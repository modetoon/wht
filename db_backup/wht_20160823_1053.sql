-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2016 at 05:52 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wht`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerCode` varchar(20) DEFAULT NULL,
  `Version` char(1) NOT NULL,
  `Type` char(50) DEFAULT NULL,
  `FullNameThai` varchar(255) DEFAULT NULL,
  `FullNameEnglish` varchar(255) DEFAULT NULL,
  `IDCard` char(13) DEFAULT NULL,
  `TaxNumber` char(50) DEFAULT NULL,
  `Phone` char(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` text,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` char(50) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `UpdatedBy` char(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `ExpenseTypeID` int(11) NOT NULL,
  `ExpenseTypeName` char(100) DEFAULT NULL,
  `Wht_Type` varchar(5) NOT NULL,
  `Percent` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`ExpenseTypeID`, `ExpenseTypeName`, `Wht_Type`, `Percent`, `Status`) VALUES
(1, 'ค่าขนส่ง 1%', '1.1', 1, 1),
(2, 'ดอกเบี้ย 1%', '1.2', 1, 1),
(3, 'ค่าโฆษณา 2%', '2.1', 2, 1),
(4, 'ค่าบริการ (ค่าเช่าเต้นท์) 3%', '3.1', 3, 1),
(6, 'ค่าจ้างทำของ 3%', '3.2', 3, 1),
(7, 'ส่งเสริมการขาย 3%', '3.3', 3, 1),
(8, 'ค่าเช่า (สิทธิครอบครอง) 5%', '5.1', 5, 1),
(10, 'รางวัล 5%', '5.2', 5, 1),
(11, 'ค่านักแสดง 5%', '53.', 5, 1),
(12, 'ค่าบริการให้คำปรึกษา (อัตราก้าวหน้า)', '15', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` bigint(11) NOT NULL,
  `DocNo` char(50) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL,
  `Amount` float(10,2) DEFAULT NULL,
  `TaxAmount` float(10,2) DEFAULT NULL,
  `NetAmount` float(10,2) DEFAULT NULL,
  `ExpenseTypeID` int(11) DEFAULT NULL,
  `TaxPercent` decimal(2,2) NOT NULL,
  `Condition` char(1) DEFAULT NULL,
  `Remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `DocNo`, `CustomerID`, `TransactionDate`, `Amount`, `TaxAmount`, `NetAmount`, `ExpenseTypeID`, `TaxPercent`, `Condition`, `Remark`) VALUES
(1, '59/00001', 1, '2016-08-02', 100.00, 3.00, 103.09, 4, '0.00', 'a', ''),
(2, '59/00002', 2, '2016-08-03', 1800.00, 3.00, 1855.67, 5, '0.00', 'd', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserType` char(50) DEFAULT '0',
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserType`, `UserName`, `Password`, `FullName`, `Email`, `CreatedDate`, `Status`) VALUES
(1, 'admin', 'admin', 'admin', 'Admin', 'natthaphol@gmail.com', '2016-07-30 17:06:37', NULL),
(4, 'admin', 'kate', 'kate123', 'Katenapa', 'kate@gmail.com', NULL, 1),
(6, 'user', 'user', 'user123', 'User WHT', 'user@gmail.com', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`ExpenseTypeID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1562;
--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `ExpenseTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
