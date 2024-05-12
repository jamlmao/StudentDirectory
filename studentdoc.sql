-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 03:56 PM
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
-- Database: `studentdoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentinfo`
--

CREATE TABLE `tblstudentinfo` (
  `StudentID` int(6) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `bdate` date NOT NULL,
  `homeaddr` varchar(30) NOT NULL,
  `boardingaddr` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `course` varchar(5) NOT NULL,
  `year_level` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civil_status` varchar(10) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `passcode` varchar(60) NOT NULL,
  `accounttype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `passcode`, `accounttype`) VALUES
(2, 'admin', '$2y$10$xYH7DocFPO0Rif1Vgl/ffuVY1yc7ya5bBVPsoATYESHQasJN.qr7C', 'Admin'),
(3, 'test123', '$2y$10$WN5RPKAvF2HH6ZEUFvBFoOQGCmHIHtDwslwOY497bPaoahFr5Gb2C', 'Admin'),
(4, 'test5', '$2y$10$viPrFWTLGNiEF7Kf90/EbuBOohSobieF5DeuQC/L0XNZdj6dZPsdi', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblstudentinfo`
--
ALTER TABLE `tblstudentinfo`
  ADD UNIQUE KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblstudentinfo`
--
ALTER TABLE `tblstudentinfo`
  MODIFY `StudentID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243125;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
