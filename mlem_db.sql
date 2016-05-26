-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 03:47 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_name` text NOT NULL,
  `category_description` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `timestamp`, `category_name`, `category_description`) VALUES
(1, '2016-05-18 13:35:44', 'Malware Analysis', 'Doing some basic malware analysis.'),
(2, '2016-05-18 13:36:26', 'Digital Forensic', 'Learn how digital forensics dissect the evidence.'),
(3, '2016-05-12 15:03:22', 'Incident Response', ''),
(15, '2016-05-17 14:20:53', 'General', 'This is general purpose category.');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pg_product` text NOT NULL,
  `pg_title` text NOT NULL,
  `pg_company` text NOT NULL,
  `pg_about` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `timestamp`, `pg_product`, `pg_title`, `pg_company`, `pg_about`) VALUES
(1, '2016-05-26 15:46:19', 'Mlemer', 'Mlemer', 'Company, Inc. Powered by <a href="https://github.com/alternat0r/Mlemer">Mlemer</a>', '');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activated` int(11) NOT NULL DEFAULT '1',
  `exer_name` text NOT NULL,
  `exer_cat_id` text NOT NULL,
  `exer_description` char(255) NOT NULL DEFAULT 'Not available.',
  `exer_long` char(255) NOT NULL DEFAULT 'Not available.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `timestamp`, `activated`, `exer_name`, `exer_cat_id`, `exer_description`, `exer_long`) VALUES
(1, '2016-05-17 13:08:12', 1, 'Digital Forensics Training', '2', 'In this training you will be teaching about how to handle an evidence.', ''),
(2, '2016-05-17 13:08:03', 1, 'Incident Response Training', '3', 'You will be train about how to handle incident and its procedures.', ''),
(3, '2016-05-17 13:07:50', 1, 'Malware Analysis', '1', 'You will learned about analyzing malware using several tools and comes with practical analysis for better understanding.', '');

-- --------------------------------------------------------

--
-- Table structure for table `questionaire`
--

DROP TABLE IF EXISTS `questionaire`;
CREATE TABLE IF NOT EXISTS `questionaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `exercise_id` int(11) NOT NULL DEFAULT '15',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `point` int(11) NOT NULL DEFAULT '10',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionaire`
--

INSERT INTO `questionaire` (`id`, `timestamp`, `exercise_id`, `question`, `answer`, `point`) VALUES
(1, '2016-05-13 16:14:03', 3, 'What is current offset of printf() now?', '0x4001223', 10),
(2, '2016-05-13 16:14:03', 1, 'Which evidence saying that you are completed the analysis?', 'Judge', 10),
(3, '2016-05-13 16:14:03', 2, 'Complainant have been lost their finance due to the cyber-extortion. What is the first step for the complainant to do?', 'Make a police report', 10),
(4, '2016-05-13 16:14:03', 3, 'Jump instruction in Assembly?', 'JMP', 5),
(5, '2016-05-13 16:14:03', 3, 'Which of the following system calls is most likely to be used by a keylogger?\r\n', 'GetAsyncKeyState', 10),
(6, '2016-05-13 16:14:03', 3, 'Which x86 register is most commonly used for storing a function''s return value in assembler?', 'EAX', 10),
(7, '2016-05-13 16:14:03', 3, 'Which of the following tools best supports the concept of breakpoints?\r\n', 'Debugger', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_loginname` text,
  `user_realname` text,
  `user_password` text,
  `user_activated` int(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` text NOT NULL,
  `user_hostname` text NOT NULL,
  `user_uid` text NOT NULL,
  `user_point` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_loginname`, `user_realname`, `user_password`, `user_activated`, `timestamp`, `user_ip`, `user_hostname`, `user_uid`, `user_point`) VALUES
(41, 'tom', 'Tom Rider', '', 1, '2016-05-15 12:35:26', '192.168.54.1', 'trump-user', 'fe990a8447ea2015f155a9ade98ea61240057268', 10),
(43, 'under', 'Under Taker', '', 1, '2016-05-15 12:55:35', '192.168.23.1', 'sultan-pc', 'fe990a8447ea2015f155a9ade98ea61240057268', 35),
(44, 'kesuma', 'Kesuma Dewi', '', 1, '2016-05-15 15:54:42', '192.168.77.1', 'muchwow-pc', 'fe990a8447ea2015f155a9ade98ea61240057268', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_answer`
--

DROP TABLE IF EXISTS `users_answer`;
CREATE TABLE IF NOT EXISTS `users_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` text NOT NULL,
  `user_last_exercise_id` text NOT NULL,
  `user_last_qid` text NOT NULL,
  `user_last_answer` text NOT NULL,
  `correct` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_answer`
--

INSERT INTO `users_answer` (`id`, `timestamp`, `user_id`, `user_last_exercise_id`, `user_last_qid`, `user_last_answer`, `correct`) VALUES
(44, '2016-05-17 12:56:41', '44', '1', '2', 'judge', 'yes'),
(43, '2016-05-15 15:56:00', '44', '3', '1', '0x4001223', 'yes'),
(42, '2016-05-15 15:55:38', '44', '3', '7', 'debugger', 'yes'),
(28, '2016-05-15 12:38:01', '41', '2', '3', 'make a police report', 'yes'),
(37, '2016-05-15 13:21:59', '43', '3', '1', '', 'no'),
(35, '2016-05-15 12:57:55', '43', '3', '4', 'jmp', 'yes'),
(36, '2016-05-15 13:15:09', '43', '3', '6', 'eax', 'yes'),
(34, '2016-05-15 12:56:52', '43', '2', '3', 'make a police report', 'yes'),
(41, '2016-05-15 15:55:34', '44', '3', '6', 'eax', 'yes'),
(40, '2016-05-15 15:55:31', '44', '3', '5', 'GetAsyncKeyState', 'yes'),
(39, '2016-05-15 15:55:06', '44', '3', '4', 'jmp', 'yes'),
(38, '2016-05-15 13:22:39', '43', '3', '7', 'TEST', 'no'),
(33, '2016-05-15 12:56:39', '43', '1', '2', 'judge', 'yes'),
(45, '2016-05-15 15:56:19', '44', '2', '3', 'make a police report', 'yes'),
(46, '2016-05-17 15:03:46', '44', '5', '9', '10', 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
