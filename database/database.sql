-- --------------------------------------------------------
-- Host:                         194.233.72.251
-- Server version:               10.6.19-MariaDB - MariaDB Server
-- Server OS:                    linux-systemd
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mikhaelf_db_ars.tbl_ion_groups
DROP TABLE IF EXISTS `tbl_ion_groups`;
CREATE TABLE IF NOT EXISTS `tbl_ion_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `akses` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_ion_groups: ~9 rows (approximately)
DELETE FROM `tbl_ion_groups`;
/*!40000 ALTER TABLE `tbl_ion_groups` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_ion_groups` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_ion_login_attempts
DROP TABLE IF EXISTS `tbl_ion_login_attempts`;
CREATE TABLE IF NOT EXISTS `tbl_ion_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_ion_login_attempts: ~0 rows (approximately)
DELETE FROM `tbl_ion_login_attempts`;
/*!40000 ALTER TABLE `tbl_ion_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ion_login_attempts` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_ion_modules
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

-- Dumping data for table mikhaelf_db_ars.tbl_ion_modules: ~0 rows (approximately)
DELETE FROM `tbl_ion_modules`;
/*!40000 ALTER TABLE `tbl_ion_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ion_modules` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_ion_users
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_ion_users: ~10 rows (approximately)
DELETE FROM `tbl_ion_users`;
/*!40000 ALTER TABLE `tbl_ion_users` DISABLE KEYS */;
INSERT INTO `tbl_ion_users` (`id`, `username`, `ip_address`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `nik`, `first_name`, `last_name`, `birthdate`, `address`, `company`, `phone`, `file_name`, `file_base64`, `tipe`) VALUES
	(1, 'sadmin', '127.0.0.1', '$2y$10$cYK4ah5foDzxtcv.uHkWpeHwPihec/7NjvB4aDuXaCzxyfrzX5ZVO', '', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, 'RxCZnvoR/mUeTe47', 1268889823, 1674577864, 1, NULL, 'MIKHAEL FELIAN WASKITO', '', '1954-02-02', NULL, 'ADMIN', '', '', NULL, '1'),
	(2, 'superadmin', '112.78.39.51', '$2y$10$B8gNk6Tlf8KMTbRDSFqz8eGN0V8vmSwMZsx4EfzwGf1fvc22/wefm', 'EBo75QJvR14a7H9c', 'noreply@esensia.co.id', NULL, NULL, NULL, NULL, NULL, 'ce434586b7536a0c7ad5071508cd548157a9d50b', '$2y$10$RbYC6afH.2N4byOGaLBiB.VQ5ZagJ2K9dKrZ6Txh2if2ux90wpoea', 1560132540, 1727187234, 1, NULL, 'SUPERADMIN', 'S.Kom', '2024-04-14', NULL, NULL, NULL, 'profile_2superadmin.png', '', '1'),
	(10, 'rina', '27.124.95.90', '$2y$10$MEoAMIQR2vzUWJ0kdFEWgOuQqNKv.t7N3JCZ5C9rMqLj1lgc1l5ba', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '34a5431293cfc82d042f87b8db2a24bc885d8998', '$2y$10$52ituyXhxZhuzyZfvAWvL.u/Xi5p0BSPKolwMG9eC1vIr/eeupC5a', 1717563543, 1727161812, 1, '3325086703970002', 'RINA KARTIKASARI', '', '1997-03-27', NULL, NULL, NULL, NULL, NULL, '1'),
	(11, 'salma', '27.124.95.90', '$2y$10$AUIquQRL5jyIvZiD9sC3XOv1ES1WK0aCCJnvZIWiAXo1RAlPrAEuq', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '21ccc3f2e6b8b3478af0485252e8c60584e4fe2a', '$2y$10$nnisSQB43n6JU4AIL6AS5Oa9lgZzC/ToClPKzdlLHuSJURONZ.e0u', 1717563772, 1726808748, 1, '3374074705990004', 'SALMA RACHMAWATI', '', '1999-05-27', NULL, NULL, NULL, NULL, NULL, '1'),
	(12, 'ari', '27.124.95.90', '$2y$10$9E1h0kboBagiz3mKap6KgeCfWth4VRmR98rGPVWAOi/82FhfLdieO', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1717730235, NULL, 1, '3374110807850003', 'ARI YULIANTO', '', '1985-07-08', NULL, NULL, NULL, NULL, NULL, '1'),
	(13, 'putra', '27.124.95.90', '$2y$10$mMnTm3XQxaPU6bp/1N4vqeBXYddY3P1OL9z7sZOGBZl4bDkRKG58S', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '118c29f17d788beb831ee5837aab4e50b66c2066', '$2y$10$gIDItwjk4IlEIo/jbmB4h.xVNCg53MapMA1XRDs0tEuLKHl1F5Ahi', 1717730379, 1726889563, 1, '3374112607920001', 'SURA PUTRA HASWATAMA', '', '1992-07-26', NULL, NULL, NULL, NULL, NULL, '1'),
	(14, 'eko', '27.124.95.90', '$2y$10$kTPxStlW8Jskay.4w7XkQ..ZBWtyj3VqySlXdT.BDsxAp1DKkRngW', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '5ac8417604c3a83fac919513b598ba66e145f6ce', '$2y$10$.MFolWkzgudAkD4KO0.bfuLswPhYx1N2Pvr9Y.whYYH91JklVYw6y', 1717730501, 1726826420, 1, '3374112405760001', 'WAYU EKO SUHARTO', '', '1976-05-24', NULL, NULL, NULL, NULL, NULL, '1'),
	(17, 'fadly', '114.10.122.28', '$2y$10$HoBL5xSKUqsbtmGhDhibY.6yjHhLyldldu1SLgxbcqLErKT5zW5i6', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '8ae111c772df8c7ce22b3cc18d88e3580ba5d8b3', '$2y$10$tY8/50gsnH8d7RJ4JIuD9OhOWlyz3gIXm/UY3mWCc/eTOqLovhPPe', 1719137577, 1726741919, 1, '3374150309900005', 'FADLY RAHMAN', '', '1990-09-03', NULL, NULL, NULL, NULL, NULL, '1'),
	(18, 'pujiyono', '27.124.95.218', '$2y$10$njpZ5qAVjRKMO/00hJ2wN.LjuhE83ySfuyKly6SgQQjNohpxfjw1a', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '6f147662347177c60f5a3db2bd96402970b85603', '$2y$10$6rGBYDHRoxZbsgKqyuDVv.V/JXyCkGoOpHBDEsw6cnFGmdiLLugfu', 1726545737, 1726545765, 1, '1223', 'PUJIYONO', '', '2024-09-17', NULL, NULL, NULL, NULL, NULL, '1'),
	(19, 'Wika', '27.124.95.218', '$2y$10$9LQzljjOT78usVRmE11BoeIL1c5O.gOt6Pw3/dYAsO4mnzSxs1uaa', NULL, 'noreply@arshaka.co.id', NULL, NULL, NULL, NULL, NULL, '0cf1e04f3a5dd6a0564bce5865158b0bf74de344', '$2y$10$NhX7w6JnSzJFRMbq33/WbeOMdvyrafeflHXyWoauA6.BduJVQW3d6', 1726546588, 1726547080, 1, '000', 'WIKA SEPTIANA', '', '1993-09-20', NULL, NULL, NULL, NULL, NULL, '1');
/*!40000 ALTER TABLE `tbl_ion_users` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_ion_users_groups
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
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_ion_users_groups: ~11 rows (approximately)
DELETE FROM `tbl_ion_users_groups`;
/*!40000 ALTER TABLE `tbl_ion_users_groups` DISABLE KEYS */;
INSERT INTO `tbl_ion_users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(57, 1, 2),
	(85, 2, 2),
	(73, 10, 2),
	(81, 11, 2),
	(69, 12, 8),
	(88, 13, 8),
	(87, 14, 7),
	(71, 17, 8),
	(72, 18, 8),
	(78, 19, 8);
/*!40000 ALTER TABLE `tbl_ion_users_groups` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_berkas
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_berkas: ~5 rows (approximately)
DELETE FROM `tbl_m_berkas`;
/*!40000 ALTER TABLE `tbl_m_berkas` DISABLE KEYS */;
INSERT INTO `tbl_m_berkas` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `tipe`, `status`) VALUES
	(1, 2, '2024-06-24 18:29:21', '2024-06-24 18:29:21', 'Kontrak', 1),
	(2, 2, '2024-06-24 18:29:37', '2024-06-24 18:29:37', 'SPK / Surat Pesanan', 1),
	(3, 2, '2024-06-24 18:29:47', '2024-06-24 18:29:47', 'Faktur Pajak', 1),
	(4, 2, '2024-06-24 18:29:57', '2024-06-24 18:29:57', 'Bukti Potong PPn', 1),
	(5, 2, '2024-06-24 18:30:06', '2024-06-24 18:30:06', 'Bukti Potong PPh', 1),
	(6, 2, '2024-07-11 14:16:24', '2024-07-11 14:16:24', 'BAST', 1);
/*!40000 ALTER TABLE `tbl_m_berkas` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_departemen
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_departemen: ~5 rows (approximately)
DELETE FROM `tbl_m_departemen`;
/*!40000 ALTER TABLE `tbl_m_departemen` DISABLE KEYS */;
INSERT INTO `tbl_m_departemen` (`id`, `id_user`, `tgl_simpan`, `kode`, `dept`, `keterangan`, `status`) VALUES
	(1, 41, '2023-09-19 22:14:42', 'MGT', 'MANAJEMEN', NULL, '1'),
	(2, 41, '2023-09-19 22:14:42', 'FO', 'PELAYANAN', NULL, '1'),
	(3, 41, '2023-09-19 22:14:42', 'AKT', 'AKUNTING', NULL, '1'),
	(4, 41, '2023-09-19 22:14:42', 'TEK', 'TEKNISI', NULL, '1'),
	(5, 41, '2023-09-19 22:14:42', 'PJK', 'PAJAK', NULL, '1');
/*!40000 ALTER TABLE `tbl_m_departemen` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_gelar
DROP TABLE IF EXISTS `tbl_m_gelar`;
CREATE TABLE IF NOT EXISTS `tbl_m_gelar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gelar` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_gelar: ~4 rows (approximately)
DELETE FROM `tbl_m_gelar`;
/*!40000 ALTER TABLE `tbl_m_gelar` DISABLE KEYS */;
INSERT INTO `tbl_m_gelar` (`id`, `gelar`, `ket`) VALUES
	(1, 'TN.', 'TUAN'),
	(2, 'NN.', 'NONA'),
	(3, 'NY.', 'NYONYA'),
	(4, 'AN.', 'ANAK');
/*!40000 ALTER TABLE `tbl_m_gelar` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_gudang
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_gudang: ~0 rows (approximately)
DELETE FROM `tbl_m_gudang`;
/*!40000 ALTER TABLE `tbl_m_gudang` DISABLE KEYS */;
INSERT INTO `tbl_m_gudang` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `gudang`, `keterangan`, `status`) VALUES
	(1, 1, '2019-04-17 10:24:51', NULL, 'GD.001', 'Gd. Utama', '-', '1');
/*!40000 ALTER TABLE `tbl_m_gudang` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_item
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_item: ~1 rows (approximately)
DELETE FROM `tbl_m_item`;
/*!40000 ALTER TABLE `tbl_m_item` DISABLE KEYS */;
INSERT INTO `tbl_m_item` (`id`, `id_satuan`, `id_kategori`, `id_merk`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `barcode`, `item`, `keterangan`, `jml`, `harga_beli`, `harga_jual`, `status_stok`, `status`) VALUES
	(1, 1, 1, 3, 2, '2024-09-23 09:01:17', '2024-09-23 09:01:17', '1234567', NULL, 'TESTING ITEM BARU', '-', 0.00, 5000000.00, 6000000.00, '1', '1'),
	(2, 1, 1, 2, 2, '2024-09-24 14:16:05', '2024-09-24 14:16:05', '1234567', NULL, 'tambah item rab baru', '-', 0.00, 500000.00, 750000.00, '1', '1');
/*!40000 ALTER TABLE `tbl_m_item` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_item_hist
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_item_hist: ~0 rows (approximately)
DELETE FROM `tbl_m_item_hist`;
/*!40000 ALTER TABLE `tbl_m_item_hist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_item_hist` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_item_stok
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_item_stok: ~1 rows (approximately)
DELETE FROM `tbl_m_item_stok`;
/*!40000 ALTER TABLE `tbl_m_item_stok` DISABLE KEYS */;
INSERT INTO `tbl_m_item_stok` (`id`, `id_item`, `id_gudang`, `id_satuan`, `id_user`, `tgl_simpan`, `tgl_modif`, `jml`, `jml_satuan`, `satuan`, `keterangan`, `status`, `sp`) VALUES
	(1, 1, 1, 1, 0, '2024-09-23 09:01:17', '2024-09-23 09:01:17', 0, 1, 'PCS', NULL, '1', '0'),
	(2, 2, 1, 1, 0, '2024-09-24 14:16:05', '2024-09-24 14:16:05', 0, 1, 'PCS', NULL, '1', '0');
/*!40000 ALTER TABLE `tbl_m_item_stok` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_item_stok_det
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_item_stok_det: ~0 rows (approximately)
DELETE FROM `tbl_m_item_stok_det`;
/*!40000 ALTER TABLE `tbl_m_item_stok_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_item_stok_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_jabatan
DROP TABLE IF EXISTS `tbl_m_jabatan`;
CREATE TABLE IF NOT EXISTS `tbl_m_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT 0,
  `tgl_simpan` datetime DEFAULT '0000-00-00 00:00:00',
  `kode` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data jabatan';

-- Dumping data for table mikhaelf_db_ars.tbl_m_jabatan: ~14 rows (approximately)
DELETE FROM `tbl_m_jabatan`;
/*!40000 ALTER TABLE `tbl_m_jabatan` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_m_jabatan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_jenis_kerja
DROP TABLE IF EXISTS `tbl_m_jenis_kerja`;
CREATE TABLE IF NOT EXISTS `tbl_m_jenis_kerja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_jenis_kerja: ~51 rows (approximately)
DELETE FROM `tbl_m_jenis_kerja`;
/*!40000 ALTER TABLE `tbl_m_jenis_kerja` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_m_jenis_kerja` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan: ~8 rows (approximately)
DELETE FROM `tbl_m_karyawan`;
/*!40000 ALTER TABLE `tbl_m_karyawan` DISABLE KEYS */;
INSERT INTO `tbl_m_karyawan` (`id`, `id_user`, `id_user_group`, `id_perusahaan`, `tgl_simpan`, `tgl_modif`, `kode`, `nik`, `nama`, `nama_blk`, `jns_klm`, `no_hp`, `alamat`, `alamat_dom`, `tmp_lahir`, `tgl_lahir`, `file_name`, `file_ext`, `file_type`, `status`) VALUES
	(1, 1, 2, 0, '2022-12-22 22:28:13', '2024-06-23 21:03:06', 'PG-001', '337407150292002', 'MIKHAEL FELIAN WASKITO', '', 'L', '085741220427', '-', '-', 'Semarang', '1954-02-02', NULL, NULL, NULL, 0),
	(2, 2, 2, 0, '2024-04-19 10:39:38', '2024-09-19 15:16:44', 'PG-002', '3374071502920002', 'SUPERADMIN', 'S.Kom', 'L', '085741220482', '-', '-o', 'Semarang', '2024-04-14', NULL, NULL, NULL, NULL),
	(10, 10, 5, 0, '2024-06-05 11:59:03', '2024-06-05 11:59:03', 'PG-003', '3325086703970002', 'Rina Kartikasari', '', 'P', '0882006884666', 'Ds Rowosari RT/RW 002/003 Kec. Limpung Kab. Batang', 'Ds Rowosari RT/RW 002/003 Kec. Limpung Kab. Batang', 'Batang', '1997-03-27', NULL, NULL, NULL, NULL),
	(11, 11, 6, 0, '2024-06-05 12:02:52', '2024-06-05 12:02:52', 'PG-004', '3374074705990004', 'Salma Rachmawati', '', 'P', '081381473610', 'Karanglo RT 5 RW 4 Gemah Pedurungan Semarang', 'Karanglo RT 5 RW 4 Gemah Pedurungan Semarang', 'Semarang', '1999-05-27', NULL, NULL, NULL, NULL),
	(12, 12, 8, 0, '2024-06-07 10:17:15', '2024-06-07 10:17:15', 'PG-005', '3374110807850003', 'Ari Yulianto', '', 'L', '081391855566', 'Jurang Belimbing RT/RW 001/004 Tembalang', 'Jurang Belimbing RT/RW 001/004 Tembalang', 'Semarang', '1985-07-08', NULL, NULL, NULL, NULL),
	(13, 13, 8, 0, '2024-06-07 10:19:39', '2024-09-24 13:59:22', 'PG-006', '3374112607920001', 'SURA PUTRA HASWATAMA', '', 'L', '08112688468', 'Jl. Pramuka Pudakpayung Rt 3 Rw 2', 'Jl. Pramuka Pudakpayung Rt 3 Rw 2', 'Semarang', '1992-07-26', NULL, NULL, NULL, NULL),
	(14, 14, 7, 2, '2024-06-07 10:21:41', '2024-09-20 14:04:01', 'PG-007', '3374112405760001', 'WAYU EKO SUHARTO', '', 'L', '08112688468', 'Jl. Pramuka Pudakpayung Rt 3 Rw 2', 'Jl. Pramuka Pudakpayung Rt 3 Rw 2', 'Semarang', '1976-05-24', NULL, NULL, NULL, NULL),
	(15, 15, 8, 2, '2024-06-17 00:20:17', '2024-07-12 14:00:03', 'PG-008', '-', 'TEST SALES', '', 'L', '-', 'D', 'asdas', '-', '2024-06-17', NULL, NULL, NULL, NULL),
	(17, 17, 8, 0, '2024-06-23 17:12:57', '2024-06-23 21:03:22', 'PG-009', '3374150309900005', 'FADLY RAHMAN', '', 'L', '085727147127', 'Jl. layur selatan no 73 sebantengan ungaran', 'jl. layur selatan no 73 sebantengan ungaran', 'Semarang', '1990-09-03', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tbl_m_karyawan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_cuti
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_cuti: ~4 rows (approximately)
DELETE FROM `tbl_m_karyawan_cuti`;
/*!40000 ALTER TABLE `tbl_m_karyawan_cuti` DISABLE KEYS */;
INSERT INTO `tbl_m_karyawan_cuti` (`id`, `id_karyawan`, `id_user`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `tgl_keluar`, `kode`, `keterangan`, `status`) VALUES
	(1, 1, 41, '2023-11-09 22:57:08', '0000-00-00 00:00:00', '2023-11-01', '2023-11-02', NULL, 'Kawin ', '0'),
	(3, 1, 41, '2023-11-09 23:02:24', '0000-00-00 00:00:00', '2023-11-08', '2023-11-08', NULL, 'TES', '0'),
	(4, 63, 210, '2023-11-14 08:35:32', '0000-00-00 00:00:00', '2023-11-14', '2023-11-22', NULL, 'Gsgd', '0'),
	(5, 103, 250, '2023-11-14 14:56:25', '0000-00-00 00:00:00', '2023-11-14', '2023-11-30', NULL, 'tidur nyenyak', '0');
/*!40000 ALTER TABLE `tbl_m_karyawan_cuti` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_jadwal
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_jadwal: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_jadwal`;
/*!40000 ALTER TABLE `tbl_m_karyawan_jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_karyawan_jadwal` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_kel
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_kel: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_kel`;
/*!40000 ALTER TABLE `tbl_m_karyawan_kel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_karyawan_kel` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_peg
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_peg: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_peg`;
/*!40000 ALTER TABLE `tbl_m_karyawan_peg` DISABLE KEYS */;
INSERT INTO `tbl_m_karyawan_peg` (`id`, `id_karyawan`, `id_user`, `id_dept`, `id_jabatan`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `tgl_keluar`, `kode`, `no_bpjs_tk`, `no_bpjs_ks`, `no_npwp`, `no_ptkp`, `no_rek`, `keterangan`, `tipe`) VALUES
	(75, 1, 41, 1, 1, '2023-11-02 10:38:39', '0000-00-00 00:00:00', '2015-02-03', '2024-11-01', '1234', '-', '-', NULL, '-', NULL, NULL, 1);
/*!40000 ALTER TABLE `tbl_m_karyawan_peg` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_pend
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data riwayat pendidikan karyawan';

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_pend: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_pend`;
/*!40000 ALTER TABLE `tbl_m_karyawan_pend` DISABLE KEYS */;
INSERT INTO `tbl_m_karyawan_pend` (`id`, `id_karyawan`, `id_user`, `tgl_simpan`, `no_dok`, `pendidikan`, `jurusan`, `instansi`, `keterangan`, `thn_masuk`, `thn_keluar`, `file_name`, `file_ext`, `file_type`, `file_base64`, `status_lulus`) VALUES
	(4, 1, 41, '2023-09-22 14:05:58', 'sasasasas', 'sasas', 'asas', 'asasa', '0', '2019', '2020', 'file_pend_1_00104.jpg', '.jpg', 'image/jpeg', NULL, '0');
/*!40000 ALTER TABLE `tbl_m_karyawan_pend` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_sert
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_sert: ~0 rows (approximately)
DELETE FROM `tbl_m_karyawan_sert`;
/*!40000 ALTER TABLE `tbl_m_karyawan_sert` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_karyawan_sert` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_karyawan_tipe
DROP TABLE IF EXISTS `tbl_m_karyawan_tipe`;
CREATE TABLE IF NOT EXISTS `tbl_m_karyawan_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_karyawan_tipe: ~3 rows (approximately)
DELETE FROM `tbl_m_karyawan_tipe`;
/*!40000 ALTER TABLE `tbl_m_karyawan_tipe` DISABLE KEYS */;
INSERT INTO `tbl_m_karyawan_tipe` (`id`, `kode`, `tipe`, `status`) VALUES
	(1, NULL, 'Tetap', '1'),
	(2, NULL, 'Kontrak', '1'),
	(3, NULL, 'Mitra', '1');
/*!40000 ALTER TABLE `tbl_m_karyawan_tipe` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_kategori
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_kategori: ~95 rows (approximately)
DELETE FROM `tbl_m_kategori`;
/*!40000 ALTER TABLE `tbl_m_kategori` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_m_kategori` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_kategori_cuti
DROP TABLE IF EXISTS `tbl_m_kategori_cuti`;
CREATE TABLE IF NOT EXISTS `tbl_m_kategori_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_kategori_cuti: ~3 rows (approximately)
DELETE FROM `tbl_m_kategori_cuti`;
/*!40000 ALTER TABLE `tbl_m_kategori_cuti` DISABLE KEYS */;
INSERT INTO `tbl_m_kategori_cuti` (`id`, `tipe`, `status`) VALUES
	(1, 'Cuti', 1),
	(2, 'Ijin', 1),
	(3, 'Dinas Luar', 1);
/*!40000 ALTER TABLE `tbl_m_kategori_cuti` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_merk
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
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_merk: ~383 rows (approximately)
DELETE FROM `tbl_m_merk`;
/*!40000 ALTER TABLE `tbl_m_merk` DISABLE KEYS */;
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
	(414, '2024-09-21 23:09:11', '2024-09-21 23:12:20', '414', 'ZOMEI', NULL, '1');
/*!40000 ALTER TABLE `tbl_m_merk` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_pelanggan
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_pelanggan: ~1 rows (approximately)
DELETE FROM `tbl_m_pelanggan`;
/*!40000 ALTER TABLE `tbl_m_pelanggan` DISABLE KEYS */;
INSERT INTO `tbl_m_pelanggan` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `no_telp`, `alamat`, `kota`, `provinsi`, `tipe`, `status`) VALUES
	(1, 10, '2024-09-24 13:55:56', '2024-09-24 13:55:56', 'PLG-00001', 'Universitas Diponegoro', '', 'Jl. Prof. Soedarto No.13, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275', 'KOTA SEMARANG', 'JAWA TENGAH', '2', '1');
/*!40000 ALTER TABLE `tbl_m_pelanggan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_pelanggan_cp
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Untuk menyimpan data kontak person pelanggan';

-- Dumping data for table mikhaelf_db_ars.tbl_m_pelanggan_cp: ~0 rows (approximately)
DELETE FROM `tbl_m_pelanggan_cp`;
/*!40000 ALTER TABLE `tbl_m_pelanggan_cp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_m_pelanggan_cp` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_platform
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_platform: ~2 rows (approximately)
DELETE FROM `tbl_m_platform`;
/*!40000 ALTER TABLE `tbl_m_platform` DISABLE KEYS */;
INSERT INTO `tbl_m_platform` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode`, `platform`, `keterangan`, `status`) VALUES
	(1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Tunai', NULL, '1'),
	(2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Transfer', NULL, '1');
/*!40000 ALTER TABLE `tbl_m_platform` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_satuan
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_satuan: ~6 rows (approximately)
DELETE FROM `tbl_m_satuan`;
/*!40000 ALTER TABLE `tbl_m_satuan` DISABLE KEYS */;
INSERT INTO `tbl_m_satuan` (`id`, `tgl_simpan`, `tgl_modif`, `satuanTerkecil`, `satuanBesar`, `jml`, `status`) VALUES
	(1, '2019-08-10 16:15:39', '2024-04-17 14:27:00', 'PCS', 'PCS', 1, '1'),
	(3, '2024-05-24 03:06:04', '2024-05-26 06:50:38', 'Batang', 'Batang', 1, '1'),
	(4, '2024-05-26 06:50:57', '2024-05-26 06:50:57', 'Meter', 'Meter', 1, '1'),
	(5, '2024-05-26 06:51:18', '2024-05-26 06:51:48', 'Meter', 'Roll', 306, '1'),
	(6, '2024-05-26 12:23:00', '2024-05-26 12:23:00', 'kubik', 'kubik', 10, '1'),
	(7, '2024-06-03 18:51:54', '2024-06-03 18:51:54', 'UNIT', 'UNIT', 1, '1');
/*!40000 ALTER TABLE `tbl_m_satuan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_supplier
DROP TABLE IF EXISTS `tbl_m_supplier`;
CREATE TABLE IF NOT EXISTS `tbl_m_supplier` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` datetime DEFAULT NULL,
  `tgl_modif` datetime DEFAULT NULL,
  `kode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `npwp` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `provinsi` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cp` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_m_supplier: ~1 rows (approximately)
DELETE FROM `tbl_m_supplier`;
/*!40000 ALTER TABLE `tbl_m_supplier` DISABLE KEYS */;
INSERT INTO `tbl_m_supplier` (`id`, `tgl_simpan`, `tgl_modif`, `kode`, `nama`, `npwp`, `alamat`, `kota`, `provinsi`, `no_telp`, `no_hp`, `cp`, `status`) VALUES
	(1, '2024-09-24 14:12:37', '2024-09-24 14:12:37', 'PRSC-00001', 'PT Seroja Putra', NULL, 'JL. KH. Ahmad Dalan', 'SEMARANG', 'JAWA TENGAH', '-', '-', NULL, '1');
/*!40000 ALTER TABLE `tbl_m_supplier` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_m_tipe
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

-- Dumping data for table mikhaelf_db_ars.tbl_m_tipe: ~4 rows (approximately)
DELETE FROM `tbl_m_tipe`;
/*!40000 ALTER TABLE `tbl_m_tipe` DISABLE KEYS */;
INSERT INTO `tbl_m_tipe` (`id`, `id_user`, `tgl_simpan`, `tgl_modif`, `tipe`, `status`) VALUES
	(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e-Katalog', 1),
	(2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Siplah', 1),
	(3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PL', 1),
	(4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lelang', 1),
	(5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Umum', 1);
/*!40000 ALTER TABLE `tbl_m_tipe` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_pengaturan
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

-- Dumping data for table mikhaelf_db_ars.tbl_pengaturan: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan`;
/*!40000 ALTER TABLE `tbl_pengaturan` DISABLE KEYS */;
INSERT INTO `tbl_pengaturan` (`id`, `id_app`, `website`, `judul`, `judul_app`, `url_app`, `favicon`, `logo`, `logo_header`, `logo_header_kop`, `deskripsi`, `deskripsi_pendek`, `notifikasi`, `alamat`, `kota`, `email`, `pesan`, `tlp`, `fax`, `kode_plgn`, `kode_kary`, `kode_supp`, `kode_po`, `kode_psn`, `kode_rab`, `kode_penj`, `kode_mts`, `kode_do`, `ppn`, `dpp`, `pph`, `ppn_tot`, `jml_ppn`, `jml_item`, `jml_limit_stok`, `jml_limit_tempo`, `status_app`) VALUES
	(1, 1, 'arsakha.co.id', 'ARSAKHA', 'ARS', 'https://sap.arsakha.co.id', 'logo_fav_arsakha.png', 'logo_arsakha.png', 'logo_hdr_arsakha.png', 'logo-arshaka.png', '', '', '', '', 'Semarang', 'mikhaelfelian@gmail.com', '', '', '', 'PLG', 'PG', 'PRSC', NULL, NULL, NULL, NULL, 'MTS', 'DO', 1.11, 1.11, 1.50, 111, 11, 10, 12, 10, '');
/*!40000 ALTER TABLE `tbl_pengaturan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_pengaturan_mail
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_pengaturan_mail: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_mail`;
/*!40000 ALTER TABLE `tbl_pengaturan_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengaturan_mail` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_pengaturan_profile
DROP TABLE IF EXISTS `tbl_pengaturan_profile`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan_profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengaturan` int(10) NOT NULL DEFAULT 0,
  `id_user` int(10) NOT NULL DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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

-- Dumping data for table mikhaelf_db_ars.tbl_pengaturan_profile: ~4 rows (approximately)
DELETE FROM `tbl_pengaturan_profile`;
/*!40000 ALTER TABLE `tbl_pengaturan_profile` DISABLE KEYS */;
INSERT INTO `tbl_pengaturan_profile` (`id`, `id_pengaturan`, `id_user`, `tgl_simpan`, `tgl_modif`, `kode_srt_dpn`, `kode_inv_dpn`, `kode_rab_dpn`, `kode_po_dpn`, `kode_kwi_dpn`, `kode_srt_blk`, `npwp`, `nama`, `no_telp`, `no_fax`, `alamat`, `kota`, `email`, `kbli`, `logo`, `logo_kop`, `logo_wm`, `rek_bank`, `rek_nama`, `rek_nomor`, `direktur`, `keterangan`, `status`) VALUES
	(2, 1, 2, '2024-05-23 04:20:51', '2024-07-09 00:13:03', 'BQ', 'INV', 'RAB', 'PO', 'KWI', 'ARS', '81.773.385.0-503.000', 'CV. AR SAKHA', '08112688468', '-', 'Jalan Pramuka No 31 Pudakpayung', 'SEMARANG', 'arsakha.solution@gmail.com', NULL, 'logo_si-man.png', 'logo_prof_cvarsakha.png', 'logo_prof_cvarsakha_wm.png', 'PT Bank Central Asia Tbk.', 'a/n : AR SAKHA ', 'xxxxxxxxxx', 'Sura Putra Haswatama', NULL, 1),
	(3, 1, 2, '2024-06-03 11:15:53', '2024-07-08 18:23:54', 'SPH', 'INV', 'RAB', 'PO', 'KWI', 'RA', '61.916.972.5-517.000', 'CV. RESTU ARSI', '-', NULL, 'JL. RASAMALA UTARA 1 NO 62 SRONDOL WETAN BANYUMANIK', 'SEMARANG', NULL, NULL, NULL, '', 'logo_prof_cvrestuarsi_wm.png', NULL, NULL, NULL, 'Nur Alimin', NULL, 1),
	(8, 1, 2, '2024-06-05 11:55:08', '2024-07-08 18:24:16', 'SP', 'INV', 'RAB', 'PO', 'KWI', 'MST', '94.131.671.3-603.000', 'CV. MITRA SARANA TEKNOLOGI', '', NULL, 'PERUM PONDOK WAGE INDAH I BLOK F NO 22 WAGE TAMAN KAB. SIDOARJO JAWA TIMUR', 'SIDOARJO', NULL, NULL, NULL, '', 'logo_prof_cvmitrasaranateknologi_wm.png', 'PT Bank Central Asia Tbk.', 'a/n : MITRA SARANA TEKNOLOGI ', ' 6150797568', 'Ninna Arifatun Nisak', NULL, 1),
	(9, 1, 2, '2024-09-17 12:20:53', '2024-09-17 12:22:47', NULL, NULL, NULL, NULL, NULL, NULL, '96.317.419.8-517.000', 'CV. Wijaya Mandala', '-', NULL, 'Jl. Pramuka RT.003 RW 002, Pudak Payung, Semarang', 'Semarang', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '-', NULL, 1);
/*!40000 ALTER TABLE `tbl_pengaturan_profile` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_pengaturan_theme
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

-- Dumping data for table mikhaelf_db_ars.tbl_pengaturan_theme: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_theme`;
/*!40000 ALTER TABLE `tbl_pengaturan_theme` DISABLE KEYS */;
INSERT INTO `tbl_pengaturan_theme` (`id`, `id_pengaturan`, `nama`, `path`, `status`) VALUES
	(1, 1, 'Admin LTE 3', 'admin-lte-3', 1);
/*!40000 ALTER TABLE `tbl_pengaturan_theme` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_sessions
DROP TABLE IF EXISTS `tbl_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `id_sessions` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL,
  PRIMARY KEY (`id_sessions`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_sessions: ~0 rows (approximately)
DELETE FROM `tbl_sessions`;
/*!40000 ALTER TABLE `tbl_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sessions` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_sessions_front
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

-- Dumping data for table mikhaelf_db_ars.tbl_sessions_front: ~0 rows (approximately)
DELETE FROM `tbl_sessions_front`;
/*!40000 ALTER TABLE `tbl_sessions_front` DISABLE KEYS */;
INSERT INTO `tbl_sessions_front` (`id`, `session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	(346, 'ef266d2304ff9a4888bbecbfa6921e5f', '66.249.79.194', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.6045.123 M', 1701561571, _binary '');
/*!40000 ALTER TABLE `tbl_sessions_front` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_beli
DROP TABLE IF EXISTS `tbl_trans_beli`;
CREATE TABLE IF NOT EXISTS `tbl_trans_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_po` int(11) DEFAULT 0,
  `id_penerima` int(11) DEFAULT 0,
  `id_perusahaan` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_bayar` date DEFAULT '0000-00-00',
  `tgl_masuk` date DEFAULT '0000-00-00',
  `tgl_keluar` date DEFAULT '0000-00-00',
  `no_nota` varchar(160) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
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
  `metode_bayar` varchar(160) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idSupplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_beli: ~4 rows (approximately)
DELETE FROM `tbl_trans_beli`;
/*!40000 ALTER TABLE `tbl_trans_beli` DISABLE KEYS */;
INSERT INTO `tbl_trans_beli` (`id`, `id_supplier`, `id_user`, `id_po`, `id_penerima`, `id_perusahaan`, `tgl_simpan`, `tgl_modif`, `tgl_bayar`, `tgl_masuk`, `tgl_keluar`, `no_nota`, `no_po`, `supplier`, `jml_total`, `disk1`, `disk2`, `disk3`, `jml_potongan`, `jml_retur`, `jml_diskon`, `jml_biaya`, `jml_subtotal`, `jml_dpp`, `ppn`, `jml_ppn`, `jml_gtotal`, `jml_bayar`, `jml_kembali`, `jml_kurang`, `status`, `status_bayar`, `status_ppn`, `status_penerimaan`, `metode_bayar`, `status_hps`) VALUES
	(1, 5, 14, 12, 0, 2, '2024-09-20 14:11:49', '2024-09-20 17:10:07', '0000-00-00', '2024-09-20', '2024-09-27', 'RS-001', '', 'PT SEROJA KARUNIA PUTRAJAYA', 4275000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 225000.00, 0.00, 4275000.00, 0.00, 0, 0.00, 4275000.00, 0.00, 0.00, 0.00, '1', '0', '2', '3', NULL, '0'),
	(2, 2, 14, 16, 0, 2, '2024-09-20 14:30:27', '2024-09-20 14:33:41', '0000-00-00', '2024-09-20', '2024-09-20', '1001', '', 'PT HOME CENTER INDONESIA RETAIL', 18838000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0.00, 0, 0.00, 18838000.00, 0.00, 0.00, 0.00, '1', '0', '2', '3', NULL, '0'),
	(3, 3, 14, 17, 0, 3, '2024-09-20 14:30:54', '2024-09-20 14:33:33', '0000-00-00', '2024-09-20', '2024-09-20', '1002', '', 'CV. ANEKA TEKNOLOGI INDONESIA', 18838000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0.00, 0, 0.00, 18838000.00, 0.00, 0.00, 0.00, '1', '0', '2', '3', NULL, '0'),
	(4, 4, 14, 18, 0, 2, '2024-09-20 14:31:18', '2024-09-20 14:33:26', '0000-00-00', '2024-09-20', '2024-09-20', '1003', '', 'PT DUTA MEDIA CITRA', 18838000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0.00, 0, 0.00, 18838000.00, 0.00, 0.00, 0.00, '1', '0', '2', '3', NULL, '0'),
	(5, 5, 2, 19, 0, 2, '2024-09-21 11:04:14', '2024-09-21 11:04:27', '0000-00-00', '2024-09-05', '2024-09-05', 'ARSakha/142/SE/IX/2024', '', 'PT SEROJA KARUNIA PUTRAJAYA', 27375000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 27375000.00, 0.00, 0, 0.00, 27375000.00, 0.00, 0.00, 0.00, '1', '0', '2', '0', NULL, '0');
/*!40000 ALTER TABLE `tbl_trans_beli` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_beli_det
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_beli_det: ~4 rows (approximately)
DELETE FROM `tbl_trans_beli_det`;
/*!40000 ALTER TABLE `tbl_trans_beli_det` DISABLE KEYS */;
INSERT INTO `tbl_trans_beli_det` (`id`, `id_user`, `id_pembelian`, `id_item`, `id_satuan`, `tgl_simpan`, `tgl_modif`, `tgl_terima`, `kode`, `item`, `jml`, `jml_satuan`, `jml_diterima`, `satuan`, `keterangan`, `harga`, `disk1`, `disk2`, `disk3`, `diskon`, `potongan`, `subtotal`, `sp`, `status_ppn`, `status_sn`) VALUES
	(1, 14, 1, 1, 7, '2024-09-20 14:11:49', '2024-09-20 14:21:37', '0000-00-00 00:00:00', '010001198', 'FCC 820L High Pressure Cleaner ', 5, 1, 0, 'UNIT', '', 900000.00, 5.00, 0.00, 0.00, 225000.00, 0.00, 4275000.00, 0, '1', '0'),
	(2, 14, 2, 22, 7, '2024-09-20 14:30:27', '2024-09-20 14:32:27', '0000-00-00 00:00:00', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 7, 'UNIT', 'AD6189684\r\nAD6189684\r\n', 9419000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0, '1', '0'),
	(3, 14, 3, 22, 7, '2024-09-20 14:30:54', '2024-09-20 14:33:03', '0000-00-00 00:00:00', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 9, 'UNIT', 'AD6189684\r\nAD6189684\r\n', 9419000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0, '1', '0'),
	(4, 14, 4, 22, 7, '2024-09-20 14:31:18', '2024-09-20 14:33:22', '0000-00-00 00:00:00', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 11, 'UNIT', 'AD6189684\r\nAD6189684\r\n', 9419000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 18838000.00, 0, '1', '0'),
	(5, 2, 5, 25, 7, '2024-09-21 11:04:14', '2024-09-21 11:08:21', '0000-00-00 00:00:00', '12000911', 'Polytron AC 2 PK Deluxe PAC 18VH indor', 5, 1, 5, 'UNIT', ' \r\n 	\r\nA0AY84G00707\r\nA0AY84G00673\r\nA0AY84G00661\r\nA0AY84C00959\r\nA0AY84C00956', 5475000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 27375000.00, 0, '1', '0');
/*!40000 ALTER TABLE `tbl_trans_beli_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_beli_plat
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_beli_plat: ~0 rows (approximately)
DELETE FROM `tbl_trans_beli_plat`;
/*!40000 ALTER TABLE `tbl_trans_beli_plat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_beli_plat` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_beli_po
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
  `no_po` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `supplier` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `pengiriman` text DEFAULT NULL,
  `status_nota` int(11) DEFAULT 0 COMMENT 'Untuk mencatat status nota, sudah proses atau belum',
  `status_fkt` int(11) DEFAULT 0 COMMENT 'Untuk mencatat status faktur',
  `status_hps` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idSupplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_beli_po: ~23 rows (approximately)
DELETE FROM `tbl_trans_beli_po`;
/*!40000 ALTER TABLE `tbl_trans_beli_po` DISABLE KEYS */;
INSERT INTO `tbl_trans_beli_po` (`id`, `id_supplier`, `id_user`, `id_perusahaan`, `id_rab`, `id_penjualan`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `tgl_keluar`, `no_po`, `supplier`, `keterangan`, `pengiriman`, `status_nota`, `status_fkt`, `status_hps`) VALUES
	(1, 2, 2, 2, 1, NULL, '2024-08-26 16:06:34', '2024-08-26 16:06:34', '2024-08-26', NULL, 'PO/001-ARS/VIII/2024', 'PT HOME CENTER INDONESIA RETAIL', '', NULL, 0, 0, '0'),
	(2, 3, 2, 3, NULL, 1, '2024-08-26 16:07:10', '2024-08-27 23:39:01', '2024-08-26', NULL, 'PO/003-RA/VIII/2024', 'CV. ANEKA TEKNOLOGI INDONESIA', 'tes', NULL, 0, 0, '0'),
	(3, 2, 2, 2, 2, NULL, '2024-09-09 14:23:09', '2024-09-09 14:23:09', '2024-09-09', NULL, 'PO/003-ARS/IX/2024', 'PT HOME CENTER INDONESIA RETAIL', 'TEST', NULL, 0, 0, '0'),
	(4, 5, 2, 8, 2, NULL, '2024-09-09 14:24:09', '2024-09-09 14:28:49', '2024-09-09', NULL, 'PO/004-MST/IX/2024', 'PT SEROJA KARUNIA PUTRAJAYA', 'aaaa', NULL, 0, 1, '0'),
	(5, 3, 2, 2, 4, NULL, '2024-09-16 06:29:32', '2024-09-16 06:29:32', '2024-09-16', NULL, 'PO/005-ARS/IX/2024', 'CV. ANEKA TEKNOLOGI INDONESIA', 'Tes', NULL, 0, 0, '0'),
	(6, 2, 2, 8, 4, NULL, '2024-09-16 06:30:13', '2024-09-16 20:41:44', '2024-09-16', NULL, 'PO/006-MST/IX/2024', 'PT HOME CENTER INDONESIA RETAIL', 'Tes', NULL, 0, 1, '0'),
	(7, 4, 2, 2, 0, 0, '2024-09-16 09:39:14', '2024-09-16 09:40:18', '2024-09-16', NULL, 'PO-00007', 'PT DUTA MEDIA CITRA', 'Tes gudang', NULL, 1, 1, '0'),
	(8, 2, 2, 3, 0, 0, '2024-09-17 06:49:45', '2024-09-17 06:49:45', '2024-09-17', NULL, 'PO-00008', 'PT HOME CENTER INDONESIA RETAIL', 'Tes', NULL, 0, 0, '0'),
	(9, 3, 2, 2, 0, 0, '2024-09-17 06:50:33', '2024-09-17 06:51:26', '2024-09-17', NULL, 'PO-00009', 'CV. ANEKA TEKNOLOGI INDONESIA', 'Te s', NULL, 1, 1, '0'),
	(10, 4, 2, 3, 0, 0, '2024-09-17 06:52:44', '2024-09-17 06:53:48', '2024-09-25', NULL, 'PO-00010', 'PT DUTA MEDIA CITRA', 'Tes', NULL, 1, 1, '0'),
	(11, 2, 14, 2, NULL, 4, '2024-09-20 14:09:08', '2024-09-20 14:09:08', '2024-09-20', NULL, 'PO/011-ARS/IX/2024', 'PT HOME CENTER INDONESIA RETAIL', 'tes', NULL, 0, 0, '0'),
	(12, 5, 14, 2, 5, NULL, '2024-09-20 14:10:54', '2024-09-20 14:11:49', '2024-09-27', NULL, 'PO/012-ARS/IX/2024', 'PT SEROJA KARUNIA PUTRAJAYA', 'TES', NULL, 0, 1, '0'),
	(13, 2, 14, 2, NULL, 7, '2024-09-20 14:27:07', '2024-09-20 14:27:07', '2024-09-20', NULL, 'PO/013-ARS/IX/2024', 'PT HOME CENTER INDONESIA RETAIL', 'TEST', NULL, 0, 0, '0'),
	(14, 3, 14, 2, NULL, 7, '2024-09-20 14:27:22', '2024-09-20 14:27:22', '2024-09-20', NULL, 'PO/014-ARS/IX/2024', 'CV. ANEKA TEKNOLOGI INDONESIA', 'TES 2', NULL, 0, 0, '0'),
	(15, 4, 14, 2, NULL, 7, '2024-09-20 14:27:36', '2024-09-20 14:27:36', '2024-09-20', NULL, 'PO/015-ARS/IX/2024', 'PT DUTA MEDIA CITRA', 'TEST 3', NULL, 0, 0, '0'),
	(16, 2, 14, 2, 6, NULL, '2024-09-20 14:28:24', '2024-09-20 14:30:27', '2024-09-20', NULL, 'PO/016-ARS/IX/2024', 'PT HOME CENTER INDONESIA RETAIL', 'PO 1', NULL, 0, 1, '0'),
	(17, 3, 14, 2, 6, NULL, '2024-09-20 14:28:39', '2024-09-20 14:30:54', '2024-09-20', NULL, 'PO/017-ARS/IX/2024', 'CV. ANEKA TEKNOLOGI INDONESIA', 'PO 2', NULL, 0, 1, '0'),
	(18, 4, 14, 2, 6, NULL, '2024-09-20 14:28:51', '2024-09-20 14:31:18', '2024-09-20', NULL, 'PO/018-ARS/IX/2024', 'PT DUTA MEDIA CITRA', 'PO 3', NULL, 0, 1, '0'),
	(19, 5, 2, 2, 7, NULL, '2024-09-21 11:01:45', '2024-09-21 11:04:14', '2024-09-05', NULL, 'PO/019-ARS/IX/2024', 'PT SEROJA KARUNIA PUTRAJAYA', '', NULL, 0, 1, '0'),
	(20, 1, 2, 2, 0, 0, '2024-09-24 14:13:16', '2024-09-24 14:13:16', '2024-09-23', NULL, 'PO-00020', 'PT Seroja Putra', '', NULL, 0, 0, '0'),
	(21, 1, 2, 2, 8, NULL, '2024-09-24 14:20:45', '2024-09-24 14:20:45', '2024-09-24', NULL, 'PO/021-ARS/IX/2024', 'PT Seroja Putra', '-', NULL, 0, 0, '0'),
	(22, 1, 2, 2, 0, 0, '2024-09-24 14:39:20', '2024-09-24 14:39:20', '2024-09-24', NULL, 'PO-00022', 'PT Seroja Putra', 'tes', NULL, 0, 0, '0'),
	(23, 1, 2, 2, 0, 0, '2024-09-24 14:41:38', '2024-09-24 14:42:22', '2024-09-24', NULL, 'PO-00023', 'PT Seroja Putra', 'tes', NULL, 1, 0, '0');
/*!40000 ALTER TABLE `tbl_trans_beli_po` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_beli_po_det
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_beli_po_det: ~14 rows (approximately)
DELETE FROM `tbl_trans_beli_po_det`;
/*!40000 ALTER TABLE `tbl_trans_beli_po_det` DISABLE KEYS */;
INSERT INTO `tbl_trans_beli_po_det` (`id`, `id_user`, `id_pembelian`, `id_item`, `id_satuan`, `id_rab_det`, `tgl_simpan`, `tgl_modif`, `kode`, `item`, `jml`, `jml_satuan`, `harga`, `harga_ppn`, `subtotal`, `satuan`, `keterangan`, `keterangan_itm`, `status`, `status_ppn`) VALUES
	(1, 2, 23, 1, 1, 1, '2024-08-26 16:06:45', '2024-09-24 14:42:09', '1234567', 'TESTING ITEM BARU', 1, 1, 900000, NULL, 1800000, 'PCS', NULL, NULL, '0', '1'),
	(2, 2, 23, 2, 7, 2, '2024-08-26 16:27:30', '2024-09-24 14:41:56', '1234567', 'tambah item rab baru', 1, 1, 400000, NULL, 2000000, 'UNIT', NULL, NULL, '0', '1'),
	(3, 2, 9, 3, 7, 3, '2024-09-09 14:23:47', '2024-09-17 06:50:43', '030003200', '20 PINTU KOZURE TYPE KL 20', 5, 1, 900000, NULL, 900000, 'UNIT', NULL, NULL, '0', ''),
	(5, 2, 5, 1, 7, 8, '2024-09-16 06:29:46', '2024-09-16 06:29:46', '010001198', 'FCC 820L High Pressure Cleaner ', 5, 1, 900000, NULL, 4500000, 'UNIT', NULL, NULL, '0', ''),
	(6, 2, 5, 1, 7, 8, '2024-09-16 06:30:28', '2024-09-16 06:30:28', '010001198', 'FCC 820L High Pressure Cleaner ', 5, 1, 900000, NULL, 4500000, 'UNIT', NULL, NULL, '0', '1'),
	(7, 2, 6, 4, 7, 9, '2024-09-16 06:30:55', '2024-09-16 06:30:55', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', 2, 1, 400000, NULL, 800000, 'UNIT', NULL, NULL, '0', '1'),
	(8, 2, 5, 4, 7, 9, '2024-09-16 06:31:17', '2024-09-16 06:31:17', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', 3, 1, 400000, NULL, 1200000, 'UNIT', NULL, NULL, '0', ''),
	(9, 2, 10, 22, 7, 0, '2024-09-17 06:52:55', '2024-09-17 06:52:55', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 5, 1, NULL, NULL, NULL, 'UNIT', NULL, NULL, '0', '0'),
	(10, 14, 12, 1, 7, 11, '2024-09-20 14:11:07', '2024-09-20 14:11:07', '010001198', 'FCC 820L High Pressure Cleaner ', 5, 1, 900000, NULL, 4500000, 'UNIT', NULL, NULL, '0', '1'),
	(11, 14, 18, 22, 7, 13, '2024-09-20 14:29:00', '2024-09-20 14:29:00', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 9419000, NULL, 18838000, 'UNIT', NULL, NULL, '0', '1'),
	(12, 14, 17, 22, 7, 13, '2024-09-20 14:29:11', '2024-09-20 14:29:11', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 9419000, NULL, 18838000, 'UNIT', NULL, NULL, '0', '1'),
	(13, 14, 16, 22, 7, 13, '2024-09-20 14:29:28', '2024-09-20 14:29:28', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 2, 1, 9419000, NULL, 18838000, 'UNIT', NULL, NULL, '0', '1'),
	(14, 2, 19, 25, 7, 14, '2024-09-21 11:02:52', '2024-09-21 11:02:52', '12000911', 'Polytron AC 2 PK Deluxe PAC 18VH indor', 5, 1, 5475000, NULL, 27375000, 'UNIT', NULL, NULL, '0', '1'),
	(15, 2, 21, 1, 1, 16, '2024-09-24 14:21:00', '2024-09-24 14:21:00', '1234567', 'TESTING ITEM BARU', 1, 1, 5000000, NULL, 5000000, 'PCS', NULL, NULL, '0', '');
/*!40000 ALTER TABLE `tbl_trans_beli_po_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual: ~7 rows (approximately)
DELETE FROM `tbl_trans_jual`;
/*!40000 ALTER TABLE `tbl_trans_jual` DISABLE KEYS */;
INSERT INTO `tbl_trans_jual` (`id`, `id_user`, `id_sales`, `id_kasir`, `id_pelanggan`, `id_perusahaan`, `id_tipe`, `id_rab`, `id_platform`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `tgl_keluar`, `tgl_bayar`, `no_nota`, `no_kontrak`, `no_paket`, `platform`, `jml_hps`, `jml_pagu`, `jml_total`, `ppn`, `jml_ppn`, `pph`, `jml_pph`, `jml_gtotal`, `jml_biaya`, `jml_bayar`, `jml_hpp`, `jml_hpp_ppn`, `jml_profit`, `keterangan`, `metode_bayar`, `status`, `status_bayar`, `status_nota`, `status_ppn`, `status_hps`) VALUES
	(1, 2, 12, 0, 1, 2, 1, 1, 0, '2024-08-26 16:28:18', '2024-08-28 00:11:04', '2024-08-26', '0000-00-00', '0000-00-00', 'INV/001-ARS/VIII/2024', NULL, NULL, NULL, 0.00, 0.00, 7511261.26, 11, 826238.74, 2, 112669, 8337500.00, 0.00, 0.00, 3800000.00, 376576.58, 3975168.92, NULL, NULL, '1', '0', 0, NULL, '0'),
	(2, 2, 12, 0, 2, 2, 1, 0, 0, '2024-08-29 20:15:03', '2024-08-29 20:15:53', '2024-08-29', '0000-00-00', '0000-00-00', 'INV/002-ARS/VIII/2024', '123344', NULL, NULL, 0.00, 0.00, 9459459.46, 11, 1040540.54, 2, 141892, 10500000.00, 0.00, 0.00, 9419000.00, 933414.41, 831981.98, NULL, NULL, '1', '0', 0, '0', '0'),
	(3, 2, 12, 0, 1, 2, 2, 2, 0, '2024-09-09 14:25:09', '2024-09-09 14:38:24', '2024-09-04', '0000-00-00', '2024-09-09', 'INV/003-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 23856000.00, 11, 2364068.47, 2, 322373, 23855600.00, 50000.00, 0.00, 19144000.00, 1897153.15, 2064347.75, NULL, 1, '1', '1', 0, NULL, '0'),
	(4, 2, 12, 0, 6, 2, 1, 3, 0, '2024-09-10 09:47:45', '2024-09-10 15:03:38', '2024-09-10', '0000-00-00', '0000-00-00', 'INV/004-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 45225225.23, 11, 4974774.77, 2, 678378, 50200000.00, 0.00, 0.00, 47095000.00, 4667072.07, -2548153.15, NULL, NULL, '0', '0', 0, NULL, '0'),
	(5, 2, 13, 0, 2, 2, 1, 4, 0, '2024-09-16 06:31:25', '2024-09-17 10:17:58', '2024-09-16', '0000-00-00', '2024-09-17', 'INV/005-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 31537500.00, 11, 3125337.84, 2, 426182, 31537500.00, 0.00, 0.00, 11000000.00, 1090090.09, 17877871.62, NULL, 1, '1', '1', 0, NULL, '0'),
	(6, 14, 12, 0, 12, 2, 1, 5, 0, '2024-09-20 14:11:16', '2024-09-20 14:11:16', '2024-09-20', '0000-00-00', '0000-00-00', 'INV/006-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 12950450.45, 1, 1424549.55, 2, 194257, 14375000.00, 0.00, 0.00, 4500000.00, 445945.95, 8687139.64, NULL, NULL, '0', '0', 0, NULL, '0'),
	(8, 14, 19, 0, 10, 2, 1, 6, 0, '2024-09-20 14:29:41', '2024-09-20 14:29:41', '2024-09-20', '0000-00-00', '0000-00-00', 'INV/007-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 81081081.08, 1, 8918918.92, 2, 1216216, 90000000.00, 0.00, 0.00, 56514000.00, 5600486.49, 28951351.35, NULL, NULL, '0', '0', 0, NULL, '0'),
	(9, 2, 12, 0, 1, 2, 1, 8, 0, '2024-09-24 14:21:52', '2024-09-24 14:30:28', '2024-09-24', '0000-00-00', '2024-09-24', 'INV/008-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 6000000.00, 11, 594594.59, 2, 81081, 6000000.00, 0.00, 0.00, 5000000.00, 495495.50, 324324.32, NULL, 1, '1', '1', 0, NULL, '0');
/*!40000 ALTER TABLE `tbl_trans_jual` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_det
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_det: ~16 rows (approximately)
DELETE FROM `tbl_trans_jual_det`;
/*!40000 ALTER TABLE `tbl_trans_jual_det` DISABLE KEYS */;
INSERT INTO `tbl_trans_jual_det` (`id`, `id_penjualan`, `id_item`, `id_item_kat`, `id_item_sat`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `kode`, `item`, `item_link`, `satuan`, `keterangan`, `harga`, `harga_dpp`, `harga_ppn`, `harga_pph`, `jml`, `jml_po`, `jml_satuan`, `disk1`, `disk2`, `disk3`, `diskon`, `potongan`, `subtotal`, `profit`, `harga_hpp`, `harga_hpp_ppn`, `harga_hpp_tot`, `status_hrg`, `status_brg`, `status_ppn`, `status_biaya`, `status`) VALUES
	(1, 1, 1, 198, 7, '2024-08-26 16:28:18', '2024-08-26 16:28:18', '2024-08-26', '010001198', 'FCC 820L High Pressure Cleaner ', '', 'UNIT', NULL, 2875000.00, 0.00, 0.00, 0.00, 2, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 5750000.00, 3302477.48, 900000.00, 178378.38, 1800000.00, 0, '0', '1', '0', 1),
	(2, 1, 4, 200, 7, '2024-08-26 16:28:18', '2024-08-26 16:28:18', '2024-08-26', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', '', 'UNIT', NULL, 517500.00, 0.00, 0.00, 0.00, 5, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 2587500.00, 296114.86, 400000.00, 198198.20, 2000000.00, 0, '0', '1', '0', 1),
	(3, 2, 22, 1, 1, '2024-08-29 20:15:48', '2024-08-29 20:15:48', '2024-08-29', '', 'Travelmate P214 Core i3 (TMP214/0037)', NULL, 'PCS', '--', 10500000.00, 9459459.46, 1040540.54, 141891.89, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 10500000.00, -101432.43, 9419000.00, 933414.41, 9419000.00, 0, '0', '1', NULL, 1),
	(4, 3, 1, 198, 7, '2024-09-09 14:25:09', '2024-09-09 14:25:09', '2024-09-04', '010001198', 'FCC 820L High Pressure Cleaner ', '', 'UNIT', NULL, 2875000.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 2875000.00, 1651238.74, 900000.00, 89189.19, 900000.00, 0, '0', '1', '0', 1),
	(5, 3, 0, 0, 0, '2024-09-09 14:25:09', '2024-09-09 14:25:09', '2024-09-04', '', 'Biaya Ongkir', NULL, '', NULL, 50000.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 50000.00, 0.00, 0.00, 0.00, 0.00, 0, '0', '0', '0', 2),
	(6, 3, 2, 199, 7, '2024-09-09 14:25:09', '2024-09-09 14:25:09', '2024-09-04', '020002199', 'OTOMATIC PLC HMI', '', 'UNIT', NULL, 20980600.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 20980600.00, 373919.82, 18244000.00, 0.00, 18244000.00, 0, '0', '0', '0', 1),
	(7, 4, 22, 163, 1, '2024-09-10 09:47:45', '2024-09-10 09:47:45', '2024-09-10', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 'tes.com', 'PCS', NULL, 10000000.00, 0.00, 0.00, 0.00, 5, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 50000000.00, -2725630.63, 9419000.00, 0.00, 47095000.00, 0, '0', '0', '0', 1),
	(8, 4, 0, 0, 0, '2024-09-10 09:47:45', '2024-09-10 09:47:45', '2024-09-10', '', 'ongkir', NULL, '', NULL, 100000.00, 0.00, 0.00, 0.00, 2, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 200000.00, 0.00, 0.00, 0.00, 0.00, 0, '0', '0', '1', 2),
	(9, 5, 1, 198, 7, '2024-09-16 06:31:25', '2024-09-16 06:31:25', '2024-09-16', '010001198', 'FCC 820L High Pressure Cleaner ', 'Tes. Com', 'UNIT', NULL, 2875000.00, 0.00, 0.00, 0.00, 10, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 28750000.00, 16512387.39, 900000.00, 891891.89, 9000000.00, 0, '0', '1', '0', 1),
	(10, 5, 4, 200, 7, '2024-09-16 06:31:25', '2024-09-16 06:31:25', '2024-09-16', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', 'Tes. Com', 'UNIT', NULL, 517500.00, 0.00, 0.00, 0.00, 5, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 2587500.00, 296114.86, 400000.00, 0.00, 2000000.00, 0, '0', '0', '0', 1),
	(11, 5, 0, 0, 0, '2024-09-16 06:31:25', '2024-09-16 06:31:25', '2024-09-16', '', 'Ongkir', NULL, '', NULL, 200000.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 200000.00, 0.00, 0.00, 0.00, 0.00, 0, '0', '0', '1', 2),
	(12, 6, 1, 198, 7, '2024-09-20 14:11:16', '2024-09-20 14:11:16', '2024-09-20', '010001198', 'FCC 820L High Pressure Cleaner ', '', 'UNIT', NULL, 2875000.00, 0.00, 0.00, 0.00, 5, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 14375000.00, 8256193.69, 900000.00, 445945.95, 4500000.00, 0, '0', '1', '0', 1),
	(13, 6, 0, 0, 0, '2024-09-20 14:11:16', '2024-09-20 14:11:16', '2024-09-20', '', 'Ongkir', NULL, '', NULL, 15000.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 15000.00, 0.00, 0.00, 0.00, 0.00, 0, '0', '0', '0', 2),
	(15, 8, 22, 163, 7, '2024-09-20 14:29:41', '2024-09-20 14:29:41', '2024-09-20', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', '', 'UNIT', NULL, 15000000.00, 0.00, 0.00, 0.00, 6, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 90000000.00, 23350864.86, 9419000.00, 5600486.49, 56514000.00, 0, '0', '1', '0', 1),
	(16, 9, 1, 1, 1, '2024-09-24 14:21:52', '2024-09-24 14:21:52', '2024-09-24', '1234567', 'TESTING ITEM BARU', '', 'PCS', NULL, 6000000.00, 0.00, 0.00, 0.00, 1, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 6000000.00, 324324.32, 5000000.00, 0.00, 5000000.00, 0, '0', '0', '0', 1),
	(17, 9, 0, 0, 0, '2024-09-24 14:23:18', '2024-09-24 14:23:18', '2024-09-24', '', 'ongkir', NULL, '', '-', 50000.00, 0.00, 0.00, 0.00, 1, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 50000.00, 0.00, 0.00, 0.00, 0.00, 0, '0', '', NULL, 2);
/*!40000 ALTER TABLE `tbl_trans_jual_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_file
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Unggah dokumen penjualan';

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_file: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_file`;
/*!40000 ALTER TABLE `tbl_trans_jual_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_file` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_hist
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_hist: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_hist`;
/*!40000 ALTER TABLE `tbl_trans_jual_hist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_hist` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_kirim
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_kirim: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_kirim`;
/*!40000 ALTER TABLE `tbl_trans_jual_kirim` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_kirim` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_kwi
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_kwi: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_kwi`;
/*!40000 ALTER TABLE `tbl_trans_jual_kwi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_kwi` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_log
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_log: ~17 rows (approximately)
DELETE FROM `tbl_trans_jual_log`;
/*!40000 ALTER TABLE `tbl_trans_jual_log` DISABLE KEYS */;
INSERT INTO `tbl_trans_jual_log` (`id`, `id_penjualan`, `id_user`, `tgl_simpan`, `tgl_modif`, `log`, `status`) VALUES
	(1, 1, 2, '2024-08-26 16:28:18', '2024-08-26 16:28:18', '{"id_rab":"1","id_user":"2","id_sales":"12","id_pelanggan":"1","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-08-26","no_nota":"INV\\/001-ARS\\/VIII\\/2024","no_kontrak":null,"no_paket":null,"jml_total":7511261.26,"ppn":1.11,"jml_ppn":826238.74,"pph":1.5,"jml_pph":112668.92,"jml_gtotal":8337500,"jml_biaya":0,"jml_hpp":3800000,"jml_hpp_ppn":376576.58,"jml_profit":3975168.92,"status":"0","status_ppn":null}', 1),
	(2, 1, 2, '2024-08-28 00:11:04', '2024-08-28 00:11:04', '{"jml_total":7511261.26126126,"ppn":11,"jml_ppn":826238.7387387387,"pph":1.5,"jml_pph":112668.91891891889,"jml_gtotal":8337500,"jml_biaya":0,"jml_hpp":3800000,"jml_hpp_ppn":376576.57657657657,"jml_profit":3975168.9223423414,"status":"1","tgl_modif":"2024-08-28 00:11:04"}', 2),
	(3, 2, 2, '2024-08-29 20:15:53', '2024-08-29 20:15:53', '{"jml_total":9459459.45945946,"ppn":11,"jml_ppn":1040540.5405405406,"pph":1.5,"jml_pph":141891.8918918919,"jml_gtotal":10500000,"jml_biaya":0,"jml_hpp":9419000,"jml_hpp_ppn":933414.4144144144,"jml_profit":831981.9775675683,"status":"1","tgl_modif":"2024-08-29 20:15:53"}', 2),
	(4, 3, 2, '2024-09-09 14:25:09', '2024-09-09 14:25:09', '{"id_rab":"2","id_user":"2","id_sales":"12","id_pelanggan":"1","id_perusahaan":"2","id_tipe":"2","tgl_masuk":"2024-09-04","no_nota":"INV\\/003-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":21491531.53,"ppn":1.11,"jml_ppn":2364068.47,"pph":1.5,"jml_pph":322372.97,"jml_gtotal":23855600,"jml_biaya":0,"jml_hpp":19144000,"jml_hpp_ppn":89189.19,"jml_profit":2064347.75,"status":"0","status_ppn":null}', 1),
	(5, 3, 2, '2024-09-09 14:25:24', '2024-09-09 14:25:24', '{"jml_total":21491531.53153153,"ppn":11,"jml_ppn":2364068.4684684686,"pph":1.5,"jml_pph":322372.97297297296,"jml_gtotal":23855600,"jml_biaya":50000,"jml_hpp":19144000,"jml_hpp_ppn":1897153.1531531531,"jml_profit":2064347.7485585571,"status":"1","tgl_modif":"2024-09-09 14:25:24"}', 2),
	(6, 3, 2, '2024-09-09 14:38:24', '2024-09-09 14:38:24', '{"tgl_bayar":"2024-09-09","jml_total":23856000,"metode_bayar":"1","status_bayar":"1","tgl_modif":"2024-09-09 14:38:24"}', 2),
	(7, 4, 2, '2024-09-10 09:47:45', '2024-09-10 09:47:45', '{"id_rab":"3","id_user":"2","id_sales":"12","id_pelanggan":"6","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-10","no_nota":"INV\\/004-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":45225225.23,"ppn":1.11,"jml_ppn":4974774.77,"pph":1.5,"jml_pph":678378.38,"jml_gtotal":50000000,"jml_biaya":200000,"jml_hpp":47095000,"jml_hpp_ppn":0,"jml_profit":-2548153.15,"status":"0","status_ppn":null}', 1),
	(8, 4, 2, '2024-09-10 09:47:54', '2024-09-10 09:47:54', '{"jml_total":45225225.22522522,"ppn":11,"jml_ppn":4974774.774774775,"pph":1.5,"jml_pph":678378.3783783782,"jml_gtotal":50200000,"jml_biaya":0,"jml_hpp":47095000,"jml_hpp_ppn":4667072.072072072,"jml_profit":-2548153.1531531587,"status":"1","tgl_modif":"2024-09-10 09:47:54"}', 2),
	(9, 4, 2, '2024-09-10 15:03:38', '2024-09-10 15:03:38', '{"jml_total":45225225.22522522,"ppn":11,"jml_ppn":4974774.774774775,"pph":1.5,"jml_pph":678378.3783783782,"jml_gtotal":50200000,"jml_biaya":0,"jml_hpp":47095000,"jml_hpp_ppn":4667072.072072072,"jml_profit":-2548153.1531531587,"status":"0","tgl_modif":"2024-09-10 15:03:38"}', 2),
	(10, 5, 2, '2024-09-16 06:31:25', '2024-09-16 06:31:25', '{"id_rab":"4","id_user":"2","id_sales":"13","id_pelanggan":"2","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-16","no_nota":"INV\\/005-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":28412162.16,"ppn":1.11,"jml_ppn":3125337.84,"pph":1.5,"jml_pph":426182.43,"jml_gtotal":31337500,"jml_biaya":200000,"jml_hpp":11000000,"jml_hpp_ppn":891891.89,"jml_profit":17877871.62,"status":"0","status_ppn":null}', 1),
	(11, 5, 2, '2024-09-16 06:31:31', '2024-09-16 06:31:31', '{"jml_total":28412162.16216216,"ppn":11,"jml_ppn":3125337.8378378376,"pph":1.5,"jml_pph":426182.43243243237,"jml_gtotal":31537500,"jml_biaya":0,"jml_hpp":11000000,"jml_hpp_ppn":1090090.0900900902,"jml_profit":17877871.619729728,"status":"1","tgl_modif":"2024-09-16 06:31:31"}', 2),
	(12, 5, 2, '2024-09-17 10:17:58', '2024-09-17 10:17:58', '{"tgl_bayar":"2024-09-17","jml_total":31537500,"metode_bayar":"1","status_bayar":"1","tgl_modif":"2024-09-17 10:17:58"}', 2),
	(13, 6, 14, '2024-09-20 14:11:16', '2024-09-20 14:11:16', '{"id_rab":"5","id_user":"14","id_sales":"12","id_pelanggan":"12","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-20","no_nota":"INV\\/006-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":12950450.45,"ppn":1.11,"jml_ppn":1424549.55,"pph":1.5,"jml_pph":194256.76,"jml_gtotal":14375000,"jml_biaya":0,"jml_hpp":4500000,"jml_hpp_ppn":445945.95,"jml_profit":8687139.64,"status":"0","status_ppn":null}', 1),
	(16, 8, 14, '2024-09-20 14:29:41', '2024-09-20 14:29:41', '{"id_rab":"6","id_user":"14","id_sales":"19","id_pelanggan":"10","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-20","no_nota":"INV\\/007-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":81081081.08,"ppn":1.11,"jml_ppn":8918918.92,"pph":1.5,"jml_pph":1216216.22,"jml_gtotal":90000000,"jml_biaya":0,"jml_hpp":56514000,"jml_hpp_ppn":5600486.49,"jml_profit":28951351.35,"status":"0","status_ppn":null}', 1),
	(17, 9, 2, '2024-09-24 14:21:52', '2024-09-24 14:21:52', '{"id_rab":"8","id_user":"2","id_sales":"12","id_pelanggan":"1","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-24","no_nota":"INV\\/008-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_total":5405405.41,"ppn":1.11,"jml_ppn":594594.59,"pph":1.5,"jml_pph":81081.08,"jml_gtotal":6000000,"jml_biaya":0,"jml_hpp":5000000,"jml_hpp_ppn":0,"jml_profit":324324.33,"status":"0","status_ppn":null}', 1),
	(18, 9, 2, '2024-09-24 14:23:53', '2024-09-24 14:23:53', '{"jml_total":5405405.405405405,"ppn":11,"jml_ppn":594594.5945945946,"pph":1.5,"jml_pph":81081.08108108107,"jml_gtotal":6000000,"jml_biaya":0,"jml_hpp":5000000,"jml_hpp_ppn":495495.4954954955,"jml_profit":324324.3243243238,"status":"1","tgl_modif":"2024-09-24 14:23:53"}', 2),
	(19, 9, 2, '2024-09-24 14:30:28', '2024-09-24 14:30:28', '{"tgl_bayar":"2024-09-24","jml_total":6000000,"metode_bayar":"1","status_bayar":"1","tgl_modif":"2024-09-24 14:30:28"}', 2);
/*!40000 ALTER TABLE `tbl_trans_jual_log` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_pen
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_pen: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_pen`;
/*!40000 ALTER TABLE `tbl_trans_jual_pen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_pen` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_pen_det
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_pen_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_pen_det`;
/*!40000 ALTER TABLE `tbl_trans_jual_pen_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_pen_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_plat
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_plat: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_plat`;
/*!40000 ALTER TABLE `tbl_trans_jual_plat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_plat` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_jual_po
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_jual_po: ~0 rows (approximately)
DELETE FROM `tbl_trans_jual_po`;
/*!40000 ALTER TABLE `tbl_trans_jual_po` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_jual_po` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_mutasi
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Mencatat transaksi mutasi keluar masuk gudang';

-- Dumping data for table mikhaelf_db_ars.tbl_trans_mutasi: ~3 rows (approximately)
DELETE FROM `tbl_trans_mutasi`;
/*!40000 ALTER TABLE `tbl_trans_mutasi` DISABLE KEYS */;
INSERT INTO `tbl_trans_mutasi` (`id`, `id_user`, `id_user_terima`, `id_gd_asal`, `id_gd_tujuan`, `id_sales`, `id_pelanggan`, `id_perusahaan`, `id_penjualan`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `tgl_keluar`, `no_nota`, `keterangan`, `tipe`, `status`, `status_hps`, `status_terima`) VALUES
	(4, 2, 0, 1, 0, 0, 5, 2, 0, '2024-09-19 15:39:21', '2024-09-19 15:41:11', '2024-09-19', '0000-00-00', 'MTS-00001', 'tes mutasi tes', '3', '1', '0', '0'),
	(6, 2, 0, 1, 0, 0, 1, 2, 0, '2024-09-24 14:34:07', '2024-09-24 14:34:07', '2024-09-24', '0000-00-00', 'MTS-00002', 'barang rusak', '3', '0', '0', '0'),
	(7, 2, 0, 1, 0, 12, 1, 2, 9, '2024-09-24 21:56:12', '2024-09-24 21:56:12', '2024-09-24', '0000-00-00', 'DO-00001', 'TEST', '4', '1', '0', '0');
/*!40000 ALTER TABLE `tbl_trans_mutasi` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_mutasi_det
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Mencatat transaksi mutasi antar gudang';

-- Dumping data for table mikhaelf_db_ars.tbl_trans_mutasi_det: ~3 rows (approximately)
DELETE FROM `tbl_trans_mutasi_det`;
/*!40000 ALTER TABLE `tbl_trans_mutasi_det` DISABLE KEYS */;
INSERT INTO `tbl_trans_mutasi_det` (`id`, `id_mutasi`, `id_user`, `id_item`, `id_item_kat`, `id_satuan`, `id_penjualan_det`, `tgl_simpan`, `tgl_modif`, `tgl_terima`, `tgl_masuk`, `sn`, `kode`, `item`, `satuan`, `keterangan`, `jml`, `jml_satuan`, `jml_diterima`, `status_brg`, `status_terima`) VALUES
	(3, 4, 2, 22, 163, 1, 0, '2024-09-19 15:39:38', '2024-09-19 15:39:38', '0000-00-00 00:00:00', '2024-09-19', NULL, '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 'PCS', NULL, 10, 1, 0, '0', '0'),
	(5, 6, 2, 2, 1, 7, 0, '2024-09-24 14:34:29', '2024-09-24 14:34:29', '0000-00-00 00:00:00', '2024-09-24', NULL, '1234567', 'tambah item rab baru', 'UNIT', NULL, 1, 1, 0, '0', '0'),
	(6, 7, 2, 1, 1, 7, 16, '2024-09-24 21:58:17', '2024-09-24 21:58:17', '0000-00-00 00:00:00', '2024-09-24', NULL, '1234567', 'TESTING ITEM BARU', 'UNIT', 'UDVWKSD039417004E20601,UDVWKSD039417004E20601,UDVWKSD039417004E20601,UDVWKSD039417004E20601, UDVWKSD039417004E20601,UDVWKSD039417004E20601,UDVWKSD039417004E20601,', 1, 1, 0, '0', '0');
/*!40000 ALTER TABLE `tbl_trans_mutasi_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_mutasi_stok
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_mutasi_stok: ~0 rows (approximately)
DELETE FROM `tbl_trans_mutasi_stok`;
/*!40000 ALTER TABLE `tbl_trans_mutasi_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_mutasi_stok` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_pesanan
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_pesanan: ~0 rows (approximately)
DELETE FROM `tbl_trans_pesanan`;
/*!40000 ALTER TABLE `tbl_trans_pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_pesanan` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_pesanan_det
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_pesanan_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_pesanan_det`;
/*!40000 ALTER TABLE `tbl_trans_pesanan_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_pesanan_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_rab
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_rab: ~9 rows (approximately)
DELETE FROM `tbl_trans_rab`;
/*!40000 ALTER TABLE `tbl_trans_rab` DISABLE KEYS */;
INSERT INTO `tbl_trans_rab` (`id`, `id_user`, `id_sales`, `id_pelanggan`, `id_perusahaan`, `id_tipe`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `no_rab`, `no_kontrak`, `no_paket`, `keterangan`, `jml_hps`, `jml_pagu`, `jml_total`, `ppn`, `jml_ppn`, `pph`, `jml_pph`, `jml_gtotal`, `jml_biaya`, `jml_hpp`, `jml_hpp_ppn`, `jml_profit`, `status`, `status_ppn`, `status_hps`) VALUES
	(1, 2, 12, 1, 2, 1, '2024-08-26 15:58:53', '2024-08-26 16:28:18', '2024-08-26', 'RAB/001-ARS/VIII/2024', NULL, NULL, NULL, 0.00, 50000000.00, 7511261.26, 1.11, 826238.74, 1.50, 112668.92, 8337500.00, 0.00, 3800000.00, 376576.58, 3975168.92, '6', NULL, '0'),
	(2, 2, 12, 1, 2, 2, '2024-09-04 14:32:47', '2024-09-09 14:25:09', '2024-09-04', 'RAB/002-ARS/IX/2024', NULL, NULL, NULL, 0.00, 20000000.00, 21491531.53, 1.11, 2364068.47, 1.50, 322372.97, 23855600.00, 0.00, 19144000.00, 89189.19, 2064347.75, '6', NULL, '0'),
	(3, 2, 12, 6, 2, 1, '2024-09-10 09:44:34', '2024-09-10 09:47:45', '2024-09-10', 'RAB/003-ARS/IX/2024', NULL, NULL, NULL, 0.00, 50000000.00, 45225225.23, 1.11, 4974774.77, 1.50, 678378.38, 50000000.00, 200000.00, 47095000.00, 0.00, -2548153.15, '6', NULL, '0'),
	(4, 2, 13, 2, 2, 1, '2024-09-16 06:26:47', '2024-09-16 06:31:25', '2024-09-16', 'RAB/004-ARS/IX/2024', NULL, NULL, NULL, 0.00, 50000000.00, 28412162.16, 1.11, 3125337.84, 1.50, 426182.43, 31337500.00, 200000.00, 11000000.00, 891891.89, 17877871.62, '6', NULL, '0'),
	(5, 14, 12, 12, 2, 1, '2024-09-20 14:09:47', '2024-09-20 14:11:16', '2024-09-20', 'RAB/005-ARS/IX/2024', NULL, NULL, NULL, 0.00, 8.00, 12950450.45, 1.11, 1424549.55, 1.50, 194256.76, 14375000.00, 0.00, 4500000.00, 445945.95, 8687139.64, '6', NULL, '0'),
	(6, 14, 19, 10, 2, 1, '2024-09-20 14:25:33', '2024-09-20 14:29:41', '2024-09-20', 'RAB/006-ARS/IX/2024', NULL, NULL, NULL, 0.00, 8000000.00, 81081081.08, 1.11, 8918918.92, 1.50, 1216216.22, 90000000.00, 0.00, 56514000.00, 5600486.49, 28951351.35, '6', NULL, '0'),
	(7, 13, 13, 15, 2, 1, '2024-09-21 10:38:44', '2024-09-21 10:58:27', '2024-09-03', 'RAB/007-ARS/IX/2024', NULL, NULL, NULL, 0.00, 49400000.00, 34234234.23, 1.11, 3765765.77, 1.50, 513513.51, 38000000.00, 0.00, 27375000.00, 2712837.84, 5058558.56, '4', NULL, '0'),
	(8, 2, 12, 1, 2, 1, '2024-09-24 14:13:55', '2024-09-24 14:21:52', '2024-09-24', 'RAB/008-ARS/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 5405405.41, 1.11, 594594.59, 1.50, 81081.08, 6000000.00, 0.00, 5000000.00, 0.00, 324324.33, '6', NULL, '0'),
	(9, 2, 19, 1, 8, 1, '2024-09-24 14:44:56', '2024-09-24 21:27:15', '2024-09-24', 'RAB/009-MST/IX/2024', NULL, NULL, NULL, 0.00, 0.00, 5405405.41, 1.11, 594594.59, 1.50, 81081.08, 6000000.00, 0.00, 5000000.00, 495495.50, 819819.83, '0', NULL, '0');
/*!40000 ALTER TABLE `tbl_trans_rab` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_rab_det
DROP TABLE IF EXISTS `tbl_trans_rab_det`;
CREATE TABLE IF NOT EXISTS `tbl_trans_rab_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rab` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_item` int(11) DEFAULT 0,
  `id_item_kat` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `tgl_simpan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_modif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_masuk` date NOT NULL DEFAULT '0000-00-00',
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_rab_det: ~17 rows (approximately)
DELETE FROM `tbl_trans_rab_det`;
/*!40000 ALTER TABLE `tbl_trans_rab_det` DISABLE KEYS */;
INSERT INTO `tbl_trans_rab_det` (`id`, `id_rab`, `id_user`, `id_item`, `id_item_kat`, `id_satuan`, `tgl_simpan`, `tgl_modif`, `tgl_masuk`, `kode`, `item`, `item_link`, `jml`, `jml_satuan`, `jml_po`, `satuan`, `harga`, `harga_dpp`, `harga_ppn`, `harga_pph`, `subtotal`, `harga_hpp`, `harga_hpp_ppn`, `harga_hpp_tot`, `profit`, `keterangan`, `status_ppn`, `status_biaya`, `status`) VALUES
	(1, 1, 2, 1, 198, 7, '2024-08-26 15:59:13', '2024-08-26 16:06:45', '2024-08-26', '010001198', 'FCC 820L High Pressure Cleaner ', '', 2, 1, 2, 'UNIT', 2875000.00, 5180180.18, 569819.82, 77702.70, 5750000.00, 900000.00, 178378.38, 1800000.00, 3302477.48, '', 1, 0, 1),
	(2, 1, 2, 4, 200, 7, '2024-08-26 15:59:33', '2024-08-26 16:27:30', '2024-08-26', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', '', 5, 1, 5, 'UNIT', 517500.00, 2331081.08, 256418.92, 34966.22, 2587500.00, 400000.00, 198198.20, 2000000.00, 296114.86, '', 1, 0, 1),
	(3, 2, 2, 1, 198, 7, '2024-09-09 14:12:35', '2024-09-09 14:23:47', '2024-09-04', '010001198', 'FCC 820L High Pressure Cleaner ', '', 1, 1, 1, 'UNIT', 2875000.00, 2590090.09, 284909.91, 38851.35, 2875000.00, 900000.00, 89189.19, 900000.00, 1651238.74, 'TESTING', 1, 0, 1),
	(4, 2, 2, 0, 0, 0, '2024-09-09 14:13:06', '2024-09-09 14:13:06', '2024-09-04', '', 'Biaya Ongkir', NULL, 1, 1, 0, '', 50000.00, 0.00, 0.00, 0.00, 50000.00, 0.00, 0.00, 0.00, 0.00, '', 0, 0, 2),
	(5, 2, 2, 2, 199, 7, '2024-09-09 14:21:13', '2024-09-09 14:24:23', '2024-09-04', '020002199', 'OTOMATIC PLC HMI', '', 1, 1, 1, 'UNIT', 20980600.00, 18901441.44, 2079158.56, 283521.62, 20980600.00, 18244000.00, 0.00, 18244000.00, 373919.82, '', 0, 0, 1),
	(6, 3, 2, 22, 163, 1, '2024-09-10 09:45:19', '2024-09-10 09:45:44', '2024-09-10', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', 'tes.com', 5, 1, 0, 'PCS', 10000000.00, 45045045.05, 4954954.95, 675675.68, 50000000.00, 9419000.00, 0.00, 47095000.00, -2725630.63, 'tes', 0, 0, 1),
	(7, 3, 2, 0, 0, 0, '2024-09-10 09:46:33', '2024-09-10 09:46:33', '2024-09-10', '', 'ongkir', NULL, 2, 1, 0, '', 100000.00, 0.00, 0.00, 0.00, 200000.00, 0.00, 0.00, 0.00, 0.00, '-', 0, 1, 2),
	(8, 4, 2, 1, 198, 7, '2024-09-16 06:27:24', '2024-09-16 06:30:28', '2024-09-16', '010001198', 'FCC 820L High Pressure Cleaner ', 'Tes. Com', 10, 1, 10, 'UNIT', 2875000.00, 25900900.90, 2849099.10, 388513.51, 28750000.00, 900000.00, 891891.89, 9000000.00, 16512387.39, 'Tes', 1, 0, 1),
	(9, 4, 2, 4, 200, 7, '2024-09-16 06:28:17', '2024-09-16 06:31:17', '2024-09-16', '000004165', 'KURSI LABORATORIUM BESI + KAYU JATI', 'Tes. Com', 5, 1, 5, 'UNIT', 517500.00, 2331081.08, 256418.92, 34966.22, 2587500.00, 400000.00, 0.00, 2000000.00, 296114.86, 'Tes', 0, 0, 1),
	(10, 4, 2, 0, 0, 0, '2024-09-16 06:28:45', '2024-09-16 06:28:45', '2024-09-16', '', 'Ongkir', NULL, 1, 1, 0, '', 200000.00, 0.00, 0.00, 0.00, 200000.00, 0.00, 0.00, 0.00, 0.00, 'Tes', 0, 1, 2),
	(11, 5, 14, 1, 198, 7, '2024-09-20 14:10:01', '2024-09-20 14:11:07', '2024-09-20', '010001198', 'FCC 820L High Pressure Cleaner ', '', 5, 1, 5, 'UNIT', 2875000.00, 12950450.45, 1424549.55, 194256.76, 14375000.00, 900000.00, 445945.95, 4500000.00, 8256193.69, '', 1, 0, 1),
	(12, 5, 14, 0, 0, 0, '2024-09-20 14:10:20', '2024-09-20 14:10:20', '2024-09-20', '', 'Ongkir', NULL, 1, 1, 0, '', 15000.00, 0.00, 0.00, 0.00, 15000.00, 0.00, 0.00, 0.00, 0.00, '', 0, 0, 2),
	(13, 6, 14, 22, 163, 7, '2024-09-20 14:26:11', '2024-09-20 14:29:28', '2024-09-20', '100007163', 'Travelmate P214 Core i3 (TMP214/0037)', '', 6, 1, 6, 'UNIT', 15000000.00, 81081081.08, 8918918.92, 1216216.22, 90000000.00, 9419000.00, 5600486.49, 56514000.00, 23350864.86, '', 1, 0, 1),
	(14, 7, 13, 25, 11, 7, '2024-09-21 10:45:27', '2024-09-21 11:02:52', '2024-09-03', '12000911', 'Polytron AC 2 PK Deluxe PAC 18VH indor', 'https://e-katalog.lkpp.go.id/katalog/produk/detail/77214536?type=general', 5, 1, 5, 'UNIT', 7600000.00, 34234234.23, 3765765.77, 513513.51, 38000000.00, 5475000.00, 2712837.84, 27375000.00, 6345720.72, 'Inc Pemasangan Standart', 1, 0, 1),
	(15, 7, 13, 0, 0, 0, '2024-09-21 10:51:09', '2024-09-21 10:55:40', '2024-09-03', '', 'Instalasi', NULL, 5, 1, 0, '', 800000.00, 0.00, 0.00, 0.00, 4000000.00, 0.00, 0.00, 0.00, 0.00, 'Instalasi AC Split 2pk ', 0, 0, 2),
	(16, 8, 2, 1, 1, 1, '2024-09-24 14:17:01', '2024-09-24 14:21:00', '2024-09-24', '1234567', 'TESTING ITEM BARU', '', 1, 1, 1, 'PCS', 6000000.00, 5405405.41, 594594.59, 81081.08, 6000000.00, 5000000.00, 0.00, 5000000.00, 324324.32, '-', 0, 0, 1),
	(17, 9, 2, 1, 1, 1, '2024-09-24 21:27:15', '2024-09-24 21:27:15', '2024-09-24', '1234567', 'TESTING ITEM BARU', '', 1, 1, 0, 'PCS', 6000000.00, 5405405.41, 594594.59, 81081.08, 6000000.00, 5000000.00, 495495.50, 5000000.00, 324324.32, '', 1, 0, 1);
/*!40000 ALTER TABLE `tbl_trans_rab_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_rab_log
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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_rab_log: ~122 rows (approximately)
DELETE FROM `tbl_trans_rab_log`;
/*!40000 ALTER TABLE `tbl_trans_rab_log` DISABLE KEYS */;
INSERT INTO `tbl_trans_rab_log` (`id`, `id_rab`, `id_user`, `tgl_simpan`, `tgl_modif`, `log`, `status`) VALUES
	(1, 1, 2, '2024-08-26 15:58:53', '2024-08-26 15:58:53', '{"id_user":"2","id_pelanggan":"1","id_sales":"12","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-08-26","no_rab":"RAB\\/001-ARS\\/VIII\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"50000000","status":"0","status_ppn":null,"tgl_simpan":"2024-08-26 15:58:53","tgl_modif":"2024-08-26 15:58:53"}', 1),
	(2, 1, 2, '2024-08-26 15:59:13', '2024-08-26 15:59:13', '{"id_rab":"1","id_user":"2","id_item":"1","id_item_kat":"198","id_satuan":"7","tgl_masuk":"2024-08-26","kode":"010001198","item":"FCC 820L High Pressure Cleaner ","item_link":"","jml":2,"jml_satuan":1,"satuan":"UNIT","harga":2875000,"harga_dpp":5180180.18018018,"harga_ppn":569819.8198198199,"harga_pph":77702.70270270269,"subtotal":5750000,"profit":3302477.477477477,"harga_hpp":900000,"harga_hpp_ppn":178378.37837837837,"harga_hpp_tot":1800000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-08-26 15:59:13","tgl_modif":"2024-08-26 15:59:13"}', 1),
	(3, 1, 2, '2024-08-26 15:59:13', '2024-08-26 15:59:13', '{"jml_total":5180180.18,"ppn":1.11,"jml_ppn":569819.82,"pph":1.5,"jml_pph":77702.7,"jml_gtotal":5750000,"jml_biaya":0,"jml_hpp":1800000,"jml_hpp_ppn":178378.38,"jml_profit":3480855.8599999994,"tgl_modif":"2024-08-26 15:59:13"}', 2),
	(4, 1, 2, '2024-08-26 15:59:33', '2024-08-26 15:59:33', '{"id_rab":"1","id_user":"2","id_item":"4","id_item_kat":"200","id_satuan":"7","tgl_masuk":"2024-08-26","kode":"000004165","item":"KURSI LABORATORIUM BESI + KAYU JATI","item_link":"","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":517500,"harga_dpp":2331081.0810810807,"harga_ppn":256418.91891891893,"harga_pph":34966.21621621621,"subtotal":2587500,"profit":296114.86486486485,"harga_hpp":400000,"harga_hpp_ppn":198198.1981981982,"harga_hpp_tot":2000000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-08-26 15:59:33","tgl_modif":"2024-08-26 15:59:33"}', 1),
	(5, 1, 2, '2024-08-26 15:59:33', '2024-08-26 15:59:33', '{"jml_total":7511261.26,"ppn":1.11,"jml_ppn":826238.74,"pph":1.5,"jml_pph":112668.92,"jml_gtotal":8337500,"jml_biaya":0,"jml_hpp":3800000,"jml_hpp_ppn":376576.58,"jml_profit":3975168.92,"tgl_modif":"2024-08-26 15:59:33"}', 2),
	(6, 1, 2, '2024-08-26 15:59:51', '2024-08-26 15:59:51', '{"status":"1","tgl_modif":"2024-08-26 15:59:51"}', 2),
	(7, 1, 2, '2024-08-26 16:00:00', '2024-08-26 16:00:00', '{"status":"2","tgl_modif":"2024-08-26 16:00:00"}', 2),
	(8, 1, 2, '2024-08-26 16:06:17', '2024-08-26 16:06:17', '{"status":"4","tgl_modif":"2024-08-26 16:06:17"}', 2),
	(9, 1, 2, '2024-08-26 16:06:45', '2024-08-26 16:06:45', '{"jml_po":2,"tgl_modif":"2024-08-26 16:06:45"}', 2),
	(10, 1, 2, '2024-08-26 16:27:30', '2024-08-26 16:27:30', '{"jml_po":5,"tgl_modif":"2024-08-26 16:27:30"}', 2),
	(11, 1, 2, '2024-08-26 16:28:18', '2024-08-26 16:28:18', '{"status":"6","tgl_modif":"2024-08-26 16:28:18"}', 2),
	(12, 2, 2, '2024-09-04 14:32:47', '2024-09-04 14:32:47', '{"id_user":"2","id_pelanggan":"1","id_sales":"12","id_perusahaan":"2","id_tipe":"2","tgl_masuk":"2024-09-04","no_rab":"RAB\\/002-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"20000000","status":"0","status_ppn":null,"tgl_simpan":"2024-09-04 14:32:47","tgl_modif":"2024-09-04 14:32:47"}', 1),
	(13, 2, 2, '2024-09-09 14:12:35', '2024-09-09 14:12:35', '{"id_rab":"2","id_user":"2","id_item":"1","id_item_kat":"198","id_satuan":"7","tgl_masuk":"2024-09-04","kode":"010001198","item":"FCC 820L High Pressure Cleaner ","item_link":"","jml":1,"jml_satuan":1,"satuan":"UNIT","harga":2875000,"harga_dpp":2590090.09009009,"harga_ppn":284909.90990990994,"harga_pph":38851.351351351346,"subtotal":2875000,"profit":1651238.7387387385,"harga_hpp":900000,"harga_hpp_ppn":89189.18918918919,"harga_hpp_tot":900000,"keterangan":"TESTING","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-09 14:12:35","tgl_modif":"2024-09-09 14:12:35"}', 1),
	(14, 2, 2, '2024-09-09 14:12:35', '2024-09-09 14:12:35', '{"jml_total":2590090.09,"ppn":1.11,"jml_ppn":284909.91,"pph":1.5,"jml_pph":38851.35,"jml_gtotal":2875000,"jml_biaya":0,"jml_hpp":900000,"jml_hpp_ppn":89189.19,"jml_profit":1740427.9299999997,"tgl_modif":"2024-09-09 14:12:35"}', 2),
	(15, 2, 2, '2024-09-09 14:13:06', '2024-09-09 14:13:06', '{"id_rab":"2","id_user":"2","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-04","kode":"","item":"Biaya Ongkir","item_link":null,"jml":1,"jml_satuan":1,"satuan":"","harga":50000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":50000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"","status":2,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-09 14:13:06","tgl_modif":"2024-09-09 14:13:06"}', 1),
	(16, 2, 2, '2024-09-09 14:13:06', '2024-09-09 14:13:06', '{"jml_total":2590090.09,"ppn":1.11,"jml_ppn":284909.91,"pph":1.5,"jml_pph":38851.35,"jml_gtotal":2875000,"jml_biaya":0,"jml_hpp":900000,"jml_hpp_ppn":89189.19,"jml_profit":1690427.9299999997,"tgl_modif":"2024-09-09 14:13:06"}', 2),
	(17, 2, 2, '2024-09-09 14:14:54', '2024-09-09 14:14:54', '{"id_pelanggan":"1","id_sales":"12","id_perusahaan":"3","id_tipe":"2","status":"0","tgl_modif":"2024-09-09 14:14:54"}', 2),
	(18, 2, 2, '2024-09-09 14:14:59', '2024-09-09 14:14:59', '{"id_pelanggan":"1","id_sales":"12","id_perusahaan":"8","id_tipe":"2","status":"0","tgl_modif":"2024-09-09 14:14:59"}', 2),
	(19, 2, 2, '2024-09-09 14:15:36', '2024-09-09 14:15:36', '{"status":"1","tgl_modif":"2024-09-09 14:15:36"}', 2),
	(20, 2, 2, '2024-09-09 14:16:46', '2024-09-09 14:16:46', '{"status":"0","tgl_modif":"2024-09-09 14:16:46"}', 2),
	(21, 2, 2, '2024-09-09 14:17:10', '2024-09-09 14:17:10', '{"id_pelanggan":"1","id_sales":"12","id_perusahaan":"2","id_tipe":"2","status":"0","tgl_modif":"2024-09-09 14:17:10"}', 2),
	(22, 2, 2, '2024-09-09 14:17:15', '2024-09-09 14:17:15', '{"status":"1","tgl_modif":"2024-09-09 14:17:15"}', 2),
	(23, 2, 2, '2024-09-09 14:18:49', '2024-09-09 14:18:49', '{"status":"0","tgl_modif":"2024-09-09 14:18:49"}', 2),
	(24, 2, 2, '2024-09-09 14:21:13', '2024-09-09 14:21:13', '{"id_rab":"2","id_user":"2","id_item":"2","id_item_kat":"199","id_satuan":"7","tgl_masuk":"2024-09-04","kode":"020002199","item":"OTOMATIC PLC HMI","item_link":"","jml":1,"jml_satuan":1,"satuan":"UNIT","harga":20980600,"harga_dpp":18901441.44144144,"harga_ppn":2079158.5585585586,"harga_pph":283521.6216216216,"subtotal":20980600,"profit":373919.8198198229,"harga_hpp":18244000,"harga_hpp_ppn":0,"harga_hpp_tot":18244000,"keterangan":"","status":1,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-09 14:21:13","tgl_modif":"2024-09-09 14:21:13"}', 1),
	(25, 2, 2, '2024-09-09 14:21:13', '2024-09-09 14:21:13', '{"jml_total":21491531.53,"ppn":1.11,"jml_ppn":2364068.47,"pph":1.5,"jml_pph":322372.97,"jml_gtotal":23855600,"jml_biaya":0,"jml_hpp":19144000,"jml_hpp_ppn":89189.19,"jml_profit":2064347.7500000023,"tgl_modif":"2024-09-09 14:21:13"}', 2),
	(26, 2, 2, '2024-09-09 14:21:27', '2024-09-09 14:21:27', '{"id_rab":"2","id_user":"2","id_item":"2","id_item_kat":"199","id_satuan":"7","tgl_masuk":"2024-09-04","kode":"020002199","item":"OTOMATIC PLC HMI","item_link":"","jml":1,"jml_satuan":1,"satuan":"UNIT","harga":20980600,"harga_dpp":18901441.44144144,"harga_ppn":2079158.5585585586,"harga_pph":283521.6216216216,"subtotal":20980600,"profit":373919.8198198229,"harga_hpp":18244000,"harga_hpp_ppn":1807963.963963964,"harga_hpp_tot":18244000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_modif":"2024-09-09 14:21:27"}', 2),
	(27, 2, 2, '2024-09-09 14:21:27', '2024-09-09 14:21:27', '{"jml_total":21491531.53,"ppn":1.11,"jml_ppn":2364068.47,"pph":1.5,"jml_pph":322372.97,"jml_gtotal":23855600,"jml_biaya":0,"jml_hpp":19144000,"jml_hpp_ppn":1897153.15,"jml_profit":3872311.7100000023,"tgl_modif":"2024-09-09 14:21:27"}', 2),
	(28, 2, 2, '2024-09-09 14:21:32', '2024-09-09 14:21:32', '{"id_rab":"2","id_user":"2","id_item":"2","id_item_kat":"199","id_satuan":"7","tgl_masuk":"2024-09-04","kode":"020002199","item":"OTOMATIC PLC HMI","item_link":"","jml":1,"jml_satuan":1,"satuan":"UNIT","harga":20980600,"harga_dpp":18901441.44144144,"harga_ppn":2079158.5585585586,"harga_pph":283521.6216216216,"subtotal":20980600,"profit":373919.8198198229,"harga_hpp":18244000,"harga_hpp_ppn":0,"harga_hpp_tot":18244000,"keterangan":"","status":1,"status_ppn":0,"status_biaya":0,"tgl_modif":"2024-09-09 14:21:32"}', 2),
	(29, 2, 2, '2024-09-09 14:21:32', '2024-09-09 14:21:32', '{"jml_total":21491531.53,"ppn":1.11,"jml_ppn":2364068.47,"pph":1.5,"jml_pph":322372.97,"jml_gtotal":23855600,"jml_biaya":0,"jml_hpp":19144000,"jml_hpp_ppn":89189.19,"jml_profit":2064347.7500000023,"tgl_modif":"2024-09-09 14:21:32"}', 2),
	(30, 2, 2, '2024-09-09 14:21:37', '2024-09-09 14:21:37', '{"status":"1","tgl_modif":"2024-09-09 14:21:37"}', 2),
	(31, 2, 2, '2024-09-09 14:21:56', '2024-09-09 14:21:56', '{"status":"2","tgl_modif":"2024-09-09 14:21:56"}', 2),
	(32, 2, 2, '2024-09-09 14:22:43', '2024-09-09 14:22:43', '{"status":"4","tgl_modif":"2024-09-09 14:22:43"}', 2),
	(33, 2, 2, '2024-09-09 14:23:47', '2024-09-09 14:23:47', '{"jml_po":1,"tgl_modif":"2024-09-09 14:23:47"}', 2),
	(34, 2, 2, '2024-09-09 14:24:23', '2024-09-09 14:24:23', '{"jml_po":1,"tgl_modif":"2024-09-09 14:24:23"}', 2),
	(35, 2, 2, '2024-09-09 14:25:09', '2024-09-09 14:25:09', '{"status":"6","tgl_modif":"2024-09-09 14:25:09"}', 2),
	(36, 3, 2, '2024-09-10 09:44:34', '2024-09-10 09:44:34', '{"id_user":"2","id_pelanggan":"6","id_sales":"12","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-10","no_rab":"RAB\\/003-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"50000000","status":"0","status_ppn":null,"tgl_simpan":"2024-09-10 09:44:34","tgl_modif":"2024-09-10 09:44:34"}', 1),
	(37, 3, 2, '2024-09-10 09:45:19', '2024-09-10 09:45:19', '{"id_rab":"3","id_user":"2","id_item":"22","id_item_kat":"163","id_satuan":"1","tgl_masuk":"2024-09-10","kode":"100007163","item":"Travelmate P214 Core i3 (TMP214\\/0037)","item_link":"tes.com","jml":5,"jml_satuan":1,"satuan":"PCS","harga":10000000,"harga_dpp":45045045.04504504,"harga_ppn":4954954.954954955,"harga_pph":675675.6756756756,"subtotal":50000000,"profit":-2725630.6306306273,"harga_hpp":9419000,"harga_hpp_ppn":4667072.072072072,"harga_hpp_tot":47095000,"keterangan":"tes","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-10 09:45:19","tgl_modif":"2024-09-10 09:45:19"}', 1),
	(38, 3, 2, '2024-09-10 09:45:19', '2024-09-10 09:45:19', '{"jml_total":45045045.05,"ppn":1.11,"jml_ppn":4954954.95,"pph":1.5,"jml_pph":675675.68,"jml_gtotal":50000000,"jml_biaya":0,"jml_hpp":47095000,"jml_hpp_ppn":4667072.07,"jml_profit":1941441.4399999976,"tgl_modif":"2024-09-10 09:45:19"}', 2),
	(39, 3, 2, '2024-09-10 09:45:44', '2024-09-10 09:45:44', '{"id_rab":"3","id_user":"2","id_item":"22","id_item_kat":"163","id_satuan":"1","tgl_masuk":"2024-09-10","kode":"100007163","item":"Travelmate P214 Core i3 (TMP214\\/0037)","item_link":"tes.com","jml":5,"jml_satuan":1,"satuan":"PCS","harga":10000000,"harga_dpp":45045045.04504504,"harga_ppn":4954954.954954955,"harga_pph":675675.6756756756,"subtotal":50000000,"profit":-2725630.6306306273,"harga_hpp":9419000,"harga_hpp_ppn":0,"harga_hpp_tot":47095000,"keterangan":"tes","status":1,"status_ppn":0,"status_biaya":0,"tgl_modif":"2024-09-10 09:45:44"}', 2),
	(40, 3, 2, '2024-09-10 09:45:44', '2024-09-10 09:45:44', '{"jml_total":45045045.05,"ppn":1.11,"jml_ppn":4954954.95,"pph":1.5,"jml_pph":675675.68,"jml_gtotal":50000000,"jml_biaya":0,"jml_hpp":47095000,"jml_hpp_ppn":0,"jml_profit":-2725630.6300000027,"tgl_modif":"2024-09-10 09:45:44"}', 2),
	(41, 3, 2, '2024-09-10 09:46:33', '2024-09-10 09:46:33', '{"id_rab":"3","id_user":"2","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-10","kode":"","item":"ongkir","item_link":null,"jml":2,"jml_satuan":1,"satuan":"","harga":100000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":200000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"-","status":2,"status_ppn":0,"status_biaya":1,"tgl_simpan":"2024-09-10 09:46:33","tgl_modif":"2024-09-10 09:46:33"}', 1),
	(42, 3, 2, '2024-09-10 09:46:33', '2024-09-10 09:46:33', '{"jml_total":45225225.22522522,"ppn":1.11,"jml_ppn":4974774.774774775,"pph":1.5,"jml_pph":678378.3783783782,"jml_gtotal":50000000,"jml_biaya":200000,"jml_hpp":47095000,"jml_hpp_ppn":0,"jml_profit":-2548153.1531531587,"tgl_modif":"2024-09-10 09:46:33"}', 2),
	(43, 3, 2, '2024-09-10 09:46:59', '2024-09-10 09:46:59', '{"status":"1","tgl_modif":"2024-09-10 09:46:59"}', 2),
	(44, 3, 2, '2024-09-10 09:47:06', '2024-09-10 09:47:06', '{"status":"2","tgl_modif":"2024-09-10 09:47:06"}', 2),
	(45, 3, 2, '2024-09-10 09:47:38', '2024-09-10 09:47:38', '{"status":"4","tgl_modif":"2024-09-10 09:47:38"}', 2),
	(46, 3, 2, '2024-09-10 09:47:45', '2024-09-10 09:47:45', '{"status":"6","tgl_modif":"2024-09-10 09:47:45"}', 2),
	(47, 4, 2, '2024-09-16 06:26:47', '2024-09-16 06:26:47', '{"id_user":"2","id_pelanggan":"2","id_sales":"13","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-16","no_rab":"RAB\\/004-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"50000000","status":"0","status_ppn":null,"tgl_simpan":"2024-09-16 06:26:47","tgl_modif":"2024-09-16 06:26:47"}', 1),
	(48, 4, 2, '2024-09-16 06:27:24', '2024-09-16 06:27:24', '{"id_rab":"4","id_user":"2","id_item":"1","id_item_kat":"198","id_satuan":"7","tgl_masuk":"2024-09-16","kode":"010001198","item":"FCC 820L High Pressure Cleaner ","item_link":"Tes. Com","jml":10,"jml_satuan":1,"satuan":"UNIT","harga":2875000,"harga_dpp":25900900.9009009,"harga_ppn":2849099.099099099,"harga_pph":388513.5135135135,"subtotal":28750000,"profit":16512387.387387387,"harga_hpp":900000,"harga_hpp_ppn":891891.891891892,"harga_hpp_tot":9000000,"keterangan":"Tes","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-16 06:27:24","tgl_modif":"2024-09-16 06:27:24"}', 1),
	(49, 4, 2, '2024-09-16 06:27:24', '2024-09-16 06:27:24', '{"jml_total":25900900.9,"ppn":1.11,"jml_ppn":2849099.1,"pph":1.5,"jml_pph":388513.51,"jml_gtotal":28750000,"jml_biaya":0,"jml_hpp":9000000,"jml_hpp_ppn":891891.89,"jml_profit":17404279.279999997,"tgl_modif":"2024-09-16 06:27:24"}', 2),
	(50, 4, 2, '2024-09-16 06:28:17', '2024-09-16 06:28:17', '{"id_rab":"4","id_user":"2","id_item":"4","id_item_kat":"200","id_satuan":"7","tgl_masuk":"2024-09-16","kode":"000004165","item":"KURSI LABORATORIUM BESI + KAYU JATI","item_link":"Tes. Com","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":517500,"harga_dpp":2331081.0810810807,"harga_ppn":256418.91891891893,"harga_pph":34966.21621621621,"subtotal":2587500,"profit":296114.86486486485,"harga_hpp":400000,"harga_hpp_ppn":0,"harga_hpp_tot":2000000,"keterangan":"Tes","status":1,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-16 06:28:17","tgl_modif":"2024-09-16 06:28:17"}', 1),
	(51, 4, 2, '2024-09-16 06:28:17', '2024-09-16 06:28:17', '{"jml_total":28231981.98,"ppn":1.11,"jml_ppn":3105518.02,"pph":1.5,"jml_pph":423479.73,"jml_gtotal":31337500,"jml_biaya":0,"jml_hpp":11000000,"jml_hpp_ppn":891891.89,"jml_profit":17700394.14,"tgl_modif":"2024-09-16 06:28:17"}', 2),
	(52, 4, 2, '2024-09-16 06:28:45', '2024-09-16 06:28:45', '{"id_rab":"4","id_user":"2","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-16","kode":"","item":"Ongkir","item_link":null,"jml":1,"jml_satuan":1,"satuan":"","harga":200000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":200000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"Tes","status":2,"status_ppn":0,"status_biaya":1,"tgl_simpan":"2024-09-16 06:28:45","tgl_modif":"2024-09-16 06:28:45"}', 1),
	(53, 4, 2, '2024-09-16 06:28:45', '2024-09-16 06:28:45', '{"jml_total":28412162.16216216,"ppn":1.11,"jml_ppn":3125337.8378378376,"pph":1.5,"jml_pph":426182.43243243237,"jml_gtotal":31337500,"jml_biaya":200000,"jml_hpp":11000000,"jml_hpp_ppn":891891.89,"jml_profit":17877871.619729728,"tgl_modif":"2024-09-16 06:28:45"}', 2),
	(54, 4, 2, '2024-09-16 06:28:59', '2024-09-16 06:28:59', '{"status":"1","tgl_modif":"2024-09-16 06:28:59"}', 2),
	(55, 4, 2, '2024-09-16 06:29:09', '2024-09-16 06:29:09', '{"status":"2","tgl_modif":"2024-09-16 06:29:09"}', 2),
	(56, 4, 2, '2024-09-16 06:29:13', '2024-09-16 06:29:13', '{"status":"4","tgl_modif":"2024-09-16 06:29:13"}', 2),
	(57, 4, 2, '2024-09-16 06:29:46', '2024-09-16 06:29:46', '{"jml_po":5,"tgl_modif":"2024-09-16 06:29:46"}', 2),
	(58, 4, 2, '2024-09-16 06:30:28', '2024-09-16 06:30:28', '{"jml_po":10,"tgl_modif":"2024-09-16 06:30:28"}', 2),
	(59, 4, 2, '2024-09-16 06:30:55', '2024-09-16 06:30:55', '{"jml_po":2,"tgl_modif":"2024-09-16 06:30:55"}', 2),
	(60, 4, 2, '2024-09-16 06:31:17', '2024-09-16 06:31:17', '{"jml_po":5,"tgl_modif":"2024-09-16 06:31:17"}', 2),
	(61, 4, 2, '2024-09-16 06:31:25', '2024-09-16 06:31:25', '{"status":"6","tgl_modif":"2024-09-16 06:31:25"}', 2),
	(62, 5, 14, '2024-09-20 14:09:47', '2024-09-20 14:09:47', '{"id_user":"14","id_pelanggan":"12","id_sales":"12","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-20","no_rab":"RAB\\/005-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"8","status":"0","status_ppn":null,"tgl_simpan":"2024-09-20 14:09:47","tgl_modif":"2024-09-20 14:09:47"}', 1),
	(63, 5, 14, '2024-09-20 14:10:01', '2024-09-20 14:10:01', '{"id_rab":"5","id_user":"14","id_item":"1","id_item_kat":"198","id_satuan":"7","tgl_masuk":"2024-09-20","kode":"010001198","item":"FCC 820L High Pressure Cleaner ","item_link":"","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":2875000,"harga_dpp":12950450.45045045,"harga_ppn":1424549.5495495496,"harga_pph":194256.75675675675,"subtotal":14375000,"profit":8256193.693693694,"harga_hpp":900000,"harga_hpp_ppn":445945.945945946,"harga_hpp_tot":4500000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-20 14:10:01","tgl_modif":"2024-09-20 14:10:01"}', 1),
	(64, 5, 14, '2024-09-20 14:10:01', '2024-09-20 14:10:01', '{"jml_total":12950450.45,"ppn":1.11,"jml_ppn":1424549.55,"pph":1.5,"jml_pph":194256.76,"jml_gtotal":14375000,"jml_biaya":0,"jml_hpp":4500000,"jml_hpp_ppn":445945.95,"jml_profit":8702139.639999999,"tgl_modif":"2024-09-20 14:10:01"}', 2),
	(65, 5, 14, '2024-09-20 14:10:20', '2024-09-20 14:10:20', '{"id_rab":"5","id_user":"14","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-20","kode":"","item":"Ongkir","item_link":null,"jml":1,"jml_satuan":1,"satuan":"","harga":15000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":15000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"","status":2,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-20 14:10:20","tgl_modif":"2024-09-20 14:10:20"}', 1),
	(66, 5, 14, '2024-09-20 14:10:20', '2024-09-20 14:10:20', '{"jml_total":12950450.45,"ppn":1.11,"jml_ppn":1424549.55,"pph":1.5,"jml_pph":194256.76,"jml_gtotal":14375000,"jml_biaya":0,"jml_hpp":4500000,"jml_hpp_ppn":445945.95,"jml_profit":8687139.639999999,"tgl_modif":"2024-09-20 14:10:20"}', 2),
	(67, 5, 14, '2024-09-20 14:10:24', '2024-09-20 14:10:24', '{"status":"1","tgl_modif":"2024-09-20 14:10:24"}', 2),
	(68, 5, 14, '2024-09-20 14:10:31', '2024-09-20 14:10:31', '{"status":"2","tgl_modif":"2024-09-20 14:10:31"}', 2),
	(69, 5, 14, '2024-09-20 14:10:36', '2024-09-20 14:10:36', '{"status":"4","tgl_modif":"2024-09-20 14:10:36"}', 2),
	(70, 5, 14, '2024-09-20 14:11:07', '2024-09-20 14:11:07', '{"jml_po":5,"tgl_modif":"2024-09-20 14:11:07"}', 2),
	(71, 5, 14, '2024-09-20 14:11:16', '2024-09-20 14:11:16', '{"status":"6","tgl_modif":"2024-09-20 14:11:16"}', 2),
	(72, 6, 14, '2024-09-20 14:25:33', '2024-09-20 14:25:33', '{"id_user":"14","id_pelanggan":"10","id_sales":"19","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-20","no_rab":"RAB\\/006-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"8000000","status":"0","status_ppn":null,"tgl_simpan":"2024-09-20 14:25:33","tgl_modif":"2024-09-20 14:25:33"}', 1),
	(73, 6, 14, '2024-09-20 14:26:11', '2024-09-20 14:26:11', '{"id_rab":"6","id_user":"14","id_item":"22","id_item_kat":"163","id_satuan":"7","tgl_masuk":"2024-09-20","kode":"100007163","item":"Travelmate P214 Core i3 (TMP214\\/0037)","item_link":"","jml":6,"jml_satuan":1,"satuan":"UNIT","harga":15000000,"harga_dpp":81081081.08108108,"harga_ppn":8918918.918918919,"harga_pph":1216216.216216216,"subtotal":90000000,"profit":23350864.864864856,"harga_hpp":9419000,"harga_hpp_ppn":5600486.486486486,"harga_hpp_tot":56514000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-20 14:26:11","tgl_modif":"2024-09-20 14:26:11"}', 1),
	(74, 6, 14, '2024-09-20 14:26:11', '2024-09-20 14:26:11', '{"jml_total":81081081.08,"ppn":1.11,"jml_ppn":8918918.92,"pph":1.5,"jml_pph":1216216.22,"jml_gtotal":90000000,"jml_biaya":0,"jml_hpp":56514000,"jml_hpp_ppn":5600486.49,"jml_profit":28951351.35,"tgl_modif":"2024-09-20 14:26:11"}', 2),
	(75, 6, 14, '2024-09-20 14:26:17', '2024-09-20 14:26:17', '{"status":"1","tgl_modif":"2024-09-20 14:26:17"}', 2),
	(76, 6, 14, '2024-09-20 14:26:22', '2024-09-20 14:26:22', '{"status":"2","tgl_modif":"2024-09-20 14:26:22"}', 2),
	(77, 6, 14, '2024-09-20 14:26:27', '2024-09-20 14:26:27', '{"status":"4","tgl_modif":"2024-09-20 14:26:27"}', 2),
	(78, 6, 14, '2024-09-20 14:26:33', '2024-09-20 14:26:33', '{"status":"6","tgl_modif":"2024-09-20 14:26:33"}', 2),
	(79, 6, 14, '2024-09-20 14:28:01', '2024-09-20 14:28:01', '{"status":"4","tgl_modif":"2024-09-20 14:28:01"}', 2),
	(80, 6, 14, '2024-09-20 14:29:00', '2024-09-20 14:29:00', '{"jml_po":2,"tgl_modif":"2024-09-20 14:29:00"}', 2),
	(81, 6, 14, '2024-09-20 14:29:11', '2024-09-20 14:29:11', '{"jml_po":4,"tgl_modif":"2024-09-20 14:29:11"}', 2),
	(82, 6, 14, '2024-09-20 14:29:28', '2024-09-20 14:29:28', '{"jml_po":6,"tgl_modif":"2024-09-20 14:29:28"}', 2),
	(83, 6, 14, '2024-09-20 14:29:41', '2024-09-20 14:29:41', '{"status":"6","tgl_modif":"2024-09-20 14:29:41"}', 2),
	(84, 7, 13, '2024-09-21 10:38:44', '2024-09-21 10:38:44', '{"id_user":"13","id_pelanggan":"15","id_sales":"13","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-03","no_rab":"RAB\\/007-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"49400000","status":"0","status_ppn":null,"tgl_simpan":"2024-09-21 10:38:44","tgl_modif":"2024-09-21 10:38:44"}', 1),
	(85, 7, 13, '2024-09-21 10:45:27', '2024-09-21 10:45:27', '{"id_rab":"7","id_user":"13","id_item":"25","id_item_kat":"11","id_satuan":"7","tgl_masuk":"2024-09-03","kode":"12000911","item":"Polytron AC 2 PK Deluxe PAC 18VH indor","item_link":"https:\\/\\/e-katalog.lkpp.go.id\\/katalog\\/produk\\/detail\\/77214536?type=general","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":7800000,"harga_dpp":35135135.13513513,"harga_ppn":3864864.864864865,"harga_pph":527027.0270270269,"subtotal":39000000,"profit":7233108.108108111,"harga_hpp":5475000,"harga_hpp_ppn":0,"harga_hpp_tot":27375000,"keterangan":"Inc Pemasangan Standart","status":1,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-21 10:45:27","tgl_modif":"2024-09-21 10:45:27"}', 1),
	(86, 7, 13, '2024-09-21 10:45:27', '2024-09-21 10:45:27', '{"jml_total":35135135.14,"ppn":1.11,"jml_ppn":3864864.86,"pph":1.5,"jml_pph":527027.03,"jml_gtotal":39000000,"jml_biaya":0,"jml_hpp":27375000,"jml_hpp_ppn":0,"jml_profit":7233108.109999999,"tgl_modif":"2024-09-21 10:45:27"}', 2),
	(87, 7, 13, '2024-09-21 10:47:46', '2024-09-21 10:47:46', '{"id_rab":"7","id_user":"13","id_item":"25","id_item_kat":"11","id_satuan":"7","tgl_masuk":"2024-09-03","kode":"12000911","item":"Polytron AC 2 PK Deluxe PAC 18VH indor","item_link":"https:\\/\\/e-katalog.lkpp.go.id\\/katalog\\/produk\\/detail\\/77214536?type=general","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":7600000,"harga_dpp":34234234.23423423,"harga_ppn":3765765.7657657657,"harga_pph":513513.51351351343,"subtotal":38000000,"profit":6345720.720720723,"harga_hpp":5475000,"harga_hpp_ppn":0,"harga_hpp_tot":27375000,"keterangan":"Inc Pemasangan Standart","status":1,"status_ppn":0,"status_biaya":0,"tgl_modif":"2024-09-21 10:47:46"}', 2),
	(88, 7, 13, '2024-09-21 10:47:46', '2024-09-21 10:47:46', '{"jml_total":34234234.23,"ppn":1.11,"jml_ppn":3765765.77,"pph":1.5,"jml_pph":513513.51,"jml_gtotal":38000000,"jml_biaya":0,"jml_hpp":27375000,"jml_hpp_ppn":0,"jml_profit":6345720.719999999,"tgl_modif":"2024-09-21 10:47:46"}', 2),
	(89, 7, 13, '2024-09-21 10:47:59', '2024-09-21 10:47:59', '{"id_rab":"7","id_user":"13","id_item":"25","id_item_kat":"11","id_satuan":"7","tgl_masuk":"2024-09-03","kode":"12000911","item":"Polytron AC 2 PK Deluxe PAC 18VH indor","item_link":"https:\\/\\/e-katalog.lkpp.go.id\\/katalog\\/produk\\/detail\\/77214536?type=general","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":7600000,"harga_dpp":34234234.23423423,"harga_ppn":3765765.7657657657,"harga_pph":513513.51351351343,"subtotal":38000000,"profit":6345720.720720723,"harga_hpp":5475000,"harga_hpp_ppn":2712837.8378378376,"harga_hpp_tot":27375000,"keterangan":"Inc Pemasangan Standart","status":1,"status_ppn":"1","status_biaya":0,"tgl_modif":"2024-09-21 10:47:59"}', 2),
	(90, 7, 13, '2024-09-21 10:47:59', '2024-09-21 10:47:59', '{"jml_total":34234234.23,"ppn":1.11,"jml_ppn":3765765.77,"pph":1.5,"jml_pph":513513.51,"jml_gtotal":38000000,"jml_biaya":0,"jml_hpp":27375000,"jml_hpp_ppn":2712837.84,"jml_profit":9058558.559999999,"tgl_modif":"2024-09-21 10:47:59"}', 2),
	(91, 7, 13, '2024-09-21 10:49:10', '2024-09-21 10:49:10', '{"id_rab":"7","id_user":"13","id_item":"25","id_item_kat":"11","id_satuan":"7","tgl_masuk":"2024-09-03","kode":"12000911","item":"Polytron AC 2 PK Deluxe PAC 18VH indor","item_link":"https:\\/\\/e-katalog.lkpp.go.id\\/katalog\\/produk\\/detail\\/77214536?type=general","jml":5,"jml_satuan":1,"satuan":"UNIT","harga":7600000,"harga_dpp":34234234.23423423,"harga_ppn":3765765.7657657657,"harga_pph":513513.51351351343,"subtotal":38000000,"profit":6345720.720720723,"harga_hpp":5475000,"harga_hpp_ppn":2712837.8378378376,"harga_hpp_tot":27375000,"keterangan":"Inc Pemasangan Standart","status":1,"status_ppn":"1","status_biaya":0,"tgl_modif":"2024-09-21 10:49:10"}', 2),
	(92, 7, 13, '2024-09-21 10:49:10', '2024-09-21 10:49:10', '{"jml_total":34234234.23,"ppn":1.11,"jml_ppn":3765765.77,"pph":1.5,"jml_pph":513513.51,"jml_gtotal":38000000,"jml_biaya":0,"jml_hpp":27375000,"jml_hpp_ppn":2712837.84,"jml_profit":9058558.559999999,"tgl_modif":"2024-09-21 10:49:10"}', 2),
	(93, 7, 13, '2024-09-21 10:49:16', '2024-09-21 10:49:16', '{"status":"1","tgl_modif":"2024-09-21 10:49:16"}', 2),
	(94, 7, 13, '2024-09-21 10:50:15', '2024-09-21 10:50:15', '{"status":"0","tgl_modif":"2024-09-21 10:50:15"}', 2),
	(95, 7, 13, '2024-09-21 10:51:09', '2024-09-21 10:51:09', '{"id_rab":"7","id_user":"13","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-03","kode":"","item":"Instalasi","item_link":null,"jml":5,"jml_satuan":1,"satuan":"","harga":4000000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":20000000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"Instalasi AC Split 2pk ","status":2,"status_ppn":0,"status_biaya":1,"tgl_simpan":"2024-09-21 10:51:09","tgl_modif":"2024-09-21 10:51:09"}', 1),
	(96, 7, 13, '2024-09-21 10:51:09', '2024-09-21 10:51:09', '{"jml_total":52252252.25225225,"ppn":1.11,"jml_ppn":5747747.747747748,"pph":1.5,"jml_pph":783783.7837837838,"jml_gtotal":38000000,"jml_biaya":20000000,"jml_hpp":27375000,"jml_hpp_ppn":2712837.84,"jml_profit":26806306.308468465,"tgl_modif":"2024-09-21 10:51:09"}', 2),
	(97, 7, 13, '2024-09-21 10:52:08', '2024-09-21 10:52:08', '{"id_rab":"7","id_user":"13","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-03","kode":"","item":"Instalasi","item_link":null,"jml":5,"jml_satuan":1,"satuan":"","harga":800000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":4000000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"Instalasi AC Split 2pk ","status":2,"status_ppn":0,"status_biaya":1,"tgl_modif":"2024-09-21 10:52:08"}', 2),
	(98, 7, 13, '2024-09-21 10:52:08', '2024-09-21 10:52:08', '{"jml_total":37837837.83783784,"ppn":1.11,"jml_ppn":4162162.1621621624,"pph":1.5,"jml_pph":567567.5675675676,"jml_gtotal":38000000,"jml_biaya":4000000,"jml_hpp":27375000,"jml_hpp_ppn":2712837.84,"jml_profit":12608108.110270273,"tgl_modif":"2024-09-21 10:52:08"}', 2),
	(99, 7, 13, '2024-09-21 10:52:38', '2024-09-21 10:52:38', '{"status":"1","tgl_modif":"2024-09-21 10:52:38"}', 2),
	(100, 7, 13, '2024-09-21 10:55:26', '2024-09-21 10:55:26', '{"status":"0","tgl_modif":"2024-09-21 10:55:26"}', 2),
	(101, 7, 13, '2024-09-21 10:55:40', '2024-09-21 10:55:40', '{"id_rab":"7","id_user":"13","id_item":0,"id_item_kat":0,"id_satuan":0,"tgl_masuk":"2024-09-03","kode":"","item":"Instalasi","item_link":null,"jml":5,"jml_satuan":1,"satuan":"","harga":800000,"harga_dpp":0,"harga_ppn":0,"harga_pph":0,"subtotal":4000000,"profit":0,"harga_hpp":0,"harga_hpp_ppn":0,"harga_hpp_tot":0,"keterangan":"Instalasi AC Split 2pk ","status":2,"status_ppn":0,"status_biaya":0,"tgl_modif":"2024-09-21 10:55:40"}', 2),
	(102, 7, 13, '2024-09-21 10:55:40', '2024-09-21 10:55:40', '{"jml_total":34234234.23,"ppn":1.11,"jml_ppn":3765765.77,"pph":1.5,"jml_pph":513513.51,"jml_gtotal":38000000,"jml_biaya":0,"jml_hpp":27375000,"jml_hpp_ppn":2712837.84,"jml_profit":5058558.559999999,"tgl_modif":"2024-09-21 10:55:40"}', 2),
	(103, 7, 13, '2024-09-21 10:56:02', '2024-09-21 10:56:02', '{"status":"1","tgl_modif":"2024-09-21 10:56:02"}', 2),
	(104, 7, 2, '2024-09-21 10:56:18', '2024-09-21 10:56:18', '{"status":"1","tgl_modif":"2024-09-21 10:56:18"}', 2),
	(105, 7, 2, '2024-09-21 10:57:13', '2024-09-21 10:57:13', '{"status":"2","tgl_modif":"2024-09-21 10:57:13"}', 2),
	(106, 7, 13, '2024-09-21 10:58:27', '2024-09-21 10:58:27', '{"status":"4","tgl_modif":"2024-09-21 10:58:27"}', 2),
	(107, 7, 2, '2024-09-21 11:02:52', '2024-09-21 11:02:52', '{"jml_po":5,"tgl_modif":"2024-09-21 11:02:52"}', 2),
	(108, 8, 2, '2024-09-24 14:13:55', '2024-09-24 14:13:55', '{"id_user":"2","id_pelanggan":"1","id_sales":"12","id_perusahaan":"2","id_tipe":"1","tgl_masuk":"2024-09-24","no_rab":"RAB\\/008-ARS\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"","status":"0","status_ppn":null,"tgl_simpan":"2024-09-24 14:13:55","tgl_modif":"2024-09-24 14:13:55"}', 1),
	(109, 8, 2, '2024-09-24 14:17:01', '2024-09-24 14:17:01', '{"id_rab":"8","id_user":"2","id_item":"1","id_item_kat":"1","id_satuan":"1","tgl_masuk":"2024-09-24","kode":"1234567","item":"TESTING ITEM BARU","item_link":"","jml":1,"jml_satuan":1,"satuan":"PCS","harga":6000000,"harga_dpp":5405405.405405405,"harga_ppn":594594.5945945946,"harga_pph":81081.08108108107,"subtotal":6000000,"profit":324324.3243243247,"harga_hpp":5000000,"harga_hpp_ppn":0,"harga_hpp_tot":5000000,"keterangan":"-","status":1,"status_ppn":0,"status_biaya":0,"tgl_simpan":"2024-09-24 14:17:01","tgl_modif":"2024-09-24 14:17:01"}', 1),
	(110, 8, 2, '2024-09-24 14:17:01', '2024-09-24 14:17:01', '{"jml_total":5405405.41,"ppn":1.11,"jml_ppn":594594.59,"pph":1.5,"jml_pph":81081.08,"jml_gtotal":6000000,"jml_biaya":0,"jml_hpp":5000000,"jml_hpp_ppn":0,"jml_profit":324324.3300000001,"tgl_modif":"2024-09-24 14:17:01"}', 2),
	(111, 8, 2, '2024-09-24 14:17:10', '2024-09-24 14:17:10', '{"status":"1","tgl_modif":"2024-09-24 14:17:10"}', 2),
	(112, 8, 2, '2024-09-24 14:17:42', '2024-09-24 14:17:42', '{"status":"0","tgl_modif":"2024-09-24 14:17:42"}', 2),
	(113, 8, 2, '2024-09-24 14:18:11', '2024-09-24 14:18:11', '{"status":"1","tgl_modif":"2024-09-24 14:18:11"}', 2),
	(114, 8, 2, '2024-09-24 14:18:38', '2024-09-24 14:18:38', '{"status":"0","tgl_modif":"2024-09-24 14:18:38"}', 2),
	(115, 8, 2, '2024-09-24 14:18:57', '2024-09-24 14:18:57', '{"status":"1","tgl_modif":"2024-09-24 14:18:57"}', 2),
	(116, 8, 2, '2024-09-24 14:19:19', '2024-09-24 14:19:19', '{"status":"2","tgl_modif":"2024-09-24 14:19:19"}', 2),
	(117, 8, 2, '2024-09-24 14:19:46', '2024-09-24 14:19:46', '{"status":"4","tgl_modif":"2024-09-24 14:19:46"}', 2),
	(118, 8, 2, '2024-09-24 14:21:00', '2024-09-24 14:21:00', '{"jml_po":1,"tgl_modif":"2024-09-24 14:21:00"}', 2),
	(119, 8, 2, '2024-09-24 14:21:52', '2024-09-24 14:21:52', '{"status":"6","tgl_modif":"2024-09-24 14:21:52"}', 2),
	(120, 9, 2, '2024-09-24 14:44:56', '2024-09-24 14:44:56', '{"id_user":"2","id_pelanggan":"1","id_sales":"19","id_perusahaan":"8","id_tipe":"1","tgl_masuk":"2024-09-24","no_rab":"RAB\\/009-MST\\/IX\\/2024","no_kontrak":null,"no_paket":null,"jml_hps":"","jml_pagu":"","status":"0","status_ppn":null,"tgl_simpan":"2024-09-24 14:44:56","tgl_modif":"2024-09-24 14:44:56"}', 1),
	(121, 9, 2, '2024-09-24 21:27:15', '2024-09-24 21:27:15', '{"id_rab":"9","id_user":"2","id_item":"1","id_item_kat":"1","id_satuan":"1","tgl_masuk":"2024-09-24","kode":"1234567","item":"TESTING ITEM BARU","item_link":"","jml":1,"jml_satuan":1,"satuan":"PCS","harga":6000000,"harga_dpp":5405405.405405405,"harga_ppn":594594.5945945946,"harga_pph":81081.08108108107,"subtotal":6000000,"profit":324324.3243243247,"harga_hpp":5000000,"harga_hpp_ppn":495495.4954954955,"harga_hpp_tot":5000000,"keterangan":"","status":1,"status_ppn":"1","status_biaya":0,"tgl_simpan":"2024-09-24 21:27:15","tgl_modif":"2024-09-24 21:27:15"}', 1),
	(122, 9, 2, '2024-09-24 21:27:15', '2024-09-24 21:27:15', '{"jml_total":5405405.41,"ppn":1.11,"jml_ppn":594594.59,"pph":1.5,"jml_pph":81081.08,"jml_gtotal":6000000,"jml_biaya":0,"jml_hpp":5000000,"jml_hpp_ppn":495495.5,"jml_profit":819819.8300000001,"tgl_modif":"2024-09-24 21:27:15"}', 2);
/*!40000 ALTER TABLE `tbl_trans_rab_log` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_rab_pen
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Untuk menyimpan penawaran';

-- Dumping data for table mikhaelf_db_ars.tbl_trans_rab_pen: ~7 rows (approximately)
DELETE FROM `tbl_trans_rab_pen`;
/*!40000 ALTER TABLE `tbl_trans_rab_pen` DISABLE KEYS */;
INSERT INTO `tbl_trans_rab_pen` (`id`, `id_rab`, `id_user`, `id_perusahaan`, `tgl_simpan`, `tgl_modif`, `no_surat`, `status`) VALUES
	(1, 1, 2, 2, '2024-08-26 16:00:00', '2024-08-26 16:00:00', 'BQ/001-ARS/VIII/2024', 0),
	(2, 2, 2, 2, '2024-09-09 14:21:56', '2024-09-09 14:21:56', 'BQ/002-ARS/IX/2024', 0),
	(3, 3, 2, 2, '2024-09-10 09:47:06', '2024-09-10 09:47:06', 'BQ/003-ARS/IX/2024', 0),
	(4, 4, 2, 2, '2024-09-16 06:29:09', '2024-09-16 06:29:09', 'BQ/004-ARS/IX/2024', 0),
	(5, 5, 14, 2, '2024-09-20 14:10:31', '2024-09-20 14:10:31', 'BQ/005-ARS/IX/2024', 0),
	(6, 6, 14, 2, '2024-09-20 14:26:22', '2024-09-20 14:26:22', 'BQ/006-ARS/IX/2024', 0),
	(7, 7, 2, 2, '2024-09-21 10:57:13', '2024-09-21 10:57:13', 'BQ/007-ARS/IX/2024', 0),
	(8, 8, 2, 2, '2024-09-24 14:19:19', '2024-09-24 14:19:19', 'BQ/008-ARS/IX/2024', 0);
/*!40000 ALTER TABLE `tbl_trans_rab_pen` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_retur_beli
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_retur_beli: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_beli`;
/*!40000 ALTER TABLE `tbl_trans_retur_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_retur_beli` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_retur_beli_det
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_retur_beli_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_beli_det`;
/*!40000 ALTER TABLE `tbl_trans_retur_beli_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_retur_beli_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_retur_jual
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

-- Dumping data for table mikhaelf_db_ars.tbl_trans_retur_jual: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_jual`;
/*!40000 ALTER TABLE `tbl_trans_retur_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_retur_jual` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_trans_retur_jual_det
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_trans_retur_jual_det: ~0 rows (approximately)
DELETE FROM `tbl_trans_retur_jual_det`;
/*!40000 ALTER TABLE `tbl_trans_retur_jual_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trans_retur_jual_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_backup
DROP TABLE IF EXISTS `tbl_util_backup`;
CREATE TABLE IF NOT EXISTS `tbl_util_backup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tgl` timestamp NULL DEFAULT NULL,
  `name` varchar(160) NOT NULL,
  `file_name` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_util_backup: ~0 rows (approximately)
DELETE FROM `tbl_util_backup`;
/*!40000 ALTER TABLE `tbl_util_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_backup` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_eksport
DROP TABLE IF EXISTS `tbl_util_eksport`;
CREATE TABLE IF NOT EXISTS `tbl_util_eksport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_util_eksport: ~0 rows (approximately)
DELETE FROM `tbl_util_eksport`;
/*!40000 ALTER TABLE `tbl_util_eksport` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_eksport` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_import
DROP TABLE IF EXISTS `tbl_util_import`;
CREATE TABLE IF NOT EXISTS `tbl_util_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_util_import: ~0 rows (approximately)
DELETE FROM `tbl_util_import`;
/*!40000 ALTER TABLE `tbl_util_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_import` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_log
DROP TABLE IF EXISTS `tbl_util_log`;
CREATE TABLE IF NOT EXISTS `tbl_util_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_simpan` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_util_log: ~0 rows (approximately)
DELETE FROM `tbl_util_log`;
/*!40000 ALTER TABLE `tbl_util_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_log` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_so
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

-- Dumping data for table mikhaelf_db_ars.tbl_util_so: ~0 rows (approximately)
DELETE FROM `tbl_util_so`;
/*!40000 ALTER TABLE `tbl_util_so` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_so` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.tbl_util_so_det
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table mikhaelf_db_ars.tbl_util_so_det: ~0 rows (approximately)
DELETE FROM `tbl_util_so_det`;
/*!40000 ALTER TABLE `tbl_util_so_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_util_so_det` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','operator','operator_gedung') NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mikhaelf_db_ars.users: ~6 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin redha', 'admin', 'admin@gmail.com', '$2y$12$9Ivv26Fq4kNKhXdsVJGoLuWj4gsOsQDuct9.kaXh5Wu46HImuWkXO', 'superadmin', 'Y', NULL, NULL, '2024-07-23 14:05:04', '2024-07-24 12:18:48', NULL),
	(2, 'yuda1', 'redha', 'redha@gmail.com', '$2y$12$WMwDAchryheH.TZ10f1BU.aLofrPeipXqpQGS6n.7UozK/0VRK5u.', 'operator_gedung', 'Y', NULL, NULL, '2024-07-23 14:05:18', '2024-07-27 03:18:10', NULL),
	(4, 'fafa', 'fafa', 'fafa@gmail.com', '$2y$12$yFmyNEw6ZHxl1J2WkVlT2ekvNorbkRnE38d.H3q6CqxrM4dKaXtZi', 'operator_gedung', 'Y', NULL, NULL, '2024-07-24 10:38:14', '2024-07-24 14:03:57', NULL),
	(5, 'reza', 'reza', 'reza@gmail.com', '$2y$12$duVzjuLBmnSqMZcu9bV3KOxGrSMZ/rINld0eFFbZOLaTQFWX1A01G', 'operator', 'Y', NULL, NULL, '2024-07-24 11:35:11', '2024-07-27 12:32:30', NULL),
	(10, 'yuda', 'yuda', 'yuda@gmail.com', '$2y$12$Urr.XN.eSx1uRbSFS8J4reTLacobjlaNBKxQWKPWx1rAwX5eeEFRC', 'operator_gedung', 'Y', NULL, NULL, '2024-07-27 03:02:31', '2024-07-27 03:02:46', NULL),
	(11, 'yuda', 'yudha', 'yudha@gmail.com', '$2y$12$WcbCUipg5k007tyJ/vD.Y.LUUHTppwasgrqrK63tuAkIrl8.ESR6q', 'superadmin', 'Y', NULL, NULL, '2024-07-27 03:38:11', '2024-07-27 03:38:11', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table mikhaelf_db_ars.user_buildings
DROP TABLE IF EXISTS `user_buildings`;
CREATE TABLE IF NOT EXISTS `user_buildings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `building_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_buildings_user_id_foreign` (`user_id`),
  KEY `user_buildings_building_id_foreign` (`building_id`),
  CONSTRAINT `user_buildings_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_buildings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mikhaelf_db_ars.user_buildings: ~3 rows (approximately)
DELETE FROM `user_buildings`;
/*!40000 ALTER TABLE `user_buildings` DISABLE KEYS */;
INSERT INTO `user_buildings` (`id`, `user_id`, `building_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(7, 4, 1, '2024-07-24 10:39:45', '2024-07-24 10:41:09', NULL),
	(11, 10, 15, '2024-07-27 03:02:31', '2024-07-27 03:02:31', NULL),
	(12, 2, 7, '2024-07-27 03:03:22', '2024-07-27 03:03:22', NULL);
/*!40000 ALTER TABLE `user_buildings` ENABLE KEYS */;

-- Dumping structure for view mikhaelf_db_ars.v_item
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
	`kode` VARCHAR(65) NULL COLLATE 'utf8mb3_general_ci',
	`kategori` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`merk` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`item` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci',
	`item2` VARCHAR(321) NULL COLLATE 'utf8mb3_general_ci',
	`jml` DECIMAL(10,2) NULL,
	`harga_beli` DECIMAL(10,2) NULL,
	`harga_jual` DECIMAL(10,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`status_stok` ENUM('0','1') NULL COLLATE 'utf8mb3_general_ci',
	`status` ENUM('0','1') NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_item_hist
DROP VIEW IF EXISTS `v_item_hist`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_item_hist` (
	`id` INT(11) NOT NULL,
	`id_item` INT(11) NOT NULL,
	`id_gudang` INT(11) NULL,
	`tgl_simpan` DATETIME NULL,
	`tgl_modif` DATETIME NULL,
	`tgl_masuk` DATETIME NULL,
	`username` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`gudang` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`kode` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`item` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`jml` INT(11) NULL,
	`jml_satuan` INT(11) NULL,
	`satuan` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`nominal` DECIMAL(10,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`status` ENUM('0','1','2','3','4','5','6','7','8') NULL COMMENT '1 = Stok Masuk Pembelian\\\\\\\\r\\\\\\\\n2 = Stok Masuk\\\\\\\\r\\\\\\\\n3 = Stok Masuk Retur Jual\\\\\\\\r\\\\\\\\n4 = Stok Keluar Penjualan\\\\\\\\r\\\\\\\\n5 = Stok Keluar Retur Beli\\\\\\\\r\\\\\\\\n6 = SO\\\\\\\\r\\\\\\\\n7 = Stok Keluar\\\\\\\\r\\\\\\\\n8 = Mutasi Antar Gd' COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_item_stok
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
	`gudang` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`jml` FLOAT NULL,
	`jml_satuan` FLOAT NULL,
	`satuan` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci',
	`status` ENUM('0','1','2') NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_beli
DROP VIEW IF EXISTS `v_trans_beli`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_beli` (
	`id` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`id_supplier` INT(11) NOT NULL,
	`id_po` INT(11) NULL,
	`id_penerima` INT(11) NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_masuk` DATE NULL,
	`tgl_keluar` DATE NULL,
	`username` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`c_nama` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_no_telp` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`c_no_fax` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`c_logo` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`kode` VARCHAR(10) NULL COLLATE 'utf8mb3_general_ci',
	`npwp` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`supplier` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`no_telp` VARCHAR(20) NULL COLLATE 'utf8mb3_general_ci',
	`cp` VARCHAR(20) NULL COLLATE 'utf8mb3_general_ci',
	`no_po` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci',
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
	`metode_bayar` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_jual
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
	`tipe` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`sales` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`c_nama` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`p_nama` VARCHAR(360) NULL COLLATE 'utf8mb3_unicode_ci',
	`p_alamat` TEXT NULL COLLATE 'utf8mb3_unicode_ci',
	`no_rab` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`no_nota` VARCHAR(50) NULL COLLATE 'utf8mb3_general_ci',
	`no_kontrak` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci',
	`no_paket` VARCHAR(160) NULL COLLATE 'utf8mb3_general_ci',
	`jml_total` DECIMAL(32,2) NULL,
	`jml_ppn` DECIMAL(32,2) NULL,
	`ppn` INT(11) NULL,
	`jml_gtotal` DECIMAL(32,2) NULL,
	`keterangan` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`status` ENUM('0','1','2','3','4') NULL COMMENT '\r\n1=pos\r\n2=rajal\r\n3=ranap' COLLATE 'utf8mb3_general_ci',
	`status_nota` INT(11) NULL COMMENT '1=anamnesa\\\\r\\\\n2=pemeriksaan\\\\r\\\\n3=tindakan\\\\r\\\\n4=obat\\\\r\\\\n5=dokter\\\\r\\\\n6=pembayaran\\\\r\\\\n7=finish',
	`status_ppn` ENUM('0','1') NULL COLLATE 'utf8mb3_general_ci',
	`status_bayar` ENUM('0','1','2') NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_mutasi
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
	`user` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`no_mutasi` VARCHAR(50) NOT NULL COLLATE 'utf8mb3_general_ci',
	`c_nama` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`sales` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`no_nota` VARCHAR(50) NULL COLLATE 'utf8mb3_general_ci',
	`p_nama` VARCHAR(360) NULL COLLATE 'utf8mb3_unicode_ci',
	`gd_asal` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`keterangan` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`tipe` ENUM('0','1','2','3','4') NULL COMMENT '1 = Pindah Gudang\\r\\n2 = Stok Masuk\\r\\n3 = Stok Keluar\\r\\n4 = Pengiriman (dengan nota invoice)' COLLATE 'utf8mb3_general_ci',
	`status` ENUM('0','1','2','3','4') NULL COLLATE 'utf8mb3_general_ci',
	`status_terima` ENUM('0','1') NULL COLLATE 'utf8mb3_general_ci',
	`status_hps` ENUM('0','1') NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_pesanan
DROP VIEW IF EXISTS `v_trans_pesanan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_pesanan` (
	`id` INT(11) NOT NULL,
	`id_pelanggan` INT(11) NOT NULL,
	`id_sales` INT(11) NOT NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_masuk_pm` DATETIME NULL,
	`no_nota` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`pelanggan` TEXT NULL COLLATE 'utf8mb3_unicode_ci',
	`keterangan` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`sales` VARCHAR(100) NULL COLLATE 'latin1_general_ci',
	`status` INT(11) NULL COMMENT '0=baru\r\n1=proses\r\n2=rab'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_po
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
	`username` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`c_nama` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_no_telp` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`c_no_fax` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`c_kota` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`c_logo` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`kode` VARCHAR(10) NULL COLLATE 'utf8mb3_general_ci',
	`npwp` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`supplier` VARCHAR(100) NULL COLLATE 'utf8mb3_general_ci',
	`alamat` TEXT NULL COLLATE 'utf8mb3_general_ci',
	`no_telp` VARCHAR(20) NULL COLLATE 'utf8mb3_general_ci',
	`cp` VARCHAR(20) NULL COLLATE 'utf8mb3_general_ci',
	`no_po` VARCHAR(50) NULL COLLATE 'utf8mb3_general_ci',
	`keterangan` TEXT NULL COLLATE 'latin1_swedish_ci',
	`status_nota` INT(11) NULL COMMENT 'Untuk mencatat status nota, sudah proses atau belum',
	`status_fkt` INT(11) NULL COMMENT 'Untuk mencatat status faktur'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_trans_rab
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
	`username` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`sales` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`c_nama` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`c_alamat` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`p_nama` VARCHAR(360) NULL COLLATE 'utf8mb3_unicode_ci',
	`p_alamat` TEXT NULL COLLATE 'utf8mb3_unicode_ci',
	`tipe` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`no_rab` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`no_kontrak` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
	`no_paket` VARCHAR(160) NULL COLLATE 'latin1_swedish_ci',
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

-- Dumping structure for view mikhaelf_db_ars.v_trans_rab_log
DROP VIEW IF EXISTS `v_trans_rab_log`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_trans_rab_log` (
	`id` INT(11) NOT NULL,
	`id_rab` INT(11) NOT NULL,
	`id_user` INT(11) NOT NULL,
	`tgl_simpan` DATETIME NOT NULL,
	`tgl_modif` DATETIME NOT NULL,
	`user` VARCHAR(50) NULL COMMENT 'Untuk nama user' COLLATE 'utf8mb3_general_ci',
	`log` TEXT NULL COLLATE 'latin1_swedish_ci',
	`status` INT(11) NULL COMMENT '0=default;‧1=insert;‧2=update;‧3=soft_delete;‧4=delete;‧'
) ENGINE=MyISAM;

-- Dumping structure for view mikhaelf_db_ars.v_item
DROP VIEW IF EXISTS `v_item`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_item` AS select `tbl_m_item`.`id` AS `id`,`tbl_m_item`.`id_user` AS `id_user`,`tbl_m_item`.`id_kategori` AS `id_kategori`,`tbl_m_item`.`id_merk` AS `id_merk`,`tbl_m_item`.`id_satuan` AS `id_satuan`,`tbl_m_item`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item`.`tgl_modif` AS `tgl_modif`,`tbl_m_item`.`kode` AS `kode`,`tbl_m_kategori`.`kategori` AS `kategori`,`tbl_m_merk`.`merk` AS `merk`,`tbl_m_item`.`item` AS `item`,concat(`tbl_m_merk`.`merk`,' ',`tbl_m_item`.`item`) AS `item2`,`tbl_m_item`.`jml` AS `jml`,`tbl_m_item`.`harga_beli` AS `harga_beli`,`tbl_m_item`.`harga_jual` AS `harga_jual`,`tbl_m_item`.`keterangan` AS `keterangan`,`tbl_m_item`.`status_stok` AS `status_stok`,`tbl_m_item`.`status` AS `status` from (((`tbl_m_item` join `tbl_m_kategori` on(`tbl_m_item`.`id_kategori` = `tbl_m_kategori`.`id`)) left join `tbl_m_merk` on(`tbl_m_item`.`id_merk` = `tbl_m_merk`.`id`)) join `tbl_m_satuan` on(`tbl_m_item`.`id_satuan` = `tbl_m_satuan`.`id`)) order by `tbl_m_item`.`item`;

-- Dumping structure for view mikhaelf_db_ars.v_item_hist
DROP VIEW IF EXISTS `v_item_hist`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item_hist`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_item_hist` AS select `tbl_m_item_hist`.`id` AS `id`,`tbl_m_item_hist`.`id_item` AS `id_item`,`tbl_m_item_hist`.`id_gudang` AS `id_gudang`,`tbl_m_item_hist`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item_hist`.`tgl_modif` AS `tgl_modif`,`tbl_m_item_hist`.`tgl_masuk` AS `tgl_masuk`,`tbl_ion_users`.`username` AS `username`,`tbl_m_gudang`.`gudang` AS `gudang`,`tbl_m_item_hist`.`no_nota` AS `no_nota`,`tbl_m_item_hist`.`kode` AS `kode`,`tbl_m_item_hist`.`item` AS `item`,`tbl_m_item_hist`.`jml` AS `jml`,`tbl_m_item_hist`.`jml_satuan` AS `jml_satuan`,`tbl_m_item_hist`.`satuan` AS `satuan`,`tbl_m_item_hist`.`nominal` AS `nominal`,`tbl_m_item_hist`.`keterangan` AS `keterangan`,`tbl_m_item_hist`.`status` AS `status` from ((`tbl_m_item_hist` join `tbl_m_gudang` on(`tbl_m_item_hist`.`id_gudang` = `tbl_m_gudang`.`id`)) join `tbl_ion_users` on(`tbl_m_item_hist`.`id_user` = `tbl_ion_users`.`id`)) order by `tbl_m_item_hist`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_item_stok
DROP VIEW IF EXISTS `v_item_stok`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_item_stok`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_item_stok` AS select `tbl_m_item_stok`.`id` AS `id`,`tbl_m_item_stok`.`id_item` AS `id_item`,`tbl_m_item_stok`.`id_satuan` AS `id_satuan`,`tbl_m_item_stok`.`id_gudang` AS `id_gudang`,`tbl_m_item_stok`.`id_user` AS `id_user`,`tbl_m_item_stok`.`tgl_simpan` AS `tgl_simpan`,`tbl_m_item_stok`.`tgl_modif` AS `tgl_modif`,`tbl_m_gudang`.`gudang` AS `gudang`,`tbl_m_item_stok`.`jml` AS `jml`,`tbl_m_item_stok`.`jml_satuan` AS `jml_satuan`,`tbl_m_item_stok`.`satuan` AS `satuan`,`tbl_m_item_stok`.`status` AS `status` from (`tbl_m_item_stok` join `tbl_m_gudang` on(`tbl_m_item_stok`.`id_gudang` = `tbl_m_gudang`.`id`)) order by `tbl_m_item_stok`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_beli
DROP VIEW IF EXISTS `v_trans_beli`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_beli`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_beli` AS select `tbl_trans_beli`.`id` AS `id`,`tbl_trans_beli`.`id_user` AS `id_user`,`tbl_trans_beli`.`id_supplier` AS `id_supplier`,`tbl_trans_beli`.`id_po` AS `id_po`,`tbl_trans_beli`.`id_penerima` AS `id_penerima`,`tbl_trans_beli`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_beli`.`tgl_masuk` AS `tgl_masuk`,`tbl_trans_beli`.`tgl_keluar` AS `tgl_keluar`,`tbl_ion_users`.`username` AS `username`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`no_telp` AS `c_no_telp`,`tbl_pengaturan_profile`.`no_fax` AS `c_no_fax`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_pengaturan_profile`.`logo` AS `c_logo`,`tbl_m_supplier`.`kode` AS `kode`,`tbl_m_supplier`.`npwp` AS `npwp`,`tbl_m_supplier`.`nama` AS `supplier`,`tbl_m_supplier`.`alamat` AS `alamat`,`tbl_m_supplier`.`no_telp` AS `no_telp`,`tbl_m_supplier`.`cp` AS `cp`,`tbl_trans_beli`.`no_po` AS `no_po`,`tbl_trans_beli`.`no_nota` AS `no_nota`,`tbl_trans_beli`.`jml_total` AS `jml_total`,`tbl_trans_beli`.`disk1` AS `disk1`,`tbl_trans_beli`.`disk2` AS `disk2`,`tbl_trans_beli`.`disk3` AS `disk3`,`tbl_trans_beli`.`jml_potongan` AS `jml_potongan`,`tbl_trans_beli`.`jml_diskon` AS `jml_diskon`,`tbl_trans_beli`.`jml_biaya` AS `jml_biaya`,`tbl_trans_beli`.`jml_subtotal` AS `jml_subtotal`,`tbl_trans_beli`.`ppn` AS `ppn`,`tbl_trans_beli`.`jml_ppn` AS `jml_ppn`,`tbl_trans_beli`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_beli`.`jml_bayar` AS `jml_bayar`,`tbl_trans_beli`.`status` AS `status`,`tbl_trans_beli`.`status_ppn` AS `status_ppn`,`tbl_trans_beli`.`status_bayar` AS `status_bayar`,`tbl_trans_beli`.`status_penerimaan` AS `status_penerimaan`,`tbl_trans_beli`.`metode_bayar` AS `metode_bayar` from (((`tbl_trans_beli` join `tbl_m_supplier` on(`tbl_trans_beli`.`id_supplier` = `tbl_m_supplier`.`id`)) join `tbl_ion_users` on(`tbl_trans_beli`.`id_user` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_beli`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_beli`.`status_hps` = '0' order by `tbl_trans_beli`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_jual
DROP VIEW IF EXISTS `v_trans_jual`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_jual`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_jual` AS select `tbl_trans_jual`.`id` AS `id`,`tbl_trans_jual`.`id_user` AS `id_user`,`tbl_trans_jual`.`id_rab` AS `id_rab`,`tbl_trans_jual`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_jual`.`id_sales` AS `id_sales`,`tbl_trans_jual`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_jual`.`id_platform` AS `id_platform`,`tbl_trans_jual`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_jual`.`tgl_modif` AS `tgl_modif`,`tbl_trans_jual`.`tgl_masuk` AS `tgl_masuk`,`tbl_trans_jual`.`tgl_keluar` AS `tgl_keluar`,`tbl_trans_jual`.`tgl_bayar` AS `tgl_bayar`,`tbl_m_tipe`.`tipe` AS `tipe`,`tbl_ion_users`.`first_name` AS `sales`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_pelanggan`.`alamat` AS `p_alamat`,`tbl_trans_rab`.`no_rab` AS `no_rab`,`tbl_trans_jual`.`no_nota` AS `no_nota`,`tbl_trans_jual`.`no_kontrak` AS `no_kontrak`,`tbl_trans_jual`.`no_paket` AS `no_paket`,`tbl_trans_jual`.`jml_total` AS `jml_total`,`tbl_trans_jual`.`jml_ppn` AS `jml_ppn`,`tbl_trans_jual`.`ppn` AS `ppn`,`tbl_trans_jual`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_jual`.`keterangan` AS `keterangan`,`tbl_trans_jual`.`status` AS `status`,`tbl_trans_jual`.`status_nota` AS `status_nota`,`tbl_trans_jual`.`status_ppn` AS `status_ppn`,`tbl_trans_jual`.`status_bayar` AS `status_bayar` from (((((`tbl_trans_jual` left join `tbl_trans_rab` on(`tbl_trans_jual`.`id_rab` = `tbl_trans_rab`.`id`)) join `tbl_m_pelanggan` on(`tbl_trans_jual`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_m_tipe` on(`tbl_trans_jual`.`id_tipe` = `tbl_m_tipe`.`id`)) join `tbl_ion_users` on(`tbl_trans_jual`.`id_sales` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_jual`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_jual`.`status_hps` = '0' order by `tbl_trans_jual`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_mutasi
DROP VIEW IF EXISTS `v_trans_mutasi`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_mutasi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_mutasi` AS select `tbl_trans_mutasi`.`id` AS `id`,`tbl_trans_mutasi`.`id_user` AS `id_user`,`tbl_trans_mutasi`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_mutasi`.`id_penjualan` AS `id_penjualan`,`tbl_trans_mutasi`.`id_gd_asal` AS `id_gd_asal`,`tbl_trans_mutasi`.`id_gd_tujuan` AS `id_gd_tujuan`,`tbl_trans_mutasi`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_mutasi`.`tgl_masuk` AS `tgl_masuk`,`Users`.`first_name` AS `user`,`tbl_trans_mutasi`.`no_nota` AS `no_mutasi`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`Sales`.`first_name` AS `sales`,`tbl_trans_jual`.`no_nota` AS `no_nota`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_gudang`.`gudang` AS `gd_asal`,`tbl_trans_mutasi`.`keterangan` AS `keterangan`,`tbl_trans_mutasi`.`tipe` AS `tipe`,`tbl_trans_mutasi`.`status` AS `status`,`tbl_trans_mutasi`.`status_terima` AS `status_terima`,`tbl_trans_mutasi`.`status_hps` AS `status_hps` from ((((((`tbl_trans_mutasi` join `tbl_m_gudang` on(`tbl_trans_mutasi`.`id_gd_asal` = `tbl_m_gudang`.`id`)) left join `tbl_m_pelanggan` on(`tbl_trans_mutasi`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_ion_users` `Users` on(`tbl_trans_mutasi`.`id_user` = `Users`.`id`)) left join `tbl_ion_users` `Sales` on(`tbl_trans_mutasi`.`id_sales` = `Sales`.`id`)) left join `tbl_trans_jual` on(`tbl_trans_mutasi`.`id_penjualan` = `tbl_trans_jual`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_mutasi`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) order by `tbl_trans_mutasi`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_pesanan
DROP VIEW IF EXISTS `v_trans_pesanan`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_pesanan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_pesanan` AS select `tbl_trans_pesanan`.`id` AS `id`,`tbl_trans_pesanan`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_pesanan`.`id_sales` AS `id_sales`,`tbl_trans_pesanan`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_pesanan`.`tgl_masuk_pm` AS `tgl_masuk_pm`,`tbl_trans_pesanan`.`no_nota` AS `no_nota`,concat('[',`tbl_m_pelanggan`.`kode`,'] ',`tbl_m_pelanggan`.`nama`) AS `pelanggan`,`tbl_trans_pesanan`.`keterangan` AS `keterangan`,`tbl_m_karyawan`.`nama` AS `sales`,`tbl_trans_pesanan`.`status` AS `status` from ((`tbl_trans_pesanan` join `tbl_m_karyawan` on(`tbl_trans_pesanan`.`id_sales` = `tbl_m_karyawan`.`id_user`)) join `tbl_m_pelanggan` on(`tbl_trans_pesanan`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) order by `tbl_trans_pesanan`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_po
DROP VIEW IF EXISTS `v_trans_po`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_po`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_po` AS select `tbl_trans_beli_po`.`id` AS `id`,`tbl_trans_beli_po`.`id_user` AS `id_user`,`tbl_trans_beli_po`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_beli_po`.`id_supplier` AS `id_supplier`,`tbl_trans_beli_po`.`id_rab` AS `id_rab`,`tbl_trans_beli_po`.`id_penjualan` AS `id_penjualan`,`tbl_trans_beli_po`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_beli_po`.`tgl_masuk` AS `tgl_masuk`,`tbl_ion_users`.`username` AS `username`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_pengaturan_profile`.`no_telp` AS `c_no_telp`,`tbl_pengaturan_profile`.`no_fax` AS `c_no_fax`,`tbl_pengaturan_profile`.`kota` AS `c_kota`,`tbl_pengaturan_profile`.`logo` AS `c_logo`,`tbl_m_supplier`.`kode` AS `kode`,`tbl_m_supplier`.`npwp` AS `npwp`,`tbl_m_supplier`.`nama` AS `supplier`,`tbl_m_supplier`.`alamat` AS `alamat`,`tbl_m_supplier`.`no_telp` AS `no_telp`,`tbl_m_supplier`.`cp` AS `cp`,`tbl_trans_beli_po`.`no_po` AS `no_po`,`tbl_trans_beli_po`.`keterangan` AS `keterangan`,`tbl_trans_beli_po`.`status_nota` AS `status_nota`,`tbl_trans_beli_po`.`status_fkt` AS `status_fkt` from (((`tbl_trans_beli_po` join `tbl_m_supplier` on(`tbl_trans_beli_po`.`id_supplier` = `tbl_m_supplier`.`id`)) join `tbl_ion_users` on(`tbl_trans_beli_po`.`id_user` = `tbl_ion_users`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_beli_po`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_beli_po`.`status_hps` = '0' order by `tbl_trans_beli_po`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_rab
DROP VIEW IF EXISTS `v_trans_rab`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_rab`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_rab` AS select `tbl_trans_rab`.`id` AS `id`,`tbl_trans_rab`.`id_user` AS `id_user`,`tbl_trans_rab`.`id_sales` AS `id_sales`,`tbl_trans_rab`.`id_pelanggan` AS `id_pelanggan`,`tbl_trans_rab`.`id_perusahaan` AS `id_perusahaan`,`tbl_trans_rab`.`id_tipe` AS `id_tipe`,`tbl_trans_rab`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_rab`.`tgl_modif` AS `tgl_modif`,`tbl_trans_rab`.`tgl_masuk` AS `tgl_masuk`,`Usr`.`first_name` AS `username`,`tbl_ion_users`.`first_name` AS `sales`,`tbl_pengaturan_profile`.`nama` AS `c_nama`,`tbl_pengaturan_profile`.`alamat` AS `c_alamat`,`tbl_m_pelanggan`.`nama` AS `p_nama`,`tbl_m_pelanggan`.`alamat` AS `p_alamat`,`tbl_m_tipe`.`tipe` AS `tipe`,`tbl_trans_rab`.`no_rab` AS `no_rab`,`tbl_trans_rab`.`no_kontrak` AS `no_kontrak`,`tbl_trans_rab`.`no_paket` AS `no_paket`,`tbl_trans_rab`.`jml_hps` AS `jml_hps`,`tbl_trans_rab`.`jml_pagu` AS `jml_pagu`,`tbl_trans_rab`.`jml_total` AS `jml_total`,`tbl_trans_rab`.`ppn` AS `ppn`,`tbl_trans_rab`.`jml_ppn` AS `jml_ppn`,`tbl_trans_rab`.`pph` AS `pph`,`tbl_trans_rab`.`jml_pph` AS `jml_pph`,`tbl_trans_rab`.`jml_gtotal` AS `jml_gtotal`,`tbl_trans_rab`.`jml_biaya` AS `jml_biaya`,`tbl_trans_rab`.`jml_hpp` AS `jml_hpp`,`tbl_trans_rab`.`jml_hpp_ppn` AS `jml_hpp_ppn`,`tbl_trans_rab`.`jml_profit` AS `jml_profit`,`tbl_trans_rab`.`status` AS `status`,`tbl_trans_rab`.`status_ppn` AS `status_ppn` from (((((`tbl_trans_rab` join `tbl_ion_users` on(`tbl_trans_rab`.`id_sales` = `tbl_ion_users`.`id`)) join `tbl_ion_users` `Usr` on(`tbl_trans_rab`.`id_user` = `Usr`.`id`)) join `tbl_m_pelanggan` on(`tbl_trans_rab`.`id_pelanggan` = `tbl_m_pelanggan`.`id`)) join `tbl_m_tipe` on(`tbl_trans_rab`.`id_tipe` = `tbl_m_tipe`.`id`)) join `tbl_pengaturan_profile` on(`tbl_trans_rab`.`id_perusahaan` = `tbl_pengaturan_profile`.`id`)) where `tbl_trans_rab`.`status_hps` = '0' order by `tbl_trans_rab`.`id` desc;

-- Dumping structure for view mikhaelf_db_ars.v_trans_rab_log
DROP VIEW IF EXISTS `v_trans_rab_log`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_trans_rab_log`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_trans_rab_log` AS select `tbl_trans_rab_log`.`id` AS `id`,`tbl_trans_rab_log`.`id_rab` AS `id_rab`,`tbl_trans_rab_log`.`id_user` AS `id_user`,`tbl_trans_rab_log`.`tgl_simpan` AS `tgl_simpan`,`tbl_trans_rab_log`.`tgl_modif` AS `tgl_modif`,`tbl_ion_users`.`first_name` AS `user`,`tbl_trans_rab_log`.`log` AS `log`,`tbl_trans_rab_log`.`status` AS `status` from ((`tbl_trans_rab_log` join `v_trans_rab` on(`tbl_trans_rab_log`.`id_rab` = `v_trans_rab`.`id`)) join `tbl_ion_users` on(`tbl_trans_rab_log`.`id_user` = `tbl_ion_users`.`id`)) order by `tbl_trans_rab_log`.`id` desc;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
