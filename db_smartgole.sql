-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 08:51 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smartgole`
--

-- --------------------------------------------------------

--
-- Table structure for table `sg_tbladminusers`
--

CREATE TABLE `sg_tbladminusers` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `displayname` varchar(200) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `isactive` int(1) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT NULL,
  `createdDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sg_tblcommonmaster`
--

CREATE TABLE `sg_tblcommonmaster` (
  `autoid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `isactive` int(11) DEFAULT '1',
  `isdelete` int(11) NOT NULL DEFAULT '0',
  `otherfield` varchar(200) DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sg_tblcommonmaster`
--

INSERT INTO `sg_tblcommonmaster` (`autoid`, `title`, `description`, `created_on`, `start_time`, `end_time`, `isactive`, `isdelete`, `otherfield`, `userid`) VALUES
(1, 'Texas Technologies', '', '2020-07-18', '00:00:00', '00:00:00', 1, 0, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sg_tbladminusers`
--
ALTER TABLE `sg_tbladminusers`
  ADD KEY `Index 1` (`userid`);

--
-- Indexes for table `sg_tblcommonmaster`
--
ALTER TABLE `sg_tblcommonmaster`
  ADD PRIMARY KEY (`autoid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sg_tbladminusers`
--
ALTER TABLE `sg_tbladminusers`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sg_tblcommonmaster`
--
ALTER TABLE `sg_tblcommonmaster`
  MODIFY `autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
