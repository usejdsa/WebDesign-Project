-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 05:45 PM
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
(1, 'Deluxe Room', 'Spacious room with city view', 120.00, 'room-deluxe.jpeg', 1, 'available', '2026-01-30 15:35:02'),
(2, 'Economy Room', 'Affordable and cozy room', 70.00, 'room-economy.jpg', 1, 'available', '2026-01-30 15:35:02'),
(3, 'Ocean View Room', 'Room with stunning ocean view', 150.00, 'room-oceanView.jpg', 1, 'available', '2026-01-30 15:35:02'),
(4, 'Superior Room', 'Larger room with premium amenities', 130.00, 'room-superior.jpg', 1, 'available', '2026-01-30 15:35:02'),
(5, 'Family Suite', 'Spacious suite perfect for family', 180.00, 'suite-family.jpg', 1, 'available', '2026-01-30 15:35:02'),
(6, 'Junior Suite', 'Comfortable suite for two', 200.00, 'suite-junior.jpg', 1, 'available', '2026-01-30 15:35:02'),
(8, 'bestsuite', 'best room ever', 50.00, '1769790551_foto.jpg', 1, 'available', '2026-01-30 16:29:11');

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
(3, 'admin', 'maca', 'maca@gmail.com', '$2y$10$hVJEc4.fHvDOWLnqe.1H0enDy6Qgj3TVlClQvilbvKbcds3dbSGxu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
