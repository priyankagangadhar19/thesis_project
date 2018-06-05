-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 05:02 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis_project`
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
  `domain_id` int(255) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_role_domain`
--

CREATE TABLE `job_role_domain` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_categ_list`
--

CREATE TABLE `req_categ_list` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_categ_list`
--

INSERT INTO `req_categ_list` (`id`, `name`, `description`) VALUES
(1, 'Education', ''),
(2, 'OS', ''),
(3, 'Testing Tools', ''),
(4, 'SQL', ''),
(5, 'Issue Tracking Tool', ''),
(6, 'Unit Tests', ''),
(7, 'Integration Tests', ''),
(8, 'Agile management', ''),
(9, 'Build Server', ''),
(10, 'Static Code Analysis', ''),
(11, 'Version Control System', ''),
(14, 'Certifications', '');

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
  `role` set('normal','admin','','') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_name`, `password`, `name`, `email`, `role`) VALUES
(1, 'athul', 'f97223dddf692dfd903332bbec69d407', 'Athul', 'athullive@gmail.com', 'admin'),
(2, 'priyanka', '81dc9bdb52d04dc20036dbd8313ed055', 'Priyanka Gangadhar', 'priyankagangadhar19@gmail.com', 'admin');

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
-- Indexes for table `job_role_domain`
--
ALTER TABLE `job_role_domain`
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
-- AUTO_INCREMENT for table `job_role_domain`
--
ALTER TABLE `job_role_domain`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
