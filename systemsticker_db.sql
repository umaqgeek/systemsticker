-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 26, 2015 at 01:54 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `systemsticker_db`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `bangsa`
-- 

CREATE TABLE `bangsa` (
  `ba_id` int(11) NOT NULL auto_increment,
  `ba_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`ba_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `bangsa`
-- 

INSERT INTO `bangsa` VALUES (1, 'Malay');
INSERT INTO `bangsa` VALUES (2, 'Chinese');
INSERT INTO `bangsa` VALUES (3, 'Indian');
INSERT INTO `bangsa` VALUES (4, 'Kadazan');
INSERT INTO `bangsa` VALUES (5, 'Others');

-- --------------------------------------------------------

-- 
-- Table structure for table `jantina`
-- 

CREATE TABLE `jantina` (
  `ja_id` int(11) NOT NULL auto_increment,
  `ja_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`ja_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `jantina`
-- 

INSERT INTO `jantina` VALUES (1, 'Male');
INSERT INTO `jantina` VALUES (2, 'Female');

-- --------------------------------------------------------

-- 
-- Table structure for table `jenis_kenderaan`
-- 

CREATE TABLE `jenis_kenderaan` (
  `jk_id` int(11) NOT NULL auto_increment,
  `jk_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`jk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `jenis_kenderaan`
-- 

INSERT INTO `jenis_kenderaan` VALUES (1, 'Car');
INSERT INTO `jenis_kenderaan` VALUES (2, 'Motorcycle');

-- --------------------------------------------------------

-- 
-- Table structure for table `jenis_pengguna`
-- 

CREATE TABLE `jenis_pengguna` (
  `jp_id` int(11) NOT NULL auto_increment,
  `jp_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`jp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `jenis_pengguna`
-- 

INSERT INTO `jenis_pengguna` VALUES (1, 'Army');
INSERT INTO `jenis_pengguna` VALUES (2, 'Public Citizen');

-- --------------------------------------------------------

-- 
-- Table structure for table `model_kenderaan`
-- 

CREATE TABLE `model_kenderaan` (
  `mk_id` int(11) NOT NULL auto_increment,
  `mk_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`mk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `model_kenderaan`
-- 

INSERT INTO `model_kenderaan` VALUES (1, 'Honda');
INSERT INTO `model_kenderaan` VALUES (2, 'Proton');
INSERT INTO `model_kenderaan` VALUES (3, 'Perodua');
INSERT INTO `model_kenderaan` VALUES (4, 'Toyota');
INSERT INTO `model_kenderaan` VALUES (5, 'Others');

-- --------------------------------------------------------

-- 
-- Table structure for table `pelekat`
-- 

CREATE TABLE `pelekat` (
  `pel_id` int(11) NOT NULL auto_increment,
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
  `pel_status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`pel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `pelekat`
-- 

INSERT INTO `pelekat` VALUES (3, 1, 2, '2015-06-10 01:50:44', '2015-06-24 00:00:00', 'WUM1804', 1, '012334123123', '2016-06-30 00:00:00', 'download (2).jpg', '435456666', '2016-06-29 00:00:00', 'download (4).jpg', 1);
INSERT INTO `pelekat` VALUES (4, 1, 1, '2015-06-10 02:11:26', '2015-07-01 00:00:00', 'WUM1801', 4, '66666', '2015-06-18 00:00:00', 'compromise.jpg', 'vcvcvcv', '2015-07-02 00:00:00', 'download (1).jpg', 2);
INSERT INTO `pelekat` VALUES (5, 2, 1, '2015-06-10 03:37:42', '2015-06-11 00:00:00', 'AJM2425', 3, '6353444', '2015-06-18 00:00:00', 'download (6).jpg', 't133333', '2015-06-01 00:00:00', 'download (5).jpg', 1);
INSERT INTO `pelekat` VALUES (6, 3, 1, '2015-06-10 07:35:46', '2016-06-25 00:00:00', 'wer4343', 1, 'sdfdfds', '2015-06-18 00:00:00', 'Assignment1_2015.docx', 'erdede43343', '2015-06-25 00:00:00', 'Lab_7_Intro_to_HTML_5_Canvas_and_WebGL (1).docx', 1);
INSERT INTO `pelekat` VALUES (8, 2, 2, '2015-07-08 01:23:48', '2015-07-08 01:24:15', 'QWE3212', 3, 'T1223232123', '2015-07-31 00:00:00', 'carta organisasi keps 2013-2014.png', 'R32323232', '2015-07-31 00:00:00', 'carta organisasi keps 2013-2014.png', 1);
INSERT INTO `pelekat` VALUES (10, 23, 2, '2015-08-25 05:18:32', '2015-08-25 05:19:43', 'MBP9723', 5, '06509271', '2016-04-01 00:00:00', 'IMG_0002.jpg', '22694464', '2015-08-28 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (11, 5, 2, '2015-08-25 05:21:26', '2015-08-25 05:23:28', 'BHD9146', 5, '04356487', '2017-04-16 00:00:00', 'IMG_0002.jpg', '21347895', '2016-05-26 00:00:00', 'IMG_0001.jpg', 2);
INSERT INTO `pelekat` VALUES (12, 6, 1, '2015-08-25 05:24:12', '2015-08-25 05:26:10', 'MBX293', 2, '05509432', '2015-09-05 00:00:00', 'IMG_0002.jpg', '20657865', '2015-05-26 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (13, 7, 1, '2015-08-25 05:26:56', '2015-08-25 05:28:49', 'MAT7718', 2, '06546721', '2015-11-27 00:00:00', 'IMG_0005.jpg', '22345678', '2016-07-12 00:00:00', 'IMG_0001.pdf', 2);
INSERT INTO `pelekat` VALUES (14, 8, 1, '2015-08-25 05:53:29', '2015-08-25 05:54:23', 'DCB9246', 2, '06514356', '2016-01-01 00:00:00', 'IMG_0002.jpg', '21344345', '2016-07-22 00:00:00', 'IMG_0001_2.jpg', 2);
INSERT INTO `pelekat` VALUES (15, 9, 2, '2015-08-25 05:56:38', '2015-08-25 05:58:13', 'WTE2672', 1, '05432345', '2015-08-31 00:00:00', 'IMG_0002.jpg', '21345687', '2015-09-02 00:00:00', 'IMG_0001.jpg', 2);
INSERT INTO `pelekat` VALUES (16, 10, 2, '2015-08-25 05:58:48', '2015-08-25 06:00:06', 'JHF483', 5, '05432156', '2015-09-27 00:00:00', 'IMG_0002.jpg', '21234565', '2016-06-27 00:00:00', 'IMG_0001.jpg', 2);
INSERT INTO `pelekat` VALUES (17, 11, 1, '2015-08-25 06:01:49', '2015-08-25 06:03:19', 'PBX2993', 2, '04547687', '2017-07-03 00:00:00', 'IMG.jpg', '23432123', '2016-09-09 00:00:00', 'IMG_0003.jpg', 2);
INSERT INTO `pelekat` VALUES (18, 12, 1, '2015-08-25 06:03:47', '2015-08-25 06:05:18', 'JED6633', 2, '05433456', '2015-10-19 00:00:00', 'IMG_0002.jpg', '23456543', '2015-11-24 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (19, 13, 1, '2015-08-25 06:05:41', '2015-08-25 06:07:03', 'MCG5449', 3, '05432785', '2016-05-24 00:00:00', 'IMG_2.jpg', '21345678', '2015-11-28 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (20, 14, 2, '2015-08-25 06:07:25', '2015-08-25 06:09:39', 'PKW305', 5, '03456763', '2016-09-11 00:00:00', 'IMG.jpg', '21234567', '2016-01-14 00:00:00', 'IMG.pdf', 2);
INSERT INTO `pelekat` VALUES (21, 15, 1, '2015-08-25 06:10:36', '2015-08-25 06:12:15', 'WBQ7571', 2, '04325678', '2016-04-29 00:00:00', 'IMG_0002.jpg', '23456789', '2015-10-22 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (22, 16, 2, '2015-08-25 06:12:46', '2015-08-25 06:14:43', 'JKU4765', 5, '09823134', '2016-05-04 00:00:00', 'IMG_0002.jpg', '23212345', '2016-03-09 00:00:00', 'IMG_0001.jpg', 2);
INSERT INTO `pelekat` VALUES (23, 17, 2, '2015-08-25 06:16:39', '2015-08-25 06:17:47', 'MCQ1970', 1, '08765432', '2016-05-10 00:00:00', 'IMG_0003.jpg', '23124567', '2016-01-15 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (24, 22, 1, '2015-08-25 06:18:15', '2015-08-25 06:19:59', 'JLF8351', 4, '05281642', '2016-05-11 00:00:00', 'IMG_0002.jpg', '23124568', '2016-02-03 00:00:00', 'IMG_0001.jpg', 2);
INSERT INTO `pelekat` VALUES (25, 18, 2, '2015-08-25 06:20:38', '2015-08-25 06:21:56', 'JJE354', 1, '08765412', '2016-06-12 00:00:00', 'IMG.jpg', '34215676', '2016-07-15 00:00:00', 'IMG_0002.jpg', 2);
INSERT INTO `pelekat` VALUES (26, 21, 2, '2015-08-25 06:22:26', '2015-08-25 06:23:44', 'JLA1694', 1, '07654265', '2015-09-29 00:00:00', 'IMG_0003.jpg', '22132456', '2016-03-24 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (27, 4, 1, '2015-08-25 06:24:08', '2015-08-25 06:25:12', 'NAH8713', 2, '09875645', '2015-11-03 00:00:00', 'IMG_0001.jpg', '21436576', '2015-10-29 00:00:00', 'IMG_0004.jpg', 2);
INSERT INTO `pelekat` VALUES (28, 20, 1, '2015-08-25 06:25:36', '2015-08-25 06:27:01', 'NBM500', 2, '12321154', '2016-07-05 00:00:00', 'IMG_0002.jpg', '21342132', '2016-04-22 00:00:00', 'IMG.jpg', 2);
INSERT INTO `pelekat` VALUES (29, 19, 1, '2015-08-25 06:27:24', '2015-08-25 06:28:24', 'JPE5289', 3, '02174354', '2017-01-06 00:00:00', 'IMG.jpg', '32434543', '2016-02-27 00:00:00', 'IMG_0002.jpg', 2);
INSERT INTO `pelekat` VALUES (30, 24, 1, '2015-08-26 06:37:34', '2015-08-26 06:38:56', 'maw234', 1, '123', '2015-04-03 00:00:00', 'logo.png', '123', '2015-09-03 00:00:00', 'Car2.jpg', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `pengguna`
-- 

CREATE TABLE `pengguna` (
  `pe_id` int(11) NOT NULL auto_increment,
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
  PRIMARY KEY  (`pe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `pengguna`
-- 

INSERT INTO `pengguna` VALUES (5, 'david', 'da', 'David ak Sebuloh', 'david@yahoo.com', '1117209', 'Sjn', 'Kem Terendak, Melaka', '1980-04-16 00:00:00', '0129034031', '2015-08-25 03:41:03', 1, 4, 1, 3, 1);
INSERT INTO `pengguna` VALUES (4, 'limau', 'li', 'Sypol Bahari bin Hamzah', 'sy@gmail.com', '841103045313', 'LKpl', 'No 256 Taman Sri Rembau 73100 Rembau Negeri Sembilan Darul Khusus', '1984-11-03 00:00:00', '0136393009', '2015-08-25 03:38:34', 1, 1, 1, 1, 1);
INSERT INTO `pengguna` VALUES (6, 'akmar', 'ak', 'Zainatul Akmar bin Zainuddin', 'zai@yahoo.com', '1128127', 'Kpl', 'SI 2148 Jln SG9 Taman Seri Gamelan 78300 Kuala Sg Baru Melaka', '1982-09-05 00:00:00', '0126660332', '2015-08-25 03:47:19', 1, 1, 1, 1, 1);
INSERT INTO `pengguna` VALUES (7, 'azman', 'az', 'Mohd Azman bin Abdul Aziz', 'ma@gmail.com', '1137997', 'Kpl', 'Blok F 1-2 Taman Desa Taming Sari 2 76300 Melaka', '1980-11-27 00:00:00', '0166260767', '2015-08-25 03:50:09', 1, 1, 1, 1, 1);
INSERT INTO `pengguna` VALUES (8, 'khai', 'ck', 'Che Khairo Nizam bin Che Ab Rahman', 'khai@gmail.com', '1130623', 'LKpl', 'Lot 66 Kg Tok Betek Kota Bharu 15350 Kota Bharu Kelantan', '1984-01-01 00:00:00', '0172018936', '2015-08-25 03:52:46', 1, 1, 1, 4, 1);
INSERT INTO `pengguna` VALUES (9, 'fazri', 'fa', 'Mohamad Fazri bin Mohd Raseni', 'fazri@gmail.com', '1155267', 'Kpl', '12 Skn Sem Siraja Kem Wardeburn Setapak 53300 Wilayah Persekutuan Kuala Lumpur', '1988-08-31 00:00:00', '0125300951', '2015-08-25 03:55:47', 1, 1, 1, 4, 1);
INSERT INTO `pengguna` VALUES (10, 'jembu', 'jem', 'Jembu anak Erong', 'jae@gmail.com', '1153510', 'Kpl', '6-2-9 Kelompok Seri Anggerik Jalan 7/4 Seksyen 7 43560 Bandar Baru Bangi Selangor', '1984-09-27 00:00:00', '0138213158', '2015-08-25 03:58:21', 1, 1, 1, 4, 1);
INSERT INTO `pengguna` VALUES (11, 'nazri', 'naz', 'Muhamad Nazre bin Mohd Noordin', 'azre@gmail.com', '1135700', 'Kpl', 'No 9 Felda Chegar Perah 27200 Kuala Lipis Pahang', '1983-07-03 00:00:00', '0196734960', '2015-08-25 04:00:46', 1, 1, 1, 2, 1);
INSERT INTO `pengguna` VALUES (12, 'nazrul', 'nar', 'Mohd Nazrul bin M Suregi', 'nazrul@gmail.com', '1125282', 'Kpl', '71 Rej Sem Diraja Kem Sg Besi KL 5700 Wilayah Persekutuan Kuala Lumpur', '0081-10-19 00:00:00', '0193279232', '2015-08-25 04:03:31', 1, 1, 1, 2, 1);
INSERT INTO `pengguna` VALUES (13, 'axzuat', 'ax', 'Nuzul Axzuat bin Zaini', 'axzuat@gmail.com', '1132423', 'Kpl', 'No 43 Jalan Intan 5/9 Taman Intan 86000 Kluang Johor', '1984-05-24 00:00:00', '0123006551', '2015-08-25 04:08:00', 1, 1, 1, 2, 1);
INSERT INTO `pengguna` VALUES (14, 'soleh', 'soi', 'Muhamad Solleh bin Ramli', 'msr@gmail.com', '1167585', 'Kpl', 'No 52 Kg Tasek Gelugor Bukit Mertajam 13300 Pulau Pinang', '1990-09-11 00:00:00', '0122226783', '2015-08-25 04:10:08', 1, 1, 1, 2, 1);
INSERT INTO `pengguna` VALUES (15, 'termizi', 'mt', 'Mohd Termizi bin Daud', 'termy@gmail.com', '1147592', 'Kpl', 'No 35 Jalan R15 Taman Rambai Idaman Air Salak 75250 Melaka', '1985-04-29 00:00:00', '0163208137', '2015-08-25 04:12:25', 1, 1, 1, 5, 1);
INSERT INTO `pengguna` VALUES (16, 'zaid', 'zai', 'Mohd Nur Zaid bin Zaidi', 'nurza@gmail.com', '1132432', 'Kpl', 'SU 279 Jalan Indah 15 Taman Indah 76300 Sungai Udang Melaka', '1985-05-04 00:00:00', '0193771804', '2015-08-25 04:15:30', 1, 1, 1, 5, 1);
INSERT INTO `pengguna` VALUES (17, 'zul', 'zuza', 'Mohd Zulkifli bin Zainal', 'mozu@gmail.com', '1155609', 'Kpl', '53B Kampung Kepala Tanjung Tanjung Dawai 08110 Bedong Kedah', '1988-05-10 00:00:00', '0173397090', '2015-08-25 04:17:57', 1, 1, 1, 5, 1);
INSERT INTO `pengguna` VALUES (18, 'hafiz', 'haf', 'Mohammad Nur Hafiz bin Md Sharif', 'nurha@gmail.com', '1165210', 'Kpl', '81 Jalan Gigih 1 Taman Sri Lambak 86000 Kluang Johor', '1990-06-12 00:00:00', '0133553172', '2015-08-25 04:22:01', 1, 1, 1, 4, 1);
INSERT INTO `pengguna` VALUES (19, 'jasni', 'jas', 'jasni bin ahmad', 'jaa@gmail.com', '1136781', 'SSjn', 'No A-2 Kampung Hilir Mukim Kubang Rotan Alor Setar 06250 Kedah', '1984-11-06 00:00:00', '0193144274', '2015-08-25 04:25:54', 1, 1, 1, 3, 1);
INSERT INTO `pengguna` VALUES (20, 'richard', 'mck', 'Richard Mckoolby anak Henry', 'rich@gmail.com', '1175132', 'Pbt', 'Kampung Segong, Singgai 94000 Bau Sarawak ', '1989-07-05 00:00:00', '0195212193', '2015-08-25 04:44:14', 1, 4, 1, 3, 1);
INSERT INTO `pengguna` VALUES (21, 'jelly', 'jel', 'Jelly anak Jitep', 'jelly@gmail.com', '1166144', 'Kpl', 'Blok F4-1 Desa Taming Sari 76300 Sungai Udang Melaka', '1986-09-29 00:00:00', '0195354528', '2015-08-25 04:47:13', 1, 5, 1, 3, 1);
INSERT INTO `pengguna` VALUES (22, 'juandy', 'juan', 'Juandy Safril bin Basirun', 'safril@gmail.com', '1164952', 'LKpl', 'B F-14 Felda Jengka 7 26410 Bandar Jengka Pahang', '1988-05-11 00:00:00', '0123272846', '2015-08-25 04:51:18', 1, 1, 1, 1, 1);
INSERT INTO `pengguna` VALUES (23, 'azmi', 'nam', 'Nor Azmi bin Mohamed', 'azmi@yahoo.com', '1111308', 'PW 2', '10 Skn Rej Sem Diraja Para Kem Terendak Sungai Udang 76200 Melaka', '1977-04-01 00:00:00', '0195456186', '2015-08-25 04:53:36', 1, 1, 1, 5, 1);
INSERT INTO `pengguna` VALUES (24, 'mamat', 'mamat', 'mamat', 'mamat@yahoo.com', '123', 'en', 'melaka', '1981-02-02 00:00:00', '123', '2015-08-26 06:33:30', 2, 1, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `unit_tentera`
-- 

CREATE TABLE `unit_tentera` (
  `ut_id` int(11) NOT NULL auto_increment,
  `ut_desc` varchar(200) NOT NULL,
  PRIMARY KEY  (`ut_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `unit_tentera`
-- 

INSERT INTO `unit_tentera` VALUES (1, '9 RAMD');
INSERT INTO `unit_tentera` VALUES (2, '17 RAMD');
INSERT INTO `unit_tentera` VALUES (3, '8 RRD');
INSERT INTO `unit_tentera` VALUES (4, '3 RSD');
INSERT INTO `unit_tentera` VALUES (5, '10 SSD');
