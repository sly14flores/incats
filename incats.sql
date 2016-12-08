-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2016 at 10:23 PM
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
  `is_activated` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_type`, `student_id`, `first_name`, `middle_name`, `last_name`, `gender`, `address`, `contact_no`, `birthdate`, `age`, `username`, `password`, `email`, `built_in`, `is_activated`) VALUES
(1, 'Administrator', '', 'Admin', '', '', '', '', '', '0000-00-00', 0, 'admin', 'admin', '', 1, 1),
(2, 'Applicant', '131-0428-5', 'Mary Claire', 'Senilla', 'Macabenta', 'Female', 'Balaoan', '09128818668', '1996-08-11', 20, 'claire', 'claire', 'sly@christian.com.ph', 2147483647, 1),
(3, 'Applicant', '131-0428-2', 'Keesha', 'Vega', 'Javier', 'Female', 'Bacnotan', '09498439978', '1996-11-27', 19, 'Keesha', 'javier', 'keeshajavier@yahoo.com', 2147483647, 1),
(4, 'Applicant', '131-0441-5', 'pamela', 'alcantara', 'ledda', 'Female', 'Bacnotan', '09461234671', '1995-09-17', 21, 'pamela', 'ledda', 'pamelaledda@yahoo.com', 2147483647, 1),
(5, 'Applicant', '131-0432-8', 'renella', 'ledda', 'acosta', 'Female', 'Bauang', '09084563634', '1994-04-09', 22, 'nella', 'acosta', 'renella@yahoo.com', 2147483647, 1),
(6, 'Applicant', '131-0441-7', 'Mikkah', 'Haha', 'Corpuz', 'Female', 'bauang', '09306583857', '1996-12-06', 19, 'mikkah', 'mikkah', 'mikkah@yahoo.com', 2147483647, 1),
(7, 'Applicant', '131-0428-1', 'Kaye', 'kin', 'Chu', 'Female', 'Bacnotan', '09498439978', '1995-11-27', 20, 'kaye', 'kaye', 'kayeA@yahoo.com', 2147483647, 1),
(8, 'Applicant', '131-1242-9', 'John', 'ken', 'Lui', 'Male', 'Luna', '09087765657', '1998-03-06', 18, 'john', '123', 'john@yahoo.com', 2147483647, 1),
(9, 'Applicant', '131-0436-9', 'jovy', 'accosta', 'abuan', 'Female', 'san fernando', '09464573435', '1995-07-08', 21, 'jovy', 'jovy', 'jovyabuan@yahoo.com', 2147483647, 1),
(10, 'Applicant', '131-0976-6', 'eman', 'joe', 'bautista', 'Male', 'agoo', '0936134388', '1998-01-02', 18, 'eman', 'eman', 'eman@yahoo.com', 2147483647, 1),
(11, 'Applicant', '', 'La mej', 'pirena', 'maldita', '', '', '', '0000-00-00', 0, 'mejo', 'mejo', 'mejo@gmail.com', 0, 1),
(12, 'Applicant', '', 'maria', 'andres', 'sabado', '', '', '', '0000-00-00', 0, 'maria', 'maria', 'maria@gmail.com', 0, 1),
(13, 'Applicant', '131-1246-2', 'Mary', 'uce', 'cary', 'Female', 'BAUANG', '09127121222', '1996-11-24', 19, 'marycary', 'mary', 'cary@gmail.com', 2147483647, 1),
(14, 'Applicant', '2424849', 'Mary Renella Mikkah Keesha Pamela', 'S B D V A', 'Macabenta Acosta Corpuz Javier Ledda', 'Female', 'Jan Jan lng sa tabi', '0912345678', '1996-11-27', 19, 'bastauser', '1234', 'sbdva@ayoko.nga', 2147483647, 1),
(15, 'Applicant', '131-1234-2', 'Joseph', 'Avatar', 'Patacsil', 'Male', 'kahit saan', '09090909090', '1996-11-23', 19, 'avatar', 'avatar', 'avatar@yahoo.com', 2147483647, 1),
(16, 'Applicant', '', 'pam', 'ala', 'bee', '', '', '', '0000-00-00', 0, 'pam', 'pam', 'pam@gmailcom', 0, 1),
(17, 'Applicant', '123', 'jake', 'c', 'alminiana', 'Male', 'sapilang', '9161212212', '1996-12-03', 19, 'jako', '123', 'dmmmsu@dmmmsu.edu.ph', 2147483647, 1),
(18, 'Applicant', '', 'robert', 'go', 'see', '', '', '', '0000-00-00', 0, 'robert', 'robert', 'robert@gmail.com', 0, 1),
(19, 'Applicant', '', 'robert', 'go', 'see', '', '', '', '0000-00-00', 0, 'robert', 'robert', 'robert@gmail.com', 0, 1),
(20, 'Applicant', '123456789', 'enrique', 'geneta', 'abad', 'Male', 'payocpoc sur', '09095679089', '2010-07-20', 6, 'enrique', 'enrique', 'geneta@yahoo.com', 2147483647, 1),
(21, 'Applicant', '00000', 'erma', 'erosa', 'panganiban', 'Female', 'poblacion sur, caba, la union', '09102911866', '1983-01-02', 33, 'erma', 'honeybear010911', 'ermaerosa@yahoo.com', 2147483647, 1),
(22, 'Applicant', '12345678', 'jonathan', 'javier', 'estilong', 'Male', 'majiadsdak', '0975789549', '1984-01-17', 32, 'javier', 'javier', 'jje@yahoo.com', 2147483647, 1),
(23, 'Applicant', '', 'Sly', 'Bulilan', 'Flores', '', '', '', '0000-00-00', 0, 'sly', 'legend', 'sly@christian.com.ph', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_activations`
--

CREATE TABLE IF NOT EXISTS `account_activations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(10) NOT NULL,
  `activation_code` int(5) NOT NULL,
  `date_activated` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account_activations`
--

INSERT INTO `account_activations` (`id`, `account_id`, `activation_code`, `date_activated`) VALUES
(1, 23, 18374, '2016-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `heading` varchar(500) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `announcement_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `heading`, `content`, `announcement_date`) VALUES
(2, 'announcement', 'test', '2016-11-17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `dismiss_notifications`
--

INSERT INTO `dismiss_notifications` (`id`, `account_id`, `scholarship_id`) VALUES
(1, 2, 1),
(2, 8, 1),
(3, 8, 7),
(4, 8, 5),
(5, 2, 5),
(6, 2, 7),
(7, 4, 1),
(8, 4, 5),
(9, 4, 7),
(10, 3, 1),
(11, 3, 5),
(12, 3, 7),
(13, 5, 1),
(14, 5, 5),
(15, 5, 7),
(16, 9, 1),
(17, 9, 5),
(18, 9, 7),
(19, 10, 1),
(20, 10, 5),
(21, 10, 7),
(22, 1, 3),
(23, 1, 4),
(24, 1, 6),
(25, 1, 8),
(26, 1, 9),
(27, 13, 1),
(28, 13, 5),
(29, 13, 7),
(31, 1, 13),
(32, 1, 12),
(33, 1, 12),
(34, 1, 12),
(35, 1, 12),
(36, 16, 1),
(37, 16, 5),
(38, 16, 7),
(40, 16, 13),
(41, 16, 14),
(42, 17, 5),
(43, 17, 14),
(45, 17, 7),
(46, 17, 1),
(47, 17, 13),
(48, 1, 16),
(49, 1, 18),
(51, 1, 20),
(52, 1, 21),
(53, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `heading` varchar(500) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `event_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `heading`, `content`, `event_date`) VALUES
(1, 'heading', 'adfdhadferg', '2016-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE IF NOT EXISTS `memos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `file` varchar(50) NOT NULL,
  `memo_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`id`, `title`, `file`, `memo_date`) VALUES
(1, 'Memo', 'apply.1.jpg', '2016-12-07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `scholarship_id`, `description`, `doc_rating`, `doc_title`) VALUES
(1, 1, 'COG', '80', 'download.PNG'),
(2, 2, 'cog', '87', 'download.PNG'),
(3, 3, 'cog', '90', 'download.PNG'),
(4, 4, 'COG', '89', 'download.PNG'),
(5, 5, 'COG', '89', 'download.PNG'),
(6, 6, 'COG', '92', 'download.PNG'),
(7, 7, 'COG', '89', 'download.PNG'),
(8, 8, 'COG', '87', 'download.PNG'),
(9, 9, 'COG', '96', 'download.PNG'),
(10, 10, 'COG', '96', 'download.PNG'),
(12, 12, 'COG', '90', 'download.PNG'),
(13, 13, 'Multiple daw po yan', '90', 'download.PNG'),
(14, 14, 'COG', '90', 'download.PNG'),
(15, 15, 'tet', 'test', 'app.docx'),
(16, 16, 'cog', '98', 'IMG_3301.JPG'),
(17, 17, 'cog', '1.0', 'IMG_3299.JPG'),
(18, 18, 'cog', '2.50', 'IMG_3465.JPG'),
(20, 20, 'COG', '90', 'IMG_3301.JPG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `account_id`, `application_type`, `programs`, `program`, `course`, `college`, `year_level`, `semester`, `school_year`, `status`, `status_date`, `evaluated`, `evaluation_date`) VALUES
(1, 2, 'New', 'University', 'Academic', 'BSIS', 'College of Computer Studies', '2', '1', '2016-2017', 'Approved', '2016-12-08 22:00:51', 2147483647, '2016-11-14 09:02:51'),
(2, 3, 'New', 'University', 'Academic', 'BS agriculture', 'College of Agriculture', '3', '2', '2016-2017', 'Approved', '2016-12-07 20:18:05', 0, '2016-11-14 09:14:19'),
(3, 4, 'New', 'Government', 'Local Code', 'BS agricultural engineering', 'College of engineering', '3', '1', '2017-2018', 'Approved', '2016-12-08 21:59:32', 0, '0000-00-00 00:00:00'),
(4, 5, 'New', 'Government', 'DA ACEF', 'BEED', 'College of Education', '4', '1', '2017-2018', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 6, 'New', 'University', 'Dependent', 'BSIS', 'College of Information System', '2', '1', '2016-2017', 'Approved', '2016-11-14 09:22:57', 2147483647, '2016-11-14 09:22:57'),
(6, 7, 'New', 'University', 'Academic', 'BS Information System', 'College of Info Tech', '2', '1', '2016-2017', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 8, 'New', 'Government', 'DA ACEF', 'BSED', 'College of education', '2', '2', '2017-2018', 'Approved', '2016-11-14 09:27:54', 2147483647, '2016-11-14 09:27:54'),
(8, 9, 'New', 'Government', 'DA ACEF', 'BEED', 'College of Education', '3', '2', '2016-2017', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 10, 'New', 'University', 'Dependent', 'BS Agroforestry', 'Institute of Agroforestry & Watershed Management', '2', '1', '2016-2017', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 10, 'New', 'University', 'Dependent', 'BS Agroforestry', 'Institute of Agroforestry & Watershed Management', '2', '1', '2016-2017', 'Disapproved', '2016-11-14 09:47:21', 2147483647, '2016-11-14 09:47:21'),
(12, 13, 'New', 'University', 'Academic', 'BSIS', 'College of Computer Studies', '2', '1', '2018-2019', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 14, 'New', 'Government', 'DSWD', 'Of Course', 'College of Course', '5', '1', '2019-2020', 'Approved', '2016-11-22 13:28:14', 2147483647, '2016-11-22 13:28:14'),
(14, 15, 'New', 'University', 'Dependent', 'BSA', 'college of agriculture', '2', '1', '2016-2017', 'Approved', '2016-11-22 17:27:47', 2147483647, '2016-11-22 17:27:47'),
(15, 17, 'Renewal', 'University', 'Academic', 'bsit', 'cit', '5', '1', '2016-2017', 'Approved', '2016-11-23 10:08:04', 2147483647, '2016-11-23 10:07:48'),
(16, 20, 'New', 'Government', 'Local Code', 'ComSci', 'bsit', '2', '1', '2019-2020', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 21, 'New', 'Government', 'DSWD', 'BS Psychology', 'CaS', '1', '1', '2016-2017', 'Approved', '2016-11-23 16:03:16', 2147483647, '2016-11-23 16:03:16'),
(18, 22, 'New', 'Government', 'CHED', 'bsit', 'cit', '1', '1', '2019-2020', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 6, 'Renewal', 'University', 'Dependent', 'BSIS', 'College of Computer Studies', '2', '1', '2016-2017', 'Approved', '2016-12-08 22:08:05', 0, '0000-00-00 00:00:00'),
(21, 2, 'Renewal', 'University', 'Dependent', 'BSIT', 'CIT', '1', '1', '2016-2017', 'On-Process', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `scholars_infos`
--

CREATE TABLE IF NOT EXISTS `scholars_infos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(10) NOT NULL,
  `course_year` varchar(20) NOT NULL,
  `last_school` varchar(100) NOT NULL,
  `school_class` varchar(100) NOT NULL,
  `gwa` float(10,2) NOT NULL,
  `last_school_year` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `tribal` varchar(100) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `spouse` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_bday` date NOT NULL,
  `mother_age` int(2) NOT NULL,
  `mother_education` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `mother_income` float(10,2) NOT NULL,
  `mother_contact` varchar(20) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_bday` date NOT NULL,
  `father_age` int(2) NOT NULL,
  `father_education` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `father_income` float(10,2) NOT NULL,
  `father_contact` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scholars_infos`
--

INSERT INTO `scholars_infos` (`id`, `account_id`, `course_year`, `last_school`, `school_class`, `gwa`, `last_school_year`, `religion`, `tribal`, `civil_status`, `spouse`, `mother_name`, `mother_bday`, `mother_age`, `mother_education`, `mother_occupation`, `mother_income`, `mother_contact`, `father_name`, `father_bday`, `father_age`, `father_education`, `father_occupation`, `father_income`, `father_contact`) VALUES
(1, 2, 'course year', 'last school attended', 'class of school', 89.00, '2016-2017', 'catholic', 'tribal', 'Single', 'not applicable', 'mother name', '2016-12-07', 40, 'mother educ', 'mother occu', 100.00, '0347', 'father name', '2016-12-08', 50, 'father educ', 'father occu', 200.00, '38748');

-- --------------------------------------------------------

--
-- Table structure for table `testing_results`
--

CREATE TABLE IF NOT EXISTS `testing_results` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `scholar_id` int(10) NOT NULL,
  `testing_type` varchar(50) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `testing_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scholar_id` (`scholar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `testing_results`
--

INSERT INTO `testing_results` (`id`, `scholar_id`, `testing_type`, `rating`, `testing_date`) VALUES
(1, 2, 'PT', '21', '2016-11-17'),
(2, 4, 'CAT', '85', '2016-11-17'),
(3, 5, 'PT', '90', '2016-11-17'),
(4, 6, 'PT', '88', '2016-11-17'),
(5, 3, 'CAT', '93', '2016-11-22'),
(6, 14, 'PT', '101', '2016-11-22'),
(7, 14, 'CAT', '2001', '2016-11-22');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_activations`
--
ALTER TABLE `account_activations`
  ADD CONSTRAINT `account_activations_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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

--
-- Constraints for table `scholars_infos`
--
ALTER TABLE `scholars_infos`
  ADD CONSTRAINT `scholars_infos_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `testing_results`
--
ALTER TABLE `testing_results`
  ADD CONSTRAINT `testing_results_ibfk_2` FOREIGN KEY (`scholar_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
