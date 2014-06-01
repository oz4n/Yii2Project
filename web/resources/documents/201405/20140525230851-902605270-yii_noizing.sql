-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2014 at 02:56 PM
-- Server version: 5.5.23
-- PHP Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_noizing`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('A','O','U','T') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `salt`, `email`, `level`) VALUES
(1, 'ozan', 'admin', '769087kjlndljkashdoi', 'oz4n.rock@gmail.com', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('P','D') COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `parent_replay` int(11) DEFAULT '0',
  `like` int(11) DEFAULT '0',
  `unlike` int(11) DEFAULT '0',
  `country` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_buplic` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post1_idx` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `author`, `email`, `url`, `content`, `status`, `create_time`, `parent_replay`, `like`, `unlike`, `country`, `ip_buplic`, `post_id`) VALUES
(1, 'melengo', 'melengo@gmail.com', 'http://melengo.com', 'Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.', 'P', 1394001920, 0, 0, 0, NULL, NULL, 14),
(2, 'melengo', 'melengo@gmail.com', 'http://melengo.com', 'Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.', 'P', 1394001969, 0, 0, 0, NULL, NULL, 14);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` text NOT NULL,
  `status` enum('E','D') NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `status` enum('default','other') NOT NULL,
  `position` int(11) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dropbox_account`
--

CREATE TABLE IF NOT EXISTS `dropbox_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(45) NOT NULL,
  `display_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `type` enum('M','C') NOT NULL DEFAULT 'C',
  `key` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `referral_link` varchar(45) NOT NULL,
  `quota_normal` int(11) NOT NULL DEFAULT '0',
  `quota_in_used` int(11) NOT NULL DEFAULT '0',
  `quota_in_shared` int(11) NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dropbox_account`
--

INSERT INTO `dropbox_account` (`id`, `uid`, `display_name`, `email`, `type`, `key`, `secret`, `access_token`, `referral_link`, `quota_normal`, `quota_in_used`, `quota_in_shared`, `account_id`) VALUES
(1, 'asd', 'asd', 'asd', 'C', 'asd', 'asd', 'asd', 'asd', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dropbox_files`
--

CREATE TABLE IF NOT EXISTS `dropbox_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `files_uid` varchar(45) NOT NULL,
  `name` text NOT NULL,
  `status` enum('L','I') NOT NULL DEFAULT 'L',
  `path` text NOT NULL,
  `type` enum('img','document','video','sound') NOT NULL DEFAULT 'img',
  `mime_type` varchar(255) DEFAULT NULL,
  `url_share` text NOT NULL,
  `url_thumbnail_share` text,
  `dropbox_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dropbox_files_dropbox_account1_idx` (`dropbox_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dropbox_files`
--

INSERT INTO `dropbox_files` (`id`, `files_uid`, `name`, `status`, `path`, `type`, `mime_type`, `url_share`, `url_thumbnail_share`, `dropbox_account_id`) VALUES
(1, '108488029', '108488029.jpg', 'L', 'D:\\Libraries\\Github\\NoiZingProject\\protected\\config\\public\\../../../cache/images/orginal/108488029.jpg', 'img', 'image/jpeg', '/cache/images/thumbnails/orginal/108488029.jpg', '{"orginal":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/108488029.jpg","imgurl":"\\/cache\\/images\\/orginal\\/108488029.jpg"},"T1024X768":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/1024X768\\/108488029.jpg"},"T232X155":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/232X155\\/108488029.jpg"},"T255X255":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/255X255\\/108488029.jpg"},"T60X60":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/60X60\\/108488029.jpg"},"T800X534":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/800X534\\/108488029.jpg"},"T800X600":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/800X600\\/108488029.jpg"},"T100X74":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/100X74\\/108488029.jpg"},"torginal":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/orginal\\/108488029.jpg"},"torginal_100":{"path":"D:\\\\Libraries\\\\Github\\\\NoiZingProject\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/108488029.jpg","imgurl":"\\/cache\\/images\\/thumbnails\\/orginal_100\\/108488029.jpg"}}', 1),
(2, '646921052', '646921052.jpg', 'L', 'D:\\Zend\\Apache2\\htdocs\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/646921052.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/646921052.jpg', '{"orginal":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/646921052.jpg"},"T1024X768":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/646921052.jpg"},"T232X155":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/646921052.jpg"},"T255X255":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/646921052.jpg"},"T60X60":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/646921052.jpg"},"T800X534":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/646921052.jpg"},"T800X600":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/646921052.jpg"},"T100X74":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/646921052.jpg"},"torginal":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/646921052.jpg"},"torginal_100":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/646921052.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/646921052.jpg"}}', 1),
(3, '553960007', '553960007.jpg', 'L', 'D:\\Zend\\Apache2\\htdocs\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/553960007.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/553960007.jpg', '{"orginal":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/553960007.jpg"},"T1024X768":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/553960007.jpg"},"T232X155":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/553960007.jpg"},"T255X255":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/553960007.jpg"},"T60X60":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/553960007.jpg"},"T800X534":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/553960007.jpg"},"T800X600":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/553960007.jpg"},"T100X74":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/553960007.jpg"},"torginal":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/553960007.jpg"},"torginal_100":{"path":"D:\\\\Zend\\\\Apache2\\\\htdocs\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/553960007.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/553960007.jpg"}}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `path` text NOT NULL,
  `url` text NOT NULL,
  `type` enum('image','video','document') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE IF NOT EXISTS `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('P','D') NOT NULL DEFAULT 'D',
  `create_time` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Published', 'p', 'PostStatus', 1),
(2, 'Draft', 'D', 'PostStatus', 2),
(3, 'Pending Approval	', 'D', 'CommentStatus', 1),
(4, 'Approved', 'P', 'CommentStatus', 2),
(5, 'Administrator', 'A', 'LevelStatus', 1),
(6, 'Operator', 'O', 'LevelStatus', 2),
(7, 'User', 'U', 'LevelStatus', 3),
(8, 'Male', 'M', 'GenderStatus', 1),
(9, 'Female', 'F', 'GenderStatus', 2),
(10, 'Enable', 'E', 'PostCommentStatus', 1),
(11, 'Disable', 'D', 'PostCommentStatus', 2),
(12, 'Enable', 'E', 'TaxStatus', 1),
(13, 'Disable', 'D', 'TaxStatus', 2),
(14, 'Page', 'page', 'PostType', 1),
(15, 'Info', 'info', 'PostType', 2),
(16, 'Enable', 'enable', 'PostShares', 1),
(17, 'Disable', 'disable', 'PostShares', 2),
(18, 'Yes', 'Y', 'PostCheked', 1),
(19, 'No', 'N', 'PostCheked', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nav_menu`
--

CREATE TABLE IF NOT EXISTS `nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` enum('category','pages','nav_link','component') NOT NULL,
  `slug` text NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `status` enum('E','D') NOT NULL DEFAULT 'E',
  `term_id` varchar(45) NOT NULL,
  `term_taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nav_menu_term_taxonomy1_idx` (`term_taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `nav_menu`
--

INSERT INTO `nav_menu` (`id`, `name`, `type`, `slug`, `position`, `parent`, `status`, `term_id`, `term_taxonomy_id`) VALUES
(13, 'budaya', 'category', 'budaya', 0, 0, 'E', '22', 40),
(14, 'lombok', 'category', 'lombok', 0, 0, 'E', '26', 40),
(15, 'ubuntu', 'category', 'ubuntu', 0, 0, 'E', '28', 40),
(16, 'Linux', 'category', 'linux', 0, 0, 'E', '29', 40);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` text,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pages_slug` text,
  `status` enum('P','D') NOT NULL,
  `icon` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `unlike` int(11) NOT NULL DEFAULT '0',
  `shares` enum('true','false') NOT NULL DEFAULT 'true',
  `comment_status` enum('E','D') DEFAULT NULL,
  `post_view` int(11) DEFAULT '0',
  `post_status` enum('pages','info') DEFAULT NULL,
  `files_uid` text,
  `cron_checked` enum('Y','N') NOT NULL DEFAULT 'Y',
  `parent` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `slug`, `tags`, `pages_slug`, `status`, `icon`, `create_time`, `update_time`, `like`, `unlike`, `shares`, `comment_status`, `post_view`, `post_status`, `files_uid`, `cron_checked`, `parent`, `account_id`) VALUES
(14, 'Istri di Saudi bunuh suami agar bebas selingkuh', '<p>\n	      Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.\n</p>\n<p>\n	      Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.\n</p>\n<p>\n	<!--more-->\n</p>\n<p>\n	      Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.\n</p>\n<p>\n	<img src="/cache/images/thumbnails/orginal/108488029.jpg" alt="108488029.jpg" file-uid="108488029">\n</p>\n<p>\n	      Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.\n</p>', 'istri-di-saudi-bunuh-suami-agar-bebas-selingkuh', 'budaya', 'uncategories,budaya', 'P', '/cache/images/thumbnails/orginal/108488029.jpg', 1392739676, 1392739676, 0, 0, 'true', 'E', 0, 'info', '108488029', 'Y', NULL, 1),
(15, 'Profil Prusahaan', '<p>\n	Profil Prusahaan\n</p>', 'profil-prusahaan', '', 'profil', 'P', NULL, 1393661882, 1393661882, 0, 0, 'true', 'D', 0, 'pages', NULL, 'Y', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `image` text,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `gender`, `address`, `about`, `birthday`, `image`, `account_id`) VALUES
(1, 'ozan', 'rock', 'M', 'mataram', '-', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `post_id` int(11) NOT NULL,
  `term_taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`term_taxonomy_id`),
  KEY `fk_post_has_term_taxonomy_term_taxonomy1_idx` (`term_taxonomy_id`),
  KEY `fk_post_has_term_taxonomy_post1_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`post_id`, `term_taxonomy_id`) VALUES
(14, 11),
(15, 24),
(14, 25);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `autoload` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `description`, `frequency`) VALUES
(9, 'budaya', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`id`, `name`, `slug`) VALUES
(3, 'Contact', 'contact/pront/index'),
(4, 'Guestbook', 'guestbook/pront/index'),
(11, 'uncategories', 'uncategories'),
(21, 'Profil', 'profil'),
(22, 'budaya', 'budaya'),
(26, 'lombok', 'lombok'),
(28, 'ubuntu', 'ubuntu'),
(29, 'Linux', 'linux'),
(37, 'Page Menu', 'page-menu'),
(39, 'ubuntu', 'ubuntu-1');

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `term_taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('category','page_category','pages','nav_menu','nav_link','component') NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `count` varchar(45) NOT NULL DEFAULT '0',
  `status` enum('E','D') NOT NULL DEFAULT 'D',
  `parent` int(11) NOT NULL DEFAULT '0',
  `term_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_term_taxonomy_term1_idx` (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`id`, `type`, `description`, `count`, `status`, `parent`, `term_id`) VALUES
(3, 'component', 'contact', '0', 'E', 0, 3),
(4, 'component', 'guestbook', '0', 'E', 0, 4),
(11, 'category', 'linux categories', '0', 'E', 0, 11),
(24, 'pages', '', '0', 'E', 0, 21),
(25, 'category', '', '0', 'E', 0, 22),
(29, 'category', '', '0', 'E', 0, 26),
(31, 'category', '', '0', 'E', 0, 28),
(32, 'category', 'linux', '0', 'E', 0, 29),
(40, 'nav_menu', 'Page Menu', '0', 'E', 0, 37),
(42, 'nav_menu', 'ubuntu', '0', 'E', 0, 39);

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `position` int(11) DEFAULT '0',
  `layouts_position` enum('H','P','S','PM','CM') DEFAULT NULL,
  `status` enum('P','D') NOT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `name`, `position`, `layouts_position`, `status`, `other`) VALUES
(1, 'TagCloud', 3, 'P', 'P', NULL),
(2, 'RecentTweets', 1, 'P', 'P', NULL),
(3, 'RecentComments', 2, 'P', 'P', NULL),
(4, 'CategoriesCloud', 4, 'P', 'P', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dropbox_files`
--
ALTER TABLE `dropbox_files`
  ADD CONSTRAINT `fk_dropbox_files_dropbox_account1` FOREIGN KEY (`dropbox_account_id`) REFERENCES `dropbox_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nav_menu`
--
ALTER TABLE `nav_menu`
  ADD CONSTRAINT `fk_nav_menu_term_taxonomy1` FOREIGN KEY (`term_taxonomy_id`) REFERENCES `term_taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `fk_post_has_term_taxonomy_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_has_term_taxonomy_term_taxonomy1` FOREIGN KEY (`term_taxonomy_id`) REFERENCES `term_taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  ADD CONSTRAINT `fk_term_taxonomy_term1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
