-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 08, 2020 at 02:58 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_information`
--
CREATE DATABASE test;
USE test;

CREATE TABLE `client_information` (
  `id` int(6) NOT NULL,
  `client_info_id` int(6) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zipcode` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`id`, `client_info_id`, `full_name`, `address1`, `address2`, `city`, `state`, `zipcode`) VALUES
(4, 12, 'Bill Kemp', '1053 Circle Drive', NULL, 'Houston', 'TX', '77032'),
(5, 13, 'Noah Walters', '3706 Todds Lane', NULL, 'San Antonio', 'TX', '78205');

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
(2, 1, 1000, '2020-08-01', '60.00', 60000.00, '2020-02-04'),
(2, 2, 2000, '2020-09-01', '50.00', 100000.00, '2020-06-01'),
(3, 3, 3000, '2020-10-01', '40.00', 120000.00, '2020-01-01'),
(3, 4, 4000, '2020-11-01', '90.00', 360000.00, '2020-07-04'),
(4, 5, 1255, '2020-10-15', '2.43', 3049.65, '2020-07-07'),
(5, 6, 296, '2020-09-01', '2.55', 754.80, '2020-07-07'),
(5, 7, 300, '2021-01-14', '2.47', 741.00, '2020-07-08');

-- --------------------------------------------------------
--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state` varchar(30) NOT NULL,
  `abbreviation` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state`, `abbreviation`) VALUES
('Alabama', 'AL'),
('Alaska', 'AK'),
('Arizona', 'AZ'),
('Arkansas', 'AR'),
('California', 'CA'),
('Colorado', 'CO'),
('Connecticut', 'CT'),
('Delaware', 'DE'),
('District of Columbia', 'DC'),
('Florida', 'FL'),
('Georgia', 'GA'),
('Hawaii', 'HI'),
('Idaho', 'ID'),
('Illinois', 'IL'),
('Indiana', 'IN'),
('Iowa', 'IA'),
('Kansas', 'KS'),
('Kentucky', 'KY'),
('Louisiana', 'LA'),
('Maine', 'ME'),
('Maryland', 'MD'),
('Massachusetts', 'MA'),
('Michigan', 'MI'),
('Mississippi', 'MS'),
('Missouri', 'MO'),
('Montana', 'MT'),
('Nebraska', 'NE'),
('Nevada', 'NV'),
('New Hampshire', 'NH'),
('New Jersey', 'NJ'),
('New Mexico', 'NM'),
('New York', 'NY'),
('North Carolina', 'NC'),
('North Dakota', 'ND'),
('Ohio', 'OH'),
('Oklahoma', 'OK'),
('Oregon', 'OR'),
('Pennsylvania', 'PA'),
('Rhode Island', 'RI'),
('South Carolina', 'SC'),
('South Dakota', 'SD'),
('Tennessee', 'TN'),
('Texas', 'TX'),
('Utah', 'UT'),
('Vermont', 'VT'),
('Virginia', 'VA'),
('Washington', 'WA'),
('West Virginia', 'WV'),
('Wisconsin', 'WI'),
('Wyoming', 'WY');

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
(4, 'billkemp@gmail.com', '12345', 'billkemp', '1053 Circle Drive', '', 'Houston', 'TX', 77032),
(5, 'noahwalters@gmail.com', '12345', 'noahwalters', '3706 Todds Lane', '', 'San Antonio', 'TX', 78205);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_information`
--
ALTER TABLE `client_information`
  ADD PRIMARY KEY (`client_info_id`);

--
-- Indexes for table `fuel_quotes`

-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `fuel_quotes`
--
ALTER TABLE `fuel_quotes`
  ADD PRIMARY KEY (`id`);

--
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_information`
--
ALTER TABLE `client_information`
  MODIFY `client_info_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  
  --
ALTER TABLE `fuel_quotes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--