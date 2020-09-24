-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2020 at 02:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matzaccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `balancesheet`
--

CREATE TABLE `balancesheet` (
  `UserId` int(11) NOT NULL,
  `BalanceID` int(11) NOT NULL,
  `BName` varchar(100) NOT NULL,
  `BDescription` varchar(500) NOT NULL,
  `CategoryID` int(50) NOT NULL,
  `BAmount` int(20) NOT NULL,
  `BDebit` int(2) DEFAULT NULL,
  `BCredit` int(2) DEFAULT NULL,
  `BTransfer` int(2) DEFAULT NULL,
  `BDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balancesheet`
--

INSERT INTO `balancesheet` (`UserId`, `BalanceID`, `BName`, `BDescription`, `CategoryID`, `BAmount`, `BDebit`, `BCredit`, `BTransfer`, `BDate`) VALUES
(2, 4, 'Abdul Rafay', 'asdfghjkl', 4, 10000, 0, 1, NULL, '2020-09-19'),
(2, 5, 'Abdul Rafay', 'LKJHGFDS', 2, 500, 1, 0, NULL, '2020-09-19'),
(2, 6, 'Rawaha', 'poiuytrewq', 2, 10000, 0, 1, NULL, '2020-08-14'),
(2, 7, 'Rawaha', 'APOIUYTREWE', 6, 5000, 1, 0, NULL, '2020-08-19'),
(1, 8, 'Rawaha', 'asdfghjklqwertyuio', 2, 10000, 0, 1, NULL, '2020-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CName`) VALUES
(1, 'patty Cash'),
(2, 'Utility Bills'),
(3, 'salaries'),
(4, 'Office Expense'),
(5, 'Misc. Expenses'),
(6, 'petty cash'),
(7, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`) VALUES
(1, 'admin', 'admin'),
(2, 'shan', 'shan'),
(3, 'admin1', 'admin1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balancesheet`
--
ALTER TABLE `balancesheet`
  ADD PRIMARY KEY (`BalanceID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balancesheet`
--
ALTER TABLE `balancesheet`
  MODIFY `BalanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
