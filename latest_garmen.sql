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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alamats`
--

LOCK TABLES `alamats` WRITE;
/*!40000 ALTER TABLE `alamats` DISABLE KEYS */;
INSERT INTO `alamats` VALUES (1,6,'tes','0812919283','Rumah','tes 123','Jawa Timur','11','6155','444','Surabaya','Tambaksari','60267','Utama','2022-09-05 12:40:39','2022-09-05 12:40:39'),(2,5,'Ryan Ardito','081282828828','Rumah','Jl. Ir. Soekarno 45','Bali','1','258','17','Badung','Abiansemal','61257','Utama','2022-09-05 13:11:35','2022-09-05 13:11:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahans`
--

LOCK TABLES `bahans` WRITE;
/*!40000 ALTER TABLE `bahans` DISABLE KEYS */;
INSERT INTO `bahans` VALUES (1,NULL,NULL,'B01','SJ050920221057',NULL,'Kaos Polos','Cotton Combed 24s','Hitam',25,NULL,NULL,'Triple A','2022-09-05',NULL,'bahan keluar','2022-09-05 10:58:22','2022-09-05 10:58:58'),(2,3,'TR-2022-09-05-0001','B01','SJK050920221058','001/1/1','Kaos Polos','Cotton Combed 24s','Hitam',25,10,NULL,'Triple A','2022-09-05','2022-09-05','bahan keluar','2022-09-05 10:58:58','2022-09-05 11:06:12'),(3,NULL,NULL,'B02','SJ050920221105',NULL,'Kemeja lengan panjang','Satin','Putih',50,NULL,NULL,'Triple A','2022-09-05',NULL,'bahan keluar','2022-09-05 11:05:36','2022-09-05 11:06:44'),(4,4,'TR-2022-09-05-0002','B01','SJK050920221105','001/1/2','Kaos Polos','Cotton Combed 24s','Hitam',15,10,NULL,'Triple A','2022-09-05','2022-09-05','bahan keluar','2022-09-05 11:06:12','2022-09-05 11:07:54'),(5,8,'TR-2022-09-05-0003','B02','SJK050920221106','002/1/2','Kemeja lengan panjang','Satin','Putih',50,10,NULL,'Triple A','2022-09-05','2022-09-05','bahan keluar','2022-09-05 11:06:44','2022-09-05 11:08:43'),(6,3,'TR-2022-09-05-0004','B01','SJK050920221107','001/1/1','Kaos Polos','Cotton Combed 24s','Hitam',5,5,0,'Triple A','2022-09-05','2022-09-05','bahan keluar','2022-09-05 11:07:54','2022-09-05 11:07:54'),(7,7,'TR-2022-09-05-0005','B02','SJK050920221108','002/1/1','Kemeja lengan panjang','Satin','Putih',40,10,30,'Triple A','2022-09-05','2022-09-05','bahan keluar','2022-09-05 11:08:43','2022-09-05 11:08:43');
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
INSERT INTO `banners` VALUES (1,'Banner 01','Tidak Aktif','Slider Utama','2022-09-05','2022-09-05','-','166235293560609.png','2022-09-05 11:40:36','2022-11-04 17:21:50'),(2,'Promo 2','Aktif','Slider Utama','2022-09-05','2023-02-14','-','166235285988864.png','2022-09-05 11:40:59','2022-11-04 17:21:50'),(3,'Promo 3','Aktif','Slider Utama','2022-09-05','2023-01-11','-','166235290955416.png','2022-09-05 11:41:49','2022-11-04 17:21:50'),(4,'Promo 1','Aktif','Promo Tambahan','2022-09-05','2023-02-11','-','166235303169629.png','2022-09-05 11:43:51','2022-11-04 17:21:50'),(6,'Promo 2','Tidak Aktif','Promo Tambahan','2022-09-05','2022-09-05','-','166235306761652.png','2022-09-05 11:44:27','2022-11-04 17:21:50'),(7,'Promo 3','Aktif','Promo Tambahan','2022-09-05','2023-02-25','-','166235308490115.png','2022-09-05 11:44:44','2022-11-04 17:21:50');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuci_dibuangs`
--

LOCK TABLES `cuci_dibuangs` WRITE;
/*!40000 ALTER TABLE `cuci_dibuangs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuci_direpairs`
--

LOCK TABLES `cuci_direpairs` WRITE;
/*!40000 ALTER TABLE `cuci_direpairs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cucis`
--

LOCK TABLES `cucis` WRITE;
/*!40000 ALTER TABLE `cucis` DISABLE KEYS */;
INSERT INTO `cucis` VALUES (1,1,'SJK050920221058',NULL,'1970-01-01','1970-01-01','2022-09-05',120,'eksternal','Triple A','Belum Lunas',45000.00,120,NULL,0,0,0,NULL,NULL,'-','-',0,5400000,5400000,'cucian keluar','selesai','2022-09-05 11:00:48','2022-11-07 15:25:51'),(2,5,'SJK050920221105',NULL,'1970-01-01','1970-01-01','2022-09-05',60,'eksternal','Triple A','Belum Lunas',45000.00,60,NULL,0,0,0,NULL,NULL,'-','-',0,2700000,2700000,'cucian keluar','selesai','2022-09-05 11:21:39','2022-11-07 15:25:51'),(3,4,'SJK050920221106',NULL,'1970-01-01','1970-01-01','2022-09-05',60,'eksternal','Triple A','Belum Lunas',45000.00,60,NULL,0,0,0,NULL,NULL,'-','-',0,2700000,2700000,'cucian keluar','selesai','2022-09-05 11:21:46','2022-11-07 15:25:51'),(4,3,'SJK050920221107',NULL,'1970-01-01','1970-01-01','2022-09-05',30,'eksternal','Triple A','Belum Lunas',45000.00,30,NULL,0,0,0,NULL,NULL,'-','-',0,1350000,1350000,'cucian keluar','selesai','2022-09-05 11:21:52','2022-11-07 15:25:51'),(5,2,'SJK050920221108',NULL,'1970-01-01','1970-01-01','2022-09-05',60,'eksternal','Triple A','Belum Lunas',45000.00,60,NULL,0,0,0,NULL,NULL,'-','-',0,2700000,2700000,'cucian keluar','selesai','2022-09-05 11:21:57','2022-11-07 15:25:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_cucis`
--

LOCK TABLES `detail_cucis` WRITE;
/*!40000 ALTER TABLE `detail_cucis` DISABLE KEYS */;
INSERT INTO `detail_cucis` VALUES (1,1,'S',40,'2022-09-05 11:00:48','2022-09-05 11:00:48'),(2,1,'M',40,'2022-09-05 11:00:48','2022-09-05 11:00:48'),(3,1,'L',40,'2022-09-05 11:00:48','2022-09-05 11:00:48'),(4,2,'S',20,'2022-09-05 11:21:39','2022-09-05 11:21:39'),(5,2,'M',20,'2022-09-05 11:21:39','2022-09-05 11:21:39'),(6,2,'L',20,'2022-09-05 11:21:39','2022-09-05 11:21:39'),(7,3,'S',20,'2022-09-05 11:21:46','2022-09-05 11:21:46'),(8,3,'M',20,'2022-09-05 11:21:46','2022-09-05 11:21:46'),(9,3,'L',20,'2022-09-05 11:21:46','2022-09-05 11:21:46'),(10,4,'S',10,'2022-09-05 11:21:52','2022-09-05 11:21:52'),(11,4,'M',10,'2022-09-05 11:21:52','2022-09-05 11:21:52'),(12,4,'L',10,'2022-09-05 11:21:52','2022-09-05 11:21:52'),(13,5,'S',20,'2022-09-05 11:21:57','2022-09-05 11:21:57'),(14,5,'M',20,'2022-09-05 11:21:57','2022-09-05 11:21:57'),(15,5,'L',20,'2022-09-05 11:21:57','2022-09-05 11:21:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_finishings`
--

LOCK TABLES `detail_finishings` WRITE;
/*!40000 ALTER TABLE `detail_finishings` DISABLE KEYS */;
INSERT INTO `detail_finishings` VALUES (16,1,'S',40,'2022-09-05 11:25:48','2022-09-05 11:25:48'),(17,1,'M',40,'2022-09-05 11:25:48','2022-09-05 11:25:48'),(18,1,'L',40,'2022-09-05 11:25:48','2022-09-05 11:25:48'),(19,2,'S',20,'2022-09-05 11:26:28','2022-09-05 11:26:28'),(20,2,'M',20,'2022-09-05 11:26:28','2022-09-05 11:26:28'),(21,2,'L',20,'2022-09-05 11:26:28','2022-09-05 11:26:28'),(22,5,'S',20,'2022-09-05 11:26:47','2022-09-05 11:26:47'),(23,5,'M',20,'2022-09-05 11:26:47','2022-09-05 11:26:47'),(24,5,'L',20,'2022-09-05 11:26:47','2022-09-05 11:26:47'),(25,4,'S',10,'2022-09-05 11:27:03','2022-09-05 11:27:03'),(26,4,'M',10,'2022-09-05 11:27:03','2022-09-05 11:27:03'),(27,4,'L',10,'2022-09-05 11:27:03','2022-09-05 11:27:03'),(28,3,'S',20,'2022-09-05 11:27:18','2022-09-05 11:27:18'),(29,3,'M',20,'2022-09-05 11:27:18','2022-09-05 11:27:18'),(30,3,'L',20,'2022-09-05 11:27:18','2022-09-05 11:27:18');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_jahits`
--

LOCK TABLES `detail_jahits` WRITE;
/*!40000 ALTER TABLE `detail_jahits` DISABLE KEYS */;
INSERT INTO `detail_jahits` VALUES (1,1,'S',40,'2022-09-05 11:00:08','2022-09-05 11:00:08'),(2,1,'M',40,'2022-09-05 11:00:08','2022-09-05 11:00:08'),(3,1,'L',40,'2022-09-05 11:00:08','2022-09-05 11:00:08'),(4,2,'S',20,'2022-09-05 11:14:55','2022-09-05 11:14:55'),(5,2,'M',20,'2022-09-05 11:14:55','2022-09-05 11:14:55'),(6,2,'L',20,'2022-09-05 11:14:55','2022-09-05 11:14:55'),(7,3,'S',10,'2022-09-05 11:15:02','2022-09-05 11:15:02'),(8,3,'M',10,'2022-09-05 11:15:02','2022-09-05 11:15:02'),(9,3,'L',10,'2022-09-05 11:15:02','2022-09-05 11:15:02'),(10,4,'S',20,'2022-09-05 11:15:09','2022-09-05 11:15:09'),(11,4,'M',20,'2022-09-05 11:15:09','2022-09-05 11:15:09'),(12,4,'L',20,'2022-09-05 11:15:09','2022-09-05 11:15:09'),(13,5,'S',20,'2022-09-05 11:15:14','2022-09-05 11:15:14'),(14,5,'M',20,'2022-09-05 11:15:14','2022-09-05 11:15:14'),(15,5,'L',20,'2022-09-05 11:15:14','2022-09-05 11:15:14');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_perbaikans`
--

LOCK TABLES `detail_perbaikans` WRITE;
/*!40000 ALTER TABLE `detail_perbaikans` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_potongs`
--

LOCK TABLES `detail_potongs` WRITE;
/*!40000 ALTER TABLE `detail_potongs` DISABLE KEYS */;
INSERT INTO `detail_potongs` VALUES (1,1,'S',40,'2022-09-05 10:59:51','2022-09-05 10:59:51'),(2,1,'M',40,'2022-09-05 10:59:51','2022-09-05 10:59:51'),(3,1,'L',40,'2022-09-05 10:59:51','2022-09-05 10:59:51'),(4,5,'S',20,'2022-09-05 11:10:52','2022-09-05 11:10:52'),(5,5,'M',20,'2022-09-05 11:10:52','2022-09-05 11:10:52'),(6,5,'L',20,'2022-09-05 11:10:52','2022-09-05 11:10:52'),(7,4,'S',10,'2022-09-05 11:11:24','2022-09-05 11:11:24'),(8,4,'M',10,'2022-09-05 11:11:24','2022-09-05 11:11:24'),(9,4,'L',10,'2022-09-05 11:11:24','2022-09-05 11:11:24'),(10,3,'S',20,'2022-09-05 11:12:35','2022-09-05 11:12:35'),(11,3,'M',20,'2022-09-05 11:12:35','2022-09-05 11:12:35'),(12,3,'L',20,'2022-09-05 11:12:35','2022-09-05 11:12:35'),(13,2,'S',20,'2022-09-05 11:13:40','2022-09-05 11:13:40'),(14,2,'M',20,'2022-09-05 11:13:40','2022-09-05 11:13:40'),(15,2,'L',20,'2022-09-05 11:13:40','2022-09-05 11:13:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_produk_images`
--

LOCK TABLES `detail_produk_images` WRITE;
/*!40000 ALTER TABLE `detail_produk_images` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_produks`
--

LOCK TABLES `detail_produks` WRITE;
/*!40000 ALTER TABLE `detail_produks` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_rekapitulasi_warehouses`
--

LOCK TABLES `detail_rekapitulasi_warehouses` WRITE;
/*!40000 ALTER TABLE `detail_rekapitulasi_warehouses` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_rekapitulasis`
--

LOCK TABLES `detail_rekapitulasis` WRITE;
/*!40000 ALTER TABLE `detail_rekapitulasis` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_returs`
--

LOCK TABLES `detail_returs` WRITE;
/*!40000 ALTER TABLE `detail_returs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sampahs`
--

LOCK TABLES `detail_sampahs` WRITE;
/*!40000 ALTER TABLE `detail_sampahs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sub_kategoris`
--

LOCK TABLES `detail_sub_kategoris` WRITE;
/*!40000 ALTER TABLE `detail_sub_kategoris` DISABLE KEYS */;
INSERT INTO `detail_sub_kategoris` VALUES (3,3,'Kaos polos','001/1/1','2022-09-05 10:56:19','2022-09-05 10:56:19'),(4,3,'Kaos bergambar','001/1/2','2022-09-05 10:56:19','2022-09-05 10:56:19'),(5,4,'Kemeja lengan pendek','001/2/1','2022-09-05 10:56:35','2022-09-05 10:56:35'),(6,4,'Kemeja lengan panjang','001/2/2','2022-09-05 10:56:35','2022-09-05 10:56:35'),(7,5,'Kemeja lengan pendek','002/1/1','2022-09-05 11:03:52','2022-09-05 11:03:52'),(8,5,'Kemeja lengan panjang','002/1/2','2022-09-05 11:03:52','2022-09-05 11:03:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_transaksis`
--

LOCK TABLES `detail_transaksis` WRITE;
/*!40000 ALTER TABLE `detail_transaksis` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_warehouses`
--

LOCK TABLES `detail_warehouses` WRITE;
/*!40000 ALTER TABLE `detail_warehouses` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishing_dibuangs`
--

LOCK TABLES `finishing_dibuangs` WRITE;
/*!40000 ALTER TABLE `finishing_dibuangs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishing_returs`
--

LOCK TABLES `finishing_returs` WRITE;
/*!40000 ALTER TABLE `finishing_returs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishings`
--

LOCK TABLES `finishings` WRITE;
/*!40000 ALTER TABLE `finishings` DISABLE KEYS */;
INSERT INTO `finishings` VALUES (1,1,'SJ1','2022-09-05','2022-09-05','2022-09-05',120,0,0,0,'-','-','kirim warehouse',NULL,'2022-09-05 11:01:26','2022-09-05 11:25:48'),(2,5,'SJ2','2022-09-05','2022-09-05','2022-09-05',60,0,0,0,'-','-','kirim warehouse',NULL,'2022-09-05 11:24:00','2022-09-05 11:26:28'),(3,3,'SJK050920221106','2022-09-05','2022-09-05','2022-09-05',60,0,0,0,'-','-','kirim warehouse',NULL,'2022-09-05 11:24:06','2022-09-05 11:27:18'),(4,4,'SJK050920221107','2022-09-05','2022-09-05','2022-09-05',30,0,0,0,'-','-','kirim warehouse',NULL,'2022-09-05 11:24:10','2022-09-05 11:27:03'),(5,2,'SJK050920221105','2022-09-05','2022-09-05','2022-09-05',60,0,0,0,'-','-','kirim warehouse',NULL,'2022-09-05 11:24:14','2022-09-05 11:26:47');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahit_dibuangs`
--

LOCK TABLES `jahit_dibuangs` WRITE;
/*!40000 ALTER TABLE `jahit_dibuangs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahit_direpairs`
--

LOCK TABLES `jahit_direpairs` WRITE;
/*!40000 ALTER TABLE `jahit_direpairs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahits`
--

LOCK TABLES `jahits` WRITE;
/*!40000 ALTER TABLE `jahits` DISABLE KEYS */;
INSERT INTO `jahits` VALUES (1,1,'SJK050920221058','2022-09-05','2022-09-05','2022-09-05','internal',NULL,NULL,120,120,'10 Lusin 0 pcs',0,0,0,'-','-',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-09-05 11:00:08','2022-11-07 15:25:43'),(2,5,'SJK050920221108','2022-09-05','2022-09-05','2022-09-05','internal',NULL,NULL,60,60,'5 Lusin 0 pcs',0,0,0,'0','-',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-09-05 11:14:55','2022-11-07 15:25:43'),(3,4,'SJK050920221107','2022-09-05','2022-09-05','2022-09-05','internal',NULL,NULL,30,30,'2 Lusin 6 pcs',0,0,0,'-','-',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-09-05 11:15:02','2022-11-07 15:25:43'),(4,3,'SJK050920221106','2022-09-05','2022-09-05','2022-09-05','internal',NULL,NULL,60,60,'5 Lusin 0 pcs',0,0,0,'-','-',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-09-05 11:15:09','2022-11-07 15:25:43'),(5,2,'SJK050920221105','2022-09-05','2022-09-05','2022-09-05','internal',NULL,NULL,60,60,'5 Lusin 0 pcs',0,0,0,'0','-',NULL,0,NULL,NULL,'jahitan keluar','selesai','2022-09-05 11:15:14','2022-11-07 15:25:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoris`
--

LOCK TABLES `kategoris` WRITE;
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` VALUES (3,'Pria','001','166235014034702.png','2022-09-05 10:55:40','2022-09-05 10:55:40'),(4,'Wanita','002','166235059997755.png','2022-09-05 11:03:19','2022-09-05 11:03:19');
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
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(4,'App\\User',3),(3,'App\\User',4),(5,'App\\User',5),(5,'App\\User',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 10:58:58','2022-11-04 17:03:23'),(2,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:00:08','2022-11-04 17:03:23'),(3,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:00:48','2022-11-04 17:03:23'),(4,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:01:26','2022-11-04 17:03:23'),(5,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:01:26','2022-09-05 11:01:26'),(6,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:06:12','2022-11-04 17:03:23'),(7,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:06:44','2022-11-04 17:03:23'),(8,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:07:54','2022-11-04 17:03:23'),(9,'bahan keluar telah dikirim ke potong, silahkan di cek bahan','http://m2nstore.com/production/potong',1,0,'production','2022-09-05 11:08:43','2022-11-04 17:03:23'),(10,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:14:55','2022-11-04 17:03:23'),(11,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:02','2022-11-04 17:03:23'),(12,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:09','2022-11-04 17:03:23'),(13,'potong keluar telah dikirim ke jahit, silahkan di cek','http://m2nstore.com/production/jahit',1,0,'production','2022-09-05 11:15:14','2022-11-04 17:03:23'),(14,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:39','2022-11-04 17:03:23'),(15,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:46','2022-11-04 17:03:23'),(16,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:52','2022-11-04 17:03:23'),(17,'jahit keluar telah dikirim ke cuci, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:21:57','2022-11-04 17:03:23'),(18,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:00','2022-11-04 17:03:23'),(19,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:00','2022-09-05 11:24:00'),(20,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:06','2022-11-04 17:03:23'),(21,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:06','2022-09-05 11:24:06'),(22,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:10','2022-11-04 17:03:23'),(23,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:10','2022-09-05 11:24:10'),(24,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/production/cuci',1,0,'production','2022-09-05 11:24:14','2022-11-04 17:03:23'),(25,'cuci keluar telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/finishing',0,0,'warehouse','2022-09-05 11:24:14','2022-09-05 11:24:14'),(26,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:25:48','2022-11-04 17:03:23'),(27,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:25:48','2022-09-05 11:25:48'),(28,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:26:28','2022-11-04 17:03:23'),(29,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:26:28','2022-09-05 11:26:28'),(30,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:26:47','2022-11-04 17:03:23'),(31,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:26:47','2022-09-05 11:26:47'),(32,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:27:03','2022-11-04 17:03:23'),(33,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:03','2022-09-05 11:27:03'),(34,'ada barang yang diretur, silahkan di cek','http://m2nstore.com/production/retur',1,0,'production','2022-09-05 11:27:18','2022-11-04 17:03:23'),(35,'sortir telah dikirim ke gudang, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:18','2022-09-05 11:27:18'),(36,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:30','2022-09-05 11:27:30'),(37,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:37','2022-09-05 11:27:37'),(38,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:42','2022-09-05 11:27:42'),(39,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:49','2022-09-05 11:27:49'),(40,'gudang telah dikirim ke ecommerce, silahkan di cek','http://m2nstore.com/warehouse/warehouse',0,0,'warehouse','2022-09-05 11:27:58','2022-09-05 11:27:58'),(41,'Ada transaksi baru INV050920221','http://m2nstore.com/admin/transaksi',0,0,'online','2022-09-05 13:12:08','2022-09-05 13:12:08');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_cucis`
--

LOCK TABLES `pembayaran_cucis` WRITE;
/*!40000 ALTER TABLE `pembayaran_cucis` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_jahits`
--

LOCK TABLES `pembayaran_jahits` WRITE;
/*!40000 ALTER TABLE `pembayaran_jahits` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perbaikans`
--

LOCK TABLES `perbaikans` WRITE;
/*!40000 ALTER TABLE `perbaikans` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potongs`
--

LOCK TABLES `potongs` WRITE;
/*!40000 ALTER TABLE `potongs` DISABLE KEYS */;
INSERT INTO `potongs` VALUES (1,2,'SJK050920221058','2022-09-05','2022-09-05',NULL,120.00,'10 Lusin 0 pcs','potong keluar','selesai','2022-09-05 10:58:58','2022-11-07 15:25:38'),(2,4,'SJK050920221105','2022-09-05','2022-09-05',NULL,60.00,'5 Lusin 0 pcs','potong keluar','selesai','2022-09-05 11:06:12','2022-11-07 15:25:38'),(3,5,'SJK050920221106','2022-09-05','2022-09-05',NULL,60.00,'5 Lusin 0 pcs','potong keluar','selesai','2022-09-05 11:06:44','2022-11-07 15:25:38'),(4,6,'SJK050920221107','2022-09-05','2022-09-05',NULL,30.00,'2 Lusin 6 pcs','potong keluar','selesai','2022-09-05 11:07:54','2022-11-07 15:25:38'),(5,7,'SJK050920221108','2022-09-05','2022-09-05',NULL,60.00,'5 Lusin 0 pcs','potong keluar','selesai','2022-09-05 11:08:43','2022-11-07 15:25:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produks`
--

LOCK TABLES `produks` WRITE;
/*!40000 ALTER TABLE `produks` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekapitulasi_warehouses`
--

LOCK TABLES `rekapitulasi_warehouses` WRITE;
/*!40000 ALTER TABLE `rekapitulasi_warehouses` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekapitulasis`
--

LOCK TABLES `rekapitulasis` WRITE;
/*!40000 ALTER TABLE `rekapitulasis` DISABLE KEYS */;
INSERT INTO `rekapitulasis` VALUES (1,1,NULL,0,0,'2022-09-05 11:01:29','2022-09-05 11:01:29'),(2,NULL,1,0,0,'2022-09-05 11:01:29','2022-09-05 11:01:29'),(3,2,NULL,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(4,3,NULL,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(5,4,NULL,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(6,5,NULL,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(7,NULL,2,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(8,NULL,3,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(9,NULL,4,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15'),(10,NULL,5,0,0,'2022-09-05 11:24:15','2022-09-05 11:24:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returs`
--

LOCK TABLES `returs` WRITE;
/*!40000 ALTER TABLE `returs` DISABLE KEYS */;
INSERT INTO `returs` VALUES (1,1,0,'2022-09-05','-','2022-11-04 17:03:33','2022-11-04 17:03:33'),(2,2,0,'2022-09-05','-','2022-11-04 17:03:33','2022-11-04 17:03:33'),(3,3,0,'2022-09-05','-','2022-11-04 17:03:33','2022-11-04 17:03:33'),(4,4,0,'2022-09-05','-','2022-11-04 17:03:33','2022-11-04 17:03:33'),(5,5,0,'2022-09-05','-','2022-11-04 17:03:33','2022-11-04 17:03:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sampahs`
--

LOCK TABLES `sampahs` WRITE;
/*!40000 ALTER TABLE `sampahs` DISABLE KEYS */;
INSERT INTO `sampahs` VALUES (1,1,NULL,0,'2022-09-05','cuci','2022-11-04 17:03:29','2022-11-04 17:03:29'),(2,2,NULL,0,'2022-09-05','cuci','2022-11-04 17:03:29','2022-11-04 17:03:29'),(3,3,NULL,0,'2022-09-05','cuci','2022-11-04 17:03:29','2022-11-04 17:03:29'),(4,4,NULL,0,'2022-09-05','cuci','2022-11-04 17:03:29','2022-11-04 17:03:29'),(5,5,NULL,0,'2022-09-05','cuci','2022-11-04 17:03:29','2022-11-04 17:03:29'),(6,NULL,1,0,'2022-09-05','jahit','2022-11-04 17:03:29','2022-11-04 17:03:29'),(7,NULL,2,0,'2022-09-05','jahit','2022-11-04 17:03:29','2022-11-04 17:03:29'),(8,NULL,3,0,'2022-09-05','jahit','2022-11-04 17:03:29','2022-11-04 17:03:29'),(9,NULL,4,0,'2022-09-05','jahit','2022-11-04 17:03:29','2022-11-04 17:03:29'),(10,NULL,5,0,'2022-09-05','jahit','2022-11-04 17:03:29','2022-11-04 17:03:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kategoris`
--

LOCK TABLES `sub_kategoris` WRITE;
/*!40000 ALTER TABLE `sub_kategoris` DISABLE KEYS */;
INSERT INTO `sub_kategoris` VALUES (3,3,'Kaos','001/1','2022-09-05 10:56:01','2022-09-05 10:56:01'),(4,3,'Kemeja','001/2','2022-09-05 10:56:01','2022-09-05 10:56:01'),(5,4,'Kemeja','002/1','2022-09-05 11:03:33','2022-09-05 11:03:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksis`
--

LOCK TABLES `transaksis` WRITE;
/*!40000 ALTER TABLE `transaksis` DISABLE KEYS */;
INSERT INTO `transaksis` VALUES (1,1,5,2,NULL,NULL,NULL,'12132asdjahd',NULL,'INV050920221','2022-09-05 13:12:08',1,112500,'online','telah tiba','sudah dibayar','166235841569558.jpg',NULL,NULL,NULL,'2022-09-05 13:12:08','2022-09-07 14:00:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'produksi','produksi@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$8/ZDM2rBJSs1DM1VzzbwNeEvCOlClxgyOUcjR.yRoER1v45DNoEGG',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(2,'gudang','gudang@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$IK5eGiZJn1OIPAjBDjS0du0SyOc.O8xAkJy5O0xYaYcIapwJy4Zp.',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(3,'admin','admin_offline@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$X2FqOkqU2iePOb25OcStYOV69Tvqe33uYChBVpNP/OyCEQbrA28hK',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(4,'admin','admin_online@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$AWbNZOuLCAr2hKPqi.nXYOfMQ0CodF9dKNoERFur/Ux9ntnnBNym2',NULL,NULL,'2022-08-30 14:18:34','2022-08-30 14:18:34'),(5,'Ryan Ardito','ryan@tes.com',NULL,NULL,NULL,NULL,'$2y$10$moCsMxzlYwSx1e7dlsm1ju/ojCWTuIYNpBItXfazSuVBxdkk3pUgm',NULL,NULL,'2022-09-05 12:22:34','2022-09-05 12:22:34'),(6,'test','test123@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$9YO4CiUA9GiA3gpetuN72ezgmwZj1M7fQfBjXr2R7ZeUo2A2Lz60C',NULL,NULL,'2022-09-05 12:37:54','2022-09-05 12:37:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
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

-- Dump completed on 2022-11-07  8:35:53
