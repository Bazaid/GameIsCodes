-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2013 at 06:02 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gameiscodes`
--

-- --------------------------------------------------------

--
-- Table structure for table `mainchallanges`
--

CREATE TABLE IF NOT EXISTS `mainchallanges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `level` text NOT NULL,
  `info` text NOT NULL,
  `limit` text NOT NULL,
  `chid` int(11) NOT NULL,
  `pic` text NOT NULL,
  `limitnum` double NOT NULL,
  `answer` text NOT NULL,
  `xp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mainchallanges`
--

INSERT INTO `mainchallanges` (`id`, `name`, `level`, `info`, `limit`, `chid`, `pic`, `limitnum`, `answer`, `xp`) VALUES
(1, 'Week Challange', 'Unknown', 'Unknown', 'No Limit', 1, 'WeekChallange.png', 168, '3', 1000),
(2, 'Test Challange', 'Very Easy', 'Just a simple test challange to try', '1 Minute', 2, 'TestChallange.png', 0.017, '3', 50),
(3, 'BufferLover', 'Easy', 'Slove this buffer overflow code in C++', 'No Limit', 3, 'BufferLover.png', 0, 'char*mem=(char*)malloc(sizeof(buffer));', 50),
(4, 'Bypass The Page', 'Normal', 'Find the way to login to the next page', 'No Limit', 4, 'BypassPage.png', 0.5, 'x9000hx', 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
