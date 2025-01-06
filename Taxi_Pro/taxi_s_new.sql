-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 06:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi_s_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `destination` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `driver_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `status` enum('pending','accepted','rejected','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `pickup_location`, `destination`, `created_at`, `driver_id`, `vehicle_type`, `status`) VALUES
(1, 1, 'chebaa', 'beirut', '2024-12-20 16:29:35', 8, 'suv', 'pending'),
(2, 1, 'chebaa', 'beirut', '2024-12-20 16:29:42', 10, 'suv', 'pending'),
(3, 1, 'ww', 'w1q', '2025-01-06 17:04:52', NULL, 'sedan', 'pending'),
(4, 1, '12', '11', '2025-01-06 17:08:19', NULL, 'sedan', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'hisham alzoghbi', 'hishamalzoghbi552@gmail.com', 'h', '2025-01-06 17:01:06'),
(2, 'hisham alzoghbi', 'hishamalzoghbi552@gmail.com', 'hi', '2025-01-06 17:03:59'),
(3, 'hisham alzoghbi', 'hishamalzoghbi552@gmail.com', 'hi', '2025-01-06 17:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `user_id`, `username`, `vehicle_number`, `license_number`, `status`, `created_at`) VALUES
(1, 2, '', '', '', 'rejected', '2024-12-11 19:08:13'),
(2, 8, '', '4444', '321', 'approved', '2024-12-11 19:15:18'),
(3, 9, '', '1234', '1222', 'rejected', '2024-12-11 19:16:55'),
(4, 10, '', '1111', '1234', 'rejected', '2024-12-11 23:06:40'),
(5, 11, '', '2222', '1111', 'approved', '2024-12-15 22:14:36'),
(6, 12, '', '1112', '2221', 'approved', '2024-12-15 22:35:43'),
(7, 14, '', '1123', '2221', 'pending', '2024-12-15 22:49:17'),
(8, 15, '', '4444', '5555', 'pending', '2024-12-20 15:54:59'),
(9, 16, '', '1313', '1313', 'approved', '2024-12-20 16:33:00'),
(10, 17, '', '1414', '1414', 'pending', '2024-12-20 16:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `driverss`
--

CREATE TABLE `driverss` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driverss`
--

INSERT INTO `driverss` (`id`, `user_id`, `vehicle_number`, `license_number`, `status`, `created_at`) VALUES
(1, 13, '2222', '1234', 'pending', '2024-12-15 22:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_requests`
--

CREATE TABLE `support_requests` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Pending','Resolved') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_requests`
--

INSERT INTO `support_requests` (`id`, `driver_id`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 4, 'aa', 'bbb', 'Pending', '2024-12-11 23:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('passenger','driver') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, '11', '11@gmail.com', '$2y$10$wxhVlOQMfuH5egMJO3Te8uDYqxA/QLD1fk/rQkOI35JZyCu6coVsa', 'passenger', '2024-12-11 19:05:48'),
(2, '12', '12@gmail.com', '$2y$10$GqTtnHAZJCTEnQpjrQYsueRRoVYaaeLPZsW3aF1KuyFh7dSZbv.iG', 'driver', '2024-12-11 19:08:13'),
(8, 'hisham', 'hisham@gmail.com', '$2y$10$PFjcGsujYtzIxBUNPoxGuOqwVUwosrvI9Bb67Z8Q0CKeO76qUCEb6', 'driver', '2024-12-11 19:15:18'),
(9, 'hisham1', 'hisham1@gmail.com', '$2y$10$ErOR6ija5G9873i2LaXIiuM6KO9jk5c0CygEZ0iU7.S5y3FW0Owvq', 'driver', '2024-12-11 19:16:55'),
(10, 'Hishamm', 'h1@gmail.com', '$2y$10$IC.mFVgNoHpNJyBvpXqd3uDp/24LqUI7llFwkQ8SrR/tzmAAt7fIm', 'driver', '2024-12-11 23:06:40'),
(11, 'hisham zoghby', 'hisham223@gmail.com', '$2y$10$4mZyLpC2kon/IxO.9YkN2urobRPvPOR83NKzgipTM95.4ou.5UiY.', 'driver', '2024-12-15 22:14:36'),
(12, 'hisham', 'h123@gmail.com', '$2y$10$owVlvM/w1/i2IZHpeljTKucOq8aTiY3dk672mH02ax9vmkps0q2hm', 'driver', '2024-12-15 22:35:43'),
(13, 'hisham', 'h12@gmail.com', '$2y$10$52BwP.9skFIDKfBFlsO/wupcWx6Ky.mYLVOGJNezufX7a9uhk7v9G', 'driver', '2024-12-15 22:42:59'),
(14, 'hisham zoghby', 'h112@gmail.com', '$2y$10$gSae.6Z4hPwkVx5/TnhTXe4NiKhB54w18AFeYIxWEWGitPsQK3xaG', 'driver', '2024-12-15 22:49:17'),
(15, 'hhh', 'hh@gmail.com', '$2y$10$hmSRZePSGNfhOQLM9812FeFQZAl3l597fl9nVrSKPjlZdVmYmurje', 'driver', '2024-12-20 15:54:59'),
(16, '13', '13@gmail.com', '$2y$10$HkooiVmS.LxvLCybtpkzMubJKywI2b2GxncfQjynDQ5LqgFS3W9v.', 'driver', '2024-12-20 16:33:00'),
(17, '14', '14@gmail.com', '$2y$10$MfKyf1OtC8f2Q0k7dFjbKeP3XLVvbwYL14ZOVoeIvw8EaZmODF7tW', 'driver', '2024-12-20 16:34:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `driverss`
--
ALTER TABLE `driverss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `support_requests`
--
ALTER TABLE `support_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `driverss`
--
ALTER TABLE `driverss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_requests`
--
ALTER TABLE `support_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `driverss`
--
ALTER TABLE `driverss`
  ADD CONSTRAINT `driverss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `support_requests`
--
ALTER TABLE `support_requests`
  ADD CONSTRAINT `support_requests_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
