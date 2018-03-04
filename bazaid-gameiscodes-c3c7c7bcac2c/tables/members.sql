-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2013 at 05:03 PM
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
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(15) NOT NULL,
  `team` varchar(15) NOT NULL DEFAULT 'No Team',
  `level` int(11) NOT NULL DEFAULT '1',
  `ChallangesWin` int(11) NOT NULL DEFAULT '0',
  `ChallangesLose` int(11) NOT NULL DEFAULT '0',
  `achievements_n` int(11) NOT NULL DEFAULT '0',
  `CurrXP` int(11) NOT NULL DEFAULT '0',
  `NextXP` int(64) NOT NULL DEFAULT '100',
  `info` longtext NOT NULL,
  `pic` varchar(255) NOT NULL,
  `notifications` int(11) NOT NULL,
  `IsChid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `password`, `email`, `team`, `level`, `ChallangesWin`, `ChallangesLose`, `achievements_n`, `CurrXP`, `NextXP`, `info`, `pic`, `notifications`, `IsChid`) VALUES
(1, 'bazaid', '0d5a2770f51788d401a235a5cbca3c0b8e1fd9fa', 'test@test.com', 'No Team', 1, 0, 0, 0, 0, 500, 'nothing', 'default.png', 2, 'NO'),
(2, 'uncoder', '0d5a2770f51788d401a235a5cbca3c0b8e1fd9fa', 'test@test.com', 'hh', 14, 2, 1, 1, 8400, 9000, '''', 'default.png', 0, 'NO');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
