-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 06:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `databasephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_rooms_db`
--

CREATE TABLE IF NOT EXISTS `approved_rooms_db` (
`id` int(11) NOT NULL,
  `room_name` text,
  `date` date DEFAULT NULL,
  `time` text,
  `email_address` text,
  `activity` text,
  `requester` text,
  `reason` varchar(255) DEFAULT NULL,
  `admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approved_rooms_db`
--

INSERT INTO `approved_rooms_db` (`id`, `room_name`, `date`, `time`, `email_address`, `activity`, `requester`, `reason`, `admin`) VALUES
(1, 'CL1', '2016-04-11', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Event', 'student', 'Approved.', 'David'),
(3, 'FD2', '2016-04-13', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Class', 'student1', 'pagination testing', 'David'),
(5, '401', '2016-04-18', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Meeting', 'student', 'Message display test I''m testing the apostrophe too', 'David'),
(6, '404', '2016-04-18', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Event', 'student', 'bug ni keith testing.', 'David'),
(7, '507', '2016-04-30', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Event', 'StudentA', 'Cancel reservation dummy data. Head to StudentA''s account then cancel this reservation. StudentB''s similar reservation would move back to pending.', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_rooms_db`
--

CREATE TABLE IF NOT EXISTS `cancel_rooms_db` (
`id` int(11) NOT NULL,
  `room_name` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `requester` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancel_rooms_db`
--

INSERT INTO `cancel_rooms_db` (`id`, `room_name`, `date`, `time`, `email_address`, `activity`, `requester`, `reason`) VALUES
(1, 'MMA1', '2016-04-11', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Event', 'student', 'Cancelled.'),
(2, 'FD1', '2016-04-11', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Class', 'student1', 'cancelled pagination');

-- --------------------------------------------------------

--
-- Table structure for table `denied_rooms_db`
--

CREATE TABLE IF NOT EXISTS `denied_rooms_db` (
`id` int(11) NOT NULL,
  `room_name` text,
  `date` date DEFAULT NULL,
  `time` text,
  `email_address` text,
  `activity` text,
  `requester` text,
  `reason` varchar(255) DEFAULT NULL,
  `admin` varchar(255) DEFAULT NULL,
  `reason_denial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denied_rooms_db`
--

INSERT INTO `denied_rooms_db` (`id`, `room_name`, `date`, `time`, `email_address`, `activity`, `requester`, `reason`, `admin`, `reason_denial`) VALUES
(1, 'CL2', '2016-04-11', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Class', 'student', 'Denied.', 'David', 'No reason was specified.'),
(2, 'MMA2', '2016-04-11', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Meeting', 'student', 'denied pagination', 'David', 'No reason was specified.'),
(3, '507', '2016-04-14', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Meeting', 'student', 'Whatever', 'David', 'No reason was specified.'),
(4, '404', '2016-04-22', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Event', 'student', 'gg', 'David', 'No reason was specified.'),
(5, '507', '2016-04-30', '8:00AM-11:00AM', 'jandavid701@yahoo.com', 'Meeting', 'StudentB', 'Cancel reservation dummy data. This will move back to pending after StudentA cancels his/her reservation.', 'Admin', 'A similar room has been accepted');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_approved_db`
--

CREATE TABLE IF NOT EXISTS `equipment_approved_db` (
`id` int(11) NOT NULL,
  `equipment_name` text,
  `quantity` int(11) DEFAULT NULL,
  `email_address` text,
  `requester` text,
  `return_status` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_approved_db`
--

INSERT INTO `equipment_approved_db` (`id`, `equipment_name`, `quantity`, `email_address`, `requester`, `return_status`) VALUES
(1, 'Speakers', 4, 'neigelyap@gmail.com', 'student', 'Returned'),
(2, 'Speakers', 1, 'jandavid701@yahoo.com', 'student', 'Returned'),
(3, 'Speakers', 1, 'jandavid701@yahoo.com', 'student', 'Returned'),
(4, 'Speakers', 3, 'jandavid701@yahoo.com', 'student', 'Returned'),
(5, 'Projector', 1, 'jandavid701@yahoo.com', 'StudentA', 'For Verification');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_available_db`
--

CREATE TABLE IF NOT EXISTS `equipment_available_db` (
`id` int(11) NOT NULL,
  `equipment_name` text,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_available_db`
--

INSERT INTO `equipment_available_db` (`id`, `equipment_name`, `quantity`) VALUES
(1, 'Speakers', 6),
(2, 'Projector', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_denied_db`
--

CREATE TABLE IF NOT EXISTS `equipment_denied_db` (
`id` int(11) NOT NULL,
  `equipment_name` text,
  `quantity` int(11) DEFAULT NULL,
  `email_address` text,
  `requester` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_denied_db`
--

INSERT INTO `equipment_denied_db` (`id`, `equipment_name`, `quantity`, `email_address`, `requester`) VALUES
(1, 'Speakers', 2, 'neigelyap@gmail.com', 'student'),
(2, 'Speakers', 1, 'jandavid701@yahoo.com', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_pending_db`
--

CREATE TABLE IF NOT EXISTS `equipment_pending_db` (
`id` int(11) NOT NULL,
  `equipment_name` text,
  `quantity` int(11) DEFAULT NULL,
  `email_address` text,
  `requester` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_pending_db`
--

INSERT INTO `equipment_pending_db` (`id`, `equipment_name`, `quantity`, `email_address`, `requester`) VALUES
(1, 'Speakers', 2, 'jandavid701@yahoo.com', 'StudentA'),
(2, 'Projector', 1, 'jandavid701@yahoo.com', 'StudentB');

-- --------------------------------------------------------

--
-- Table structure for table `pending_rooms_db`
--

CREATE TABLE IF NOT EXISTS `pending_rooms_db` (
`id` int(11) NOT NULL,
  `email_address` text,
  `activity` text,
  `requester` text,
  `room` text,
  `date` text,
  `time` text,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_rooms_db`
--

INSERT INTO `pending_rooms_db` (`id`, `email_address`, `activity`, `requester`, `room`, `date`, `time`, `reason`) VALUES
(1, 'jandavid701@yahoo.com', 'Class', 'StudentA', '501', '2016-04-24', '8:00AM-11:00AM', 'Pending rooms dummy data. StudentB will also reserve for this room. Approve this one.'),
(2, 'jandavid701@yahoo.com', 'Event', 'StudentA', '502', '2016-04-25', '2:45PM-5:45PM', 'Pending rooms dummy data. Approve this room. This one is unique.'),
(3, 'jandavid701@yahoo.com', 'Meeting', 'StudentA', '503', '2016-04-26', '8:00AM-11:00AM', 'Pending rooms dummy data. Deny this room. This one is also unique.'),
(4, 'jandavid701@yahoo.com', 'Event', 'StudentB', '501', '2016-04-24', '8:00AM-11:00AM', 'Pending rooms dummy data. StudentA''s reservation will be accepted. This should automatically move to denied rooms.');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
`id` int(11) NOT NULL,
  `username` text CHARACTER SET ascii,
  `password` text CHARACTER SET ascii,
  `ADMINorSTUDENT` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `username`, `password`, `ADMINorSTUDENT`) VALUES
(1, 'Admin', '4e7afebcfbae000b22c7c85e5560f89a2a0280b4', 0),
(2, 'StudentA', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(3, 'StudentB', '2abd55e001c524cb2cf6300a89ca6366848a77d5', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_rooms_db`
--
ALTER TABLE `approved_rooms_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_rooms_db`
--
ALTER TABLE `cancel_rooms_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `denied_rooms_db`
--
ALTER TABLE `denied_rooms_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_approved_db`
--
ALTER TABLE `equipment_approved_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_available_db`
--
ALTER TABLE `equipment_available_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_denied_db`
--
ALTER TABLE `equipment_denied_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_pending_db`
--
ALTER TABLE `equipment_pending_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_rooms_db`
--
ALTER TABLE `pending_rooms_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_rooms_db`
--
ALTER TABLE `approved_rooms_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cancel_rooms_db`
--
ALTER TABLE `cancel_rooms_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `denied_rooms_db`
--
ALTER TABLE `denied_rooms_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `equipment_approved_db`
--
ALTER TABLE `equipment_approved_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `equipment_available_db`
--
ALTER TABLE `equipment_available_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipment_denied_db`
--
ALTER TABLE `equipment_denied_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipment_pending_db`
--
ALTER TABLE `equipment_pending_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pending_rooms_db`
--
ALTER TABLE `pending_rooms_db`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
