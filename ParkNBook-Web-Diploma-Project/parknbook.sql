-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2025 at 03:01 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parknbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `psd` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `email`, `psd`) VALUES
(101, 'Admin223@gmail.com', 'Admin_1234');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slot_id` int DEFAULT NULL,
  `parking_id` int DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `vno` varchar(20) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slot_id` (`slot_id`),
  KEY `parking_id` (`parking_id`),
  KEY `cid` (`cid`),
  KEY `vno` (`vno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `slot_id`, `parking_id`, `cid`, `vno`, `booking_date`, `start_time`, `end_time`) VALUES
(1, 5, 1, 1, '3931-ry', '2025-05-14', '14:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `psd` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cname`, `email`, `psd`, `phone`) VALUES
(1, 'Marwa', 'marwa22@gmail.com', '$2y$10$qNzvvf6yrlCB8GlRHgBvYeXRswj8ozSKgJ6fpq1Huq.NtilbtGVSy', '23354422');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `rating` int NOT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fid`),
  KEY `fk_feedback_customer` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `cid`, `rating`, `feedback`) VALUES
(1, 1, 5, 'Thank you for your services');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
CREATE TABLE IF NOT EXISTS `parking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_parking_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `name`, `price`) VALUES
(1, 'P01', 1),
(2, 'P02', 1),
(3, 'P03', 1),
(4, 'P04', 1),
(5, 'P05', 1),
(6, 'P06', 1),
(7, 'P07', 1),
(8, 'P08', 1),
(9, 'P09', 1),
(10, 'P10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parking_slots`
--

DROP TABLE IF EXISTS `parking_slots`;
CREATE TABLE IF NOT EXISTS `parking_slots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parking_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `slot_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parking_id` (`parking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parking_slots`
--

INSERT INTO `parking_slots` (`id`, `parking_id`, `start_time`, `end_time`, `slot_date`) VALUES
(1, 1, '10:00:00', '11:00:00', '2025-05-14'),
(2, 1, '11:00:00', '12:00:00', '2025-05-14'),
(3, 1, '12:00:00', '13:00:00', '2025-05-14'),
(4, 1, '13:00:00', '14:00:00', '2025-05-14'),
(5, 1, '14:00:00', '15:00:00', '2025-05-14'),
(6, 1, '15:00:00', '16:00:00', '2025-05-14'),
(7, 1, '16:00:00', '17:00:00', '2025-05-14'),
(8, 1, '17:00:00', '18:00:00', '2025-05-14'),
(9, 1, '18:00:00', '19:00:00', '2025-05-14'),
(10, 1, '19:00:00', '20:00:00', '2025-05-14'),
(11, 1, '20:00:00', '21:00:00', '2025-05-14'),
(12, 1, '21:00:00', '22:00:00', '2025-05-14'),
(13, 2, '10:00:00', '11:00:00', '2025-05-14'),
(14, 2, '11:00:00', '12:00:00', '2025-05-14'),
(15, 2, '12:00:00', '13:00:00', '2025-05-14'),
(16, 2, '13:00:00', '14:00:00', '2025-05-14'),
(17, 2, '14:00:00', '15:00:00', '2025-05-14'),
(18, 2, '15:00:00', '16:00:00', '2025-05-14'),
(19, 2, '16:00:00', '17:00:00', '2025-05-14'),
(20, 2, '17:00:00', '18:00:00', '2025-05-14'),
(21, 2, '18:00:00', '19:00:00', '2025-05-14'),
(22, 2, '19:00:00', '20:00:00', '2025-05-14'),
(23, 2, '20:00:00', '21:00:00', '2025-05-14'),
(24, 2, '21:00:00', '22:00:00', '2025-05-14'),
(25, 3, '10:00:00', '11:00:00', '2025-05-14'),
(26, 3, '11:00:00', '12:00:00', '2025-05-14'),
(27, 3, '12:00:00', '13:00:00', '2025-05-14'),
(28, 3, '13:00:00', '14:00:00', '2025-05-14'),
(29, 3, '14:00:00', '15:00:00', '2025-05-14'),
(30, 3, '15:00:00', '16:00:00', '2025-05-14'),
(31, 3, '16:00:00', '17:00:00', '2025-05-14'),
(32, 3, '17:00:00', '18:00:00', '2025-05-14'),
(33, 3, '18:00:00', '19:00:00', '2025-05-14'),
(34, 3, '19:00:00', '20:00:00', '2025-05-14'),
(35, 3, '20:00:00', '21:00:00', '2025-05-14'),
(36, 3, '21:00:00', '22:00:00', '2025-05-14'),
(37, 4, '10:00:00', '11:00:00', '2025-05-14'),
(38, 4, '11:00:00', '12:00:00', '2025-05-14'),
(39, 4, '12:00:00', '13:00:00', '2025-05-14'),
(40, 4, '13:00:00', '14:00:00', '2025-05-14'),
(41, 4, '14:00:00', '15:00:00', '2025-05-14'),
(42, 4, '15:00:00', '16:00:00', '2025-05-14'),
(43, 4, '16:00:00', '17:00:00', '2025-05-14'),
(44, 4, '17:00:00', '18:00:00', '2025-05-14'),
(45, 4, '18:00:00', '19:00:00', '2025-05-14'),
(46, 4, '19:00:00', '20:00:00', '2025-05-14'),
(47, 4, '20:00:00', '21:00:00', '2025-05-14'),
(48, 4, '21:00:00', '22:00:00', '2025-05-14'),
(49, 5, '10:00:00', '11:00:00', '2025-05-14'),
(50, 5, '11:00:00', '12:00:00', '2025-05-14'),
(51, 5, '12:00:00', '13:00:00', '2025-05-14'),
(52, 5, '13:00:00', '14:00:00', '2025-05-14'),
(53, 5, '14:00:00', '15:00:00', '2025-05-14'),
(54, 5, '15:00:00', '16:00:00', '2025-05-14'),
(55, 5, '16:00:00', '17:00:00', '2025-05-14'),
(56, 5, '17:00:00', '18:00:00', '2025-05-14'),
(57, 5, '18:00:00', '19:00:00', '2025-05-14'),
(58, 5, '19:00:00', '20:00:00', '2025-05-14'),
(59, 5, '20:00:00', '21:00:00', '2025-05-14'),
(60, 5, '21:00:00', '22:00:00', '2025-05-14'),
(61, 6, '10:00:00', '11:00:00', '2025-05-14'),
(62, 6, '11:00:00', '12:00:00', '2025-05-14'),
(63, 6, '12:00:00', '13:00:00', '2025-05-14'),
(64, 6, '13:00:00', '14:00:00', '2025-05-14'),
(65, 6, '14:00:00', '15:00:00', '2025-05-14'),
(66, 6, '15:00:00', '16:00:00', '2025-05-14'),
(67, 6, '16:00:00', '17:00:00', '2025-05-14'),
(68, 6, '17:00:00', '18:00:00', '2025-05-14'),
(69, 6, '18:00:00', '19:00:00', '2025-05-14'),
(70, 6, '19:00:00', '20:00:00', '2025-05-14'),
(71, 6, '20:00:00', '21:00:00', '2025-05-14'),
(72, 6, '21:00:00', '22:00:00', '2025-05-14'),
(73, 7, '10:00:00', '11:00:00', '2025-05-14'),
(74, 7, '11:00:00', '12:00:00', '2025-05-14'),
(75, 7, '12:00:00', '13:00:00', '2025-05-14'),
(76, 7, '13:00:00', '14:00:00', '2025-05-14'),
(77, 7, '14:00:00', '15:00:00', '2025-05-14'),
(78, 7, '15:00:00', '16:00:00', '2025-05-14'),
(79, 7, '16:00:00', '17:00:00', '2025-05-14'),
(80, 7, '17:00:00', '18:00:00', '2025-05-14'),
(81, 7, '18:00:00', '19:00:00', '2025-05-14'),
(82, 7, '19:00:00', '20:00:00', '2025-05-14'),
(83, 7, '20:00:00', '21:00:00', '2025-05-14'),
(84, 7, '21:00:00', '22:00:00', '2025-05-14'),
(85, 8, '10:00:00', '11:00:00', '2025-05-14'),
(86, 8, '11:00:00', '12:00:00', '2025-05-14'),
(87, 8, '12:00:00', '13:00:00', '2025-05-14'),
(88, 8, '13:00:00', '14:00:00', '2025-05-14'),
(89, 8, '14:00:00', '15:00:00', '2025-05-14'),
(90, 8, '15:00:00', '16:00:00', '2025-05-14'),
(91, 8, '16:00:00', '17:00:00', '2025-05-14'),
(92, 8, '17:00:00', '18:00:00', '2025-05-14'),
(93, 8, '18:00:00', '19:00:00', '2025-05-14'),
(94, 8, '19:00:00', '20:00:00', '2025-05-14'),
(95, 8, '20:00:00', '21:00:00', '2025-05-14'),
(96, 8, '21:00:00', '22:00:00', '2025-05-14'),
(97, 9, '10:00:00', '11:00:00', '2025-05-14'),
(98, 9, '11:00:00', '12:00:00', '2025-05-14'),
(99, 9, '12:00:00', '13:00:00', '2025-05-14'),
(100, 9, '13:00:00', '14:00:00', '2025-05-14'),
(101, 9, '14:00:00', '15:00:00', '2025-05-14'),
(102, 9, '15:00:00', '16:00:00', '2025-05-14'),
(103, 9, '16:00:00', '17:00:00', '2025-05-14'),
(104, 9, '17:00:00', '18:00:00', '2025-05-14'),
(105, 9, '18:00:00', '19:00:00', '2025-05-14'),
(106, 9, '19:00:00', '20:00:00', '2025-05-14'),
(107, 9, '20:00:00', '21:00:00', '2025-05-14'),
(108, 9, '21:00:00', '22:00:00', '2025-05-14'),
(109, 10, '10:00:00', '11:00:00', '2025-05-14'),
(110, 10, '11:00:00', '12:00:00', '2025-05-14'),
(111, 10, '12:00:00', '13:00:00', '2025-05-14'),
(112, 10, '13:00:00', '14:00:00', '2025-05-14'),
(113, 10, '14:00:00', '15:00:00', '2025-05-14'),
(114, 10, '15:00:00', '16:00:00', '2025-05-14'),
(115, 10, '16:00:00', '17:00:00', '2025-05-14'),
(116, 10, '17:00:00', '18:00:00', '2025-05-14'),
(117, 10, '18:00:00', '19:00:00', '2025-05-14'),
(118, 10, '19:00:00', '20:00:00', '2025-05-14'),
(119, 10, '20:00:00', '21:00:00', '2025-05-14'),
(120, 10, '21:00:00', '22:00:00', '2025-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `Card_Number` int NOT NULL,
  `Booking_ID` int DEFAULT NULL,
  `CVV` int NOT NULL,
  `Expiry_Date` date NOT NULL,
  `Total_Payment` float(10,2) NOT NULL,
  PRIMARY KEY (`Card_Number`),
  KEY `Booking_ID` (`Booking_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vno` varchar(20) NOT NULL,
  `cid` int NOT NULL,
  `type` varchar(20) NOT NULL,
  `model` varchar(30) NOT NULL,
  PRIMARY KEY (`vno`),
  KEY `fk_customer` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vno`, `cid`, `type`, `model`) VALUES
('3931-ry', 1, 'bmw', 'q1');

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `update_slot_date_daily`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_slot_date_daily` ON SCHEDULE EVERY 1 DAY STARTS '2025-05-13 09:56:27' ON COMPLETION PRESERVE ENABLE DO UPDATE parking_slots 
  SET slot_date = CURRENT_DATE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
