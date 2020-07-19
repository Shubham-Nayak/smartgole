-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 03:17 PM
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

--
-- Dumping data for table `sg_tbladminusers`
--

INSERT INTO `sg_tbladminusers` (`userid`, `username`, `password`, `displayname`, `profile_pic`, `isactive`, `isDeleted`, `createdDtm`) VALUES
(1, 'kabirn408@gmail.com', '9175477080', 'Shubham Nayak', '', 1, 0, '2020-07-19 17:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `sg_tblcommonmaster`
--

CREATE TABLE `sg_tblcommonmaster` (
  `autoid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `created_on` date NOT NULL,
  `expexted_time` time DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `isactive` int(11) DEFAULT '1',
  `isdelete` int(11) NOT NULL DEFAULT '0',
  `otherfield` varchar(200) DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sg_tblcommonmaster`
--
ALTER TABLE `sg_tblcommonmaster`
  MODIFY `autoid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
