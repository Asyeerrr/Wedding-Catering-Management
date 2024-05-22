-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 03:11 PM
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
-- Database: `user_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `cater_staff`
--

CREATE TABLE `cater_staff` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `salary` char(64) NOT NULL,
  `duty` varchar(255) NOT NULL,
  `salary_plain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cater_staff`
--

INSERT INTO `cater_staff` (`staff_id`, `username`, `contact`, `age`, `salary`, `duty`, `salary_plain`) VALUES
(1, 'Lee', '0123456789', 24, 'XXXX', 'Waiter', '1800'),
(2, 'Abdul', '01986325381', 21, 'XXXX', 'Waiter', '1800'),
(3, 'Angeline', '0112374921', 20, 'XXXX', 'Waitress', '1800'),
(4, 'Kamal', '0102375498', 28, 'XXXX', 'Chef', '2400'),
(5, 'Nina', '0105431545', 24, 'XXXX', 'Chef', '2400'),
(6, 'Sasha', '0187236491', 25, 'XXXX', 'Cleaner', '1900');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `Role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$hfti5nnKj.JiaC95ZbwPruN/WgNiQXGgViueEwWJn4h0y1JUH5uSe', 'Admin'),
(2, 'PK', 'pk@gmail.com', '$2y$10$1Qus52GJGWmcKctX240b1uO8LXc9HQeWkKvyEanW0Mj32JFzo/ct2', 'Catering Manager'),
(3, 'Divya', 'divya@gmail.com', '$2y$10$eRMHrS3d.1PLwbb1qetW3OUQoghix5YWZVDKX4Ut0owY08r4aO0NW', 'Wedding Manager');

-- --------------------------------------------------------

--
-- Table structure for table `wed_staff`
--

CREATE TABLE `wed_staff` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `salary` char(64) NOT NULL,
  `duty` varchar(255) NOT NULL,
  `salary_plain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wed_staff`
--

INSERT INTO `wed_staff` (`staff_id`, `username`, `contact`, `age`, `salary`, `duty`, `salary_plain`) VALUES
(1, 'Saiful', '0198765432', 26, 'XXXX', 'MC', '2000'),
(2, 'Ng', '0145294628', 21, 'XXXX', 'PA System', '1900'),
(3, 'Sarah', '0127285920', 22, 'XXXX', 'PA System', '1900'),
(4, 'Edward', '0132759071', 23, 'XXXX', 'Photographer', '2000'),
(5, 'Vikram', '0173819537', 22, 'XXXX', 'Videographer', '2000'),
(6, 'Yashene', '0192374810', 21, 'XXXX', 'Event Handler', '2000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cater_staff`
--
ALTER TABLE `cater_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wed_staff`
--
ALTER TABLE `wed_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cater_staff`
--
ALTER TABLE `cater_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wed_staff`
--
ALTER TABLE `wed_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
