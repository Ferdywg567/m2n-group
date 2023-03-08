-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: garmen
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alamats`
--

DROP TABLE IF EXISTS `alamats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alamats` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alamats`
--

LOCK TABLES `alamats` WRITE;
/*!40000 ALTER TABLE `alamats` DISABLE KEYS */;
INSERT INTO `alamats` VALUES (1,6,'tes','0812919283','Rumah','tes 123','Jawa Timur','11','6155','444','Surabaya','Tambaksari','60267','Utama','2022-09-05 12:40:39','2022-09-05 12:40:39'),(2,5,'Ryan Ardito','081282828828','Rumah','Jl. Ir. Soekarno 45','Bali','1','258','17','Badung','Abiansemal','61257','Utama','2022-09-05 13:11:35','2022-09-05 13:11:35'),(3,7,'Aziz Muslim','083894267082','Rumah','Jl. Asirot No. 26','DKI Jakarta','6','2090','151','Jakarta Barat','Kebon Jeruk','11560','Utama','2022-12-22 18:59:39','2022-12-22 18:59:39');
/*!40000 ALTER TABLE `alamats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bahans`
--

DROP TABLE IF EXISTS `bahans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahans` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bahans_detail_sub_kategori_id_index` (`detail_sub_kategori_id`),
  CONSTRAINT `bahans_detail_sub_kategori_id_foreign` FOREIGN KEY (`detail_sub_kategori_id`) REFERENCES `detail_sub_kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahans`
--

LOCK TABLES `bahans` WRITE;
/*!40000 ALTER TABLE `bahans` DISABLE KEYS */;
INSERT INTO `bahans` VALUES (1,NULL,NULL,'B01','SJ050920221057',NULL,'Kaos Polos','Cotton Combed 24s','Hitam',25,NULL,NULL,'Triple A','2022-09-05',NULL,'bahan keluar','2022-09-05 10:58:22','2022-09-05 10:58:58'),(3,NULL,NULL,'B02','SJ050920221105',NULL,'Kemeja lengan panjang','Satin','Putih',50,NULL,NULL,'Triple A','2022-09-05',NULL,'bahan keluar','2022-09-05 11:05:36','2022-09-05 11:06:44'),(8,NULL,NULL,'Test 1','M2N/SJ/2022/001',NULL,'Test 1','Cotton Combed 20s','Hitam',50,NULL,NULL,'Vendor A','2022-12-16',NULL,'bahan keluar','2022-12-18 18:59:16','2022-12-18 19:03:52'),(9,NULL,NULL,'Test 2','PUSH/SJ/XII/2022/001',NULL,'Test 2','Cotton Combed 28s','Merah',70,NULL,NULL,'Vendor A','2022-12-16',NULL,'bahan keluar','2022-12-18 19:01:02','2022-12-18 19:05:45'),(10,9,'TR-2022-12-18-0001','Test 1','M2N/BK/XII/2022/001','001/1/1','Test 1','Cotton Combed 20s','Hitam',50,25,25,'Vendor A','2022-12-16','2022-12-18','bahan keluar','2022-12-18 19:03:52','2022-12-18 19:03:52'),(11,10,'TR-2022-12-18-0002','Test 2','PUSH/BHK/XII/2022/001','001/1/2','Test 2','Cotton Combed 28s','Merah',70,50,20,'Vendor A','2022-12-16','2022-12-18','bahan keluar','2022-12-18 19:05:45','2022-12-18 19:05:45'),(12,NULL,NULL,'Test 3','M2N/SJ/2022/002',NULL,'Test 3','Cotton Combed 30s','Merah',100,NULL,NULL,'Vendor B','2022-12-22',NULL,'bahan keluar','2022-12-22 16:16:22','2022-12-22 16:19:30'),(13,NULL,NULL,'Test 4','PUSH/SJ/XII/2022/002',NULL,'Test 4','Cotton Combed 30s','Putih',100,NULL,NULL,'Vendor B','2022-12-22',NULL,'bahan keluar','2022-12-22 16:17:09','2022-12-22 16:19:56'),(14,11,'TR-2022-12-22-0001','Test 3','M2N/BK/XII/2022/002','001/2/1','Test 3','Cotton Combed 30s','Merah',100,90,10,'Vendor B','2022-12-22','2022-12-22','bahan keluar','2022-12-22 16:19:30','2022-12-22 16:19:30'),(15,12,'TR-2022-12-22-0002','Test 4','PUSH/BHK/XII/2022/002','001/2/2','Test 4','Cotton Combed 30s','Putih',100,90,10,'Vendor B','2022-12-22','2022-12-22','bahan keluar','2022-12-22 16:19:56','2022-12-22 16:19:56');
/*!40000 ALTER TABLE `bahans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` VALUES (1,'BCA','5156562627','M2N','166235818520117.png','2022-09-05 13:09:45','2022-09-05 13:09:45');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuci_dibuangs`
--

DROP TABLE IF EXISTS `cuci_dibuangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuci_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuci_dibuangs_cuci_id_index` (`cuci_id`),
  CONSTRAINT `cuci_dibuangs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuci_dibuangs`
--

LOCK TABLES `cuci_dibuangs` WRITE;
/*!40000 ALTER TABLE `cuci_dibuangs` DISABLE KEYS */;
INSERT INTO `cuci_dibuangs` VALUES (1,9,'S',1,'2022-12-22 16:34:08','2022-12-22 16:34:08');
/*!40000 ALTER TABLE `cuci_dibuangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuci_direpairs`
--

DROP TABLE IF EXISTS `cuci_direpairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuci_direpairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuci_direpairs_cuci_id_index` (`cuci_id`),
  CONSTRAINT `cuci_direpairs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuci_direpairs`
--

LOCK TABLES `cuci_direpairs` WRITE;
/*!40000 ALTER TABLE `cuci_direpairs` DISABLE KEYS */;
INSERT INTO `cuci_direpairs` VALUES (1,6,'S',1,'2022-12-18 19:19:23','2022-12-18 19:19:23'),(2,7,'L',1,'2022-12-18 19:20:36','2022-12-18 19:20:36'),(3,8,'S',1,'2022-12-22 16:34:46','2022-12-22 16:34:46');
/*!40000 ALTER TABLE `cuci_direpairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cucis`
--

DROP TABLE IF EXISTS `cucis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cucis` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cucis_jahit_id_index` (`jahit_id`),
  CONSTRAINT `cucis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cucis`
--

LOCK TABLES `cucis` WRITE;
/*!40000 ALTER TABLE `cucis` DISABLE KEYS */;
INSERT INTO `cucis` VALUES (6,7,'PUSH/BHK/XII/2022/001',NULL,'1970-01-01','1970-01-01','2022-12-18',45,'eksternal','Vendor B','Belum Lunas',50000.00,44,'3 Lusin 8 pcs',1,1,0,NULL,NULL,'Dicuci ulang',NULL,0,2250000,2250000,'cucian keluar','selesai','2022-12-18 19:14:17','2022-12-23 09:11:52'),(7,6,'M2N/BK/XII/2022/001',NULL,'1970-01-01','1970-01-01','2022-12-18',24,'eksternal','Vendor A','Termin 1',50000.00,23,'1 Lusin 11 pcs',1,1,0,NULL,NULL,'- Pudar. Solusi:  Dicuci ulang',NULL,200000,-200000,1200000,'cucian keluar','selesai','2022-12-18 19:14:24','2022-12-23 09:11:52'),(8,9,'PUSH/BHK/XII/2022/002',NULL,'1970-01-01','1970-01-01','2022-12-22',76,'eksternal','Vendor B','Belum Lunas',20000.00,75,NULL,1,1,0,NULL,NULL,'Cuci Ulang',NULL,0,1520000,1520000,'cucian keluar','selesai','2022-12-22 16:31:59','2022-12-23 09:11:52'),(9,8,'M2N/BK/XII/2022/002',NULL,'1970-01-01','1970-01-01','2022-12-22',77,'eksternal','Vendor A','Belum Lunas',20000.00,76,NULL,1,0,1,NULL,NULL,NULL,'Cucian luntur',0,1540000,1540000,'cucian keluar','selesai','2022-12-22 16:32:09','2022-12-23 09:11:52');
/*!40000 ALTER TABLE `cucis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_cucis`
--

DROP TABLE IF EXISTS `detail_cucis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_cucis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_cucis_cuci_id_index` (`cuci_id`),
  CONSTRAINT `detail_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_cucis`
--

LOCK TABLES `detail_cucis` WRITE;
/*!40000 ALTER TABLE `detail_cucis` DISABLE KEYS */;
INSERT INTO `detail_cucis` VALUES (16,6,'S',7,'2022-12-18 19:14:17','2022-12-18 19:19:23'),(17,6,'M',8,'2022-12-18 19:14:17','2022-12-18 19:14:17'),(18,6,'L',9,'2022-12-18 19:14:17','2022-12-18 19:14:17'),(19,6,'XL',10,'2022-12-18 19:14:17','2022-12-18 19:14:17'),(20,6,'XXL',10,'2022-12-18 19:14:17','2022-12-18 19:14:17'),(21,7,'S',4,'2022-12-18 19:14:24','2022-12-18 19:14:24'),(22,7,'M',5,'2022-12-18 19:14:24','2022-12-18 19:14:24'),(23,7,'L',4,'2022-12-18 19:14:24','2022-12-18 19:20:36'),(24,7,'XL',5,'2022-12-18 19:14:24','2022-12-18 19:14:24'),(25,7,'XXL',5,'2022-12-18 19:14:24','2022-12-18 19:14:24'),(26,8,'S',4,'2022-12-22 16:31:59','2022-12-22 16:34:46'),(27,8,'M',5,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(28,8,'L',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(29,8,'3',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(30,8,'4',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(31,8,'5',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(32,8,'6',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(33,8,'7',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(34,8,'8',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(35,8,'9',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(36,8,'10',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(37,8,'11',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(38,8,'12',6,'2022-12-22 16:31:59','2022-12-22 16:31:59'),(39,9,'S',4,'2022-12-22 16:32:09','2022-12-22 16:34:08'),(40,9,'M',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(41,9,'L',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(42,9,'3',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(43,9,'4',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(44,9,'5',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(45,9,'6',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(46,9,'7',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(47,9,'8',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(48,9,'9',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(49,9,'10',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(50,9,'11',6,'2022-12-22 16:32:09','2022-12-22 16:32:09'),(51,9,'12',6,'2022-12-22 16:32:09','2022-12-22 16:32:09');
/*!40000 ALTER TABLE `detail_cucis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_finishings`
--

DROP TABLE IF EXISTS `detail_finishings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_finishings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_finishings_finishing_id_index` (`finishing_id`),
  CONSTRAINT `detail_finishings_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_finishings`
--

LOCK TABLES `detail_finishings` WRITE;
/*!40000 ALTER TABLE `detail_finishings` DISABLE KEYS */;
INSERT INTO `detail_finishings` VALUES (41,7,'S',4,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(42,7,'M',5,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(43,7,'L',4,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(44,7,'XL',5,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(45,7,'XXL',5,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(46,6,'S',7,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(47,6,'M',8,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(48,6,'L',9,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(49,6,'XL',10,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(50,6,'XXL',10,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(77,9,'S',4,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(78,9,'M',4,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(79,9,'L',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(80,9,'3',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(81,9,'4',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(82,9,'5',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(83,9,'6',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(84,9,'7',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(85,9,'8',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(86,9,'9',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(87,9,'10',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(88,9,'11',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(89,9,'12',6,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(90,8,'S',4,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(91,8,'M',4,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(92,8,'L',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(93,8,'3',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(94,8,'4',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(95,8,'5',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(96,8,'6',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(97,8,'7',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(98,8,'8',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(99,8,'9',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(100,8,'10',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(101,8,'11',6,'2022-12-22 18:01:05','2022-12-22 18:01:05'),(102,8,'12',6,'2022-12-22 18:01:05','2022-12-22 18:01:05');
/*!40000 ALTER TABLE `detail_finishings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_jahits`
--

DROP TABLE IF EXISTS `detail_jahits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_jahits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_jahits_jahit_id_index` (`jahit_id`),
  CONSTRAINT `detail_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_jahits`
--

LOCK TABLES `detail_jahits` WRITE;
/*!40000 ALTER TABLE `detail_jahits` DISABLE KEYS */;
INSERT INTO `detail_jahits` VALUES (16,6,'S',4,'2022-12-18 19:09:20','2022-12-18 19:12:34'),(17,6,'M',5,'2022-12-18 19:09:20','2022-12-18 19:09:20'),(18,6,'L',5,'2022-12-18 19:09:20','2022-12-18 19:09:20'),(19,6,'XL',5,'2022-12-18 19:09:20','2022-12-18 19:09:20'),(20,6,'XXL',5,'2022-12-18 19:09:20','2022-12-18 19:09:20'),(21,7,'S',8,'2022-12-18 19:09:36','2022-12-18 19:13:34'),(22,7,'M',8,'2022-12-18 19:09:36','2022-12-18 19:13:34'),(23,7,'L',9,'2022-12-18 19:09:36','2022-12-18 19:13:34'),(24,7,'XL',10,'2022-12-18 19:09:36','2022-12-18 19:09:36'),(25,7,'XXL',10,'2022-12-18 19:09:36','2022-12-18 19:09:36'),(26,8,'S',5,'2022-12-22 16:27:38','2022-12-22 16:30:24'),(27,8,'M',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(28,8,'L',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(29,8,'3',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(30,8,'4',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(31,8,'5',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(32,8,'6',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(33,8,'7',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(34,8,'8',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(35,8,'9',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(36,8,'10',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(37,8,'11',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(38,8,'12',6,'2022-12-22 16:27:38','2022-12-22 16:27:38'),(39,9,'S',5,'2022-12-22 16:27:44','2022-12-22 16:31:36'),(40,9,'M',5,'2022-12-22 16:27:44','2022-12-22 16:31:36'),(41,9,'L',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(42,9,'3',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(43,9,'4',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(44,9,'5',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(45,9,'6',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(46,9,'7',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(47,9,'8',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(48,9,'9',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(49,9,'10',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(50,9,'11',6,'2022-12-22 16:27:44','2022-12-22 16:27:44'),(51,9,'12',6,'2022-12-22 16:27:44','2022-12-22 16:27:44');
/*!40000 ALTER TABLE `detail_jahits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_perbaikans`
--

DROP TABLE IF EXISTS `detail_perbaikans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_perbaikans` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_perbaikans`
--

LOCK TABLES `detail_perbaikans` WRITE;
/*!40000 ALTER TABLE `detail_perbaikans` DISABLE KEYS */;
INSERT INTO `detail_perbaikans` VALUES (1,1,NULL,1,1,'Dicuci ulang','2022-12-22 16:39:56','2022-12-22 16:39:56'),(2,1,2,NULL,2,'Dicuci ulang','2022-12-22 16:39:56','2022-12-22 16:40:04'),(3,2,3,NULL,2,'Dicuci ulang','2022-12-22 16:39:56','2022-12-22 16:40:04'),(4,3,NULL,2,1,'- Pudar. Solusi:  Dicuci ulang','2022-12-22 16:39:56','2022-12-22 16:39:56'),(5,4,1,NULL,1,'- Pudar. Solusi:  Dicuci ulang','2022-12-22 16:39:56','2022-12-22 16:40:04'),(6,5,NULL,3,1,'Cuci Ulang','2022-12-22 16:39:56','2022-12-22 16:39:56'),(7,5,5,NULL,1,'Cuci Ulang','2022-12-22 16:39:56','2022-12-22 16:40:04'),(8,6,6,NULL,1,'Cuci Ulang','2022-12-22 16:39:56','2022-12-22 16:40:04'),(9,7,4,NULL,1,NULL,'2022-12-22 16:39:56','2022-12-22 16:40:04');
/*!40000 ALTER TABLE `detail_perbaikans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_potongs`
--

DROP TABLE IF EXISTS `detail_potongs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_potongs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `potong_id` bigint unsigned DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_potongs_potong_id_index` (`potong_id`),
  CONSTRAINT `detail_potongs_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_potongs`
--

LOCK TABLES `detail_potongs` WRITE;
/*!40000 ALTER TABLE `detail_potongs` DISABLE KEYS */;
INSERT INTO `detail_potongs` VALUES (16,6,'S',5,'2022-12-18 19:08:05','2022-12-18 19:08:05'),(17,6,'M',5,'2022-12-18 19:08:05','2022-12-18 19:08:05'),(18,6,'L',5,'2022-12-18 19:08:05','2022-12-18 19:08:05'),(19,6,'XL',5,'2022-12-18 19:08:05','2022-12-18 19:08:05'),(20,6,'XXL',5,'2022-12-18 19:08:05','2022-12-18 19:08:05'),(21,7,'S',10,'2022-12-18 19:09:00','2022-12-18 19:09:00'),(22,7,'M',10,'2022-12-18 19:09:00','2022-12-18 19:09:00'),(23,7,'L',10,'2022-12-18 19:09:00','2022-12-18 19:09:00'),(24,7,'XL',10,'2022-12-18 19:09:00','2022-12-18 19:09:00'),(25,7,'XXL',10,'2022-12-18 19:09:00','2022-12-18 19:09:00'),(26,8,'S',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(27,8,'M',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(28,8,'L',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(29,8,'3',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(30,8,'4',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(31,8,'5',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(32,8,'6',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(33,8,'7',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(34,8,'8',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(35,8,'9',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(36,8,'10',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(37,8,'11',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(38,8,'12',6,'2022-12-22 16:25:33','2022-12-22 16:25:33'),(39,9,'S',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(40,9,'M',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(41,9,'L',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(42,9,'3',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(43,9,'4',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(44,9,'5',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(45,9,'6',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(46,9,'7',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(47,9,'8',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(48,9,'9',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(49,9,'10',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(50,9,'11',6,'2022-12-22 16:27:03','2022-12-22 16:27:03'),(51,9,'12',6,'2022-12-22 16:27:03','2022-12-22 16:27:03');
/*!40000 ALTER TABLE `detail_potongs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_produk_images`
--

DROP TABLE IF EXISTS `detail_produk_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_produk_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` bigint unsigned DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_produk_images_produk_id_index` (`produk_id`),
  CONSTRAINT `detail_produk_images_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_produk_images`
--

LOCK TABLES `detail_produk_images` WRITE;
/*!40000 ALTER TABLE `detail_produk_images` DISABLE KEYS */;
INSERT INTO `detail_produk_images` VALUES (6,6,'167136926479202.jpg','2022-12-18 20:14:24','2022-12-18 20:14:24'),(7,7,'167137276958772.jpg','2022-12-18 21:12:49','2022-12-18 21:12:49');
/*!40000 ALTER TABLE `detail_produk_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_produks`
--

DROP TABLE IF EXISTS `detail_produks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_produks` (
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_produks`
--

LOCK TABLES `detail_produks` WRITE;
/*!40000 ALTER TABLE `detail_produks` DISABLE KEYS */;
INSERT INTO `detail_produks` VALUES (16,6,'S',-11,50000,'2022-12-18 20:14:24','2022-12-18 20:16:33'),(17,6,'M',-10,50000,'2022-12-18 20:14:24','2022-12-18 20:16:33'),(18,6,'L',-11,50000,'2022-12-18 20:14:24','2022-12-18 20:16:33'),(19,6,'XL',5,55000,'2022-12-18 20:14:24','2022-12-18 20:14:24'),(20,6,'XXL',5,57000,'2022-12-18 20:14:24','2022-12-18 20:14:24'),(21,7,'S',7,50000,'2022-12-18 21:12:49','2022-12-18 21:12:49'),(22,7,'M',8,50000,'2022-12-18 21:12:49','2022-12-18 21:12:49'),(23,7,'L',9,50000,'2022-12-18 21:12:49','2022-12-18 21:12:49'),(24,7,'XL',10,55000,'2022-12-18 21:12:49','2022-12-18 21:12:49'),(25,7,'XXL',10,57000,'2022-12-18 21:12:49','2022-12-18 21:12:49');
/*!40000 ALTER TABLE `detail_produks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_rekapitulasi_warehouses`
--

DROP TABLE IF EXISTS `detail_rekapitulasi_warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_rekapitulasi_warehouses` (
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_rekapitulasi_warehouses`
--

LOCK TABLES `detail_rekapitulasi_warehouses` WRITE;
/*!40000 ALTER TABLE `detail_rekapitulasi_warehouses` DISABLE KEYS */;
INSERT INTO `detail_rekapitulasi_warehouses` VALUES (28,3,'M','diretur',1,'2022-12-23 09:13:02','2022-12-23 09:13:02'),(29,4,'M','diretur',1,'2022-12-23 09:13:02','2022-12-23 09:13:02'),(30,4,'M','dibuang',1,'2022-12-23 09:13:02','2022-12-23 09:13:02');
/*!40000 ALTER TABLE `detail_rekapitulasi_warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_rekapitulasis`
--

DROP TABLE IF EXISTS `detail_rekapitulasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_rekapitulasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rekapitulasi_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_rekapitulasis_rekapitulasi_id_index` (`rekapitulasi_id`),
  CONSTRAINT `detail_rekapitulasis_rekapitulasi_id_foreign` FOREIGN KEY (`rekapitulasi_id`) REFERENCES `rekapitulasis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_rekapitulasis`
--

LOCK TABLES `detail_rekapitulasis` WRITE;
/*!40000 ALTER TABLE `detail_rekapitulasis` DISABLE KEYS */;
INSERT INTO `detail_rekapitulasis` VALUES (123,11,'direpair','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(124,12,'direpair','L',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(125,15,'direpair','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(126,16,'dibuang','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(127,13,'direpair','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(128,14,'dibuang','L',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(129,14,'direpair','S',2,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(130,14,'direpair','M',2,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(131,17,'direpair','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(132,18,'direpair','S',1,'2022-12-23 09:11:53','2022-12-23 09:11:53'),(133,18,'direpair','M',1,'2022-12-23 09:11:53','2022-12-23 09:11:53');
/*!40000 ALTER TABLE `detail_rekapitulasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_returs`
--

DROP TABLE IF EXISTS `detail_returs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `retur_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_returs_retur_id_index` (`retur_id`),
  CONSTRAINT `detail_returs_retur_id_foreign` FOREIGN KEY (`retur_id`) REFERENCES `returs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_returs`
--

LOCK TABLES `detail_returs` WRITE;
/*!40000 ALTER TABLE `detail_returs` DISABLE KEYS */;
INSERT INTO `detail_returs` VALUES (1,8,'M',1,'2022-12-22 18:07:33','2022-12-22 18:07:33'),(2,9,'M',1,'2022-12-22 18:07:33','2022-12-22 18:07:33');
/*!40000 ALTER TABLE `detail_returs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_sampahs`
--

DROP TABLE IF EXISTS `detail_sampahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_sampahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sampah_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_sampahs_sampah_id_index` (`sampah_id`),
  CONSTRAINT `detail_sampahs_sampah_id_foreign` FOREIGN KEY (`sampah_id`) REFERENCES `sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sampahs`
--

LOCK TABLES `detail_sampahs` WRITE;
/*!40000 ALTER TABLE `detail_sampahs` DISABLE KEYS */;
INSERT INTO `detail_sampahs` VALUES (42,16,'S',1,'2022-12-23 09:28:10','2022-12-23 09:28:10'),(43,14,'L',1,'2022-12-23 09:28:10','2022-12-23 09:28:10');
/*!40000 ALTER TABLE `detail_sampahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_sub_kategoris`
--

DROP TABLE IF EXISTS `detail_sub_kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_sub_kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sub_kategori_id` bigint unsigned DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_sub_kategoris_sub_kategori_id_index` (`sub_kategori_id`),
  CONSTRAINT `detail_sub_kategoris_sub_kategori_id_foreign` FOREIGN KEY (`sub_kategori_id`) REFERENCES `sub_kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sub_kategoris`
--

LOCK TABLES `detail_sub_kategoris` WRITE;
/*!40000 ALTER TABLE `detail_sub_kategoris` DISABLE KEYS */;
INSERT INTO `detail_sub_kategoris` VALUES (9,8,'M2N Kids','001/1/1','2022-12-18 18:54:02','2022-12-18 18:54:02'),(10,8,'Push and Pull','001/1/2','2022-12-18 18:54:02','2022-12-18 18:54:02'),(11,9,'M2N Kids','001/2/1','2022-12-22 16:18:57','2022-12-22 16:18:57'),(12,9,'Push and Pull','001/2/2','2022-12-22 16:18:57','2022-12-22 16:18:57');
/*!40000 ALTER TABLE `detail_sub_kategoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_transaksis`
--

DROP TABLE IF EXISTS `detail_transaksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_transaksis` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_transaksis`
--

LOCK TABLES `detail_transaksis` WRITE;
/*!40000 ALTER TABLE `detail_transaksis` DISABLE KEYS */;
INSERT INTO `detail_transaksis` VALUES (2,2,6,NULL,15,'S,M,L',50000,750000,'2022-12-18 20:16:33','2022-12-18 20:16:33');
/*!40000 ALTER TABLE `detail_transaksis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_warehouses`
--

DROP TABLE IF EXISTS `detail_warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_warehouses_warehouse_id_index` (`warehouse_id`),
  CONSTRAINT `detail_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_warehouses`
--

LOCK TABLES `detail_warehouses` WRITE;
/*!40000 ALTER TABLE `detail_warehouses` DISABLE KEYS */;
INSERT INTO `detail_warehouses` VALUES (16,6,'S',4,50000,'2022-12-18 19:34:38','2022-12-18 19:38:44'),(17,6,'M',5,50000,'2022-12-18 19:34:38','2022-12-18 19:38:44'),(18,6,'L',4,50000,'2022-12-18 19:34:38','2022-12-18 19:38:44'),(19,6,'XL',5,55000,'2022-12-18 19:34:38','2022-12-18 19:38:44'),(20,6,'XXL',5,57000,'2022-12-18 19:34:38','2022-12-18 19:38:44'),(21,7,'S',7,50000,'2022-12-18 19:37:14','2022-12-18 19:38:11'),(22,7,'M',8,50000,'2022-12-18 19:37:14','2022-12-18 19:38:11'),(23,7,'L',9,50000,'2022-12-18 19:37:14','2022-12-18 19:38:11'),(24,7,'XL',10,55000,'2022-12-18 19:37:14','2022-12-18 19:38:11'),(25,7,'XXL',10,57000,'2022-12-18 19:37:14','2022-12-18 19:38:11'),(26,8,'S',4,70000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(27,8,'M',4,70000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(28,8,'L',6,70000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(29,8,'3',6,75000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(30,8,'4',6,75000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(31,8,'5',6,75000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(32,8,'6',6,80000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(33,8,'7',6,80000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(34,8,'8',6,80000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(35,8,'9',6,85000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(36,8,'10',6,85000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(37,8,'11',6,85000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(38,8,'12',6,85000,'2022-12-22 17:59:15','2022-12-22 18:06:42'),(39,9,'S',4,70000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(40,9,'M',4,70000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(41,9,'L',6,70000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(42,9,'3',6,75000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(43,9,'4',6,75000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(44,9,'5',6,75000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(45,9,'6',6,80000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(46,9,'7',6,80000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(47,9,'8',6,80000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(48,9,'9',6,85000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(49,9,'10',6,85000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(50,9,'11',6,85000,'2022-12-22 18:01:05','2022-12-22 18:03:09'),(51,9,'12',6,85000,'2022-12-22 18:01:05','2022-12-22 18:03:09');
/*!40000 ALTER TABLE `detail_warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorits`
--

DROP TABLE IF EXISTS `favorits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorits` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorits`
--

LOCK TABLES `favorits` WRITE;
/*!40000 ALTER TABLE `favorits` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishing_dibuangs`
--

DROP TABLE IF EXISTS `finishing_dibuangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finishing_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishing_dibuangs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `finishing_dibuangs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishing_dibuangs`
--

LOCK TABLES `finishing_dibuangs` WRITE;
/*!40000 ALTER TABLE `finishing_dibuangs` DISABLE KEYS */;
INSERT INTO `finishing_dibuangs` VALUES (1,8,'M',1,'2022-12-22 18:01:05','2022-12-22 18:01:05');
/*!40000 ALTER TABLE `finishing_dibuangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishing_returs`
--

DROP TABLE IF EXISTS `finishing_returs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finishing_returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishing_returs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `finishing_returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishing_returs`
--

LOCK TABLES `finishing_returs` WRITE;
/*!40000 ALTER TABLE `finishing_returs` DISABLE KEYS */;
INSERT INTO `finishing_returs` VALUES (1,9,'M',1,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(2,8,'M',1,'2022-12-22 18:01:05','2022-12-22 18:01:05');
/*!40000 ALTER TABLE `finishing_returs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishings`
--

DROP TABLE IF EXISTS `finishings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finishings` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finishings_cuci_id_index` (`cuci_id`),
  CONSTRAINT `finishings_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishings`
--

LOCK TABLES `finishings` WRITE;
/*!40000 ALTER TABLE `finishings` DISABLE KEYS */;
INSERT INTO `finishings` VALUES (6,6,'PUSH/FNG/XII/2022/001','2022-12-18','2023-01-01','2023-01-03',44,0,0,0,NULL,NULL,'kirim warehouse',NULL,'2022-12-18 19:20:58','2022-12-18 19:37:14'),(7,7,'M2N/FNG/XII/2022/001','2022-12-18','2023-01-01','2022-12-03',23,0,0,0,NULL,'0','kirim warehouse',NULL,'2022-12-18 19:21:42','2022-12-18 19:34:38'),(8,9,'M2N/BK/XII/2022/002','2022-12-22','2023-01-01','2023-01-03',74,2,1,1,'Jahitan tidak rapi','Robek di Saku','kirim warehouse',NULL,'2022-12-22 16:34:52','2022-12-22 18:01:05'),(9,8,'PUSH/BHK/XII/2022/002','2022-12-22','2023-01-01','2023-01-03',74,1,1,0,'Jahitan tidak rapi',NULL,'kirim warehouse',NULL,'2022-12-22 16:34:57','2022-12-22 17:59:15');
/*!40000 ALTER TABLE `finishings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jahit_dibuangs`
--

DROP TABLE IF EXISTS `jahit_dibuangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jahit_dibuangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jahit_dibuangs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `jahit_dibuangs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahit_dibuangs`
--

LOCK TABLES `jahit_dibuangs` WRITE;
/*!40000 ALTER TABLE `jahit_dibuangs` DISABLE KEYS */;
INSERT INTO `jahit_dibuangs` VALUES (1,7,'L',1,'2022-12-18 19:13:34','2022-12-18 19:13:34');
/*!40000 ALTER TABLE `jahit_dibuangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jahit_direpairs`
--

DROP TABLE IF EXISTS `jahit_direpairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jahit_direpairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jahit_direpairs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `jahit_direpairs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahit_direpairs`
--

LOCK TABLES `jahit_direpairs` WRITE;
/*!40000 ALTER TABLE `jahit_direpairs` DISABLE KEYS */;
INSERT INTO `jahit_direpairs` VALUES (1,6,'S',1,'2022-12-18 19:12:34','2022-12-18 19:12:34'),(2,7,'S',2,'2022-12-18 19:13:34','2022-12-18 19:13:34'),(3,7,'M',2,'2022-12-18 19:13:34','2022-12-18 19:13:34'),(4,8,'S',1,'2022-12-22 16:30:24','2022-12-22 16:30:24'),(5,9,'S',1,'2022-12-22 16:31:36','2022-12-22 16:31:36'),(6,9,'M',1,'2022-12-22 16:31:36','2022-12-22 16:31:36');
/*!40000 ALTER TABLE `jahit_direpairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jahits`
--

DROP TABLE IF EXISTS `jahits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jahits` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jahits_potong_id_index` (`potong_id`),
  CONSTRAINT `jahits_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahits`
--

LOCK TABLES `jahits` WRITE;
/*!40000 ALTER TABLE `jahits` DISABLE KEYS */;
INSERT INTO `jahits` VALUES (6,6,'M2N/BK/XII/2022/001','2022-12-26','2022-12-27','2022-12-18','eksternal','Pak H. Leman',50000.00,24,25,'2 Lusin 1 pcs',1,1,0,'Lepas Jahitan',NULL,'Termin 2',750000,500000,1250000,'jahitan keluar','selesai','2022-12-18 19:09:20','2022-12-23 09:27:09'),(7,7,'PUSH/BHK/XII/2022/001','2022-12-26','2022-12-27','2022-12-18','internal',NULL,NULL,45,50,'4 Lusin 2 pcs',5,4,1,'1. Lepas jahitan\r\n2. Jahitan keluar','Tidak bisa diperbaiki',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-12-18 19:09:36','2022-12-23 09:27:09'),(8,8,'M2N/BK/XII/2022/002','2022-12-25','2022-12-26','2022-12-22','eksternal','Casnuri',20000.00,77,78,'6 Lusin 6 pcs',1,1,0,'Jahitan rusak',NULL,'Termin 1',560000,-560000,1560000,'jahitan keluar','selesai','2022-12-22 16:27:38','2022-12-23 09:27:09'),(9,9,'PUSH/BHK/XII/2022/002','2022-12-25','2022-12-26','2022-12-22','internal',NULL,NULL,76,78,'6 Lusin 6 pcs',2,2,0,'Rusak di leher',NULL,NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-12-22 16:27:44','2022-12-23 09:27:09');
/*!40000 ALTER TABLE `jahits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategoris`
--

DROP TABLE IF EXISTS `kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoris`
--

LOCK TABLES `kategoris` WRITE;
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` VALUES (5,'Kemeja','001','167136432665391.jpg','2022-12-18 18:52:06','2022-12-18 18:52:06');
/*!40000 ALTER TABLE `kategoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keranjangs`
--

DROP TABLE IF EXISTS `keranjangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keranjangs` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keranjangs`
--

LOCK TABLES `keranjangs` WRITE;
/*!40000 ALTER TABLE `keranjangs` DISABLE KEYS */;
/*!40000 ALTER TABLE `keranjangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2021_07_25_124001_create_kategoris_table',1),(4,'2021_07_25_124200_create_sub_kategoris_table',1),(5,'2021_07_25_124215_create_detail_sub_kategoris_table',1),(6,'2021_07_28_133143_create_bahans_table',1),(7,'2021_07_28_134326_create_potongs_table',1),(8,'2021_07_28_134354_create_detail_potongs_table',1),(9,'2021_07_28_134417_create_jahits_table',1),(10,'2021_07_28_134437_create_detail_jahits_table',1),(11,'2021_07_28_135416_create_cucis_table',1),(12,'2021_07_28_135600_create_detail_cucis_table',1),(13,'2021_07_30_153748_create_permission_tables',1),(14,'2021_07_31_074824_create_jahit_direpairs_table',1),(15,'2021_07_31_074838_create_jahit_dibuangs_table',1),(16,'2021_08_05_071341_create_cuci_direpairs_table',1),(17,'2021_08_05_071458_create_cuci_dibuangs_table',1),(18,'2021_08_06_033837_create_sampahs_table',1),(19,'2021_08_06_035424_create_detail_sampahs_table',1),(20,'2021_08_06_042903_create_perbaikans_table',1),(21,'2021_08_06_043332_create_detail_perbaikans_table',1),(22,'2021_08_06_080817_create_rekapitulasis_table',1),(23,'2021_08_10_073534_create_finishings_table',1),(24,'2021_08_10_123346_create_detail_finishings_table',1),(25,'2021_08_10_132605_create_finishing_returs_table',1),(26,'2021_08_10_132718_create_finishing_dibuangs_table',1),(27,'2021_08_10_135948_create_detail_rekapitulasis_table',1),(28,'2021_08_11_042832_create_warehouses_table',1),(29,'2021_08_11_042927_create_detail_warehouses_table',1),(30,'2021_08_14_054929_create_returs_table',1),(31,'2021_08_14_055110_create_detail_returs_table',1),(32,'2021_08_14_060055_create_rekapitulasi_warehouses_table',1),(33,'2021_08_14_060114_create_detail_rekapitulasi_warehouses_table',1),(34,'2021_08_22_131026_create_notifications_table',1),(35,'2021_10_04_210554_create_pembayaran_jahits_table',1),(36,'2021_10_04_210918_create_pembayaran_cucis_table',1),(37,'2021_10_17_194112_create_promos_table',1),(38,'2021_10_18_214949_create_produks_table',1),(39,'2021_10_18_215239_create_detail_produks_table',1),(40,'2021_10_18_215447_create_detail_produk_images_table',1),(41,'2021_10_20_125923_create_banners_table',1),(42,'2021_10_27_220932_create_alamats_table',1),(43,'2021_11_24_214632_create_banks_table',1),(44,'2021_11_25_194546_create_keranjangs_table',1),(45,'2021_12_02_225512_create_favorits_table',1),(46,'2021_12_22_213132_create_transaksis_table',1),(47,'2021_12_22_213608_create_detail_transaksis_table',1),(48,'2021_12_23_195752_create_notification_ecommerces_table',1),(49,'2021_12_23_224052_create_ulasans_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(4,'App\\User',3),(3,'App\\User',4),(5,'App\\User',5),(5,'App\\User',6),(5,'App\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_ecommerces`
--

DROP TABLE IF EXISTS `notification_ecommerces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_ecommerces` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_ecommerces`
--

LOCK TABLES `notification_ecommerces` WRITE;
/*!40000 ALTER TABLE `notification_ecommerces` DISABLE KEYS */;
INSERT INTO `notification_ecommerces` VALUES (1,5,1,'Pesanan dengan nomor transaksi INV050920221 dalam proses pengiriman!','2022-09-07 13:59:10','2022-09-07 13:59:10');
/*!40000 ALTER TABLE `notification_ecommerces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` int NOT NULL DEFAULT '0',
  `read` int NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 10:58:58','2023-01-12 21:23:27'),(2,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:00:08','2023-01-12 21:23:27'),(3,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:00:48','2023-01-12 21:23:27'),(4,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:01:26','2023-01-12 21:23:27'),(5,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:01:26','2022-09-05 11:01:26'),(6,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:06:12','2023-01-12 21:23:27'),(7,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:06:44','2023-01-12 21:23:27'),(8,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:07:54','2023-01-12 21:23:27'),(9,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:08:43','2023-01-12 21:23:27'),(10,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:14:55','2023-01-12 21:23:27'),(11,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:02','2023-01-12 21:23:27'),(12,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:09','2023-01-12 21:23:27'),(13,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:14','2023-01-12 21:23:27'),(14,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:39','2023-01-12 21:23:27'),(15,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:46','2023-01-12 21:23:27'),(16,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:52','2023-01-12 21:23:27'),(17,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:57','2023-01-12 21:23:27'),(18,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:00','2023-01-12 21:23:27'),(19,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:00','2022-09-05 11:24:00'),(20,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:06','2023-01-12 21:23:27'),(21,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:06','2022-09-05 11:24:06'),(22,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:10','2023-01-12 21:23:27'),(23,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:10','2022-09-05 11:24:10'),(24,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:14','2023-01-12 21:23:27'),(25,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:14','2022-09-05 11:24:14'),(26,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:25:48','2023-01-12 21:23:27'),(27,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:25:48','2022-09-05 11:25:48'),(28,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:26:28','2023-01-12 21:23:27'),(29,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:26:28','2022-09-05 11:26:28'),(30,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:26:47','2023-01-12 21:23:27'),(31,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:26:47','2022-09-05 11:26:47'),(32,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:27:03','2023-01-12 21:23:27'),(33,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:03','2022-09-05 11:27:03'),(34,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:27:18','2023-01-12 21:23:27'),(35,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:18','2022-09-05 11:27:18'),(36,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:30','2022-09-05 11:27:30'),(37,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:37','2022-09-05 11:27:37'),(38,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:42','2022-09-05 11:27:42'),(39,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:49','2022-09-05 11:27:49'),(40,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:58','2022-09-05 11:27:58'),(41,'Ada transaksi baru INV050920221','http://m2nstore.com/admin/transaksi',0,0,'online','2022-09-05 13:12:08','2022-09-05 13:12:08'),(42,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-12-18 19:03:52','2023-01-12 21:23:27'),(43,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-12-18 19:05:45','2023-01-12 21:23:27'),(44,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-12-18 19:09:20','2023-01-12 21:23:27'),(45,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-12-18 19:09:36','2023-01-12 21:23:27'),(46,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-18 19:14:17','2023-01-12 21:23:27'),(47,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-18 19:14:24','2023-01-12 21:23:27'),(48,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-18 19:20:58','2023-01-12 21:23:27'),(49,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-12-18 19:20:58','2022-12-18 19:20:58'),(50,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-18 19:21:42','2023-01-12 21:23:27'),(51,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-12-18 19:21:42','2022-12-18 19:21:42'),(52,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-12-18 19:34:38','2023-01-12 21:23:27'),(53,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-18 19:34:38','2022-12-18 19:34:38'),(54,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-12-18 19:37:14','2023-01-12 21:23:27'),(55,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-18 19:37:14','2022-12-18 19:37:14'),(56,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-18 19:38:11','2022-12-18 19:38:11'),(57,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-18 19:38:44','2022-12-18 19:38:44'),(58,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-12-22 16:19:30','2023-01-12 21:23:27'),(59,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-12-22 16:19:56','2023-01-12 21:23:27'),(60,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-12-22 16:27:38','2023-01-12 21:23:27'),(61,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-12-22 16:27:44','2023-01-12 21:23:27'),(62,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-22 16:31:59','2023-01-12 21:23:27'),(63,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-22 16:32:09','2023-01-12 21:23:27'),(64,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-22 16:34:52','2023-01-12 21:23:27'),(65,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-12-22 16:34:52','2022-12-22 16:34:52'),(66,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-12-22 16:34:57','2023-01-12 21:23:27'),(67,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-12-22 16:34:57','2022-12-22 16:34:57'),(68,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-12-22 17:59:15','2023-01-12 21:23:27'),(69,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-22 17:59:15','2022-12-22 17:59:15'),(70,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-12-22 18:01:05','2023-01-12 21:23:27'),(71,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-22 18:01:05','2022-12-22 18:01:05'),(72,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-22 18:02:03','2022-12-22 18:02:03'),(73,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-22 18:03:09','2022-12-22 18:03:09'),(74,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-12-22 18:06:42','2022-12-22 18:06:42');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_cucis`
--

DROP TABLE IF EXISTS `pembayaran_cucis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran_cucis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_cucis_cuci_id_index` (`cuci_id`),
  CONSTRAINT `pembayaran_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_cucis`
--

LOCK TABLES `pembayaran_cucis` WRITE;
/*!40000 ALTER TABLE `pembayaran_cucis` DISABLE KEYS */;
INSERT INTO `pembayaran_cucis` VALUES (1,7,'Termin 1',200000,'2022-12-22 16:37:56','2022-12-22 16:37:56');
/*!40000 ALTER TABLE `pembayaran_cucis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_jahits`
--

DROP TABLE IF EXISTS `pembayaran_jahits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran_jahits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_jahits_jahit_id_index` (`jahit_id`),
  CONSTRAINT `pembayaran_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_jahits`
--

LOCK TABLES `pembayaran_jahits` WRITE;
/*!40000 ALTER TABLE `pembayaran_jahits` DISABLE KEYS */;
INSERT INTO `pembayaran_jahits` VALUES (1,6,'Termin 1',250000,'2022-12-22 16:36:24','2022-12-22 16:36:24'),(2,6,'Termin 2',500000,'2022-12-22 16:37:28','2022-12-22 16:37:28'),(3,8,'Termin 1',560000,'2022-12-22 16:39:01','2022-12-22 16:39:01');
/*!40000 ALTER TABLE `pembayaran_jahits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perbaikans`
--

DROP TABLE IF EXISTS `perbaikans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perbaikans` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perbaikans`
--

LOCK TABLES `perbaikans` WRITE;
/*!40000 ALTER TABLE `perbaikans` DISABLE KEYS */;
INSERT INTO `perbaikans` VALUES (1,11,'2022-12-22',NULL,'2022-12-30',3,'S','proses repair','2022-12-22 16:39:56','2022-12-22 16:40:15'),(2,11,'2022-12-22',NULL,NULL,2,'M','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:39:56'),(3,10,'2022-12-22',NULL,NULL,1,'L','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:39:56'),(4,10,'2022-12-22',NULL,NULL,1,'S','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:39:56'),(5,15,'2022-12-22',NULL,NULL,2,'S','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:40:04'),(6,15,'2022-12-22',NULL,NULL,1,'M','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:39:56'),(7,14,'2022-12-22',NULL,NULL,1,'S','butuh konfirmasi','2022-12-22 16:39:56','2022-12-22 16:39:56');
/*!40000 ALTER TABLE `perbaikans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `potongs`
--

DROP TABLE IF EXISTS `potongs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `potongs` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `potongs_bahan_id_index` (`bahan_id`),
  CONSTRAINT `potongs_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potongs`
--

LOCK TABLES `potongs` WRITE;
/*!40000 ALTER TABLE `potongs` DISABLE KEYS */;
INSERT INTO `potongs` VALUES (6,10,'M2N/BK/XII/2022/001','2022-12-18','2022-12-25',NULL,25.00,'2 Lusin 1 pcs','potong keluar','selesai','2022-12-18 19:03:52','2022-12-23 09:27:10'),(7,11,'PUSH/BHK/XII/2022/001','2022-12-18','2022-12-25',NULL,50.00,'4 Lusin 2 pcs','potong keluar','selesai','2022-12-18 19:05:45','2022-12-23 09:27:10'),(8,14,'M2N/BK/XII/2022/002','2022-12-22','2022-12-23',NULL,78.00,'6 Lusin 6 pcs','potong keluar','selesai','2022-12-22 16:19:30','2022-12-23 09:27:10'),(9,15,'PUSH/BHK/XII/2022/002','2022-12-22','2022-12-23',NULL,78.00,'6 Lusin 6 pcs','potong keluar','selesai','2022-12-22 16:19:56','2022-12-23 09:27:10');
/*!40000 ALTER TABLE `potongs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produks`
--

DROP TABLE IF EXISTS `produks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produks` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produks`
--

LOCK TABLES `produks` WRITE;
/*!40000 ALTER TABLE `produks` DISABLE KEYS */;
INSERT INTO `produks` VALUES (6,'PRD-1',NULL,6,NULL,'Test 1','Kemeja Lengan Pendek dengan Motif Salur',-22,0,0,NULL,'Kemeja','Kemeja Lengan Pendek','M2N Kids','2022-12-18 20:14:24','2022-12-18 20:16:33'),(7,'PRD-7',NULL,7,NULL,'Test 2','Kemeja Lengan Pendek dengan Motif Salur',44,0,0,NULL,'Kemeja','Kemeja Lengan Pendek','Push and Pull','2022-12-18 21:12:49','2022-12-18 21:12:49');
/*!40000 ALTER TABLE `produks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promos` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promos`
--

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;
/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekapitulasi_warehouses`
--

DROP TABLE IF EXISTS `rekapitulasi_warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rekapitulasi_warehouses` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekapitulasi_warehouses`
--

LOCK TABLES `rekapitulasi_warehouses` WRITE;
/*!40000 ALTER TABLE `rekapitulasi_warehouses` DISABLE KEYS */;
INSERT INTO `rekapitulasi_warehouses` VALUES (1,6,NULL,NULL,0,0,'2022-12-18 19:38:47','2022-12-18 19:38:47'),(2,7,NULL,NULL,0,0,'2022-12-18 19:38:47','2022-12-18 19:38:47'),(3,8,NULL,NULL,1,0,'2022-12-22 18:06:57','2022-12-22 18:06:57'),(4,9,NULL,NULL,1,1,'2022-12-22 18:06:57','2022-12-22 18:06:57');
/*!40000 ALTER TABLE `rekapitulasi_warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekapitulasis`
--

DROP TABLE IF EXISTS `rekapitulasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rekapitulasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `jumlah_diperbaiki` int DEFAULT NULL,
  `jumlah_dibuang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekapitulasis_cuci_id_index` (`cuci_id`),
  KEY `rekapitulasis_jahit_id_index` (`jahit_id`),
  CONSTRAINT `rekapitulasis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekapitulasis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekapitulasis`
--

LOCK TABLES `rekapitulasis` WRITE;
/*!40000 ALTER TABLE `rekapitulasis` DISABLE KEYS */;
INSERT INTO `rekapitulasis` VALUES (11,6,NULL,1,0,'2022-12-18 19:22:01','2022-12-18 19:22:01'),(12,7,NULL,1,0,'2022-12-18 19:22:01','2022-12-18 19:22:01'),(13,NULL,6,1,0,'2022-12-18 19:22:01','2022-12-18 19:22:01'),(14,NULL,7,4,1,'2022-12-18 19:22:01','2022-12-18 19:22:01'),(15,8,NULL,1,0,'2022-12-22 16:35:22','2022-12-22 16:35:22'),(16,9,NULL,0,1,'2022-12-22 16:35:22','2022-12-22 16:35:22'),(17,NULL,8,1,0,'2022-12-22 16:35:22','2022-12-22 16:35:22'),(18,NULL,9,2,0,'2022-12-22 16:35:22','2022-12-22 16:35:22');
/*!40000 ALTER TABLE `rekapitulasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returs`
--

DROP TABLE IF EXISTS `returs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `returs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `total_barang` int NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan_diretur` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `returs_finishing_id_index` (`finishing_id`),
  CONSTRAINT `returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returs`
--

LOCK TABLES `returs` WRITE;
/*!40000 ALTER TABLE `returs` DISABLE KEYS */;
INSERT INTO `returs` VALUES (6,6,0,'2022-12-16',NULL,'2022-12-22 16:43:42','2022-12-22 16:43:42'),(7,7,0,'2022-12-16',NULL,'2022-12-22 16:43:42','2022-12-22 16:43:42'),(8,8,1,'2022-12-22','Jahitan tidak rapi','2022-12-22 18:07:33','2022-12-22 18:07:33'),(9,9,1,'2022-12-22','Jahitan tidak rapi','2022-12-22 18:07:33','2022-12-22 18:07:33');
/*!40000 ALTER TABLE `returs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'production','web','2022-08-30 14:18:34','2022-08-30 14:18:34'),(2,'warehouse','web','2022-08-30 14:18:34','2022-08-30 14:18:34'),(3,'admin-online','web','2022-08-30 14:18:34','2022-08-30 14:18:34'),(4,'admin-offline','web','2022-08-30 14:18:34','2022-08-30 14:18:34'),(5,'ecommerce','web','2022-08-30 14:18:34','2022-08-30 14:18:34');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sampahs`
--

DROP TABLE IF EXISTS `sampahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sampahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cuci_id` bigint unsigned DEFAULT NULL,
  `jahit_id` bigint unsigned DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `tanggal_masuk` date DEFAULT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sampahs_cuci_id_index` (`cuci_id`),
  KEY `sampahs_jahit_id_index` (`jahit_id`),
  CONSTRAINT `sampahs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sampahs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sampahs`
--

LOCK TABLES `sampahs` WRITE;
/*!40000 ALTER TABLE `sampahs` DISABLE KEYS */;
INSERT INTO `sampahs` VALUES (11,6,NULL,0,'2022-12-18','cuci','2022-12-22 16:28:15','2022-12-22 16:28:15'),(12,7,NULL,0,'2022-12-18','cuci','2022-12-22 16:28:15','2022-12-22 16:28:15'),(13,NULL,6,0,'2022-12-18','jahit','2022-12-22 16:28:15','2022-12-22 16:28:15'),(14,NULL,7,1,'2022-12-18','jahit','2022-12-22 16:28:15','2022-12-22 16:28:15'),(15,8,NULL,0,'2022-12-22','cuci','2022-12-22 16:35:24','2022-12-22 16:35:24'),(16,9,NULL,1,'2022-12-22','cuci','2022-12-22 16:35:24','2022-12-22 16:35:24'),(17,NULL,8,0,'2022-12-22','jahit','2022-12-22 16:35:24','2022-12-22 16:35:24'),(18,NULL,9,0,'2022-12-22','jahit','2022-12-22 16:35:24','2022-12-22 16:35:24');
/*!40000 ALTER TABLE `sampahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_kategoris`
--

DROP TABLE IF EXISTS `sub_kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kategoris_kategori_id_index` (`kategori_id`),
  CONSTRAINT `sub_kategoris_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kategoris`
--

LOCK TABLES `sub_kategoris` WRITE;
/*!40000 ALTER TABLE `sub_kategoris` DISABLE KEYS */;
INSERT INTO `sub_kategoris` VALUES (8,5,'Kemeja Lengan Pendek','001/1','2022-12-18 18:53:33','2022-12-18 18:53:33'),(9,5,'Kemeja Lengan Panjang','001/2','2022-12-18 18:53:33','2022-12-18 18:53:33');
/*!40000 ALTER TABLE `sub_kategoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksis`
--

DROP TABLE IF EXISTS `transaksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksis` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksis`
--

LOCK TABLES `transaksis` WRITE;
/*!40000 ALTER TABLE `transaksis` DISABLE KEYS */;
INSERT INTO `transaksis` VALUES (1,1,5,2,NULL,NULL,NULL,'12132asdjahd',NULL,'INV050920221','2022-09-05 13:12:08',1,112500,'online','telah tiba','sudah dibayar','166235841569558.jpg',NULL,NULL,NULL,'2022-09-05 13:12:08','2022-09-07 14:00:03'),(2,NULL,NULL,NULL,'Aziz Muslim','083894267082','Jalan Asirot Jakarta',NULL,NULL,'INV181220222','2022-12-18 20:16:33',15,750000,'offline',NULL,NULL,NULL,'Transfer',750000,0,'2022-12-18 20:16:33','2022-12-18 20:16:33');
/*!40000 ALTER TABLE `transaksis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ulasans`
--

DROP TABLE IF EXISTS `ulasans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ulasans` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ulasans`
--

LOCK TABLES `ulasans` WRITE;
/*!40000 ALTER TABLE `ulasans` DISABLE KEYS */;
/*!40000 ALTER TABLE `ulasans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'produksi','produksi@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$8/ZDM2rBJSs1DM1VzzbwNeEvCOlClxgyOUcjR.yRoER1v45DNoEGG',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(2,'gudang','gudang@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$IK5eGiZJn1OIPAjBDjS0du0SyOc.O8xAkJy5O0xYaYcIapwJy4Zp.',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(3,'admin','admin_offline@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$X2FqOkqU2iePOb25OcStYOV69Tvqe33uYChBVpNP/OyCEQbrA28hK',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(4,'admin','admin_online@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$AWbNZOuLCAr2hKPqi.nXYOfMQ0CodF9dKNoERFur/Ux9ntnnBNym2',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(5,'Ryan Ardito','ryan@tes.com',NULL,NULL,NULL,NULL,'$2y$10$moCsMxzlYwSx1e7dlsm1ju/ojCWTuIYNpBItXfazSuVBxdkk3pUgm',NULL,NULL,'2022-09-05 12:22:34','2022-09-05 12:22:34'),(6,'test','test123@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$9YO4CiUA9GiA3gpetuN72ezgmwZj1M7fQfBjXr2R7ZeUo2A2Lz60C',NULL,NULL,'2022-09-05 12:37:54','2022-09-05 12:37:54'),(7,'Aziz Muslim','abdulaziz_muslim@ymail.com',NULL,NULL,NULL,NULL,'$2y$10$fPkX6Ax41lmYWYCHrvwsnueLuMv/l4owFycUllxMikBpoJrXbt156',NULL,NULL,'2022-12-22 18:58:22','2022-12-22 18:58:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finishing_id` bigint unsigned DEFAULT NULL,
  `harga_produk` double(8,2) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouses_finishing_id_index` (`finishing_id`),
  CONSTRAINT `warehouses_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES (6,7,0.00,NULL,'2022-12-18 19:34:38','2022-12-18 19:34:38'),(7,6,0.00,NULL,'2022-12-18 19:37:14','2022-12-18 19:37:14'),(8,9,0.00,NULL,'2022-12-22 17:59:15','2022-12-22 17:59:15'),(9,8,0.00,NULL,'2022-12-22 18:01:05','2022-12-22 18:01:05');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-20  7:55:18
