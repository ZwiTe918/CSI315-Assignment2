-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 03:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mitre`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `coursecode` varchar(50) NOT NULL,
  `coursetitle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`coursecode`, `coursetitle`) VALUES
('abc123', 'science'),
('def123', 'agriculture'),
('dft123', 'vegetation'),
('eng121', 'psychology'),
('fgt123', 'Biology'),
('frt123', 'Biology'),
('jkl123', 'Biology'),
('mat344', 'Biology'),
('psy101', 'psychology');

-- --------------------------------------------------------

--
-- Table structure for table `gradebook`
--

CREATE TABLE `gradebook` (
  `coursecode` varchar(10) NOT NULL,
  `studentid` int(10) NOT NULL,
  `grade` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradebook`
--

INSERT INTO `gradebook` (`coursecode`, `studentid`, `grade`) VALUES
('abc123', 202001234, 25),
('abc123', 202002554, 49),
('abc123', 202003667, 80),
('def123', 202001234, 50),
('eng121', 201305897, 40),
('eng121', 201509724, 38),
('psy101', 201305897, 67),
('psy101', 201509724, 30);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(10) NOT NULL,
  `emailaddress` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `postaladdress` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `emailaddress`, `name`, `postaladdress`) VALUES
(201305897, '201305897@ub.ac.bw', 'Mogapi', 'POBOX675'),
(201509724, '201509724@ub.ac.bw', 'Tumi', 'POBOX855'),
(202001234, '202001234@ub.ac.bw', 'Majorowe', 'PO BOX 123'),
(202002554, '202002554@ub.ac.bw', 'Conlicious', 'PO BOX 554'),
(202003667, '202003667@ub.ac.bw', 'Matheus', 'PO BOX 891'),
(202004932, '202004932@ub.ac.bw', 'Sarah', 'PO BOX 932'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`coursecode`);

--
-- Indexes for table `gradebook`
--
ALTER TABLE `gradebook`
  ADD PRIMARY KEY (`coursecode`,`studentid`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`,`emailaddress`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gradebook`
--
ALTER TABLE `gradebook`
  ADD CONSTRAINT `gradebook_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `gradebook_ibfk_2` FOREIGN KEY (`coursecode`) REFERENCES `course` (`coursecode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
