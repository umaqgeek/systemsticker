-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2015 at 01:27 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `systemsticker_db`
--
CREATE DATABASE IF NOT EXISTS `systemsticker_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `systemsticker_db`;

-- --------------------------------------------------------

--
-- Table structure for table `bangsa`
--

CREATE TABLE IF NOT EXISTS `bangsa` (
  `ba_id` int(11) NOT NULL AUTO_INCREMENT,
  `ba_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`ba_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bangsa`
--

INSERT INTO `bangsa` (`ba_id`, `ba_desc`) VALUES
(1, 'Malay'),
(2, 'Chinese'),
(3, 'Indian'),
(4, 'Kadazan'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `jantina`
--

CREATE TABLE IF NOT EXISTS `jantina` (
  `ja_id` int(11) NOT NULL AUTO_INCREMENT,
  `ja_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`ja_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jantina`
--

INSERT INTO `jantina` (`ja_id`, `ja_desc`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kenderaan`
--

CREATE TABLE IF NOT EXISTS `jenis_kenderaan` (
  `jk_id` int(11) NOT NULL AUTO_INCREMENT,
  `jk_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`jk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jenis_kenderaan`
--

INSERT INTO `jenis_kenderaan` (`jk_id`, `jk_desc`) VALUES
(1, 'Car'),
(2, 'Motorcycle');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengguna`
--

CREATE TABLE IF NOT EXISTS `jenis_pengguna` (
  `jp_id` int(11) NOT NULL AUTO_INCREMENT,
  `jp_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`jp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jenis_pengguna`
--

INSERT INTO `jenis_pengguna` (`jp_id`, `jp_desc`) VALUES
(1, 'Army'),
(2, 'Public Citizen');

-- --------------------------------------------------------

--
-- Table structure for table `model_kenderaan`
--

CREATE TABLE IF NOT EXISTS `model_kenderaan` (
  `mk_id` int(11) NOT NULL AUTO_INCREMENT,
  `mk_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`mk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `model_kenderaan`
--

INSERT INTO `model_kenderaan` (`mk_id`, `mk_desc`) VALUES
(1, 'Honda'),
(2, 'Proton'),
(3, 'Perodua'),
(4, 'Toyota'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `pelekat`
--

CREATE TABLE IF NOT EXISTS `pelekat` (
  `pel_id` int(11) NOT NULL AUTO_INCREMENT,
  `pe_id` int(11) NOT NULL,
  `jk_id` int(11) NOT NULL,
  `pel_regdate` datetime NOT NULL,
  `pel_expireddate` datetime NOT NULL,
  `pel_noplat` varchar(200) NOT NULL,
  `mk_id` int(11) NOT NULL,
  `pel_nolesen` varchar(200) NOT NULL,
  `pel_lesentamat` datetime NOT NULL,
  `pel_lesenimage` varchar(200) NOT NULL,
  `pel_noroadtax` varchar(200) NOT NULL,
  `pel_roadtaxtamat` datetime NOT NULL,
  `pel_roadtaximage` varchar(200) NOT NULL,
  `pel_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pelekat`
--

INSERT INTO `pelekat` (`pel_id`, `pe_id`, `jk_id`, `pel_regdate`, `pel_expireddate`, `pel_noplat`, `mk_id`, `pel_nolesen`, `pel_lesentamat`, `pel_lesenimage`, `pel_noroadtax`, `pel_roadtaxtamat`, `pel_roadtaximage`, `pel_status`) VALUES
(3, 1, 2, '2015-06-10 01:50:44', '2015-06-24 00:00:00', 'WUM1804', 1, '012334123123', '2016-06-30 00:00:00', 'download (2).jpg', '435456666', '2016-06-29 00:00:00', 'download (4).jpg', 1),
(4, 1, 1, '2015-06-10 02:11:26', '2015-07-01 00:00:00', 'WUM1801', 4, '66666', '2015-06-18 00:00:00', 'compromise.jpg', 'vcvcvcv', '2015-07-02 00:00:00', 'download (1).jpg', 2),
(5, 2, 1, '2015-06-10 03:37:42', '2015-06-11 00:00:00', 'AJM2425', 3, '6353444', '2015-06-18 00:00:00', 'download (6).jpg', 't133333', '2015-06-01 00:00:00', 'download (5).jpg', 1),
(6, 3, 1, '2015-06-10 07:35:46', '2016-06-25 00:00:00', 'wer4343', 1, 'sdfdfds', '2015-06-18 00:00:00', 'Assignment1_2015.docx', 'erdede43343', '2015-06-25 00:00:00', 'Lab_7_Intro_to_HTML_5_Canvas_and_WebGL (1).docx', 1),
(8, 2, 2, '2015-07-08 01:23:48', '2015-07-08 01:24:15', 'QWE3212', 3, 'T1223232123', '2015-07-31 00:00:00', 'carta organisasi keps 2013-2014.png', 'R32323232', '2015-07-31 00:00:00', 'carta organisasi keps 2013-2014.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `pe_id` int(11) NOT NULL AUTO_INCREMENT,
  `pe_username` varchar(200) NOT NULL,
  `pe_password` varchar(200) NOT NULL,
  `pe_fullname` varchar(200) NOT NULL,
  `pe_email` varchar(200) NOT NULL,
  `pe_idno` varchar(200) NOT NULL,
  `pe_jawatan` varchar(200) NOT NULL,
  `pe_alamat` varchar(500) NOT NULL,
  `pe_tarikhlahir` datetime NOT NULL,
  `pe_telefon` varchar(200) NOT NULL,
  `pe_regdate` datetime NOT NULL,
  `jp_id` int(11) NOT NULL,
  `ba_id` int(11) NOT NULL,
  `ja_id` int(11) NOT NULL,
  `ut_id` int(11) NOT NULL,
  `pe_status` int(11) NOT NULL,
  PRIMARY KEY (`pe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pe_id`, `pe_username`, `pe_password`, `pe_fullname`, `pe_email`, `pe_idno`, `pe_jawatan`, `pe_alamat`, `pe_tarikhlahir`, `pe_telefon`, `pe_regdate`, `jp_id`, `ba_id`, `ja_id`, `ut_id`, `pe_status`) VALUES
(1, 'umaq', 'abc123', 'Umar Mukhtar bin Hambaran', 'kidzeclipes@gmail.com', '891031065213', 'Kolonel', 'Pahang.', '1989-10-31 00:00:00', '0199737579', '2015-06-10 01:03:46', 1, 1, 1, 4, 1),
(2, 'ura', '123', 'Urahara Kisuke', 'umaq@gmail.com', '891031085933', 'Kapten', 'Melaka', '1989-10-31 00:00:00', '0193939345', '2015-06-10 03:33:56', 2, 5, 1, 3, 1),
(3, 'apulisme', 'mmm', 'Saiful Zahrin Hamzah', 'apulisme@yahoo.com', 'T3009681', 'Kapt', 'aaaa', '2015-06-08 00:00:00', '0122061266', '2015-06-10 07:34:11', 1, 1, 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_tentera`
--

CREATE TABLE IF NOT EXISTS `unit_tentera` (
  `ut_id` int(11) NOT NULL AUTO_INCREMENT,
  `ut_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`ut_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `unit_tentera`
--

INSERT INTO `unit_tentera` (`ut_id`, `ut_desc`) VALUES
(1, 'No unit'),
(2, 'RAMD 04'),
(3, 'Cobra 01'),
(4, 'Eagle One'),
(5, 'Pedang Merah'),
(6, 'RAMD 02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
