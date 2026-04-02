-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2026 at 12:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `install`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fullname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fullname`, `admin_email`, `admin_phone`, `admin_address`, `admin_username`, `admin_password`) VALUES
(2, 'Harsh Modi', 'harsh@gmail.com', '1236547893', 'xyz', 'Harsh', '123@Harsh'),
(3, 'Admin User', '', '', '', 'admin', 'admin'),
(4, 'het modi', '', '', '', 'het', 'het');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`site_id`, `site_name`, `site_logo`, `currency`) VALUES
(2, 'Vehicle Parking System', NULL, '₹');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `parking_number` int(11) NOT NULL,
  `vehicle_cat` int(11) NOT NULL,
  `vehicle_company` varchar(255) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_contact` varchar(255) NOT NULL,
  `vehicle_intime` datetime NOT NULL,
  `vehicle_outtime` datetime DEFAULT NULL,
  `parking_charges` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `vehicle_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `parking_number`, `vehicle_cat`, `vehicle_company`, `reg_number`, `owner_name`, `owner_contact`, `vehicle_intime`, `vehicle_outtime`, `parking_charges`, `remark`, `vehicle_status`) VALUES
(14, 8513, 1, 'BMW', '8513', 'het', '1236547891', '2026-03-19 08:14:58', NULL, 100, 'no', 1),
(15, 1861, 3, 'BMW', '8513', 'harsh', '1234567890', '2026-03-01 15:47:33', '2026-03-23 15:47:33', 20, NULL, 0),
(16, 7944, 3, 'Tata', '8653', 'kenil', '1542639874', '2026-03-01 00:00:00', NULL, NULL, NULL, 0),
(17, 3315, 3, 'Suzuki ', '1525', 'bhargav', '1524638974', '2026-03-23 16:27:04', '2026-03-27 10:32:12', NULL, NULL, 1),
(18, 9850, 3, 'Lamborghini ', '0085', 'harshil', '1563248975', '2026-03-01 00:00:00', '2026-04-01 12:22:56', NULL, NULL, 1),
(19, 4147, 7, 'honda', '5642', 'hemil', '5269856412', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(20, 2027, 3, 'tata', '6985', 'kartik', '4569325874', '2026-04-01 15:48:26', '2026-04-01 16:51:20', NULL, NULL, 1),
(21, 8692, 7, 'tvs', '4569', 'darshan', '2589632145', '2026-04-01 15:48:26', '2026-04-01 16:51:20', NULL, NULL, 1),
(22, 1255, 3, 'maruti suzuki', '8532', 'haresh', '2563987452', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(23, 3841, 3, 'bmw', '5265', 'dev', '4585963258', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(24, 2454, 3, 'lemborgini', '4569', 'harsh', '9157738653', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(25, 6849, 7, 'sign', '0014', 'harit', '2563417896', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(26, 9903, 3, 'bently', '9865', 'het', '6589741236', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(27, 6154, 7, 'honda', '5655', 'harit', '9145826535', '2026-04-01 15:48:26', NULL, NULL, NULL, 0),
(28, 9678, 4, 'bmw', '8888', 'Bhargavi ', '222222222', '2026-04-01 15:48:26', '2026-04-01 13:22:25', NULL, NULL, 1),
(29, 1295, 7, 'royal eengine ', '00236', 'divy', '6352418974', '2026-04-01 13:25:49', NULL, NULL, NULL, 0),
(30, 3188, 3, 'kia', '2563', 'spider men', '8569741235', '2026-04-01 13:52:38', NULL, NULL, NULL, 0),
(31, 8923, 4, 'xdfe', '58527', 'fgdsgg ', '7418529638', '2026-04-01 14:03:52', NULL, NULL, NULL, 0),
(32, 7218, 3, 'fewsdf', '4458', 'harsh', '2589631478', '2026-04-01 17:46:47', '2026-04-01 17:47:28', NULL, NULL, 1),
(33, 7104, 7, 'java', '2534', 'kenil', '8273645137', '2026-04-02 16:15:52', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_category`
--

CREATE TABLE `vehicle_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parking_charge` int(11) NOT NULL,
  `category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_category`
--

INSERT INTO `vehicle_category` (`id`, `category_name`, `parking_charge`, `category_status`) VALUES
(3, 'cars', 80, 1),
(4, 'BMW', 50, 0),
(5, 'TATA', 20, 0),
(6, 'Suzuki ', 30, 0),
(7, 'bike', 20, 1),
(8, 'activa', 30, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
