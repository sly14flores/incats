-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2016 at 01:04 AM
-- Server version: 5.6.20
-- PHP Version: 5.4.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `incats`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `built_in` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_type`, `student_id`, `first_name`, `middle_name`, `last_name`, `gender`, `address`, `contact_no`, `birthdate`, `age`, `username`, `password`, `email`, `built_in`) VALUES
(1, 'Administrator', '', 'Admin', '', '', '', '', '', '0000-00-00', 0, 'admin', 'admin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dismiss_notifications`
--

CREATE TABLE IF NOT EXISTS `dismiss_notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(10) NOT NULL,
  `scholarship_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `doc_rating` varchar(50) NOT NULL,
  `doc_title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE IF NOT EXISTS `scholarships` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(10) NOT NULL,
  `application_type` varchar(50) NOT NULL,
  `programs` varchar(100) NOT NULL,
  `program` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `school_year` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'On-Process',
  `status_date` datetime NOT NULL,
  `evaluated` int(10) NOT NULL,
  `evaluation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dismiss_notifications`
--
ALTER TABLE `dismiss_notifications`
  ADD CONSTRAINT `dismiss_notifications_ibfk_1` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD CONSTRAINT `scholarships_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
