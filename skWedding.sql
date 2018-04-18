-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2018 at 09:50 AM
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
-- Table structure for table `sk_accom`
--

CREATE TABLE IF NOT EXISTS `sk_accom` (
  `id_accom` int(11) NOT NULL AUTO_INCREMENT,
  `nm_accom` varchar(500) NOT NULL,
  `tx_website` varchar(1000) NOT NULL,
  `tx_website_display` varchar(500) NOT NULL,
  `tx_contact` varchar(1000) NOT NULL,
  `tx_img_filename` varchar(5000) NOT NULL,
  `map_lat` double(17,14) NOT NULL,
  `map_lng` double(17,14) NOT NULL,
  PRIMARY KEY (`id_accom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sk_accom`
--

INSERT INTO `sk_accom` (`id_accom`, `nm_accom`, `tx_website`, `tx_website_display`, `tx_contact`, `tx_img_filename`, `map_lat`, `map_lng`) VALUES
(1, 'Meon Valley Marriott Hotel & Country Club', 'http://www.marriott.com/hotels/travel/sougs-meon-valley-marriott-hotel-and-country-club/?scid=bb1a189a-fec3-4d19-a255-54ba596febe2', 'www.marriott.com', '01329 833455', 'marriot-meon-valley.jpg', 50.92226200000000, -1.21421000000000),
(2, 'The Roebuck Inn', 'http://www.theroebuckinnwickham.co.uk', 'www.theroebuckinnwickham.co.uk', ' 01329 832150', 'roebuck-wickham.jpg', 50.91531300000000, -1.16803600000000),
(3, 'B+B Wickham', 'http://www.bb-wickham.com/', 'www.bb-wickham.com', '01329 835870', 'bb-wickham.jpg', 50.90010100000000, -1.18674100000000),
(4, 'Solent Hotel & Spa', 'https://www.thwaites.co.uk/hotels-and-inns/hotels/solent-hotel-fareham/', 'www.thwaites.co.uk', '01489 880000', 'solent-hotel.jpg', 50.87992700000000, -1.24953400000000),
(5, 'Macdonald Botley Park Hotel & Spa', 'http://www.macdonaldhotels.co.uk/our-hotels/macdonald-botley-park-hotel-spa/?utm_source=google&utm_medium=organic&utm_campaign=macdonald-botley-park-hotel-spa-gmb', 'macdonaldhotels.co.uk', '0344 879 9034', '', 50.93138100000000, -1.28124300000000),
(6, 'Botleigh Grange Hotel and Spa', 'https://www.botleighgrange.com/', 'botleighgrange.com', '01489 787700', '', 50.91846100000000, -1.29568100000000);

-- --------------------------------------------------------

--
-- Table structure for table `sk_admin_user`
--

CREATE TABLE IF NOT EXISTS `sk_admin_user` (
  `id_admin_user` int(11) NOT NULL AUTO_INCREMENT,
  `nm_admin_user` varchar(100) NOT NULL,
  `tx_admin_password` varchar(200) NOT NULL,
  PRIMARY KEY (`id_admin_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `tx_dietary` varchar(10000) NOT NULL,
  `fl_outbound_transport` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Hotel to Sparsholt journey',
  `fl_inbound_transport` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Sparsholt to Hotel journey',
  `id_rsvp_confirm` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sk_guest_type`
--

INSERT INTO `sk_guest_type` (`id_guest_type`, `nm_guest_type`) VALUES
(1, 'Day'),
(2, 'Evening');

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

-- --------------------------------------------------------

--
-- Table structure for table `sk_rsvp_confirm`
--

CREATE TABLE IF NOT EXISTS `sk_rsvp_confirm` (
  `id_rsvp_confirm` int(11) NOT NULL AUTO_INCREMENT,
  `nm_firstname` varchar(100) NOT NULL,
  `nm_surname` varchar(100) NOT NULL,
  `id_guest_type` int(11) NOT NULL,
  `tx_rsvp` varchar(20) NOT NULL,
  `tx_dietary` varchar(10000) NOT NULL,
  `fl_outbound_transport` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Hotel to Sparsholt journey',
  `fl_inbound_transport` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Sparsholt to Hotel journey',
  `tx_nm_rsvp` varchar(500) NOT NULL,
  `fl_confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `tx_verify_key` varchar(1000) NOT NULL,
  `dt_response` datetime NOT NULL,
  `fl_matched` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rsvp_confirm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sk_rsvp_confirm`
--

/*INSERT INTO `sk_rsvp_confirm` (`id_rsvp_confirm`, `nm_firstname`, `nm_surname`, `id_guest_type`, `tx_rsvp`, `tx_dietary`, `fl_outbound_transport`, `fl_inbound_transport`, `tx_nm_rsvp`, `fl_confirmed`, `tx_verify_key`, `dt_response`, `fl_matched`) VALUES
(1, 'Karla', 'Fry', 1, 'yes', '', 1, 1, 'karla (lead)', 1, '1234', '2018-04-10 09:23:30', 0),
(2, 'Sean', 'Barnes', 1, 'yes', '', 1, 1, 'karla', 1, '1234', '2018-04-10 09:23:30', 0);*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
