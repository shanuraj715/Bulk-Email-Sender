-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2020 at 01:07 AM
-- Server version: 5.6.45
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techfact_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

CREATE TABLE `contact_form_submissions` (
  `id` int(4) NOT NULL,
  `name` varchar(56) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(56) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(3) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_available` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_list`
--

INSERT INTO `email_list` (`id`, `email`, `is_available`) VALUES
(1, 'advertise@techfacts007.in', 1),
(2, 'anonymous@techfacts007.in', 1),
(3, 'cs_reply@techfacts007.in', 1),
(4, 'sender@techfacts007.in', 1),
(5, 'sender2@techfacts007.in', 1),
(6, 'subscribers@techfacts007.in', 1),
(7, 'support@techfacts007.in', 1),
(8, 'default@techfacts007.in', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user-id` bigint(6) NOT NULL COMMENT 'this is random user id for every user',
  `name` varchar(56) NOT NULL COMMENT 'name of the user',
  `username` varchar(56) DEFAULT NULL COMMENT 'username of the user',
  `password` text NOT NULL COMMENT 'password of the user account',
  `email` varchar(56) NOT NULL COMMENT 'registered email id of the user',
  `dob` varchar(32) NOT NULL COMMENT 'user date of birth',
  `reg_date_time` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL COMMENT 'user account status { active, blocked, pending }'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user-id`, `name`, `username`, `password`, `email`, `dob`, `reg_date_time`, `status`) VALUES
(123456, 'Shanu Raj', 'shanuraj1696', '$6$rounds=1200$emailsystem$nFYs2cf2oevCuRjKwducHMvrWEwOqseJ7RtfEHN3aGyAC3SC8/6PVTTQBbLwsQr/PJMUs7GMr0bcJCHXRwLUK1', 'shanuraj1696@gmail.com', '31-March-1997', '1584384259', 'active'),
(458508, 'Shanu Raj', 'shanuraj715@gmail.com', '$6$rounds=1200$emailsystem$xIuzBWE5fBCWIl0KgF1rR.nRSNEcqjpoOWqODnfJUoRqzjgw4yrYkSC7oA5VZYBITw5FXpQO0VTMBjQ/SgVm21', 'shanuraj715@gmail.com', '06/01/1996', '1585047168', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users_otp`
--

CREATE TABLE `users_otp` (
  `id` int(3) NOT NULL,
  `user-id` bigint(6) NOT NULL,
  `otp` bigint(6) NOT NULL,
  `otp_timestamp` varchar(52) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user-id`);

--
-- Indexes for table `users_otp`
--
ALTER TABLE `users_otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user-id` bigint(6) NOT NULL AUTO_INCREMENT COMMENT 'this is random user id for every user', AUTO_INCREMENT=977541;

--
-- AUTO_INCREMENT for table `users_otp`
--
ALTER TABLE `users_otp`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
