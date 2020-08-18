-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 12:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

CREATE TABLE `staff_data` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `role_type` enum('project_manager','admin','task_manager','client') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `entry` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_data`
--

INSERT INTO `staff_data` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `role_type`, `status`, `entry`) VALUES
(1, 'MS', 'Dhoni', 'dhoni07@gmail.com', 'UGFzc0BEaG9uaQ==', '8425070863', 'admin', 'Active', '2020-08-18 09:28:35'),
(2, 'Sarika', 'Singh', 'sarikasingh1133@gmail.com', 'UGFzc0BTYXJpa2E=', '8425012863', 'task_manager', 'Active', '2020-08-18 09:29:24'),
(3, 'Pooja', 'Shabade', 'pooja@gmail.com', 'MTIzQDEyMw==', '7548962145', 'client', 'Active', '2020-08-18 09:29:55'),
(4, 'Rohit', 'Sharma', 'sharmarohit45@gmail.com', 'UGFzc0BSb2hpdG1hbg==', '9874563215', 'project_manager', 'Active', '2020-08-18 09:30:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff_data`
--
ALTER TABLE `staff_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
