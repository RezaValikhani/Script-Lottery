-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2020 at 10:45 AM
-- Server version: 10.3.24-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sources1_lott`
--

-- --------------------------------------------------------

--
-- Table structure for table `zx_admin`
--

CREATE TABLE `zx_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zx_admin`
--

INSERT INTO `zx_admin` (`id`, `name`, `email`, `password`) VALUES
(3, 'سورس ساز', 'info@sourcesaaz.ir', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `zx_info`
--

CREATE TABLE `zx_info` (
  `id` int(11) NOT NULL,
  `name` varchar(22) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(22) NOT NULL,
  `idlottery` varchar(22) CHARACTER SET utf8 NOT NULL,
  `statuspay` int(2) NOT NULL DEFAULT 0,
  `statuswin` int(2) NOT NULL DEFAULT 0,
  `date` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `code` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zx_winner`
--

CREATE TABLE `zx_winner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `idlottery` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zx_admin`
--
ALTER TABLE `zx_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_info`
--
ALTER TABLE `zx_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_winner`
--
ALTER TABLE `zx_winner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zx_admin`
--
ALTER TABLE `zx_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zx_info`
--
ALTER TABLE `zx_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `zx_winner`
--
ALTER TABLE `zx_winner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
