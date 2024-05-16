-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2024 at 10:52 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbvpny1qngaxgp`
--

-- --------------------------------------------------------

--
-- Table structure for table `checking`
--

DROP TABLE IF EXISTS `checking`;
CREATE TABLE IF NOT EXISTS `checking` (
  `Acct_no` int NOT NULL,
  `userid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Balance` double NOT NULL,
  `Date` date NOT NULL,
  `TRansID` int NOT NULL,
  PRIMARY KEY (`Acct_no`),
  KEY `fk_user_id` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checking`
--

INSERT INTO `checking` (`Acct_no`, `userid`, `lastname`, `firstname`, `address`, `email`, `phone`, `Balance`, `Date`, `TRansID`) VALUES
(123456789, 'jalton', 'Alton', 'Jayden', '471 Lexington Circle', 'jmalton77@gmail.com', '7606072036', 11, '2024-05-12', 123456789),
(0, 'quickme1_4211', '', '', '', '', '', 442, '2024-05-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checking_transactions`
--

DROP TABLE IF EXISTS `checking_transactions`;
CREATE TABLE IF NOT EXISTS `checking_transactions` (
  `transid` int NOT NULL,
  `trans_type` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trans_date` date NOT NULL,
  `trans-amount` double NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checking_transactions`
--

INSERT INTO `checking_transactions` (`transid`, `trans_type`, `trans_date`, `trans-amount`, `lastname`, `firstname`, `phone`) VALUES
(123456789, 'Deposit', '2024-05-16', 100, 'Alton', 'Jayden', '7606072036'),
(123456789, 'Deposit', '2024-05-16', 12, 'Alton', 'Jayden', '7606072036'),
(123456789, 'Deposit', '2024-05-16', 293, 'Alton', 'Jayden', '7606072036'),
(123456789, 'Deposit', '2024-05-16', 12, 'Alton', 'Jayden', '7606072036'),
(123123123, 'Deposit', '2024-05-16', 1200, 'User', 'Default', '1231231234'),
(123123123, 'Deposit', '2024-05-16', 32, 'User', 'Default', '1231231234'),
(123123123, 'Deposit', '2024-05-16', 4590, 'User', 'Default', '1231231234'),
(0, 'Deposit', '2024-05-16', 1000, '', '', ''),
(0, 'Transfer', '2024-05-16', 500, '', '', ''),
(0, 'Deposit', '2024-05-16', 2000, '', '', ''),
(0, 'Transfer', '2024-05-16', 24, '', '', ''),
(0, 'Transfer', '2024-05-16', 34, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

DROP TABLE IF EXISTS `investment`;
CREATE TABLE IF NOT EXISTS `investment` (
  `Acct_no` int NOT NULL,
  `userid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Balance` double NOT NULL,
  `Date` date NOT NULL,
  `TRansID` int NOT NULL,
  `interest-rate` double NOT NULL,
  `total-amount` double NOT NULL,
  PRIMARY KEY (`Acct_no`),
  KEY `fk_user_id` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`Acct_no`, `userid`, `lastname`, `firstname`, `address`, `email`, `phone`, `Balance`, `Date`, `TRansID`, `interest-rate`, `total-amount`) VALUES
(111222333, 'jalton', 'Alton', 'Jayden', '471 Lexington Cir', 'jmalton77@gmail.com', '7606072036', 3872.9628246951, '2016-05-11', 0, 10, 0),
(0, 'quickme1_4211', '', '', '', '', '', 2534, '2024-05-16', 0, 0.1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `investment_transactions`
--

DROP TABLE IF EXISTS `investment_transactions`;
CREATE TABLE IF NOT EXISTS `investment_transactions` (
  `transid` int NOT NULL,
  `trans_type` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trans_date` date NOT NULL,
  `trans-amount` double NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment_transactions`
--

INSERT INTO `investment_transactions` (`transid`, `trans_type`, `trans_date`, `trans-amount`, `lastname`, `firstname`, `phone`) VALUES
(111222333, 'Deposit', '2024-05-16', 12, 'Alton', 'Jayden', '7606072036'),
(111222333, 'Withdrawal', '2024-05-16', 12, 'Alton', 'Jayden', '7606072036'),
(111222333, 'Deposit', '2024-05-16', 123, 'Alton', 'Jayden', '7606072036'),
(111222333, 'Withdrawal', '2024-05-16', 123, 'Alton', 'Jayden', '7606072036'),
(0, 'Transfer', '2024-05-16', 500, '', '', ''),
(0, 'Transfer', '2024-05-16', 34, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

DROP TABLE IF EXISTS `login_tbl`;
CREATE TABLE IF NOT EXISTS `login_tbl` (
  `userid` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `Testquestion` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `Testanswer` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `usertype` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`userid`, `password`, `lastname`, `firstname`, `address`, `phone`, `email`, `Testquestion`, `Testanswer`, `usertype`) VALUES
('jalton', 'Pa$$w0rd', 'Alton', 'Jayden', '471 Lexington Circle', '7606072036', 'jmalton77@gmail.com', 'What is the name of your first pet?', 'Misty', 'admin'),
('bsmith', 'Pa$$w0rd', 'Smith', 'Bob', '123 Bob Ave', '7607607600', 'bob@gmail.com', 'Answer is none?', 'none', ''),
('quickme1_4211', 'csci4211', 'User', 'Default', '123 Default Lane', '1231231234', 'default@gmail.com', 'Are you default?', 'Yes', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

DROP TABLE IF EXISTS `savings`;
CREATE TABLE IF NOT EXISTS `savings` (
  `Acct_no` int NOT NULL,
  `userid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Balance` double NOT NULL,
  `Date` date NOT NULL,
  `TRansID` int NOT NULL,
  `interest-rate` double NOT NULL,
  `total-amount` double NOT NULL,
  PRIMARY KEY (`Acct_no`),
  KEY `fk_user_id` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`Acct_no`, `userid`, `lastname`, `firstname`, `address`, `email`, `phone`, `Balance`, `Date`, `TRansID`, `interest-rate`, `total-amount`) VALUES
(987654321, 'jalton', 'Alton', 'Jayden', '471 Lexington Circle', 'jmalton77@gmail.com', '7606072036', 166.8491514476342, '2024-05-12', 987654321, 2.5, 0),
(0, 'quickme1_4211', '', '', '', '', '', 24.024, '2024-05-16', 0, 0.1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savings_transactions`
--

DROP TABLE IF EXISTS `savings_transactions`;
CREATE TABLE IF NOT EXISTS `savings_transactions` (
  `transid` int NOT NULL,
  `trans_type` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `trans_date` date NOT NULL,
  `trans-amount` double NOT NULL,
  `lastname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savings_transactions`
--

INSERT INTO `savings_transactions` (`transid`, `trans_type`, `trans_date`, `trans-amount`, `lastname`, `firstname`, `phone`) VALUES
(987654321, 'Deposit', '2024-05-16', 123, 'Alton', 'Jayden', '7606072036'),
(987654321, 'Withdrawal', '2024-05-16', 12, 'Alton', 'Jayden', '7606072036'),
(0, 'Deposit', '2024-05-16', 123, '', '', ''),
(0, 'Deposit', '2024-05-16', 23, '', '', ''),
(0, 'Transfer', '2024-05-16', 24, '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
