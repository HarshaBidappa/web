-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2018 at 09:01 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cart`
--
CREATE DATABASE IF NOT EXISTS `cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cart`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int(11) NOT NULL,
  `AdminId` varchar(200) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `AdminId`, `Password`) VALUES
(1, 'admin@scotchhub.com', 'questpirates');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Quantity` bigint(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Id`, `ProductId`, `UserId`, `Quantity`) VALUES
(0, 62, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `ProductId`, `UserId`, `OrderDate`, `Quantity`) VALUES
(23, 3, 6, '2018-10-15 02:35:06', 1),
(24, 8, 6, '2018-10-15 02:35:38', 1),
(25, 3, 6, '2018-10-15 02:48:42', 1),
(26, 6, 6, '2018-10-15 02:51:40', 1),
(27, 8, 2, '2018-10-15 02:55:16', 2),
(28, 3, 2, '2018-10-15 02:55:16', 1),
(29, 7, 2, '2018-10-15 03:45:05', 1),
(30, 3, 2, '2018-10-15 03:45:50', 1),
(31, 6, 2, '2018-10-15 03:48:43', 2),
(32, 5, 2, '2018-10-15 04:05:13', 2),
(33, 4, 2, '2018-10-15 04:05:13', 1),
(34, 3, 2, '2018-10-15 04:16:30', 1),
(35, 7, 2, '2018-10-15 05:04:46', 1),
(36, 8, 2, '2018-10-15 05:04:46', 2),
(37, 7, 2, '2018-10-15 05:08:47', 2),
(38, 1, 2, '2018-10-15 05:08:47', 2),
(39, 2, 2, '2018-10-15 05:14:48', 2),
(40, 7, 2, '2018-10-15 05:16:47', 1),
(41, 6, 2, '2018-10-15 05:18:40', 1),
(42, 6, 2, '2018-10-15 05:20:29', 1),
(43, 6, 2, '2018-10-15 05:21:53', 2),
(44, 5, 2, '2018-10-15 05:21:53', 3),
(45, 3, 2, '2018-10-15 05:30:22', 1),
(46, 7, 2, '2018-10-15 05:30:22', 2),
(47, 2, 2, '2018-10-15 05:33:30', 3),
(48, 7, 2, '2018-10-15 05:33:31', 2),
(49, 2, 1, '2018-10-15 05:38:17', 2),
(50, 5, 1, '2018-10-15 05:38:17', 2),
(51, 7, 1, '2018-10-15 05:38:17', 1),
(52, 8, 8, '2018-10-15 06:37:37', 1),
(53, 6, 8, '2018-10-15 06:37:37', 2),
(54, 3, 8, '2018-10-15 08:48:38', 1),
(55, 2, 9, '2018-10-15 12:55:34', 2),
(56, 8, 9, '2018-10-15 12:55:34', 1),
(57, 5, 9, '2018-10-15 13:15:17', 1),
(58, 2, 9, '2018-10-15 13:25:17', 3),
(59, 4, 10, '2018-10-15 23:38:32', 2),
(60, 8, 10, '2018-10-15 23:38:32', 1),
(61, 13, 11, '2018-10-16 08:02:40', 1),
(62, 9, 10, '2018-10-17 02:26:06', 2),
(63, 8, 10, '2018-10-17 02:26:06', 2),
(64, 80, 10, '2018-10-18 03:58:03', 1),
(65, 86, 10, '2018-10-18 03:58:04', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(50) NOT NULL,
  `InStock` bigint(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Price`, `Image`, `InStock`) VALUES
(62, 'Omega', 11233, '1.jpg', 60),
(63, 'Rado', 1123, '1.jpg', 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `MobileNo` varchar(20) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `Area` varchar(200) DEFAULT NULL,
  `Landmark` varchar(100) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `PinCode` bigint(20) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `Address2` varchar(500) DEFAULT NULL,
  `Area2` varchar(200) DEFAULT NULL,
  `Landmark2` varchar(100) DEFAULT NULL,
  `State2` varchar(50) DEFAULT NULL,
  `City2` varchar(50) DEFAULT NULL,
  `PinCode2` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `EmailId`, `MobileNo`, `DOB`, `Gender`, `Address`, `Area`, `Landmark`, `State`, `City`, `PinCode`, `Password`, `Address2`, `Area2`, `Landmark2`, `State2`, `City2`, `PinCode2`) VALUES
(0, 'DHEERAJ KUMAR', 'dkcity11s@gmail.com', '9447530143', '2018-06-19', 'male', NULL, NULL, NULL, NULL, NULL, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
