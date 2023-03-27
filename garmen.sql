-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table garmen.alamats
DROP TABLE IF EXISTS `alamats`;
CREATE TABLE IF NOT EXISTS `alamats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alamats_user_id_index` (`user_id`),
  CONSTRAINT `alamats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.alamats: ~1 rows (approximately)
REPLACE INTO `alamats` (`id`, `user_id`, `nama_penerima`, `no_telp`, `jenis_alamat`, `alamat_detail`, `provinsi`, `provinsi_id`, `kecamatan_id`, `kota_id`, `kota`, `kecamatan`, `kode_pos`, `status`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Ferdy', '087857600717', 'Kantor', 'Jalan Nginden Semolo no 69', 'Jawa Timur', '11', '6136', '444', 'Surabaya', 'Gayungan', '60118', 'Utama', '2023-03-13 08:05:31', '2023-03-13 08:05:31');

-- Dumping structure for table garmen.bahans
DROP TABLE IF EXISTS `bahans`;
CREATE TABLE IF NOT EXISTS `bahans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `detail_sub_kategori_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bahans_detail_sub_kategori_id_index` (`detail_sub_kategori_id`),
  CONSTRAINT `bahans_detail_sub_kategori_id_foreign` FOREIGN KEY (`detail_sub_kategori_id`) REFERENCES `detail_sub_kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.bahans: ~15 rows (approximately)
REPLACE INTO `bahans` (`id`, `detail_sub_kategori_id`, `kode_transaksi`, `kode_bahan`, `no_surat`, `sku`, `nama_bahan`, `jenis_bahan`, `warna`, `panjang_bahan`, `panjang_bahan_diambil`, `sisa_bahan`, `vendor`, `tanggal_masuk`, `tanggal_keluar`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
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
	(12, 1, 'TR-2023-03-10-0006', 'BHN-0003', 'SJL-0012', 'SKU001/1/1', 'Jeans', 'Denim', 'Navy', 9900, 100, 9800, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 09:44:19', '2023-03-10 09:44:19'),
	(13, NULL, NULL, 'BHN-0004', 'SJL-0015', NULL, 'Kemeja Batik', 'Batik', 'Brown', 1000, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', NULL, 'bahan keluar', NULL, '2023-03-13 03:15:32', '2023-03-13 03:16:33'),
	(14, 1, 'TR-2023-03-13-0001', 'BHN-0004', 'SJL-0016', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 1000, 30, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-13', 'bahan keluar', NULL, '2023-03-13 03:16:33', '2023-03-13 04:43:45'),
	(15, 2, 'TR-2023-03-13-0002', 'BHN-0004', 'SJL-0017', 'SKU002/2/2', 'Kemeja Batik', 'Batik', 'Brown', 970, 30, 940, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-13', 'bahan keluar', NULL, '2023-03-13 04:43:45', '2023-03-13 04:43:45');

-- Dumping structure for table garmen.banks
DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.banks: ~1 rows (approximately)
REPLACE INTO `banks` (`id`, `nama_bank`, `nomor_rekening`, `nama_penerima`, `logo`, `created_at`, `updated_at`) VALUES
	(1, 'BCA', '5156562627', 'M2N', '166235818520117.png', '2022-09-05 06:09:45', '2022-09-05 06:09:45');

-- Dumping structure for table garmen.banners
DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_mulai` date NOT NULL,
  `promo_berakhir` date NOT NULL,
  `syarat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.banners: ~0 rows (approximately)

-- Dumping structure for table garmen.cucis
DROP TABLE IF EXISTS `cucis`;
CREATE TABLE IF NOT EXISTS `cucis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `cucis_jahit_id_index` (`jahit_id`),
  CONSTRAINT `cucis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.cucis: ~8 rows (approximately)
REPLACE INTO `cucis` (`id`, `jahit_id`, `no_surat`, `tanggal_masuk`, `tanggal_cuci`, `tanggal_selesai`, `tanggal_keluar`, `kain_siap_cuci`, `vendor`, `nama_vendor`, `status_pembayaran`, `harga_vendor`, `berhasil_cuci`, `konversi`, `gagal_cuci`, `barang_direpair`, `barang_dibuang`, `barang_akan_direpair`, `barang_akan_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_cuci`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 1, 'SJL-0002', NULL, '1970-01-01', '1970-01-01', '2023-03-09', 40, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 10, 5, 5, NULL, NULL, 'diperbaiki laundry', 'dibuang laundry', 25000, 0, 200000, 'cucian keluar', 'selesai', NULL, '2023-03-09 04:03:09', '2023-03-13 03:54:52'),
	(3, 2, 'SJL-0004', NULL, '1970-01-01', '1970-01-01', '2023-03-09', 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 20000, 0, 150000, 'cucian keluar', 'selesai', NULL, '2023-03-09 06:38:13', '2023-03-13 03:54:52'),
	(4, 2, 'SJL-0004', NULL, '1970-01-01', '1970-01-01', '2023-03-10', 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 0, 0, 0, NULL, NULL, '-', '-', 20000, 0, 150000, 'cucian keluar', 'selesai', NULL, '2023-03-10 04:01:12', '2023-03-13 03:54:52'),
	(5, 3, 'SJL-0005', NULL, '1970-01-01', '1970-01-01', NULL, 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 10000.00, NULL, '2 Lusin 6 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30000, 0, 30000, 'cucian masuk', 'butuh konfirmasi', NULL, '2023-03-10 04:09:28', '2023-03-13 07:05:00'),
	(6, 5, 'SJL-0007', NULL, '1970-01-01', '1970-01-01', '2023-03-13', 60, 'eksternal', 'Sumeh Laundry', 'Lunas', 12000.00, 60, NULL, 0, 0, 0, NULL, NULL, '-', '-', 60000, 0, 60000, 'cucian keluar', 'selesai', NULL, '2023-03-10 04:36:44', '2023-03-13 03:54:52'),
	(7, 10, 'SJL-0016', NULL, '1970-01-01', '1970-01-01', '2023-03-13', 55, 'eksternal', 'Sumeh Laundry', 'Lunas', 10000.00, 55, NULL, 0, 0, 0, NULL, NULL, '-', '-', 50000, 0, 50000, 'cucian keluar', 'butuh konfirmasi', NULL, '2023-03-13 03:41:46', '2023-03-13 03:54:52'),
	(8, 9, 'SJL-0012', NULL, '2023-03-12', '2023-03-13', NULL, 96, 'eksternal', 'Rara Laundry', 'Belum Lunas', 9000.00, NULL, '8 Lusin 0 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 72000, 72000, 'cucian masuk', 'butuh konfirmasi', NULL, '2023-03-13 06:47:45', '2023-03-13 07:05:00'),
	(9, 11, 'SJL-0017', NULL, '1970-01-01', '1970-01-01', NULL, 49, 'eksternal', 'rara laundry', 'Belum Lunas', 9000.00, NULL, '4 Lusin 1 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 45000, 45000, 'cucian masuk', 'butuh konfirmasi', NULL, '2023-03-13 06:53:33', '2023-03-13 07:05:00');

-- Dumping structure for table garmen.cuci_dibuangs
DROP TABLE IF EXISTS `cuci_dibuangs`;
CREATE TABLE IF NOT EXISTS `cuci_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuci_dibuangs_cuci_id_index` (`cuci_id`),
  CONSTRAINT `cuci_dibuangs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.cuci_dibuangs: ~1 rows (approximately)
REPLACE INTO `cuci_dibuangs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'M', 5, NULL, '2023-03-09 04:07:08', '2023-03-09 04:07:08');

-- Dumping structure for table garmen.cuci_direpairs
DROP TABLE IF EXISTS `cuci_direpairs`;
CREATE TABLE IF NOT EXISTS `cuci_direpairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuci_direpairs_cuci_id_index` (`cuci_id`),
  CONSTRAINT `cuci_direpairs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.cuci_direpairs: ~1 rows (approximately)
REPLACE INTO `cuci_direpairs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'M', 5, NULL, '2023-03-09 04:07:08', '2023-03-09 04:07:08');

-- Dumping structure for table garmen.detail_cucis
DROP TABLE IF EXISTS `detail_cucis`;
CREATE TABLE IF NOT EXISTS `detail_cucis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_cucis_cuci_id_index` (`cuci_id`),
  CONSTRAINT `detail_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_cucis: ~19 rows (approximately)
REPLACE INTO `detail_cucis` (`id`, `cuci_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 2, 'M', 30, NULL, '2023-03-09 04:03:09', '2023-03-09 04:07:08'),
	(3, 3, 'S', 20, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
	(4, 3, 'M', 5, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
	(5, 3, 'L', 5, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
	(6, 4, 'S', 20, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
	(7, 4, 'M', 5, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
	(8, 4, 'L', 5, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
	(9, 5, 'S', 5, NULL, '2023-03-10 04:09:28', '2023-03-10 04:09:28'),
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
	(20, 9, 'S', 49, NULL, '2023-03-13 06:53:33', '2023-03-13 06:53:33');

-- Dumping structure for table garmen.detail_finishings
DROP TABLE IF EXISTS `detail_finishings`;
CREATE TABLE IF NOT EXISTS `detail_finishings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_finishings_finishing_id_index` (`finishing_id`),
  CONSTRAINT `detail_finishings_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_finishings: ~20 rows (approximately)
REPLACE INTO `detail_finishings` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
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
	(18, 5, 'S', 20, NULL, '2023-03-13 03:54:51', '2023-03-13 03:54:51'),
	(19, 5, 'M', 20, NULL, '2023-03-13 03:54:51', '2023-03-13 03:54:51'),
	(20, 5, 'L', 20, NULL, '2023-03-13 03:54:51', '2023-03-13 03:54:51'),
	(24, 6, 'S', 20, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
	(25, 6, 'M', 20, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
	(26, 6, 'L', 15, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58');

-- Dumping structure for table garmen.detail_jahits
DROP TABLE IF EXISTS `detail_jahits`;
CREATE TABLE IF NOT EXISTS `detail_jahits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_jahits_jahit_id_index` (`jahit_id`),
  CONSTRAINT `detail_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_jahits: ~21 rows (approximately)
REPLACE INTO `detail_jahits` (`id`, `jahit_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
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
	(24, 11, 'S', 49, NULL, '2023-03-13 04:54:55', '2023-03-13 06:53:18');

-- Dumping structure for table garmen.detail_perbaikans
DROP TABLE IF EXISTS `detail_perbaikans`;
CREATE TABLE IF NOT EXISTS `detail_perbaikans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `perbaikan_id` bigint unsigned DEFAULT NULL,
  `jahit_direpair_id` bigint unsigned DEFAULT NULL,
  `cuci_direpair_id` bigint unsigned DEFAULT NULL,
  `jumlah` int NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_perbaikans_perbaikan_id_index` (`perbaikan_id`),
  KEY `detail_perbaikans_jahit_direpair_id_index` (`jahit_direpair_id`),
  KEY `detail_perbaikans_cuci_direpair_id_index` (`cuci_direpair_id`),
  CONSTRAINT `detail_perbaikans_cuci_direpair_id_foreign` FOREIGN KEY (`cuci_direpair_id`) REFERENCES `cuci_direpairs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_perbaikans_jahit_direpair_id_foreign` FOREIGN KEY (`jahit_direpair_id`) REFERENCES `jahit_direpairs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_perbaikans_perbaikan_id_foreign` FOREIGN KEY (`perbaikan_id`) REFERENCES `perbaikans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_perbaikans: ~5 rows (approximately)
REPLACE INTO `detail_perbaikans` (`id`, `perbaikan_id`, `jahit_direpair_id`, `cuci_direpair_id`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, 10, 'diperbaiki', '2023-03-09 04:04:41', '2023-03-09 09:10:29'),
	(2, 1, NULL, 1, 5, 'diperbaiki laundry', '2023-03-09 04:30:27', '2023-03-09 04:30:27'),
	(3, 2, 2, NULL, 5, 'diperbaiki', '2023-03-09 06:38:24', '2023-03-09 09:10:29'),
	(4, 3, 3, NULL, 5, 'diperbaiki coba lagi', '2023-03-10 06:32:37', '2023-03-10 06:32:37'),
	(5, 4, 5, NULL, 1, 'diperbaiki', '2023-03-13 03:51:46', '2023-03-13 03:51:46');

-- Dumping structure for table garmen.detail_potongs
DROP TABLE IF EXISTS `detail_potongs`;
CREATE TABLE IF NOT EXISTS `detail_potongs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `potong_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_potongs_potong_id_index` (`potong_id`),
  CONSTRAINT `detail_potongs_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_potongs: ~24 rows (approximately)
REPLACE INTO `detail_potongs` (`id`, `potong_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
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
	(24, 11, 'S', 50, NULL, '2023-03-13 04:54:46', '2023-03-13 04:54:46');

-- Dumping structure for table garmen.detail_produks
DROP TABLE IF EXISTS `detail_produks`;
CREATE TABLE IF NOT EXISTS `detail_produks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_produks_produk_id_index` (`produk_id`),
  CONSTRAINT `detail_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_produks: ~4 rows (approximately)
REPLACE INTO `detail_produks` (`id`, `produk_id`, `ukuran`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', -5, 50000, '2023-03-09 04:51:44', '2023-03-15 04:28:26'),
	(2, 2, 'S', 20, 150, '2023-03-27 03:39:16', '2023-03-27 03:39:16'),
	(3, 2, 'M', 20, 150, '2023-03-27 03:39:16', '2023-03-27 03:39:16'),
	(4, 2, 'L', 15, 150, '2023-03-27 03:39:16', '2023-03-27 03:39:16');

-- Dumping structure for table garmen.detail_produk_images
DROP TABLE IF EXISTS `detail_produk_images`;
CREATE TABLE IF NOT EXISTS `detail_produk_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` bigint unsigned DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_produk_images_produk_id_index` (`produk_id`),
  CONSTRAINT `detail_produk_images_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_produk_images: ~2 rows (approximately)
REPLACE INTO `detail_produk_images` (`id`, `produk_id`, `filename`, `created_at`, `updated_at`) VALUES
	(1, 1, '167833750457405.jpg', '2023-03-09 04:51:44', '2023-03-09 04:51:44'),
	(2, 2, '167988835613519.jpg', '2023-03-27 03:39:16', '2023-03-27 03:39:16');

-- Dumping structure for table garmen.detail_rekapitulasis
DROP TABLE IF EXISTS `detail_rekapitulasis`;
CREATE TABLE IF NOT EXISTS `detail_rekapitulasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rekapitulasi_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_rekapitulasis_rekapitulasi_id_index` (`rekapitulasi_id`),
  CONSTRAINT `detail_rekapitulasis_rekapitulasi_id_foreign` FOREIGN KEY (`rekapitulasi_id`) REFERENCES `rekapitulasis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_rekapitulasis: ~21 rows (approximately)
REPLACE INTO `detail_rekapitulasis` (`id`, `rekapitulasi_id`, `status`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
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

-- Dumping structure for table garmen.detail_rekapitulasi_warehouses
DROP TABLE IF EXISTS `detail_rekapitulasi_warehouses`;
CREATE TABLE IF NOT EXISTS `detail_rekapitulasi_warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rekapitulasi_warehouse_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_rekapitulasi_warehouses_rekapitulasi_warehouse_id_index` (`rekapitulasi_warehouse_id`),
  CONSTRAINT `detail_rekapitulasi_warehouses_rekapitulasi_warehouse_id_foreign` FOREIGN KEY (`rekapitulasi_warehouse_id`) REFERENCES `rekapitulasi_warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_rekapitulasi_warehouses: ~3 rows (approximately)
REPLACE INTO `detail_rekapitulasi_warehouses` (`id`, `rekapitulasi_warehouse_id`, `ukuran`, `status`, `jumlah`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', 'diretur', 1, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
	(2, 3, 'M', 'diretur', 3, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
	(3, 3, 'M', 'dibuang', 2, '2023-03-13 04:19:43', '2023-03-13 04:19:43');

-- Dumping structure for table garmen.detail_returs
DROP TABLE IF EXISTS `detail_returs`;
CREATE TABLE IF NOT EXISTS `detail_returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `retur_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_returs_retur_id_index` (`retur_id`),
  CONSTRAINT `detail_returs_retur_id_foreign` FOREIGN KEY (`retur_id`) REFERENCES `returs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_returs: ~2 rows (approximately)
REPLACE INTO `detail_returs` (`id`, `retur_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', 1, NULL, '2023-03-09 04:58:51', '2023-03-09 04:58:51'),
	(2, 4, 'M', 3, NULL, '2023-03-10 07:29:21', '2023-03-10 07:29:21');

-- Dumping structure for table garmen.detail_sampahs
DROP TABLE IF EXISTS `detail_sampahs`;
CREATE TABLE IF NOT EXISTS `detail_sampahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sampah_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_sampahs_sampah_id_index` (`sampah_id`),
  CONSTRAINT `detail_sampahs_sampah_id_foreign` FOREIGN KEY (`sampah_id`) REFERENCES `sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_sampahs: ~8 rows (approximately)
REPLACE INTO `detail_sampahs` (`id`, `sampah_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'M', 5, '2023-03-09 06:38:32', '2023-03-09 04:30:20', '2023-03-09 06:38:32'),
	(2, 2, 'M', 5, NULL, '2023-03-09 06:38:32', '2023-03-09 06:38:32'),
	(3, 3, 'L', 5, '2023-03-10 06:32:41', '2023-03-09 06:38:32', '2023-03-10 06:32:41'),
	(4, 3, 'L', 5, '2023-03-13 03:51:14', '2023-03-10 06:32:41', '2023-03-13 03:51:14'),
	(5, 4, 'S', 5, '2023-03-13 03:51:14', '2023-03-10 06:32:41', '2023-03-13 03:51:14'),
	(6, 3, 'L', 5, NULL, '2023-03-13 03:51:14', '2023-03-13 03:51:14'),
	(7, 4, 'S', 5, NULL, '2023-03-13 03:51:14', '2023-03-13 03:51:14'),
	(8, 5, 'S', 4, NULL, '2023-03-13 03:51:14', '2023-03-13 03:51:14');

-- Dumping structure for table garmen.detail_sub_kategoris
DROP TABLE IF EXISTS `detail_sub_kategoris`;
CREATE TABLE IF NOT EXISTS `detail_sub_kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sub_kategori_id` bigint unsigned DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_sub_kategoris_sub_kategori_id_index` (`sub_kategori_id`),
  CONSTRAINT `detail_sub_kategoris_sub_kategori_id_foreign` FOREIGN KEY (`sub_kategori_id`) REFERENCES `sub_kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_sub_kategoris: ~2 rows (approximately)
REPLACE INTO `detail_sub_kategoris` (`id`, `sub_kategori_id`, `nama_kategori`, `sku`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Kemeja Lengan Panjang', 'SKU001/1/1', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
	(2, 2, 'Kemeja Lengan Pendek', 'SKU002/2/2', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28');

-- Dumping structure for table garmen.detail_transaksis
DROP TABLE IF EXISTS `detail_transaksis`;
CREATE TABLE IF NOT EXISTS `detail_transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned DEFAULT NULL,
  `produk_id` bigint unsigned DEFAULT NULL,
  `promo_id` bigint unsigned DEFAULT NULL,
  `jumlah` int NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double NOT NULL,
  `total_harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_transaksis_transaksi_id_index` (`transaksi_id`),
  KEY `detail_transaksis_produk_id_index` (`produk_id`),
  KEY `detail_transaksis_promo_id_index` (`promo_id`),
  CONSTRAINT `detail_transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_transaksis_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_transaksis: ~7 rows (approximately)
REPLACE INTO `detail_transaksis` (`id`, `transaksi_id`, `produk_id`, `promo_id`, `jumlah`, `ukuran`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:12:34', '2023-03-09 08:12:34'),
	(2, 2, 1, NULL, 2, 'M', 50000, 100000, '2023-03-09 08:30:58', '2023-03-09 08:30:58'),
	(3, 3, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:32:03', '2023-03-09 08:32:03'),
	(4, 4, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:34:58', '2023-03-09 08:34:58'),
	(5, 5, 1, NULL, 1, 'M', 50000, 50000, '2023-03-13 08:05:52', '2023-03-13 08:05:52'),
	(8, 6, 1, NULL, 32, 'M', 50000, 1600000, '2023-03-15 04:25:51', '2023-03-15 04:25:51'),
	(9, 22, 2, NULL, 1, 'S,M,L', 150, 150, '2023-03-27 03:49:21', '2023-03-27 03:49:21');

-- Dumping structure for table garmen.detail_warehouses
DROP TABLE IF EXISTS `detail_warehouses`;
CREATE TABLE IF NOT EXISTS `detail_warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_warehouses_warehouse_id_index` (`warehouse_id`),
  CONSTRAINT `detail_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.detail_warehouses: ~10 rows (approximately)
REPLACE INTO `detail_warehouses` (`id`, `warehouse_id`, `ukuran`, `jumlah`, `harga`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', 28, 50000, NULL, '2023-03-09 04:34:47', '2023-03-09 08:34:58'),
	(2, 2, 'S', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
	(3, 2, 'M', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
	(4, 2, 'L', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
	(5, 3, 'S', 10, 150, NULL, '2023-03-10 07:29:16', '2023-03-27 03:37:49'),
	(6, 3, 'M', 5, 150, NULL, '2023-03-10 07:29:16', '2023-03-27 03:37:49'),
	(7, 3, 'L', 10, 150, NULL, '2023-03-10 07:29:16', '2023-03-27 03:37:49'),
	(8, 4, 'S', 20, 150, NULL, '2023-03-27 03:18:58', '2023-03-27 03:36:58'),
	(9, 4, 'M', 20, 150, NULL, '2023-03-27 03:18:58', '2023-03-27 03:36:58'),
	(10, 4, 'L', 15, 150, NULL, '2023-03-27 03:18:58', '2023-03-27 03:36:58');

-- Dumping structure for table garmen.favorits
DROP TABLE IF EXISTS `favorits`;
CREATE TABLE IF NOT EXISTS `favorits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `produk_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorits_user_id_index` (`user_id`),
  KEY `favorits_produk_id_index` (`produk_id`),
  CONSTRAINT `favorits_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.favorits: ~0 rows (approximately)

-- Dumping structure for table garmen.finishings
DROP TABLE IF EXISTS `finishings`;
CREATE TABLE IF NOT EXISTS `finishings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishings_cuci_id_index` (`cuci_id`),
  CONSTRAINT `finishings_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.finishings: ~5 rows (approximately)
REPLACE INTO `finishings` (`id`, `cuci_id`, `no_surat`, `tanggal_masuk`, `tanggal_qc`, `tanggal_selesai`, `barang_lolos_qc`, `barang_gagal_qc`, `barang_diretur`, `barang_dibuang`, `keterangan_diretur`, `keterangan_dibuang`, `status`, `status_finishing`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'SJL-0002', '2023-03-09', '2023-03-08', '2023-03-09', 29, 1, 1, 0, 'retur dari gudang', NULL, 'kirim warehouse', NULL, NULL, '2023-03-09 04:30:02', '2023-03-09 04:34:47'),
	(2, 3, 'SJL-0004', '2023-03-09', '2023-03-08', '2023-03-08', 30, 0, 0, 0, NULL, NULL, 'kirim warehouse', NULL, NULL, '2023-03-09 08:42:45', '2023-03-09 08:43:52'),
	(3, 4, 'SJL-0004', '2023-03-10', '2023-03-10', '2023-03-10', 25, 5, 3, 2, 'retur', 'buang', 'kirim warehouse', NULL, NULL, '2023-03-10 06:22:24', '2023-03-10 07:29:16'),
	(5, 6, 'SJL-0007', '2023-03-13', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'finishing masuk', NULL, NULL, '2023-03-13 03:54:51', '2023-03-13 03:54:51'),
	(6, 7, 'SJL-0016', '2023-03-13', '2023-03-13', '2023-03-27', 55, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, NULL, '2023-03-13 04:15:35', '2023-03-27 03:18:58');

-- Dumping structure for table garmen.finishing_dibuangs
DROP TABLE IF EXISTS `finishing_dibuangs`;
CREATE TABLE IF NOT EXISTS `finishing_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishing_dibuangs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `finishing_dibuangs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.finishing_dibuangs: ~1 rows (approximately)
REPLACE INTO `finishing_dibuangs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 3, 'M', 2, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16');

-- Dumping structure for table garmen.finishing_returs
DROP TABLE IF EXISTS `finishing_returs`;
CREATE TABLE IF NOT EXISTS `finishing_returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishing_returs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `finishing_returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.finishing_returs: ~2 rows (approximately)
REPLACE INTO `finishing_returs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', 1, NULL, '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
	(2, 3, 'M', 3, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16');

-- Dumping structure for table garmen.jahits
DROP TABLE IF EXISTS `jahits`;
CREATE TABLE IF NOT EXISTS `jahits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `potong_id` bigint unsigned DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `jahits_potong_id_index` (`potong_id`),
  CONSTRAINT `jahits_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.jahits: ~10 rows (approximately)
REPLACE INTO `jahits` (`id`, `potong_id`, `no_surat`, `tanggal_jahit`, `tanggal_selesai`, `tanggal_keluar`, `vendor`, `nama_vendor`, `harga_vendor`, `berhasil`, `jumlah_bahan`, `konversi`, `gagal_jahit`, `barang_direpair`, `barang_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `status_pembayaran`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_jahit`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'SJL-0002', '2023-03-08', '2023-03-08', '2023-03-09', 'eksternal', 'PT Sumeh Jaya Tailor', 50000.00, 40, 50, '4 Lusin 2 pcs', 10, 10, 0, 'diperbaiki', NULL, 'Lunas', 2500000, 0, 2500000, 'jahitan keluar', 'selesai', NULL, '2023-03-08 09:11:47', '2023-03-09 06:31:32'),
	(2, 2, 'SJL-0004', '2023-03-09', '2023-03-09', '2023-03-10', 'internal', NULL, NULL, 30, 40, '3 Lusin 4 pcs', 10, 5, 5, 'diperbaiki', 'dibuang', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', NULL, '2023-03-09 06:30:38', '2023-03-10 04:01:12'),
	(3, 3, 'SJL-0005', '2023-03-08', '2023-03-08', '2023-03-10', 'eksternal', 'PT Sumeh Jaya Tailor', 100000.00, 30, 40, '3 Lusin 4 pcs', 10, 5, 5, 'diperbaiki coba lagi', 'dibuang coba lagi', 'Lunas', 400000, 0, 400000, 'jahitan keluar', 'selesai', NULL, '2023-03-09 06:41:13', '2023-03-10 04:34:52'),
	(5, 5, 'SJL-0007', '2023-03-10', '2023-03-10', '2023-03-10', 'eksternal', 'Sumeh Laundry', 5000.00, 60, 60, '5 Lusin 0 pcs', 0, 0, 0, '-', '-', 'Lunas', 25000, 0, 25000, 'jahitan keluar', 'selesai', NULL, '2023-03-10 04:31:16', '2023-03-10 04:36:44'),
	(6, 6, 'SJL-0008', '2023-03-10', '2023-03-10', NULL, 'internal', NULL, NULL, 48, 48, '4 Lusin 0 pcs', 0, 0, 0, '0', '0', NULL, 0, NULL, NULL, 'jahitan selesai', 'selesai', NULL, '2023-03-10 06:31:34', '2023-03-10 06:32:29'),
	(7, 7, 'SJL-0009', '2023-03-10', '2023-03-10', NULL, 'eksternal', 'Indonesia Tailor', 100.00, NULL, 20, '1 Lusin 8 pcs', NULL, NULL, NULL, NULL, NULL, 'Belum Lunas', 0, 200, 200, 'jahitan masuk', 'butuh konfirmasi', '2023-03-13 03:19:58', '2023-03-10 08:08:52', '2023-03-13 03:19:58'),
	(8, 8, 'SJL-0011', '2023-03-09', '2023-03-10', NULL, 'eksternal', 'PT Sumeh Jaya Tailor', 50000.00, 95, 100, '8 Lusin 4 pcs', 5, 3, 2, '3 diperbaiki', '2 dibuang', 'Lunas', 450000, 0, 450000, 'jahitan selesai', 'selesai', NULL, '2023-03-10 08:22:02', '2023-03-10 09:43:14'),
	(9, 9, 'SJL-0012', '2023-03-10', '2023-03-10', '2023-03-13', 'eksternal', 'PT Sumeh Jaya Tailor', 100000.00, 96, 100, '8 Lusin 4 pcs', 4, 4, 0, '-', '-', 'Lunas', 900000, 0, 900000, 'jahitan keluar', 'selesai', NULL, '2023-03-10 09:45:02', '2023-03-13 06:47:45'),
	(10, 10, 'SJL-0016', '2023-03-13', '2023-03-13', '2023-03-13', 'eksternal', 'PT Sumeh Jaya Tailor', 15000.00, 55, 60, '5 Lusin 0 pcs', 5, 1, 4, 'diperbaiki', 'dibuang', 'Termin 1', 45000, 30000, 75000, 'jahitan keluar', 'selesai', NULL, '2023-03-13 03:18:33', '2023-03-13 03:41:46'),
	(11, 11, 'SJL-0017', '2023-03-10', '2023-03-12', '2023-03-13', 'internal', NULL, NULL, 49, 50, '4 Lusin 2 pcs', 1, 1, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', NULL, '2023-03-13 04:54:55', '2023-03-13 06:53:33');

-- Dumping structure for table garmen.jahit_dibuangs
DROP TABLE IF EXISTS `jahit_dibuangs`;
CREATE TABLE IF NOT EXISTS `jahit_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jahit_dibuangs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `jahit_dibuangs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.jahit_dibuangs: ~4 rows (approximately)
REPLACE INTO `jahit_dibuangs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'L', 5, NULL, '2023-03-09 06:37:28', '2023-03-09 06:37:28'),
	(2, 3, 'S', 5, NULL, '2023-03-09 07:12:23', '2023-03-09 07:12:23'),
	(3, 8, 'S', 2, NULL, '2023-03-10 09:43:14', '2023-03-10 09:43:14'),
	(4, 10, 'S', 4, NULL, '2023-03-13 03:30:36', '2023-03-13 03:30:36');

-- Dumping structure for table garmen.jahit_direpairs
DROP TABLE IF EXISTS `jahit_direpairs`;
CREATE TABLE IF NOT EXISTS `jahit_direpairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jahit_direpairs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `jahit_direpairs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.jahit_direpairs: ~7 rows (approximately)
REPLACE INTO `jahit_direpairs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'M', 10, NULL, '2023-03-09 03:49:45', '2023-03-09 03:49:45'),
	(2, 2, 'M', 5, NULL, '2023-03-09 06:37:28', '2023-03-09 06:37:28'),
	(3, 3, 'S', 5, NULL, '2023-03-09 07:12:23', '2023-03-09 07:12:23'),
	(4, 8, 'S', 3, NULL, '2023-03-10 09:43:14', '2023-03-10 09:43:14'),
	(5, 10, 'M', 1, NULL, '2023-03-13 03:30:36', '2023-03-13 03:30:36'),
	(6, 9, 'L', 4, NULL, '2023-03-13 06:47:08', '2023-03-13 06:47:08'),
	(7, 11, 'S', 1, NULL, '2023-03-13 06:53:18', '2023-03-13 06:53:18');

-- Dumping structure for table garmen.kategoris
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.kategoris: ~2 rows (approximately)
REPLACE INTO `kategoris` (`id`, `nama_kategori`, `sku`, `gambar`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Pria', 'SKU001', NULL, NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
	(2, 'Wanita', 'SKU002', NULL, NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28');

-- Dumping structure for table garmen.keranjangs
DROP TABLE IF EXISTS `keranjangs`;
CREATE TABLE IF NOT EXISTS `keranjangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `produk_id` bigint unsigned DEFAULT NULL,
  `check` int NOT NULL DEFAULT '0',
  `harga` double NOT NULL,
  `jumlah` double NOT NULL,
  `subtotal` double NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `keranjangs_user_id_index` (`user_id`),
  KEY `keranjangs_produk_id_index` (`produk_id`),
  CONSTRAINT `keranjangs_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.keranjangs: ~0 rows (approximately)

-- Dumping structure for table garmen.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.migrations: ~49 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
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

-- Dumping structure for table garmen.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table garmen.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.model_has_roles: ~5 rows (approximately)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\User', 1),
	(2, 'App\\User', 2),
	(4, 'App\\User', 3),
	(3, 'App\\User', 4),
	(5, 'App\\User', 5);

-- Dumping structure for table garmen.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` int NOT NULL DEFAULT '0',
  `read` int NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.notifications: ~57 rows (approximately)
REPLACE INTO `notifications` (`id`, `description`, `url`, `aktif`, `read`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-08 08:39:39', '2023-03-08 08:39:39'),
	(2, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-08 09:11:47', '2023-03-08 09:11:47'),
	(3, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-09 03:50:03', '2023-03-09 03:50:03'),
	(4, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-09 04:03:09', '2023-03-09 04:03:09'),
	(5, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-09 04:30:02', '2023-03-09 04:30:02'),
	(6, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-09 04:30:02', '2023-03-13 08:44:33'),
	(7, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 0, 0, 'production', '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
	(8, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 04:34:47', '2023-03-13 08:44:33'),
	(9, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 04:50:03', '2023-03-13 08:44:33'),
	(10, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-09 06:29:33', '2023-03-09 06:29:33'),
	(11, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-09 06:30:38', '2023-03-09 06:30:38'),
	(12, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
	(13, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-09 06:40:13', '2023-03-09 06:40:13'),
	(14, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-09 06:41:13', '2023-03-09 06:41:13'),
	(15, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-09 08:42:45', '2023-03-09 08:42:45'),
	(16, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-09 08:42:45', '2023-03-13 08:44:33'),
	(17, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 0, 0, 'production', '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
	(18, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 08:43:52', '2023-03-13 08:44:33'),
	(19, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
	(20, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-10 04:09:28', '2023-03-10 04:09:28'),
	(21, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 04:17:28', '2023-03-10 04:17:28'),
	(22, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 04:24:35', '2023-03-10 04:24:35'),
	(23, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 04:27:01', '2023-03-10 04:27:01'),
	(24, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 04:31:16', '2023-03-10 04:31:16'),
	(25, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-10 04:36:44', '2023-03-10 04:36:44'),
	(26, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-10 06:22:24', '2023-03-10 06:22:24'),
	(27, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-10 06:22:24', '2023-03-13 08:44:33'),
	(28, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 06:30:10', '2023-03-10 06:30:10'),
	(29, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 06:31:34', '2023-03-10 06:31:34'),
	(30, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 0, 0, 'production', '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
	(31, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-10 07:29:16', '2023-03-13 08:44:33'),
	(32, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 08:07:44', '2023-03-10 08:07:44'),
	(33, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 08:08:52', '2023-03-10 08:08:52'),
	(34, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 08:20:49', '2023-03-10 08:20:49'),
	(35, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 08:22:02', '2023-03-10 08:22:02'),
	(36, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-10 09:44:19', '2023-03-10 09:44:19'),
	(37, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-10 09:45:02', '2023-03-10 09:45:02'),
	(38, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-13 03:16:33', '2023-03-13 03:16:33'),
	(39, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-13 03:18:33', '2023-03-13 03:18:33'),
	(40, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-13 03:41:46', '2023-03-13 03:41:46'),
	(41, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-13 03:50:24', '2023-03-13 03:50:24'),
	(42, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-13 03:50:24', '2023-03-13 08:44:33'),
	(43, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-13 03:54:51', '2023-03-13 03:54:51'),
	(44, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-13 03:54:51', '2023-03-13 08:44:33'),
	(45, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 0, 0, 'production', '2023-03-13 04:43:45', '2023-03-13 04:43:45'),
	(46, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 0, 0, 'production', '2023-03-13 04:54:55', '2023-03-13 04:54:55'),
	(47, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-13 06:47:45', '2023-03-13 06:47:45'),
	(48, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 0, 0, 'production', '2023-03-13 06:53:33', '2023-03-13 06:53:33'),
	(49, 'Ada transaksi baru INV150320236', 'http://192.168.18.131:8000/admin/transaksi', 0, 0, 'online', '2023-03-15 04:25:51', '2023-03-15 04:25:51'),
	(50, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 0, 0, 'production', '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
	(51, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
	(52, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:33:41', '2023-03-27 03:33:41'),
	(53, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:34', '2023-03-27 03:36:34'),
	(54, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:45', '2023-03-27 03:36:45'),
	(55, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:58', '2023-03-27 03:36:58'),
	(56, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:37:49', '2023-03-27 03:37:49'),
	(57, 'Ada transaksi baru INV270320237', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-03-27 03:49:21', '2023-03-27 03:49:21');

-- Dumping structure for table garmen.notification_ecommerces
DROP TABLE IF EXISTS `notification_ecommerces`;
CREATE TABLE IF NOT EXISTS `notification_ecommerces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `transaksi_id` bigint unsigned DEFAULT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_ecommerces_user_id_index` (`user_id`),
  KEY `notification_ecommerces_transaksi_id_index` (`transaksi_id`),
  CONSTRAINT `notification_ecommerces_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notification_ecommerces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.notification_ecommerces: ~2 rows (approximately)
REPLACE INTO `notification_ecommerces` (`id`, `user_id`, `transaksi_id`, `pesan`, `created_at`, `updated_at`) VALUES
	(1, 5, 5, 'Pesanan dengan nomor transaksi INV130320233 dalam proses pengiriman!', '2023-03-13 08:23:28', '2023-03-13 08:23:28'),
	(2, 5, 6, 'Pesanan dengan nomor transaksi INV150320236 dalam proses pengiriman!', '2023-03-15 04:28:26', '2023-03-15 04:28:26');

-- Dumping structure for table garmen.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.password_resets: ~0 rows (approximately)

-- Dumping structure for table garmen.pembayaran_cucis
DROP TABLE IF EXISTS `pembayaran_cucis`;
CREATE TABLE IF NOT EXISTS `pembayaran_cucis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_cucis_cuci_id_index` (`cuci_id`),
  CONSTRAINT `pembayaran_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.pembayaran_cucis: ~8 rows (approximately)
REPLACE INTO `pembayaran_cucis` (`id`, `cuci_id`, `status`, `nominal`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Lunas', 25000, NULL, '2023-03-09 04:29:49', '2023-03-09 04:29:49'),
	(2, 4, 'Lunas', 20000, NULL, '2023-03-10 06:21:50', '2023-03-10 06:21:50'),
	(3, 3, 'Lunas', 20000, NULL, '2023-03-10 06:23:05', '2023-03-10 06:23:05'),
	(4, 5, 'Termin 1', 10000, NULL, '2023-03-10 09:07:22', '2023-03-10 09:07:22'),
	(5, 5, 'Termin 2', 20000, NULL, '2023-03-10 09:07:41', '2023-03-10 09:07:41'),
	(6, 6, 'Termin 1', 30000, NULL, '2023-03-10 09:59:09', '2023-03-10 09:59:09'),
	(7, 6, 'Termin 2', 30000, NULL, '2023-03-10 09:59:09', '2023-03-10 09:59:09'),
	(8, 7, 'Termin 1', 50000, NULL, '2023-03-13 03:49:13', '2023-03-13 03:49:13');

-- Dumping structure for table garmen.pembayaran_jahits
DROP TABLE IF EXISTS `pembayaran_jahits`;
CREATE TABLE IF NOT EXISTS `pembayaran_jahits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_jahits_jahit_id_index` (`jahit_id`),
  CONSTRAINT `pembayaran_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.pembayaran_jahits: ~13 rows (approximately)
REPLACE INTO `pembayaran_jahits` (`id`, `jahit_id`, `status`, `nominal`, `deleted_at`, `created_at`, `updated_at`) VALUES
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
	(13, 9, 'Termin 3', 300000, NULL, '2023-03-13 03:31:14', '2023-03-13 03:31:14');

-- Dumping structure for table garmen.perbaikans
DROP TABLE IF EXISTS `perbaikans`;
CREATE TABLE IF NOT EXISTS `perbaikans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bahan_id` bigint unsigned DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perbaikans_bahan_id_index` (`bahan_id`),
  CONSTRAINT `perbaikans_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.perbaikans: ~4 rows (approximately)
REPLACE INTO `perbaikans` (`id`, `bahan_id`, `tanggal_masuk`, `tanggal_kirim`, `tanggal_selesai`, `total`, `ukuran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, '2023-03-09', NULL, NULL, 15, 'M', 'butuh konfirmasi', '2023-03-09 04:04:41', '2023-03-09 04:30:27'),
	(2, 4, '2023-03-09', NULL, '2023-03-12', 5, 'M', 'proses repair', '2023-03-09 06:38:24', '2023-03-13 04:56:21'),
	(3, 5, '2023-03-10', NULL, '2023-03-13', 5, 'S', 'proses repair', '2023-03-10 06:32:37', '2023-03-13 04:55:56'),
	(4, 14, '2023-03-13', NULL, NULL, 1, 'M', 'butuh konfirmasi', '2023-03-13 03:51:46', '2023-03-13 03:51:46');

-- Dumping structure for table garmen.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.permissions: ~0 rows (approximately)

-- Dumping structure for table garmen.potongs
DROP TABLE IF EXISTS `potongs`;
CREATE TABLE IF NOT EXISTS `potongs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bahan_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `potongs_bahan_id_index` (`bahan_id`),
  CONSTRAINT `potongs_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.potongs: ~11 rows (approximately)
REPLACE INTO `potongs` (`id`, `bahan_id`, `no_surat`, `tanggal_cutting`, `tanggal_selesai`, `tanggal_keluar`, `hasil_cutting`, `konversi`, `status`, `status_potong`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 2, 'SJL-0002', '2023-03-08', '2023-03-08', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-08 08:39:39', '2023-03-08 09:11:47'),
	(2, 4, 'SJL-0004', '2023-03-09', '2023-03-09', NULL, 40.00, '3 Lusin 4 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-09 06:29:33', '2023-03-09 06:30:38'),
	(3, 5, 'SJL-0005', '2023-03-09', '2023-03-09', NULL, 40.00, '3 Lusin 4 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-09 06:40:13', '2023-03-09 06:41:13'),
	(4, 6, 'SJL-0006', '2023-03-10', '2023-03-10', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 04:17:28', '2023-03-10 04:27:01'),
	(5, 7, 'SJL-0007', '2023-03-10', '2023-03-10', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 04:24:35', '2023-03-10 04:31:16'),
	(6, 8, 'SJL-0008', '2023-03-10', '2023-03-10', NULL, 48.00, '4 Lusin 0 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 06:30:10', '2023-03-10 06:31:34'),
	(7, 9, 'SJL-0009', '2023-03-10', '2023-03-10', NULL, 20.00, '1 Lusin 8 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 08:07:44', '2023-03-10 08:08:52'),
	(8, 11, 'SJL-0011', '2023-03-10', '2023-03-10', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 08:20:49', '2023-03-10 08:22:02'),
	(9, 12, 'SJL-0012', '2023-03-10', '2023-03-10', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-10 09:44:19', '2023-03-10 09:45:02'),
	(10, 14, 'SJL-0016', '2023-03-13', '2023-03-13', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-13 03:16:33', '2023-03-13 03:18:33'),
	(11, 15, 'SJL-0017', '2023-03-13', '2023-03-13', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'butuh konfirmasi', NULL, '2023-03-13 04:43:45', '2023-03-13 04:54:55');

-- Dumping structure for table garmen.produks
DROP TABLE IF EXISTS `produks`;
CREATE TABLE IF NOT EXISTS `produks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_id` bigint unsigned DEFAULT NULL,
  `warehouse_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produks_kode_produk_unique` (`kode_produk`),
  UNIQUE KEY `produks_barcode_unique` (`barcode`),
  KEY `produks_promo_id_index` (`promo_id`),
  KEY `produks_warehouse_id_index` (`warehouse_id`),
  CONSTRAINT `produks_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produks_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.produks: ~2 rows (approximately)
REPLACE INTO `produks` (`id`, `kode_produk`, `promo_id`, `warehouse_id`, `barcode`, `nama_produk`, `deskripsi_produk`, `stok`, `harga`, `harga_promo`, `status`, `kategori`, `sub_kategori`, `detail_sub_kategori`, `created_at`, `updated_at`) VALUES
	(1, 'PRD-1', NULL, 1, NULL, 'kaos Polos', 'Kaos Polos', -5, 0, 0, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2023-03-09 04:51:44', '2023-03-15 04:28:26'),
	(2, 'PRD-2', NULL, 4, NULL, 'Kemeja Batik', 'batik bos', 55, 0, 0, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2023-03-27 03:39:16', '2023-03-27 03:39:16');

-- Dumping structure for table garmen.promos
DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_mulai` date NOT NULL,
  `promo_berakhir` date NOT NULL,
  `potongan` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promos_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.promos: ~0 rows (approximately)

-- Dumping structure for table garmen.rekapitulasis
DROP TABLE IF EXISTS `rekapitulasis`;
CREATE TABLE IF NOT EXISTS `rekapitulasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `jumlah_diperbaiki` int DEFAULT NULL,
  `jumlah_dibuang` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekapitulasis_cuci_id_index` (`cuci_id`),
  KEY `rekapitulasis_jahit_id_index` (`jahit_id`),
  CONSTRAINT `rekapitulasis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekapitulasis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.rekapitulasis: ~10 rows (approximately)
REPLACE INTO `rekapitulasis` (`id`, `cuci_id`, `jahit_id`, `jumlah_diperbaiki`, `jumlah_dibuang`, `deleted_at`, `created_at`, `updated_at`) VALUES
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

-- Dumping structure for table garmen.rekapitulasi_warehouses
DROP TABLE IF EXISTS `rekapitulasi_warehouses`;
CREATE TABLE IF NOT EXISTS `rekapitulasi_warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint unsigned DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah_diretur` int DEFAULT NULL,
  `jumlah_dibuang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekapitulasi_warehouses_warehouse_id_index` (`warehouse_id`),
  CONSTRAINT `rekapitulasi_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.rekapitulasi_warehouses: ~3 rows (approximately)
REPLACE INTO `rekapitulasi_warehouses` (`id`, `warehouse_id`, `tanggal_kirim`, `tanggal_masuk`, `jumlah_diretur`, `jumlah_dibuang`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL, 1, 0, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
	(2, 2, NULL, NULL, 0, 0, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
	(3, 3, NULL, NULL, 3, 2, '2023-03-13 04:19:43', '2023-03-13 04:19:43');

-- Dumping structure for table garmen.returs
DROP TABLE IF EXISTS `returs`;
CREATE TABLE IF NOT EXISTS `returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `total_barang` int NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan_diretur` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `returs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.returs: ~2 rows (approximately)
REPLACE INTO `returs` (`id`, `finishing_id`, `total_barang`, `tanggal_masuk`, `keterangan_diretur`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2023-03-08', 'retur dari gudang', NULL, '2023-03-09 04:58:51', '2023-03-09 04:58:51'),
	(4, 3, 3, '2023-03-09', 'retur', NULL, '2023-03-10 07:29:21', '2023-03-10 07:29:21');

-- Dumping structure for table garmen.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.roles: ~5 rows (approximately)
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'production', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
	(2, 'warehouse', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
	(3, 'admin-online', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
	(4, 'admin-offline', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
	(5, 'ecommerce', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17');

-- Dumping structure for table garmen.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.role_has_permissions: ~0 rows (approximately)

-- Dumping structure for table garmen.sampahs
DROP TABLE IF EXISTS `sampahs`;
CREATE TABLE IF NOT EXISTS `sampahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `tanggal_masuk` date DEFAULT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sampahs_cuci_id_index` (`cuci_id`),
  KEY `sampahs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `sampahs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sampahs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.sampahs: ~4 rows (approximately)
REPLACE INTO `sampahs` (`id`, `cuci_id`, `jahit_id`, `total`, `tanggal_masuk`, `asal`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 2, NULL, 5, '2023-03-09', 'cuci', NULL, '2023-03-09 04:30:20', '2023-03-09 04:30:20'),
	(3, NULL, 2, 5, '2023-03-09', 'jahit', NULL, '2023-03-09 06:38:32', '2023-03-09 06:38:32'),
	(4, NULL, 3, 5, '2023-03-09', 'jahit', NULL, '2023-03-10 06:32:41', '2023-03-10 06:32:41'),
	(5, NULL, 10, 4, '2023-03-13', 'jahit', NULL, '2023-03-13 03:51:14', '2023-03-13 03:51:14');

-- Dumping structure for table garmen.sub_kategoris
DROP TABLE IF EXISTS `sub_kategoris`;
CREATE TABLE IF NOT EXISTS `sub_kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kategoris_kategori_id_index` (`kategori_id`),
  CONSTRAINT `sub_kategoris_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.sub_kategoris: ~3 rows (approximately)
REPLACE INTO `sub_kategoris` (`id`, `kategori_id`, `nama_kategori`, `sku`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Kemeja', 'SKU001/1', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
	(2, 2, 'Kemeja', 'SKU002/2', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
	(3, 1, 'Kemeja lengan panjaannnnnnngggggg', 'SKU001/2', NULL, '2023-03-09 07:55:37', '2023-03-09 07:55:37');

-- Dumping structure for table garmen.transaksis
DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE IF NOT EXISTS `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `alamat_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  KEY `transaksis_bank_id_index` (`bank_id`),
  KEY `transaksis_user_id_index` (`user_id`),
  KEY `transaksis_alamat_id_index` (`alamat_id`),
  CONSTRAINT `transaksis_alamat_id_foreign` FOREIGN KEY (`alamat_id`) REFERENCES `alamats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksis_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.transaksis: ~7 rows (approximately)
REPLACE INTO `transaksis` (`id`, `bank_id`, `user_id`, `alamat_id`, `nama`, `no_hp`, `alamat`, `no_resi`, `ongkir`, `kode_transaksi`, `tgl_transaksi`, `qty`, `total_harga`, `status_transaksi`, `status`, `status_bayar`, `bukti_bayar`, `pembayaran`, `bayar`, `kembalian`, `created_at`, `updated_at`) VALUES
	(1, NULL, NULL, NULL, 'Didan', '087857600717', 'Jalan Kehatimu', NULL, NULL, 'INV090320231', '2023-03-09 08:12:34', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:12:34', '2023-03-09 08:12:34'),
	(2, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320232', '2023-03-09 08:30:58', 2, 100000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:30:58', '2023-03-09 08:30:58'),
	(3, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320233', '2023-03-09 08:32:03', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:32:03', '2023-03-09 08:32:03'),
	(4, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320234', '2023-03-09 08:34:58', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:34:58', '2023-03-09 08:34:58'),
	(5, 1, 5, 1, NULL, NULL, NULL, '1239102312031', NULL, 'INV130320233', '2023-03-13 08:05:52', 1, 57500, 'online', 'dikirim', 'sudah dibayar', NULL, NULL, NULL, NULL, '2023-03-13 08:05:52', '2023-03-13 08:23:28'),
	(6, 1, 5, 1, NULL, NULL, NULL, '123456789', NULL, 'INV150320236', '2023-03-15 04:25:51', 32, 1602500, 'online', 'telah tiba', 'sudah dibayar', '167885446747726.jpg', NULL, NULL, NULL, '2023-03-15 04:25:51', '2023-03-15 04:28:52'),
	(22, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, 'INV270320237', '2023-03-27 03:49:21', 1, 2650, 'online', 'butuh konfirmasi', 'sudah dibayar', '167988897497466.jpg', NULL, NULL, NULL, '2023-03-27 03:49:21', '2023-03-27 03:50:52');

-- Dumping structure for table garmen.ulasans
DROP TABLE IF EXISTS `ulasans`;
CREATE TABLE IF NOT EXISTS `ulasans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `transaksi_id` bigint unsigned DEFAULT NULL,
  `produk_id` bigint unsigned DEFAULT NULL,
  `rating` int NOT NULL,
  `ulasan` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ulasans_user_id_index` (`user_id`),
  KEY `ulasans_transaksi_id_index` (`transaksi_id`),
  KEY `ulasans_produk_id_index` (`produk_id`),
  CONSTRAINT `ulasans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ulasans_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ulasans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.ulasans: ~0 rows (approximately)

-- Dumping structure for table garmen.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.users: ~5 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'produksi', 'produksi@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$g2RMxxO1CR5iytO74MkDw.X78FDmoUnGHFDedi1vpQR6hw7.5aQ9S', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
	(2, 'gudang', 'gudang@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$afzpOg9YOmqMBbqA1g3n2Oy7CYxIIQXi1TUYJQ8cbMuaH4.SBkWDe', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
	(3, 'admin', 'admin_offline@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$6EywlLEgK/AyJ24cWrVfxePD1i5pLvLl2YXoW1E/lo6QpIus9G0gq', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
	(4, 'admin online', 'admin_online@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$6EywlLEgK/AyJ24cWrVfxePD1i5pLvLl2YXoW1E/lo6QpIus9G0gq', NULL, NULL, '2023-03-08 08:20:22', '2023-03-09 07:53:43'),
	(5, 'Didan Rizky Adha', 'didanadha99@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$9QO.cmA/f8W9IfgkbqDDAe1bohF5T1Aq4vFTGjCZKDVdBJzRqduPi', NULL, NULL, '2023-03-10 03:45:31', '2023-03-10 03:45:31');

-- Dumping structure for table garmen.warehouses
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `harga_produk` double(8,2) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouses_finishing_id_index` (`finishing_id`),
  CONSTRAINT `warehouses_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table garmen.warehouses: ~4 rows (approximately)
REPLACE INTO `warehouses` (`id`, `finishing_id`, `harga_produk`, `tanggal_masuk`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 0.00, NULL, NULL, '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
	(2, 2, 0.00, NULL, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
	(3, 3, 0.00, NULL, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
	(4, 6, 0.00, NULL, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
