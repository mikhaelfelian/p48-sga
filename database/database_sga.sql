-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_p48_ars.tbl_ion_groups
DROP TABLE IF EXISTS `tbl_ion_groups`;
CREATE TABLE IF NOT EXISTS `tbl_ion_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `akses` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_ion_groups: ~9 rows (approximately)
DELETE FROM `tbl_ion_groups`;
INSERT INTO `tbl_ion_groups` (`id`, `name`, `description`, `akses`) VALUES
	(1, 'superadmin', 'Super Administrator', NULL),
	(2, 'owner', 'Pemilik Perusahaan', NULL),
	(3, 'owner2', 'Pemilik Perusahaan', NULL),
	(4, 'adminm', 'Manager', NULL),
	(5, 'admin', 'Staff Admin', NULL),
	(6, 'purchasing', 'Purchasing', NULL),
	(7, 'gudang', 'Gudang', NULL),
	(8, 'sales', 'Sales', NULL),
	(9, 'teknisi', 'Teknisi', NULL);

-- Dumping structure for table db_p48_ars.tbl_ion_login_attempts
DROP TABLE IF EXISTS `tbl_ion_login_attempts`;
CREATE TABLE IF NOT EXISTS `tbl_ion_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_ion_login_attempts: ~0 rows (approximately)
DELETE FROM `tbl_ion_login_attempts`;

-- Dumping structure for table db_p48_ars.tbl_ion_modules
DROP TABLE IF EXISTS `tbl_ion_modules`;
CREATE TABLE IF NOT EXISTS `tbl_ion_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `modules` varchar(50) DEFAULT NULL,
  `modules_action` varchar(50) DEFAULT NULL,
  `modules_name` varchar(50) DEFAULT NULL,
  `modules_route` varchar(50) DEFAULT NULL,
  `modules_param` varchar(50) DEFAULT NULL,
  `modules_icon` varchar(50) DEFAULT NULL,
  `is_parent` enum('0','1') DEFAULT '0',
  `is_sidebar` enum('0','1') DEFAULT '0',
  `is_view` enum('0','1') DEFAULT '0',
  `is_save` enum('0','1') DEFAULT '0',
  `is_update` enum('0','1') DEFAULT '0',
  `is_delete` enum('0','1') DEFAULT '0',
  `note` text DEFAULT NULL,
  `sort` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_ion_modules: ~0 rows (approximately)
DELETE FROM `tbl_ion_modules`;

-- Dumping structure for table db_p48_ars.tbl_ion_users
DROP TABLE IF EXISTS `tbl_ion_users`;
CREATE TABLE IF NOT EXISTS `tbl_ion_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned DEFAULT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL COMMENT 'Untuk nik',
  `first_name` varchar(50) DEFAULT NULL COMMENT 'Untuk nama user',
  `last_name` varchar(50) DEFAULT NULL COMMENT 'Untuk gelar belakang',
  `birthdate` date DEFAULT NULL COMMENT 'Tanggal Lahir',
  `address` text DEFAULT NULL COMMENT 'Untuk alamat',
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `file_name` text DEFAULT NULL,
  `file_base64` longtext DEFAULT NULL,
  `tipe` enum('0','1','2') DEFAULT '1' COMMENT '0=none;\r\n1=karyawan;\r\n2=pasien;',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_ion_users: ~11 rows (approximately)
DELETE FROM `tbl_ion_users`;
INSERT INTO `tbl_ion_users` (`id`, `username`, `ip_address`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `nik`, `first_name`, `last_name`, `birthdate`, `address`, `company`, `phone`, `file_name`, `file_base64`, `tipe`) VALUES
	(1, 'sadmin', '127.0.0.1', '$2y$10$cYK4ah5foDzxtcv.uHkWpeHwPihec/7NjvB4aDuXaCzxyfrzX5ZVO', '', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, 'RxCZnvoR/mUeTe47', 1268889823, 1674577864, 1, NULL, 'MIKHAEL FELIAN WASKITO', '', '1954-02-02', NULL, 'ADMIN', '', '', NULL, '1'),
	(2, 'superadmin', '112.78.39.51', '$2y$10$B8gNk6Tlf8KMTbRDSFqz8eGN0V8vmSwMZsx4EfzwGf1fvc22/wefm', 'EBo75QJvR14a7H9c', 'noreply@esensia.co.id', NULL, NULL, NULL, NULL, NULL, '9286c9cddf87d1623220ce76432ee21a885836ca', '$2y$10$8sccpzgja68Z4lk8ZbhwJelbrjFYHt6qq7bvllzrd0DdKprQtSb7e', 1560132540, 1741254895, 1, NULL, 'SUPERADMIN', 'S.Kom', '2024-04-14', NULL, NULL, NULL, 'profile_2superadmin.png', '', '1'),
	(10, 'rina', '27.124.95.90', '$2y$10$MEoAMIQR2vzUWJ0kdFEWgOuQqNKv.t7N3JCZ5C9rMqLj1lgc1l5ba', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '34a5431293cfc82d042f87b8db2a24bc885d8998', '$2y$10$52ituyXhxZhuzyZfvAWvL.u/Xi5p0BSPKolwMG9eC1vIr/eeupC5a', 1717563543, 1727161812, 1, '3325086703970002', 'RINA KARTIKASARI', '', '1997-03-27', NULL, NULL, NULL, NULL, NULL, '1'),
	(11, 'salma', '27.124.95.90', '$2y$10$AUIquQRL5jyIvZiD9sC3XOv1ES1WK0aCCJnvZIWiAXo1RAlPrAEuq', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '22b3b9fc0bfb27888bc48dbf35a1b0200d0a9f3a', '$2y$10$WRynWpwLOTxHWKu/03h9tOF5cbUt8OWo69vQCQqWku5twi9b5SEwq', 1717563772, 1727340888, 1, '3374074705990004', 'SALMA RACHMAWATI', '', '1999-05-27', NULL, NULL, NULL, NULL, NULL, '1'),
	(12, 'ari', '27.124.95.90', '$2y$10$9E1h0kboBagiz3mKap6KgeCfWth4VRmR98rGPVWAOi/82FhfLdieO', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1717730235, NULL, 1, '3374110807850003', 'ARI YULIANTO', '', '1985-07-08', NULL, NULL, NULL, NULL, NULL, '1'),
	(13, 'putra', '27.124.95.90', '$2y$10$mMnTm3XQxaPU6bp/1N4vqeBXYddY3P1OL9z7sZOGBZl4bDkRKG58S', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '118c29f17d788beb831ee5837aab4e50b66c2066', '$2y$10$gIDItwjk4IlEIo/jbmB4h.xVNCg53MapMA1XRDs0tEuLKHl1F5Ahi', 1717730379, 1726889563, 1, '3374112607920001', 'SURA PUTRA HASWATAMA', '', '1992-07-26', NULL, NULL, NULL, NULL, NULL, '1'),
	(14, 'eko', '27.124.95.90', '$2y$10$kTPxStlW8Jskay.4w7XkQ..ZBWtyj3VqySlXdT.BDsxAp1DKkRngW', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '40bade57c9ee5282f6d35cb7affc46637860b5fc', '$2y$10$sDfKdbBjOi3XpxwEKr2zgOiVia/vT/tNzSNEp6gKpX.of1N/H.cvu', 1717730501, 1727330875, 1, '3374112405760001', 'WAYU EKO SUHARTO', '', '1976-05-24', NULL, NULL, NULL, NULL, NULL, '1'),
	(17, 'fadly', '114.10.122.28', '$2y$10$HoBL5xSKUqsbtmGhDhibY.6yjHhLyldldu1SLgxbcqLErKT5zW5i6', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, 'f27ac8c9c29f26b5c27a95ba274aba86374a5a88', '$2y$10$y3BbvVrHYqcIdN7JDHYL7OQzsU1WrUVeOJasOW1Xh0pZtcXwLjSA2', 1719137577, 1728236726, 1, '3374150309900005', 'FADLY RAHMAN', '', '1990-09-03', NULL, NULL, NULL, NULL, NULL, '1'),
	(18, 'pujiyono', '27.124.95.218', '$2y$10$njpZ5qAVjRKMO/00hJ2wN.LjuhE83ySfuyKly6SgQQjNohpxfjw1a', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '6f147662347177c60f5a3db2bd96402970b85603', '$2y$10$6rGBYDHRoxZbsgKqyuDVv.V/JXyCkGoOpHBDEsw6cnFGmdiLLugfu', 1726545737, 1726545765, 1, '1223', 'PUJIYONO', '', '2024-09-17', NULL, NULL, NULL, NULL, NULL, '1'),
	(19, 'Wika', '27.124.95.218', '$2y$10$9LQzljjOT78usVRmE11BoeIL1c5O.gOt6Pw3/dYAsO4mnzSxs1uaa', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '0cf1e04f3a5dd6a0564bce5865158b0bf74de344', '$2y$10$NhX7w6JnSzJFRMbq33/WbeOMdvyrafeflHXyWoauA6.BduJVQW3d6', 1726546588, 1726547080, 1, '000', 'WIKA SEPTIANA', '', '1993-09-20', NULL, NULL, NULL, NULL, NULL, '1'),
	(20, 'pujiyono1', '202.145.5.171', '$2y$10$BycRUoOwULhe9VBHCHcdHeyMp5vl.MJk0yivglL6hT0dlOKs.PX.e', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1728876418, NULL, 1, '1234567890-', 'PUJIYONO', '', '2024-10-14', NULL, NULL, NULL, NULL, NULL, '1');

-- Dumping structure for table db_p48_ars.tbl_ion_users_groups
DROP TABLE IF EXISTS `tbl_ion_users_groups`;
CREATE TABLE IF NOT EXISTS `tbl_ion_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `group_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `tbl_ion_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `tbl_ion_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_ion_users_groups: ~12 rows (approximately)
DELETE FROM `tbl_ion_users_groups`;
INSERT INTO `tbl_ion_users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(57, 1, 2),
	(92, 2, 2),
	(73, 10, 2),
	(81, 11, 2),
	(69, 12, 8),
	(88, 13, 8),
	(87, 14, 7),
	(89, 17, 2),
	(72, 18, 8),
	(78, 19, 8),
	(90, 20, 8);

-- Dumping structure for table db_p48_ars.tbl_m_berkas
DROP TABLE IF EXISTS `tbl_m_berkas`;
CREATE TABLE IF NOT EXISTS `tbl_m_berkas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_berkas: ~6 rows (approximately)
DELETE FROM `tbl_m_berkas`;
INSERT INTO `tbl_m_berkas` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `tipe`, `status`) VALUES
	(1, 2, '2024-06-24 18:29:21', '2024-06-24 18:29:21', 'Kontrak', 1),
	(2, 2, '2024-06-24 18:29:37', '2024-06-24 18:29:37', 'SPK / Surat Pesanan', 1),
	(3, 2, '2024-06-24 18:29:47', '2024-06-24 18:29:47', 'Faktur Pajak', 1),
	(4, 2, '2024-06-24 18:29:57', '2024-06-24 18:29:57', 'Bukti Potong PPn', 1),
	(5, 2, '2024-06-24 18:30:06', '2024-06-24 18:30:06', 'Bukti Potong PPh', 1),
	(6, 2, '2024-07-11 14:16:24', '2024-07-11 14:16:24', 'BAST', 1);

-- Dumping structure for table db_p48_ars.tbl_m_departemen
DROP TABLE IF EXISTS `tbl_m_departemen`;
CREATE TABLE IF NOT EXISTS `tbl_m_departemen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `dept` varchar(160) DEFAULT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data departemen / divisi';

-- Dumping data for table db_p48_ars.tbl_m_departemen: ~5 rows (approximately)
DELETE FROM `tbl_m_departemen`;
INSERT INTO `tbl_m_departemen` (`id`, `id_user`, `tgl_simpan`, `kode`, `dept`, `keterangan`, `status`) VALUES
	(1, 41, '2023-09-19 22:14:42', 'MGT', 'MANAJEMEN', NULL, '1'),
	(2, 41, '2023-09-19 22:14:42', 'FO', 'PELAYANAN', NULL, '1'),
	(3, 41, '2023-09-19 22:14:42', 'AKT', 'AKUNTING', NULL, '1'),
	(4, 41, '2023-09-19 22:14:42', 'TEK', 'TEKNISI', NULL, '1'),
	(5, 41, '2023-09-19 22:14:42', 'PJK', 'PAJAK', NULL, '1');

-- Dumping structure for table db_p48_ars.tbl_m_gelar
DROP TABLE IF EXISTS `tbl_m_gelar`;
CREATE TABLE IF NOT EXISTS `tbl_m_gelar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gelar` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_gelar: ~4 rows (approximately)
DELETE FROM `tbl_m_gelar`;
INSERT INTO `tbl_m_gelar` (`id`, `gelar`, `ket`) VALUES
	(1, 'TN.', 'TUAN'),
	(2, 'NN.', 'NONA'),
	(3, 'NY.', 'NYONYA'),
	(4, 'AN.', 'ANAK');

-- Dumping structure for table db_p48_ars.tbl_m_gudang
DROP TABLE IF EXISTS `tbl_m_gudang`;
CREATE TABLE IF NOT EXISTS `tbl_m_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `gudang` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT NULL COMMENT '1 = Gudang aktif\r\n2 = Gudang Bazar (tertentu)\r\n0 = Gudang simpan (stok)\r\n3 = Gudang Brg Keluar / Pinjam / dll',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_gudang: ~0 rows (approximately)
DELETE FROM `tbl_m_gudang`;
INSERT INTO `tbl_m_gudang` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `gudang`, `keterangan`, `status`) VALUES
	(1, 1, '2019-04-17 10:24:51', NULL, 'GD.001', 'Gd. Utama', '-', '1');

-- Dumping structure for table db_p48_ars.tbl_m_item
DROP TABLE IF EXISTS `tbl_m_item`;
CREATE TABLE IF NOT EXISTS `tbl_m_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_satuan` int(11) DEFAULT 0,
  `id_kategori` int(11) DEFAULT 0,
  `id_merk` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(65) DEFAULT NULL,
  `barcode` varchar(65) DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jml` decimal(10,2) DEFAULT 0.00,
  `harga_beli` decimal(65,2) DEFAULT 0.00,
  `harga_jual` decimal(65,2) DEFAULT 0.00,
  `status_stok` enum('0','1') DEFAULT '0',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_item: ~100 rows (approximately)
DELETE FROM `tbl_m_item`;
INSERT INTO `tbl_m_item` (`id`, `id_satuan`, `id_kategori`, `id_merk`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `barcode`, `item`, `keterangan`, `jml`, `harga_beli`, `harga_jual`, `status_stok`, `status`) VALUES
	(1, 7, 80, 135, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0001', 'BC000001', 'Item 1', 'ut minim ullamco ut labore ullamco ad amet ullamco ut', 0.00, 101907197.00, 56466865.00, '0', '1'),
	(2, 2, 15, 407, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0002', 'BC000002', 'Item 2', 'enim tempor do nostrud adipiscing labore sed Ut nisi sed', 0.00, 135353708.00, 81210658.00, '0', '1'),
	(3, 2, 7, 254, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0003', 'BC000003', 'Item 3', 'tempor aliquip magna consectetur adipiscing incididunt Lorem sit eiusmod quis', 0.00, 141559380.00, 34643775.00, '1', '1'),
	(4, 4, 53, 262, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0004', 'BC000004', 'Item 4', 'quis labore enim aliquip magna exercitation labore enim amet labore', 0.00, 106111614.00, 23311183.00, '1', '1'),
	(5, 5, 94, 199, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0005', 'BC000005', 'Item 5', 'nostrud ipsum sed ut enim magna eiusmod consectetur elit et', 0.00, 144065979.00, 45214998.00, '1', '1'),
	(6, 7, 67, 123, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0006', 'BC000006', 'Item 6', 'aliquip exercitation ea elit dolor ad et nostrud aliqua consequat', 0.00, 21992842.00, 120560929.00, '0', '1'),
	(7, 4, 4, 283, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0007', 'BC000007', 'Item 7', 'sed consequat sed do do tempor dolore et labore ut', 0.00, 159471588.00, 126309998.00, '1', '1'),
	(8, 7, 22, 97, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0008', 'BC000008', 'Item 8', 'dolor dolor dolore dolor Lorem sed magna amet aliqua ut', 0.00, 81351886.00, 11101778.00, '1', '1'),
	(9, 2, 4, 130, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0009', 'BC000009', 'Item 9', 'consequat exercitation elit ad ullamco eiusmod veniam enim quis minim', 0.00, 70384984.00, 53185964.00, '1', '1'),
	(10, 1, 36, 152, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0010', 'BC000010', 'Item 10', 'ad incididunt commodo adipiscing dolore elit tempor dolor elit elit', 0.00, 14572812.00, 30523014.00, '1', '1'),
	(11, 4, 42, 146, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0011', 'BC000011', 'Item 11', 'ut laboris Ut et elit dolore veniam ut aliqua Ut', 0.00, 142830687.00, 277049.00, '1', '1'),
	(12, 1, 89, 412, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0012', 'BC000012', 'Item 12', 'sed elit adipiscing dolor sed dolor Lorem dolor Ut ea', 0.00, 167362302.00, 169509365.00, '1', '1'),
	(13, 4, 76, 134, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0013', 'BC000013', 'Item 13', 'ut sit commodo Lorem magna incididunt ea ullamco do ullamco', 0.00, 150622215.00, 35250577.00, '1', '1'),
	(14, 6, 75, 372, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0014', 'BC000014', 'Item 14', 'exercitation enim aliqua adipiscing dolor ullamco dolore nostrud quis ipsum', 0.00, 165690364.00, 153294979.00, '1', '1'),
	(15, 6, 84, 128, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0015', 'BC000015', 'Item 15', 'minim dolore adipiscing quis sit incididunt labore enim enim eiusmod', 0.00, 152340653.00, 163619368.00, '0', '1'),
	(16, 5, 83, 379, 2, '2025-03-06 17:39:14', '2025-03-06 17:40:04', 'ITM0016', 'BC000016', 'Item 16', 'elit tempor adipiscing et sit laboris consectetur quis Ut veniam', 0.00, 168614529.00, 58953833.00, '1', '1'),
	(17, 2, 64, 26, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0017', 'BC000017', 'Item 17', 'consequat laboris sed laboris labore minim dolor sit ea amet', 0.00, 36743075.00, 72201534.00, '1', '1'),
	(18, 5, 31, 105, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0018', 'BC000018', 'Item 18', 'ullamco enim ut ut minim ea Lorem sed et Lorem', 0.00, 3923061.00, 21197663.00, '0', '1'),
	(19, 4, 79, 219, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0019', 'BC000019', 'Item 19', 'laboris ut consequat ut ad ex aliquip enim minim do', 0.00, 145741429.00, 62712234.00, '0', '1'),
	(20, 4, 51, 306, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0020', 'BC000020', 'Item 20', 'dolore enim dolore incididunt ut commodo ullamco magna amet consequat', 0.00, 85912320.00, 33575690.00, '1', '1'),
	(21, 1, 62, 8, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0021', 'BC000021', 'Item 21', 'eiusmod consequat amet ullamco consectetur do ut dolore aliqua commodo', 0.00, 147293365.00, 106304933.00, '1', '1'),
	(22, 3, 56, 351, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0022', 'BC000022', 'Item 22', 'elit laboris ad commodo incididunt ad veniam aliqua nostrud aliqua', 0.00, 173317244.00, 135308176.00, '0', '1'),
	(23, 2, 22, 145, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0023', 'BC000023', 'Item 23', 'ad exercitation magna nostrud tempor aliquip dolor et ipsum nostrud', 0.00, 57513200.00, 55253484.00, '0', '1'),
	(24, 3, 64, 234, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0024', 'BC000024', 'Item 24', 'amet minim exercitation ipsum sed dolor adipiscing et Ut enim', 0.00, 158411617.00, 131640966.00, '0', '1'),
	(25, 3, 4, 371, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0025', 'BC000025', 'Item 25', 'sit tempor labore ut ex et ea laboris amet labore', 0.00, 66758320.00, 65777884.00, '0', '1'),
	(26, 4, 6, 35, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0026', 'BC000026', 'Item 26', 'ea do ad ad consectetur minim nisi aliqua exercitation et', 0.00, 50321679.00, 3513511.00, '0', '1'),
	(27, 2, 46, 44, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0027', 'BC000027', 'Item 27', 'consectetur amet sit adipiscing ullamco adipiscing adipiscing exercitation ut enim', 0.00, 88089954.00, 57907556.00, '0', '1'),
	(28, 1, 74, 70, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0028', 'BC000028', 'Item 28', 'incididunt quis commodo ex nisi ad labore nostrud veniam incididunt', 0.00, 98275311.00, 82021332.00, '1', '1'),
	(29, 1, 94, 31, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0029', 'BC000029', 'Item 29', 'minim laboris aliqua incididunt ea adipiscing eiusmod nostrud tempor ad', 0.00, 106995351.00, 159086281.00, '0', '1'),
	(30, 6, 61, 308, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0030', 'BC000030', 'Item 30', 'amet quis Lorem aliquip quis ut minim aliquip quis ullamco', 0.00, 84639422.00, 34837540.00, '1', '1'),
	(31, 2, 80, 336, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0031', 'BC000031', 'Item 31', 'labore veniam minim quis magna enim ipsum elit consectetur ut', 0.00, 121584641.00, 108302339.00, '0', '1'),
	(32, 6, 71, 152, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0032', 'BC000032', 'Item 32', 'Ut tempor incididunt labore ea aliqua dolore tempor elit incididunt', 0.00, 158608129.00, 111781407.00, '0', '1'),
	(33, 4, 9, 293, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0033', 'BC000033', 'Item 33', 'ipsum amet consectetur enim elit magna dolore nisi Lorem sed', 0.00, 35724252.00, 81523843.00, '1', '1'),
	(34, 4, 72, 173, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0034', 'BC000034', 'Item 34', 'exercitation tempor veniam dolore ut dolore sit eiusmod quis exercitation', 0.00, 149494642.00, 64213994.00, '1', '1'),
	(35, 4, 35, 20, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0035', 'BC000035', 'Item 35', 'sed ad consectetur magna nisi ipsum et adipiscing aliqua tempor', 0.00, 137524012.00, 40544727.00, '1', '1'),
	(36, 3, 69, 227, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0036', 'BC000036', 'Item 36', 'dolore Lorem aliquip amet sit ut nisi ut ut aliqua', 0.00, 90235639.00, 166164744.00, '1', '1'),
	(37, 7, 64, 173, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0037', 'BC000037', 'Item 37', 'ea nisi et nostrud ullamco ad sit Lorem ut consectetur', 0.00, 133818819.00, 73325398.00, '1', '1'),
	(38, 7, 46, 223, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0038', 'BC000038', 'Item 38', 'laboris nostrud magna eiusmod enim incididunt sed labore et aliquip', 0.00, 40024711.00, 19761957.00, '0', '1'),
	(39, 6, 55, 301, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0039', 'BC000039', 'Item 39', 'commodo sed tempor minim quis amet dolore ipsum consequat exercitation', 0.00, 163427981.00, 7879764.00, '1', '1'),
	(40, 1, 59, 221, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0040', 'BC000040', 'Item 40', 'amet minim enim elit Lorem dolore ad elit ullamco ipsum', 0.00, 66027609.00, 105849866.00, '1', '1'),
	(41, 6, 20, 62, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0041', 'BC000041', 'Item 41', 'ipsum nostrud labore sed sit aliquip consequat magna tempor exercitation', 0.00, 136177123.00, 106004746.00, '0', '1'),
	(42, 4, 38, 313, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0042', 'BC000042', 'Item 42', 'magna ad elit nostrud adipiscing enim quis ex sit sit', 0.00, 43432372.00, 103700893.00, '0', '1'),
	(43, 3, 49, 329, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0043', 'BC000043', 'Item 43', 'sed veniam ad do sed dolore aliqua ut nostrud exercitation', 0.00, 82497803.00, 163826246.00, '1', '1'),
	(44, 7, 25, 58, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0044', 'BC000044', 'Item 44', 'ullamco labore sit commodo amet ullamco aliquip exercitation adipiscing consequat', 0.00, 75287272.00, 32002762.00, '0', '1'),
	(45, 4, 28, 197, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0045', 'BC000045', 'Item 45', 'magna consectetur quis minim dolor ullamco laboris laboris exercitation labore', 0.00, 113962784.00, 137386198.00, '0', '1'),
	(46, 2, 64, 240, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0046', 'BC000046', 'Item 46', 'Lorem Lorem consectetur enim labore ipsum enim nisi amet aliquip', 0.00, 53847588.00, 114104891.00, '0', '1'),
	(47, 7, 60, 355, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0047', 'BC000047', 'Item 47', 'consequat quis nisi consectetur quis ea enim nisi amet laboris', 0.00, 30976007.00, 89095388.00, '0', '1'),
	(48, 6, 72, 340, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0048', 'BC000048', 'Item 48', 'tempor elit laboris veniam dolore quis aliquip ex minim elit', 0.00, 36897195.00, 100175260.00, '0', '1'),
	(49, 5, 71, 349, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0049', 'BC000049', 'Item 49', 'magna sit Ut amet exercitation elit ad aliqua laboris labore', 0.00, 109438048.00, 137097348.00, '1', '1'),
	(50, 4, 77, 207, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0050', 'BC000050', 'Item 50', 'eiusmod dolore consequat ullamco enim consequat consectetur ea adipiscing dolore', 0.00, 41449364.00, 91388713.00, '0', '1'),
	(51, 5, 93, 318, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0051', 'BC000051', 'Item 51', 'nisi do aliqua nostrud consectetur Ut adipiscing minim do veniam', 0.00, 85639109.00, 149008461.00, '0', '1'),
	(52, 5, 53, 370, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0052', 'BC000052', 'Item 52', 'ad nostrud ullamco dolor labore aliquip ea ex elit ex', 0.00, 64998772.00, 9967151.00, '1', '1'),
	(53, 6, 59, 232, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0053', 'BC000053', 'Item 53', 'quis ut nostrud labore enim ex adipiscing ex ut ut', 0.00, 91166235.00, 158297985.00, '1', '1'),
	(54, 1, 92, 70, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0054', 'BC000054', 'Item 54', 'exercitation quis sed tempor ea eiusmod minim aliquip ipsum minim', 0.00, 42258931.00, 133667995.00, '0', '1'),
	(55, 3, 51, 41, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0055', 'BC000055', 'Item 55', 'do consectetur sit laboris labore consectetur adipiscing incididunt sit ipsum', 0.00, 104869961.00, 133511464.00, '0', '1'),
	(56, 6, 19, 155, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0056', 'BC000056', 'Item 56', 'ut adipiscing do ut ipsum adipiscing dolor nisi do nisi', 0.00, 128356941.00, 77215584.00, '1', '1'),
	(57, 3, 79, 224, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0057', 'BC000057', 'Item 57', 'Lorem ad exercitation ad labore ut enim veniam aliquip consequat', 0.00, 31043082.00, 41278285.00, '1', '1'),
	(58, 3, 78, 318, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0058', 'BC000058', 'Item 58', 'veniam aliqua veniam nostrud magna aliquip labore ex sed sit', 0.00, 7844084.00, 85055493.00, '0', '1'),
	(59, 4, 63, 236, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0059', 'BC000059', 'Item 59', 'commodo sed do commodo eiusmod aliquip aliquip ut ipsum minim', 0.00, 116117614.00, 42029573.00, '1', '1'),
	(60, 2, 76, 5, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0060', 'BC000060', 'Item 60', 'eiusmod magna enim eiusmod consectetur ea ipsum consequat minim aliquip', 0.00, 106474932.00, 60898490.00, '0', '1'),
	(61, 6, 3, 309, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0061', 'BC000061', 'Item 61', 'consequat Lorem Lorem Ut laboris incididunt incididunt ut Ut laboris', 0.00, 127121257.00, 90861610.00, '0', '1'),
	(62, 3, 40, 31, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0062', 'BC000062', 'Item 62', 'ut et ea Lorem commodo exercitation adipiscing amet adipiscing exercitation', 0.00, 158258913.00, 89090488.00, '1', '1'),
	(63, 6, 38, 279, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0063', 'BC000063', 'Item 63', 'aliqua nisi dolor adipiscing adipiscing ipsum incididunt adipiscing commodo ipsum', 0.00, 20191733.00, 145396889.00, '0', '1'),
	(64, 5, 87, 192, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0064', 'BC000064', 'Item 64', 'consectetur ut eiusmod adipiscing sed tempor consequat ipsum ad labore', 0.00, 31555999.00, 152080367.00, '0', '1'),
	(65, 5, 81, 326, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0065', 'BC000065', 'Item 65', 'magna aliqua magna veniam eiusmod consequat aliqua eiusmod elit nostrud', 0.00, 134188964.00, 74812900.00, '0', '1'),
	(66, 7, 47, 395, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0066', 'BC000066', 'Item 66', 'adipiscing consectetur ut magna nostrud ea adipiscing incididunt tempor Lorem', 0.00, 48696658.00, 29267965.00, '0', '1'),
	(67, 7, 26, 232, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0067', 'BC000067', 'Item 67', 'do ullamco laboris sit nostrud nostrud laboris enim ut tempor', 0.00, 1592934.00, 117403942.00, '0', '1'),
	(68, 7, 44, 379, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0068', 'BC000068', 'Item 68', 'quis ut enim enim enim nostrud veniam ea Ut minim', 0.00, 64455308.00, 49128876.00, '1', '1'),
	(69, 7, 59, 114, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0069', 'BC000069', 'Item 69', 'ut dolore exercitation eiusmod Lorem eiusmod eiusmod ut incididunt ex', 0.00, 82612185.00, 12709717.00, '0', '1'),
	(70, 6, 61, 384, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0070', 'BC000070', 'Item 70', 'veniam aliquip ea veniam labore sed amet nisi sit tempor', 0.00, 105670341.00, 154628662.00, '0', '1'),
	(71, 1, 94, 269, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0071', 'BC000071', 'Item 71', 'et dolor ex ut amet ut eiusmod enim incididunt aliqua', 0.00, 21441512.00, 117916114.00, '0', '1'),
	(72, 7, 28, 392, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0072', 'BC000072', 'Item 72', 'enim ut tempor veniam ipsum aliqua labore elit ea do', 0.00, 131958843.00, 35724876.00, '0', '1'),
	(73, 3, 54, 182, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0073', 'BC000073', 'Item 73', 'Lorem minim dolore magna consectetur incididunt enim commodo dolore ut', 0.00, 88015942.00, 111542443.00, '0', '1'),
	(74, 6, 18, 149, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0074', 'BC000074', 'Item 74', 'sed tempor ipsum sit ut ullamco enim do aliqua veniam', 0.00, 149297904.00, 28015641.00, '0', '1'),
	(75, 3, 89, 317, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0075', 'BC000075', 'Item 75', 'aliqua veniam ipsum ut nisi labore veniam ad veniam consequat', 0.00, 63809447.00, 55164707.00, '1', '1'),
	(76, 3, 37, 266, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0076', 'BC000076', 'Item 76', 'aliquip ad enim adipiscing ex ipsum sed ullamco nisi amet', 0.00, 19318618.00, 116055088.00, '1', '1'),
	(77, 5, 15, 27, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0077', 'BC000077', 'Item 77', 'Ut Lorem incididunt sed do do consequat aliqua ut elit', 0.00, 132305584.00, 1576558.00, '0', '1'),
	(78, 2, 64, 227, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0078', 'BC000078', 'Item 78', 'nostrud sit ut consequat tempor veniam consequat magna nisi quis', 0.00, 84133670.00, 93845340.00, '1', '1'),
	(79, 7, 86, 310, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0079', 'BC000079', 'Item 79', 'tempor et do nisi elit ut sit ullamco quis labore', 0.00, 32332663.00, 154202802.00, '1', '1'),
	(80, 3, 32, 73, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0080', 'BC000080', 'Item 80', 'ea ullamco ex laboris adipiscing commodo exercitation incididunt ipsum consectetur', 0.00, 137768513.00, 29184035.00, '1', '1'),
	(81, 1, 47, 300, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0081', 'BC000081', 'Item 81', 'eiusmod ut consectetur sit sed aliquip Ut aliqua Lorem Lorem', 0.00, 56097302.00, 461887.00, '0', '1'),
	(82, 1, 17, 206, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0082', 'BC000082', 'Item 82', 'exercitation eiusmod tempor labore quis amet amet incididunt Ut dolore', 0.00, 41028718.00, 87291934.00, '0', '1'),
	(83, 5, 94, 84, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0083', 'BC000083', 'Item 83', 'enim elit amet eiusmod enim commodo elit amet magna commodo', 0.00, 35576784.00, 131986188.00, '0', '1'),
	(84, 7, 65, 303, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0084', 'BC000084', 'Item 84', 'do labore quis tempor consectetur incididunt enim aliqua sit consequat', 0.00, 74491094.00, 55891942.00, '1', '1'),
	(85, 6, 30, 221, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0085', 'BC000085', 'Item 85', 'incididunt elit nisi ea nisi nisi elit et magna eiusmod', 0.00, 160617364.00, 32240430.00, '0', '1'),
	(86, 2, 45, 367, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0086', 'BC000086', 'Item 86', 'amet adipiscing exercitation magna magna commodo et magna nisi tempor', 0.00, 169122792.00, 39573483.00, '1', '1'),
	(87, 3, 76, 143, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0087', 'BC000087', 'Item 87', 'laboris enim consequat ipsum tempor nisi laboris quis nostrud ut', 0.00, 124952493.00, 81473226.00, '0', '1'),
	(88, 1, 42, 44, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0088', 'BC000088', 'Item 88', 'ullamco Lorem labore magna sit tempor eiusmod ullamco consectetur dolore', 0.00, 532090.00, 160613426.00, '1', '1'),
	(89, 7, 76, 40, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0089', 'BC000089', 'Item 89', 'quis aliquip laboris veniam enim ut ad exercitation Lorem ipsum', 0.00, 28539902.00, 49670934.00, '1', '1'),
	(90, 1, 82, 116, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0090', 'BC000090', 'Item 90', 'laboris elit elit nisi commodo elit ut adipiscing adipiscing laboris', 0.00, 88567088.00, 90029707.00, '0', '1'),
	(91, 6, 50, 209, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0091', 'BC000091', 'Item 91', 'ut Ut minim enim laboris quis aliquip consectetur laboris ex', 0.00, 42470488.00, 155541475.00, '0', '1'),
	(92, 2, 1, 78, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0092', 'BC000092', 'Item 92', 'minim enim ex eiusmod nostrud sit Ut laboris magna dolor', 0.00, 48122159.00, 89812489.00, '1', '1'),
	(93, 1, 35, 273, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0093', 'BC000093', 'Item 93', 'adipiscing et adipiscing adipiscing ipsum veniam sit magna ad labore', 0.00, 104381048.00, 87123706.00, '1', '1'),
	(94, 7, 40, 137, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0094', 'BC000094', 'Item 94', 'quis enim ullamco nostrud ipsum dolore ad nisi consequat commodo', 0.00, 152686823.00, 54383453.00, '1', '1'),
	(95, 6, 34, 76, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0095', 'BC000095', 'Item 95', 'ipsum sed et dolore et labore commodo magna amet labore', 0.00, 28774252.00, 116660084.00, '1', '1'),
	(96, 1, 25, 362, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0096', 'BC000096', 'Item 96', 'quis enim ipsum adipiscing ut consequat ipsum ullamco Lorem eiusmod', 0.00, 136798958.00, 75177892.00, '0', '1'),
	(97, 1, 69, 372, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0097', 'BC000097', 'Item 97', 'et sit do ea adipiscing veniam tempor aliqua labore do', 0.00, 58001420.00, 128558100.00, '1', '1'),
	(98, 5, 91, 132, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0098', 'BC000098', 'Item 98', 'enim ex magna exercitation minim Ut sit dolor ex laboris', 0.00, 137950484.00, 147735487.00, '0', '1'),
	(99, 7, 2, 153, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0099', 'BC000099', 'Item 99', 'incididunt laboris minim veniam dolore enim et minim nostrud elit', 0.00, 105135089.00, 139945440.00, '0', '1'),
	(100, 4, 54, 283, 1, '2025-03-06 17:39:14', '2025-03-06 17:39:14', 'ITM0100', 'BC000100', 'Item 100', 'do ullamco labore do ullamco ex labore Lorem nostrud aliquip', 0.00, 69993747.00, 41932753.00, '1', '1');

-- Dumping structure for table db_p48_ars.tbl_m_item_hist
DROP TABLE IF EXISTS `tbl_m_item_hist`;
CREATE TABLE IF NOT EXISTS `tbl_m_item_hist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL DEFAULT 0,
  `id_gudang` int(11) DEFAULT 1,
  `id_perusahaan` int(11) DEFAULT 0,
  `id_pelanggan` int(11) DEFAULT 0,
  `id_supplier` int(11) DEFAULT 0,
  `id_penjualan` int(11) DEFAULT 0,
  `id_pembelian` int(11) DEFAULT 0,
  `id_pembelian_det` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `id_so` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `no_nota` varchar(100) DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `sn` text DEFAULT NULL,
  `nominal` decimal(10,2) DEFAULT 0.00,
  `jml` int(11) DEFAULT 0,
  `jml_satuan` int(11) DEFAULT 1,
  `satuan` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2','3','4','5','6','7','8') DEFAULT '0' COMMENT '1 = Stok Masuk Pembelian\\\\\\\\r\\\\\\\\n2 = Stok Masuk\\\\\\\\r\\\\\\\\n3 = Stok Masuk Retur Jual\\\\\\\\r\\\\\\\\n4 = Stok Keluar Penjualan\\\\\\\\r\\\\\\\\n5 = Stok Keluar Retur Beli\\\\\\\\r\\\\\\\\n6 = SO\\\\\\\\r\\\\\\\\n7 = Stok Keluar\\\\\\\\r\\\\\\\\n8 = Mutasi Antar Gd',
  `sp` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_item_hist_tbl_m_item` (`id_item`),
  CONSTRAINT `FK_tbl_m_item_hist_tbl_m_item` FOREIGN KEY (`id_item`) REFERENCES `tbl_m_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_item_hist: ~0 rows (approximately)
DELETE FROM `tbl_m_item_hist`;

-- Dumping structure for table db_p48_ars.tbl_m_item_stok
DROP TABLE IF EXISTS `tbl_m_item_stok`;
CREATE TABLE IF NOT EXISTS `tbl_m_item_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL DEFAULT 0,
  `id_gudang` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `jml` float DEFAULT 0,
  `jml_satuan` float DEFAULT 1,
  `satuan` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `sp` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_item_stok_tbl_m_item` (`id_item`),
  CONSTRAINT `FK_tbl_m_item_stok_tbl_m_item` FOREIGN KEY (`id_item`) REFERENCES `tbl_m_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_item_stok: ~0 rows (approximately)
DELETE FROM `tbl_m_item_stok`;
INSERT INTO `tbl_m_item_stok` (`id`, `id_item`, `id_gudang`, `id_satuan`, `id_user`, `tgl_simpan`, `tgl_modif`, `jml`, `jml_satuan`, `satuan`, `keterangan`, `status`, `sp`) VALUES
	(1, 16, 1, 5, 0, '2025-03-06 10:40:04', '2025-03-06 17:40:04', 0, 1, 'Roll', NULL, '1', '0');

-- Dumping structure for table db_p48_ars.tbl_m_item_stok_det
DROP TABLE IF EXISTS `tbl_m_item_stok_det`;
CREATE TABLE IF NOT EXISTS `tbl_m_item_stok_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) NOT NULL DEFAULT 0,
  `id_item_stok` int(11) NOT NULL DEFAULT 0,
  `id_pembelian` int(11) DEFAULT 0,
  `id_pembelian_det` int(11) DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `jml` int(11) DEFAULT 0,
  `jml_satuan` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_item_stok_det_tbl_m_item_stok` (`id_item_stok`),
  CONSTRAINT `FK_tbl_m_item_stok_det_tbl_m_item_stok` FOREIGN KEY (`id_item_stok`) REFERENCES `tbl_m_item_stok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_item_stok_det: ~0 rows (approximately)
DELETE FROM `tbl_m_item_stok_det`;

-- Dumping structure for table db_p48_ars.tbl_m_jabatan
DROP TABLE IF EXISTS `tbl_m_jabatan`;
CREATE TABLE IF NOT EXISTS `tbl_m_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data jabatan';

-- Dumping data for table db_p48_ars.tbl_m_jabatan: ~14 rows (approximately)
DELETE FROM `tbl_m_jabatan`;
INSERT INTO `tbl_m_jabatan` (`id`, `id_user`, `tgl_simpan`, `kode`, `jabatan`) VALUES
	(1, 41, '2023-09-19 22:14:51', 'OWN', 'OWNER'),
	(2, 41, '2023-09-19 22:14:51', 'DIR', 'DIREKTUR UTAMA'),
	(3, 41, '2023-09-19 22:14:51', 'WDR', 'WAKIL DIREKTUR'),
	(4, 41, '2023-09-19 22:14:51', 'KOM', 'KOMISARIS'),
	(5, 41, '2023-09-19 22:14:51', 'MNG', 'MANAGER'),
	(6, 41, '2023-09-19 22:14:51', 'SPV', 'SUPERVISOR'),
	(7, 41, '2023-09-19 22:14:51', 'STF', 'STAFF ADMIN'),
	(8, 41, '2023-09-19 22:14:51', 'PJK', 'STAFF PAJAK'),
	(9, 41, '2023-09-19 22:14:51', 'GD', 'STAFF GUDANG'),
	(10, 41, '2023-09-19 22:14:51', 'SK', 'STAFF KEUANGAN'),
	(11, 41, '2023-09-19 22:14:51', 'SA', 'STAFF AKUNTING'),
	(12, 41, '2023-09-19 22:14:51', 'SP', 'STAFF PURCHASING'),
	(13, 41, '2023-09-19 22:14:51', 'HR', 'SPV HRD'),
	(14, 41, '2023-09-19 22:14:51', 'HR', 'STAFF HRD');

-- Dumping structure for table db_p48_ars.tbl_m_jenis_kerja
DROP TABLE IF EXISTS `tbl_m_jenis_kerja`;
CREATE TABLE IF NOT EXISTS `tbl_m_jenis_kerja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_jenis_kerja: ~51 rows (approximately)
DELETE FROM `tbl_m_jenis_kerja`;
INSERT INTO `tbl_m_jenis_kerja` (`id`, `jenis`, `ket`) VALUES
	(1, 'Pelajar / Mahasiswa', NULL),
	(2, 'Belum / Tidak Bekerja', NULL),
	(3, 'Karyawan Swasta', NULL),
	(4, 'Karyawan BUMN / BUMD Dll', NULL),
	(5, 'PNS', NULL),
	(6, 'TNI / POLRI', NULL),
	(7, 'Profesi', NULL),
	(8, 'Ibu Rumah Tangga', NULL),
	(9, 'Pensiunan', NULL),
	(10, 'Karyawan Honorer', NULL),
	(11, 'Buruh Tani', NULL),
	(12, 'Buruh Harian Lepas', NULL),
	(13, 'Anggota DPR RI', NULL),
	(14, 'Anggota DPD', NULL),
	(15, 'Anggota BPK', NULL),
	(16, 'Gubernur', NULL),
	(17, 'Wakil Gubernur', NULL),
	(18, 'Bupati', NULL),
	(19, 'Wakil Bupati', NULL),
	(20, 'Walikota', NULL),
	(21, 'Wakil Walikota', NULL),
	(22, 'Anggota DPRD Provinsi', NULL),
	(23, 'Anggota DPRD Kab/Kota', NULL),
	(24, 'Dosen', NULL),
	(25, 'Guru', NULL),
	(26, 'Pilot', NULL),
	(27, 'Pengacara', NULL),
	(28, 'Notaris', NULL),
	(29, 'Arsitek', NULL),
	(30, 'Dokter', NULL),
	(31, 'Bidan', NULL),
	(32, 'Perawat', NULL),
	(33, 'Polisi', NULL),
	(34, 'TNI', NULL),
	(35, 'Apoteker', NULL),
	(36, 'Psikiater/Psikolog', NULL),
	(37, 'Pelaut', NULL),
	(38, 'Supir', NULL),
	(39, 'Peneliti', NULL),
	(40, 'Pedagang', NULL),
	(41, 'Pendeta', NULL),
	(42, 'Ustadz', NULL),
	(43, 'Wiraswasta', NULL),
	(44, 'Kepala Desa', NULL),
	(45, 'Konstruksi', NULL),
	(46, 'Peternak', NULL),
	(47, 'Presiden', NULL),
	(48, 'Wakil Presiden', NULL),
	(49, 'Seniman', NULL),
	(50, 'Wartawan', NULL),
	(51, 'Residen', NULL);

-- Dumping structure for table db_p48_ars.tbl_m_karyawan
DROP TABLE IF EXISTS `tbl_m_karyawan`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) unsigned DEFAULT 0,
  `id_user_group` int(4) DEFAULT 0,
  `id_perusahaan` int(4) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nama_blk` varchar(100) DEFAULT NULL,
  `jns_klm` enum('L','P') DEFAULT 'L',
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `alamat_dom` text DEFAULT NULL,
  `tmp_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `file_name` varchar(160) DEFAULT NULL,
  `file_ext` varchar(10) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=perawat\\r\\n2=dokter\\r\\n3=kasir\\r\\n4=analis\\r\\n5=radiografer\\r\\n6=farmasi',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tbl_m_karyawan_tbl_ion_users` (`id_user`),
  CONSTRAINT `FK_tbl_m_karyawan_tbl_ion_users` FOREIGN KEY (`id_user`) REFERENCES `tbl_ion_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_karyawan: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan`;
INSERT INTO `tbl_m_karyawan` (`id`, `id_user`, `id_user_group`, `id_perusahaan`, `tgl_simpan`, `tgl_modif`, `kode`, `nik`, `nama`, `nama_blk`, `jns_klm`, `no_hp`, `alamat`, `alamat_dom`, `tmp_lahir`, `tgl_lahir`, `file_name`, `file_ext`, `file_type`, `status`) VALUES
	(1, 1, 2, 0, '2022-12-22 22:28:13', '2024-06-23 21:03:06', 'PG-001', '337407150292002', 'MIKHAEL FELIAN WASKITO', '', 'L', '085741220427', '-', '-', 'Semarang', '1954-02-02', NULL, NULL, NULL, 0);

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_cuti
DROP TABLE IF EXISTS `tbl_m_karyawan_cuti`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0' COMMENT '0=pend\r\n1=terima\r\n2=tolak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_karyawan_cuti: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_cuti`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_jadwal
DROP TABLE IF EXISTS `tbl_m_karyawan_jadwal`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `id_poli` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `hari_1` varchar(50) DEFAULT NULL,
  `hari_2` varchar(50) DEFAULT NULL,
  `hari_3` varchar(50) DEFAULT NULL,
  `hari_4` varchar(50) DEFAULT NULL,
  `hari_5` varchar(50) DEFAULT NULL,
  `hari_6` varchar(50) DEFAULT NULL,
  `hari_7` varchar(50) DEFAULT NULL,
  `waktu` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status_prtk` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tbl_m_karyawan_jadwal_tbl_m_karyawan` (`id_karyawan`),
  CONSTRAINT `FK_tbl_m_karyawan_jadwal_tbl_m_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_m_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data riwayat sertifikasi karyawan';

-- Dumping data for table db_p48_ars.tbl_m_karyawan_jadwal: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_jadwal`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_kel
DROP TABLE IF EXISTS `tbl_m_karyawan_kel`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_kel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `nm_ayah` varchar(160) DEFAULT NULL,
  `nm_ibu` varchar(160) DEFAULT NULL,
  `nm_pasangan` varchar(160) DEFAULT NULL,
  `nm_anak` text DEFAULT NULL,
  `tgl_lhr_ayah` date DEFAULT NULL,
  `tgl_lhr_ibu` date DEFAULT NULL,
  `tgl_lhr_psg` date DEFAULT NULL,
  `jns_pasangan` enum('0','1','2') DEFAULT '0',
  `file_name` varchar(160) DEFAULT NULL,
  `file_name_ktp` varchar(160) DEFAULT NULL,
  `file_ext` varchar(160) DEFAULT NULL,
  `file_ext_ktp` varchar(160) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_type_ktp` varchar(50) DEFAULT NULL,
  `status_kawin` enum('0','1','2','3') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_karyawan_kel: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_kel`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_peg
DROP TABLE IF EXISTS `tbl_m_karyawan_peg`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_peg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `id_dept` int(11) DEFAULT 0,
  `id_jabatan` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `no_bpjs_tk` varchar(50) DEFAULT NULL,
  `no_bpjs_ks` varchar(50) DEFAULT NULL,
  `no_npwp` varchar(50) DEFAULT NULL,
  `no_ptkp` varchar(5) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tipe` int(11) DEFAULT 0 COMMENT 'Status karyawan kotrak, dll',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_karyawan_peg_tbl_m_karyawan` (`id_karyawan`),
  CONSTRAINT `FK_tbl_m_karyawan_peg_tbl_m_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_m_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_karyawan_peg: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_peg`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_pend
DROP TABLE IF EXISTS `tbl_m_karyawan_pend`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_pend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `no_dok` varchar(160) DEFAULT NULL,
  `pendidikan` varchar(160) DEFAULT NULL,
  `jurusan` varchar(160) DEFAULT NULL,
  `instansi` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `thn_masuk` year(4) DEFAULT NULL,
  `thn_keluar` year(4) DEFAULT NULL,
  `file_name` varchar(160) DEFAULT NULL,
  `file_ext` varchar(160) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_base64` longtext DEFAULT NULL,
  `status_lulus` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_karyawan_pend_tbl_m_karyawan` (`id_karyawan`),
  CONSTRAINT `FK_tbl_m_karyawan_pend_tbl_m_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_m_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data riwayat pendidikan karyawan';

-- Dumping data for table db_p48_ars.tbl_m_karyawan_pend: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_pend`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_sert
DROP TABLE IF EXISTS `tbl_m_karyawan_sert`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_sert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `no_dok` varchar(160) DEFAULT NULL,
  `pt` varchar(160) DEFAULT NULL,
  `instansi` varchar(160) DEFAULT NULL,
  `tipe` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `file_name` varchar(160) DEFAULT NULL,
  `file_ext` varchar(160) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_base64` longtext DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tbl_m_karyawan_pend_tbl_m_karyawan` (`id_karyawan`) USING BTREE,
  CONSTRAINT `FK_tbl_m_karyawan_sert_tbl_m_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_m_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data riwayat sertifikasi karyawan';

-- Dumping data for table db_p48_ars.tbl_m_karyawan_sert: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_sert`;

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_tipe
DROP TABLE IF EXISTS `tbl_m_karyawan_tipe`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_karyawan_tipe: ~3 rows (approximately)
DELETE FROM `tbl_m_karyawan_tipe`;
INSERT INTO `tbl_m_karyawan_tipe` (`id`, `kode`, `tipe`, `status`) VALUES
	(1, NULL, 'Tetap', '1'),
	(2, NULL, 'Kontrak', '1'),
	(3, NULL, 'Mitra', '1');

-- Dumping structure for table db_p48_ars.tbl_m_kategori
DROP TABLE IF EXISTS `tbl_m_kategori`;
CREATE TABLE IF NOT EXISTS `tbl_m_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` datetime DEFAULT current_timestamp(),
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=disabled;\r\n1=aktif;',
  `tipe` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_kategori: ~95 rows (approximately)
DELETE FROM `tbl_m_kategori`;
INSERT INTO `tbl_m_kategori` (`id`, `tgl_simpan`, `tgl_modif`, `kode`, `kategori`, `keterangan`, `status`, `tipe`) VALUES
	(1, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '001', 'LAPTOP/NOTEBOOK', NULL, '1', 0),
	(2, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '002', 'PC DEKSTOP', NULL, '1', 0),
	(3, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '003', 'PC AIO', NULL, '1', 0),
	(4, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '004', 'MONITOR', NULL, '1', 0),
	(5, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '005', 'PROFESIONAL DISPLAY', NULL, '1', 0),
	(6, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '006', 'VIDEOWALL', NULL, '1', 0),
	(7, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '007', 'VIDEOTRON', NULL, '1', 0),
	(8, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '008', 'DIGITAL SIGNAGE', NULL, '1', 0),
	(9, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '009', 'MODEM', NULL, '1', 0),
	(10, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '010', 'KVM', NULL, '1', 0),
	(11, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '011', 'SPEAKER', NULL, '1', 0),
	(12, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '012', 'WEBCAM', NULL, '1', 0),
	(13, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '013', 'KEYBOARD', NULL, '1', 0),
	(14, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '014', 'MOUSE', NULL, '1', 0),
	(15, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '015', 'PRINTER DOT MATRIX', NULL, '1', 0),
	(16, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '016', 'PRINTER THERMAL', NULL, '1', 0),
	(17, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '017', 'PRINTER 3D', NULL, '1', 0),
	(18, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '018', 'AKSESORIES DAN SPAREPART PRINTER', NULL, '1', 0),
	(19, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '019', 'PRINTER INKJET', NULL, '1', 0),
	(20, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '020', 'PRINTER LASER', NULL, '1', 0),
	(21, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '021', 'SCANNER DOKUMEN', NULL, '1', 0),
	(22, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '022', 'SCANNER BIOMETRIX', NULL, '1', 0),
	(23, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '023', 'SCANNER DATA', NULL, '1', 0),
	(24, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '024', 'AKSESORIS DAN SPAREPART SCANNER', NULL, '1', 0),
	(25, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '025', 'DRAWING DEVICE', NULL, '1', 0),
	(26, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '026', 'HDD/SSD EXTERNAL/PORTABLE', NULL, '1', 0),
	(27, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '027', 'HDD/SSD INTERNAL', NULL, '1', 0),
	(28, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '028', 'USB FLASDISK/DRIVE', NULL, '1', 0),
	(29, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '029', 'MEMORY CARD', NULL, '1', 0),
	(30, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '030', 'STABILIZER', NULL, '1', 0),
	(31, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '031', 'KIOSK AND OPTIONS', NULL, '1', 0),
	(32, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '032', 'UPS/POWER BACK UP', NULL, '1', 0),
	(33, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '033', 'KAMERA MIRRORLESS', NULL, '1', 0),
	(34, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '034', 'KAMERA PROSUMER', NULL, '1', 0),
	(35, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '035', 'KAMERA POCKET', NULL, '1', 0),
	(36, '2024-09-21 22:46:32', '2024-09-21 23:14:41', '036', 'KAMERA DSLR', NULL, '1', 0),
	(37, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '037', 'ACTION CAM', NULL, '1', 0),
	(38, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '038', 'CAMCORDER', NULL, '1', 0),
	(39, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '039', 'TRIPOD/MONOPOD', NULL, '1', 0),
	(40, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '040', 'LENSA KAMERA', NULL, '1', 0),
	(41, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '041', 'LIGHTING', NULL, '1', 0),
	(42, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '042', 'DRONE', NULL, '1', 0),
	(43, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '043', 'RECORDER', NULL, '1', 0),
	(44, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '044', 'CAMERA CCTV', NULL, '1', 0),
	(45, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '045', 'VOICE RECORDER', NULL, '1', 0),
	(46, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '046', 'DRY BOXES/DRY CABINET', NULL, '1', 0),
	(47, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '047', 'SMARTPHONE', NULL, '1', 0),
	(48, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '048', 'TABLET', NULL, '1', 0),
	(49, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '049', 'RADIO DEVICE', NULL, '1', 0),
	(50, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '050', 'IP PHONE', NULL, '1', 0),
	(51, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '051', 'AUDIO/VIDEO CONFERENCE', NULL, '1', 0),
	(52, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '052', 'PERANGKAT TELEPON', NULL, '1', 0),
	(53, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '053', 'PABX', NULL, '1', 0),
	(54, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '054', 'GPS', NULL, '1', 0),
	(55, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '055', 'HEADSET', NULL, '1', 0),
	(56, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '056', 'MESIN ABSENSI DAN ACCES CONTROL', NULL, '1', 0),
	(57, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '057', 'MESIN JILID', NULL, '1', 0),
	(58, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '058', 'MESIN LAMINATING', NULL, '1', 0),
	(59, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '059', 'MESIN PENGHITUNG UANG', NULL, '1', 0),
	(60, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '060', 'MESIN PEMOTONG KERTAS', NULL, '1', 0),
	(61, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '061', 'MESIN PENGHANCUR', NULL, '1', 0),
	(62, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '062', 'PROYEKTOR', NULL, '1', 0),
	(63, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '063', 'LAYAR PROYEKTOR / SCREEN', NULL, '1', 0),
	(64, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '064', 'PAPAN TULIS ELECTRIC/COPYBOARD', NULL, '1', 0),
	(65, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '065', 'PAPAN TULIS INTERAKTIF', NULL, '1', 0),
	(66, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '066', 'LASER POINTER', NULL, '1', 0),
	(67, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '067', 'AUDIO/VIDEO SWITCH BOX', NULL, '1', 0),
	(68, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '068', 'TELEVISI DAN AKSESORIES', NULL, '1', 0),
	(69, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '069', 'KULKAS', NULL, '1', 0),
	(70, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '070', 'KOMPOR LISTRIK', NULL, '1', 0),
	(71, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '071', 'MICROWAVE', NULL, '1', 0),
	(72, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '072', 'VACUUM CLEANERS', NULL, '1', 0),
	(73, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '073', 'DISPENSER', NULL, '1', 0),
	(74, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '074', 'WATER PURIFIER/HEATER', NULL, '1', 0),
	(75, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '075', 'MESIN KETIK ELEKTRIK', NULL, '1', 0),
	(76, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '076', 'MESIN FOTOKOPI', NULL, '1', 0),
	(77, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '077', 'AIR CONDITIONER', NULL, '1', 0),
	(78, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '078', 'KIPAS ANGIN', NULL, '1', 0),
	(79, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '079', 'AIR PURIFIER', NULL, '1', 0),
	(80, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '080', 'HUMIDIFIER', NULL, '1', 0),
	(81, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '081', 'DIFFUSER', NULL, '1', 0),
	(82, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '082', 'AUDIO PORTABLE', NULL, '1', 0),
	(83, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '083', 'CONSUMABLE MESIN FOTOCOPY', NULL, '1', 0),
	(84, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '084', 'CONSUMABLE PRINTER', NULL, '1', 0),
	(85, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '085', 'SERVER', NULL, '1', 0),
	(86, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '086', 'SERVER STORAGE', NULL, '1', 0),
	(87, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '087', 'RACK SYSTEM', NULL, '1', 0),
	(88, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '088', 'NETWORK CARD', NULL, '1', 0),
	(89, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '089', 'NETWORK CONNECTOR DAN CONVERTER', NULL, '1', 0),
	(90, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '090', 'NETWORK ACCESORIES', NULL, '1', 0),
	(91, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '091', 'NETWORK SECURITY', NULL, '1', 0),
	(92, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '092', 'ROUTER', NULL, '1', 0),
	(93, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '093', 'ACCES POINT DAN CONTROLLER', NULL, '1', 0),
	(94, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '094', 'SWITCH/HUB', NULL, '1', 0),
	(95, '2024-09-21 22:46:32', '2024-09-21 23:14:42', '095', 'SOUND SYSTEM', NULL, '1', 0);

-- Dumping structure for table db_p48_ars.tbl_m_kategori_cuti
DROP TABLE IF EXISTS `tbl_m_kategori_cuti`;
CREATE TABLE IF NOT EXISTS `tbl_m_kategori_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_kategori_cuti: ~3 rows (approximately)
DELETE FROM `tbl_m_kategori_cuti`;
INSERT INTO `tbl_m_kategori_cuti` (`id`, `tipe`, `status`) VALUES
	(1, 'Cuti', 1),
	(2, 'Ijin', 1),
	(3, 'Dinas Luar', 1);

-- Dumping structure for table db_p48_ars.tbl_m_merk
DROP TABLE IF EXISTS `tbl_m_merk`;
CREATE TABLE IF NOT EXISTS `tbl_m_merk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `merk` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=disabled;\\r\\n1=aktif;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_merk: ~416 rows (approximately)
DELETE FROM `tbl_m_merk`;
INSERT INTO `tbl_m_merk` (`id`, `tgl_simpan`, `tgl_modif`, `kode`, `merk`, `keterangan`, `status`) VALUES
	(1, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '001', 'ABBARACK', NULL, '1'),
	(2, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '002', 'ABACUS', NULL, '1'),
	(3, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '003', 'ACER', NULL, '1'),
	(4, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '004', 'APACER', NULL, '1'),
	(5, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '005', 'AUDAC', NULL, '1'),
	(6, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '006', 'ACMIC', NULL, '1'),
	(7, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '007', 'ADVAN', NULL, '1'),
	(8, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '008', 'ADVANCE', NULL, '1'),
	(9, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '009', 'ADATA', NULL, '1'),
	(10, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '010', 'ADOBE', NULL, '1'),
	(11, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '011', 'ADITECH', NULL, '1'),
	(12, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '012', 'ADNET', NULL, '1'),
	(13, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '013', 'ARKADIA', NULL, '1'),
	(14, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '014', 'AUROMAGE', NULL, '1'),
	(15, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '015', 'AUBERN', NULL, '1'),
	(16, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '016', 'AUDIO TECHNICA', NULL, '1'),
	(17, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '017', 'AVER', NULL, '1'),
	(18, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '018', 'ASUS', NULL, '1'),
	(19, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '019', 'APPLE', NULL, '1'),
	(20, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '020', 'AXIOO', NULL, '1'),
	(21, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '021', 'ASUSTOR', NULL, '1'),
	(22, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '022', 'APC', NULL, '1'),
	(23, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '023', 'ARUBA', NULL, '1'),
	(24, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '024', 'ALLIED TELESIS', NULL, '1'),
	(25, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '025', 'ALINCO', NULL, '1'),
	(26, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '026', 'AXEL', NULL, '1'),
	(27, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '027', 'APEXEL', NULL, '1'),
	(28, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '028', 'ATEM', NULL, '1'),
	(29, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '029', 'ATEN', NULL, '1'),
	(30, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '030', 'AMPHENOL', NULL, '1'),
	(31, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '031', 'ASHLEY', NULL, '1'),
	(32, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '032', 'AVIGILON', NULL, '1'),
	(33, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '033', 'AKG', NULL, '1'),
	(34, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '034', 'ARTUGO', NULL, '1'),
	(35, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '035', 'AVISION', NULL, '1'),
	(36, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '036', 'AQUA', NULL, '1'),
	(37, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '037', 'BENQ', NULL, '1'),
	(38, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '038', 'BROTHER', NULL, '1'),
	(39, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '039', 'BARETONE', NULL, '1'),
	(40, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '040', 'BARDI', NULL, '1'),
	(41, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '041', 'BAFO', NULL, '1'),
	(42, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '042', 'BLACK SPIDER', NULL, '1'),
	(43, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '043', 'BASEUS', NULL, '1'),
	(44, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '044', 'BARCO', NULL, '1'),
	(45, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '045', 'BARRACUDA', NULL, '1'),
	(46, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '046', 'BELYST', NULL, '1'),
	(47, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '047', 'BELDEN', NULL, '1'),
	(48, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '048', 'BEHRINGER', NULL, '1'),
	(49, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '049', 'BEIKE', NULL, '1'),
	(50, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '050', 'BENRO', NULL, '1'),
	(51, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '051', 'BETAVO', NULL, '1'),
	(52, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '052', 'BEELINK', NULL, '1'),
	(53, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '053', 'BEEX', NULL, '1'),
	(54, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '054', 'BETAVO', NULL, '1'),
	(55, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '055', 'BEZZEL', NULL, '1'),
	(56, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '056', 'BMB', NULL, '1'),
	(57, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '057', 'BLACKMAGIC DESIGN', NULL, '1'),
	(58, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '058', 'BIO RAD', NULL, '1'),
	(59, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '059', 'BIOSTAR', NULL, '1'),
	(60, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '060', 'BILICO', NULL, '1'),
	(61, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '061', 'BITEC', NULL, '1'),
	(62, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '062', 'BUSHNELL', NULL, '1'),
	(63, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '063', 'BOSCH', NULL, '1'),
	(64, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '064', 'BOSE', NULL, '1'),
	(65, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '065', 'BOXLIGHT', NULL, '1'),
	(66, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '066', 'BOYA', NULL, '1'),
	(67, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '067', 'BOLDE', NULL, '1'),
	(68, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '068', 'BRITE', NULL, '1'),
	(69, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '069', 'BLUEPRINT', NULL, '1'),
	(70, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '070', 'CANON', NULL, '1'),
	(71, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '071', 'CORSAIR', NULL, '1'),
	(72, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '072', 'CANARE', NULL, '1'),
	(73, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '073', 'CISCO', NULL, '1'),
	(74, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '074', 'COOCAA', NULL, '1'),
	(75, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '075', 'CASIO', NULL, '1'),
	(76, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '076', 'CANVA', NULL, '1'),
	(77, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '077', 'CASELL', NULL, '1'),
	(78, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '078', 'CAFELER', NULL, '1'),
	(79, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '079', 'CAMELION', NULL, '1'),
	(80, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '080', 'CITIZENT', NULL, '1'),
	(81, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '081', 'CINETREACK', NULL, '1'),
	(82, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '082', 'COLORFUL', NULL, '1'),
	(83, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '083', 'CRIMSON', NULL, '1'),
	(84, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '084', 'COSMOS', NULL, '1'),
	(85, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '085', 'CHANGHONG', NULL, '1'),
	(86, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '086', 'DATAPRINT', NULL, '1'),
	(87, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '087', 'DAIKIN', NULL, '1'),
	(88, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '088', 'DAHUA', NULL, '1'),
	(89, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '089', 'DATALITE', NULL, '1'),
	(90, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '090', 'DATATRON', NULL, '1'),
	(91, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '091', 'DATACARD', NULL, '1'),
	(92, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '092', 'DAT', NULL, '1'),
	(93, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '093', 'DANUMAYA', NULL, '1'),
	(94, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '094', 'DATAFILE', NULL, '1'),
	(95, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '095', 'DAICHIBAN', NULL, '1'),
	(96, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '096', 'DAITO', NULL, '1'),
	(97, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '097', 'DALCOM', NULL, '1'),
	(98, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '098', 'DAIMITSU', NULL, '1'),
	(99, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '099', 'DALTON', NULL, '1'),
	(100, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '100', 'DASCOM', NULL, '1'),
	(101, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '101', 'DELL', NULL, '1'),
	(102, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '102', 'DELTA', NULL, '1'),
	(103, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '103', 'DELONGHI', NULL, '1'),
	(104, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '104', 'DESVIEW', NULL, '1'),
	(105, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '105', 'DESNET', NULL, '1'),
	(106, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '106', 'DENPOO', NULL, '1'),
	(107, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '107', 'DOLCE', NULL, '1'),
	(108, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '108', 'DECO', NULL, '1'),
	(109, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '109', 'DEITY', NULL, '1'),
	(110, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '110', 'DENON', NULL, '1'),
	(111, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '111', 'DEKKSON', NULL, '1'),
	(112, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '112', 'DELTONS', NULL, '1'),
	(113, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '113', 'DIGILIGHT', NULL, '1'),
	(114, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '114', 'DIGITALPRO', NULL, '1'),
	(115, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '115', 'DJI', NULL, '1'),
	(116, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '116', 'DOLBY', NULL, '1'),
	(117, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '117', 'DONATI', NULL, '1'),
	(118, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '118', 'DYNABOOK', NULL, '1'),
	(119, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '119', 'DOCUPRINT', NULL, '1'),
	(120, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '120', 'EATON', NULL, '1'),
	(121, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '121', 'EBARA', NULL, '1'),
	(122, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '122', 'ELECTROLUX', NULL, '1'),
	(123, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '123', 'ECOHOME', NULL, '1'),
	(124, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '124', 'EDCON', NULL, '1'),
	(125, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '125', 'EDUVISION', NULL, '1'),
	(126, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '126', 'EDIFIER', NULL, '1'),
	(127, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '127', 'EDSON', NULL, '1'),
	(128, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '128', 'EFORTA', NULL, '1'),
	(129, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '129', 'EGGEL', NULL, '1'),
	(130, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '130', 'ELITE', NULL, '1'),
	(131, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '131', 'ELECTROCO', NULL, '1'),
	(132, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '132', 'ELITERY', NULL, '1'),
	(133, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '133', 'ELASTEX', NULL, '1'),
	(134, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '134', 'EXTREME', NULL, '1'),
	(135, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '135', 'EMERALD', NULL, '1'),
	(136, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '136', 'ENTRUST', NULL, '1'),
	(137, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '137', 'EPSON', NULL, '1'),
	(138, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '138', 'EPPOS', NULL, '1'),
	(139, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '139', 'EVERCOSS', NULL, '1'),
	(140, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '140', 'ETERNW', NULL, '1'),
	(141, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '141', 'ETERNA', NULL, '1'),
	(142, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '142', 'EROC', NULL, '1'),
	(143, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '143', 'ESET', NULL, '1'),
	(144, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '144', 'EYESEC', NULL, '1'),
	(145, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '145', 'ETIS', NULL, '1'),
	(146, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '146', 'EVOLIS', NULL, '1'),
	(147, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '147', 'EVOVIEW', NULL, '1'),
	(148, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '148', 'EXTRON', NULL, '1'),
	(149, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '149', 'EXPO', NULL, '1'),
	(150, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '150', 'EZCAP', NULL, '1'),
	(151, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '151', 'EZVIZ', NULL, '1'),
	(152, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '152', 'EZCAST', NULL, '1'),
	(153, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '153', 'EZMODE', NULL, '1'),
	(154, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '154', 'FARGO', NULL, '1'),
	(155, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '155', 'FALCO', NULL, '1'),
	(156, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '156', 'FANTECH', NULL, '1'),
	(157, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '157', 'FANTONI', NULL, '1'),
	(158, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '158', 'FEELWORLD', NULL, '1'),
	(159, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '159', 'FEIYUTECH', NULL, '1'),
	(160, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '160', 'FUJIFILM', NULL, '1'),
	(161, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '161', 'FEDERAL', NULL, '1'),
	(162, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '162', 'FEIYU', NULL, '1'),
	(163, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '163', 'FINGERSPOT', NULL, '1'),
	(164, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '164', 'FIREFIX', NULL, '1'),
	(165, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '165', 'FUJITSU', NULL, '1'),
	(166, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '166', 'FUJI XEROX', NULL, '1'),
	(167, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '167', 'FORTINET', NULL, '1'),
	(168, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '168', 'FORTIGET', NULL, '1'),
	(169, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '169', 'FONESTAR', NULL, '1'),
	(170, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '170', 'FORTUNARACK', NULL, '1'),
	(171, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '171', 'FOTOPRO', NULL, '1'),
	(172, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '172', 'FORTE', NULL, '1'),
	(173, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '173', 'FORCEPOINT', NULL, '1'),
	(174, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '174', 'FOMAC', NULL, '1'),
	(175, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '175', 'FOCUS', NULL, '1'),
	(176, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '176', 'GARMIN', NULL, '1'),
	(177, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '177', 'GIGABYTE', NULL, '1'),
	(178, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '178', 'GAINTECH', NULL, '1'),
	(179, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '179', 'GTC', NULL, '1'),
	(180, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '180', 'GAMAT', NULL, '1'),
	(181, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '181', 'GEAR', NULL, '1'),
	(182, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '182', 'GELATIK', NULL, '1'),
	(183, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '183', 'GEA', NULL, '1'),
	(184, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '184', 'GEMET', NULL, '1'),
	(185, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '185', 'GETRA', NULL, '1'),
	(186, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '186', 'GENPAC', NULL, '1'),
	(187, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '187', 'GENELEC', NULL, '1'),
	(188, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '188', 'GENIUS', NULL, '1'),
	(189, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '189', 'GESTETNER', NULL, '1'),
	(190, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '190', 'GOLDWIN', NULL, '1'),
	(191, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '191', 'GODOX', NULL, '1'),
	(192, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '192', 'GVM', NULL, '1'),
	(193, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '193', 'GRUNDFOS', NULL, '1'),
	(194, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '194', 'HARDWELL', NULL, '1'),
	(195, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '195', 'HARTECH', NULL, '1'),
	(196, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '196', 'HAGANERACK', NULL, '1'),
	(197, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '197', 'HARMAN KARDON', NULL, '1'),
	(198, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '198', 'HARRIER', NULL, '1'),
	(199, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '199', 'HEWLETT PACKARD', NULL, '1'),
	(200, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '200', 'HEWLETT PACKARD ENTERPRISE', NULL, '1'),
	(201, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '201', 'HERCULES', NULL, '1'),
	(202, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '202', 'HUAWEI', NULL, '1'),
	(203, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '203', 'HUPER', NULL, '1'),
	(204, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '204', 'HIKVISION', NULL, '1'),
	(205, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '205', 'HISENSE', NULL, '1'),
	(206, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '206', 'HITEVISION', NULL, '1'),
	(207, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '207', 'HITACHI', NULL, '1'),
	(208, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '208', 'HILOOK', NULL, '1'),
	(209, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '209', 'HIGHLIGHT', NULL, '1'),
	(210, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '210', 'HIKMICRO', NULL, '1'),
	(211, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '211', 'HIVIEW', NULL, '1'),
	(212, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '212', 'HOLLYLAND', NULL, '1'),
	(213, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '213', 'HORION', NULL, '1'),
	(214, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '214', 'HONEYWELL', NULL, '1'),
	(215, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '215', 'HONORVISION', NULL, '1'),
	(216, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '216', 'HONDA', NULL, '1'),
	(217, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '217', 'HOOSEKI', NULL, '1'),
	(218, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '218', 'IBRIGHT', NULL, '1'),
	(219, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '219', 'ICA', NULL, '1'),
	(220, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '220', 'ICEBOARD', NULL, '1'),
	(221, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '221', 'ICOM', NULL, '1'),
	(222, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '222', 'INDOVISUAL', NULL, '1'),
	(223, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '223', 'IDEAL', NULL, '1'),
	(224, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '224', 'IDEALIFE', NULL, '1'),
	(225, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '225', 'INSIGHT', NULL, '1'),
	(226, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '226', 'INTIMUS', NULL, '1'),
	(227, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '227', 'IMAGO', NULL, '1'),
	(228, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '228', 'INVISION', NULL, '1'),
	(229, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '229', 'INDORACK', NULL, '1'),
	(230, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '230', 'INSTA360', NULL, '1'),
	(231, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '231', 'INTEL', NULL, '1'),
	(232, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '232', 'INFOCUS', NULL, '1'),
	(233, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '233', 'INDOSAT', NULL, '1'),
	(234, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '234', 'INFORMA', NULL, '1'),
	(235, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '235', 'INBEX', NULL, '1'),
	(236, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '236', 'INFINIX', NULL, '1'),
	(237, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '237', 'INFINITY', NULL, '1'),
	(238, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '238', 'INNOLA', NULL, '1'),
	(239, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '239', 'INNOGRAPH', NULL, '1'),
	(240, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '240', 'IP-COM', NULL, '1'),
	(241, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '241', 'ISEMC', NULL, '1'),
	(242, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '242', 'IWARE', NULL, '1'),
	(243, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '243', 'JABRA', NULL, '1'),
	(244, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '244', 'JEMBO', NULL, '1'),
	(245, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '245', 'JOYKO', NULL, '1'),
	(246, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '246', 'KASPERSKY', NULL, '1'),
	(247, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '247', 'KARCHER', NULL, '1'),
	(248, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '248', 'KETTLER', NULL, '1'),
	(249, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '249', 'KENIKA', NULL, '1'),
	(250, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '250', 'KENKO', NULL, '1'),
	(251, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '251', 'KINGSTON', NULL, '1'),
	(252, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '252', 'KIRIN', NULL, '1'),
	(253, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '253', 'KOZURE', NULL, '1'),
	(254, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '254', 'KODAK', NULL, '1'),
	(255, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '255', 'KONICA MINOLTA', NULL, '1'),
	(256, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '256', 'KRAMER', NULL, '1'),
	(257, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '257', 'KREZT', NULL, '1'),
	(258, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '258', 'KYOCERA', NULL, '1'),
	(259, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '259', 'KRISBOW', NULL, '1'),
	(260, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '260', 'LENOVO', NULL, '1'),
	(261, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '261', 'LEXOS', NULL, '1'),
	(262, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '262', 'LEXAR', NULL, '1'),
	(263, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '263', 'LETAEC', NULL, '1'),
	(264, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '264', 'LEICA', NULL, '1'),
	(265, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '265', 'LEITZ', NULL, '1'),
	(266, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '266', 'LIBERA', NULL, '1'),
	(267, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '267', 'LINKSYS', NULL, '1'),
	(268, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '268', 'LIEBERT', NULL, '1'),
	(269, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '269', 'LG', NULL, '1'),
	(270, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '270', 'LION STAR', NULL, '1'),
	(271, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '271', 'LOGITECH', NULL, '1'),
	(272, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '272', 'LIBEC', NULL, '1'),
	(273, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '273', 'MAXHUB', NULL, '1'),
	(274, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '274', 'MASPION', NULL, '1'),
	(275, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '275', 'MAXTOR', NULL, '1'),
	(276, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '276', 'MATSUNAGA', NULL, '1'),
	(277, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '277', 'MAKITA', NULL, '1'),
	(278, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '278', 'MATICA', NULL, '1'),
	(279, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '279', 'MICROVISION', NULL, '1'),
	(280, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '280', 'MIKROTIK', NULL, '1'),
	(281, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '281', 'MIYAKO', NULL, '1'),
	(282, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '282', 'MINAMOTO', NULL, '1'),
	(283, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '283', 'MICROSOFT', NULL, '1'),
	(284, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '284', 'MIDEA', NULL, '1'),
	(285, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '285', 'MIKROBITS', NULL, '1'),
	(286, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '286', 'MICROPACK', NULL, '1'),
	(287, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '287', 'MITO', NULL, '1'),
	(288, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '288', 'MOTOROLA', NULL, '1'),
	(289, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '289', 'MODENA', NULL, '1'),
	(290, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '290', 'MSI', NULL, '1'),
	(291, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '291', 'NATHANS', NULL, '1'),
	(292, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '292', 'NAGOYA', NULL, '1'),
	(293, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '293', 'NAKAMICHI', NULL, '1'),
	(294, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '294', 'NETVIEL', NULL, '1'),
	(295, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '295', 'NEC', NULL, '1'),
	(296, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '296', 'NEUTRIK', NULL, '1'),
	(297, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '297', 'NETLINE', NULL, '1'),
	(298, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '298', 'NESCAFE', NULL, '1'),
	(299, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '299', 'NEST', NULL, '1'),
	(300, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '300', 'NETLINK', NULL, '1'),
	(301, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '301', 'NUTANIX', NULL, '1'),
	(302, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '302', 'NIKON', NULL, '1'),
	(303, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '303', 'NORTH BAYOU', NULL, '1'),
	(304, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '304', 'NOTALE', NULL, '1'),
	(305, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '305', 'NUC', NULL, '1'),
	(306, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '306', 'ONESIA', NULL, '1'),
	(307, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '307', 'OLYMPUS', NULL, '1'),
	(308, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '308', 'ORICO', NULL, '1'),
	(309, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '309', 'PANASONIC', NULL, '1'),
	(310, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '310', 'PALOALTO NETWORKS', NULL, '1'),
	(311, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '311', 'PAPERLINE', NULL, '1'),
	(312, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '312', 'PALADIN', NULL, '1'),
	(313, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '313', 'PALOMA', NULL, '1'),
	(314, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '314', 'PASCAL', NULL, '1'),
	(315, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '315', 'PINERI', NULL, '1'),
	(316, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '316', 'PIXEL', NULL, '1'),
	(317, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '317', 'PIONEER', NULL, '1'),
	(318, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '318', 'POLYTRON', NULL, '1'),
	(319, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '319', 'POLY', NULL, '1'),
	(320, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '320', 'POLYGOND', NULL, '1'),
	(321, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '321', 'POLAROID', NULL, '1'),
	(322, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '322', 'POWERSOFT', NULL, '1'),
	(323, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '323', 'POWELL', NULL, '1'),
	(324, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '324', 'PRIMATECH', NULL, '1'),
	(325, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '325', 'PLUSTEK', NULL, '1'),
	(326, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '326', 'PROVENT', NULL, '1'),
	(327, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '327', 'PROLINK', NULL, '1'),
	(328, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '328', 'QUANTUM', NULL, '1'),
	(329, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '329', 'RAINER', NULL, '1'),
	(330, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '330', 'RAKINDO', NULL, '1'),
	(331, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '331', 'RAZER', NULL, '1'),
	(332, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '332', 'REDWARE', NULL, '1'),
	(333, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '333', 'REMINGTONS', NULL, '1'),
	(334, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '334', 'REXUS', NULL, '1'),
	(335, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '335', 'REGENCY', NULL, '1'),
	(336, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '336', 'REALME', NULL, '1'),
	(337, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '337', 'RUCKUS', NULL, '1'),
	(338, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '338', 'RUJIE', NULL, '1'),
	(339, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '339', 'RUSSEL', NULL, '1'),
	(340, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '340', 'RUCIKA', NULL, '1'),
	(341, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '341', 'RICOH', NULL, '1'),
	(342, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '342', 'RINNAI', NULL, '1'),
	(343, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '343', 'RODSON', NULL, '1'),
	(344, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '344', 'SAMSUNG', NULL, '1'),
	(345, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '345', 'SANDISK', NULL, '1'),
	(346, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '346', 'SANGFOR', NULL, '1'),
	(347, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '347', 'SARAMONIC', NULL, '1'),
	(348, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '348', 'SANKEN', NULL, '1'),
	(349, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '349', 'SAMSON', NULL, '1'),
	(350, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '350', 'SAMOTO', NULL, '1'),
	(351, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '351', 'SAFELIGHT', NULL, '1'),
	(352, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '352', 'SAMSONIC', NULL, '1'),
	(353, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '353', 'SEAGATE', NULL, '1'),
	(354, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '354', 'SENNHEISER', NULL, '1'),
	(355, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '355', 'SECURE', NULL, '1'),
	(356, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '356', 'SEKAI', NULL, '1'),
	(357, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '357', 'SEETRONIC', NULL, '1'),
	(358, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '358', 'SEIKO', NULL, '1'),
	(359, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '359', 'SUPREME', NULL, '1'),
	(360, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '360', 'SIGMA', NULL, '1'),
	(361, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '361', 'SONY', NULL, '1'),
	(362, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '362', 'SOLUTION', NULL, '1'),
	(363, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '363', 'SOPHOS', NULL, '1'),
	(364, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '364', 'SOUNDCRAFT', NULL, '1'),
	(365, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '365', 'SOUNDBEST', NULL, '1'),
	(366, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '366', 'SOUNDPEATS', NULL, '1'),
	(367, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '367', 'SOUNDTECH', NULL, '1'),
	(368, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '368', 'STANLEY', NULL, '1'),
	(369, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '369', 'SCREENVIEW', NULL, '1'),
	(370, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '370', 'SHIMIZU', NULL, '1'),
	(371, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '371', 'TARGUS', NULL, '1'),
	(372, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '372', 'TASCAM', NULL, '1'),
	(373, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '373', 'TAKARA', NULL, '1'),
	(374, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '374', 'TAFFSTUDIO', NULL, '1'),
	(375, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '375', 'TASCO', NULL, '1'),
	(376, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '376', 'TAFFWARE', NULL, '1'),
	(377, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '377', 'TENVEO', NULL, '1'),
	(378, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '378', 'TELEVIC', NULL, '1'),
	(379, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '379', 'TENDA', NULL, '1'),
	(380, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '380', 'TEKIRO', NULL, '1'),
	(381, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '381', 'TEXCO', NULL, '1'),
	(382, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '382', 'THERMALTAKE', NULL, '1'),
	(383, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '383', 'TPLINK', NULL, '1'),
	(384, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '384', 'TOA', NULL, '1'),
	(385, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '385', 'TIGER', NULL, '1'),
	(386, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '386', 'UBIQUITI', NULL, '1'),
	(387, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '387', 'UNO', NULL, '1'),
	(388, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '388', 'UTICON', NULL, '1'),
	(389, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '389', 'UCHIDA', NULL, '1'),
	(390, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '390', 'UGREEN', NULL, '1'),
	(391, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '391', 'UBISOFT', NULL, '1'),
	(392, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '392', 'UNILAND', NULL, '1'),
	(393, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '393', 'VENTION', NULL, '1'),
	(394, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '394', 'VERTIV', NULL, '1'),
	(395, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '395', 'VERITON', NULL, '1'),
	(396, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '396', 'VIEWSONIC', NULL, '1'),
	(397, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '397', 'VIVOTEK', NULL, '1'),
	(398, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '398', 'VISALUX', NULL, '1'),
	(399, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '399', 'VISIPRO', NULL, '1'),
	(400, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '400', 'VIVO', NULL, '1'),
	(401, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '401', 'VOTRE', NULL, '1'),
	(402, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '402', 'VGEN', NULL, '1'),
	(403, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '403', 'WACOM', NULL, '1'),
	(404, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '404', 'WESTERN DIGITAL', NULL, '1'),
	(405, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '405', 'WISDOM', NULL, '1'),
	(406, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '406', 'WINDOWS', NULL, '1'),
	(407, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '407', 'YAMAHA', NULL, '1'),
	(408, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '408', 'YUASA', NULL, '1'),
	(409, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '409', 'YONG MA', NULL, '1'),
	(410, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '410', 'ZEBRA', NULL, '1'),
	(411, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '411', 'ZETAPRO', NULL, '1'),
	(412, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '412', 'ZOAN', NULL, '1'),
	(413, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '413', 'ZOOM', NULL, '1'),
	(414, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '414', 'ZOMEI', NULL, '1'),
	(415, '2024-09-26 13:41:36', '2024-09-26 13:41:36', '415', 'ELECTRO-VOICE', 'AUDIO ', '1'),
	(416, '2024-09-26 13:52:18', '2024-09-26 13:52:18', 'TRIPOD', 'NO BRAND', 'TRIPOD ', '1');

-- Dumping structure for table db_p48_ars.tbl_m_pelanggan
DROP TABLE IF EXISTS `tbl_m_pelanggan`;
CREATE TABLE IF NOT EXISTS `tbl_m_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `nama` varchar(360) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `provinsi` text DEFAULT NULL,
  `tipe` enum('0','1','2','3') DEFAULT '0' COMMENT '0=none;\\\\r\\\\n1=personal;\\\\r\\\\n2=instansi;\\\\r\\\\n',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_p48_ars.tbl_m_pelanggan: ~153 rows (approximately)
DELETE FROM `tbl_m_pelanggan`;
INSERT INTO `tbl_m_pelanggan` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `no_telp`, `alamat`, `kota`, `provinsi`, `tipe`, `status`) VALUES
	(1, 3, '2024-09-24 13:55:56', '2024-09-24 13:55:56', 'PLG-00001', 'Universitas Diponegoro', '', 'Jl. Prof. Soedarto No.13, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275', 'KOTA SEMARANG', 'JAWA TENGAH', '2', '1'),
	(2, 1, '2024-09-26 13:36:49', '2024-09-26 13:36:49', 'PLG-00002', 'OJK Provinsi Jawa Tengah', '(024) 86003000', 'Jl. Kyai Saleh No.12 - 14, Mugassari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50243', 'SEMARANG', 'JAWA TENGAH', '2', '1'),
	(3, 2, '2025-03-01 12:29:25', '2025-03-01 12:29:25', 'PLG-00003', 'pip semarang', '08726254232', 'tes', 'SEMARANG', 'JATENG', '2', '1'),
	(4, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0001', 'PT Handayani', '+62 (097) 226 4274', 'Jl. Gang Suniaraja, Yogyakarta', 'Mataram', 'Bengkulu', '3', '1'),
	(5, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0002', 'CV Suartini', '+62 (59) 462-9463', 'Jl. Gg. M.H Thamrin, Magelang', 'Kota Administrasi Jakarta Selatan', 'DKI Jakarta', '3', '1'),
	(6, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0003', 'Ika Yulianti', '+62-0560-850-3957', 'Jl. Gg. Tebet Barat Dalam, Kota Administrasi Jakarta Barat', 'Ternate', 'Sulawesi Utara', '1', '1'),
	(7, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0004', 'CV Riyanti', '0818600063', 'Jl. Gang KH Amin Jasuta, Prabumulih', 'Banjar', 'Maluku Utara', '3', '1'),
	(8, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0005', 'UD Hassanah', '+62-010-719-1727', 'Jl. Gg. Erlangga, Kediri', 'Solok', 'Nusa Tenggara Timur', '3', '1'),
	(9, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0006', 'UD Waskita', '087 029 3974', 'Jl. Gang S. Parman, Bontang', 'Manado', 'Sumatera Selatan', '3', '1'),
	(10, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0007', 'UD Andriani', '0826932311', 'Jl. Jalan Merdeka, Sungai Penuh', 'Tanjungbalai', 'Maluku', '3', '1'),
	(11, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0008', 'Kementerian Impedit', '0895308394', 'Jl. Gg. Raya Ujungberung, Samarinda', 'Padang Sidempuan', 'Riau', '1', '1'),
	(12, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0009', 'PT Mansur', '+62-383-921-7798', 'Jl. Jl. KH Amin Jasuta, Parepare', 'Semarang', 'Sumatera Barat', '3', '1'),
	(13, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0010', 'Kementerian At', '084 263 3155', 'Jl. Jalan Jakarta, Bekasi', 'Malang', 'Jawa Timur', '1', '1'),
	(14, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0011', 'CV Maulana', '+62 (512) 276-1757', 'Jl. Jalan K.H. Wahid Hasyim, Batam', 'Probolinggo', 'Nusa Tenggara Barat', '3', '1'),
	(15, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0012', 'PT Mardhiyah', '+62-252-380-9427', 'Jl. Gg. Ahmad Dahlan, Sukabumi', 'Kediri', 'Sumatera Selatan', '3', '1'),
	(16, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0013', 'PT Kuswandari', '+62 (69) 921 3571', 'Jl. Jalan Ciwastra, Bandung', 'Pagaralam', 'Sulawesi Selatan', '3', '1'),
	(17, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0014', 'CV Ardianto', '+62 (0619) 456-8375', 'Jl. Jl. M.H Thamrin, Madiun', 'Cimahi', 'Maluku', '3', '1'),
	(18, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0015', 'PT Tampubolon', '+62-019-554-4695', 'Jl. Jalan H.J Maemunah, Lhokseumawe', 'Pariaman', 'Maluku', '3', '1'),
	(19, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0016', 'CV Widodo', '+62 (087) 106 7925', 'Jl. Jalan PHH. Mustofa, Tual', 'Batam', 'Jambi', '3', '1'),
	(20, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0017', 'Bella Suryono', '(0815) 884 2288', 'Jl. Gg. Kutai, Pariaman', 'Pariaman', 'Sulawesi Utara', '1', '1'),
	(21, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0018', 'PT Prayoga', '086 032 6097', 'Jl. Gg. Joyoboyo, Palangkaraya', 'Kediri', 'DKI Jakarta', '3', '1'),
	(22, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0019', 'Kementerian Neque', '+62 (689) 006 8982', 'Jl. Jalan Dipenogoro, Solok', 'Kupang', 'Bali', '1', '1'),
	(23, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0020', 'Kementerian Repellat', '+62 (797) 928 7327', 'Jl. Jalan W.R. Supratman, Bengkulu', 'Purwokerto', 'Maluku Utara', '1', '1'),
	(24, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0021', 'Ina Astuti, M.Farm', '+62-050-802-8785', 'Jl. Jl. Raya Ujungberung, Samarinda', 'Sabang', 'Kalimantan Barat', '1', '1'),
	(25, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0022', 'PT Hastuti', '+62 (375) 221-5935', 'Jl. Jl. Dipenogoro, Padang', 'Ambon', 'Jawa Timur', '3', '1'),
	(26, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0023', 'PT Manullang', '+62-73-932-0274', 'Jl. Jalan Antapani Lama, Bima', 'Kota Administrasi Jakarta Timur', 'Kalimantan Tengah', '3', '1'),
	(27, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0024', 'PT Nashiruddin', '+62 (0384) 342 0904', 'Jl. Gg. Astana Anyar, Pariaman', 'Tomohon', 'Papua Barat', '3', '1'),
	(28, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0025', 'CV Pranowo', '(068) 139-4537', 'Jl. Gang Moch. Toha, Tangerang Selatan', 'Depok', 'Kepulauan Riau', '3', '1'),
	(29, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0026', 'PT Maulana', '+62-05-753-3789', 'Jl. Gang Raya Setiabudhi, Balikpapan', 'Kota Administrasi Jakarta Selatan', 'Kepulauan Riau', '3', '1'),
	(30, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0027', 'PT Iswahyudi', '+62 (92) 724-1852', 'Jl. Gang Moch. Toha, Subulussalam', 'Banda Aceh', 'Bengkulu', '3', '1'),
	(31, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0028', 'Kementerian Iusto', '+62 (0038) 547-6420', 'Jl. Jalan Cihampelas, Yogyakarta', 'Kendari', 'Aceh', '1', '1'),
	(32, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0029', 'CV Purnawati', '+62 (86) 063 1258', 'Jl. Gang Gedebage Selatan, Samarinda', 'Metro', 'Gorontalo', '3', '1'),
	(33, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0030', 'CV Yuliarti', '084 529 0648', 'Jl. Gg. Bangka Raya, Tangerang', 'Jambi', 'Kalimantan Selatan', '3', '1'),
	(34, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0031', 'PT Kuswandari', '(090) 936-6005', 'Jl. Gang Dr. Djunjunan, Batu', 'Sabang', 'DI Yogyakarta', '3', '1'),
	(35, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0032', 'PT Samosir', '(091) 236-5931', 'Jl. Gang Rajawali Barat, Palangkaraya', 'Binjai', 'Papua', '3', '1'),
	(36, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0033', 'PT Astuti', '(0463) 433-4436', 'Jl. Gg. M.T Haryono, Bukittinggi', 'Balikpapan', 'Jambi', '3', '1'),
	(37, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0034', 'Kementerian Perferendis', '(0261) 634-2875', 'Jl. Gang Rumah Sakit, Palopo', 'Balikpapan', 'Riau', '1', '1'),
	(38, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0035', 'PT Prayoga', '(098) 161 5615', 'Jl. Jl. Cihampelas, Salatiga', 'Tegal', 'Kepulauan Riau', '3', '1'),
	(39, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0036', 'Kementerian Et', '086 848 7506', 'Jl. Gang Kiaracondong, Binjai', 'Tidore Kepulauan', 'Jambi', '1', '1'),
	(40, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0037', 'CV Mahendra', '+62 (293) 133-4680', 'Jl. Jalan Cempaka, Padangpanjang', 'Palu', 'Riau', '3', '1'),
	(41, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0038', 'Kementerian Ducimus', '0848784139', 'Jl. Gg. Joyoboyo, Bima', 'Manado', 'Kalimantan Timur', '1', '1'),
	(42, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0039', 'Kementerian Et', '+62 (437) 481 2658', 'Jl. Jalan Ahmad Yani, Palu', 'Kediri', 'Gorontalo', '1', '1'),
	(43, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0040', 'CV Rahimah', '+62-65-519-6955', 'Jl. Jl. Ciwastra, Sabang', 'Tasikmalaya', 'Papua Barat', '3', '1'),
	(44, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0041', 'Kementerian Deserunt', '+62 (0190) 839-1186', 'Jl. Jl. Ciwastra, Prabumulih', 'Sorong', 'Nusa Tenggara Timur', '1', '1'),
	(45, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0042', 'PT Gunarto', '+62 (003) 089 7128', 'Jl. Gang Ir. H. Djuanda, Parepare', 'Cirebon', 'Papua Barat', '3', '1'),
	(46, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0043', 'PT Hartati', '+62-782-147-6912', 'Jl. Gang Medokan Ayu, Tomohon', 'Sungai Penuh', 'Nusa Tenggara Barat', '3', '1'),
	(47, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0044', 'UD Haryanti', '+62-053-307-3070', 'Jl. Gang Kebonjati, Tegal', 'Sawahlunto', 'Sumatera Selatan', '3', '1'),
	(48, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0045', 'PT Natsir', '+62-018-427-0500', 'Jl. Jalan Kebonjati, Kota Administrasi Jakarta Selatan', 'Sukabumi', 'Nusa Tenggara Timur', '3', '1'),
	(49, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0046', 'PT Palastri', '(0610) 532 4660', 'Jl. Gang Rumah Sakit, Palopo', 'Pagaralam', 'Papua', '3', '1'),
	(50, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0047', 'Kementerian Dignissimos', '(0500) 369 1072', 'Jl. Jl. Pasir Koja, Banjarbaru', 'Meulaboh', 'Bengkulu', '1', '1'),
	(51, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0048', 'Kementerian Exercitationem', '(056) 025-8199', 'Jl. Jalan Kutai, Serang', 'Lhokseumawe', 'Kepulauan Riau', '1', '1'),
	(52, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0049', 'Kementerian Laboriosam', '+62 (0398) 008-7059', 'Jl. Jl. Cikutra Barat, Blitar', 'Kota Administrasi Jakarta Timur', 'Sulawesi Barat', '1', '1'),
	(53, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0050', 'Kementerian Magni', '(0590) 447 7101', 'Jl. Gg. Tubagus Ismail, Banjarbaru', 'Pagaralam', 'Kalimantan Tengah', '1', '1'),
	(54, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0051', 'CV Hastuti', '+62 (356) 743-4430', 'Jl. Gg. Merdeka, Tegal', 'Malang', 'Jawa Timur', '3', '1'),
	(55, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0052', 'Kementerian Iure', '+62 (94) 688-5993', 'Jl. Gg. Ciwastra, Bekasi', 'Padangpanjang', 'Kalimantan Timur', '1', '1'),
	(56, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0053', 'UD Prasetyo', '+62 (085) 463 7388', 'Jl. Gang Suryakencana, Madiun', 'Padang', 'Maluku Utara', '3', '1'),
	(57, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0054', 'PT Farida', '+62 (30) 559 4958', 'Jl. Gg. Dr. Djunjunan, Pontianak', 'Manado', 'Kalimantan Barat', '3', '1'),
	(58, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0055', 'PT Jailani', '086 807 2869', 'Jl. Jalan Soekarno Hatta, Singkawang', 'Batu', 'Kalimantan Selatan', '3', '1'),
	(59, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0056', 'CV Usada', '+62-073-301-2985', 'Jl. Gg. Gegerkalong Hilir, Lhokseumawe', 'Samarinda', 'DKI Jakarta', '3', '1'),
	(60, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0057', 'Kementerian Accusamus', '+62 (005) 997-6006', 'Jl. Jl. Ciwastra, Prabumulih', 'Yogyakarta', 'Kepulauan Riau', '1', '1'),
	(61, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0058', 'PT Wahyuni', '+62 (26) 012-1495', 'Jl. Gg. Erlangga, Palu', 'Blitar', 'DI Yogyakarta', '3', '1'),
	(62, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0059', 'UD Wibisono', '+62 (62) 188-2430', 'Jl. Gang Raya Setiabudhi, Mataram', 'Surakarta', 'Kepulauan Bangka Belitung', '3', '1'),
	(63, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0060', 'Kementerian Consequuntur', '+62 (31) 299-5336', 'Jl. Gg. Asia Afrika, Kota Administrasi Jakarta Barat', 'Tangerang', 'Kalimantan Barat', '1', '1'),
	(64, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0061', 'UD Irawan', '(021) 044 3071', 'Jl. Jl. Kiaracondong, Pagaralam', 'Meulaboh', 'Kalimantan Barat', '3', '1'),
	(65, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0062', 'PT Mangunsong', '+62 (075) 797 8260', 'Jl. Jalan Veteran, Yogyakarta', 'Palu', 'Kepulauan Bangka Belitung', '3', '1'),
	(66, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0063', 'CV Laksmiwati', '+62-063-047-3853', 'Jl. Gg. Dipenogoro, Tanjungbalai', 'Ambon', 'Lampung', '3', '1'),
	(67, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0064', 'UD Namaga', '+62 (68) 869 0225', 'Jl. Gg. Cikutra Timur, Tasikmalaya', 'Langsa', 'Jambi', '3', '1'),
	(68, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0065', 'Kementerian Dolorem', '+62 (43) 837-9089', 'Jl. Gang Dr. Djunjunan, Batu', 'Cilegon', 'Kalimantan Utara', '1', '1'),
	(69, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0066', 'PT Mahendra', '(043) 012 5982', 'Jl. Jl. Bangka Raya, Cimahi', 'Manado', 'Jawa Timur', '3', '1'),
	(70, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0067', 'PT Wibisono', '+62 (0494) 726 2843', 'Jl. Jl. Moch. Ramdan, Kediri', 'Tarakan', 'Sumatera Selatan', '3', '1'),
	(71, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0068', 'CV Mardhiyah', '+62-0052-845-9480', 'Jl. Jl. Rumah Sakit, Kota Administrasi Jakarta Utara', 'Pematangsiantar', 'Nusa Tenggara Barat', '3', '1'),
	(72, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0069', 'CV Nasyidah', '+62 (074) 590-4469', 'Jl. Gg. Ir. H. Djuanda, Cimahi', 'Pekalongan', 'Gorontalo', '3', '1'),
	(73, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0070', 'Kementerian Dolore', '+62 (618) 008 3209', 'Jl. Gg. Dipatiukur, Bandung', 'Bau-Bau', 'Sulawesi Tengah', '1', '1'),
	(74, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0071', 'UD Wibisono', '+62 (61) 311-8886', 'Jl. Gang Indragiri, Tidore Kepulauan', 'Sungai Penuh', 'Nusa Tenggara Barat', '3', '1'),
	(75, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0072', 'Kementerian Magni', '080 425 9653', 'Jl. Gg. Kutai, Medan', 'Bukittinggi', 'Gorontalo', '1', '1'),
	(76, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0073', 'UD Wahyuni', '+62 (61) 890 9085', 'Jl. Gg. Gegerkalong Hilir, Pasuruan', 'Kota Administrasi Jakarta Timur', 'Aceh', '3', '1'),
	(77, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0074', 'CV Namaga', '+62-21-830-7105', 'Jl. Gg. HOS. Cokroaminoto, Singkawang', 'Tebingtinggi', 'Nusa Tenggara Timur', '3', '1'),
	(78, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0075', 'Kementerian Vero', '+62 (066) 866 1728', 'Jl. Jalan Pacuan Kuda, Bima', 'Binjai', 'Nusa Tenggara Barat', '1', '1'),
	(79, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0076', 'UD Kurniawan', '+62 (25) 441-8305', 'Jl. Jalan Pelajar Pejuang, Ternate', 'Kota Administrasi Jakarta Barat', 'Nusa Tenggara Barat', '3', '1'),
	(80, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0077', 'PT Maryadi', '+62-0150-942-6288', 'Jl. Gang Ahmad Dahlan, Jayapura', 'Banjar', 'Sumatera Selatan', '3', '1'),
	(81, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0078', 'Dt. Ibrahim Prastuti, S.I.Kom', '(0687) 445 5848', 'Jl. Gg. Stasiun Wonokromo, Pagaralam', 'Banjar', 'DKI Jakarta', '1', '1'),
	(82, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0079', 'UD Yolanda', '080 273 4906', 'Jl. Jalan KH Amin Jasuta, Payakumbuh', 'Tasikmalaya', 'Kepulauan Bangka Belitung', '3', '1'),
	(83, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0080', 'Kementerian In', '(0790) 055-5527', 'Jl. Gang Raya Ujungberung, Kota Administrasi Jakarta Pusat', 'Purwokerto', 'Lampung', '1', '1'),
	(84, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0081', 'PT Mandasari', '(0452) 546 4554', 'Jl. Jalan Cihampelas, Yogyakarta', 'Cirebon', 'Papua', '3', '1'),
	(85, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0082', 'CV Latupono', '0856313521', 'Jl. Jl. Cempaka, Parepare', 'Malang', 'Sulawesi Tengah', '3', '1'),
	(86, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0083', 'Bahuwarna Maryati', '+62-036-694-5238', 'Jl. Jl. Lembong, Tual', 'Pematangsiantar', 'Jambi', '1', '1'),
	(87, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0084', 'PT Nasyidah', '(043) 626 2519', 'Jl. Jl. Pasteur, Solok', 'Sungai Penuh', 'Maluku Utara', '3', '1'),
	(88, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0085', 'Kementerian Repellat', '081 125 6758', 'Jl. Jl. Dipenogoro, Probolinggo', 'Lubuklinggau', 'Sumatera Utara', '1', '1'),
	(89, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0086', 'PT Najmudin', '+62-0576-834-4234', 'Jl. Gg. Ir. H. Djuanda, Malang', 'Pekalongan', 'Jawa Tengah', '3', '1'),
	(90, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0087', 'UD Nugroho', '(008) 624-0810', 'Jl. Gg. Antapani Lama, Bandung', 'Pekanbaru', 'Jawa Tengah', '3', '1'),
	(91, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0088', 'UD Mustofa', '+62 (830) 658 2454', 'Jl. Jl. Lembong, Lhokseumawe', 'Pekalongan', 'Sumatera Selatan', '3', '1'),
	(92, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0089', 'CV Andriani', '+62-0008-865-2547', 'Jl. Jalan Moch. Toha, Gorontalo', 'Sawahlunto', 'Riau', '3', '1'),
	(93, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0090', 'Artawan Siregar', '(068) 995 4170', 'Jl. Gang BKR, Kota Administrasi Jakarta Utara', 'Madiun', 'Sulawesi Tengah', '1', '1'),
	(94, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0091', 'Kementerian Maxime', '+62 (77) 529-5481', 'Jl. Jl. Cikutra Timur, Pontianak', 'Sabang', 'Jawa Tengah', '1', '1'),
	(95, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0092', 'UD Sirait', '+62 (891) 996 3123', 'Jl. Jl. Cikutra Timur, Pagaralam', 'Tegal', 'Sumatera Utara', '3', '1'),
	(96, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0093', 'CV Prayoga', '+62 (426) 560 4919', 'Jl. Gang W.R. Supratman, Samarinda', 'Cirebon', 'Kepulauan Riau', '3', '1'),
	(97, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0094', 'PT Megantara', '0809795876', 'Jl. Gang Kutai, Samarinda', 'Bitung', 'Jawa Timur', '3', '1'),
	(98, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0095', 'Hamima Kuswandari', '+62-88-968-3975', 'Jl. Jl. Cihampelas, Banjarbaru', 'Mataram', 'Bali', '1', '1'),
	(99, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0096', 'Kementerian Nostrum', '+62-056-365-3089', 'Jl. Gg. Soekarno Hatta, Meulaboh', 'Subulussalam', 'Kepulauan Riau', '1', '1'),
	(100, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0097', 'Kementerian Excepturi', '+62 (0839) 246-1119', 'Jl. Jalan Kutisari Selatan, Gorontalo', 'Serang', 'Kepulauan Riau', '1', '1'),
	(101, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0098', 'UD Rahmawati', '+62 (070) 812-2691', 'Jl. Gg. Medokan Ayu, Tangerang', 'Banjar', 'Riau', '3', '1'),
	(102, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0099', 'Kementerian Laborum', '(064) 140-0095', 'Jl. Gg. Peta, Pekalongan', 'Kotamobagu', 'Sulawesi Barat', '1', '1'),
	(103, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0100', 'CV Ardianto', '+62 (0339) 705 2004', 'Jl. Gg. Astana Anyar, Mataram', 'Purwokerto', 'Maluku', '3', '1'),
	(104, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0101', 'Kementerian Sequi', '+62-181-989-5314', 'Jl. Jl. Pasir Koja, Tanjungpinang', 'Cilegon', 'Aceh', '1', '1'),
	(105, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0102', 'Kementerian Recusandae', '+62 (023) 773-9716', 'Jl. Gg. Sadang Serang, Padangpanjang', 'Kediri', 'Nusa Tenggara Barat', '1', '1'),
	(106, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0103', 'Kementerian Corporis', '+62 (597) 464-4538', 'Jl. Jalan Gedebage Selatan, Blitar', 'Sukabumi', 'Sulawesi Tengah', '1', '1'),
	(107, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0104', 'CV Wijayanti', '+62 (44) 455-1768', 'Jl. Jl. Siliwangi, Sibolga', 'Denpasar', 'Sulawesi Barat', '3', '1'),
	(108, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0105', 'PT Natsir', '+62 (004) 911-9807', 'Jl. Gg. Rumah Sakit, Surakarta', 'Mojokerto', 'Maluku Utara', '3', '1'),
	(109, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0106', 'CV Astuti', '+62 (0792) 153 9420', 'Jl. Jalan Kiaracondong, Sungai Penuh', 'Tanjungbalai', 'Kepulauan Riau', '3', '1'),
	(110, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0107', 'Kementerian Optio', '+62 (0100) 834 7650', 'Jl. Jalan Cikapayang, Batam', 'Makassar', 'Jambi', '1', '1'),
	(111, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0108', 'Purwa Puspasari, S.T.', '(024) 935 9976', 'Jl. Jalan M.T Haryono, Manado', 'Tidore Kepulauan', 'Jawa Tengah', '1', '1'),
	(112, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0109', 'Kementerian Libero', '+62 (0054) 499 0092', 'Jl. Jl. Rajawali Timur, Pagaralam', 'Tarakan', 'Aceh', '1', '1'),
	(113, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0110', 'PT Mandasari', '+62 (0813) 647 6486', 'Jl. Jalan M.H Thamrin, Denpasar', 'Tangerang Selatan', 'Sulawesi Barat', '3', '1'),
	(114, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0111', 'Farah Purwanti', '+62 (0957) 884-4093', 'Jl. Gang H.J Maemunah, Subulussalam', 'Pangkalpinang', 'Gorontalo', '1', '1'),
	(115, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0112', 'UD Rahimah', '+62 (085) 056 1917', 'Jl. Gg. Kendalsari, Cirebon', 'Tegal', 'Lampung', '3', '1'),
	(116, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0113', 'Kementerian Nemo', '(037) 091-9638', 'Jl. Jalan Rumah Sakit, Kediri', 'Tangerang', 'Nusa Tenggara Timur', '1', '1'),
	(117, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0114', 'CV Mangunsong', '(080) 781 8894', 'Jl. Jalan Pasirkoja, Tomohon', 'Pangkalpinang', 'Bengkulu', '3', '1'),
	(118, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0115', 'UD Suwarno', '+62 (048) 126-3151', 'Jl. Jalan R.E Martadinata, Surabaya', 'Mojokerto', 'Sumatera Selatan', '3', '1'),
	(119, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0116', 'PT Hutasoit', '(068) 877 9320', 'Jl. Jalan M.H Thamrin, Cilegon', 'Cirebon', 'Sulawesi Utara', '3', '1'),
	(120, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0117', 'CV Hidayat', '(0851) 016 5374', 'Jl. Gg. Otto Iskandardinata, Palangkaraya', 'Pasuruan', 'Jambi', '3', '1'),
	(121, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0118', 'Kementerian Dolor', '+62 (0204) 148 1339', 'Jl. Gang Antapani Lama, Banda Aceh', 'Palu', 'Jambi', '1', '1'),
	(122, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0119', 'PT Purwanti', '0805543798', 'Jl. Gg. Kapten Muslihat, Cimahi', 'Cilegon', 'Kalimantan Timur', '3', '1'),
	(123, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0120', 'PT Riyanti', '+62 (0708) 900 1936', 'Jl. Jalan Dipenogoro, Bekasi', 'Kota Administrasi Jakarta Timur', 'Gorontalo', '3', '1'),
	(124, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0121', 'UD Irawan', '+62 (87) 227 5416', 'Jl. Jl. Dipenogoro, Cilegon', 'Payakumbuh', 'Jawa Barat', '3', '1'),
	(125, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0122', 'Salsabila Usamah', '(051) 002 4890', 'Jl. Jl. Pasirkoja, Subulussalam', 'Bogor', 'Sumatera Selatan', '1', '1'),
	(126, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0123', 'PT Prakasa', '+62 (025) 028 0945', 'Jl. Gg. Stasiun Wonokromo, Banjarmasin', 'Mataram', 'Sulawesi Tengah', '3', '1'),
	(127, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0124', 'PT Sirait', '(0286) 964 5291', 'Jl. Gg. Kendalsari, Sorong', 'Malang', 'Kalimantan Barat', '3', '1'),
	(128, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0125', 'UD Halim', '087 556 5578', 'Jl. Gang Gegerkalong Hilir, Bontang', 'Sungai Penuh', 'Kepulauan Bangka Belitung', '3', '1'),
	(129, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0126', 'PT Wibisono', '(0329) 510 4819', 'Jl. Gang Rajawali Barat, Pontianak', 'Semarang', 'Jawa Timur', '3', '1'),
	(130, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0127', 'Kementerian Distinctio', '+62-104-422-9580', 'Jl. Gg. Erlangga, Surakarta', 'Pekalongan', 'Jawa Timur', '1', '1'),
	(131, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0128', 'CV Narpati', '(019) 305-2132', 'Jl. Gang K.H. Wahid Hasyim, Pematangsiantar', 'Kota Administrasi Jakarta Barat', 'Sulawesi Selatan', '3', '1'),
	(132, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0129', 'PT Nasyiah', '+62 (0203) 462-1451', 'Jl. Gang Lembong, Madiun', 'Cimahi', 'Sumatera Utara', '3', '1'),
	(133, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0130', 'UD Prasasta', '+62-55-233-4899', 'Jl. Gg. Soekarno Hatta, Serang', 'Tual', 'Nusa Tenggara Barat', '3', '1'),
	(134, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0131', 'PT Wacana', '082 814 4679', 'Jl. Gg. Tebet Barat Dalam, Batu', 'Bengkulu', 'Nusa Tenggara Timur', '3', '1'),
	(135, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0132', 'UD Puspita', '+62 (041) 103-3681', 'Jl. Gang Rungkut Industri, Jayapura', 'Tanjungbalai', 'Jawa Barat', '3', '1'),
	(136, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0133', 'Ika Tarihoran', '+62 (008) 432-5234', 'Jl. Gang KH Amin Jasuta, Probolinggo', 'Pariaman', 'Jambi', '1', '1'),
	(137, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0134', 'CV Narpati', '+62 (51) 152-7891', 'Jl. Jl. Merdeka, Kota Administrasi Jakarta Selatan', 'Langsa', 'Kalimantan Selatan', '3', '1'),
	(138, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0135', 'Kementerian Fugiat', '(0538) 083 3593', 'Jl. Jl. Moch. Toha, Palopo', 'Meulaboh', 'Sulawesi Tenggara', '1', '1'),
	(139, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0136', 'Kementerian Tempore', '0878491791', 'Jl. Gg. Dipatiukur, Solok', 'Medan', 'Nusa Tenggara Timur', '1', '1'),
	(140, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0137', 'PT Halimah', '+62-026-587-4296', 'Jl. Gang Abdul Muis, Bengkulu', 'Bandar Lampung', 'Kepulauan Bangka Belitung', '3', '1'),
	(141, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0138', 'Banara Hutapea', '+62 (35) 476-9976', 'Jl. Gg. Pelajar Pejuang, Tanjungbalai', 'Kota Administrasi Jakarta Timur', 'Sulawesi Barat', '1', '1'),
	(142, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0139', 'CV Pudjiastuti', '+62 (0767) 322-5002', 'Jl. Gg. Gegerkalong Hilir, Surakarta', 'Mojokerto', 'Kalimantan Selatan', '3', '1'),
	(143, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0140', 'CV Setiawan', '+62 (45) 142-9867', 'Jl. Gang Cihampelas, Lubuklinggau', 'Kotamobagu', 'Kalimantan Selatan', '3', '1'),
	(144, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0141', 'Kementerian Nam', '(063) 821-3120', 'Jl. Jl. Veteran, Samarinda', 'Yogyakarta', 'Jambi', '1', '1'),
	(145, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0142', 'UD Latupono', '+62-266-087-7756', 'Jl. Gg. R.E Martadinata, Meulaboh', 'Cilegon', 'Sumatera Selatan', '3', '1'),
	(146, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0143', 'PT Kuswandari', '+62-09-923-4517', 'Jl. Jl. Pasteur, Pontianak', 'Medan', 'Kepulauan Riau', '3', '1'),
	(147, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0144', 'UD Hariyah', '0834380893', 'Jl. Gg. Suniaraja, Kota Administrasi Jakarta Utara', 'Tegal', 'Kepulauan Riau', '3', '1'),
	(148, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0145', 'Kementerian Sequi', '+62 (163) 612-5258', 'Jl. Gang Abdul Muis, Kota Administrasi Jakarta Selatan', 'Kota Administrasi Jakarta Utara', 'DKI Jakarta', '1', '1'),
	(149, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0146', 'PT Maryati', '(005) 949-4661', 'Jl. Gang Pacuan Kuda, Bengkulu', 'Subulussalam', 'Jambi', '3', '1'),
	(150, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0147', 'UD Gunawan', '+62 (46) 196 4097', 'Jl. Jalan Kutai, Meulaboh', 'Padang', 'Sulawesi Selatan', '3', '1'),
	(151, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0148', 'PT Prabowo', '084 633 1148', 'Jl. Gang M.H Thamrin, Blitar', 'Blitar', 'Gorontalo', '3', '1'),
	(152, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0149', 'PT Wibowo', '+62-036-178-7199', 'Jl. Gang Pelajar Pejuang, Tebingtinggi', 'Binjai', 'Banten', '3', '1'),
	(153, 1, '2025-03-06 18:19:59', '2025-03-06 18:19:59', 'CUST0150', 'R.A. Shania Farida, S.E.', '+62-0775-684-4451', 'Jl. Jalan Antapani Lama, Madiun', 'Bekasi', 'Sulawesi Barat', '1', '1');

-- Dumping structure for table db_p48_ars.tbl_m_pelanggan_cp
DROP TABLE IF EXISTS `tbl_m_pelanggan_cp`;
CREATE TABLE IF NOT EXISTS `tbl_m_pelanggan_cp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `nama` varchar(160) DEFAULT NULL,
  `no_hp` varchar(160) DEFAULT NULL,
  `jabatan` varchar(160) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_pelanggan_cp_tbl_m_pelanggan` (`id_pelanggan`),
  CONSTRAINT `FK_tbl_m_pelanggan_cp_tbl_m_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_m_pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data kontak person pelanggan';

-- Dumping data for table db_p48_ars.tbl_m_pelanggan_cp: ~0 rows (approximately)
DELETE FROM `tbl_m_pelanggan_cp`;
INSERT INTO `tbl_m_pelanggan_cp` (`id`, `id_pelanggan`, `id_user`, `tgl_simpan`, `tgl_modif`, `nama`, `no_hp`, `jabatan`, `status`) VALUES
	(1, 3, 2, '2025-03-01 12:29:53', '2025-03-01 12:29:53', 'hendra', '082762424', 'IT', '1');

-- Dumping structure for table db_p48_ars.tbl_m_platform
DROP TABLE IF EXISTS `tbl_m_platform`;
CREATE TABLE IF NOT EXISTS `tbl_m_platform` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `platform` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_platform: ~2 rows (approximately)
DELETE FROM `tbl_m_platform`;
INSERT INTO `tbl_m_platform` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `platform`, `keterangan`, `status`) VALUES
	(1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Tunai', NULL, '1'),
	(2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Transfer', NULL, '1');

-- Dumping structure for table db_p48_ars.tbl_m_satuan
DROP TABLE IF EXISTS `tbl_m_satuan`;
CREATE TABLE IF NOT EXISTS `tbl_m_satuan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `satuanTerkecil` varchar(250) NOT NULL,
  `satuanBesar` varchar(250) DEFAULT NULL,
  `jml` int(11) NOT NULL,
  `status` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_satuan: ~7 rows (approximately)
DELETE FROM `tbl_m_satuan`;
INSERT INTO `tbl_m_satuan` (`id`, `tgl_simpan`, `tgl_modif`, `satuanTerkecil`, `satuanBesar`, `jml`, `status`) VALUES
	(1, '2019-08-10 16:15:39', '2024-04-17 14:27:00', 'PCS', 'PCS', 1, '1'),
	(3, '2024-05-24 03:06:04', '2024-05-26 06:50:38', 'Batang', 'Batang', 1, '1'),
	(4, '2024-05-26 06:50:57', '2024-05-26 06:50:57', 'Meter', 'Meter', 1, '1'),
	(5, '2024-05-26 06:51:18', '2024-05-26 06:51:48', 'Meter', 'Roll', 306, '1'),
	(6, '2024-05-26 12:23:00', '2024-05-26 12:23:00', 'kubik', 'kubik', 10, '1'),
	(7, '2024-06-03 18:51:54', '2024-06-03 18:51:54', 'UNIT', 'UNIT', 1, '1'),
	(8, '2024-09-26 13:51:10', '2024-09-26 13:51:10', 'PASANG', 'PASANG', 1, '1');

-- Dumping structure for table db_p48_ars.tbl_m_supplier
DROP TABLE IF EXISTS `tbl_m_supplier`;
CREATE TABLE IF NOT EXISTS `tbl_m_supplier` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `npwp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `provinsi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cp` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_supplier: ~150 rows (approximately)
DELETE FROM `tbl_m_supplier`;
INSERT INTO `tbl_m_supplier` (`id`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `npwp`, `alamat`, `kota`, `provinsi`, `no_telp`, `no_hp`, `cp`, `status`) VALUES
	(1, '2025-03-06 18:09:13', NULL, 'SUP0001', 'CV UD Rahayu (Persero) Tbk', '90.905.893.3-192.147', 'Jl. Gang Ahmad Dahlan, Tarakan', 'Metro', 'Kalimantan Tengah', '+62 (022) 739 6413', '(084) 035 9219', 'Siti Mansur', '1'),
	(2, '2025-03-06 18:09:13', NULL, 'SUP0002', 'PT PT Latupono', '86.173.824.6-488.445', 'Jl. Gang Pasteur, Samarinda', 'Lhokseumawe', 'Banten', '+62 (28) 646-6829', '+62 (99) 993-9152', 'Tgk. Mahdi Lazuardi, M.TI.', '1'),
	(3, '2025-03-06 18:09:13', NULL, 'SUP0003', 'CV UD Laksmiwati Pradipta', '94.894.686.8-756.317', 'Jl. Jl. Pasir Koja, Surakarta', 'Magelang', 'Jawa Tengah', '(005) 955-2181', '+62-088-438-7275', 'Jagaraga Hakim', '1'),
	(4, '2025-03-06 18:09:13', NULL, 'SUP0004', 'Kementerian Impedit', '81.320.737.5-322.690', 'Jl. Jalan Waringin, Probolinggo', 'Kota Administrasi Jakarta Utara', 'Gorontalo', '+62-0852-395-6970', '+62 (010) 554-2885', 'Puti Puput Wastuti', '1'),
	(5, '2025-03-06 18:09:13', NULL, 'SUP0005', 'CV Perum Narpati Manullang', '22.930.971.6-612.547', 'Jl. Jalan Kendalsari, Surabaya', 'Banjarbaru', 'Nusa Tenggara Barat', '(0032) 605-2790', '+62-920-783-7029', 'dr. Aisyah Riyanti, M.M.', '1'),
	(6, '2025-03-06 18:09:13', NULL, 'SUP0006', 'PT CV Nuraini', '91.509.606.1-729.238', 'Jl. Jl. Asia Afrika, Bekasi', 'Surakarta', 'Sulawesi Utara', '+62 (764) 695 4432', '+62 (046) 115 2953', 'Daryani Setiawan', '1'),
	(7, '2025-03-06 18:09:13', NULL, 'SUP0007', 'Kementerian Rem', '65.358.308.6-970.422', 'Jl. Gang Yos Sudarso, Blitar', 'Banjar', 'Gorontalo', '+62-087-192-9978', '(0523) 097-7597', 'Imam Oktaviani', '1'),
	(8, '2025-03-06 18:09:13', NULL, 'SUP0008', 'Kementerian Inventore', '23.277.276.7-211.652', 'Jl. Gg. Kutisari Selatan, Kediri', 'Tomohon', 'Kalimantan Utara', '0819673191', '(0220) 098 0754', 'R. Jarwa Susanti', '1'),
	(9, '2025-03-06 18:09:13', NULL, 'SUP0009', 'CV UD Wibisono Tbk', '49.747.740.7-184.714', 'Jl. Jalan Cempaka, Magelang', 'Palu', 'Maluku', '+62-69-653-8975', '+62 (55) 106 7818', 'R. Pardi Pradana', '1'),
	(10, '2025-03-06 18:09:13', NULL, 'SUP0010', 'PT Perum Kusmawati Saputra', '16.998.944.7-587.937', 'Jl. Gg. Lembong, Tangerang', 'Serang', 'Papua Barat', '+62 (0719) 245 3397', '(085) 022-2227', 'Shakila Mandasari', '1'),
	(11, '2025-03-06 18:09:13', NULL, 'SUP0011', 'PT Perum Nuraini', '80.761.524.1-777.921', 'Jl. Gg. W.R. Supratman, Batam', 'Bandung', 'Sulawesi Tenggara', '+62-94-293-5893', '+62-0666-457-7260', 'Pranawa Budiman', '1'),
	(12, '2025-03-06 18:09:13', NULL, 'SUP0012', 'PT CV Kurniawan Pudjiastuti Tbk', '41.955.257.8-657.323', 'Jl. Gg. Ahmad Dahlan, Kediri', 'Tegal', 'Bengkulu', '(030) 977-2567', '+62-0600-463-2435', 'R. Liman Laksmiwati, S.Farm', '1'),
	(13, '2025-03-06 18:09:13', NULL, 'SUP0013', 'Kementerian Maxime', '28.125.750.5-388.894', 'Jl. Jl. Pelajar Pejuang, Pangkalpinang', 'Surakarta', 'Sulawesi Tenggara', '+62-085-667-9917', '(044) 069 3836', 'Karen Kusumo', '1'),
	(14, '2025-03-06 18:09:13', NULL, 'SUP0014', 'Kementerian Ducimus', '11.715.695.9-841.806', 'Jl. Jl. Suniaraja, Medan', 'Palembang', 'Papua Barat', '+62-737-123-9806', '+62 (0937) 893 7830', 'R.M. Waluyo Napitupulu, M.Pd', '1'),
	(15, '2025-03-06 18:09:13', NULL, 'SUP0015', 'CV CV Situmorang Rahmawati Tbk', '32.204.546.4-757.390', 'Jl. Gang Kendalsari, Palangkaraya', 'Batu', 'Sulawesi Selatan', '+62-33-611-3111', '+62-094-325-2433', 'Pangestu Waskita', '1'),
	(16, '2025-03-06 18:09:13', NULL, 'SUP0016', 'PT PT Usada', '99.414.669.2-804.174', 'Jl. Gang Pasirkoja, Palembang', 'Bogor', 'Nusa Tenggara Timur', '+62 (795) 469-2744', '+62 (935) 157-0603', 'Aurora Wijaya', '1'),
	(17, '2025-03-06 18:09:13', NULL, 'SUP0017', 'Kementerian Corporis', '14.202.464.6-393.497', 'Jl. Jalan Wonoayu, Pasuruan', 'Palu', 'Bengkulu', '(071) 110 0250', '(066) 169-7964', 'dr. Amelia Prasetya, M.Ak', '1'),
	(18, '2025-03-06 18:09:13', NULL, 'SUP0018', 'CV Perum Pudjiastuti Tbk', '20.720.423.7-313.585', 'Jl. Jalan Cikutra Timur, Pagaralam', 'Sibolga', 'Lampung', '(0371) 504-6021', '+62-084-616-5161', 'Natalia Prasetyo', '1'),
	(19, '2025-03-06 18:09:13', NULL, 'SUP0019', 'Kementerian Quibusdam', '47.636.681.8-687.552', 'Jl. Gg. M.T Haryono, Sukabumi', 'Purwokerto', 'Papua', '(0016) 040 2467', '+62 (022) 552 6965', 'Mursita Wijaya', '1'),
	(20, '2025-03-06 18:09:13', NULL, 'SUP0020', 'CV CV Handayani Tampubolon', '39.396.616.9-959.272', 'Jl. Gang Pelajar Pejuang, Tasikmalaya', 'Depok', 'Sulawesi Selatan', '+62 (519) 431-1303', '(0406) 012-4390', 'H. Kanda Mayasari', '1'),
	(21, '2025-03-06 18:09:13', NULL, 'SUP0021', 'Kementerian Eligendi', '80.461.195.6-287.203', 'Jl. Jl. Sukabumi, Tangerang Selatan', 'Batam', 'Sulawesi Selatan', '+62-036-772-4475', '(0322) 786-4801', 'Zamira Siregar', '1'),
	(22, '2025-03-06 18:09:13', NULL, 'SUP0022', 'CV PT Yuliarti', '84.755.910.6-410.183', 'Jl. Jl. Waringin, Sukabumi', 'Subulussalam', 'Kalimantan Utara', '+62 (754) 961-3447', '+62 (212) 468 9831', 'Zulaikha Pangestu', '1'),
	(23, '2025-03-06 18:09:13', NULL, 'SUP0023', 'dr. Diah Prayoga, S.T.', '22.582.939.5-166.356', 'Jl. Jl. Cikutra Timur, Sungai Penuh', 'Yogyakarta', 'Kalimantan Selatan', '+62-025-912-6151', '+62-0939-960-8490', 'Dt. Anggabaya Rahayu', '1'),
	(24, '2025-03-06 18:09:13', NULL, 'SUP0024', 'Kementerian Corrupti', '99.787.351.1-126.897', 'Jl. Jalan Cikutra Barat, Bandar Lampung', 'Sabang', 'Bali', '+62 (086) 212 6709', '0885586787', 'Ir. Puspa Prabowo', '1'),
	(25, '2025-03-06 18:09:13', NULL, 'SUP0025', 'PT UD Lestari Napitupulu', '38.821.854.8-144.844', 'Jl. Gang R.E Martadinata, Bau-Bau', 'Pariaman', 'Maluku Utara', '(042) 003 4237', '+62-0732-265-3272', 'Wani Marpaung, S.Kom', '1'),
	(26, '2025-03-06 18:09:13', NULL, 'SUP0026', 'Kementerian Provident', '47.460.431.6-970.148', 'Jl. Jalan Tubagus Ismail, Yogyakarta', 'Kota Administrasi Jakarta Pusat', 'Nusa Tenggara Barat', '+62-88-194-4633', '+62 (0533) 332-9746', 'Dono Rahmawati', '1'),
	(27, '2025-03-06 18:09:13', NULL, 'SUP0027', 'PT Perum Dabukke Nainggolan', '90.598.265.5-556.255', 'Jl. Gang Monginsidi, Sukabumi', 'Banjarmasin', 'Kalimantan Barat', '+62-18-193-1081', '+62 (766) 483-7434', 'Adikara Wulandari', '1'),
	(28, '2025-03-06 18:09:13', NULL, 'SUP0028', 'PT PT Prasetyo Firgantoro (Persero) Tbk', '82.946.181.9-594.242', 'Jl. Jl. Kendalsari, Bandar Lampung', 'Banjarmasin', 'Nusa Tenggara Barat', '089 981 4623', '+62-173-381-6972', 'Makara Thamrin, S.Sos', '1'),
	(29, '2025-03-06 18:09:13', NULL, 'SUP0029', 'CV Perum Wijayanti', '38.280.468.7-708.732', 'Jl. Jalan Jayawijaya, Kota Administrasi Jakarta Barat', 'Bima', 'Kalimantan Tengah', '(0979) 566 4026', '+62 (0676) 511-8613', 'Maria Yuliarti, S.H.', '1'),
	(30, '2025-03-06 18:09:13', NULL, 'SUP0030', 'PT UD Dongoran Mardhiyah (Persero) Tbk', '18.563.594.3-927.537', 'Jl. Jalan Soekarno Hatta, Metro', 'Kota Administrasi Jakarta Pusat', 'Bengkulu', '+62-0184-153-3159', '+62 (625) 627-9407', 'Ulva Habibi', '1'),
	(31, '2025-03-06 18:09:13', NULL, 'SUP0031', 'CV UD Irawan Nainggolan (Persero) Tbk', '82.655.751.9-692.879', 'Jl. Jl. Otto Iskandardinata, Binjai', 'Pekanbaru', 'Sumatera Selatan', '0867984144', '(0706) 621 2515', 'Sarah Januar', '1'),
	(32, '2025-03-06 18:09:13', NULL, 'SUP0032', 'PT CV Pranowo Tbk', '95.500.678.6-407.720', 'Jl. Gang Dr. Djunjunan, Makassar', 'Lubuklinggau', 'Kalimantan Selatan', '(0971) 142 7110', '+62-023-915-0026', 'Pandu Mulyani', '1'),
	(33, '2025-03-06 18:09:13', NULL, 'SUP0033', 'Kementerian Consequuntur', '31.541.943.7-579.223', 'Jl. Jalan Ir. H. Djuanda, Langsa', 'Banjarmasin', 'Sumatera Utara', '0833625361', '+62 (055) 213 6789', 'Jagapati Mustofa', '1'),
	(34, '2025-03-06 18:09:13', NULL, 'SUP0034', 'PT PT Wahyudin (Persero) Tbk', '53.624.441.2-449.783', 'Jl. Gg. Pasirkoja, Lhokseumawe', 'Sukabumi', 'Maluku', '(056) 138 7107', '+62-47-303-5143', 'Tari Sitorus', '1'),
	(35, '2025-03-06 18:09:13', NULL, 'SUP0035', 'PT PT Ramadan', '94.271.195.4-763.184', 'Jl. Jalan Peta, Probolinggo', 'Pontianak', 'Sumatera Barat', '+62-085-709-1627', '+62 (0675) 087-5524', 'Bahuraksa Tampubolon', '1'),
	(36, '2025-03-06 18:09:13', NULL, 'SUP0036', 'PT Perum Aryani Aryani', '41.299.784.3-770.210', 'Jl. Jalan K.H. Wahid Hasyim, Tegal', 'Parepare', 'Maluku', '(0480) 550-0086', '+62 (078) 975 8247', 'Dr. Zelda Pradana', '1'),
	(37, '2025-03-06 18:09:13', NULL, 'SUP0037', 'Kementerian Dolores', '55.130.469.5-751.830', 'Jl. Gang Asia Afrika, Lhokseumawe', 'Batu', 'Bengkulu', '+62-373-391-6015', '(041) 436 7904', 'Karma Rahmawati', '1'),
	(38, '2025-03-06 18:09:13', NULL, 'SUP0038', 'Kementerian Aliquam', '55.285.748.5-790.529', 'Jl. Jalan Ahmad Dahlan, Solok', 'Semarang', 'Sulawesi Utara', '089 843 2209', '(0877) 023 2872', 'Jamil Salahudin', '1'),
	(39, '2025-03-06 18:09:13', NULL, 'SUP0039', 'PT PD Sinaga', '59.148.221.7-197.802', 'Jl. Gang Rawamangun, Banjarbaru', 'Solok', 'Bengkulu', '+62 (053) 399 2006', '(073) 170-5107', 'Dr. Queen Riyanti', '1'),
	(40, '2025-03-06 18:09:13', NULL, 'SUP0040', 'CV PD Maryati', '52.374.379.3-566.475', 'Jl. Gang Moch. Ramdan, Palangkaraya', 'Ambon', 'DKI Jakarta', '(046) 325 1179', '+62 (098) 551-0606', 'Mahesa Kusmawati', '1'),
	(41, '2025-03-06 18:09:13', NULL, 'SUP0041', 'Kementerian Amet', '76.293.942.4-966.390', 'Jl. Gg. Dipenogoro, Pagaralam', 'Bukittinggi', 'Sulawesi Barat', '0878848821', '0862233079', 'Eli Padmasari', '1'),
	(42, '2025-03-06 18:09:13', NULL, 'SUP0042', 'PT UD Winarno', '32.337.374.8-135.777', 'Jl. Gang Raya Ujungberung, Lhokseumawe', 'Kotamobagu', 'Bali', '+62-78-912-3949', '+62-0079-416-5719', 'Bagus Wastuti', '1'),
	(43, '2025-03-06 18:09:13', NULL, 'SUP0043', 'PT PD Ardianto Yulianti', '86.378.629.9-386.865', 'Jl. Gg. Pasirkoja, Denpasar', 'Kendari', 'Bali', '0802302243', '+62 (0351) 227-9954', 'Slamet Mangunsong', '1'),
	(44, '2025-03-06 18:09:13', NULL, 'SUP0044', 'Kementerian Odio', '21.451.969.6-601.310', 'Jl. Jl. Waringin, Pontianak', 'Singkawang', 'Maluku Utara', '+62-352-144-4472', '+62-66-996-7184', 'Gaman Suryono', '1'),
	(45, '2025-03-06 18:09:13', NULL, 'SUP0045', 'Kementerian Beatae', '30.888.374.8-724.346', 'Jl. Gg. Moch. Ramdan, Sukabumi', 'Pematangsiantar', 'Bali', '(0587) 081 3822', '(032) 732-5474', 'Maya Sitorus', '1'),
	(46, '2025-03-06 18:09:13', NULL, 'SUP0046', 'CV PD Pudjiastuti Napitupulu (Persero) Tbk', '40.977.583.3-686.377', 'Jl. Jl. Ahmad Yani, Surabaya', 'Palembang', 'Jawa Tengah', '(046) 601 5571', '+62 (089) 421 5953', 'Sutan Harsaya Haryanti', '1'),
	(47, '2025-03-06 18:09:13', NULL, 'SUP0047', 'CV CV Tarihoran Mustofa (Persero) Tbk', '42.591.143.2-363.984', 'Jl. Gang Jend. Sudirman, Kendari', 'Kediri', 'Maluku Utara', '(027) 133 9043', '+62-056-632-7850', 'Artanto Prasasta, M.TI.', '1'),
	(48, '2025-03-06 18:09:13', NULL, 'SUP0048', 'Kementerian Sit', '94.911.235.4-710.777', 'Jl. Gg. Moch. Ramdan, Padang', 'Bengkulu', 'Kepulauan Bangka Belitung', '+62-95-693-0162', '0862411203', 'Victoria Usada', '1'),
	(49, '2025-03-06 18:09:13', NULL, 'SUP0049', 'CV UD Laksita', '84.287.571.7-702.803', 'Jl. Gg. Cikutra Barat, Kota Administrasi Jakarta Timur', 'Pekalongan', 'Riau', '+62 (158) 094-9972', '+62 (07) 562 7714', 'Ika Prayoga', '1'),
	(50, '2025-03-06 18:09:13', NULL, 'SUP0050', 'CV PT Firgantoro Tbk', '28.799.498.3-648.600', 'Jl. Gg. Gedebage Selatan, Bitung', 'Palu', 'Sulawesi Selatan', '+62-0915-333-4297', '+62 (16) 033-9693', 'Aisyah Firmansyah', '1'),
	(51, '2025-03-06 18:09:13', NULL, 'SUP0051', 'PT PT Hardiansyah Laksita (Persero) Tbk', '60.887.748.3-249.605', 'Jl. Gg. Tebet Barat Dalam, Pagaralam', 'Jayapura', 'Kepulauan Bangka Belitung', '(099) 730 9610', '+62 (244) 098-3425', 'Unggul Hariyah', '1'),
	(52, '2025-03-06 18:09:13', NULL, 'SUP0052', 'CV UD Santoso Budiman', '38.432.924.1-578.248', 'Jl. Gg. Waringin, Banjarbaru', 'Mojokerto', 'Kepulauan Bangka Belitung', '081 469 2614', '+62 (080) 010 7505', 'R.A. Yuni Narpati, S.Farm', '1'),
	(53, '2025-03-06 18:09:13', NULL, 'SUP0053', 'CV CV Oktaviani', '63.720.264.2-598.421', 'Jl. Jl. Gardujati, Madiun', 'Sorong', 'Nusa Tenggara Barat', '+62 (03) 666-6683', '+62 (907) 283-2133', 'Karta Latupono', '1'),
	(54, '2025-03-06 18:09:13', NULL, 'SUP0054', 'PT PT Lazuardi Tbk', '26.459.341.2-513.361', 'Jl. Gg. R.E Martadinata, Serang', 'Banjarmasin', 'DKI Jakarta', '+62 (61) 446-6408', '0842064236', 'Cut Shania Latupono, S.IP', '1'),
	(55, '2025-03-06 18:09:13', NULL, 'SUP0055', 'PT UD Waskita', '64.498.252.7-900.549', 'Jl. Jl. Erlangga, Malang', 'Jambi', 'Sumatera Barat', '+62 (12) 968 2426', '(0025) 789 0731', 'Ir. Galih Suryatmi', '1'),
	(56, '2025-03-06 18:09:13', NULL, 'SUP0056', 'Kementerian Recusandae', '38.963.392.9-997.945', 'Jl. Gg. Rajiman, Semarang', 'Kota Administrasi Jakarta Selatan', 'Sulawesi Tengah', '+62 (44) 580 5213', '+62 (0908) 437 9542', 'Dr. Rika Gunawan', '1'),
	(57, '2025-03-06 18:09:13', NULL, 'SUP0057', 'PT PD Wahyuni (Persero) Tbk', '94.236.244.7-392.111', 'Jl. Gang Pacuan Kuda, Sawahlunto', 'Pontianak', 'Maluku', '(0644) 024-9896', '0883157374', 'Banara Haryanto', '1'),
	(58, '2025-03-06 18:09:13', NULL, 'SUP0058', 'CV Perum Najmudin Tbk', '19.591.466.8-124.178', 'Jl. Gang Jend. Sudirman, Bandung', 'Banjarbaru', 'Sulawesi Tengah', '+62 (082) 696-2289', '(0393) 869-0732', 'dr. Pranata Prakasa, M.Ak', '1'),
	(59, '2025-03-06 18:09:13', NULL, 'SUP0059', 'PT CV Hardiansyah Iswahyudi Tbk', '21.935.798.2-397.944', 'Jl. Gang Yos Sudarso, Cilegon', 'Sukabumi', 'Kalimantan Selatan', '+62 (0613) 963-6157', '0876436460', 'Novi Hartati', '1'),
	(60, '2025-03-06 18:09:13', NULL, 'SUP0060', 'PT Perum Sinaga', '32.994.733.4-136.665', 'Jl. Gang Indragiri, Bitung', 'Bima', 'Jawa Tengah', '0888849728', '+62 (70) 323 2058', 'Upik Nashiruddin, S.T.', '1'),
	(61, '2025-03-06 18:09:13', NULL, 'SUP0061', 'Kementerian Placeat', '49.315.114.4-712.628', 'Jl. Gg. Rawamangun, Tual', 'Blitar', 'Sumatera Barat', '+62 (069) 131-2914', '085 862 9357', 'Hamzah Gunarto', '1'),
	(62, '2025-03-06 18:09:13', NULL, 'SUP0062', 'PT Perum Saptono Tbk', '22.304.112.9-576.801', 'Jl. Jalan Gegerkalong Hilir, Sorong', 'Palu', 'Nusa Tenggara Timur', '+62-287-810-1582', '+62 (068) 950 0463', 'dr. Hasna Hutagalung', '1'),
	(63, '2025-03-06 18:09:13', NULL, 'SUP0063', 'Kementerian Aspernatur', '68.457.599.2-263.620', 'Jl. Gg. Cikutra Timur, Bima', 'Lubuklinggau', 'Maluku', '(082) 985-5735', '(0529) 687 2787', 'drg. Tiara Yuniar', '1'),
	(64, '2025-03-06 18:09:13', NULL, 'SUP0064', 'Kementerian Incidunt', '92.422.954.6-522.629', 'Jl. Gg. Antapani Lama, Bandung', 'Yogyakarta', 'Nusa Tenggara Timur', '084 310 8024', '+62-28-904-9929', 'Faizah Hardiansyah', '1'),
	(65, '2025-03-06 18:09:13', NULL, 'SUP0065', 'PT PD Lailasari Tamba', '97.303.422.5-807.313', 'Jl. Jl. Suryakencana, Kediri', 'Kotamobagu', 'Bali', '(0623) 009-2428', '(029) 458-9025', 'Eluh Usada', '1'),
	(66, '2025-03-06 18:09:13', NULL, 'SUP0066', 'CV PD Budiman (Persero) Tbk', '89.813.809.8-412.191', 'Jl. Jalan Cihampelas, Tebingtinggi', 'Banjarbaru', 'Aceh', '+62 (0687) 759-1667', '(0851) 506-7722', 'Wani Zulkarnain', '1'),
	(67, '2025-03-06 18:09:13', NULL, 'SUP0067', 'PT Perum Mandala Lestari', '16.688.923.6-636.642', 'Jl. Gg. Kebonjati, Solok', 'Pangkalpinang', 'Sulawesi Tenggara', '+62-84-995-9015', '+62-000-549-2188', 'Zalindra Nuraini', '1'),
	(68, '2025-03-06 18:09:13', NULL, 'SUP0068', 'Kementerian Cumque', '64.428.325.9-552.641', 'Jl. Jalan Rumah Sakit, Bandung', 'Jayapura', 'Sumatera Barat', '+62 (0751) 359-3236', '+62-0025-037-6042', 'Gabriella Jailani', '1'),
	(69, '2025-03-06 18:09:13', NULL, 'SUP0069', 'CV UD Astuti Tbk', '68.747.463.5-334.483', 'Jl. Gang Rajawali Barat, Padang Sidempuan', 'Prabumulih', 'Sulawesi Tengah', '(050) 355 6739', '+62 (0128) 278-6666', 'Shakila Pranowo', '1'),
	(70, '2025-03-06 18:09:13', NULL, 'SUP0070', 'PT Perum Salahudin Situmorang (Persero) Tbk', '48.913.771.9-400.478', 'Jl. Jl. K.H. Wahid Hasyim, Mojokerto', 'Bontang', 'Jawa Barat', '(0373) 753-6437', '+62-955-213-3867', 'Cemplunk Sihotang', '1'),
	(71, '2025-03-06 18:09:13', NULL, 'SUP0071', 'CV PD Safitri Tbk', '77.128.394.7-263.883', 'Jl. Jl. Ahmad Yani, Surakarta', 'Semarang', 'Riau', '087 546 7719', '(0660) 877-3365', 'Rika Palastri', '1'),
	(72, '2025-03-06 18:09:13', NULL, 'SUP0072', 'CV Perum Mardhiyah', '33.139.932.9-917.159', 'Jl. Jalan Ahmad Yani, Ambon', 'Solok', 'Sumatera Barat', '+62 (0208) 905 9141', '084 153 3064', 'Satya Puspasari', '1'),
	(73, '2025-03-06 18:09:13', NULL, 'SUP0073', 'Kementerian Sint', '98.854.998.3-960.458', 'Jl. Gg. Antapani Lama, Jambi', 'Palangkaraya', 'Papua Barat', '+62 (080) 299-2218', '+62-888-177-1565', 'Puti Nadine Lestari', '1'),
	(74, '2025-03-06 18:09:13', NULL, 'SUP0074', 'PT CV Sitorus', '76.620.230.5-616.920', 'Jl. Gang Soekarno Hatta, Tasikmalaya', 'Kota Administrasi Jakarta Timur', 'Maluku Utara', '+62 (245) 909 7738', '081 577 6273', 'Drs. Amelia Budiyanto', '1'),
	(75, '2025-03-06 18:09:13', NULL, 'SUP0075', 'CV Perum Dongoran (Persero) Tbk', '44.199.370.8-670.215', 'Jl. Jalan PHH. Mustofa, Pasuruan', 'Pasuruan', 'Sumatera Selatan', '+62 (660) 374-6138', '+62 (003) 185-5150', 'Paramita Siregar', '1'),
	(76, '2025-03-06 18:09:13', NULL, 'SUP0076', 'Kementerian Rem', '18.195.904.2-747.962', 'Jl. Gang Raya Setiabudhi, Surakarta', 'Kota Administrasi Jakarta Barat', 'Sumatera Barat', '+62 (0610) 363-2827', '088 698 9900', 'H. Dasa Kusumo, S.T.', '1'),
	(77, '2025-03-06 18:09:13', NULL, 'SUP0077', 'CV PD Setiawan', '15.112.338.1-155.427', 'Jl. Gang M.T Haryono, Cirebon', 'Tasikmalaya', 'Kalimantan Selatan', '081 175 1735', '(0481) 429-5853', 'Rama Nasyidah', '1'),
	(78, '2025-03-06 18:09:13', NULL, 'SUP0078', 'Kementerian Voluptate', '71.958.146.6-956.251', 'Jl. Gang Raya Setiabudhi, Balikpapan', 'Batam', 'Gorontalo', '(036) 186-3254', '(024) 274 5122', 'dr. Oni Maheswara', '1'),
	(79, '2025-03-06 18:09:13', NULL, 'SUP0079', 'PT PT Siregar', '76.699.450.7-830.569', 'Jl. Gg. Kendalsari, Tanjungbalai', 'Sukabumi', 'Papua', '+62 (035) 310 7403', '(0101) 126-7654', 'R.M. Kayun Pudjiastuti, S.Sos', '1'),
	(80, '2025-03-06 18:09:13', NULL, 'SUP0080', 'Kementerian Eveniet', '38.654.378.1-666.517', 'Jl. Jalan Gardujati, Pagaralam', 'Denpasar', 'Jawa Barat', '(0127) 338-6204', '+62 (029) 588-8704', 'dr. Nardi Salahudin, S.Pd', '1'),
	(81, '2025-03-06 18:09:13', NULL, 'SUP0081', 'CV CV Siregar', '35.589.784.7-739.668', 'Jl. Jalan PHH. Mustofa, Tarakan', 'Sibolga', 'Sumatera Selatan', '(085) 278-0634', '+62 (60) 569 5648', 'Bala Sinaga', '1'),
	(82, '2025-03-06 18:09:13', NULL, 'SUP0082', 'PT CV Saputra Pertiwi (Persero) Tbk', '78.925.396.4-820.684', 'Jl. Gg. Wonoayu, Kota Administrasi Jakarta Utara', 'Malang', 'Sumatera Selatan', '+62 (902) 335 0326', '(0538) 264 9459', 'Ella Ardianto, S.I.Kom', '1'),
	(83, '2025-03-06 18:09:13', NULL, 'SUP0083', 'CV CV Prabowo', '90.389.651.2-776.923', 'Jl. Jalan Cikutra Timur, Denpasar', 'Bau-Bau', 'Riau', '+62-0945-468-2408', '(0073) 785-2043', 'Victoria Mangunsong', '1'),
	(84, '2025-03-06 18:09:13', NULL, 'SUP0084', 'PT PT Sudiati (Persero) Tbk', '80.285.373.9-398.607', 'Jl. Gg. Bangka Raya, Bontang', 'Palangkaraya', 'Sulawesi Selatan', '(0572) 066 7335', '+62 (931) 008 1444', 'Cinta Mangunsong', '1'),
	(85, '2025-03-06 18:09:13', NULL, 'SUP0085', 'PT CV Sihombing (Persero) Tbk', '13.127.581.1-864.220', 'Jl. Gg. Jayawijaya, Yogyakarta', 'Lubuklinggau', 'Bengkulu', '087 793 9019', '+62 (566) 424 2873', 'Galak Firmansyah', '1'),
	(86, '2025-03-06 18:09:13', NULL, 'SUP0086', 'PT PT Nababan', '32.841.153.8-385.791', 'Jl. Gg. Monginsidi, Salatiga', 'Bandung', 'Jawa Timur', '+62 (75) 209-8502', '+62 (73) 473 0689', 'Ani Kusmawati', '1'),
	(87, '2025-03-06 18:09:13', NULL, 'SUP0087', 'CV CV Usada Tbk', '71.195.893.8-666.829', 'Jl. Jalan Soekarno Hatta, Tidore Kepulauan', 'Purwokerto', 'Bengkulu', '+62 (94) 364-2340', '+62 (99) 560-5926', 'dr. Vanesa Mandala, S.Psi', '1'),
	(88, '2025-03-06 18:09:13', NULL, 'SUP0088', 'Jono Megantara', '28.261.308.1-986.599', 'Jl. Gg. Laswi, Balikpapan', 'Meulaboh', 'Sumatera Selatan', '+62 (576) 533 3600', '(072) 630-3655', 'Irma Prasasta', '1'),
	(89, '2025-03-06 18:09:13', NULL, 'SUP0089', 'PT PT Laksita Jailani', '43.153.456.1-603.302', 'Jl. Jalan Ahmad Dahlan, Balikpapan', 'Bengkulu', 'Kepulauan Bangka Belitung', '+62 (0538) 441-2579', '0876730940', 'Baktianto Situmorang', '1'),
	(90, '2025-03-06 18:09:13', NULL, 'SUP0090', 'CV CV Gunawan', '98.320.440.3-159.801', 'Jl. Gg. Dipatiukur, Jambi', 'Tidore Kepulauan', 'Papua Barat', '+62 (039) 965 5491', '(0533) 553 4877', 'Yuliana Lazuardi, S.E.', '1'),
	(91, '2025-03-06 18:09:13', NULL, 'SUP0091', 'PT UD Hasanah Sihombing', '61.157.899.3-138.738', 'Jl. Jalan Kapten Muslihat, Depok', 'Solok', 'Sulawesi Utara', '+62 (54) 386-5614', '+62-639-407-3994', 'Ami Hidayat', '1'),
	(92, '2025-03-06 18:09:13', NULL, 'SUP0092', 'Hasna Widodo', '86.251.136.4-359.317', 'Jl. Gang BKR, Tidore Kepulauan', 'Bitung', 'Kalimantan Timur', '+62-731-061-1153', '+62 (669) 390-8573', 'R. Tari Anggriawan, S.E.I', '1'),
	(93, '2025-03-06 18:09:13', NULL, 'SUP0093', 'Kementerian Unde', '56.111.947.5-966.545', 'Jl. Jalan Kiaracondong, Surabaya', 'Bengkulu', 'Kepulauan Bangka Belitung', '0859585492', '+62-14-003-2828', 'Drs. Laras Haryanto, S.H.', '1'),
	(94, '2025-03-06 18:09:13', NULL, 'SUP0094', 'CV PD Handayani Tbk', '96.892.779.3-246.936', 'Jl. Gg. Otto Iskandardinata, Tanjungpinang', 'Bekasi', 'Kepulauan Riau', '(027) 828-6920', '(094) 389 5125', 'Drs. Elma Widodo, S.Sos', '1'),
	(95, '2025-03-06 18:09:13', NULL, 'SUP0095', 'PT Perum Mangunsong', '70.824.762.4-490.692', 'Jl. Gang Rajiman, Binjai', 'Cimahi', 'Kepulauan Riau', '(085) 155 2369', '+62 (22) 569 4659', 'Alambana Riyanti', '1'),
	(96, '2025-03-06 18:09:13', NULL, 'SUP0096', 'Kementerian Optio', '90.492.169.1-843.783', 'Jl. Jl. Kutai, Batam', 'Probolinggo', 'Aceh', '+62 (460) 145 2989', '+62-67-748-1989', 'Baktiono Siregar', '1'),
	(97, '2025-03-06 18:09:13', NULL, 'SUP0097', 'Kementerian Voluptatum', '22.588.153.7-976.258', 'Jl. Gang Cikapayang, Langsa', 'Bima', 'Papua Barat', '+62 (02) 359 0786', '+62-47-217-3015', 'Vera Napitupulu, S.Kom', '1'),
	(98, '2025-03-06 18:09:13', NULL, 'SUP0098', 'Kementerian Perspiciatis', '81.552.381.1-859.287', 'Jl. Gang Merdeka, Sorong', 'Gorontalo', 'Nusa Tenggara Timur', '+62-028-265-5800', '+62 (043) 558 6170', 'Ir. Queen Prayoga', '1'),
	(99, '2025-03-06 18:09:13', NULL, 'SUP0099', 'PT PT Santoso Yulianti Tbk', '88.535.268.4-375.869', 'Jl. Gang Jayawijaya, Serang', 'Langsa', 'Maluku Utara', '084 097 5282', '+62 (00) 728 8016', 'Baktiadi Budiyanto, M.Ak', '1'),
	(100, '2025-03-06 18:09:13', NULL, 'SUP0100', 'PT PD Salahudin', '51.258.214.4-801.979', 'Jl. Gang Suniaraja, Banda Aceh', 'Kupang', 'Gorontalo', '+62 (079) 965 7323', '+62 (77) 362 2240', 'Paramita Permadi', '1'),
	(101, '2025-03-06 18:09:13', NULL, 'SUP0101', 'PT CV Wacana', '39.932.132.3-228.143', 'Jl. Gg. M.T Haryono, Pontianak', 'Bekasi', 'Sumatera Utara', '+62-562-331-8762', '+62-0705-571-7404', 'Heryanto Hakim', '1'),
	(102, '2025-03-06 18:09:13', NULL, 'SUP0102', 'PT PD Nashiruddin Tbk', '14.560.846.5-592.160', 'Jl. Jl. Joyoboyo, Langsa', 'Tebingtinggi', 'Jawa Timur', '(0820) 285-3885', '+62 (96) 981-6471', 'Nadine Napitupulu, S.T.', '1'),
	(103, '2025-03-06 18:09:13', NULL, 'SUP0103', 'PT UD Mandala Tbk', '97.757.631.8-920.497', 'Jl. Jl. Veteran, Manado', 'Sibolga', 'Sumatera Selatan', '(099) 536-2621', '+62 (0042) 051-7694', 'Prasetya Hardiansyah', '1'),
	(104, '2025-03-06 18:09:13', NULL, 'SUP0104', 'Kementerian A', '19.692.824.9-189.405', 'Jl. Jalan Sentot Alibasa, Sibolga', 'Bogor', 'Papua', '(015) 485-6718', '082 854 2389', 'Hani Manullang', '1'),
	(105, '2025-03-06 18:09:13', NULL, 'SUP0105', 'PT PT Mandasari Mustofa', '21.723.572.3-327.146', 'Jl. Jalan Tebet Barat Dalam, Kota Administrasi Jakarta Barat', 'Padang Sidempuan', 'DKI Jakarta', '+62-034-726-8927', '0820891870', 'Amelia Suryono', '1'),
	(106, '2025-03-06 18:09:13', NULL, 'SUP0106', 'Kementerian Nesciunt', '53.197.250.8-636.369', 'Jl. Jalan Rungkut Industri, Purwokerto', 'Batam', 'Sumatera Selatan', '+62 (77) 350-6309', '+62 (0725) 572 9405', 'Drs. Lasmanto Natsir', '1'),
	(107, '2025-03-06 18:09:13', NULL, 'SUP0107', 'Bakiono Damanik', '81.329.976.1-201.407', 'Jl. Gg. Gegerkalong Hilir, Cimahi', 'Lubuklinggau', 'Sulawesi Selatan', '+62-089-370-7589', '+62 (41) 840-2702', 'Sadina Ramadan', '1'),
	(108, '2025-03-06 18:09:13', NULL, 'SUP0108', 'Kementerian Quae', '72.172.820.6-665.670', 'Jl. Gg. Dipenogoro, Tual', 'Dumai', 'Kalimantan Selatan', '+62-0786-554-9973', '+62 (350) 214-2655', 'Usyi Nashiruddin', '1'),
	(109, '2025-03-06 18:09:13', NULL, 'SUP0109', 'CV Perum Waskita', '86.103.155.1-456.502', 'Jl. Jl. Rawamangun, Batam', 'Meulaboh', 'Bengkulu', '+62-015-252-6310', '+62 (732) 298 9564', 'Elisa Purnawati', '1'),
	(110, '2025-03-06 18:09:13', NULL, 'SUP0110', 'Kementerian Reiciendis', '16.342.105.8-428.208', 'Jl. Gg. Jend. A. Yani, Meulaboh', 'Tangerang Selatan', 'Bengkulu', '+62 (0967) 460 5368', '082 982 4585', 'Ganda Irawan', '1'),
	(111, '2025-03-06 18:09:13', NULL, 'SUP0111', 'Kementerian Aliquid', '18.803.663.1-638.643', 'Jl. Gang Kebonjati, Pematangsiantar', 'Sabang', 'Kalimantan Barat', '+62 (0877) 103-0658', '081 929 9564', 'Mumpuni Hidayanto', '1'),
	(112, '2025-03-06 18:09:13', NULL, 'SUP0112', 'CV Perum Prastuti (Persero) Tbk', '86.925.228.6-466.110', 'Jl. Jl. Monginsidi, Bengkulu', 'Sungai Penuh', 'Kalimantan Barat', '+62 (683) 195 6192', '+62 (070) 269 3776', 'Dr. Ana Samosir, S.Ked', '1'),
	(113, '2025-03-06 18:09:13', NULL, 'SUP0113', 'CV UD Rahayu Tbk', '40.114.353.1-767.632', 'Jl. Gang Yos Sudarso, Palu', 'Mataram', 'Sulawesi Utara', '+62-050-215-9249', '+62 (059) 357 5766', 'Drs. Kenes Maryadi, M.Pd', '1'),
	(114, '2025-03-06 18:09:13', NULL, 'SUP0114', 'CV CV Mahendra Sihotang', '79.429.185.2-819.260', 'Jl. Jl. Lembong, Prabumulih', 'Banjar', 'Sulawesi Barat', '+62 (81) 181-2419', '+62 (986) 285 8822', 'Galiono Kurniawan', '1'),
	(115, '2025-03-06 18:09:13', NULL, 'SUP0115', 'Kementerian Facere', '89.995.776.4-522.919', 'Jl. Gang W.R. Supratman, Samarinda', 'Tanjungbalai', 'Kalimantan Selatan', '+62-050-566-8882', '0883980126', 'drg. Lidya Padmasari, S.Pd', '1'),
	(116, '2025-03-06 18:09:13', NULL, 'SUP0116', 'PT Perum Mangunsong (Persero) Tbk', '28.907.705.9-621.424', 'Jl. Gang Cikapayang, Parepare', 'Kota Administrasi Jakarta Barat', 'Bengkulu', '(052) 385 5068', '(097) 886 1509', 'Damar Waluyo', '1'),
	(117, '2025-03-06 18:09:13', NULL, 'SUP0117', 'Kementerian Aliquam', '94.438.500.6-621.694', 'Jl. Jalan Bangka Raya, Blitar', 'Sawahlunto', 'Maluku Utara', '+62 (0649) 096-4778', '+62-0034-730-6681', 'Puti Septi Yolanda, S.IP', '1'),
	(118, '2025-03-06 18:09:13', NULL, 'SUP0118', 'PT UD Padmasari Maheswara', '83.490.313.6-853.123', 'Jl. Gang KH Amin Jasuta, Malang', 'Madiun', 'Kepulauan Riau', '0881361476', '(0865) 274-4339', 'Wasis Tampubolon', '1'),
	(119, '2025-03-06 18:09:13', NULL, 'SUP0119', 'CV PD Yuniar (Persero) Tbk', '18.850.440.6-305.149', 'Jl. Jl. Astana Anyar, Surabaya', 'Pontianak', 'Kepulauan Bangka Belitung', '+62 (515) 820 7303', '+62 (59) 266 1791', 'Maida Hutasoit', '1'),
	(120, '2025-03-06 18:09:13', NULL, 'SUP0120', 'PT PT Ardianto Mandala', '43.597.627.7-629.310', 'Jl. Jalan R.E Martadinata, Prabumulih', 'Bima', 'Jawa Barat', '(035) 595-3175', '(0087) 462-4597', 'Ade Purwanti', '1'),
	(121, '2025-03-06 18:09:13', NULL, 'SUP0121', 'Kementerian Optio', '19.944.949.4-427.853', 'Jl. Jl. Kebonjati, Bontang', 'Pontianak', 'Sumatera Barat', '(0024) 884 3129', '+62 (904) 517-1337', 'Gandi Sitompul', '1'),
	(122, '2025-03-06 18:09:13', NULL, 'SUP0122', 'CV UD Tamba Sihotang Tbk', '91.902.237.5-598.371', 'Jl. Gang Cikutra Barat, Tegal', 'Lubuklinggau', 'Riau', '+62-32-318-1949', '+62-040-282-6838', 'Ida Napitupulu', '1'),
	(123, '2025-03-06 18:09:13', NULL, 'SUP0123', 'Kementerian Dicta', '95.959.860.7-469.902', 'Jl. Jl. Gegerkalong Hilir, Lubuklinggau', 'Salatiga', 'Nusa Tenggara Barat', '+62 (0328) 230 6404', '+62-03-702-9697', 'Ikhsan Wibowo', '1'),
	(124, '2025-03-06 18:09:13', NULL, 'SUP0124', 'Kementerian Iure', '53.970.641.5-143.564', 'Jl. Gg. Ciumbuleuit, Tual', 'Langsa', 'Sumatera Selatan', '+62-063-577-8272', '+62 (0904) 025-6718', 'Faizah Pratama, M.Farm', '1'),
	(125, '2025-03-06 18:09:13', NULL, 'SUP0125', 'PT PT Usamah', '71.316.305.4-371.255', 'Jl. Gang BKR, Cilegon', 'Solok', 'Papua Barat', '+62 (0267) 517 3239', '+62-038-443-0811', 'Vero Permadi', '1'),
	(126, '2025-03-06 18:09:13', NULL, 'SUP0126', 'CV PT Oktaviani Tbk', '88.565.449.8-806.747', 'Jl. Jalan Raya Setiabudhi, Bekasi', 'Banda Aceh', 'Papua Barat', '(0474) 819-5576', '+62 (378) 868 4261', 'Natalia Pranowo, S.E.I', '1'),
	(127, '2025-03-06 18:09:13', NULL, 'SUP0127', 'PT Perum Kusmawati Sinaga (Persero) Tbk', '87.941.271.8-815.451', 'Jl. Gg. Pasir Koja, Padangpanjang', 'Purwokerto', 'Kalimantan Barat', '+62 (455) 416 8077', '+62 (074) 423-4589', 'Harto Padmasari', '1'),
	(128, '2025-03-06 18:09:13', NULL, 'SUP0128', 'PT UD Jailani Winarno', '60.130.172.8-851.417', 'Jl. Gang Indragiri, Makassar', 'Kota Administrasi Jakarta Timur', 'Nusa Tenggara Barat', '+62 (00) 609 8630', '+62 (35) 268-4643', 'Ana Widiastuti, S.Pt', '1'),
	(129, '2025-03-06 18:09:13', NULL, 'SUP0129', 'Enteng Wijaya, S.Ked', '51.852.695.4-683.187', 'Jl. Jl. Kutisari Selatan, Metro', 'Samarinda', 'Riau', '081 513 7309', '0842518404', 'Ella Saragih', '1'),
	(130, '2025-03-06 18:09:13', NULL, 'SUP0130', 'PT PT Napitupulu', '32.503.619.6-133.478', 'Jl. Jl. Setiabudhi, Payakumbuh', 'Banjarmasin', 'Maluku Utara', '089 913 7958', '(0346) 363 9410', 'Belinda Melani', '1'),
	(131, '2025-03-06 18:09:13', NULL, 'SUP0131', 'Ulva Najmudin, M.M.', '74.860.727.4-951.440', 'Jl. Gg. Rumah Sakit, Kotamobagu', 'Bogor', 'Papua', '+62-012-237-0937', '(0867) 708-0657', 'Hasan Yuniar', '1'),
	(132, '2025-03-06 18:09:13', NULL, 'SUP0132', 'Kementerian Debitis', '97.866.796.1-123.543', 'Jl. Gang Antapani Lama, Pontianak', 'Padang Sidempuan', 'Kalimantan Selatan', '+62 (056) 170-4482', '+62-059-778-2664', 'drg. Xanana Widodo', '1'),
	(133, '2025-03-06 18:09:13', NULL, 'SUP0133', 'PT UD Halimah Yuliarti', '25.645.307.9-361.782', 'Jl. Jl. Jamika, Palu', 'Depok', 'Sumatera Selatan', '+62-010-925-2199', '+62 (098) 131 2965', 'Lanjar Oktaviani, S.Kom', '1'),
	(134, '2025-03-06 18:09:13', NULL, 'SUP0134', 'PT Perum Sirait Halim (Persero) Tbk', '43.974.709.2-648.572', 'Jl. Gg. Suryakencana, Tebingtinggi', 'Cilegon', 'Nusa Tenggara Timur', '+62 (981) 698-9725', '089 131 0284', 'Dr. Tari Nainggolan, S.H.', '1'),
	(135, '2025-03-06 18:09:13', NULL, 'SUP0135', 'Kementerian Id', '72.167.357.6-172.519', 'Jl. Gg. Indragiri, Pematangsiantar', 'Makassar', 'Kalimantan Utara', '+62-0157-620-9287', '+62 (85) 629-3144', 'Prabowo Yuliarti', '1'),
	(136, '2025-03-06 18:09:13', NULL, 'SUP0136', 'PT Perum Fujiati', '61.167.611.4-817.491', 'Jl. Gg. Yos Sudarso, Pekalongan', 'Sabang', 'Banten', '+62 (044) 438 2871', '(090) 166 5095', 'Ir. Cindy Maulana, M.TI.', '1'),
	(137, '2025-03-06 18:09:13', NULL, 'SUP0137', 'Kementerian Consequatur', '60.432.545.5-739.897', 'Jl. Jalan Surapati, Lubuklinggau', 'Pekanbaru', 'Sulawesi Barat', '+62 (0084) 333 5573', '+62 (66) 985 6253', 'Kania Firgantoro', '1'),
	(138, '2025-03-06 18:09:13', NULL, 'SUP0138', 'PT CV Mustofa Manullang', '75.426.354.3-980.404', 'Jl. Gg. Antapani Lama, Singkawang', 'Jambi', 'Kepulauan Riau', '(0547) 118-7604', '+62 (90) 678 8993', 'Sadina Yuniar', '1'),
	(139, '2025-03-06 18:09:13', NULL, 'SUP0139', 'PT Perum Usada Tbk', '59.214.690.8-433.437', 'Jl. Jl. Ir. H. Djuanda, Surakarta', 'Probolinggo', 'Sulawesi Barat', '+62 (00) 800 6613', '+62 (0846) 780-8385', 'dr. Vera Suryono', '1'),
	(140, '2025-03-06 18:09:13', NULL, 'SUP0140', 'PT CV Novitasari Anggraini (Persero) Tbk', '57.667.923.7-221.386', 'Jl. Gg. HOS. Cokroaminoto, Banjarmasin', 'Sorong', 'Banten', '+62 (0701) 835 3408', '(039) 103-4418', 'Okto Uwais', '1'),
	(141, '2025-03-06 18:09:13', NULL, 'SUP0141', 'PT PD Hasanah (Persero) Tbk', '27.121.556.4-186.718', 'Jl. Jl. Cikutra Barat, Banjarbaru', 'Pekalongan', 'Bengkulu', '0881065671', '(023) 935-0184', 'Ir. Kartika Oktaviani, S.E.I', '1'),
	(142, '2025-03-06 18:09:13', NULL, 'SUP0142', 'CV PD Latupono Jailani', '39.941.688.3-577.257', 'Jl. Gang Rungkut Industri, Bandar Lampung', 'Metro', 'Aceh', '+62-706-167-4584', '+62-0753-397-8681', 'Jindra Andriani, S.IP', '1'),
	(143, '2025-03-06 18:09:13', NULL, 'SUP0143', 'Ulva Anggraini', '77.520.827.5-972.429', 'Jl. Jl. Gegerkalong Hilir, Mojokerto', 'Meulaboh', 'Lampung', '0802291062', '+62-0219-326-6364', 'drg. Anita Wahyudin, M.Pd', '1'),
	(144, '2025-03-06 18:09:13', NULL, 'SUP0144', 'CV CV Wahyudin Hakim', '29.766.869.2-187.650', 'Jl. Gg. Rajawali Barat, Bau-Bau', 'Pagaralam', 'Banten', '+62 (74) 003 3583', '084 990 6767', 'Lantar Puspasari', '1'),
	(145, '2025-03-06 18:09:13', NULL, 'SUP0145', 'Kementerian Iusto', '59.991.969.4-503.300', 'Jl. Gang Tebet Barat Dalam, Kota Administrasi Jakarta Barat', 'Batam', 'Sumatera Utara', '+62 (0924) 771-4160', '+62 (73) 500-3857', 'Uli Mardhiyah, M.TI.', '1'),
	(146, '2025-03-06 18:09:13', NULL, 'SUP0146', 'Kementerian Reiciendis', '78.605.227.5-746.665', 'Jl. Gang Veteran, Dumai', 'Lhokseumawe', 'Sumatera Selatan', '+62-0835-318-2668', '0809025927', 'Galuh Kuswandari, S.Sos', '1'),
	(147, '2025-03-06 18:09:13', NULL, 'SUP0147', 'CV UD Januar', '71.198.847.7-143.400', 'Jl. Gg. K.H. Wahid Hasyim, Batam', 'Pematangsiantar', 'Kepulauan Riau', '+62-080-694-5065', '0855006176', 'Drs. Samiah Adriansyah, S.Sos', '1'),
	(148, '2025-03-06 18:09:13', NULL, 'SUP0148', 'Tina Hartati', '82.468.193.3-728.232', 'Jl. Jalan Ciumbuleuit, Palopo', 'Metro', 'Kalimantan Timur', '(0738) 087-2020', '+62 (02) 364-7455', 'Gantar Farida', '1'),
	(149, '2025-03-06 18:09:13', NULL, 'SUP0149', 'Kementerian Deleniti', '73.522.400.6-625.128', 'Jl. Gg. Dipenogoro, Madiun', 'Salatiga', 'Papua Barat', '+62 (82) 737 3877', '+62 (0450) 819 5617', 'Tugiman Utama', '1'),
	(150, '2025-03-06 18:09:13', NULL, 'SUP0150', 'Kementerian Eaque', '57.228.747.7-945.210', 'Jl. Gg. Rawamangun, Tual', 'Jayapura', 'Sumatera Barat', '(054) 390 3800', '+62 (0485) 233-3883', 'Bahuraksa Oktaviani', '1');

-- Dumping structure for table db_p48_ars.tbl_m_tipe
DROP TABLE IF EXISTS `tbl_m_tipe`;
CREATE TABLE IF NOT EXISTS `tbl_m_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_tipe: ~5 rows (approximately)
DELETE FROM `tbl_m_tipe`;
INSERT INTO `tbl_m_tipe` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `tipe`, `status`) VALUES
	(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e-Katalog', 1),
	(2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Siplah', 1),
	(3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PL', 1),
	(4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lelang', 1),
	(5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Umum', 1);

-- Dumping structure for table db_p48_ars.tbl_pengaturan
DROP TABLE IF EXISTS `tbl_pengaturan`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_app` int(3) DEFAULT 0,
  `website` varchar(100) DEFAULT NULL,
  `judul` varchar(500) DEFAULT NULL,
  `judul_app` varchar(500) DEFAULT NULL,
  `url_app` varchar(500) DEFAULT NULL,
  `favicon` varchar(500) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `logo_header` varchar(500) DEFAULT NULL,
  `logo_header_kop` varchar(500) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `deskripsi_pendek` text DEFAULT NULL,
  `notifikasi` varchar(320) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `email` varchar(360) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tlp` varchar(160) DEFAULT NULL,
  `fax` varchar(160) DEFAULT NULL,
  `kode_plgn` varchar(50) DEFAULT NULL,
  `kode_kary` varchar(50) DEFAULT NULL,
  `kode_supp` varchar(50) DEFAULT NULL,
  `kode_po` varchar(50) DEFAULT NULL,
  `kode_psn` varchar(50) DEFAULT NULL,
  `kode_rab` varchar(50) DEFAULT NULL,
  `kode_penj` varchar(50) DEFAULT NULL,
  `kode_mts` varchar(50) DEFAULT NULL,
  `kode_do` varchar(50) DEFAULT NULL,
  `ppn` decimal(10,2) DEFAULT 0.00,
  `dpp` decimal(10,2) DEFAULT 0.00,
  `pph` decimal(10,2) DEFAULT 0.00,
  `ppn_tot` int(11) DEFAULT NULL,
  `jml_ppn` int(11) DEFAULT NULL,
  `jml_item` int(11) DEFAULT NULL,
  `jml_limit_stok` int(11) DEFAULT NULL,
  `jml_limit_tempo` int(11) DEFAULT NULL,
  `status_app` enum('pusat','cabang') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_pengaturan: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan`;
INSERT INTO `tbl_pengaturan` (`id`, `id_app`, `website`, `judul`, `judul_app`, `url_app`, `favicon`, `logo`, `logo_header`, `logo_header_kop`, `deskripsi`, `deskripsi_pendek`, `notifikasi`, `alamat`, `kota`, `email`, `pesan`, `tlp`, `fax`, `kode_plgn`, `kode_kary`, `kode_supp`, `kode_po`, `kode_psn`, `kode_rab`, `kode_penj`, `kode_mts`, `kode_do`, `ppn`, `dpp`, `pph`, `ppn_tot`, `jml_ppn`, `jml_item`, `jml_limit_stok`, `jml_limit_tempo`, `status_app`) VALUES
	(1, 1, 'serbaaneka.co.id', 'Serbaneka Guna Abadi', 'SERBANEKA', 'https://sap.serbaaneka.co.id', 'logo_fav_serbanekagunaabadi.jpg', 'logo_serbanekagunaabadi.png', 'logo_hdr_serbanekagunaabadi.png', '', '', '', '', '', 'Semarang', 'mikhaelfelian@gmail.com', '', '', '', 'PLG', 'PG', 'PRSC', NULL, NULL, NULL, NULL, 'MTS', 'DO', 1.11, 1.11, 1.50, 111, 12, 10, 12, 10, '');

-- Dumping structure for table db_p48_ars.tbl_pengaturan_mail
DROP TABLE IF EXISTS `tbl_pengaturan_mail`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proto` enum('mail','sendmail','smtp') NOT NULL,
  `host` varchar(160) NOT NULL,
  `user` varchar(160) NOT NULL,
  `pass` varchar(160) NOT NULL,
  `port` int(11) NOT NULL,
  `timeout` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_p48_ars.tbl_pengaturan_mail: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_mail`;

-- Dumping structure for table db_p48_ars.tbl_pengaturan_profile
DROP TABLE IF EXISTS `tbl_pengaturan_profile`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan_profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengaturan` int(10) NOT NULL DEFAULT 0,
  `id_user` int(10) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode_srt_dpn` varchar(30) DEFAULT NULL,
  `kode_inv_dpn` varchar(30) DEFAULT NULL,
  `kode_rab_dpn` varchar(30) DEFAULT NULL,
  `kode_po_dpn` varchar(30) DEFAULT NULL,
  `kode_kwi_dpn` varchar(30) DEFAULT NULL,
  `kode_srt_blk` varchar(30) DEFAULT NULL,
  `npwp` varchar(160) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `no_fax` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `kbli` varchar(160) DEFAULT NULL,
  `logo` varchar(160) DEFAULT NULL,
  `logo_kop` varchar(160) DEFAULT NULL,
  `logo_wm` varchar(160) DEFAULT NULL,
  `rek_bank` varchar(160) DEFAULT NULL,
  `rek_nama` varchar(160) DEFAULT NULL,
  `rek_nomor` varchar(160) DEFAULT NULL,
  `direktur` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_pengaturan_profile_tbl_pengaturan` (`id_pengaturan`),
  CONSTRAINT `FK_tbl_pengaturan_profile_tbl_pengaturan` FOREIGN KEY (`id_pengaturan`) REFERENCES `tbl_pengaturan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_pengaturan_profile: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_profile`;
INSERT INTO `tbl_pengaturan_profile` (`id`, `id_pengaturan`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode_srt_dpn`, `kode_inv_dpn`, `kode_rab_dpn`, `kode_po_dpn`, `kode_kwi_dpn`, `kode_srt_blk`, `npwp`, `nama`, `no_telp`, `no_fax`, `alamat`, `kota`, `email`, `kbli`, `logo`, `logo_kop`, `logo_wm`, `rek_bank`, `rek_nama`, `rek_nomor`, `direktur`, `keterangan`, `status`) VALUES
	(2, 1, 2, '2024-05-23 04:20:51', '2025-03-06 17:05:25', 'BQ', 'INV', 'RAB', 'PO', 'KWI', 'SGA', '81.0000000000000000000000', 'PT. SERBANEKA GUNA ABADI', '-', '-', 'Jalan Jalan Sore', 'SEMARANG', '', NULL, '', 'logo_prof_ptserbanekagunaabadi.png', 'logo_prof_ptserbanekagunaabadi_wm.jpg', 'PT Bank Central Asia Tbk.', '', 'xxxxxxxxxx', 'Alfiab HARI', NULL, 1);

-- Dumping structure for table db_p48_ars.tbl_pengaturan_theme
DROP TABLE IF EXISTS `tbl_pengaturan_theme`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaturan` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `path` varchar(160) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_pengaturan_theme_tbl_pengaturan` (`id_pengaturan`),
  CONSTRAINT `FK_tbl_pengaturan_theme_tbl_pengaturan` FOREIGN KEY (`id_pengaturan`) REFERENCES `tbl_pengaturan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_pengaturan_theme: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_theme`;
INSERT INTO `tbl_pengaturan_theme` (`id`, `id_pengaturan`, `nama`, `path`, `status`) VALUES
	(1, 1, 'Admin LTE 3', 'admin-lte-3', 1);

-- Dumping structure for table db_p48_ars.tbl_sessions
DROP TABLE IF EXISTS `tbl_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Table untuk menyimpan session data';

-- Dumping data for table db_p48_ars.tbl_sessions: ~67 rows (approximately)
DELETE FROM `tbl_sessions`;
INSERT INTO `tbl_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('simedis_session:u0tno04lflioo0loj9bva2r3p6vrqcd8', '::1', '2025-02-21 12:56:24', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303134323538343b73696d656469735f746f6b656e7c733a33323a223863393133383633393733323262643363373062306261306164646531666636223b5f63695f70726576696f75735f75726c7c733a32383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f223b),
	('simedis_session:t3dp8noa5vvfj2jsqd6rbfi1k7hanmqu', '::1', '2025-02-21 13:10:14', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303134333431343b73696d656469735f746f6b656e7c733a33323a223432316631663638336262626663376232346338626535623534623431336635223b5f63695f70726576696f75735f75726c7c733a32383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f223b746f617374727c613a323a7b733a343a2274797065223b733a353a226572726f72223b733a373a226d657373616765223b733a32393a2272654341505443484120766572696669636174696f6e206661696c6564223b7d5f5f63695f766172737c613a313a7b733a363a22746f61737472223b733a333a226f6c64223b7d),
	('simedis_session:cdcgho4903c1q2ot893ofuhh3gpnmre5', '::1', '2025-02-21 13:11:07', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303134333436373b73696d656469735f746f6b656e7c733a33323a226664313562663631613865653530383865663137666632313766323561326634223b5f63695f70726576696f75735f75726c7c733a32383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430303936383531223b6c6173745f636865636b7c693a313734303134333436373b),
	('simedis_session:8f1gfdr8d80daovgjlq8118jehbqs1fk', '::1', '2025-02-21 14:20:00', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303134373630303b73696d656469735f746f6b656e7c733a33323a226664313562663631613865653530383865663137666632313766323561326634223b5f63695f70726576696f75735f75726c7c733a33393a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f73746f636b2f6974656d73223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430303936383531223b6c6173745f636865636b7c693a313734303134333436373b),
	('simedis_session:vnjb7o6v3umjfs8u8cq9618jr0nu8efr', '::1', '2025-02-21 16:17:18', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303135343633383b73696d656469735f746f6b656e7c733a33323a226664313562663631613865653530383865663137666632313766323561326634223b5f63695f70726576696f75735f75726c7c733a33373a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f64617368626f617264223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430303936383531223b6c6173745f636865636b7c693a313734303134333436373b),
	('simedis_session:60b3bjrs7q8oqhiv4ug6rn4r296mbfph', '::1', '2025-02-21 14:30:21', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303134383232303b73696d656469735f746f6b656e7c733a33323a226664313562663631613865653530383865663137666632313766323561326634223b5f63695f70726576696f75735f75726c7c733a33373a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f64617368626f617264223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430303936383531223b6c6173745f636865636b7c693a313734303134333436373b),
	('simedis_session:ciliclfft638ki920dpfpp5of2k2gdnh', '::1', '2025-02-21 16:17:35', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303135343633383b73696d656469735f746f6b656e7c733a33323a226664313562663631613865653530383865663137666632313766323561326634223b5f63695f70726576696f75735f75726c7c733a34393a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f7472616e73616b73692f706f2f64657461696c2f32223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430303936383531223b6c6173745f636865636b7c693a313734303134333436373b),
	('simedis_session:mhvp4jgg3mtmtd2cpmdtdse066eoidhf', '::1', '2025-02-22 04:16:03', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303139373736323b73696d656469735f746f6b656e7c733a33323a223961343162643864326235303663383163623337353836323832313830633763223b6572726f727c733a33303a2253696c616b616e206c6f67696e207465726c6562696820646168756c7521223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
	('simedis_session:fjnbdmvlvi50mdn1utvfh66vuv6s782s', '::1', '2025-02-22 04:16:05', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303139373736323b73696d656469735f746f6b656e7c733a33323a223234323537396161333533613662663433653061623038666137666336663836223b6572726f727c733a33303a2253696c616b616e206c6f67696e207465726c6562696820646168756c7521223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f617574682f6c6f67696e223b),
	('simedis_session:0qse215p6kgc5t31pid8uh912roqmsoq', '::1', '2025-02-22 10:46:24', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303232313138343b73696d656469735f746f6b656e7c733a33323a223365383733643965346332393339643564623230666637656463643965343033223b5f63695f70726576696f75735f75726c7c733a32383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430313433343637223b6c6173745f636865636b7c693a313734303232313138343b),
	('simedis_session:ess55krh8e5vjqdequbo89mja15s4osh', '::1', '2025-02-22 10:53:41', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303232313632313b73696d656469735f746f6b656e7c733a33323a223365383733643965346332393339643564623230666637656463643965343033223b5f63695f70726576696f75735f75726c7c733a34393a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f6d65647265636f7264732f72617761745f696e6170223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430313433343637223b6c6173745f636865636b7c693a313734303232313138343b),
	('simedis_session:4cbhbp9skm437mu1vq1c65rrvvq6gat5', '::1', '2025-02-22 10:56:39', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303232313632313b73696d656469735f746f6b656e7c733a33323a223365383733643965346332393339643564623230666637656463643965343033223b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f6d61737465722f6b617465676f72693f706167655f6b617465676f72693d32223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430313433343637223b6c6173745f636865636b7c693a313734303232313138343b),
	('simedis_session:irlno5imqat3cp8l7ngcn2c30g4ma4ei', '::1', '2025-02-23 04:06:52', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303238333630393b73696d656469735f746f6b656e7c733a33323a223037306639636261383433326230666361636638326364366166636561353164223b6572726f727c733a33303a2253696c616b616e206c6f67696e207465726c6562696820646168756c7521223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f617574682f6c6f67696e223b),
	('simedis_session:nmuqki7dnto5ll5eok1f4984dgdkr5ao', '::1', '2025-02-24 05:48:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303337363130303b73696d656469735f746f6b656e7c733a33323a223264633065643063316665363833396335653166646533363936353935623761223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f617574682f6c6f67696e223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430323231313834223b6c6173745f636865636b7c693a313734303337363039393b),
	('simedis_session:p28if4r98rdoquimt5e2tm3gvp5hlc6r', '::1', '2025-02-24 05:48:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303337363130303b73696d656469735f746f6b656e7c733a33323a223264633065643063316665363833396335653166646533363936353935623761223b5f63695f70726576696f75735f75726c7c733a33373a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f64617368626f617264223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430323231313834223b6c6173745f636865636b7c693a313734303337363039393b737563636573737c733a31353a224c6f67696e20626572686173696c21223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
	('simedis_session:bqgenp6i5v28586a3qgf9ptael2s9bq3', '::1', '2025-02-27 01:03:25', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303631383230353b73696d656469735f746f6b656e7c733a33323a223230366434356439643232633265643766373637393533343866653930306666223b5f63695f70726576696f75735f75726c7c733a32383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430333736303939223b6c6173745f636865636b7c693a313734303631383230353b),
	('simedis_session:n004i4nfbmk8lcrg4t9f6868ie9jma0o', '::1', '2025-02-27 01:03:26', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303631383230353b73696d656469735f746f6b656e7c733a33323a223230366434356439643232633265643766373637393533343866653930306666223b5f63695f70726576696f75735f75726c7c733a33373a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f64617368626f617264223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373430333736303939223b6c6173745f636865636b7c693a313734303631383230353b737563636573737c733a31353a224c6f67696e20626572686173696c21223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
	('siap_session:k2aild6if4ssrev2mt4q007qbjf8pp4q', '::1', '2025-03-04 01:59:27', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313035333536373b736961705f746f6b656e7c733a33323a226531646132653733633261643732306537386135383266633334356464363638223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b),
	('siap_session:p528di7hnhrjn6d6va89g34hn0ph59g2', '::1', '2025-03-04 01:59:27', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313035333536373b736961705f746f6b656e7c733a33323a226531646132653733633261643732306537386135383266633334356464363638223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b),
	('siap_session:c4nlu1duufvefqjmcf83ph2qam6mve58', '::1', '2025-03-04 09:40:23', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038313232333b736961705f746f6b656e7c733a33323a226136653430323435353964366463313036366464383761646664303066646331223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:1j5mp597naq6ll77568t0087avafu5r4', '::1', '2025-03-04 09:50:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038313832303b736961705f746f6b656e7c733a33323a226136653430323435353964366463313036366464383761646664303066646331223b5f63695f70726576696f75735f75726c7c733a34323a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f64617368626f6172642e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:t42sklh1v6v2afktl5v4om979j73a7d9', '::1', '2025-03-04 10:08:01', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038323838313b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a3130323a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d62656c69616e5f74616d6261682e7068703f69643d31352669645f6974656d3d362669645f6974656d5f6465743d3132223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:s9uorf6tk5ommjts5bkqfkki70rg2qoe', '::1', '2025-03-04 10:42:34', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038343935343b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a37373a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d62656c69616e5f74616d6261682e7068703f69643d3135223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:kh7sl1skh6apoqjt9gmbk49vmen9puq3', '::1', '2025-03-04 10:53:44', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038353632343b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3132223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:afc2vmc6p9cjkbscqr1qnerl1939g32a', '::1', '2025-03-04 11:00:15', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038363031353b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3132223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:mbluovdkn6rcia5d8jo46qmqom4o7vp5', '::1', '2025-03-04 11:12:40', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038363736303b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3132223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:hc6d50g5mdep6lc0e8948n3sp9flan96', '::1', '2025-03-04 11:21:26', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038373238363b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:tuo4qc9paesuij6urr05v9u4dsbmjm5s', '::1', '2025-03-04 11:34:06', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038383034363b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:djmbno5b16pd5ha5hn6hs31hsnsvugr8', '::1', '2025-03-04 11:48:21', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038383930313b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a36383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f7472616e73616b73692f646174615f70656e6a75616c616e5f616b73692e7068703f69643d3138223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:bve1l5agm0nbtprlj9qng5he6lhsoo2v', '::1', '2025-03-04 11:59:05', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313038393534353b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a36383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f7472616e73616b73692f646174615f70656e6a75616c616e5f616b73692e7068703f69643d3138223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:gvc4s316jamsmeg2hkggferghl42d8j8', '::1', '2025-03-04 12:43:26', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313039323230363b736961705f746f6b656e7c733a33323a226235383964363830653831656161363863336665363130623831333036663134223b5f63695f70726576696f75735f75726c7c733a37373a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d62656c69616e5f74616d6261682e7068703f69643d3135223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:fs1b9jstnt8kpiroiqvrle02qep07s3s', '::1', '2025-03-04 12:50:06', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313039323630363b736961705f746f6b656e7c733a33323a223934346636623061646633373232393464393739643331393234336335323438223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:olp6l47dqkjv3bqvk8qmusvu3bfdcjen', '::1', '2025-03-04 12:55:21', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313039323932313b736961705f746f6b656e7c733a33323a223035393232356362363061663366616266353539343338373237333263613036223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3135223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:uakbcrdga237qo0pqlr9lhcqmn3bucbd', '::1', '2025-03-04 13:06:37', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313039333539373b736961705f746f6b656e7c733a33323a223035393232356362363061663366616266353539343338373237333263613036223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3135223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b),
	('siap_session:rdhu6e6l1lu15tlamj9cdm889vqnjdqa', '::1', '2025-03-04 13:10:58', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313039333539373b736961705f746f6b656e7c733a33323a223135306330346564653562306562363034376536623432663966313538336362223b5f63695f70726576696f75735f75726c7c733a37383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656d62656c69616e2f66616b7475722f646174615f70656d6261796172616e5f74616d6261682e7068703f69643d3135223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303139303139223b6c6173745f636865636b7c693a313734313038313232333b6572726f727c733a34303a2254686520616374696f6e20796f7520726571756573746564206973206e6f7420616c6c6f7765642e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
	('siap_session:ds131eh1trttognsg1tbo176j0e7euvs', '::1', '2025-03-05 12:54:50', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313137393239303b736961705f746f6b656e7c733a33323a223831343332613938663034323335303863663164353965303735363131313533223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b),
	('siap_session:2e8qh7q3441qv3hfkegalbfruupc3pd1', '::1', '2025-03-05 12:54:52', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313137393239323b736961705f746f6b656e7c733a33323a223237336663646437613162306531303366383366643033646233383831363764223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303831323233223b6c6173745f636865636b7c693a313734313137393239323b),
	('siap_session:8v7k94hnuf23anpjk7prjb7tvg69g7s9', '::1', '2025-03-05 13:00:08', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313137393630383b736961705f746f6b656e7c733a33323a223237336663646437613162306531303366383366643033646233383831363764223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303831323233223b6c6173745f636865636b7c693a313734313137393239323b),
	('siap_session:jcs0dol2u3jqh808m5ilrj3spcq14hp3', '::1', '2025-03-05 13:05:38', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313137393933383b736961705f746f6b656e7c733a33323a223237336663646437613162306531303366383366643033646233383831363764223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303831323233223b6c6173745f636865636b7c693a313734313137393239323b),
	('siap_session:r3gde98ieqmo4cmojum626pv4hkl9sal', '::1', '2025-03-05 13:10:59', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138303235393b736961705f746f6b656e7c733a33323a223237336663646437613162306531303366383366643033646233383831363764223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431303831323233223b6c6173745f636865636b7c693a313734313137393239323b),
	('siap_session:aoglmfuliv79nb9fufhmd3k96fvcee25', '::1', '2025-03-05 13:16:09', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138303536393b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:1mo0e9p8gitstvpip7hlsbhhs8h8ller', '::1', '2025-03-05 13:25:13', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138313131333b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a33353a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f677564616e67223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:c5c8teru94f8m7jva04kc7g0s7ino6fh', '::1', '2025-03-05 13:40:24', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138323032343b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35333a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d61737465722f646174615f6b617465676f72692e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:54o1fb0tn3o57t8mnqefs0jn3mqr0oa3', '::1', '2025-03-05 13:48:23', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138323530333b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:455kh1mput2kdde6bcf333vp3ebrifrm', '::1', '2025-03-05 13:53:27', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138323830373b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:qu7ctvpsq5s6qifnk41sg9t4b62vdsj4', '::1', '2025-03-05 13:59:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138333136303b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f7065727573616861616e5f74616d6261682e7068703f69643d32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:d6ds9p88ae7cm1tul4fv62rno7a9h9hs', '::1', '2025-03-05 14:05:47', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138333534373b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f7065727573616861616e5f74616d6261682e7068703f69643d32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:2fbd8tcdjsdcleb7hjsa1od1al6b2vb4', '::1', '2025-03-05 14:11:47', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138333930373b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:qh0ihm2meti5r2cmigslf8gne8u85ca4', '::1', '2025-03-05 14:17:12', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138343233323b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:212hqlnpgp3fojqsqos16lho45g2toqp', '::1', '2025-03-05 15:07:57', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138373237373b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f677564616e672f6d75746173692f646174615f6d75746173692e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:0d1ffpq1vmue12t46v2p2t7cm8si4oje', '::1', '2025-03-05 16:48:27', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313139333330373b736961705f746f6b656e7c733a33323a226132653431386363343861666263313565336632393231353230373065663363223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:bo9962ejslhofh0d6fhlojslnu3gomdm', '::1', '2025-03-05 17:03:43', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313139343232333b736961705f746f6b656e7c733a33323a226132653431386363343861666263313565336632393231353230373065663363223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:okjhvgkjd71ernspkve5d9vb21i0dkoq', '::1', '2025-03-05 17:03:43', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313139343232333b736961705f746f6b656e7c733a33323a226132653431386363343861666263313565336632393231353230373065663363223b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b),
	('siap_session:tns2cnb7n5hbn0ob45hlt47h9gph3u52', '::1', '2025-03-06 02:04:13', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313232363635333b736961705f746f6b656e7c733a33323a226232373862373132636333636665363531313739306433313339316639323866223b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:46q2889432e40jhjnh1dquegdeqg91p5', '::1', '2025-03-06 03:22:31', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233313335313b736961705f746f6b656e7c733a33323a226432336662393637613337623032333938353933313833633935386263363462223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:o1quf291b0v5mbkpb63mg317pi78vgvt', '::1', '2025-03-06 03:27:38', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233313635383b736961705f746f6b656e7c733a33323a226432336662393637613337623032333938353933313833633935386263363462223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:5ncnuv1a025vehe7e78f28f6qp9ds6lt', '::1', '2025-03-06 03:41:22', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233323438323b736961705f746f6b656e7c733a33323a226432336662393637613337623032333938353933313833633935386263363462223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:26794ad8c0nbrv6nc5nbroeebkrv6q1a', '::1', '2025-03-06 03:47:56', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233323837363b736961705f746f6b656e7c733a33323a226432336662393637613337623032333938353933313833633935386263363462223b5f63695f70726576696f75735f75726c7c733a34323a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f64617368626f6172642e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:svgkmi4as8kmm26l9529aqjev22cfqng', '::1', '2025-03-06 03:52:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233323837363b736961705f746f6b656e7c733a33323a226432336662393637613337623032333938353933313833633935386263363462223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313830353639223b6c6173745f636865636b7c693a313734313232363635333b),
	('siap_session:bmp0rfktgafka2aquo8mm9p0jm8s1fc9', '::1', '2025-03-06 09:53:53', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235343833333b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b),
	('siap_session:gf4a56nf788dsmgv8i6iks07u30rdkji', '::1', '2025-03-06 09:54:55', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235343839353b5f63695f70726576696f75735f75726c7c733a32393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:f7oft7833mdh7tl2h020jhi72aubsm7c', '::1', '2025-03-06 10:00:59', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235353235393b5f63695f70726576696f75735f75726c7c733a35343a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70656e6761747572616e2f70656e6761747572616e2e706870223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:7hdt1cf761tnch62l6aqdmlp1ddjg1fs', '::1', '2025-03-06 10:09:21', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235353736313b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f70726f66696c652f32223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:4b9nt5ksn1kkov7p0qht3mrbrlnuklbc', '::1', '2025-03-06 10:29:34', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235363937343b5f63695f70726576696f75735f75726c7c733a33353a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d6173746572223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:mtbnnfq0bj39bepn9rh05dcmh6iu6qn5', '::1', '2025-03-06 10:39:39', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235373537393b5f63695f70726576696f75735f75726c7c733a34393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d61737465722f646174615f6974656d2e706870223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:t7b7m2tv36230tkulbgrh0p298o5gbnl', '::1', '2025-03-06 10:55:54', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235383535343b5f63695f70726576696f75735f75726c7c733a34393a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d61737465722f646174615f6974656d2e706870223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:c4ndlqdkk24ruh39oodq9urj20tevkg8', '::1', '2025-03-06 11:20:59', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313236303035393b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d61737465722f646174615f70656c616e6767616e5f74616d6261682e7068703f69643d33223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b),
	('siap_session:o6js3cnn6209sr061hegbf638k6i8k0b', '::1', '2025-03-06 11:21:30', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313236303035393b5f63695f70726576696f75735f75726c7c733a33353a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d6173746572223b736961705f746f6b656e7c733a33323a223063643432316161396233346363303839386132613166663662623361326136223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431323236363533223b6c6173745f636865636b7c693a313734313235343839353b);

-- Dumping structure for table db_p48_ars.tbl_sessions_front
DROP TABLE IF EXISTS `tbl_sessions_front`;
CREATE TABLE IF NOT EXISTS `tbl_sessions_front` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` longblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_sessions_front: ~0 rows (approximately)
DELETE FROM `tbl_sessions_front`;
INSERT INTO `tbl_sessions_front` (`id`, `session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	(346, 'ef266d2304ff9a4888bbecbfa6921e5f', '66.249.79.194', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.6045.123 M', 1701561571, _binary '');

-- Dumping structure for table db_p48_ars.tbl_trans_beli
DROP TABLE IF EXISTS `tbl_trans_beli`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_po` int(11) DEFAULT 0,
  `id_penerima` int(11) DEFAULT 0,
  `id_perusahaan` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `no_nota` varchar(160) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_po` varchar(160) DEFAULT NULL,
  `supplier` varchar(160) DEFAULT NULL,
  `jml_total` decimal(32,2) DEFAULT 0.00,
  `disk1` decimal(32,2) DEFAULT 0.00,
  `disk2` decimal(32,2) DEFAULT 0.00,
  `disk3` decimal(32,2) DEFAULT 0.00,
  `jml_potongan` decimal(32,2) DEFAULT 0.00,
  `jml_retur` decimal(32,2) DEFAULT 0.00,
  `jml_diskon` decimal(32,2) DEFAULT 0.00,
  `jml_biaya` decimal(32,2) DEFAULT 0.00,
  `jml_subtotal` decimal(32,2) DEFAULT 0.00,
  `jml_dpp` decimal(32,2) DEFAULT 0.00,
  `ppn` int(11) DEFAULT 0,
  `jml_ppn` decimal(32,2) DEFAULT 0.00,
  `jml_gtotal` decimal(32,2) DEFAULT 0.00,
  `jml_bayar` decimal(32,2) DEFAULT 0.00,
  `jml_kembali` decimal(32,2) DEFAULT 0.00,
  `jml_kurang` decimal(32,2) DEFAULT 0.00,
  `status` enum('0','1','2') DEFAULT '0',
  `status_bayar` enum('0','1') DEFAULT '0',
  `status_ppn` enum('0','1','2') DEFAULT '0',
  `status_penerimaan` enum('0','1','2','3') DEFAULT '0',
  `metode_bayar` varchar(160) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idSupplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_beli: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli`;

-- Dumping structure for table db_p48_ars.tbl_trans_beli_det
DROP TABLE IF EXISTS `tbl_trans_beli_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_pembelian` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) NOT NULL DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `jml_satuan` int(11) DEFAULT 0,
  `jml_diterima` int(11) DEFAULT 0,
  `satuan` varchar(160) DEFAULT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  `harga` decimal(32,2) DEFAULT 0.00,
  `disk1` decimal(32,2) DEFAULT 0.00,
  `disk2` decimal(32,2) DEFAULT 0.00,
  `disk3` decimal(32,2) DEFAULT 0.00,
  `diskon` decimal(32,2) DEFAULT 0.00,
  `potongan` decimal(32,2) DEFAULT 0.00,
  `subtotal` decimal(32,2) DEFAULT 0.00,
  `sp` int(11) DEFAULT 0,
  `status_ppn` enum('0','1') DEFAULT '0',
  `status_sn` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idBarang` (`id_item`),
  KEY `FK_tbl_trans_beli_det_tbl_trans_beli` (`id_pembelian`),
  CONSTRAINT `FK_tbl_trans_beli_det_tbl_trans_beli` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_trans_beli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_beli_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_beli_plat
DROP TABLE IF EXISTS `tbl_trans_beli_plat`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli_plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_platform` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `platform` varchar(160) NOT NULL,
  `keterangan` varchar(160) NOT NULL,
  `nominal` decimal(32,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_nota` (`id_pembelian`),
  CONSTRAINT `FK_tbl_trans_beli_plat_tbl_trans_beli` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_trans_beli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_beli_plat: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli_plat`;

-- Dumping structure for table db_p48_ars.tbl_trans_beli_po
DROP TABLE IF EXISTS `tbl_trans_beli_po`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_rab` int(11) DEFAULT 0,
  `id_penjualan` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `no_po` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `supplier` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `pengiriman` text DEFAULT NULL,
  `status_nota` int(11) DEFAULT 0 COMMENT 'Untuk mencatat status nota, sudah proses atau belum',
  `status_fkt` int(11) DEFAULT 0 COMMENT 'Untuk mencatat status faktur',
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idSupplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_beli_po: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli_po`;

-- Dumping structure for table db_p48_ars.tbl_trans_beli_po_det
DROP TABLE IF EXISTS `tbl_trans_beli_po_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli_po_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_pembelian` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_rab_det` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `jml_satuan` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_ppn` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `satuan` varchar(160) DEFAULT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  `keterangan_itm` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `status_ppn` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idBarang` (`id_item`),
  KEY `FK_tbl_trans_beli_po_det_tbl_trans_beli_po` (`id_pembelian`),
  CONSTRAINT `FK_tbl_trans_beli_po_det_tbl_trans_beli_po` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_trans_beli_po` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_beli_po_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli_po_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual
DROP TABLE IF EXISTS `tbl_trans_jual`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_sales` int(11) DEFAULT 0,
  `id_kasir` int(11) DEFAULT 0,
  `id_pelanggan` int(11) DEFAULT 0,
  `id_perusahaan` int(11) DEFAULT 0,
  `id_tipe` int(11) DEFAULT 0,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_platform` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `no_nota` varchar(50) DEFAULT NULL,
  `no_kontrak` varchar(160) DEFAULT NULL,
  `no_paket` varchar(160) DEFAULT NULL,
  `platform` varchar(160) DEFAULT NULL,
  `jml_hps` decimal(32,2) DEFAULT 0.00,
  `jml_pagu` decimal(32,2) DEFAULT 0.00,
  `jml_total` decimal(32,2) DEFAULT 0.00,
  `ppn` int(11) DEFAULT 0,
  `jml_ppn` decimal(32,2) DEFAULT 0.00,
  `pph` int(11) DEFAULT 0,
  `jml_pph` int(11) DEFAULT 0,
  `jml_gtotal` decimal(32,2) DEFAULT 0.00,
  `jml_biaya` decimal(32,2) DEFAULT 0.00,
  `jml_bayar` decimal(32,2) DEFAULT 0.00,
  `jml_hpp` decimal(32,2) DEFAULT 0.00,
  `jml_hpp_ppn` decimal(32,2) DEFAULT 0.00,
  `jml_profit` decimal(32,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `metode_bayar` int(11) DEFAULT NULL,
  `status` enum('0','1','2','3','4') DEFAULT '0' COMMENT '\r\n1=pos\r\n2=rajal\r\n3=ranap',
  `status_bayar` enum('0','1','2') DEFAULT '0',
  `status_nota` int(11) DEFAULT 0 COMMENT '1=anamnesa\\\\r\\\\n2=pemeriksaan\\\\r\\\\n3=tindakan\\\\r\\\\n4=obat\\\\r\\\\n5=dokter\\\\r\\\\n6=pembayaran\\\\r\\\\n7=finish',
  `status_ppn` enum('0','1') DEFAULT '0',
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `no_nota` (`no_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_det
DROP TABLE IF EXISTS `tbl_trans_jual_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) NOT NULL DEFAULT 0,
  `id_item_kat` int(11) NOT NULL DEFAULT 0,
  `id_item_sat` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `item_link` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `harga` decimal(32,2) DEFAULT 0.00,
  `harga_dpp` decimal(32,2) DEFAULT 0.00,
  `harga_ppn` decimal(32,2) DEFAULT 0.00,
  `harga_pph` decimal(32,2) DEFAULT 0.00,
  `jml` int(6) DEFAULT 0,
  `jml_po` int(6) DEFAULT 0,
  `jml_satuan` int(6) DEFAULT 0,
  `disk1` decimal(32,2) DEFAULT 0.00,
  `disk2` decimal(32,2) DEFAULT 0.00,
  `disk3` decimal(32,2) DEFAULT 0.00,
  `diskon` decimal(32,2) DEFAULT 0.00,
  `potongan` decimal(32,2) DEFAULT 0.00,
  `subtotal` decimal(32,2) DEFAULT 0.00,
  `profit` decimal(32,2) DEFAULT 0.00,
  `harga_hpp` decimal(32,2) DEFAULT 0.00,
  `harga_hpp_ppn` decimal(32,2) DEFAULT 0.00,
  `harga_hpp_tot` decimal(32,2) DEFAULT 0.00,
  `status_hrg` int(11) DEFAULT 0,
  `status_brg` enum('0','1') DEFAULT '0',
  `status_ppn` enum('0','1') DEFAULT '0',
  `status_biaya` enum('0','1') DEFAULT '0',
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_penjualan` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_det_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_file
DROP TABLE IF EXISTS `tbl_trans_jual_file`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_berkas` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_ext` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `tipe` int(11) DEFAULT 0 COMMENT '1=BAST;\r\n2=Kontrak;\r\n3=Faktur;\r\n4=SP2D;',
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK__tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Unggah dokumen penjualan';

-- Dumping data for table db_p48_ars.tbl_trans_jual_file: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_file`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_hist
DROP TABLE IF EXISTS `tbl_trans_jual_hist`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_hist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penjualan` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_hist_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_hist: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_hist`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_kirim
DROP TABLE IF EXISTS `tbl_trans_jual_kirim`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_kirim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_mutasi` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_sales` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_kirim: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_kirim`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_kwi
DROP TABLE IF EXISTS `tbl_trans_jual_kwi`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_kwi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `dari` varchar(160) DEFAULT NULL,
  `nominal` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_jual_kwi_tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_kwi_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_kwi: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_kwi`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_log
DROP TABLE IF EXISTS `tbl_trans_jual_log`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `log` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_jual_log_tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_log_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_log: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_log`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_pen
DROP TABLE IF EXISTS `tbl_trans_jual_pen`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_pen` (
  `no_nota` varchar(50) NOT NULL,
  `id_app` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `kode_nota_dpn` varchar(50) DEFAULT NULL,
  `kode_nota_blk` varchar(50) DEFAULT NULL,
  `kode_fp` varchar(50) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `platform` varchar(160) NOT NULL,
  `jml_total` decimal(32,2) NOT NULL,
  `jml_diskon` decimal(32,2) NOT NULL,
  `jml_biaya` decimal(32,2) NOT NULL,
  `jml_subtotal` decimal(32,2) NOT NULL,
  `ppn` int(11) NOT NULL,
  `jml_ppn` decimal(32,2) NOT NULL,
  `jml_gtotal` decimal(32,2) NOT NULL,
  `jml_retur` decimal(32,2) NOT NULL,
  `jml_bayar` decimal(32,2) NOT NULL,
  `jml_kembali` decimal(32,2) NOT NULL,
  `jml_kurang` decimal(32,2) NOT NULL,
  `jml_ongkir` decimal(32,2) NOT NULL,
  `disk1` decimal(32,2) NOT NULL,
  `jml_disk1` decimal(32,2) NOT NULL,
  `disk2` decimal(32,2) NOT NULL,
  `jml_disk2` decimal(32,2) NOT NULL,
  `disk3` decimal(32,2) NOT NULL,
  `jml_disk3` decimal(32,2) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `metode_bayar` enum('0','1','2') NOT NULL,
  `status_nota` enum('0','1','2','3') NOT NULL,
  `status_ppn` enum('0','1') NOT NULL,
  `status_bayar` enum('0','1','2') NOT NULL,
  `status_retur` enum('0','1','2') NOT NULL,
  PRIMARY KEY (`no_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_pen: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_pen`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_pen_det
DROP TABLE IF EXISTS `tbl_trans_jual_pen_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_pen_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_satuan` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `produk` varchar(256) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` decimal(32,2) NOT NULL,
  `disk1` decimal(32,2) NOT NULL,
  `disk2` decimal(32,2) NOT NULL,
  `disk3` decimal(32,2) NOT NULL,
  `jml` int(6) NOT NULL,
  `jml_satuan` int(6) NOT NULL,
  `diskon` decimal(32,2) NOT NULL,
  `potongan` decimal(32,2) NOT NULL,
  `subtotal` decimal(32,2) NOT NULL,
  `status_app` enum('0','1') NOT NULL,
  `status_hrg` int(11) NOT NULL,
  `status_brg` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_jual_pen_det_tbl_trans_jual_pen` (`no_nota`),
  CONSTRAINT `FK_tbl_trans_jual_pen_det_tbl_trans_jual_pen` FOREIGN KEY (`no_nota`) REFERENCES `tbl_trans_jual_pen` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_pen_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_pen_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_plat
DROP TABLE IF EXISTS `tbl_trans_jual_plat`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_platform` int(11) NOT NULL,
  `tgl_simpan` datetime NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `platform` varchar(160) NOT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  `nominal` decimal(32,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penjualan` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_plat_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_plat: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_plat`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_po
DROP TABLE IF EXISTS `tbl_trans_jual_po`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_po` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_po` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_jual_po_tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_po_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Untuk menyimpan PO dalam beberapa project';

-- Dumping data for table db_p48_ars.tbl_trans_jual_po: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_po`;

-- Dumping structure for table db_p48_ars.tbl_trans_mutasi
DROP TABLE IF EXISTS `tbl_trans_mutasi`;
CREATE TABLE IF NOT EXISTS `tbl_trans_mutasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_user_terima` int(11) DEFAULT 0,
  `id_gd_asal` int(11) NOT NULL DEFAULT 0,
  `id_gd_tujuan` int(11) DEFAULT 0,
  `id_sales` int(11) DEFAULT 0,
  `id_pelanggan` int(11) DEFAULT 0,
  `id_perusahaan` int(11) DEFAULT 0,
  `id_penjualan` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `no_nota` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tipe` enum('0','1','2','3','4') DEFAULT '0' COMMENT '1 = Pindah Gudang\\r\\n2 = Stok Masuk\\r\\n3 = Stok Keluar\\r\\n4 = Pengiriman (dengan nota invoice)',
  `status` enum('0','1','2','3','4') DEFAULT '0',
  `status_hps` enum('0','1') DEFAULT '0',
  `status_terima` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `no_nota` (`no_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Mencatat transaksi mutasi keluar masuk gudang';

-- Dumping data for table db_p48_ars.tbl_trans_mutasi: ~0 rows (approximately)
DELETE FROM `tbl_trans_mutasi`;

-- Dumping structure for table db_p48_ars.tbl_trans_mutasi_det
DROP TABLE IF EXISTS `tbl_trans_mutasi_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_mutasi_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mutasi` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_item_kat` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `id_penjualan_det` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jml` int(6) DEFAULT 0,
  `jml_satuan` int(6) DEFAULT 1,
  `jml_diterima` int(6) DEFAULT 0,
  `status_brg` enum('0','1') DEFAULT '0',
  `status_terima` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_mutasi` (`id_mutasi`),
  CONSTRAINT `FK_tbl_trans_gudang_det_tbl_trans_gudang` FOREIGN KEY (`id_mutasi`) REFERENCES `tbl_trans_mutasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Mencatat transaksi mutasi antar gudang';

-- Dumping data for table db_p48_ars.tbl_trans_mutasi_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_mutasi_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_mutasi_stok
DROP TABLE IF EXISTS `tbl_trans_mutasi_stok`;
CREATE TABLE IF NOT EXISTS `tbl_trans_mutasi_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT 0,
  `id_mutasi` int(11) DEFAULT 0,
  `id_mutasi_det` int(11) DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_gd_asal` int(11) DEFAULT 0,
  `id_gd_tujuan` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL,
  `stok_awal` decimal(10,2) DEFAULT 0.00,
  `jml` decimal(10,2) DEFAULT 0.00,
  `stok_akhir` decimal(10,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_mutasi` (`id_mutasi`),
  CONSTRAINT `FK__tbl_trans_mutasi` FOREIGN KEY (`id_mutasi`) REFERENCES `tbl_trans_mutasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_mutasi_stok: ~0 rows (approximately)
DELETE FROM `tbl_trans_mutasi_stok`;

-- Dumping structure for table db_p48_ars.tbl_trans_pesanan
DROP TABLE IF EXISTS `tbl_trans_pesanan`;
CREATE TABLE IF NOT EXISTS `tbl_trans_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_sales` int(11) NOT NULL DEFAULT 0,
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk_pm` datetime DEFAULT NULL,
  `no_nota` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=baru\r\n1=proses\r\n2=rab',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk data transaki pesanan';

-- Dumping data for table db_p48_ars.tbl_trans_pesanan: ~0 rows (approximately)
DELETE FROM `tbl_trans_pesanan`;

-- Dumping structure for table db_p48_ars.tbl_trans_pesanan_det
DROP TABLE IF EXISTS `tbl_trans_pesanan_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_pesanan_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `id_satuan_pesanan` int(11) DEFAULT 0,
  `id_user_sales` int(11) DEFAULT 0,
  `id_user_pm` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk_pm` datetime NOT NULL,
  `tgl_keluar_pm` datetime NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `pesanan` varchar(50) DEFAULT NULL,
  `jml` varchar(50) DEFAULT NULL,
  `jml_pesanan` varchar(50) DEFAULT NULL,
  `pagu` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_pesanan` (`id_pesanan`),
  CONSTRAINT `FK__tbl_trans_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_trans_pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_pesanan_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_pesanan_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_rab
DROP TABLE IF EXISTS `tbl_trans_rab`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_sales` int(11) NOT NULL DEFAULT 0,
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_tipe` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_rab` varchar(50) NOT NULL,
  `no_kontrak` varchar(160) DEFAULT NULL,
  `no_paket` varchar(160) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `jml_hps` decimal(15,2) DEFAULT 0.00,
  `jml_pagu` decimal(15,2) DEFAULT 0.00,
  `jml_total` decimal(15,2) DEFAULT 0.00,
  `ppn` decimal(15,2) DEFAULT 0.00,
  `jml_ppn` decimal(15,2) DEFAULT 0.00,
  `pph` decimal(15,2) DEFAULT 0.00,
  `jml_pph` decimal(15,2) DEFAULT 0.00,
  `jml_gtotal` decimal(15,2) DEFAULT 0.00,
  `jml_biaya` decimal(15,2) DEFAULT 0.00,
  `jml_hpp` decimal(15,2) DEFAULT 0.00,
  `jml_hpp_ppn` decimal(15,2) DEFAULT 0.00,
  `jml_profit` decimal(15,2) DEFAULT 0.00,
  `status` enum('0','1','2','3','4','5','6') DEFAULT '0' COMMENT '0=draft;‧1=submit / proses;‧2=approve / terima;‧3=reject / tolak / revisi;‧4=win;‧5=lose;‧6=posting;‧‧** Jika approve maka status lead dan bisa lanjut ke win‧*** Setelah win baru bisa posting ke penjualan',
  `status_ppn` enum('0','1','2') DEFAULT '0',
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_rab: ~0 rows (approximately)
DELETE FROM `tbl_trans_rab`;

-- Dumping structure for table db_p48_ars.tbl_trans_rab_det
DROP TABLE IF EXISTS `tbl_trans_rab_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_item_kat` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `item_link` text DEFAULT NULL,
  `jml` int(11) DEFAULT 0,
  `jml_satuan` int(11) DEFAULT 0,
  `jml_po` int(11) DEFAULT 0,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` decimal(32,2) DEFAULT 0.00,
  `harga_dpp` decimal(32,2) DEFAULT 0.00,
  `harga_ppn` decimal(32,2) DEFAULT 0.00,
  `harga_pph` decimal(32,2) DEFAULT 0.00,
  `subtotal` decimal(32,2) DEFAULT 0.00,
  `harga_hpp` decimal(32,2) DEFAULT 0.00,
  `harga_hpp_ppn` decimal(32,2) DEFAULT 0.00,
  `harga_hpp_tot` decimal(32,2) DEFAULT 0.00,
  `profit` decimal(32,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `status_ppn` int(11) DEFAULT 0,
  `status_biaya` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_rab_det_tbl_trans_rab` (`id_rab`),
  CONSTRAINT `FK_tbl_trans_rab_det_tbl_trans_rab` FOREIGN KEY (`id_rab`) REFERENCES `tbl_trans_rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_rab_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_rab_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_rab_log
DROP TABLE IF EXISTS `tbl_trans_rab_log`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `log` text DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=default;‧1=insert;‧2=update;‧3=soft_delete;‧4=delete;‧',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_rab_log_tbl_trans_rab` (`id_rab`),
  CONSTRAINT `FK_tbl_trans_rab_log_tbl_trans_rab` FOREIGN KEY (`id_rab`) REFERENCES `tbl_trans_rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_rab_log: ~0 rows (approximately)
DELETE FROM `tbl_trans_rab_log`;

-- Dumping structure for table db_p48_ars.tbl_trans_rab_pen
DROP TABLE IF EXISTS `tbl_trans_rab_pen`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab_pen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `tgl_modif` datetime NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_rab` (`id_rab`),
  CONSTRAINT `FK__tbl_trans_rab` FOREIGN KEY (`id_rab`) REFERENCES `tbl_trans_rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Untuk menyimpan penawaran';

-- Dumping data for table db_p48_ars.tbl_trans_rab_pen: ~0 rows (approximately)
DELETE FROM `tbl_trans_rab_pen`;

-- Dumping structure for table db_p48_ars.tbl_trans_retur_beli
DROP TABLE IF EXISTS `tbl_trans_retur_beli`;
CREATE TABLE IF NOT EXISTS `tbl_trans_retur_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_app` int(11) NOT NULL DEFAULT 0,
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_pembelian` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL,
  `no_nota` varchar(50) DEFAULT NULL,
  `no_retur` varchar(50) DEFAULT NULL,
  `jml_total` decimal(32,2) DEFAULT NULL,
  `ppn` decimal(32,2) DEFAULT NULL,
  `jml_ppn` decimal(32,2) DEFAULT NULL,
  `jml_retur` decimal(32,2) DEFAULT NULL,
  `status_retur` int(11) NOT NULL,
  `status_ppn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCustomer` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_retur_beli: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_beli`;

-- Dumping structure for table db_p48_ars.tbl_trans_retur_beli_det
DROP TABLE IF EXISTS `tbl_trans_retur_beli_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_retur_beli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_retur_beli` int(11) DEFAULT NULL,
  `id_beli_det` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `produk` varchar(256) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `harga` decimal(32,2) DEFAULT NULL,
  `disk1` decimal(10,2) DEFAULT NULL,
  `disk2` decimal(10,2) DEFAULT NULL,
  `disk3` decimal(10,2) DEFAULT NULL,
  `jml` int(6) DEFAULT NULL,
  `jml_satuan` int(6) DEFAULT NULL,
  `diskon` decimal(32,2) DEFAULT NULL,
  `potongan` decimal(32,2) DEFAULT NULL,
  `subtotal` decimal(32,2) DEFAULT NULL,
  `status_retur` enum('1','2') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_retur_beli_det_tbl_trans_retur_beli` (`id_retur_beli`),
  CONSTRAINT `FK_tbl_trans_retur_beli_det_tbl_trans_retur_beli` FOREIGN KEY (`id_retur_beli`) REFERENCES `tbl_trans_retur_beli` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_retur_beli_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_beli_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_retur_jual
DROP TABLE IF EXISTS `tbl_trans_retur_jual`;
CREATE TABLE IF NOT EXISTS `tbl_trans_retur_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_app` int(11) DEFAULT 0,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_user_auth` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `no_retur` varchar(50) DEFAULT '0',
  `no_nota` varchar(50) DEFAULT '0',
  `jml_total` decimal(32,2) DEFAULT NULL,
  `jml_diskon` decimal(32,2) DEFAULT NULL,
  `ppn` decimal(32,2) DEFAULT NULL,
  `jml_ppn` decimal(32,2) DEFAULT NULL,
  `jml_retur` decimal(32,2) DEFAULT NULL,
  `jml_gtotal` decimal(32,2) DEFAULT NULL,
  `status_retur` int(11) DEFAULT NULL,
  `status_ppn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCustomer` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_retur_jual: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_jual`;

-- Dumping structure for table db_p48_ars.tbl_trans_retur_jual_det
DROP TABLE IF EXISTS `tbl_trans_retur_jual_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_retur_jual_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_retur_jual` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `produk` varchar(256) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `harga` decimal(32,2) DEFAULT NULL,
  `disk1` decimal(10,2) DEFAULT NULL,
  `disk2` decimal(10,2) DEFAULT NULL,
  `disk3` decimal(10,2) DEFAULT NULL,
  `jml` int(6) DEFAULT NULL,
  `jml_satuan` int(6) DEFAULT NULL,
  `diskon` decimal(32,2) DEFAULT NULL,
  `potongan` decimal(32,2) DEFAULT NULL,
  `subtotal` decimal(32,2) DEFAULT NULL,
  `status_retur` enum('1','2','3') DEFAULT NULL,
  `status_nota` enum('1','2') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_retur_jual_det_tbl_trans_retur_jual` (`id_retur_jual`),
  CONSTRAINT `FK_tbl_trans_retur_jual_det_tbl_trans_retur_jual` FOREIGN KEY (`id_retur_jual`) REFERENCES `tbl_trans_retur_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_retur_jual_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_jual_det`;

-- Dumping structure for table db_p48_ars.tbl_util_backup
DROP TABLE IF EXISTS `tbl_util_backup`;
CREATE TABLE IF NOT EXISTS `tbl_util_backup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tgl` timestamp NULL DEFAULT NULL,
  `name` varchar(160) NOT NULL,
  `file_name` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_util_backup: ~0 rows (approximately)
DELETE FROM `tbl_util_backup`;

-- Dumping structure for table db_p48_ars.tbl_util_eksport
DROP TABLE IF EXISTS `tbl_util_eksport`;
CREATE TABLE IF NOT EXISTS `tbl_util_eksport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_util_eksport: ~0 rows (approximately)
DELETE FROM `tbl_util_eksport`;

-- Dumping structure for table db_p48_ars.tbl_util_import
DROP TABLE IF EXISTS `tbl_util_import`;
CREATE TABLE IF NOT EXISTS `tbl_util_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_util_import: ~0 rows (approximately)
DELETE FROM `tbl_util_import`;

-- Dumping structure for table db_p48_ars.tbl_util_log
DROP TABLE IF EXISTS `tbl_util_log`;
CREATE TABLE IF NOT EXISTS `tbl_util_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_p48_ars.tbl_util_log: ~0 rows (approximately)
DELETE FROM `tbl_util_log`;

-- Dumping structure for table db_p48_ars.tbl_util_so
DROP TABLE IF EXISTS `tbl_util_so`;
CREATE TABLE IF NOT EXISTS `tbl_util_so` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT 0,
  `sess_id` varchar(64) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `satuan` varchar(64) DEFAULT NULL,
  `nm_file` text DEFAULT NULL,
  `dl_file` text DEFAULT NULL,
  `reset` enum('0','1') DEFAULT '0',
  `status` enum('0','1','2','3') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_util_so: ~0 rows (approximately)
DELETE FROM `tbl_util_so`;

-- Dumping structure for table db_p48_ars.tbl_util_so_det
DROP TABLE IF EXISTS `tbl_util_so_det`;
CREATE TABLE IF NOT EXISTS `tbl_util_so_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_so` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `produk` varchar(100) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `jml` decimal(10,2) DEFAULT NULL,
  `jml_sys` decimal(10,2) DEFAULT NULL,
  `jml_so` decimal(10,2) DEFAULT NULL,
  `jml_sls` decimal(10,2) DEFAULT NULL,
  `jml_satuan` int(11) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `sp` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_so` (`id_so`),
  CONSTRAINT `FK_tbl_util_so_det_tbl_util_so` FOREIGN KEY (`id_so`) REFERENCES `tbl_util_so` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_util_so_det: ~0 rows (approximately)
DELETE FROM `tbl_util_so_det`;

-- Dumping structure for view db_p48_ars.v_item
DROP VIEW IF EXISTS `v_item`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_item` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NULL,
	`id_kategori` INT(11) NULL,
	`id_merk` INT(11) NULL,
	`id_satuan` INT(11) NULL,
	`tgl_simpan` DATETIME NULL,
	`tgl_modif` DATETIME NULL,
	`kode` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`kategori` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`merk` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`item` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`item2` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jml` DECIMAL(10,2) NULL,
	`harga_beli` DECIMAL(65,2) NULL,
	`harga_jual` DECIMAL(65,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8_general_ci',
	`status_stok` ENUM('0','1') NULL COLLATE 'utf8_general_ci',
	`status` ENUM('0','1') NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_item_hist
DROP VIEW IF EXISTS `v_item_hist`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_item_hist` (
	`id` INT(11) NOT NULL,
	`id_item` INT(11) NOT NULL,
	`id_gudang` INT(11) NULL,
	`tgl_simpan` DATETIME NULL,
	`tgl_modif` DATETIME NULL,
	`tgl_masuk` DATETIME NULL,
	`username` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`gudang` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`kode` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`item` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jml` INT(11) NULL,
	`jml_satuan` INT(11) NULL,
	`satuan` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`nominal` DECIMAL(10,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8_general_ci',
	`status` ENUM('0','1','2','3','4','5','6','7','8') NULL COMMENT '1 = Stok Masuk Pembelian\\\\\\\\r\\\\\\\\n2 = Stok Masuk\\\\\\\\r\\\\\\\\n3 = Stok Masuk Retur Jual\\\\\\\\r\\\\\\\\n4 = Stok Keluar Penjualan\\\\\\\\r\\\\\\\\n5 = Stok Keluar Retur Beli\\\\\\\\r\\\\\\\\n6 = SO\\\\\\\\r\\\\\\\\n7 = Stok Keluar\\\\\\\\r\\\\\\\\n8 = Mutasi Antar Gd' COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_item_stok
DROP VIEW IF EXISTS `v_item_stok`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_item_stok` (
	`id` INT(11) NOT NULL,
	`id_item` INT(11) NOT NULL,
	`id_satuan` INT(11) NULL,
	`id_gudang` INT(11) NULL,
	`id_user` INT(11) NULL,
	`tgl_simpan` TIMESTAMP NULL,
	`tgl_modif` DATETIME NULL,
	`gudang` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`jml` FLOAT NULL,
	`jml_satuan` FLOAT NULL,
	`satuan` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`status` ENUM('0','1','2') NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_beli
DROP VIEW IF EXISTS `v_trans_beli`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_beli` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_supplier` INT(11) NOT NULL,
	`id_po` INT(11) NULL,
	`id_penerima` INT(11) NULL,
	`tgl_simpan` DATETIME NULL,
	`tgl_masuk` DATE NULL,
	`tgl_keluar` DATE NULL,
	`username` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`c_nama` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_no_telp` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_no_fax` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_logo` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`kode` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`npwp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`supplier` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8_general_ci',
	`no_telp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`cp` TINYTEXT NULL COLLATE 'utf8_general_ci',
	`no_po` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jml_total` DECIMAL(32,2) NULL,
	`disk1` DECIMAL(32,2) NULL,
	`disk2` DECIMAL(32,2) NULL,
	`disk3` DECIMAL(32,2) NULL,
	`jml_potongan` DECIMAL(32,2) NULL,
	`jml_diskon` DECIMAL(32,2) NULL,
	`jml_biaya` DECIMAL(32,2) NULL,
	`jml_subtotal` DECIMAL(32,2) NULL,
	`ppn` INT(11) NULL,
	`jml_ppn` DECIMAL(32,2) NULL,
	`jml_gtotal` DECIMAL(32,2) NULL,
	`jml_bayar` DECIMAL(32,2) NULL,
	`status` ENUM('0','1','2') NULL COLLATE 'latin1_swedish_ci',
	`status_ppn` ENUM('0','1','2') NULL COLLATE 'latin1_swedish_ci',
	`status_bayar` ENUM('0','1') NULL COLLATE 'latin1_swedish_ci',
	`status_penerimaan` ENUM('0','1','2','3') NULL COLLATE 'latin1_swedish_ci',
	`metode_bayar` VARCHAR(1) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_jual
DROP VIEW IF EXISTS `v_trans_jual`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_jual` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_rab` INT(11) NOT NULL,
	`id_perusahaan` INT(11) NULL,
	`id_sales` INT(11) NULL,
	`id_pelanggan` INT(11) NULL,
	`id_platform` INT(11) NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_modif` DATETIME NOT NULL,
	`tgl_masuk` DATE NULL,
	`tgl_keluar` DATE NULL,
	`tgl_bayar` DATE NULL,
	`tipe` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`sales` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`c_nama` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`p_nama` VARCHAR(1) NULL COLLATE 'utf8_unicode_ci',
	`p_alamat` TEXT NULL COLLATE 'utf8_unicode_ci',
	`no_rab` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`no_kontrak` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`no_paket` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jml_total` DECIMAL(32,2) NULL,
	`jml_ppn` DECIMAL(32,2) NULL,
	`ppn` INT(11) NULL,
	`jml_gtotal` DECIMAL(32,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8_general_ci',
	`status` ENUM('0','1','2','3','4') NULL COMMENT '\r\n1=pos\r\n2=rajal\r\n3=ranap' COLLATE 'utf8_general_ci',
	`status_nota` INT(11) NULL COMMENT '1=anamnesa\\\\r\\\\n2=pemeriksaan\\\\r\\\\n3=tindakan\\\\r\\\\n4=obat\\\\r\\\\n5=dokter\\\\r\\\\n6=pembayaran\\\\r\\\\n7=finish',
	`status_ppn` ENUM('0','1') NULL COLLATE 'utf8_general_ci',
	`status_bayar` ENUM('0','1','2') NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_mutasi
DROP VIEW IF EXISTS `v_trans_mutasi`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_mutasi` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_perusahaan` INT(11) NULL,
	`id_penjualan` INT(11) NULL,
	`id_gd_asal` INT(11) NOT NULL,
	`id_gd_tujuan` INT(11) NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_masuk` DATE NOT NULL,
	`user` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`no_mutasi` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`c_nama` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`sales` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`no_nota` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`p_nama` VARCHAR(1) NULL COLLATE 'utf8_unicode_ci',
	`gd_asal` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`keterangan` TEXT NULL COLLATE 'utf8_general_ci',
	`tipe` ENUM('0','1','2','3','4') NULL COMMENT '1 = Pindah Gudang\\r\\n2 = Stok Masuk\\r\\n3 = Stok Keluar\\r\\n4 = Pengiriman (dengan nota invoice)' COLLATE 'utf8_general_ci',
	`status` ENUM('0','1','2','3','4') NULL COLLATE 'utf8_general_ci',
	`status_terima` ENUM('0','1') NULL COLLATE 'utf8_general_ci',
	`status_hps` ENUM('0','1') NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_pesanan
DROP VIEW IF EXISTS `v_trans_pesanan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_pesanan` (
	`id` INT(11) NOT NULL,
	`id_pelanggan` INT(11) NOT NULL,
	`id_sales` INT(11) NOT NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_masuk_pm` DATETIME NULL,
	`no_nota` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`pelanggan` TEXT NULL COLLATE 'utf8_unicode_ci',
	`keterangan` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`sales` VARCHAR(1) NULL COLLATE 'latin1_general_ci',
	`status` INT(11) NULL COMMENT '0=baru\r\n1=proses\r\n2=rab'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_po
DROP VIEW IF EXISTS `v_trans_po`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_po` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_perusahaan` INT(11) NOT NULL,
	`id_supplier` INT(11) NOT NULL,
	`id_rab` INT(11) NULL,
	`id_penjualan` INT(11) NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_masuk` DATE NOT NULL,
	`username` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`c_nama` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_no_telp` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_no_fax` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_logo` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`kode` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`npwp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`supplier` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8_general_ci',
	`no_telp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`cp` TINYTEXT NULL COLLATE 'utf8_general_ci',
	`no_po` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`keterangan` TEXT NULL COLLATE 'latin1_swedish_ci',
	`status_nota` INT(11) NULL COMMENT 'Untuk mencatat status nota, sudah proses atau belum',
	`status_fkt` INT(11) NULL COMMENT 'Untuk mencatat status faktur'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_rab
DROP VIEW IF EXISTS `v_trans_rab`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_rab` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_sales` INT(11) NOT NULL,
	`id_pelanggan` INT(11) NOT NULL,
	`id_perusahaan` INT(11) NOT NULL,
	`id_tipe` INT(11) NOT NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_modif` DATETIME NOT NULL,
	`tgl_masuk` DATE NOT NULL,
	`username` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`sales` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`c_nama` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`p_nama` VARCHAR(1) NULL COLLATE 'utf8_unicode_ci',
	`p_alamat` TEXT NULL COLLATE 'utf8_unicode_ci',
	`tipe` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`no_rab` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`no_kontrak` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`no_paket` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`jml_hps` DECIMAL(15,2) NULL,
	`jml_pagu` DECIMAL(15,2) NULL,
	`jml_total` DECIMAL(15,2) NULL,
	`ppn` DECIMAL(15,2) NULL,
	`jml_ppn` DECIMAL(15,2) NULL,
	`pph` DECIMAL(15,2) NULL,
	`jml_pph` DECIMAL(15,2) NULL,
	`jml_gtotal` DECIMAL(15,2) NULL,
	`jml_biaya` DECIMAL(15,2) NULL,
	`jml_hpp` DECIMAL(15,2) NULL,
	`jml_hpp_ppn` DECIMAL(15,2) NULL,
	`jml_profit` DECIMAL(15,2) NULL,
	`status` ENUM('0','1','2','3','4','5','6') NULL COMMENT '0=draft;‧1=submit / proses;‧2=approve / terima;‧3=reject / tolak / revisi;‧4=win;‧5=lose;‧6=posting;‧‧** Jika approve maka status lead dan bisa lanjut ke win‧*** Setelah win baru bisa posting ke penjualan' COLLATE 'latin1_swedish_ci',
	`status_ppn` ENUM('0','1','2') NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_p48_ars.v_trans_rab_log
DROP VIEW IF EXISTS `v_trans_rab_log`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_rab_log` (
	`id` INT(11) NOT NULL,
	`id_rab` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_modif` DATETIME NOT NULL,
	`user` VARCHAR(1) NULL COMMENT 'Untuk nama user' COLLATE 'utf8_general_ci',
	`log` TEXT NULL COLLATE 'latin1_swedish_ci',
	`status` INT(11) NULL COMMENT '0=default;‧1=insert;‧2=update;‧3=soft_delete;‧4=delete;‧'
) ENGINE=MyISAM;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_item` AS SELECT 
    `tbl_m_item`.`id` AS `id`,
    `tbl_m_item`.`id_user` AS `id_user`,
    `tbl_m_item`.`id_kategori` AS `id_kategori`,
    `tbl_m_item`.`id_merk` AS `id_merk`,
    `tbl_m_item`.`id_satuan` AS `id_satuan`,
    `tbl_m_item`.`tgl_simpan` AS `tgl_simpan`,
    `tbl_m_item`.`tgl_modif` AS `tgl_modif`,
    `tbl_m_item`.`kode` AS `kode`,
    `tbl_m_kategori`.`kategori` AS `kategori`,
    `tbl_m_merk`.`merk` AS `merk`,
    UPPER(`tbl_m_item`.`item`) AS item,
    UPPER(CONCAT(`tbl_m_merk`.`merk`, ' ', `tbl_m_kategori`.`kategori`, ' ', `tbl_m_item`.`item`)) AS `item2`,
    `tbl_m_item`.`jml` AS `jml`,
    `tbl_m_item`.`harga_beli` AS `harga_beli`,
    `tbl_m_item`.`harga_jual` AS `harga_jual`,
    `tbl_m_item`.`keterangan` AS `keterangan`,
    `tbl_m_item`.`status_stok` AS `status_stok`,
    `tbl_m_item`.`status` AS `status`
FROM 
    `tbl_m_item`
JOIN 
    `tbl_m_kategori` ON `tbl_m_item`.`id_kategori` = `tbl_m_kategori`.`id`
LEFT JOIN 
    `tbl_m_merk` ON `tbl_m_item`.`id_merk` = `tbl_m_merk`.`id`
JOIN 
    `tbl_m_satuan` ON `tbl_m_item`.`id_satuan` = `tbl_m_satuan`.`id`
ORDER BY 
    `tbl_m_item`.`item` ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item_hist`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_item_hist` AS select `tbl_m_item_hist`.`id` AS `id`,`tbl_m_item_hist`.`id_item` AS `id_item`,`tbl_m_item_hist`.`id_gudang` AS `id_gudang`,`tbl_m_item_hist`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item_hist`.`tgl_modif` AS `tgl_modif`,`tbl_m_item_hist`.`tgl_masuk` AS `tgl_masuk`,`tbl_ion_users`.`username` AS `username`,`tbl_m_gudang`.`gudang` AS `gudang`,`tbl_m_item_hist`.`no_nota` AS `no_nota`,`tbl_m_item_hist`.`kode` AS `kode`,`tbl_m_item_hist`.`item` AS `item`,`tbl_m_item_hist`.`jml` AS `jml`,`tbl_m_item_hist`.`jml_satuan` AS `jml_satuan`,`tbl_m_item_hist`.`satuan` AS `satuan`,`tbl_m_item_hist`.`nominal` AS `nominal`,`tbl_m_item_hist`.`keterangan` AS `keterangan`,`tbl_m_item_hist`.`status` AS `status` from ((`tbl_m_item_hist` join `tbl_m_gudang` on(`tbl_m_item_hist`.`id_gudang` = `tbl_m_gudang`.`id`)) join `tbl_ion_users` on(`tbl_m_item_hist`.`id_user` = `tbl_ion_users`.`id`)) order by `tbl_m_item_hist`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item_stok`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_item_stok` AS select `tbl_m_item_stok`.`id` AS `id`,`tbl_m_item_stok`.`id_item` AS `id_item`,`tbl_m_item_stok`.`id_satuan` AS `id_satuan`,`tbl_m_item_stok`.`id_gudang` AS `id_gudang`,`tbl_m_item_stok`.`id_user` AS `id_user`,`tbl_m_item_stok`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item_stok`.`tgl_modif` AS `tgl_modif`,`tbl_m_gudang`.`gudang` AS `gudang`,`tbl_m_item_stok`.`jml` AS `jml`,`tbl_m_item_stok`.`jml_satuan` AS `jml_satuan`,`tbl_m_item_stok`.`satuan` AS `satuan`,`tbl_m_item_stok`.`status` AS `status` from (`tbl_m_item_stok` join `tbl_m_gudang` on(`tbl_m_item_stok`.`id_gudang` = `tbl_m_gudang`.`id`)) order by `tbl_m_item_stok`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_beli`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_beli` AS select `tbl_trans_beli`.`id` AS `id`,`tbl_trans_beli`.`id_user` AS `id_user`,`tbl_trans_beli`.`id_supplier` AS `id_supplier`,`tbl_trans_beli`.`id_po` AS `id_po`,`tbl_trans_beli`.`id_penerima` AS `id_penerima`,`tbl_trans_beli`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_beli`.`tgl_masuk` AS `tgl_masuk`,`tbl_trans_beli`.`tgl_keluar` AS `tgl_keluar`,`tbl_ion_users`.`username` AS `username`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`no_telp` AS `c_no_telp`,`tbl_pengaturan_profile`.`no_fax` AS `c_no_fax`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_pengaturan_profile`.`logo` AS `c_logo`,`tbl_m_supplier`.`kode` AS `kode`,`tbl_m_supplier`.`npwp` AS `npwp`,`tbl_m_supplier`.`nama` AS `supplier`,`tbl_m_supplier`.`alamat` AS `alamat`,`tbl_m_supplier`.`no_telp` AS `no_telp`,`tbl_m_supplier`.`cp` AS `cp`,`tbl_trans_beli`.`no_po` AS `no_po`,`tbl_trans_beli`.`no_nota` AS `no_nota`,`tbl_trans_beli`.`jml_total` AS `jml_total`,`tbl_trans_beli`.`disk1` AS `disk1`,`tbl_trans_beli`.`disk2` AS `disk2`,`tbl_trans_beli`.`disk3` AS `disk3`,`tbl_trans_beli`.`jml_potongan` AS `jml_potongan`,`tbl_trans_beli`.`jml_diskon` AS `jml_diskon`,`tbl_trans_beli`.`jml_biaya` AS `jml_biaya`,`tbl_trans_beli`.`jml_subtotal` AS `jml_subtotal`,`tbl_trans_beli`.`ppn` AS `ppn`,`tbl_trans_beli`.`jml_ppn` AS `jml_ppn`,`tbl_trans_beli`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_beli`.`jml_bayar` AS `jml_bayar`,`tbl_trans_beli`.`status` AS `status`,`tbl_trans_beli`.`status_ppn` AS `status_ppn`,`tbl_trans_beli`.`status_bayar` AS `status_bayar`,`tbl_trans_beli`.`status_penerimaan` AS `status_penerimaan`,`tbl_trans_beli`.`metode_bayar` AS `metode_bayar` from (((`tbl_trans_beli` join `tbl_m_supplier` on(`tbl_trans_beli`.`id_supplier` = `tbl_m_supplier`.`id`)) join `tbl_ion_users` on(`tbl_trans_beli`.`id_user` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_beli`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_beli`.`status_hps` = '0' order by `tbl_trans_beli`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_jual`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_jual` AS select `tbl_trans_jual`.`id` AS `id`,`tbl_trans_jual`.`id_user` AS `id_user`,`tbl_trans_jual`.`id_rab` AS `id_rab`,`tbl_trans_jual`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_jual`.`id_sales` AS `id_sales`,`tbl_trans_jual`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_jual`.`id_platform` AS `id_platform`,`tbl_trans_jual`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_jual`.`tgl_modif` AS `tgl_modif`,`tbl_trans_jual`.`tgl_masuk` AS `tgl_masuk`,`tbl_trans_jual`.`tgl_keluar` AS `tgl_keluar`,`tbl_trans_jual`.`tgl_bayar` AS `tgl_bayar`,`tbl_m_tipe`.`tipe` AS `tipe`,`tbl_ion_users`.`first_name` AS `sales`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_pelanggan`.`alamat` AS `p_alamat`,`tbl_trans_rab`.`no_rab` AS `no_rab`,`tbl_trans_jual`.`no_nota` AS `no_nota`,`tbl_trans_jual`.`no_kontrak` AS `no_kontrak`,`tbl_trans_jual`.`no_paket` AS `no_paket`,`tbl_trans_jual`.`jml_total` AS `jml_total`,`tbl_trans_jual`.`jml_ppn` AS `jml_ppn`,`tbl_trans_jual`.`ppn` AS `ppn`,`tbl_trans_jual`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_jual`.`keterangan` AS `keterangan`,`tbl_trans_jual`.`status` AS `status`,`tbl_trans_jual`.`status_nota` AS `status_nota`,`tbl_trans_jual`.`status_ppn` AS `status_ppn`,`tbl_trans_jual`.`status_bayar` AS `status_bayar` from (((((`tbl_trans_jual` left join `tbl_trans_rab` on(`tbl_trans_jual`.`id_rab` = `tbl_trans_rab`.`id`)) join `tbl_m_pelanggan` on(`tbl_trans_jual`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_m_tipe` on(`tbl_trans_jual`.`id_tipe` = `tbl_m_tipe`.`id`)) join `tbl_ion_users` on(`tbl_trans_jual`.`id_sales` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_jual`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_jual`.`status_hps` = '0' order by `tbl_trans_jual`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_mutasi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_mutasi` AS select `tbl_trans_mutasi`.`id` AS `id`,`tbl_trans_mutasi`.`id_user` AS `id_user`,`tbl_trans_mutasi`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_mutasi`.`id_penjualan` AS `id_penjualan`,`tbl_trans_mutasi`.`id_gd_asal` AS `id_gd_asal`,`tbl_trans_mutasi`.`id_gd_tujuan` AS `id_gd_tujuan`,`tbl_trans_mutasi`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_mutasi`.`tgl_masuk` AS `tgl_masuk`,`Users`.`first_name` AS `user`,`tbl_trans_mutasi`.`no_nota` AS `no_mutasi`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`Sales`.`first_name` AS `sales`,`tbl_trans_jual`.`no_nota` AS `no_nota`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_gudang`.`gudang` AS `gd_asal`,`tbl_trans_mutasi`.`keterangan` AS `keterangan`,`tbl_trans_mutasi`.`tipe` AS `tipe`,`tbl_trans_mutasi`.`status` AS `status`,`tbl_trans_mutasi`.`status_terima` AS `status_terima`,`tbl_trans_mutasi`.`status_hps` AS `status_hps` from ((((((`tbl_trans_mutasi` join `tbl_m_gudang` on(`tbl_trans_mutasi`.`id_gd_asal` = `tbl_m_gudang`.`id`)) left join `tbl_m_pelanggan` on(`tbl_trans_mutasi`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_ion_users` `Users` on(`tbl_trans_mutasi`.`id_user` = `Users`.`id`)) left join `tbl_ion_users` `Sales` on(`tbl_trans_mutasi`.`id_sales` = `Sales`.`id`)) left join `tbl_trans_jual` on(`tbl_trans_mutasi`.`id_penjualan` = `tbl_trans_jual`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_mutasi`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) order by `tbl_trans_mutasi`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_pesanan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_pesanan` AS select `tbl_trans_pesanan`.`id` AS `id`,`tbl_trans_pesanan`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_pesanan`.`id_sales` AS `id_sales`,`tbl_trans_pesanan`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_pesanan`.`tgl_masuk_pm` AS `tgl_masuk_pm`,`tbl_trans_pesanan`.`no_nota` AS `no_nota`,concat('[',`tbl_m_pelanggan`.`kode`,'] ',`tbl_m_pelanggan`.`nama`) AS `pelanggan`,`tbl_trans_pesanan`.`keterangan` AS `keterangan`,`tbl_m_karyawan`.`nama` AS `sales`,`tbl_trans_pesanan`.`status` AS `status` from ((`tbl_trans_pesanan` join `tbl_m_karyawan` on(`tbl_trans_pesanan`.`id_sales` = `tbl_m_karyawan`.`id_user`)) join `tbl_m_pelanggan` on(`tbl_trans_pesanan`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) order by `tbl_trans_pesanan`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_po`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_po` AS select `tbl_trans_beli_po`.`id` AS `id`,`tbl_trans_beli_po`.`id_user` AS `id_user`,`tbl_trans_beli_po`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_beli_po`.`id_supplier` AS `id_supplier`,`tbl_trans_beli_po`.`id_rab` AS `id_rab`,`tbl_trans_beli_po`.`id_penjualan` AS `id_penjualan`,`tbl_trans_beli_po`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_beli_po`.`tgl_masuk` AS `tgl_masuk`,`tbl_ion_users`.`username` AS `username`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`no_telp` AS `c_no_telp`,`tbl_pengaturan_profile`.`no_fax` AS `c_no_fax`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_pengaturan_profile`.`logo` AS `c_logo`,`tbl_m_supplier`.`kode` AS `kode`,`tbl_m_supplier`.`npwp` AS `npwp`,`tbl_m_supplier`.`nama` AS `supplier`,`tbl_m_supplier`.`alamat` AS `alamat`,`tbl_m_supplier`.`no_telp` AS `no_telp`,`tbl_m_supplier`.`cp` AS `cp`,`tbl_trans_beli_po`.`no_po` AS `no_po`,`tbl_trans_beli_po`.`keterangan` AS `keterangan`,`tbl_trans_beli_po`.`status_nota` AS `status_nota`,`tbl_trans_beli_po`.`status_fkt` AS `status_fkt` from (((`tbl_trans_beli_po` join `tbl_m_supplier` on(`tbl_trans_beli_po`.`id_supplier` = `tbl_m_supplier`.`id`)) join `tbl_ion_users` on(`tbl_trans_beli_po`.`id_user` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_beli_po`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_beli_po`.`status_hps` = '0' order by `tbl_trans_beli_po`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_rab`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_rab` AS select `tbl_trans_rab`.`id` AS `id`,`tbl_trans_rab`.`id_user` AS `id_user`,`tbl_trans_rab`.`id_sales` AS `id_sales`,`tbl_trans_rab`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_rab`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_rab`.`id_tipe` AS `id_tipe`,`tbl_trans_rab`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_rab`.`tgl_modif` AS `tgl_modif`,`tbl_trans_rab`.`tgl_masuk` AS `tgl_masuk`,`Usr`.`first_name` AS `username`,`tbl_ion_users`.`first_name` AS `sales`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_pelanggan`.`alamat` AS `p_alamat`,`tbl_m_tipe`.`tipe` AS `tipe`,`tbl_trans_rab`.`no_rab` AS `no_rab`,`tbl_trans_rab`.`no_kontrak` AS `no_kontrak`,`tbl_trans_rab`.`no_paket` AS `no_paket`,`tbl_trans_rab`.`jml_hps` AS `jml_hps`,`tbl_trans_rab`.`jml_pagu` AS `jml_pagu`,`tbl_trans_rab`.`jml_total` AS `jml_total`,`tbl_trans_rab`.`ppn` AS `ppn`,`tbl_trans_rab`.`jml_ppn` AS `jml_ppn`,`tbl_trans_rab`.`pph` AS `pph`,`tbl_trans_rab`.`jml_pph` AS `jml_pph`,`tbl_trans_rab`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_rab`.`jml_biaya` AS `jml_biaya`,`tbl_trans_rab`.`jml_hpp` AS `jml_hpp`,`tbl_trans_rab`.`jml_hpp_ppn` AS `jml_hpp_ppn`,`tbl_trans_rab`.`jml_profit` AS `jml_profit`,`tbl_trans_rab`.`status` AS `status`,`tbl_trans_rab`.`status_ppn` AS `status_ppn` from (((((`tbl_trans_rab` join `tbl_ion_users` on(`tbl_trans_rab`.`id_sales` = `tbl_ion_users`.`id`)) join `tbl_ion_users` `Usr` on(`tbl_trans_rab`.`id_user` = `Usr`.`id`)) join `tbl_m_pelanggan` on(`tbl_trans_rab`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_m_tipe` on(`tbl_trans_rab`.`id_tipe` = `tbl_m_tipe`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_rab`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_rab`.`status_hps` = '0' order by `tbl_trans_rab`.`id` desc ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_rab_log`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_trans_rab_log` AS select `tbl_trans_rab_log`.`id` AS `id`,`tbl_trans_rab_log`.`id_rab` AS `id_rab`,`tbl_trans_rab_log`.`id_user` AS `id_user`,`tbl_trans_rab_log`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_rab_log`.`tgl_modif` AS `tgl_modif`,`tbl_ion_users`.`first_name` AS `user`,`tbl_trans_rab_log`.`log` AS `log`,`tbl_trans_rab_log`.`status` AS `status` from ((`tbl_trans_rab_log` join `v_trans_rab` on(`tbl_trans_rab_log`.`id_rab` = `v_trans_rab`.`id`)) join `tbl_ion_users` on(`tbl_trans_rab_log`.`id_user` = `tbl_ion_users`.`id`)) order by `tbl_trans_rab_log`.`id` desc ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
