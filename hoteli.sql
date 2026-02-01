-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 08:08 PM
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
-- Database: `hoteli`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `nights` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `customer_name`, `customer_email`, `nights`, `guests`, `checkin_date`, `booked_at`) VALUES
(4, 1, 'user', 'user@gmail.com', 5, 6, '2026-10-10', '2026-01-31 22:35:41'),
(5, 2, 'user', 'user@gmail.com', 5, 5, '2026-12-01', '2026-01-31 22:45:49'),
(6, 3, 'user', 'user@gmail.com', 3, 3, '2026-12-02', '2026-01-31 22:46:32'),
(7, 2, 'user', 'user@gmail.com', 5, 1, '2026-12-02', '2026-01-31 22:48:13'),
(8, 5, 'ddd', 'test@test.com', 67, 4, '5666-02-06', '2026-02-01 18:14:38'),
(9, 4, 'ddd', 'admin@test.com', 12, 3, '2026-02-17', '2026-02-01 18:16:59'),
(10, 1, 'usejd', 'usejd@test.com', 33, 3, '2026-02-26', '2026-02-01 18:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `status` enum('available','unavailable') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `price_per_night`, `image`, `is_featured`, `status`, `created_at`) VALUES
(1, 'Deluxe Room', 'Spacious room with city view', 120.00, 'room-deluxe.jpeg', 1, 'unavailable', '2026-01-30 15:35:02'),
(2, 'Economy Room', 'Affordable and cozy room', 70.00, 'room-economy.jpg', 1, 'available', '2026-01-30 15:35:02'),
(3, 'Ocean View Room', 'Room with stunning ocean view', 150.00, 'room-oceanView.jpg', 1, 'available', '2026-01-30 15:35:02'),
(4, 'Superior Room', 'Larger room with premium amenities', 130.00, 'room-superior.jpg', 1, 'available', '2026-01-30 15:35:02'),
(5, 'Family Suite', 'Spacious suite perfect for family', 180.00, 'suite-family.jpg', 1, 'available', '2026-01-30 15:35:02'),
(6, 'Junior Suite', 'Comfortable suite for three', 200.00, 'suite-junior.jpg', 1, 'available', '2026-01-30 15:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `type` enum('newsletter','contact') NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `type`, `first_name`, `last_name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'newsletter', NULL, NULL, 'delira@dkaodj.npn', NULL, NULL, NULL, '2026-02-01 16:48:22'),
(2, 'contact', 'amar', 'amari', 'amar@amari.com', '9029020202', 'amar', 'amari', '2026-02-01 16:56:33'),
(3, 'newsletter', NULL, NULL, 'admin@test.com', NULL, NULL, NULL, '2026-02-01 18:13:18'),
(4, 'contact', 'delira', 'dijar', 'usejd@test.com', '9029020202', 'yes', 'xdsfc swfvrw', '2026-02-01 18:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` varchar(40) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `email`, `password`) VALUES
(1, 'user', 'usejd', 'usejd@test.com', '$2y$10$udfD9qC1Hki4BdnYcQaQS.Rt7LKFa8b50E7CWHSJtTO7CloS3ab0i'),
(2, 'admin', 'admin', 'admin@gmai.com', '$2y$10$ZIidR68Y6T5c..9Stqn2zujCN54NxXQtl09eSzEgFa16RWcUgLzF2'),
(3, 'admin', 'maca', 'maca@gmail.com', '$2y$10$hVJEc4.fHvDOWLnqe.1H0enDy6Qgj3TVlClQvilbvKbcds3dbSGxu'),
(4, 'user', 'arti', 'arti@gmail.com', '$2y$10$VXD/n9K/Ut0aoJa.tvwa/.KFdLA3QGo1TabN0M5rBgp4dM4FqVCc2'),
(5, 'user', 'shpat', 'shpat@gmail.com', '$2y$10$RAJayJG1ZLgvnoxqMOK5DeCWfhDGPEtbw6h7/jGS2sjw3h0jJ6eYu'),
(6, 'admin', 'albion', 'albion@gmail.com', '$2y$10$Ije062aliqtpbv9Ud22WzumpV4kwvhLE3h7iRIFpFHIJZRvFlbCzS'),
(7, 'user', 'user', 'user@gmail.com', '$2y$10$qo/10OYrvBqhA2xQEagZHuTnwYNOtslSt1Ra2FxkwBmC2BhE2a40G'),
(8, 'user', 'testuser', 'admin@test.com', '$2y$10$ugQ0luXJAAdL9AbSuLKRQupj6pI7shKQ9M5vqqR6K4NRaYq.83rA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
