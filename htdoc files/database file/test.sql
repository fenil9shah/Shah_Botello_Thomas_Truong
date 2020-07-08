-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 11:16 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_quotes`
--

CREATE TABLE `fuel_quotes` (
  `userid` int(6) NOT NULL,
  `id` int(6) NOT NULL,
  `gallons_requested` int(15) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `suggested_price` int(11) DEFAULT NULL,
  `total_amount_due` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_quotes`
--

INSERT INTO `fuel_quotes` (`userid`, `id`, `gallons_requested`, `delivery_date`, `suggested_price`, `total_amount_due`, `created_date`) VALUES
(2, 1, 1000, '2020-08-01', 60, 60000, '2020-02-04'),
(2, 2, 2000, '2020-09-01', 50, 100000, '2020-06-01'),
(3, 3, 3000, '2020-10-01', 40, 120000, '2020-01-01'),
(3, 4, 4000, '2020-11-01', 90, 360000, '2020-07-04'),
(4, 5, 500, '2020-07-08', 2, 1000, '2020-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `testtable`
--

CREATE TABLE `testtable` (
  `testVar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testtable`
--

INSERT INTO `testtable` (`testVar`) VALUES
(1),
(1),
(1),
(1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `addr1` varchar(100) DEFAULT NULL,
  `addr2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullName`, `addr1`, `addr2`, `city`, `state`, `zipcode`) VALUES
(2, 'admin@admin.test', 'test12345', 'The Admin Guy', '12357 Adminland', '', 'Earth', 'AL', 45681),
(3, 'test@test.com', '12345', 'testman', '1234156swq', '', '0', '0', 78945),
(4, 'test@test.test', 'c06db68e819be6ec', 'Younman', '12345 Theres no need to feel down', '', 'I said young', 'MN', 789456),
(5, 'w@w.w', 'e10adc3949ba59ab', 'w', 'w', 'w', 'w', 'WY', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuel_quotes`
--
ALTER TABLE `fuel_quotes`
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
-- AUTO_INCREMENT for table `fuel_quotes`
--
ALTER TABLE `fuel_quotes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
