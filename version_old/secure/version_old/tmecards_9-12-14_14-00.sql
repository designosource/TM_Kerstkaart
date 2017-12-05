-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2014 at 01:48 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.35-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tmecards`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_url` text NOT NULL,
  `card_title` text NOT NULL,
  `card_type` text NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_url`, `card_title`, `card_type`) VALUES
(1, 'kaart_1', 'Placeholder 1', 'animated'),
(2, 'kaart_2', 'Placeholder 2', 'static'),
(3, 'kaart_3', 'Placeholder 3', 'static');

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE IF NOT EXISTS `receiver` (
  `receiver_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_firstname` varchar(255) NOT NULL,
  `receiver_lastname` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`receiver_id`,`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `receiver`
--

INSERT INTO `receiver` (`receiver_id`, `receiver_firstname`, `receiver_lastname`, `receiver_email`, `sender_id`) VALUES
(1, 'Kristof', 'Espen', 'krisvanespen@hotmail.com', 1),
(2, 'David', 'Heerinckx', 'david.heerinckx@thomasmore.be', 2),
(3, 'Kristof', 'Espen', 'krisvanespen@hotmail.com', 3),
(4, 'Erika', 'Pelemans', 'erika.pelemans@thomasmore.be', 4),
(5, 'Liesbeth', 'Vanaerschot', 'lies.vanaerschot@gmail.com', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE IF NOT EXISTS `sender` (
  `sender_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_firstname` varchar(255) NOT NULL,
  `sender_lastname` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_message` varchar(500) NOT NULL,
  PRIMARY KEY (`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sender`
--

INSERT INTO `sender` (`sender_id`, `sender_firstname`, `sender_lastname`, `sender_email`, `sender_message`) VALUES
(1, 'Kristof', 'Van Espen', 'r0364401@student.thomasmore.be', 'Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!'),
(2, 'David', 'Heerinckx', 'david.heerinckx@thomasmore.be', 'Tart pastry cookie tart jelly-o ice cream. Powder topping marzipan cheesecake fruitcake jelly-o. Croissant cake brownie liquorice sweet roll pie chocolate. \nPie lollipop jelly-o sesame snaps tiramisu sweet roll dessert chocolate cake. Topping toffee croissant jelly candy canes tart. Applicake toffee sweet candy canes icing croissant. Tart lemon drops oat cake dragÃ©e applicake muffin tart. Pudding dragÃ©e lollipop ice cream muffin icing pudding. '),
(3, 'Kristof', 'Van Espen', 'r0364401@student.thomasmore.be', 'Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!'),
(4, 'Erika', 'Pelemans', 'erika.pelemans@thomasmore.be', 'Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!'),
(5, 'Liesbeth', 'Vanaerschot', 'r0330949@student.thomasmore.be', 'Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
