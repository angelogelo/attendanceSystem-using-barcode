-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 04:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barcode_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `students_info`
--

CREATE TABLE `students_info` (
  `id` int(10) NOT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` int(10) NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_info`
--

INSERT INTO `students_info` (`id`, `picture`, `id_number`, `last_name`, `first_name`, `middle_name`, `gender`, `contact_no`, `address`, `course`, `created_at`) VALUES
(4, 'sherann.jpg', 20084103, 'Coma', 'Sherann', 'Sherann', 'Female', '09123456789', 'Antipolo, Rizal', 'BSIT', '2021-04-27 11:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `students_logs`
--

CREATE TABLE `students_logs` (
  `id` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `course` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_logs`
--

INSERT INTO `students_logs` (`id`, `id_number`, `fullname`, `course`, `status`) VALUES
(108, '20084103', 'Sherann Coma', 'BSIT', '1');

-- --------------------------------------------------------

--
-- Table structure for table `time_log`
--

CREATE TABLE `time_log` (
  `id` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `course` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_log`
--

INSERT INTO `time_log` (`id`, `id_number`, `fullname`, `date`, `course`, `status`, `time`) VALUES
(319, '20084103', 'Sherann Coma', '2021-04-27 12:13:07', 'BSIT', 'time-in', '08:13:06 PM'),
(320, '20084103', 'Sherann Coma', '2021-04-27 12:13:09', 'BSIT', 'time-out', '08:13:09 PM'),
(321, '20084103', 'Sherann Coma', '2021-04-27 12:13:10', 'BSIT', 'time-in', '08:13:10 PM'),
(322, '20084103', 'Sherann Coma', '2021-04-27 12:13:11', 'BSIT', 'time-out', '08:13:11 PM'),
(323, '20084103', 'Sherann Coma', '2021-04-27 12:13:18', 'BSIT', 'time-in', '08:13:18 PM'),
(324, '20084103', 'Sherann Coma', '2021-04-27 12:13:20', 'BSIT', 'time-out', '08:13:20 PM'),
(325, '20084103', 'Sherann Coma', '2021-04-27 12:13:21', 'BSIT', 'time-in', '08:13:21 PM'),
(326, '20084103', 'Sherann Coma', '2021-04-27 12:13:22', 'BSIT', 'time-out', '08:13:22 PM'),
(327, '20084103', 'Sherann Coma', '2021-04-27 12:13:32', 'BSIT', 'time-in', '08:13:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `status`, `created_at`) VALUES
(3, 'admin', '$2y$10$zAu.w/dJZB1LMTmwcAWoYeV3ZsfQmqfyLcR9fvw5NyP5/9MVCMbFO', 'admin', 'approved', '2019-09-01 09:01:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students_info`
--
ALTER TABLE `students_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_logs`
--
ALTER TABLE `students_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnum` (`id_number`);

--
-- Indexes for table `time_log`
--
ALTER TABLE `time_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students_info`
--
ALTER TABLE `students_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `students_logs`
--
ALTER TABLE `students_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `time_log`
--
ALTER TABLE `time_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
