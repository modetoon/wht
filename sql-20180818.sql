-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.1.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for wht
CREATE DATABASE IF NOT EXISTS `wht` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wht`;


-- Dumping structure for table wht.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` char(50) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IDCard` char(13) DEFAULT NULL,
  `TaxNumber` char(50) DEFAULT NULL,
  `Phone` char(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` text,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` char(50) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` char(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wht.customer: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`CustomerID`, `Type`, `FullName`, `IDCard`, `TaxNumber`, `Phone`, `Email`, `Address`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`, `Status`) VALUES
	(1, 'corporation', 'True Corporation', '1223344344435', '32323232', '053200991', 'test@admin.com', '25 SATHONTAI ROAD, THUNGMAHAMEK, SATHON, BANGKOK 10120', '2016-08-03 10:04:38', 'admin', '2016-08-03 10:04:49', 'admin', 1),
	(2, 'individual', 'DTAC', '1999283002918', '117277288', '023388829', 'test2@gmail.com', 'Somphot Chiang Mai 700 Pi Rd, Mueang Chiang Mai District, Chiang Mai 50000', '2016-08-03 10:04:57', 'admin', '2016-08-03 00:00:00', 'admin', 1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for table wht.expense_type
CREATE TABLE IF NOT EXISTS `expense_type` (
  `ExpenseTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseTypeName` char(100) DEFAULT NULL,
  `Percent` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ExpenseTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table wht.expense_type: ~12 rows (approximately)
/*!40000 ALTER TABLE `expense_type` DISABLE KEYS */;
INSERT INTO `expense_type` (`ExpenseTypeID`, `ExpenseTypeName`, `Percent`, `Status`) VALUES
	(1, 'ค่าขนส่ง 1%', 1, 1),
	(2, 'ดอกเบี้ย 1%', 1, 1),
	(3, 'ค่าโฆษณา 2%', 2, 1),
	(4, 'ค่าบริการ 3%', 3, 1),
	(5, 'ค่าเช่าเต้นท์', 3, 1),
	(6, 'ค่าจ้างทำของ 3%', 3, 1),
	(7, 'ส่งเสริมการขาย 3%', 3, 1),
	(8, 'ค่าเช่า 5%', 5, 1),
	(9, 'สิทธิครอบครอง', 5, 1),
	(10, 'รางวัล 5%', 5, 1),
	(11, 'ค่านักแสดง 5%', 5, 1),
	(12, 'ค่าบริการให้คำปรึกษา (อัตราก้าวหน้า)', 5, 1);
/*!40000 ALTER TABLE `expense_type` ENABLE KEYS */;


-- Dumping structure for table wht.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `TransactionID` bigint(11) NOT NULL AUTO_INCREMENT,
  `DocNo` char(50) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL,
  `AmountExclVat` float(10,2) DEFAULT NULL,
  `TaxPercent` int(11) DEFAULT NULL,
  `AmountInclVat` float(10,2) DEFAULT NULL,
  `ExpenseTypeID` int(11) DEFAULT NULL,
  `OverHead` char(50) DEFAULT NULL,
  PRIMARY KEY (`TransactionID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wht.transaction: ~2 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`TransactionID`, `DocNo`, `CustomerID`, `TransactionDate`, `AmountExclVat`, `TaxPercent`, `AmountInclVat`, `ExpenseTypeID`, `OverHead`) VALUES
	(1, '59/00001', 1, '2016-08-02', 100.00, 3, 103.09, 4, 'absorbed'),
	(2, '59/00002', 2, '2016-08-03', 1800.00, 3, 1855.67, 5, 'deducted');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table wht.user
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserType` char(50) DEFAULT '0',
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table wht.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`UserID`, `UserType`, `UserName`, `Password`, `FullName`, `Email`, `CreatedDate`, `Status`) VALUES
	(1, 'admin', 'admin', 'admin', 'Admin', 'natthaphol@gmail.com', '2016-07-30 17:06:37', NULL),
	(4, 'admin', 'kate', 'kate123', 'Katenapa', 'kate@gmail.com', NULL, 1),
	(6, 'user', 'user', 'user123', 'User WHT', 'user@gmail.com', NULL, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
