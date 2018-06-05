-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2018 at 09:16 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `priyanka_thesis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `collected_data`
--

CREATE TABLE `collected_data` (
  `id` int(250) NOT NULL,
  `job_title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `requirements` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_roles`
--

CREATE TABLE `job_roles` (
  `id` int(250) NOT NULL,
  `category_id` int(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_categ_list`
--

CREATE TABLE `req_categ_list` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` enum('active','disabled','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_categ_list`
--

INSERT INTO `req_categ_list` (`id`, `name`, `description`, `status`) VALUES
(1, 'Education', '', 'active'),
(2, 'OS', '', 'active'),
(3, 'Testing Tools', '', 'active'),
(4, 'SQL', '', 'active'),
(5, 'Issue Tracking Tool', '', 'active'),
(6, 'Unit Tests', '', 'active'),
(7, 'Integration Tests', '', 'active'),
(8, 'Agile management', '', 'active'),
(9, 'Build Server', '', 'active'),
(10, 'Static Code Analysis', '', 'active'),
(11, 'Version Control System', '', 'active'),
(14, 'Certifications', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `req_list`
--

CREATE TABLE `req_list` (
  `id` int(250) NOT NULL,
  `req_categ` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_name`, `password`, `name`, `email`, `role`) VALUES
(1, 'athul', 'f97223dddf692dfd903332bbec69d407', 'Athul', 'athullive@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collected_data`
--
ALTER TABLE `collected_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_roles`
--
ALTER TABLE `job_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_categ_list`
--
ALTER TABLE `req_categ_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_list`
--
ALTER TABLE `req_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collected_data`
--
ALTER TABLE `collected_data`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_categ_list`
--
ALTER TABLE `req_categ_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `req_list`
--
ALTER TABLE `req_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
