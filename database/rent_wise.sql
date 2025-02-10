-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 02:47 PM
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
-- Database: `rent_wise`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'Admin',
  `email` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `username`, `email`, `mobile`, `city`, `address`, `password`, `photo`) VALUES
(1, 'Kishan', 'rana12@gmail.com', '6353978865', 'Patan', '', 'kishan123', 'IMG-646128bc664185.97735029.jpg'),
(2, 'Admin', 'utsavmodi000@gmail.com', '9428892111', 'Patan', 'Rajvi Bungalows, near Pareva Circle, Patan.', 'admin123', 'IMG-6795c36fcbcef1.56192631.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bk_id` smallint(6) NOT NULL,
  `u_id` smallint(5) NOT NULL,
  `pr_id` smallint(5) NOT NULL,
  `bk_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `sr_id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fav_property`
--

CREATE TABLE `fav_property` (
  `f_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `pr_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav_property`
--

INSERT INTO `fav_property` (`f_id`, `u_id`, `pr_id`) VALUES
(44, 19, 164);

-- --------------------------------------------------------

--
-- Table structure for table `my_orders`
--

CREATE TABLE `my_orders` (
  `o_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `pr_id` smallint(5) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_orders`
--

INSERT INTO `my_orders` (`o_id`, `u_id`, `pr_id`, `o_date`) VALUES
(9, 21, 162, '2025-02-07 09:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `pr_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `area` varchar(30) NOT NULL,
  `society` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pro_no` varchar(10) NOT NULL,
  `rent_sell` varchar(4) NOT NULL,
  `p_space` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'aquired or not',
  `p_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` point DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`pr_id`, `u_id`, `city`, `area`, `society`, `type`, `pro_no`, `rent_sell`, `p_space`, `price`, `description`, `status`, `p_date`, `location`) VALUES
(158, 19, 'Sample City', 'Sample Area', 'Sample Society', 'Sample Type', 'S-001', 'Rent', 'N/A', 0, 'This is a sample property added by default upon registration.', 0, '2025-02-06 18:48:23', 0x00000000010100000000000000000000000000000000000000),
(159, 19, 'Ahmedabad', 'Science City', 'Green Residency ', 'Villa', '78-96-58', 'Rent', '4BHK', 52000, '', 0, '2025-02-07 06:31:52', 0x000000000101000000caff5cd454143740de1c85db29205240),
(160, 19, 'Ahmedabad', 'Gota', '235 Park View', 'Apartment ', '1-56-73', 'Rent', '3BHK', 16000, '', 0, '2025-02-07 06:56:38', 0x000000000101000000f802dc1686193740f303562e4d225240),
(161, 20, 'Sample City', 'Sample Area', 'Sample Society', 'Sample Type', 'S-001', 'Rent', 'N/A', 0, 'This is a sample property added by default upon registration.', 0, '2025-02-07 08:49:54', 0x00000000010100000000000000000000000000000000000000),
(162, 20, 'Surat', 'Varasa', 'sarthi bungalows', 'House', '1-56-74', 'Sell', '3BHK', 7000000, '', 1, '2025-02-07 08:59:46', 0x000000000101000000c63327a2f13635408d481e08e7385240),
(163, 21, 'Sample City', 'Sample Area', 'Sample Society', 'Sample Type', 'S-001', 'Rent', 'N/A', 0, 'This is a sample property added by default upon registration.', 0, '2025-02-07 09:01:29', 0x00000000010100000000000000000000000000000000000000),
(164, 21, 'Surat', 'Vesu', 'Soham Bungalows', 'Villa', 'B-5-403', 'Rent', '4BHK', 50000, 'All action will be under Govt. Documents ', 0, '2025-02-07 09:06:13', 0x0000000001010000006e9ddb31f5233540dcf91a8036315240),
(165, 22, 'Sample City', 'Sample Area', 'Sample Society', 'Sample Type', 'S-001', 'Rent', 'N/A', 0, 'This is a sample property added by default upon registration.', 0, '2025-02-09 11:54:26', 0x00000000010100000000000000000000000000000000000000);

-- --------------------------------------------------------

--
-- Table structure for table `prop_photo`
--

CREATE TABLE `prop_photo` (
  `pr_id` smallint(5) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prop_photo`
--

INSERT INTO `prop_photo` (`pr_id`, `photo`) VALUES
(159, 'IMG-67a5a8d8418126.44709341.jpg'),
(159, 'IMG-67a5a8d8422167.36291320.jpg'),
(159, 'IMG-67a5a8d84259d1.75644140.jpg'),
(159, 'IMG-67a5a8d842e3c7.79924567.jpg'),
(159, 'IMG-67a5a8d842fef1.29261578.jpg'),
(159, 'IMG-67a5a8d8431db3.28385276.jpg'),
(160, 'IMG-67a5aea60da248.75315865.jpg'),
(160, 'IMG-67a5aea60e5d29.78283196.jpg'),
(160, 'IMG-67a5aea60e9800.71691265.jpg'),
(160, 'IMG-67a5aea60f5e62.49527818.jpg'),
(160, 'IMG-67a5aea60f8ea7.85444561.jpg'),
(160, 'IMG-67a5aea60fc8a0.73586634.jpg'),
(162, 'IMG-67a5cb82c0bb01.15900635.jpg'),
(162, 'IMG-67a5cb82c16686.33241363.jpg'),
(162, 'IMG-67a5cb82c1df51.46585733.jpg'),
(162, 'IMG-67a5cb82c223d9.67368955.jpg'),
(162, 'IMG-67a5cb82c339b1.96481944.jpg'),
(162, 'IMG-67a5cb82c38ae8.44029287.jpg'),
(164, 'IMG-67a5cd05b76ba9.95030288.jpg'),
(164, 'IMG-67a5cd05b7dfc0.86998575.jpg'),
(164, 'IMG-67a5cd05b819d4.24025607.jpg'),
(164, 'IMG-67a5cd05b84c59.45672821.jpg'),
(164, 'IMG-67a5cd05b881f7.63278444.jpg'),
(164, 'IMG-67a5cd05b96515.84611535.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` smallint(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `u_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `email`, `mobile`, `password`, `photo`, `city`, `address`, `u_date`) VALUES
(19, 'Rishit Gokani', 'rishit@gmail.com', '7372964378', '$2y$10$QBBq6jJRHuptYARhkXcfsOiOBT85kSHlsNHAC/53suT61vB1XE40e', 'IMG-67a50722aadde3.67940504.jpg', 'Dwarka', 'Mandir chawk, dwarka', '2025-02-06 18:48:23'),
(20, 'Madhav', 'madhav@gmail.com', '8320393672', '$2y$10$0ijOlmOJQOh39D.0rrLBC.9pIMs3hQCOBdLCzdgA3.fpDC0aMaGgq', NULL, 'Surat', 'sanskar villa socity, varasa', '2025-02-07 08:49:54'),
(21, 'Pranav Bhimani', 'pranav@gmail.com', '9696587120', '$2y$10$9PUkyInyIPxEJFcXWC5nVOkQQX8WAwlwHEwe9.dWpm.SYRJ79YpMm', 'IMG-67a5d42501eef0.25342315.jpg', 'Anand', 'Madhav Gurukul, Bakrol road, Anand', '2025-02-07 09:01:29'),
(22, 'Patel Vishesh', 'vishesh@gmail.com', '6354594821', '$2y$10$/U9q0VosSQsU0/54D1nZjuLazbrg82aeL/nQzUmtcynIOc5O86f6K', NULL, NULL, NULL, '2025-02-09 11:54:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bk_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `fav_property`
--
ALTER TABLE `fav_property`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `prop_photo`
--
ALTER TABLE `prop_photo`
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bk_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `sr_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fav_property`
--
ALTER TABLE `fav_property`
  MODIFY `f_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `my_orders`
--
ALTER TABLE `my_orders`
  MODIFY `o_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pr_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fav_property`
--
ALTER TABLE `fav_property`
  ADD CONSTRAINT `fav_property_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_property_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD CONSTRAINT `my_orders_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `my_orders_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prop_photo`
--
ALTER TABLE `prop_photo`
  ADD CONSTRAINT `prop_photo_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
