-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2018 at 02:13 AM
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

--
-- Dumping data for table `collected_data`
--

INSERT INTO `collected_data` (`id`, `job_title`, `url`, `requirements`) VALUES
(1, 'PHP Dev', 'http://aefsdgsdg.fdbddf', 'PHP, CodeIgniter, HTML, Bachelor in Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` enum('active','disabled','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `category`, `description`, `status`) VALUES
(1, 'Testing', '', 'disabled'),
(4, 'test', '', 'active'),
(5, 'tes', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `job_roles`
--

CREATE TABLE `job_roles` (
  `id` int(250) NOT NULL,
  `job_category_id` int(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` enum('active','disabled','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_roles`
--

INSERT INTO `job_roles` (`id`, `job_category_id`, `role`, `description`, `status`) VALUES
(1, 1, 'Test Engineer', '', 'active');

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
(14, 'Certifications', '', 'active'),
(15, 'XYZ', '', 'active'),
(16, 'bbb', '', 'active'),
(17, 'Test', '', 'active'),
(18, 'Test', '', 'active'),
(19, 'Test', '', 'active'),
(20, 'Test', '', 'active'),
(21, 'Test', '', 'active'),
(22, 'Test', '', 'active'),
(23, 'Test', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `req_list`
--

CREATE TABLE `req_list` (
  `id` int(250) NOT NULL,
  `req_categ` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','disabled','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_list`
--

INSERT INTO `req_list` (`id`, `req_categ`, `name`, `description`, `status`) VALUES
(1, '1', 'test', '', 'active'),
(2, '', 'Test 2', '', 'active'),
(3, '', 'Test 3', '', 'active'),
(4, '', 'Test  3', '', 'active');

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
(1, 'athul', 'f97223dddf692dfd903332bbec69d407', 'Athul', 'athullive@gmail.com', 'admin'),
(2, 'priyanka', '81dc9bdb52d04dc20036dbd8313ed055', 'Priyanka G', 'priyankagangadhar19@gmail.com', 'admin');

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `req_categ_list`
--
ALTER TABLE `req_categ_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `req_list`
--
ALTER TABLE `req_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
