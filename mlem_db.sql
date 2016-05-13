-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2016 at 02:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mlem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_name` text NOT NULL,
  `category_description` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `timestamp`, `category_name`, `category_description`) VALUES
(1, '2016-05-12 15:02:52', 'Malware Analysis', ''),
(2, '2016-05-12 15:03:06', 'Digital Forensic', ''),
(3, '2016-05-12 15:03:22', 'Incident Response', ''),
(4, '2016-05-12 15:03:34', 'Management', '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pg_product` text NOT NULL,
  `pg_title` text NOT NULL,
  `pg_company` text NOT NULL,
  `pg_about` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `pg_product`, `pg_title`, `pg_company`, `pg_about`) VALUES
(1, 'Mlemer', 'Mlemer', 'Company, Inc. Powered by <a href="https://github.com/alternat0r/Mlemer" target="_blank">Mlemer</a>', '<strong>Mlemer</strong> is a quiz, exercise, CTF or questionnaire system designed for trainer. It is designed meant to be a simplified looking UI and easy to manage. This system is not suitable to be used for public access. It is designed for local network only. Used at your own risk.\r\n<br/>\r\n<br/>\r\n<div class="bs-callout bs-callout-info">\r\n    <h4>Credit</h4>\r\n    <p>Twitter Bootstrap</p>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activated` int(11) NOT NULL,
  `exer_name` text NOT NULL,
  `exer_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `timestamp`, `activated`, `exer_name`, `exer_description`) VALUES
(1, '2016-05-12 15:48:55', 1, 'Digital Forensics Training', 'In this training you will be teaching about how to handle an evidence.'),
(2, '2016-05-12 13:09:15', 1, 'Incident Response Training', 'You will be train about how to handle incident and its procedures.'),
(3, '2016-05-12 15:48:59', 1, 'Malware Analysis', 'You will learned about analyzing malware using several tools and comes with practical analysis for better understanding.');

-- --------------------------------------------------------

--
-- Table structure for table `questionaire`
--

CREATE TABLE IF NOT EXISTS `questionaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `point` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `questionaire`
--

INSERT INTO `questionaire` (`id`, `exercise_id`, `question`, `answer`, `point`) VALUES
(1, 3, 'What is current offset of printf() now?', '0x4001223', 10),
(2, 1, 'Which evidence saying that you are completed the analysis?', 'Judge', 10),
(3, 2, 'Complainant have been lost their finance due to the cyber-extortion. What is the first step for the complainant to do?', 'Make a police report', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_loginname` text,
  `user_realname` text,
  `user_password` text,
  `user_activated` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` text NOT NULL,
  `user_hostname` text NOT NULL,
  `user_uid` text NOT NULL,
  `user_point` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_loginname`, `user_realname`, `user_password`, `user_activated`, `timestamp`, `user_ip`, `user_hostname`, `user_uid`, `user_point`) VALUES
(29, 'potat', 'Potata Tutu', '', 1, '2016-05-10 16:01:59', '192.168.78.1', 'alternat0r-bot', 'fd990a8447ea2015f155a9ade98ea61240057268', 0),
(30, 'rosman', 'Rosman Mansor', '', 0, '2016-05-13 02:47:50', '192.168.117.78', 'wcs7-PC', '77ba56660b9b07506c46429b13f9d95bc37ecd6d', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
