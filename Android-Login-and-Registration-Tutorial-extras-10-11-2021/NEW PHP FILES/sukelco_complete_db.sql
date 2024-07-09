-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 07:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `passsword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `passsword`) VALUES
(1, 'admin@admin.com', 'admin'),
(2, 'infinityadmin@infinitydoki.xyz', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customerlogs`
--

CREATE TABLE `customerlogs` (
  `id` int(11) NOT NULL,
  `meterid` text NOT NULL,
  `totalKWH` int(11) NOT NULL,
  `customerbalance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerlogs`
--

INSERT INTO `customerlogs` (`id`, `meterid`, `totalKWH`, `customerbalance`) VALUES
(37, 'aaaaaaaaa', 0, 420.69),
(38, 'dfdfdfdfdfdfd', 0, 0),
(39, 'aasasasasasas', 0, 0),
(40, 'xddddddddd', 0, 0),
(41, '5903303485', 120, 600);

-- --------------------------------------------------------

--
-- Table structure for table `customer_feed_back`
--

CREATE TABLE `customer_feed_back` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `feedback` text NOT NULL,
  `suggestions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_feed_back`
--

INSERT INTO `customer_feed_back` (`id`, `name`, `email`, `phone`, `feedback`, `suggestions`) VALUES
(1, '', '', '', 'excellent', 'none'),
(2, '', '', '', 'neutral', 'why should I do this?'),
(3, '', '', '', 'excellent', 'test value'),
(4, '', '', '', 'good', 'this is a test'),
(5, '', '', '', 'neutral', 'test value again'),
(6, '', '', '', 'good', 'send help');

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
  `totalKWH` int(11) NOT NULL COMMENT 'total KWh per person',
  `customerbalance` float NOT NULL COMMENT 'balance in float'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `gender`, `purok`, `barangay`, `town`, `meterid`, `totalKWH`, `customerbalance`) VALUES
(1, 'infinityAdmin', '0', 'infinitydoki@infinitydoki.xyz', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '', '', '', 'debugKey', 0, 69.42),
(2, 'testaccount', '0', 'isekaitester@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'male', 'test', 'data', 'release', 'debugging', 0, 0),
(3, 'testname', '0', 'isekaitester420@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'male', 'test', 'data', 'release', 'debuggingAgain', 0, 0),
(4, 'testing', 'for the lolz', 'dev@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'Male', 'test', 'Poblacion', 'Tacurong City', 'fffff', 0, 0),
(5, 'asdf', 'fortehlol', 'asdf@infinitydoki.xyz', '827ccb0eea8a706c4c34a16891f84e7b', 'male', 'nopurok', 'nobarangay', 'notown', 'nope', 0, 0),
(6, 'qwerty', 'qwerty', 'qwerty@infintitydoki.xyz', '25d55ad283aa400af464c76d713c07ad', 'Male', 'lol', 'Poblacion', 'Tacurong City', 'aaaaaaaaa', 0, 420.69),
(7, 'weedb', 'weedb', 'linuxlove@infinitydoki.xyz', '25d55ad283aa400af464c76d713c07ad', 'Female', 'lol', 'Poblacion', 'Palimbang', 'dfdfdfdfdfdfd', 0, 0),
(8, 'onetwo', 'onetwo', 'onetwo@infinitydoki.xyz', '202cb962ac59075b964b07152d234b70', 'Male', 'aaasasasasasas', 'Buenaflores', 'Senator Ninoy Aquino', 'aasasasasasas', 0, 0),
(9, 'onetwothree', 'onetwothree', 'onetwothree@infinitydoki.xyz', '25d55ad283aa400af464c76d713c07ad', 'Male', 'aaasasasasasas', 'Banali', 'Senator Ninoy Aquino', 'xddddddddd', 21, 123.45),
(10, 'uiop', 'uiop', 'uiop@infinitydoki.xyz', '25d55ad283aa400af464c76d713c07ad', 'female', 'test', 'data', 'release', '5903303485', 120, 600);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerlogs`
--
ALTER TABLE `customerlogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meterid` (`meterid`(768));

--
-- Indexes for table `customer_feed_back`
--
ALTER TABLE `customer_feed_back`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customerlogs`
--
ALTER TABLE `customerlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `customer_feed_back`
--
ALTER TABLE `customer_feed_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Sort Order', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
