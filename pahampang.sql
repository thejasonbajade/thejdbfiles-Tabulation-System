-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2015 at 06:25 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pahampang`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicorg`
--

CREATE TABLE IF NOT EXISTS `academicorg` (
  `acadOrg_ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `overallTotal` decimal(7,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academicorg`
--

INSERT INTO `academicorg` (`acadOrg_ID`, `name`, `overallTotal`) VALUES
(1, 'Elektrons', '88.50'),
(2, 'Redbolts', '64.25'),
(3, 'Clovers', '84.25'),
(4, 'Skimmers', '89.25'),
(5, 'SoTech', '69.25'),
(6, 'Fisheries', '94.25'),
(7, 'Ugyon', '39.25'),
(8, 'Tycoons', '95.00'),
(9, 'Scions', '99.25'),
(10, 'Magnates', '79.25');

-- --------------------------------------------------------

--
-- Table structure for table `acapella`
--

CREATE TABLE IF NOT EXISTS `acapella` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion45` int(11) NOT NULL DEFAULT '0',
  `criterion46` int(11) NOT NULL DEFAULT '0',
  `criterion47` int(11) NOT NULL DEFAULT '0',
  `criterion35` int(11) NOT NULL DEFAULT '0',
  `criterion25` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `username`, `password`, `firstName`, `lastName`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bestcheeringgroup`
--

CREATE TABLE IF NOT EXISTS `bestcheeringgroup` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion21` int(11) NOT NULL DEFAULT '0',
  `criterion22` int(11) NOT NULL DEFAULT '0',
  `criterion23` int(11) NOT NULL DEFAULT '0',
  `criterion24` int(11) NOT NULL DEFAULT '0',
  `criterion` int(11) NOT NULL DEFAULT '0',
  `criterion25` int(11) NOT NULL DEFAULT '0',
  `criterion26` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bestcheeringgroup`
--

INSERT INTO `bestcheeringgroup` (`judge_ID`, `acadOrg_ID`, `rank`, `total`, `deduction`, `criterion21`, `criterion22`, `criterion23`, `criterion24`, `criterion`, `criterion25`, `criterion26`) VALUES
(2, 1, 4, 38, 0, 6, 8, 8, 6, 0, 3, 7),
(2, 2, 5, 33, 0, 0, 7, 8, 6, 0, 5, 7),
(2, 3, 4, 38, 0, 7, 6, 8, 6, 0, 4, 7),
(2, 4, 1, 44, 0, 9, 7, 9, 7, 0, 5, 7),
(2, 5, 6, 32, 0, 6, 9, 6, 9, 0, 2, 0),
(2, 6, 2, 43, 0, 7, 9, 7, 9, 0, 2, 9),
(2, 8, 5, 33, 0, 8, 8, 6, 3, 0, 4, 4),
(2, 9, 3, 42, 0, 7, 9, 6, 9, 0, 4, 7),
(2, 10, 4, 38, 1, 7, 5, 6, 10, 0, 2, 9),
(3, 1, 1, 39, 0, 8, 5, 7, 7, 0, 3, 9),
(3, 2, 6, 31, 0, 6, 6, 6, 5, 0, 3, 5),
(3, 3, 4, 36, 0, 8, 5, 8, 6, 0, 1, 8),
(3, 4, 3, 37, 0, 6, 8, 7, 8, 0, 2, 6),
(3, 5, 8, 29, 0, 4, 6, 7, 5, 0, 2, 5),
(3, 6, 2, 38, 0, 6, 7, 5, 7, 0, 5, 8),
(3, 8, 5, 32, 0, 6, 2, 5, 7, 0, 5, 7),
(3, 9, 1, 39, 0, 6, 8, 6, 8, 0, 3, 8),
(3, 10, 7, 30, 2, 7, 4, 6, 5, 0, 5, 5),
(4, 1, 5, 30, 0, 7, 5, 7, 5, 0, 1, 5),
(4, 2, 2, 36, 0, 6, 7, 8, 6, 0, 3, 6),
(4, 3, 7, 26, 0, 4, 6, 6, 4, 0, 2, 4),
(4, 4, 6, 27, 0, 6, 4, 6, 4, 0, 3, 4),
(4, 5, 4, 31, 0, 5, 4, 5, 6, 0, 5, 6),
(4, 6, 3, 35, 0, 6, 5, 7, 9, 0, 2, 6),
(4, 8, 3, 35, 0, 7, 6, 6, 5, 0, 4, 7),
(4, 9, 1, 40, 0, 8, 6, 6, 8, 0, 3, 9),
(4, 10, 5, 30, 2, 8, 7, 6, 4, 0, 3, 4),
(5, 1, 5, 35, 0, 5, 8, 6, 6, 0, 5, 5),
(5, 2, 3, 37, 0, 6, 7, 5, 7, 0, 5, 7),
(5, 3, 2, 38, 0, 7, 7, 5, 7, 0, 5, 7),
(5, 4, 4, 36, 0, 5, 7, 5, 7, 0, 5, 7),
(5, 5, 7, 29, 0, 7, 0, 8, 6, 0, 3, 5),
(5, 6, 2, 38, 0, 8, 6, 5, 7, 0, 5, 7),
(5, 8, 6, 32, 0, 8, 4, 6, 5, 0, 4, 5),
(5, 9, 1, 40, 0, 6, 7, 8, 8, 0, 2, 9),
(5, 10, 8, 27, 2, 5, 6, 5, 7, 0, 1, 5),
(6, 1, 4, 35, 0, 7, 5, 7, 6, 0, 4, 6),
(6, 2, 5, 34, 0, 7, 7, 5, 8, 0, 4, 3),
(6, 3, 3, 36, 0, 8, 6, 7, 6, 0, 3, 6),
(6, 4, 1, 39, 0, 8, 6, 8, 6, 0, 4, 7),
(6, 5, 3, 36, 0, 8, 6, 8, 6, 0, 2, 6),
(6, 6, 4, 35, 0, 6, 8, 6, 8, 0, 0, 7),
(6, 8, 2, 38, 0, 8, 9, 3, 8, 0, 2, 8),
(6, 9, 1, 39, 0, 9, 7, 9, 6, 0, 2, 6),
(6, 10, 2, 38, 2, 8, 6, 8, 6, 0, 3, 9),
(7, 1, 5, 34, 0, 5, 6, 5, 6, 0, 5, 7),
(7, 2, 6, 28, 0, 3, 7, 6, 4, 0, 2, 6),
(7, 3, 5, 34, 0, 5, 7, 5, 7, 0, 3, 7),
(7, 4, 6, 28, 0, 6, 5, 3, 3, 0, 4, 7),
(7, 5, 1, 40, 0, 6, 8, 5, 9, 0, 5, 7),
(7, 6, 4, 37, 0, 6, 7, 6, 8, 0, 2, 8),
(7, 8, 1, 40, 0, 6, 9, 6, 9, 0, 1, 9),
(7, 9, 2, 39, 0, 6, 8, 6, 8, 0, 3, 8),
(7, 10, 3, 38, 2, 7, 5, 8, 8, 0, 3, 9),
(8, 1, 8, 28, 0, 5, 3, 5, 6, 0, 5, 4),
(8, 2, 7, 29, 0, 4, 2, 4, 8, 0, 4, 7),
(8, 3, 1, 39, 0, 6, 8, 6, 8, 0, 3, 8),
(8, 4, 2, 37, 0, 6, 7, 5, 7, 0, 5, 7),
(8, 5, 4, 35, 0, 5, 7, 6, 7, 0, 2, 8),
(8, 6, 5, 34, 0, 5, 6, 7, 7, 0, 2, 7),
(8, 8, 3, 36, 0, 5, 7, 5, 7, 0, 5, 7),
(8, 9, 4, 35, 0, 5, 6, 5, 7, 0, 5, 7),
(8, 10, 6, 32, 2, 7, 8, 7, 5, 0, 1, 6),
(9, 1, 2, 34, 0, 7, 5, 7, 3, 0, 5, 7),
(9, 2, 4, 32, 0, 7, 5, 7, 5, 0, 3, 5),
(9, 3, 7, 29, 0, 7, 4, 6, 5, 0, 2, 5),
(9, 4, 6, 30, 0, 7, 3, 5, 7, 0, 3, 5),
(9, 5, 3, 33, 0, 7, 6, 7, 4, 0, 4, 5),
(9, 6, 6, 30, 0, 6, 4, 7, 6, 0, 4, 3),
(9, 8, 6, 30, 0, 7, 5, 7, 4, 0, 3, 4),
(9, 9, 5, 31, 0, 7, 2, 8, 5, 0, 4, 5),
(9, 10, 1, 39, 2, 8, 8, 7, 9, 0, 5, 4),
(10, 1, 7, 31, 0, 6, 6, 5, 6, 0, 2, 6),
(10, 2, 8, 30, 0, 6, 6, 3, 5, 0, 4, 6),
(10, 3, 4, 37, 0, 8, 3, 8, 8, 0, 2, 8),
(10, 4, 5, 36, 0, 6, 8, 7, 9, 0, 3, 3),
(10, 5, 6, 35, 0, 8, 3, 7, 8, 0, 3, 6),
(10, 6, 1, 42, 0, 9, 6, 8, 8, 0, 3, 8),
(10, 8, 2, 41, 0, 7, 8, 9, 7, 0, 2, 8),
(10, 9, 2, 41, 0, 6, 8, 6, 8, 0, 5, 8),
(10, 10, 3, 39, 2, 8, 7, 8, 6, 0, 5, 7),
(11, 1, 3, 38, 0, 7, 6, 8, 6, 0, 5, 6),
(11, 2, 5, 35, 0, 8, 6, 4, 8, 0, 3, 6),
(11, 3, 2, 39, 0, 8, 6, 8, 6, 0, 5, 6),
(11, 4, 3, 38, 0, 8, 6, 8, 6, 0, 5, 5),
(11, 5, 4, 37, 0, 7, 6, 8, 6, 0, 4, 6),
(11, 6, 4, 37, 0, 8, 6, 8, 7, 0, 1, 7),
(11, 8, 7, 26, 0, 0, 6, 6, 5, 0, 3, 6),
(11, 9, 6, 34, 0, 6, 8, 6, 6, 0, 1, 7),
(11, 10, 1, 41, 2, 9, 8, 6, 9, 0, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `bestcheerleader`
--

CREATE TABLE IF NOT EXISTS `bestcheerleader` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion24` int(11) NOT NULL DEFAULT '0',
  `criterion28` int(11) NOT NULL DEFAULT '0',
  `criterion29` int(11) NOT NULL DEFAULT '0',
  `criterion30` int(11) NOT NULL DEFAULT '0',
  `criterion31` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bestcheerleader`
--

INSERT INTO `bestcheerleader` (`judge_ID`, `acadOrg_ID`, `rank`, `total`, `deduction`, `criterion24`, `criterion28`, `criterion29`, `criterion30`, `criterion31`) VALUES
(2, 1, 2, 39, 0, 9, 6, 9, 6, 9),
(2, 2, 4, 36, 0, 6, 9, 6, 9, 6),
(2, 3, 3, 37, 0, 6, 9, 7, 9, 6),
(2, 4, 1, 40, 0, 9, 6, 9, 7, 9),
(2, 5, 6, 32, 0, 4, 7, 5, 8, 8),
(2, 6, 5, 34, 0, 8, 7, 5, 8, 6),
(2, 8, 7, 31, 0, 6, 8, 6, 4, 7),
(2, 9, 3, 37, 0, 9, 6, 8, 6, 8),
(2, 10, 4, 36, 0, 9, 7, 6, 8, 6),
(3, 1, 4, 26, 0, 6, 4, 6, 4, 6),
(3, 2, 6, 24, 0, 3, 6, 5, 6, 4),
(3, 3, 4, 26, 0, 3, 7, 5, 7, 4),
(3, 4, 2, 29, 0, 7, 4, 7, 4, 7),
(3, 5, 5, 25, 0, 4, 6, 6, 3, 6),
(3, 6, 1, 30, 0, 3, 7, 8, 5, 7),
(3, 8, 3, 28, 0, 7, 5, 7, 3, 6),
(3, 9, 2, 29, 0, 5, 7, 5, 7, 5),
(3, 10, 6, 24, 0, 8, 0, 8, 0, 8),
(4, 1, 3, 32, 0, 5, 7, 8, 6, 6),
(4, 2, 6, 28, 0, 9, 7, 4, 3, 5),
(4, 3, 5, 29, 0, 5, 7, 5, 7, 5),
(4, 4, 3, 32, 0, 7, 5, 7, 5, 8),
(4, 5, 4, 31, 0, 8, 3, 8, 5, 7),
(4, 6, 2, 34, 0, 6, 8, 6, 8, 6),
(4, 8, 5, 29, 0, 3, 7, 5, 8, 6),
(4, 9, 1, 36, 0, 8, 6, 8, 6, 8),
(4, 10, 1, 36, 0, 8, 6, 8, 6, 8),
(5, 1, 4, 32, 0, 6, 6, 7, 6, 7),
(5, 2, 1, 36, 0, 8, 9, 7, 6, 6),
(5, 3, 2, 34, 0, 7, 6, 7, 7, 7),
(5, 4, 5, 30, 0, 7, 5, 6, 5, 7),
(5, 5, 6, 26, 0, 3, 7, 6, 5, 5),
(5, 6, 1, 36, 0, 8, 7, 7, 6, 8),
(5, 8, 3, 33, 0, 6, 8, 6, 5, 8),
(5, 9, 4, 32, 0, 8, 6, 6, 5, 7),
(5, 10, 1, 36, 0, 7, 6, 8, 8, 7),
(6, 1, 1, 39, 0, 7, 9, 7, 9, 7),
(6, 2, 6, 27, 0, 4, 7, 7, 9, 0),
(6, 3, 4, 35, 0, 8, 5, 7, 9, 6),
(6, 4, 1, 39, 0, 9, 6, 9, 6, 9),
(6, 5, 5, 34, 0, 6, 8, 6, 8, 6),
(6, 6, 1, 39, 0, 9, 7, 8, 7, 8),
(6, 8, 2, 38, 0, 7, 8, 9, 6, 8),
(6, 9, 5, 34, 0, 6, 8, 6, 8, 6),
(6, 10, 3, 37, 0, 7, 6, 8, 9, 7),
(7, 1, 1, 40, 0, 9, 7, 9, 6, 9),
(7, 2, 4, 35, 0, 6, 8, 6, 9, 6),
(7, 3, 5, 34, 0, 6, 8, 6, 8, 6),
(7, 4, 3, 36, 0, 8, 6, 8, 6, 8),
(7, 5, 3, 36, 0, 7, 6, 8, 6, 9),
(7, 6, 6, 31, 0, 6, 8, 6, 3, 8),
(7, 8, 7, 29, 0, 7, 7, 5, 8, 2),
(7, 9, 7, 29, 0, 6, 7, 5, 3, 8),
(7, 10, 2, 38, 0, 8, 6, 9, 6, 9),
(8, 1, 1, 32, 0, 8, 5, 7, 6, 6),
(8, 2, 2, 31, 0, 5, 7, 5, 8, 6),
(8, 3, 3, 29, 0, 4, 6, 7, 5, 7),
(8, 4, 1, 32, 0, 5, 7, 5, 7, 8),
(8, 5, 3, 29, 0, 7, 5, 3, 8, 6),
(8, 6, 3, 29, 0, 6, 5, 3, 8, 7),
(8, 8, 5, 26, 0, 7, 5, 3, 5, 6),
(8, 9, 4, 28, 0, 4, 6, 4, 6, 8),
(8, 10, 3, 29, 0, 8, 6, 5, 4, 6),
(9, 1, 4, 27, 0, 6, 6, 8, 5, 2),
(9, 2, 4, 27, 0, 7, 5, 7, 3, 5),
(9, 3, 4, 27, 0, 7, 6, 5, 4, 5),
(9, 4, 5, 26, 0, 6, 8, 5, 2, 5),
(9, 5, 3, 28, 0, 7, 5, 7, 4, 5),
(9, 6, 2, 34, 0, 8, 9, 6, 4, 7),
(9, 8, 4, 27, 0, 7, 5, 6, 4, 5),
(9, 9, 6, 25, 0, 5, 7, 5, 3, 5),
(9, 10, 1, 36, 0, 8, 7, 9, 3, 9),
(10, 1, 2, 34, 0, 8, 5, 8, 5, 8),
(10, 2, 8, 25, 0, 8, 6, 4, 2, 5),
(10, 3, 6, 28, 0, 7, 5, 7, 4, 5),
(10, 4, 4, 30, 0, 8, 6, 7, 2, 7),
(10, 5, 8, 25, 0, 8, 6, 4, 2, 5),
(10, 6, 3, 32, 0, 9, 7, 6, 4, 6),
(10, 8, 5, 29, 0, 6, 8, 6, 3, 6),
(10, 9, 1, 35, 0, 8, 6, 8, 5, 8),
(10, 10, 7, 27, 0, 7, 6, 5, 3, 6),
(11, 1, 7, 23, 0, 6, 5, 5, 5, 2),
(11, 2, 6, 32, 0, 7, 5, 7, 6, 7),
(11, 3, 3, 37, 0, 8, 6, 9, 6, 8),
(11, 4, 5, 33, 0, 5, 8, 6, 8, 6),
(11, 5, 4, 35, 0, 4, 7, 9, 9, 6),
(11, 6, 1, 40, 0, 8, 7, 9, 7, 9),
(11, 8, 6, 32, 0, 7, 7, 6, 5, 7),
(11, 9, 2, 39, 0, 7, 9, 7, 9, 7),
(11, 10, 4, 35, 0, 8, 7, 6, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `bestfemalemodel`
--

CREATE TABLE IF NOT EXISTS `bestfemalemodel` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestinlonggown`
--

CREATE TABLE IF NOT EXISTS `bestinlonggown` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestinproductionnumber`
--

CREATE TABLE IF NOT EXISTS `bestinproductionnumber` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestinswimsuit`
--

CREATE TABLE IF NOT EXISTS `bestinswimsuit` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestmalemodel`
--

CREATE TABLE IF NOT EXISTS `bestmalemodel` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestmodellinggroup`
--

CREATE TABLE IF NOT EXISTS `bestmodellinggroup` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contestevent`
--

CREATE TABLE IF NOT EXISTS `contestevent` (
  `event_ID` int(11) NOT NULL,
  `eventName` varchar(50) NOT NULL,
  `weight_ID` int(11) NOT NULL,
  `venue_ID` int(11) NOT NULL,
  `eventCode` varchar(9) NOT NULL,
  `judgingSystem` int(2) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestevent`
--

INSERT INTO `contestevent` (`event_ID`, `eventName`, `weight_ID`, `venue_ID`, `eventCode`, `judgingSystem`, `date`) VALUES
(14, 'Cheering', 1, 1, 'O6vG6qO6f', 1, '2015-10-15'),
(15, 'Sayaw', 4, 1, 'G3rH2cO6g', NULL, '2015-10-15'),
(16, 'HASA', 4, 3, 'D7mH5eR9f', NULL, '2015-10-20'),
(17, 'Modern Dance', 4, 3, 'C6lG3nH3j', 0, '2015-10-25'),
(18, 'Poetry in Motion', 4, 3, 'Q5vY9vI3b', NULL, '2015-10-15'),
(19, 'IRAMPA', 4, 1, 'G0oU4vV7j', NULL, '2015-10-24'),
(20, 'Vocal Duet', 6, 3, 'N8tR3nZ8v', NULL, '2015-10-10'),
(21, 'Oration', 6, 1, 'A9iP3gY0z', NULL, '2015-10-11'),
(22, 'Extemporaneous Speaking', 6, 1, 'A9dV7xC3s', NULL, '2015-10-14'),
(23, 'Essay Writing', 6, 1, 'E7qJ4nB8w', NULL, '2015-10-11'),
(24, 'Lapuchack', 6, 1, 'F5sG1sC7h', NULL, '2015-10-17'),
(28, 'Acapella', 4, 3, 'Q9dR9mB6u', NULL, '2015-10-11'),
(29, 'Impromptu Dialogo', 5, 2, 'T0pI0zY1d', NULL, '2015-10-29'),
(30, 'Sipa', 2, 0, 'B3jX1bC0b', NULL, '2015-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
  `cri_ID` int(11) NOT NULL,
  `criterion` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`cri_ID`, `criterion`) VALUES
(21, 'Mastery (Unity and Discipline)'),
(22, 'Wit and Humor'),
(23, 'Volume'),
(24, 'Costume'),
(25, 'Audience Impact'),
(26, 'Concept (Social Relevance, Theme, Creativity)'),
(27, 'Costume'),
(28, 'Ability to Direct the Team/Group'),
(29, 'Showmanship (Humor with Taste) '),
(30, 'Voice (Timbre, Resonance)'),
(31, 'Interpretation'),
(32, 'Choreography'),
(33, 'Mastery, Timing and Coordination'),
(34, 'Routine'),
(35, 'Stage Presence'),
(36, 'Style in Rendering'),
(37, 'Creativity'),
(38, 'Relevance to the Theme'),
(39, 'Overall Impact'),
(40, 'Endurance'),
(41, 'Consistency'),
(42, 'Technique'),
(43, 'Content and Relevance to the Concept'),
(44, 'Delivery'),
(45, 'Voice Quality'),
(46, 'Interpretation, Originality, Ceativity'),
(47, 'Timing and Coordination');

-- --------------------------------------------------------

--
-- Table structure for table `criteriacon`
--

CREATE TABLE IF NOT EXISTS `criteriacon` (
  `cri_ID` int(11) NOT NULL,
  `contest_ID` int(11) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteriacon`
--

INSERT INTO `criteriacon` (`cri_ID`, `contest_ID`, `percentage`) VALUES
(21, 26, 25),
(22, 26, 15),
(23, 26, 10),
(24, 26, 10),
(24, 27, 10),
(24, 29, 15),
(25, 26, 5),
(25, 29, 5),
(25, 38, 5),
(25, 39, 10),
(26, 26, 35),
(28, 27, 25),
(29, 27, 25),
(30, 27, 15),
(31, 27, 25),
(32, 29, 25),
(32, 30, 25),
(32, 32, 25),
(33, 29, 25),
(34, 29, 20),
(35, 29, 10),
(35, 38, 10),
(35, 39, 20),
(36, 31, 30),
(37, 31, 30),
(38, 31, 30),
(39, 31, 10),
(40, 30, 25),
(40, 32, 25),
(41, 30, 25),
(41, 32, 25),
(42, 30, 25),
(42, 32, 25),
(43, 39, 35),
(44, 39, 35),
(45, 38, 35),
(46, 38, 30),
(47, 38, 20);

-- --------------------------------------------------------

--
-- Table structure for table `eventsponsor`
--

CREATE TABLE IF NOT EXISTS `eventsponsor` (
  `event_ID` int(11) NOT NULL,
  `sponsor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventsponsor`
--

INSERT INTO `eventsponsor` (`event_ID`, `sponsor_ID`) VALUES
(14, 12),
(14, 13),
(23, 14),
(19, 15),
(19, 16),
(24, 17),
(29, 17),
(24, 18),
(16, 19),
(19, 20),
(28, 20),
(19, 21),
(28, 21),
(21, 22),
(22, 22),
(21, 23),
(22, 23),
(23, 23),
(17, 24),
(18, 24),
(20, 24),
(28, 24),
(15, 25),
(23, 25),
(21, 26),
(15, 27),
(24, 27),
(14, 29),
(16, 30),
(20, 30),
(15, 31),
(17, 36);

-- --------------------------------------------------------

--
-- Table structure for table `impromptudialogo`
--

CREATE TABLE IF NOT EXISTS `impromptudialogo` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion43` int(11) NOT NULL DEFAULT '0',
  `criterion44` int(11) NOT NULL DEFAULT '0',
  `criterion35` int(11) NOT NULL DEFAULT '0',
  `criterion25` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `joinevent`
--

CREATE TABLE IF NOT EXISTS `joinevent` (
  `acadOrg_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `orderNum` int(11) NOT NULL,
  `eventTotal` int(11) NOT NULL DEFAULT '0',
  `eventRank` int(11) NOT NULL,
  `eventDeduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joinevent`
--

INSERT INTO `joinevent` (`acadOrg_ID`, `event_ID`, `orderNum`, `eventTotal`, `eventRank`, `eventDeduction`) VALUES
(1, 14, 9, 44, 6, 0),
(1, 17, 0, 30, 2, 0),
(2, 14, 8, 51, 8, 0),
(3, 14, 6, 39, 4, 0),
(4, 14, 8, 37, 3, 0),
(5, 14, 5, 46, 7, 0),
(6, 14, 2, 33, 2, 0),
(8, 14, 4, 40, 5, 0),
(8, 17, 0, 46, 1, 0),
(9, 14, 3, 26, 1, 0),
(10, 14, 1, 40, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE IF NOT EXISTS `judge` (
  `judge_ID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL DEFAULT ' ',
  `lastName` varchar(30) NOT NULL DEFAULT ' ',
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`judge_ID`, `firstName`, `lastName`, `username`, `password`) VALUES
(0, ' Dummy', ' Dummy', 'Dummy', 'bcf036b6f33e182d4705f4f5b1af13ac'),
(2, 'Jason', 'Bajade', 'jason', 'c4ca4238a0b923820dcc509a6f75849b'),
(3, 'Jessica Marie', 'Valderrama', 'jess', 'c4ca4238a0b923820dcc509a6f75849b'),
(4, 'Ivan', 'Canonicato', 'ivan', 'c4ca4238a0b923820dcc509a6f75849b'),
(5, 'Shaira', 'Bataga', 'shaira', 'c4ca4238a0b923820dcc509a6f75849b'),
(6, 'Gianfranco', 'Olofernes', 'gian', 'c4ca4238a0b923820dcc509a6f75849b'),
(7, 'Charles Francis', 'Aposaga', 'charles', 'c4ca4238a0b923820dcc509a6f75849b'),
(8, 'Janine', 'de la Paz', 'janine', 'c4ca4238a0b923820dcc509a6f75849b'),
(9, 'Mary Christine', 'Valderrama', 'mare', 'c4ca4238a0b923820dcc509a6f75849b'),
(10, 'Kent Paolo', 'Ilogon', 'kent', 'c4ca4238a0b923820dcc509a6f75849b'),
(11, 'Bryle Kristian', 'Camarote', 'bryle', 'c4ca4238a0b923820dcc509a6f75849b'),
(12, 'Nilo', 'Araneta', 'nilo', 'c4ca4238a0b923820dcc509a6f75849b'),
(13, 'Alexandra', 'Degala', 'alex', 'c4ca4238a0b923820dcc509a6f75849b'),
(14, 'Chrevic Josef', 'Dangan', 'chrevic', 'c4ca4238a0b923820dcc509a6f75849b'),
(15, 'Almie', 'Carajay', 'almie', 'c4ca4238a0b923820dcc509a6f75849b'),
(16, 'Francis Earl', 'Valdehuesa', 'frae', 'c81e728d9d4c2f636f067f89cc14862c'),
(17, 'Elemar', 'Teje', 'elemar', 'c4ca4238a0b923820dcc509a6f75849b'),
(18, 'Ruben', 'Gamala', 'ruben', 'c4ca4238a0b923820dcc509a6f75849b'),
(19, 'Romel', 'Espinosa', 'romel', 'c4ca4238a0b923820dcc509a6f75849b'),
(20, 'Rica', 'Cainglet', 'rica', 'c4ca4238a0b923820dcc509a6f75849b'),
(21, 'Rei', 'Hontanar', 'rei', 'c4ca4238a0b923820dcc509a6f75849b'),
(22, 'Stiffany Jane', 'Tumapon', 'stiff', 'c4ca4238a0b923820dcc509a6f75849b'),
(23, 'Brechelle Grace', 'Payongayong', 'brechelle', 'c4ca4238a0b923820dcc509a6f75849b'),
(24, 'Christian', 'Catalan', 'x', 'c4ca4238a0b923820dcc509a6f75849b'),
(25, 'Jesse', 'Cogollo', 'jesse', 'c4ca4238a0b923820dcc509a6f75849b'),
(26, 'Jose Maria Paolo', 'Santos', 'pao', 'c4ca4238a0b923820dcc509a6f75849b'),
(27, 'Benigno Simeon', 'Aquino', 'pnoy', 'c4ca4238a0b923820dcc509a6f75849b'),
(28, 'Mar', 'Roxas', 'mar', 'c4ca4238a0b923820dcc509a6f75849b'),
(29, 'Rodrigo', 'Duterte', 'duterte', 'c4ca4238a0b923820dcc509a6f75849b'),
(30, 'Miriam', 'Santiago', 'miriam', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `judgeevent`
--

CREATE TABLE IF NOT EXISTS `judgeevent` (
  `event_ID` int(11) NOT NULL,
  `judge_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judgeevent`
--

INSERT INTO `judgeevent` (`event_ID`, `judge_ID`) VALUES
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(14, 9),
(14, 10),
(14, 11),
(17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `lapuchak`
--

CREATE TABLE IF NOT EXISTS `lapuchak` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion36` int(11) NOT NULL DEFAULT '0',
  `criterion37` int(11) NOT NULL DEFAULT '0',
  `criterion38` int(11) NOT NULL DEFAULT '0',
  `criterion39` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `latindance`
--

CREATE TABLE IF NOT EXISTS `latindance` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion40` int(11) NOT NULL DEFAULT '0',
  `criterion41` int(11) NOT NULL DEFAULT '0',
  `criterion32` int(11) NOT NULL DEFAULT '0',
  `criterion42` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moderndance`
--

CREATE TABLE IF NOT EXISTS `moderndance` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion32` int(11) NOT NULL DEFAULT '0',
  `criterion33` int(11) NOT NULL DEFAULT '0',
  `criterion34` int(11) NOT NULL DEFAULT '0',
  `criterion24` int(11) NOT NULL DEFAULT '0',
  `criterion35` int(11) NOT NULL DEFAULT '0',
  `criterion25` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderndance`
--

INSERT INTO `moderndance` (`judge_ID`, `acadOrg_ID`, `rank`, `total`, `deduction`, `criterion32`, `criterion33`, `criterion34`, `criterion24`, `criterion35`, `criterion25`) VALUES
(12, 1, 2, 30, 0, 0, 7, 7, 6, 7, 3),
(12, 8, 1, 46, 0, 7, 8, 9, 8, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `modernstandard`
--

CREATE TABLE IF NOT EXISTS `modernstandard` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `criterion32` int(11) NOT NULL DEFAULT '0',
  `criterion40` int(11) NOT NULL DEFAULT '0',
  `criterion41` int(11) NOT NULL DEFAULT '0',
  `criterion42` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poetryinmotion`
--

CREATE TABLE IF NOT EXISTS `poetryinmotion` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specificcontest`
--

CREATE TABLE IF NOT EXISTS `specificcontest` (
  `contest_ID` int(11) NOT NULL,
  `contestName` varchar(40) NOT NULL DEFAULT ' ',
  `event_ID` int(11) NOT NULL,
  `main` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specificcontest`
--

INSERT INTO `specificcontest` (`contest_ID`, `contestName`, `event_ID`, `main`) VALUES
(26, 'Best Cheering Group', 14, 1),
(27, 'Best Cheerleader', 14, 0),
(29, 'Modern Dance', 17, 1),
(30, 'Latin Dance', 15, 1),
(31, 'Lapuchak', 24, 1),
(32, 'Modern Standard', 15, 0),
(33, 'Best Modelling Group', 19, 1),
(34, 'Best Female Model', 19, 0),
(35, 'Best Male Model', 19, 0),
(36, 'Poetry in Motion', 18, 1),
(37, 'Vocal Duet', 20, 1),
(38, 'Acapella', 28, 1),
(39, 'Impromptu Dialogo', 29, 1),
(40, 'Best in Production Number', 16, 0),
(41, 'Best in Swimsuit', 16, 0),
(42, 'Best in Long Gown', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `sponsor_ID` int(11) NOT NULL,
  `sponsorName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsor_ID`, `sponsorName`, `username`, `password`) VALUES
(12, 'Silab Sisterhood', 'silab', '4383e2860004101b11b7e738fba4c38f'),
(13, 'Silak Brotherhood', 'silak', 'b44d277f172fb4f639beeee859f7e732'),
(14, 'UPV Debate Society', 'debscoc', 'ec14f69ff4baf76d2a1caf920b6d2e6d'),
(15, 'DUCES', 'duces', '291302837e27a39aa665dfca75570849'),
(16, 'University Student Council', 'usc', '9358ee7c06a9463adfe0c9e8ab6c2257'),
(17, 'UP Fisheries Guild', 'upfg', 'dda32d02802c382f040f5855df65341e'),
(18, 'UP Ichthyophilic Society', 'upis', 'aca87754a70304ce3dd27b771a00e8b1'),
(19, 'Validus Amecita Brotherhood', 'va', '43b1cc1db7be63d899dd4280f578691a'),
(20, 'Scintilla Juris Brotherhood', 'sjb', '9071791b3ac926cffdb32147c75af7d6'),
(21, 'Stella Juris Sisterhood', 'sjs', 'a1d2e8381323da392803e751bbcf5461'),
(22, 'Debate Circle', 'debcir', 'd8a2f535a30cdfec41fed825235bd0a4'),
(23, 'Beta Sigma Sorority', 'betsig', '276d79543b1d094ec26a2ddd279d59d5'),
(24, 'Alpha Phi Omega', 'apo', 'b89d50982acb4cf66aaf7647bdb6e82d'),
(25, 'JPMAP', 'jpmap', 'a5e7f6dcded152a3e9bd8dd8e4f299be'),
(26, 'UPV Math Circle', 'mathcircle', '9ef1c5890b3dc81d377223445ca6844c'),
(27, 'Chemistry Society', 'chemsoc', '4f082ac9dcf54f5bf45caddc031eac88'),
(28, 'Statistical Society', 'statsoc', 'a0cc489c1bf2548308378d6946ab4924'),
(29, 'KomSai.org', 'komsai', '4d9d25406439b9159f3ac0d0988aab22'),
(30, 'Biological Society', 'biosoc', 'f52f29e3b48b75defeb092ed2c1057d3'),
(31, 'Samahang Sikolohiya', 'samasik', '4ec4376722eea587230f38bec68aa04c'),
(32, 'UPV Kamaragtas', 'kamaragtas', '1434b25f1715495605395c5817ea18e4'),
(36, 'PH Pub', 'phpub', '12a14e7999305d0c7b50064cac2c107d');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venue_ID` int(11) NOT NULL,
  `venueName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_ID`, `venueName`) VALUES
(1, 'UPV Covered Court'),
(2, 'CFOS AV Hall'),
(3, 'UPV Auditorium');

-- --------------------------------------------------------

--
-- Table structure for table `vocalduet`
--

CREATE TABLE IF NOT EXISTS `vocalduet` (
  `judge_ID` int(11) NOT NULL,
  `acadOrg_ID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE IF NOT EXISTS `weight` (
  `weight_ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `maximum` int(11) NOT NULL,
  `decrement` decimal(5,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`weight_ID`, `name`, `maximum`, `decrement`) VALUES
(1, 'Major Event', 85, '5.00'),
(2, 'Minor Event', 40, '3.00'),
(3, 'Special Event', 20, '1.50'),
(4, 'Class A Event', 30, '1.50'),
(5, 'Class B Event', 20, '1.00'),
(6, 'Class C Event', 10, '0.50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicorg`
--
ALTER TABLE `academicorg`
  ADD PRIMARY KEY (`acadOrg_ID`);

--
-- Indexes for table `acapella`
--
ALTER TABLE `acapella`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `bestcheeringgroup`
--
ALTER TABLE `bestcheeringgroup`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestcheerleader`
--
ALTER TABLE `bestcheerleader`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestfemalemodel`
--
ALTER TABLE `bestfemalemodel`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestinlonggown`
--
ALTER TABLE `bestinlonggown`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestinproductionnumber`
--
ALTER TABLE `bestinproductionnumber`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestinswimsuit`
--
ALTER TABLE `bestinswimsuit`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestmalemodel`
--
ALTER TABLE `bestmalemodel`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `bestmodellinggroup`
--
ALTER TABLE `bestmodellinggroup`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `contestevent`
--
ALTER TABLE `contestevent`
  ADD PRIMARY KEY (`event_ID`,`weight_ID`,`venue_ID`), ADD KEY `weight_ID` (`weight_ID`), ADD KEY `venue_ID` (`venue_ID`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`cri_ID`);

--
-- Indexes for table `criteriacon`
--
ALTER TABLE `criteriacon`
  ADD PRIMARY KEY (`cri_ID`,`contest_ID`), ADD KEY `criteriacon_ibfk_2` (`contest_ID`);

--
-- Indexes for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
  ADD PRIMARY KEY (`event_ID`,`sponsor_ID`), ADD KEY `eventsponsor_ibfk_2` (`sponsor_ID`);

--
-- Indexes for table `impromptudialogo`
--
ALTER TABLE `impromptudialogo`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `joinevent`
--
ALTER TABLE `joinevent`
  ADD PRIMARY KEY (`acadOrg_ID`,`event_ID`), ADD KEY `event_ID` (`event_ID`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`judge_ID`);

--
-- Indexes for table `judgeevent`
--
ALTER TABLE `judgeevent`
  ADD PRIMARY KEY (`event_ID`,`judge_ID`), ADD KEY `judge_ID` (`judge_ID`);

--
-- Indexes for table `lapuchak`
--
ALTER TABLE `lapuchak`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `latindance`
--
ALTER TABLE `latindance`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `moderndance`
--
ALTER TABLE `moderndance`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `modernstandard`
--
ALTER TABLE `modernstandard`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `poetryinmotion`
--
ALTER TABLE `poetryinmotion`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `specificcontest`
--
ALTER TABLE `specificcontest`
  ADD PRIMARY KEY (`contest_ID`,`event_ID`), ADD UNIQUE KEY `contestName` (`contestName`), ADD KEY `specificcontest_ibfk_1` (`event_ID`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsor_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_ID`);

--
-- Indexes for table `vocalduet`
--
ALTER TABLE `vocalduet`
  ADD PRIMARY KEY (`judge_ID`,`acadOrg_ID`), ADD KEY `acadOrg_ID` (`acadOrg_ID`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`weight_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicorg`
--
ALTER TABLE `academicorg`
  MODIFY `acadOrg_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contestevent`
--
ALTER TABLE `contestevent`
  MODIFY `event_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `cri_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `judge_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `specificcontest`
--
ALTER TABLE `specificcontest`
  MODIFY `contest_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsor_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `weight_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acapella`
--
ALTER TABLE `acapella`
ADD CONSTRAINT `acapella_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `acapella_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestcheeringgroup`
--
ALTER TABLE `bestcheeringgroup`
ADD CONSTRAINT `bestcheeringgroup_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestcheeringgroup_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestcheerleader`
--
ALTER TABLE `bestcheerleader`
ADD CONSTRAINT `bestcheerleader_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestcheerleader_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestfemalemodel`
--
ALTER TABLE `bestfemalemodel`
ADD CONSTRAINT `bestfemalemodel_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestfemalemodel_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestinlonggown`
--
ALTER TABLE `bestinlonggown`
ADD CONSTRAINT `bestinlonggown_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestinlonggown_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestinproductionnumber`
--
ALTER TABLE `bestinproductionnumber`
ADD CONSTRAINT `bestinproductionnumber_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestinproductionnumber_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestinswimsuit`
--
ALTER TABLE `bestinswimsuit`
ADD CONSTRAINT `bestinswimsuit_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestinswimsuit_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestmalemodel`
--
ALTER TABLE `bestmalemodel`
ADD CONSTRAINT `bestmalemodel_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestmalemodel_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `bestmodellinggroup`
--
ALTER TABLE `bestmodellinggroup`
ADD CONSTRAINT `bestmodellinggroup_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `bestmodellinggroup_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `contestevent`
--
ALTER TABLE `contestevent`
ADD CONSTRAINT `contestevent_ibfk_1` FOREIGN KEY (`weight_ID`) REFERENCES `weight` (`weight_ID`);

--
-- Constraints for table `criteriacon`
--
ALTER TABLE `criteriacon`
ADD CONSTRAINT `criteriacon_ibfk_1` FOREIGN KEY (`cri_ID`) REFERENCES `criteria` (`cri_ID`),
ADD CONSTRAINT `criteriacon_ibfk_2` FOREIGN KEY (`contest_ID`) REFERENCES `specificcontest` (`contest_ID`) ON DELETE CASCADE;

--
-- Constraints for table `eventsponsor`
--
ALTER TABLE `eventsponsor`
ADD CONSTRAINT `eventsponsor_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `contestevent` (`event_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `eventsponsor_ibfk_2` FOREIGN KEY (`sponsor_ID`) REFERENCES `sponsor` (`sponsor_ID`) ON DELETE CASCADE;

--
-- Constraints for table `impromptudialogo`
--
ALTER TABLE `impromptudialogo`
ADD CONSTRAINT `impromptudialogo_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `impromptudialogo_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `joinevent`
--
ALTER TABLE `joinevent`
ADD CONSTRAINT `joinevent_ibfk_1` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`),
ADD CONSTRAINT `joinevent_ibfk_2` FOREIGN KEY (`event_ID`) REFERENCES `contestevent` (`event_ID`);

--
-- Constraints for table `judgeevent`
--
ALTER TABLE `judgeevent`
ADD CONSTRAINT `judgeevent_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `contestevent` (`event_ID`),
ADD CONSTRAINT `judgeevent_ibfk_2` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`);

--
-- Constraints for table `lapuchak`
--
ALTER TABLE `lapuchak`
ADD CONSTRAINT `lapuchak_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `lapuchak_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `latindance`
--
ALTER TABLE `latindance`
ADD CONSTRAINT `latindance_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `latindance_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `moderndance`
--
ALTER TABLE `moderndance`
ADD CONSTRAINT `moderndance_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `moderndance_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `modernstandard`
--
ALTER TABLE `modernstandard`
ADD CONSTRAINT `modernstandard_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `modernstandard_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `poetryinmotion`
--
ALTER TABLE `poetryinmotion`
ADD CONSTRAINT `poetryinmotion_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `poetryinmotion_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

--
-- Constraints for table `specificcontest`
--
ALTER TABLE `specificcontest`
ADD CONSTRAINT `specificcontest_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `contestevent` (`event_ID`) ON DELETE CASCADE;

--
-- Constraints for table `vocalduet`
--
ALTER TABLE `vocalduet`
ADD CONSTRAINT `vocalduet_ibfk_1` FOREIGN KEY (`judge_ID`) REFERENCES `judge` (`judge_ID`),
ADD CONSTRAINT `vocalduet_ibfk_2` FOREIGN KEY (`acadOrg_ID`) REFERENCES `academicorg` (`acadOrg_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
