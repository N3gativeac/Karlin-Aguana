-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 04:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sukelco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'Sort Order',
  `username` text NOT NULL COMMENT 'username',
  `fullname` text NOT NULL,
  `email` text NOT NULL COMMENT 'user email',
  `password` text NOT NULL COMMENT 'user password',
  `gender` varchar(8) NOT NULL COMMENT 'gender',
  `purok` text NOT NULL COMMENT 'Purok (Requires barangay)',
  `barangay` text NOT NULL COMMENT 'Barangay (Requires Town)',
  `town` text NOT NULL COMMENT 'Towns in SK',
  `meterid` text NOT NULL COMMENT 'alphanumeric meter id',
  `customerbalance` float NOT NULL COMMENT 'balance in float'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `gender`, `purok`, `barangay`, `town`, `meterid`, `customerbalance`) VALUES
(1, 'infinityAdmin', '0', 'infinitydoki@infinitydoki.xyz', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '', '', '', 'debugKey', 69.42),
(2, 'testaccount', '0', 'isekaitester@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'male', 'test', 'data', 'release', 'debugging', 0),
(3, 'testname', '0', 'isekaitester420@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'male', 'test', 'data', 'release', 'debuggingAgain', 0),
(4, 'testing', 'for the lolz', 'dev@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'Male', 'test', 'Poblacion', 'Tacurong City', 'fffff', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meterid` (`meterid`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Sort Order', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
