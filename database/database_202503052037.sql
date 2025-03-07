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
	(2, 'superadmin', '112.78.39.51', '$2y$10$B8gNk6Tlf8KMTbRDSFqz8eGN0V8vmSwMZsx4EfzwGf1fvc22/wefm', 'EBo75QJvR14a7H9c', 'noreply@esensia.co.id', NULL, NULL, NULL, NULL, NULL, 'c4fb3576a8f6820a5a1626a78875e03307a2188a', '$2y$10$Tj97fXOUoj.YCuW5zr26JeSuJEfOZXhLDEAmG9iB4vu5QdqVVKUl2', 1560132540, 1741180569, 1, NULL, 'SUPERADMIN', 'S.Kom', '2024-04-14', NULL, NULL, NULL, 'profile_2superadmin.png', '', '1'),
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
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

-- Dumping data for table db_p48_ars.tbl_m_gudang: ~1 rows (approximately)
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
  `harga_beli` decimal(10,2) DEFAULT 0.00,
  `harga_jual` decimal(10,2) DEFAULT 0.00,
  `status_stok` enum('0','1') DEFAULT '0',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_item: ~0 rows (approximately)
DELETE FROM `tbl_m_item`;

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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` datetime DEFAULT '0000-00-00 00:00:00',
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `tgl_simpan` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `jml` float DEFAULT 0,
  `jml_satuan` float DEFAULT 1,
  `satuan` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `sp` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_m_item_stok_tbl_m_item` (`id_item`),
  CONSTRAINT `FK_tbl_m_item_stok_tbl_m_item` FOREIGN KEY (`id_item`) REFERENCES `tbl_m_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_m_item_stok: ~0 rows (approximately)
DELETE FROM `tbl_m_item_stok`;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
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

-- Dumping data for table db_p48_ars.tbl_m_karyawan: ~1 rows (approximately)
DELETE FROM `tbl_m_karyawan`;
INSERT INTO `tbl_m_karyawan` (`id`, `id_user`, `id_user_group`, `id_perusahaan`, `tgl_simpan`, `tgl_modif`, `kode`, `nik`, `nama`, `nama_blk`, `jns_klm`, `no_hp`, `alamat`, `alamat_dom`, `tmp_lahir`, `tgl_lahir`, `file_name`, `file_ext`, `file_type`, `status`) VALUES
	(1, 1, 2, 0, '2022-12-22 22:28:13', '2024-06-23 21:03:06', 'PG-001', '337407150292002', 'MIKHAEL FELIAN WASKITO', '', 'L', '085741220427', '-', '-', 'Semarang', '1954-02-02', NULL, NULL, NULL, 0);

-- Dumping structure for table db_p48_ars.tbl_m_karyawan_cuti
DROP TABLE IF EXISTS `tbl_m_karyawan_cuti`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `nm_ayah` varchar(160) DEFAULT NULL,
  `nm_ibu` varchar(160) DEFAULT NULL,
  `nm_pasangan` varchar(160) DEFAULT NULL,
  `nm_anak` text DEFAULT NULL,
  `tgl_lhr_ayah` date DEFAULT '0000-00-00',
  `tgl_lhr_ibu` date DEFAULT '0000-00-00',
  `tgl_lhr_psg` date DEFAULT '0000-00-00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `no_dok` varchar(160) DEFAULT NULL,
  `pt` varchar(160) DEFAULT NULL,
  `instansi` varchar(160) DEFAULT NULL,
  `tipe` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_masuk` date DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
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
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_p48_ars.tbl_m_pelanggan: ~3 rows (approximately)
DELETE FROM `tbl_m_pelanggan`;
INSERT INTO `tbl_m_pelanggan` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `no_telp`, `alamat`, `kota`, `provinsi`, `tipe`, `status`) VALUES
	(1, 10, '2024-09-24 13:55:56', '2024-09-24 13:55:56', 'PLG-00001', 'Universitas Diponegoro', '', 'Jl. Prof. Soedarto No.13, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275', 'KOTA SEMARANG', 'JAWA TENGAH', '2', '1'),
	(2, 17, '2024-09-26 13:36:49', '2024-09-26 13:36:49', 'PLG-00002', 'OJK Provinsi Jawa Tengah', '(024) 86003000', 'Jl. Kyai Saleh No.12 - 14, Mugassari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50243', 'SEMARANG', 'JAWA TENGAH', '2', '1'),
	(3, 2, '2025-03-01 12:29:25', '2025-03-01 12:29:25', 'PLG-00003', 'pip semarang', '08726254232', 'tes', 'SEMARANG', 'JATENG', '2', '1');

-- Dumping structure for table db_p48_ars.tbl_m_pelanggan_cp
DROP TABLE IF EXISTS `tbl_m_pelanggan_cp`;
CREATE TABLE IF NOT EXISTS `tbl_m_pelanggan_cp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `cp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_m_supplier: ~3 rows (approximately)
DELETE FROM `tbl_m_supplier`;
INSERT INTO `tbl_m_supplier` (`id`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `npwp`, `alamat`, `kota`, `provinsi`, `no_telp`, `no_hp`, `cp`, `status`) VALUES
	(1, '2024-09-24 14:12:37', '2024-09-24 14:12:37', 'PRSC-00001', 'PT Seroja Putra', NULL, 'JL. KH. Ahmad Dalan', 'SEMARANG', 'JAWA TENGAH', '-', '-', NULL, '1'),
	(2, '2024-09-26 10:15:12', '2024-09-26 10:15:12', 'PRSC-00002', 'PT DINAMIKA GUNA SARANA', NULL, 'Komplek Ruko Pangeran Jayakarta Center\r\nJl. Pangeran Jayakarta No.73 Blok D2 No. 7-8, RT.3/RW.6\r\nMangga Dua Selatan', 'JAKARTA', 'DKI JAKARTA', '0821-1035-2225', '0821-1035-2225', NULL, '1'),
	(3, '2024-09-26 14:07:03', '2024-09-26 14:07:03', 'PRSC-00003', 'ELECTRO VOICE', NULL, 'JAKARTA UTARA ', 'JAKARTA UTARA', 'JAKARTA', '08111209298', '', NULL, '1');

-- Dumping structure for table db_p48_ars.tbl_m_tipe
DROP TABLE IF EXISTS `tbl_m_tipe`;
CREATE TABLE IF NOT EXISTS `tbl_m_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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

-- Dumping data for table db_p48_ars.tbl_pengaturan: ~1 rows (approximately)
DELETE FROM `tbl_pengaturan`;
INSERT INTO `tbl_pengaturan` (`id`, `id_app`, `website`, `judul`, `judul_app`, `url_app`, `favicon`, `logo`, `logo_header`, `logo_header_kop`, `deskripsi`, `deskripsi_pendek`, `notifikasi`, `alamat`, `kota`, `email`, `pesan`, `tlp`, `fax`, `kode_plgn`, `kode_kary`, `kode_supp`, `kode_po`, `kode_psn`, `kode_rab`, `kode_penj`, `kode_mts`, `kode_do`, `ppn`, `dpp`, `pph`, `ppn_tot`, `jml_ppn`, `jml_item`, `jml_limit_stok`, `jml_limit_tempo`, `status_app`) VALUES
	(1, 1, 'serbaaneka.co.id', 'Serbaneka Guna Abadi', 'SERBANEKA', 'https://sap.serbaaneka.co.id', 'pkm_logo.png', 'logo_ptsga.png', 'logo_hdr_ptsga.png', '', '', '', '', '', 'Semarang', 'mikhaelfelian@gmail.com', '', '', '', 'PLG', 'PG', 'PRSC', NULL, NULL, NULL, NULL, 'MTS', 'DO', 1.11, 1.11, 1.50, 111, 11, 10, 12, 10, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_pengaturan_profile: ~1 rows (approximately)
DELETE FROM `tbl_pengaturan_profile`;
INSERT INTO `tbl_pengaturan_profile` (`id`, `id_pengaturan`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode_srt_dpn`, `kode_inv_dpn`, `kode_rab_dpn`, `kode_po_dpn`, `kode_kwi_dpn`, `kode_srt_blk`, `npwp`, `nama`, `no_telp`, `no_fax`, `alamat`, `kota`, `email`, `kbli`, `logo`, `logo_kop`, `logo_wm`, `rek_bank`, `rek_nama`, `rek_nomor`, `direktur`, `keterangan`, `status`) VALUES
	(2, 1, 2, '2024-05-23 04:20:51', '2025-03-03 18:28:10', 'BQ', 'INV', 'RAB', 'PO', 'KWI', 'SGA', '81.0000000000000000000000', 'PT. SERBANEKA GUNA ABADI', '-', '-', 'Jalan Jalan Sore', 'SEMARANG', '', NULL, 'logo_prof_ptpratamakreasimandiri.png', '', 'logo_prof_ptsga_wm.png', 'PT Bank Central Asia Tbk.', '', 'xxxxxxxxxx', 'Alfiab HARI', NULL, 1);

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

-- Dumping data for table db_p48_ars.tbl_pengaturan_theme: ~1 rows (approximately)
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

-- Dumping data for table db_p48_ars.tbl_sessions: ~43 rows (approximately)
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
	('siap_session:c5c8teru94f8m7jva04kc7g0s7ino6fh', '::1', '2025-03-05 13:25:20', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313138313131333b736961705f746f6b656e7c733a33323a223439396637396434393535356436383036323938656336343739666332626139223b5f63695f70726576696f75735f75726c7c733a35333a22687474703a2f2f6c6f63616c686f73742f7034382d617273616b68612f6d61737465722f646174615f6b617465676f72692e706870223b6964656e746974797c733a31303a22737570657261646d696e223b757365726e616d657c733a31303a22737570657261646d696e223b656d61696c7c733a32313a226e6f7265706c79406573656e7369612e636f2e6964223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373431313739323932223b6c6173745f636865636b7c693a313734313138303536393b);

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

-- Dumping data for table db_p48_ars.tbl_sessions_front: ~1 rows (approximately)
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_terima` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
  `tgl_bayar` date DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table db_p48_ars.tbl_trans_jual_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_det`;

-- Dumping structure for table db_p48_ars.tbl_trans_jual_file
DROP TABLE IF EXISTS `tbl_trans_jual_file`;
CREATE TABLE IF NOT EXISTS `tbl_trans_jual_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_berkas` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `judul` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_ext` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `tipe` int(11) DEFAULT 0 COMMENT '1=BAST;\r\n2=Kontrak;\r\n3=Faktur;\r\n4=SP2D;',
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK__tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Unggah dokumen penjualan';

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `log` text DEFAULT '0000-00-00 00:00:00',
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_jual_log_tbl_trans_jual` (`id_penjualan`),
  CONSTRAINT `FK_tbl_trans_jual_log_tbl_trans_jual` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_trans_jual` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
  `no_nota` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tipe` enum('0','1','2','3','4') DEFAULT '0' COMMENT '1 = Pindah Gudang\\r\\n2 = Stok Masuk\\r\\n3 = Stok Keluar\\r\\n4 = Pengiriman (dengan nota invoice)',
  `status` enum('0','1','2','3','4') DEFAULT '0',
  `status_hps` enum('0','1') DEFAULT '0',
  `status_terima` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `no_nota` (`no_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Mencatat transaksi mutasi keluar masuk gudang';

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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_terima` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Mencatat transaksi mutasi antar gudang';

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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` datetime DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk_pm` datetime DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk_pm` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_keluar_pm` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log` text DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=default;‧1=insert;‧2=update;‧3=soft_delete;‧4=delete;‧',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_trans_rab_log_tbl_trans_rab` (`id_rab`),
  CONSTRAINT `FK_tbl_trans_rab_log_tbl_trans_rab` FOREIGN KEY (`id_rab`) REFERENCES `tbl_trans_rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_p48_ars.tbl_trans_rab_log: ~0 rows (approximately)
DELETE FROM `tbl_trans_rab_log`;

-- Dumping structure for table db_p48_ars.tbl_trans_rab_pen
DROP TABLE IF EXISTS `tbl_trans_rab_pen`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab_pen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `no_surat` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__tbl_trans_rab` (`id_rab`),
  CONSTRAINT `FK__tbl_trans_rab` FOREIGN KEY (`id_rab`) REFERENCES `tbl_trans_rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Untuk menyimpan penawaran';

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
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
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
	`harga_beli` DECIMAL(10,2) NULL,
	`harga_jual` DECIMAL(10,2) NULL,
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
	`cp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
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
	`cp` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
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
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_item` AS select `tbl_m_item`.`id` AS `id`,`tbl_m_item`.`id_user` AS `id_user`,`tbl_m_item`.`id_kategori` AS `id_kategori`,`tbl_m_item`.`id_merk` AS `id_merk`,`tbl_m_item`.`id_satuan` AS `id_satuan`,`tbl_m_item`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item`.`tgl_modif` AS `tgl_modif`,`tbl_m_item`.`kode` AS `kode`,`tbl_m_kategori`.`kategori` AS `kategori`,`tbl_m_merk`.`merk` AS `merk`,`tbl_m_item`.`item` AS `item`,concat(`tbl_m_merk`.`merk`,' ',`tbl_m_item`.`item`) AS `item2`,`tbl_m_item`.`jml` AS `jml`,`tbl_m_item`.`harga_beli` AS `harga_beli`,`tbl_m_item`.`harga_jual` AS `harga_jual`,`tbl_m_item`.`keterangan` AS `keterangan`,`tbl_m_item`.`status_stok` AS `status_stok`,`tbl_m_item`.`status` AS `status` from (((`tbl_m_item` join `tbl_m_kategori` on(`tbl_m_item`.`id_kategori` = `tbl_m_kategori`.`id`)) left join `tbl_m_merk` on(`tbl_m_item`.`id_merk` = `tbl_m_merk`.`id`)) join `tbl_m_satuan` on(`tbl_m_item`.`id_satuan` = `tbl_m_satuan`.`id`)) order by `tbl_m_item`.`item` ;

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
