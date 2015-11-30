-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2015 at 11:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secure_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),
(4, 'hello', 'email@mail.com', '1fcc3b54a4f0401719bec87b2923b21ae832e2f1739408db496d52825925c0908908d165eebd3516296469b33a6e9ffc49c5e30023a5fb4874ba4666438e0e04', 'a67d024a64d8597db344a8bf398391fecb7b669aaa3c2bdf47411e8c0252fd1852a876585884687c24e37104746f1e223d5756ead8abb62686f77c957a60fbc2'),
(3, 'Not_Me', 'not_me@mail.com', '1963221becead80ec1d1eb1ac2defc71a2d6f00797a071d04f35ac9f48ea466258e4928dd670f953a9aa7fc511dad498df1d9d2d5583544172e1bda9a821407e', '56d0128d5b124b0ede3c8ff57e112110c2b9cc5c6a91c15535f5857d4625ef6607fda3485e5c008ea9234bde2b6fe02bf376a5bea0e2f0a8d7590e238bde90a6');
--
-- Database: `shop_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_info`
--

CREATE TABLE IF NOT EXISTS `member_info` (
  `user_id` int(11) NOT NULL COMMENT 'user id to sync with secure_login members',
  `rating_up` int(11) NOT NULL COMMENT 'votes up for this person',
  `rating_down` int(11) NOT NULL COMMENT 'votes down for this person',
  `conduct` int(11) NOT NULL COMMENT 'misconducts by this person',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posted_lists`
--

CREATE TABLE IF NOT EXISTS `posted_lists` (
  `header` tinytext NOT NULL COMMENT 'Header for the post',
  `text` text NOT NULL COMMENT 'Text within post',
  `submit_time` timestamp NOT NULL COMMENT 'Time of submission',
  `user_id` int(11) NOT NULL COMMENT 'ID of the poster',
  `drop_off` varchar(255) NOT NULL COMMENT 'Location of item pickup',
  `item_types` set('food','clothes','electronics','supplies','misc') DEFAULT NULL COMMENT 'Types of items included',
  `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID for the post',
  `last_edit` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last time editted',
  `fee` decimal(18,2) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Database for listings' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `posted_lists`
--

INSERT INTO `posted_lists` (`header`, `text`, `submit_time`, `user_id`, `drop_off`, `item_types`, `post_id`, `last_edit`, `fee`) VALUES
('Need bananas', 'Bananas, bananas, bananas, bananas\r\n\r\n-bananas\r\n-bananas\r\n-bananas\r\n-bananas\r\n-bananas\r\n-bananas\r\n-orange\r\n-bananas\r\n-bananas\r\n', '2015-11-30 17:23:30', 1, 'my place', 'food', 2, '2015-11-30 17:23:30', '2.00'),
('ME WANT APPLE', ' apple apple applsfp pasldp aplple', '2015-11-30 16:28:38', 2, 'apple orchard', 'food,clothes', 3, '0000-00-00 00:00:00', '100.00'),
('TITLE', 'MORE TOPPINGS', '0000-00-00 00:00:00', 3, 'safdg', 'food,supplies', 4, '0000-00-00 00:00:00', '45.12'),
('TITLE', 'MORE TOPPINGS', '0000-00-00 00:00:00', 3, 'safdg', 'food,supplies', 5, '0000-00-00 00:00:00', '45.12'),
('Need shoes', 'I need shoes please\\r\\nsize 9', '0000-00-00 00:00:00', 3, 'Libra parking lot', 'clothes', 6, '0000-00-00 00:00:00', '12.00'),
('Propane', 'propane', '0000-00-00 00:00:00', 3, 'trailer', 'supplies', 7, '0000-00-00 00:00:00', '10000.00'),
('Propane2', 'propane\\r\\npropane\\r\\npropane\\r\\npropane', '0000-00-00 00:00:00', 3, 'trailer', 'supplies', 8, '0000-00-00 00:00:00', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `user_id` int(11) NOT NULL COMMENT 'who was voted',
  `type` enum('up','down') NOT NULL COMMENT 'type of vote',
  `voter` int(11) NOT NULL COMMENT 'who voted'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `test`
--
--
-- Database: `www`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
