-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 04:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `songs_db`
--
CREATE DATABASE IF NOT EXISTS `songs_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `songs_db`;

-- --------------------------------------------------------

--
-- Table structure for table `songs_tbl`
--

CREATE TABLE `songs_tbl` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `lyrics` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `deleted_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs_tbl`
--

INSERT INTO `songs_tbl` (`id`, `title`, `artist`, `lyrics`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'test', 'test', 'Testsss', '2023-06-08', '2023-06-08', '2023-06-08'),
(2, 'test', 'test', '098f6bcd4621d373cade4e832627b4f6', '2023-06-08', '2023-06-08', '0000-00-00'),
(3, 'Test', 'Test', 'Test', '2023-06-08', '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `songs_tbl`
--
ALTER TABLE `songs_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `songs_tbl`
--
ALTER TABLE `songs_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
