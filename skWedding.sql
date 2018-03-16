-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2018 at 04:38 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.31-1~dotdeb+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skWedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `sk_guest_list`
--

CREATE TABLE IF NOT EXISTS `sk_guest_list` (
  `id_guest_list` int(11) NOT NULL AUTO_INCREMENT,
  `nm_firstname` varchar(100) NOT NULL,
  `nm_surname` varchar(100) NOT NULL,
  `tx_alt_names` varchar(1000) NOT NULL,
  `id_guest_type` int(11) NOT NULL,
  `tx_rsvp` varchar(20) NOT NULL,
  PRIMARY KEY (`id_guest_list`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sk_guest_type`
--

CREATE TABLE IF NOT EXISTS `sk_guest_type` (
  `id_guest_type` int(11) NOT NULL AUTO_INCREMENT,
  `nm_guest_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id_guest_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sk_images`
--

CREATE TABLE IF NOT EXISTS `sk_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `tx_filename` varchar(500) NOT NULL,
  `tx_uploaded_by` varchar(100) NOT NULL,
  `fl_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
