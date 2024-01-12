-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database_serkom
DROP DATABASE IF EXISTS `database_serkom`;
CREATE DATABASE IF NOT EXISTS `database_serkom` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database_serkom`;

-- Dumping structure for table database_serkom.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_serkom.admin: ~1 rows (approximately)
REPLACE INTO `admin` (`id`, `nama`, `telepon`, `username`, `password`) VALUES
	(1, 'dany', '089667123123', 'admin', '0192023a7bbd73250516f069df18b500');

-- Dumping structure for table database_serkom.harga
DROP TABLE IF EXISTS `harga`;
CREATE TABLE IF NOT EXISTS `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tanggal_update` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_serkom.harga: ~2 rows (approximately)
REPLACE INTO `harga` (`id`, `jenis`, `harga`, `tanggal_update`, `keterangan`) VALUES
	(1, 'Diskon', 3200, '2024-01-12', '-'),
	(2, 'Normal', 4000, '2024-01-12', NULL);

-- Dumping structure for table database_serkom.pelanggan
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT '-',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_serkom.pelanggan: ~4 rows (approximately)
REPLACE INTO `pelanggan` (`id`, `nama`, `alamat`, `telepon`, `keterangan`) VALUES
	(1, 'Dany', 'Purwokerto', '081227227227', 'yang ambil pembantunya'),
	(2, 'Candra', 'Purwokerto', '082123456123', '-'),
	(3, 'Ayu F', 'Purwokerto', '081456787873', '-'),
	(4, 'Dede', 'Purwokerto', '081223456787', '-');

-- Dumping structure for procedure database_serkom.total_pendapatan_7_hari
DROP PROCEDURE IF EXISTS `total_pendapatan_7_hari`;
DELIMITER //
CREATE PROCEDURE `total_pendapatan_7_hari`()
BEGIN
	DECLARE today_date DATE;
   DECLARE seven_days_ago DATE;

   SET today_date = CURDATE();
   SET seven_days_ago = DATE_SUB(today_date, INTERVAL 7 DAY);

   SELECT SUM(transaksi.total_harga) AS hasil
    FROM transaksi
    WHERE transaksi.tanggal_transaksi BETWEEN seven_days_ago AND today_date;

END//
DELIMITER ;

-- Dumping structure for table database_serkom.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_harga` int(11) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transaksi_pelanggan` (`id_pelanggan`),
  KEY `FK_transaksi_admin` (`id_admin`),
  KEY `FK_transaksi_harga` (`id_harga`),
  CONSTRAINT `FK_transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_transaksi_harga` FOREIGN KEY (`id_harga`) REFERENCES `harga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_serkom.transaksi: ~3 rows (approximately)
REPLACE INTO `transaksi` (`id`, `id_pelanggan`, `id_admin`, `id_harga`, `tanggal_transaksi`, `tanggal_selesai`, `berat`, `total_harga`, `status`) VALUES
	(9, 4, 1, 2, '2024-01-10 00:00:00', '2024-01-19', 1, 4000, '2'),
	(11, 4, 1, 2, '2024-01-11 07:40:38', '2024-01-19', 1, 4000, '0'),
	(12, 1, 1, 1, '2024-01-11 09:51:01', '2024-01-12', 1, 3000, '0');

-- Dumping structure for view database_serkom.transaksi_belum_selesai
DROP VIEW IF EXISTS `transaksi_belum_selesai`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `transaksi_belum_selesai` (
	`id` INT(11) NOT NULL,
	`id_pelanggan` INT(11) NOT NULL,
	`id_admin` INT(11) NOT NULL,
	`id_harga` INT(11) NULL,
	`tanggal_transaksi` DATETIME NULL,
	`tanggal_selesai` DATE NULL,
	`berat` DECIMAL(10,0) NULL,
	`total_harga` INT(11) NULL,
	`status` CHAR(1) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table database_serkom.transaksi_detail
DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `jumlah` varchar(255) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_transaksi_detail_transaksi` (`id_transaksi`),
  CONSTRAINT `FK_transaksi_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_serkom.transaksi_detail: ~1 rows (approximately)
REPLACE INTO `transaksi_detail` (`id`, `id_transaksi`, `jenis`, `jumlah`, `keterangan`) VALUES
	(7, 9, 'Kemeja', '2', '');

-- Dumping structure for view database_serkom.view_dashboard
DROP VIEW IF EXISTS `view_dashboard`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_dashboard` (
	`id` INT(11) NOT NULL,
	`tanggal_transaksi` DATETIME NULL,
	`nama` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`berat` DECIMAL(10,0) NULL,
	`tanggal_selesai` DATE NULL,
	`total_harga` INT(11) NULL,
	`status` CHAR(1) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for trigger database_serkom.delete_transaksi_detail
DROP TRIGGER IF EXISTS `delete_transaksi_detail`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `delete_transaksi_detail` BEFORE DELETE ON `transaksi` FOR EACH ROW BEGIN
DELETE FROM transaksi_detail WHERE transaksi_detail.id_transaksi=OLD.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `transaksi_belum_selesai`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `transaksi_belum_selesai` AS SELECT * from transaksi where transaksi.`status`='0' ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_dashboard`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_dashboard` AS select transaksi.id, transaksi.tanggal_transaksi, pelanggan.nama, transaksi.berat, transaksi.tanggal_selesai, transaksi.total_harga, transaksi.status from pelanggan,transaksi where pelanggan.id=transaksi.id_pelanggan order by transaksi.tanggal_transaksi desc LIMIT 10 ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
