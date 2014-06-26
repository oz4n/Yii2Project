-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2014 at 09:46 PM
-- Server version: 5.5.37-0ubuntu0.12.04.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ppi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `fk_auth_assignment_1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', 1, 1402106808),
('adminppe', 2, 1402106808),
('subadminppe', 3, 1402106808),
('subadminppe', 8, 1402106808),
('subadminppe', 9, 1402106808);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `rule_name`, `type`, `description`, `data`, `created_at`, `updated_at`) VALUES
('admin', 'UserGroupRule', 1, 'Admin default user', NULL, 1402109093, 1402109093),
('administrator', 'UserGroupRule', 1, 'Administrator default user', NULL, 1402109093, 1402109093),
('adminppe', NULL, 2, 'Admin PPE', NULL, 1402106808, 1402106808),
('albumcreate', NULL, 3, 'Tambah data album gambar', NULL, 1402137983, 1402137983),
('albumdelete', NULL, 3, 'Hapus data album gambar', NULL, 1402137983, 1402137983),
('albumindex', NULL, 3, 'List data album gambar', NULL, 1402137983, 1402137983),
('albumupdate', NULL, 3, 'Perbaharui data album gambar', NULL, 1402137983, 1402137983),
('albumview', NULL, 3, 'Lihat detail data album gambar', NULL, 1402137983, 1402137983),
('areabulk', NULL, 3, 'Hapus data daerah secara masal', NULL, 1402128057, 1402128057),
('areacreate', NULL, 3, 'Tambah data daerah', NULL, 1402128057, 1402128057),
('areadelete', NULL, 3, 'Hapus data daerah', NULL, 1402128057, 1402128057),
('areaindex', NULL, 3, 'List data daerah', NULL, 1402128057, 1402128057),
('areaupdate', NULL, 3, 'Perbaharui data daerah', NULL, 1402128057, 1402128057),
('areaview', NULL, 3, 'Lihat detail data daerah', NULL, 1402128057, 1402128057),
('brevetawardbulk', NULL, 6, 'Hapus data brevet peghargaan secara masal', NULL, 1402127618, 1402127618),
('brevetawardcreate', NULL, 6, 'Tambah data brevet peghargaan', NULL, 1402127618, 1402127618),
('brevetawarddelete', NULL, 6, 'Hapus data brevet peghargaan', NULL, 1402127618, 1402127618),
('brevetawardindex', NULL, 6, 'List data brevet peghargaan', NULL, 1402127618, 1402127618),
('brevetawardupdate', NULL, 6, 'Perbaharui data brevet peghargaan', NULL, 1402127618, 1402127618),
('brevetawardview', NULL, 6, 'Lihat detail data brevet peghargaan', NULL, 1402127618, 1402127618),
('capascreate', NULL, 5, 'Tambah data anggota capas', NULL, 1402112492, 1402112492),
('capasdelete', NULL, 5, 'Hapus data anggota capas', NULL, 1402112492, 1402112492),
('capasindex', NULL, 5, 'List data anggota capas', NULL, 1402112492, 1402112492),
('capastrash', NULL, 5, 'Buang ketongsampah data anggota capas', NULL, 1402112492, 1402112492),
('capasupdate', NULL, 5, 'Perbaharui data anggota capas', NULL, 1402112492, 1402112492),
('capasview', NULL, 5, 'Lihat detail data anggota capas', NULL, 1402112492, 1402112492),
('categorybulk', NULL, 3, 'Hapus data katagori secara masal', NULL, 1402132790, 1402132790),
('categorycreate', NULL, 3, 'Tambah data katagori', NULL, 1402132790, 1402132790),
('categorydelete', NULL, 3, 'Hapus data katagori', NULL, 1402132790, 1402132790),
('categoryindex', NULL, 3, 'List data katagori', NULL, 1402132790, 1402132790),
('categoryupdate', NULL, 3, 'Perbaharui data katagori', NULL, 1402132790, 1402132790),
('categoryview', NULL, 3, 'Lihat detail data katagori', NULL, 1402132790, 1402132790),
('dashboardindex', NULL, 3, 'List Beranda', NULL, 1402132790, 1402132790),
('dashboardloadmessage', NULL, 3, 'Load dashboard message', NULL, 1402132790, 1402132790),
('documentcreate', NULL, 3, 'Tambah Data Dokumen', NULL, 1402132790, 1402132790),
('documentdelete', NULL, 3, 'Hapus Data Dokument', NULL, 1402132790, 1402132790),
('documentindex', NULL, 3, 'List Dokumen ', NULL, 1402132790, 1402132790),
('documentloadredactorfile', NULL, 3, 'List upload Dokument', NULL, 1402132790, 1402132790),
('documentupdate', NULL, 3, 'Perbaharui Data Dokument', NULL, 1402132790, 1402132790),
('documentuploaddredactorfile', NULL, 3, 'Dokumen List upload', NULL, 1402132790, 1402132790),
('documentview', NULL, 3, 'Lihat Detail Dokument', NULL, 1402132790, 1402132790),
('filemanagercreate', NULL, 3, 'Tambah Data filemanager', NULL, 1402132790, 1402132790),
('filemanagerdelete', NULL, 3, 'Hapus data filemanager', NULL, 1402136271, 1402136271),
('filemanagerindex', NULL, 3, 'List File Manager', NULL, 1402132790, 1402132790),
('filemanagerupdate', NULL, 3, 'Perbaharui data filemanager', NULL, 1402132790, 1402132790),
('filemanagerview', NULL, 3, 'Lihat Detail Filemanager', NULL, 1402132790, 1402132790),
('guestbookcreate', NULL, 3, 'Tambah Data guestbook', NULL, 1402132790, 1402132790),
('guestbookdelete', NULL, 3, 'Hapus data guestbook', NULL, 1402137983, 1402137983),
('guestbookindex', NULL, 3, 'List guestbook', NULL, 1402132790, 1402132790),
('guestbookupdate', NULL, 3, 'Perbaharui data guestbook', NULL, 1402137983, 1402137983),
('guestbookview', NULL, 3, 'Lihat detail data guestbook', NULL, 1402132790, 1402132790),
('imagedelete', NULL, 3, 'Hapus data gambar', NULL, 1402136271, 1402136271),
('imageindex', NULL, 3, 'List data gambar', NULL, 1402136270, 1402136270),
('imageloadredactoralbum', NULL, 3, 'List data album pada modal', NULL, 1402136271, 1402136271),
('imageloadredactorimage', NULL, 3, 'List data gambar pada modal', NULL, 1402136271, 1402136271),
('imageupdate', NULL, 3, 'Perbaharui data gambar', NULL, 1402136271, 1402136271),
('imageupload', NULL, 3, 'Tambah data gambar', NULL, 1402136271, 1402136271),
('imageuploadredactorimage', NULL, 3, 'Tambah data gambar melalui modal', NULL, 1402136271, 1402136271),
('imageview', NULL, 3, 'Lihat detail data gambar', NULL, 1402136270, 1402136270),
('languageskillbulk', NULL, 3, 'Hapus data keterampilan bahasa secara masal', NULL, 1402127945, 1402127945),
('languageskillcreate', NULL, 3, 'Tambah data keterampilan bahasa', NULL, 1402127945, 1402127945),
('languageskilldelete', NULL, 3, 'Hapus data keterampilan bahasa', NULL, 1402127945, 1402127945),
('languageskillindex', NULL, 3, 'List data keterampilan bahasa', NULL, 1402127945, 1402127945),
('languageskillupdate', NULL, 3, 'Perbaharui data keterampilan bahasa', NULL, 1402127945, 1402127945),
('languageskillview', NULL, 3, 'Lihat detail data keterampilan bahasa', NULL, 1402127945, 1402127945),
('lifeskillbulk', NULL, 7, 'Hapus data keterampilan secara masal', NULL, 1402127845, 1402127845),
('lifeskillcreate', NULL, 7, 'Tambah data keterampilan', NULL, 1402127845, 1402127845),
('lifeskilldelete', NULL, 7, 'Hapus data keterampilan', NULL, 1402127845, 1402127845),
('lifeskillindex', NULL, 7, 'List data keterampilan', NULL, 1402127845, 1402127845),
('lifeskillupdate', NULL, 7, 'Perbaharui data keterampilan', NULL, 1402127845, 1402127845),
('lifeskillview', NULL, 7, 'Lihat detail data keterampilan', NULL, 1402127845, 1402127845),
('menuaddcattomenu', NULL, 3, 'Tambah data menu', NULL, 1402137983, 1402137983),
('menuaddlinktomenu', NULL, 3, 'Tambah data menu link', NULL, 1402137983, 1402137983),
('menuaddpagetomenu', NULL, 3, 'Tambah data halaman menu', NULL, 1402137983, 1402137983),
('menucreate', NULL, 3, 'Tambah data menu', NULL, 1402137983, 1402137983),
('menudelete', NULL, 3, 'Hapus data menu', NULL, 1402137983, 1402137983),
('menudeletemenuterm', NULL, 3, 'Hapus data menu', NULL, 1402128057, 1402128057),
('menuindex', NULL, 3, 'List data menu', NULL, 1402106807, 1402106807),
('menutest', NULL, 3, 'Tambah menu test', NULL, 1402137983, 1402137983),
('menuupdate', NULL, 3, 'Perbaharui menu', NULL, 1402137983, 1402137983),
('menuupdateposition', NULL, 3, 'Tambah menu posisi', NULL, 1402137983, 1402137983),
('pagecreate', NULL, 3, 'Tambah data halaman', NULL, 1402128057, 1402128057),
('pagedelete', NULL, 3, 'Hapus data halaman', NULL, 1402132872, 1402132872),
('pageindex', NULL, 3, 'List data halaman', NULL, 1402128057, 1402128057),
('pageupdate', NULL, 3, 'Perbaharui data halaman', NULL, 1402132872, 1402132872),
('pageview', NULL, 3, 'Lihat detail data halaman', NULL, 1402132872, 1402132872),
('paskibracreate', NULL, 4, 'Tambah data anggota paskibra', NULL, 1402112278, 1402112278),
('paskibradelete', NULL, 4, 'Hapus data anggota paskibra', NULL, 1402112278, 1402112278),
('paskibraindex', NULL, 4, 'List data anggota paskibra', NULL, 1402112278, 1402112278),
('paskibratrash', NULL, 4, 'Buang ketongsampah data anggota paskibra', NULL, 1402112278, 1402112278),
('paskibraupdate', NULL, 4, 'Perbaharui data anggota paskibra', NULL, 1402112278, 1402112278),
('paskibraview', NULL, 4, 'Lihat detail data anggota paskibra', NULL, 1402112278, 1402112278),
('postbulk', NULL, 3, 'Hapus data post secara masal', NULL, 1402132390, 1402132390),
('postcreate', NULL, 3, 'Tambah data post', NULL, 1402132390, 1402132390),
('postdelete', NULL, 3, 'Hapus data post', NULL, 1402132390, 1402132390),
('postindex', NULL, 3, 'List data post', NULL, 1402132390, 1402132390),
('posttrash', NULL, 3, 'Buang ketongsampah data post', NULL, 1402132390, 1402132390),
('postupdate', NULL, 3, 'Perbaharui data post', NULL, 1402132390, 1402132390),
('postview', NULL, 3, 'Lihat detail data post', NULL, 1402132390, 1402132390),
('ppicreate', NULL, 3, 'Tambah data anggota ppi', NULL, 1402106808, 1402106808),
('ppidelete', NULL, 3, 'Hapus data anggota ppi', NULL, 1402106808, 1402106808),
('ppiindex', NULL, 3, 'List data anggota ppi', NULL, 1402106807, 1402106807),
('ppitrash', NULL, 3, 'Buang ketongsampah data anggota ppi', NULL, 1402106808, 1402106808),
('ppiupdate', NULL, 3, 'Perbaharui data anggota ppi', NULL, 1402106808, 1402106808),
('ppiview', NULL, 3, 'Lihat detail data anggota ppi', NULL, 1402106807, 1402106807),
('schoolbulk', NULL, 3, 'Hapus data skolah secara masal', NULL, 1402128356, 1402128356),
('schoolcreate', NULL, 3, 'Tambah data skolah', NULL, 1402128356, 1402128356),
('schooldelete', NULL, 3, 'Hapus data skolah', NULL, 1402128356, 1402128356),
('schoolindex', NULL, 3, 'List data skolah', NULL, 1402128356, 1402128356),
('schoolupdate', NULL, 3, 'Perbaharui data skolah', NULL, 1402128356, 1402128356),
('schoolview', NULL, 3, 'Lihat detail data skolah', NULL, 1402128356, 1402128356),
('subadminppe', NULL, 2, 'Sub Admin PPE', NULL, 1402106808, 1402106808),
('tagbulk', NULL, 3, 'Hapus data tag secara masal', NULL, 1402132872, 1402132872),
('tagcreate', NULL, 3, 'Tambah data tag', NULL, 1402132872, 1402132872),
('tagdelete', NULL, 3, 'Hapus data tag', NULL, 1402132872, 1402132872),
('tagindex', NULL, 3, 'List data tag', NULL, 1402132872, 1402132872),
('tagupdate', NULL, 3, 'Perbaharui data tag', NULL, 1402132872, 1402132872),
('tagview', NULL, 3, 'Lihat detail data tag', NULL, 1402132872, 1402132872),
('tribebulk', NULL, 3, 'Hapus data suku bangsa secara masal', NULL, 1402128177, 1402128177),
('tribecreate', NULL, 3, 'Tambah data suku bangsa', NULL, 1402128177, 1402128177),
('tribedelete', NULL, 3, 'Hapus data suku bangsa', NULL, 1402128177, 1402128177),
('tribeindex', NULL, 3, 'List data suku bangsa', NULL, 1402128177, 1402128177),
('tribeupdate', NULL, 3, 'Perbaharui data suku bangsa', NULL, 1402128177, 1402128177),
('tribeview', NULL, 3, 'Lihat detail data suku bangsa', NULL, 1402128177, 1402128177),
('widgetcreate', NULL, 3, 'Tambah data widget', NULL, 1402137983, 1402137983),
('widgetdelete', NULL, 3, 'Hapus data widget', NULL, 1402137983, 1402137983),
('widgetindex', NULL, 3, 'List data widget', NULL, 1402137983, 1402137983),
('widgetupdate', NULL, 3, 'Perbaharui data widget', NULL, 1402137983, 1402137983),
('widgetview', NULL, 3, 'Lihat detail widget', NULL, 1402137983, 1402137983);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrator', 'admin'),
('admin', 'adminppe'),
('subadminppe', 'albumcreate'),
('subadminppe', 'albumdelete'),
('subadminppe', 'albumindex'),
('subadminppe', 'albumupdate'),
('subadminppe', 'albumview'),
('subadminppe', 'areabulk'),
('subadminppe', 'areacreate'),
('subadminppe', 'areadelete'),
('subadminppe', 'areaindex'),
('subadminppe', 'areaupdate'),
('subadminppe', 'areaview'),
('subadminppe', 'brevetawardbulk'),
('subadminppe', 'brevetawardcreate'),
('subadminppe', 'brevetawarddelete'),
('subadminppe', 'brevetawardindex'),
('subadminppe', 'brevetawardupdate'),
('subadminppe', 'brevetawardview'),
('subadminppe', 'capascreate'),
('subadminppe', 'capasdelete'),
('subadminppe', 'capasindex'),
('subadminppe', 'capastrash'),
('subadminppe', 'capasupdate'),
('subadminppe', 'capasview'),
('subadminppe', 'categorybulk'),
('subadminppe', 'categorycreate'),
('subadminppe', 'categorydelete'),
('subadminppe', 'categoryindex'),
('subadminppe', 'categoryupdate'),
('subadminppe', 'categoryview'),
('subadminppe', 'dashboardindex'),
('subadminppe', 'dashboardloadmessage'),
('subadminppe', 'imagedelete'),
('subadminppe', 'imageindex'),
('subadminppe', 'imageloadredactoralbum'),
('subadminppe', 'imageloadredactorimage'),
('subadminppe', 'imageupdate'),
('subadminppe', 'imageupload'),
('subadminppe', 'imageuploadredactorimage'),
('subadminppe', 'imageview'),
('subadminppe', 'languageskillbulk'),
('subadminppe', 'languageskillcreate'),
('subadminppe', 'languageskilldelete'),
('subadminppe', 'languageskillindex'),
('subadminppe', 'languageskillupdate'),
('subadminppe', 'languageskillview'),
('subadminppe', 'lifeskillbulk'),
('subadminppe', 'lifeskillcreate'),
('subadminppe', 'lifeskilldelete'),
('subadminppe', 'lifeskillindex'),
('subadminppe', 'lifeskillupdate'),
('subadminppe', 'lifeskillview'),
('subadminppe', 'pageindex'),
('subadminppe', 'paskibracreate'),
('subadminppe', 'paskibradelete'),
('subadminppe', 'paskibraindex'),
('subadminppe', 'paskibratrash'),
('subadminppe', 'paskibraupdate'),
('subadminppe', 'paskibraview'),
('subadminppe', 'postbulk'),
('subadminppe', 'postcreate'),
('subadminppe', 'postdelete'),
('subadminppe', 'postindex'),
('subadminppe', 'posttrash'),
('subadminppe', 'postupdate'),
('subadminppe', 'postview'),
('subadminppe', 'ppicreate'),
('subadminppe', 'ppidelete'),
('subadminppe', 'ppiindex'),
('subadminppe', 'ppitrash'),
('adminppe', 'ppiupdate'),
('subadminppe', 'ppiupdate'),
('subadminppe', 'ppiview'),
('subadminppe', 'schoolbulk'),
('subadminppe', 'schoolcreate'),
('subadminppe', 'schooldelete'),
('subadminppe', 'schoolindex'),
('subadminppe', 'schoolupdate'),
('subadminppe', 'schoolview'),
('adminppe', 'subadminppe'),
('subadminppe', 'tagbulk'),
('subadminppe', 'tagcreate'),
('subadminppe', 'tagdelete'),
('subadminppe', 'tagindex'),
('subadminppe', 'tagupdate'),
('subadminppe', 'tagview'),
('subadminppe', 'tribebulk'),
('subadminppe', 'tribecreate'),
('subadminppe', 'tribedelete'),
('subadminppe', 'tribeindex'),
('subadminppe', 'tribeupdate'),
('subadminppe', 'tribeview');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('UserGroupRule', 'O:37:"app\\modules\\users\\rules\\UserGroupRule":3:{s:4:"name";s:13:"UserGroupRule";s:9:"createdAt";i:1402109093;s:9:"updatedAt";i:1402109093;}', 1402109093, 1402109093);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post1_idx` (`post_id`),
  KEY `fk_comment_comment1_idx` (`parent_id`),
  KEY `fk_comment_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `orginal_name` text NOT NULL,
  `unique_name` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` varchar(45) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `other_content` longtext,
  `create_at` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_file_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `user_id`, `name`, `orginal_name`, `unique_name`, `type`, `size`, `file_type`, `description`, `other_content`, `create_at`, `update_et`) VALUES
(1, 2, 'asdasd.jpg', 'asdasd.jpg', '20140530171040-736380622-asdasd.jpg', 'image', '192972', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-30 17:11:03', '2014-05-30 17:11:03'),
(2, 2, 'adaaas.jpg', 'adaaas.jpg', '20140530171040-645105076-adaaas.jpg', 'image', '239903', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-30 17:11:03', '2014-05-30 17:11:03'),
(3, 2, 'Katy-Perry6.jpg', 'Katy-Perry6.jpg', '20140530220308-467771315-Katy-Perry6.jpg', 'image', '135928', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-30 22:03:20', '2014-05-30 22:03:20'),
(4, 2, 'katy-perry-67a.jpg', 'katy-perry-67a.jpg', '20140530220459-216301044-katy-perry-67a.jpg', 'image', '167618', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-30 22:05:09', '2014-05-30 22:05:09'),
(6, 2, 'katy-perry-konser-di-jakarta.jpg', 'katy-perry-konser-di-jakarta.jpg', '20140531012324-907791745-katy-perry-konser-di-jakarta.jpg', 'image', '435956', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 01:23:49', '2014-05-31 01:23:49'),
(8, 2, 'zahara2.jpg', 'zahara2.jpg', '20140531024551-83850435-zahara2.jpg', 'image', '39366', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 02:45:56', '2014-05-31 02:45:56'),
(11, 2, 'zahara.jpg', 'zahara.jpg', '20140531030612-413906439-zahara.jpg', 'image', '98541', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:06:22', '2014-05-31 03:06:22'),
(12, 2, 'Feature-Darling-Ralinshah-2-790x1024.jpg', 'Feature-Darling-Ralinshah-2-790x1024.jpg', '20140531030840-478484231-Feature-Darling-Ralinshah-2-790x1024.jpg', 'image', '82143', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:09:17', '2014-05-31 03:09:17'),
(13, 2, 'raline-2.jpg', 'raline-2.jpg', '20140531030844-73719400-raline-2.jpg', 'image', '53771', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:09:22', '2014-05-31 03:09:22'),
(14, 2, 'raline shah.jpg', 'raline shah.jpg', '20140531030854-282324478-raline-shah.jpg', 'image', '115558', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:09:22', '2014-05-31 03:09:22'),
(15, 2, 'raline_shah_169.jpg', 'raline_shah_169.jpg', '20140531030843-402767357-raline_shah_169.jpg', 'image', '134840', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:09:23', '2014-05-31 03:09:23'),
(16, 2, 'Feature-Darling-Ralinshah-NS3.jpg', 'Feature-Darling-Ralinshah-NS3.jpg', '20140531030842-410259620-Feature-Darling-Ralinshah-NS3.jpg', 'image', '528800', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:09:25', '2014-05-31 03:09:25'),
(17, 2, 'Raline_Shah.jpg', 'Raline_Shah.jpg', '20140531031930-983344209-Raline_Shah.jpg', 'image', '125380', 'image/jpeg', 'Photo Anggota', NULL, '2014-05-31 03:19:39', '2014-05-31 03:19:39'),
(19, 2, 'DSCN5334.JPG', 'DSCN5334.JPG', '20140601151500-255932468-DSCN5334.JPG', 'image', '495995', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-01 15:15:21', '2014-06-01 15:15:21'),
(20, 2, 'o-KATY-PERRY-570.jpg', 'o-KATY-PERRY-570.jpg', '20140604210225-795444153-o-KATY-PERRY-570.jpg', 'image', '94616', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:02:32', '2014-06-04 21:02:32'),
(21, 2, 'melengo oli .jpg', 'melengo oli .jpg', '20140604210423-599980427-melengo-oli-.jpg', 'image', '47964', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:04:28', '2014-06-04 21:04:28'),
(24, 2, '222167_luna_maya_scaled.jpg', '222167_luna_maya_scaled.jpg', '20140604212331-707017235-222167_luna_maya_scaled.jpg', 'image', '149079', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:23:40', '2014-06-04 21:23:40'),
(25, 2, 'katy_perry_smile_earrings_blac_hd_photo.jpg', 'katy_perry_smile_earrings_blac_hd_photo.jpg', '20140604212356-830060245-katy_perry_smile_earrings_blac_hd_photo.jpg', 'image', '216027', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:24:11', '2014-06-04 21:24:11'),
(26, 2, 'mulan.jpg', 'mulan.jpg', '20140604212428-902121412-mulan.jpg', 'image', '408015', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:24:43', '2014-06-04 21:24:43'),
(27, 2, 'luna-maya.jpg', 'luna-maya.jpg', '20140604212530-594438251-luna-maya.jpg', 'image', '80399', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:25:35', '2014-06-04 21:25:35'),
(28, 2, '200033_katy-pary-hot-armpit_1600x900.jpg', '200033_katy-pary-hot-armpit_1600x900.jpg', '20140604215629-413341852-200033_katy-pary-hot-armpit_1600x900.jpg', 'image', '157171', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:56:39', '2014-06-04 21:56:39'),
(29, 2, 'katy_perry_i_kissed_a_girl_screen.jpg', 'katy_perry_i_kissed_a_girl_screen.jpg', '20140604215706-25328297-katy_perry_i_kissed_a_girl_screen.jpg', 'image', '26683', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:57:09', '2014-06-04 21:57:09'),
(30, 2, 'katy_perry04.jpg', 'katy_perry04.jpg', '20140604215719-103433871-katy_perry04.jpg', 'image', '206403', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:57:33', '2014-06-04 21:57:33'),
(31, 2, 'mulan-jameela-kl.jpg', 'mulan-jameela-kl.jpg', '20140604215804-653830323-mulan-jameela-kl.jpg', 'image', '324784', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 21:58:17', '2014-06-04 21:58:17'),
(32, 2, 'Katy-Perry-d.jpg', 'Katy-Perry-d.jpg', '20140604215944-741264340-Katy-Perry-d.jpg', 'image', '746330', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:00:03', '2014-06-04 22:00:03'),
(33, 2, '600full-leah-dizon.jpg', '600full-leah-dizon.jpg', '20140604220026-475211448-600full-leah-dizon.jpg', 'image', '309236', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:00:39', '2014-06-04 22:00:39'),
(34, 2, 'beauty-bleah-bdizon-682782186.jpg', 'beauty-bleah-bdizon-682782186.jpg', '20140604220046-574119606-beauty-bleah-bdizon-682782186.jpg', 'image', '273413', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:01:01', '2014-06-04 22:01:01'),
(35, 2, 'leah-dizon-swimsuit-1421611113.jpg', 'leah-dizon-swimsuit-1421611113.jpg', '20140604220152-589114130-leah-dizon-swimsuit-1421611113.jpg', 'image', '299127', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:02:09', '2014-06-04 22:02:09'),
(36, 2, 'Leah-Dizon-02.jpg', 'Leah-Dizon-02.jpg', '20140604220530-756537599-Leah-Dizon-02.jpg', 'image', '108209', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:05:38', '2014-06-04 22:05:38'),
(37, 2, 'Leah-Dizon-Wallpaper-Abyss.jpg', 'Leah-Dizon-Wallpaper-Abyss.jpg', '20140604221118-69512727-Leah-Dizon-Wallpaper-Abyss.jpg', 'image', '235434', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:11:31', '2014-06-04 22:11:31'),
(38, 2, 'leah dizon me.jpg', 'leah dizon me.jpg', '20140604221147-496352183-leah-dizon-me.jpg', 'image', '842781', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 22:12:16', '2014-06-04 22:12:16'),
(39, 2, 'LeahDizon-Hawaii.jpg', 'LeahDizon-Hawaii.jpg', '20140604234817-468208685-LeahDizon-Hawaii.jpg', 'image', '76412', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-04 23:48:25', '2014-06-04 23:48:25'),
(40, 2, 'raline-shah.jpg', 'raline-shah.jpg', '20140605000603-811315412-raline-shah.jpg', 'image', '32225', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:06:07', '2014-06-05 00:06:07'),
(41, 2, 'jabtakhaijannbd72.Ganool.com.mkv_005171749.jpg', 'jabtakhaijannbd72.Ganool.com.mkv_005171749.jpg', '20140605001700-940695700-jabtakhaijannbd72.Ganool.com.mkv_005171749.jpg', 'image', '334569', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:17:10', '2014-06-05 00:17:10'),
(42, 2, 'jabtakhaijannbd72.Ganool.com.mkv_002923874.jpg', 'jabtakhaijannbd72.Ganool.com.mkv_002923874.jpg', '20140605001722-958776462-jabtakhaijannbd72.Ganool.com.mkv_002923874.jpg', 'image', '240264', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:17:30', '2014-06-05 00:17:30'),
(44, 2, 'Kakashi-wallpaper-9231029.jpg', 'Kakashi-wallpaper-9231029.jpg', '20140605002053-84666827-Kakashi-wallpaper-9231029.jpg', 'image', '213168', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:21:05', '2014-06-05 00:21:05'),
(45, 2, 'Gaara_Of_The_Sand-wallpaper-9303049.jpg', 'Gaara_Of_The_Sand-wallpaper-9303049.jpg', '20140605002723-645027244-Gaara_Of_The_Sand-wallpaper-9303049.jpg', 'image', '371938', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:27:34', '2014-06-05 00:27:34'),
(46, 2, 'raline-shah5.jpg', 'raline-shah5.jpg', '20140605003519-199308859-raline-shah5.jpg', 'image', '131053', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:06', '2014-06-05 00:36:06'),
(47, 2, 'raline-shah-014.jpg', 'raline-shah-014.jpg', '20140605003521-249462676-raline-shah-014.jpg', 'image', '76266', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:07', '2014-06-05 00:36:07'),
(48, 2, 'raline-shah-art.jpg', 'raline-shah-art.jpg', '20140605003521-797334803-raline-shah-art.jpg', 'image', '109935', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:08', '2014-06-05 00:36:08'),
(49, 2, 'Raline_Shah.jpg', 'Raline_Shah.jpg', '20140605003521-59467688-Raline_Shah.jpg', 'image', '125380', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:09', '2014-06-05 00:36:09'),
(50, 2, 'raline-shah-aaaa157.jpg', 'raline-shah-aaaa157.jpg', '20140605003521-838537178-raline-shah-aaaa157.jpg', 'image', '144300', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:20', '2014-06-05 00:36:20'),
(51, 2, 'raline-shah-010.jpg', 'raline-shah-010.jpg', '20140605003522-658467316-raline-shah-010.jpg', 'image', '150954', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:25', '2014-06-05 00:36:25'),
(52, 2, 'Raline_Shah-po.jpg', 'Raline_Shah-po.jpg', '20140605003607-251477874-Raline_Shah-po.jpg', 'image', '147017', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:36:51', '2014-06-05 00:36:51'),
(53, 2, 'Travis Barker UMG.jpg', 'Travis Barker UMG.jpg', '20140605003610-570121349-Travis-Barker-UMG.jpg', 'image', '274226', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:37:02', '2014-06-05 00:37:02'),
(54, 2, 'travis_landon_barker_by_fernandotravis-d39roji.jpg', 'travis_landon_barker_by_fernandotravis-d39roji.jpg', '20140605003620-964758287-travis_landon_barker_by_fernandotravis-d39roji.jpg', 'image', '195754', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:37:03', '2014-06-05 00:37:03'),
(55, 2, 'travis-barker-blink-182-spl50990_001.jpg', 'travis-barker-blink-182-spl50990_001.jpg', '20140605003609-251477874-travis-barker-blink-182-spl50990_001.jpg', 'image', '277609', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:37:03', '2014-06-05 00:37:03'),
(56, 2, 'trax-raline-shah.jpg', 'trax-raline-shah.jpg', '20140605003644-181463322-trax-raline-shah.jpg', 'image', '130040', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:37:05', '2014-06-05 00:37:05'),
(57, 2, 'barker-600-1361197712.jpg', 'barker-600-1361197712.jpg', '20140605004404-169171441-barker-600-1361197712.jpg', 'image', '175864', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:08', '2014-06-05 00:45:08'),
(58, 2, 'travis.jpg', 'travis.jpg', '20140605004408-283442257-travis.jpg', 'image', '146937', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:15', '2014-06-05 00:45:15'),
(59, 2, 'blink.jpg', 'blink.jpg', '20140605004408-347559812-blink.jpg', 'image', '79854', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:17', '2014-06-05 00:45:17'),
(60, 2, 'blink-182_174.jpg', 'blink-182_174.jpg', '20140605004408-999676856-blink-182_174.jpg', 'image', '166378', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:28', '2014-06-05 00:45:28'),
(61, 2, 'blink182.jpg', 'blink182.jpg', '20140605004408-420571554-blink182.jpg', 'image', '311373', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:39', '2014-06-05 00:45:39'),
(62, 2, 'travis-b.jpg', 'travis-b.jpg', '20140605004515-376829885-travis-b.jpg', 'image', '84056', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:45:55', '2014-06-05 00:45:55'),
(63, 2, 'travis-barker.jpg', 'travis-barker.jpg', '20140605004517-440573446-travis-barker.jpg', 'image', '321773', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:46:05', '2014-06-05 00:46:05'),
(64, 2, 'travis barker portada libro.jpg', 'travis barker portada libro.jpg', '20140605004529-351420224-travis-barker-portada-libro.jpg', 'image', '274943', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:46:25', '2014-06-05 00:46:25'),
(65, 2, 'travisss.jpg', 'travisss.jpg', '20140605004608-438023728-travisss.jpg', 'image', '126289', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:46:48', '2014-06-05 00:46:48'),
(66, 2, 'travisbbb.jpg', 'travisbbb.jpg', '20140605004609-26534044-travisbbb.jpg', 'image', '157141', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 00:46:50', '2014-06-05 00:46:50'),
(67, 2, 'blink-183-photo-band.png', 'blink-183-photo-band.png', '20140605004418-557365018-blink-183-photo-band.png', 'image', '1540747', 'image/png', 'Photo Anggota', NULL, '2014-06-05 00:46:55', '2014-06-05 00:46:55'),
(68, 2, 'Laporan Pekan I.xlsx', 'Laporan Pekan I.xlsx', '20140605010217-253062998-Laporan-Pekan-I.xlsx', 'document', '15901', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Dokumen Laporan Pekan I.xlsx', NULL, '2014-06-05 01:02:17', '2014-06-05 01:02:17'),
(69, 2, 'Laporan Pekan II.xlsx', 'Laporan Pekan II.xlsx', '20140605010243-827112731-Laporan-Pekan-II.xlsx', 'document', '16094', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Dokumen Laporan Pekan II.xlsx', NULL, '2014-06-05 01:02:43', '2014-06-05 01:02:43'),
(70, 2, 'Laporan Pekan III.xlsx', 'Laporan Pekan III.xlsx', '20140605010251-435212770-Laporan-Pekan-III.xlsx', 'document', '25541', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Dokumen Laporan Pekan III.xlsx', NULL, '2014-06-05 01:02:51', '2014-06-05 01:02:51'),
(71, 2, 'ZendServer-6.3.0-RepositoryInstaller-linux.tar.gz', 'ZendServer-6.3.0-RepositoryInstaller-linux.tar.gz', '20140605010304-964620373-ZendServer-6.3.0-RepositoryInstaller-linux.tar.gz', 'document', '6047', 'application/x-gzip', 'Dokumen ZendServer-6.3.0-RepositoryInstaller-linux.tar.gz', NULL, '2014-06-05 01:03:04', '2014-06-05 01:03:04'),
(72, 2, 'Attachments.zip', 'Attachments.zip', '20140605010644-417920693-Attachments.zip', 'document', '1968237', 'application/zip', 'Dokumen Attachments.zip', NULL, '2014-06-05 01:07:13', '2014-06-05 01:07:13'),
(73, 2, 'dropbox_1.6.0_amd64.deb', 'dropbox_1.6.0_amd64.deb', '20140605010713-974871643-dropbox_1.6.0_amd64.deb', 'document', '94178', 'application/x-deb', 'Dokumen dropbox_1.6.0_amd64.deb', NULL, '2014-06-05 01:07:15', '2014-06-05 01:07:15'),
(74, 2, 'ip2location-php-6.0.0.zip', 'ip2location-php-6.0.0.zip', '20140605010745-837115944-ip2location-php-6.0.0.zip', 'document', '1041352', 'application/zip', 'Dokumen ip2location-php-6.0.0.zip', NULL, '2014-06-05 01:08:01', '2014-06-05 01:08:01'),
(75, 2, 'keygen.exe', 'keygen.exe', '20140605010818-337887465-keygen.exe', 'document', '43520', 'application/x-ms-dos-executable', 'Dokumen keygen.exe', NULL, '2014-06-05 01:08:19', '2014-06-05 01:08:19'),
(76, 2, 'serial.txt', 'serial.txt', '20140605010828-128568452-serial.txt', 'document', '117', 'text/plain', 'Dokumen serial.txt', NULL, '2014-06-05 01:08:29', '2014-06-05 01:08:29'),
(82, 2, 'Kakashi-wallpaper-8533288.jpg', 'Kakashi-wallpaper-8533288.jpg', '20140605023629-472132955-Kakashi-wallpaper-8533288.jpg', 'image', '139786', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 02:36:38', '2014-06-05 02:36:38'),
(83, 2, '1397735926747.jpg', '1397735926747.jpg', '20140605025453-626269042-1397735926747.jpg', 'image', '18499', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 02:54:56', '2014-06-05 02:54:56'),
(84, 2, 'C360_2014-05-25-20-11-12-873.jpg', 'C360_2014-05-25-20-11-12-873.jpg', '20140605025646-690652204-C360_2014-05-25-20-11-12-873.jpg', 'image', '374898', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 02:57:08', '2014-06-05 02:57:08'),
(88, 2, '1.jpg', '1.jpg', '20140605185959-719676503-1.jpg', 'image', '21665', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 19:00:15', '2014-06-05 19:00:15'),
(89, 2, '4.jpg', '4.jpg', '20140605185959-177480467-4.jpg', 'image', '29728', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 19:00:15', '2014-06-05 19:00:15'),
(90, 2, '2.jpg', '2.jpg', '20140605185959-5016222-2.jpg', 'image', '31146', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 19:00:15', '2014-06-05 19:00:15'),
(91, 2, '3.jpg', '3.jpg', '20140605185959-558897863-3.jpg', 'image', '29691', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 19:00:15', '2014-06-05 19:00:15'),
(92, 2, '5.jpg', '5.jpg', '20140605190001-797173838-5.jpg', 'image', '29690', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 19:00:15', '2014-06-05 19:00:15'),
(93, 2, 'ayu.jpg', 'ayu.jpg', '20140605215941-513215581-ayu.jpg', 'image', '65378', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 22:00:03', '2014-06-05 22:00:03'),
(94, 2, 'sexs.jpg', 'sexs.jpg', '20140605215942-945144821-sexs.jpg', 'image', '99545', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 22:00:09', '2014-06-05 22:00:09'),
(95, 2, 'fix.jpg', 'fix.jpg', '20140605215942-663642740-fix.jpg', 'image', '59521', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-05 22:00:17', '2014-06-05 22:00:17'),
(96, 2, 'sadasd.jpg', 'sadasd.jpg', '20140606035757-467425999-sadasd.jpg', 'image', '57060', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:40', '2014-06-06 03:58:40'),
(97, 2, 'adasdasd.jpg', 'adasdasd.jpg', '20140606035751-929602171-adasdasd.jpg', 'image', '105222', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:43', '2014-06-06 03:58:43'),
(98, 2, 'adad.jpg', 'adad.jpg', '20140606035751-997915481-adad.jpg', 'image', '114196', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:43', '2014-06-06 03:58:43'),
(99, 2, 'Restyana.jpg', 'Restyana.jpg', '20140606035757-58184688-Restyana.jpg', 'image', '75802', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:43', '2014-06-06 03:58:43'),
(100, 2, 'asdasd.jpg', 'asdasd.jpg', '20140606035751-340310200-asdasd.jpg', 'image', '171658', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:43', '2014-06-06 03:58:43'),
(101, 2, 'sdsd.jpg', 'sdsd.jpg', '20140606035807-381685941-sdsd.jpg', 'image', '65618', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 03:58:47', '2014-06-06 03:58:47'),
(102, 2, 'katy_perry_2012-wallpaper-1024x768.jpg', 'katy_perry_2012-wallpaper-1024x768.jpg', '20140606142517-225886704-katy_perry_2012-wallpaper-1024x768.jpg', 'image', '117846', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 14:25:24', '2014-06-06 14:25:24'),
(103, 2, 'katy_perry_california_gurls-wallpaper-1024x768.jpg', 'katy_perry_california_gurls-wallpaper-1024x768.jpg', '20140606142554-112068943-katy_perry_california_gurls-wallpaper-1024x768.jpg', 'image', '331762', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-06 14:26:11', '2014-06-06 14:26:11'),
(104, 3, 'sdf.jpg', 'sdf.jpg', '20140607181843-806472768-sdf.jpg', 'image', '51895', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-07 18:18:50', '2014-06-07 18:18:50'),
(105, 2, 'C360_2014-06-06-19-27-27-523.jpg', 'C360_2014-06-06-19-27-27-523.jpg', '20140607203557-493839398-C360_2014-06-06-19-27-27-523.jpg', 'image', '282086', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-07 20:36:19', '2014-06-07 20:36:19'),
(106, 9, '254234_prabowo-kunjungi-ponpes-al-qodiri_663_382.jpg', '254234_prabowo-kunjungi-ponpes-al-qodiri_663_382.jpg', '20140608154827-651111828-254234_prabowo-kunjungi-ponpes-al-qodiri_663_382.jpg', 'image', '52571', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-08 15:48:32', '2014-06-08 15:48:32'),
(107, 9, '254421_prabowo-di-solo-_663_382.jpg', '254421_prabowo-di-solo-_663_382.jpg', '20140608155229-433173289-254421_prabowo-di-solo-_663_382.jpg', 'image', '49583', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-08 15:52:34', '2014-06-08 15:52:34'),
(108, 9, '254483_skuad-timnas-inggris-saat-melawan-honduras-_663_382.JPG', '254483_skuad-timnas-inggris-saat-melawan-honduras-_663_382.JPG', '20140608155538-307573553-254483_skuad-timnas-inggris-saat-melawan-honduras-_663_382.JPG', 'image', '55322', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-08 15:55:44', '2014-06-08 15:55:44'),
(109, 9, '197707_lionel-messi--kiri--dan-gonzalo-higuain--tengah--rayakan-gol-argentina_663_382.jpg', '197707_lionel-messi--kiri--dan-gonzalo-higuain--tengah--rayakan-gol-argentina_663_382.jpg', '20140608155913-451054430-197707_lionel-messi--kiri--dan-gonzalo-higuain--tengah--rayakan-gol-argentina_663_382.jpg', 'image', '36630', 'image/jpeg', 'Photo Anggota', NULL, '2014-06-08 15:59:17', '2014-06-08 15:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE IF NOT EXISTS `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `web_site` varchar(45) DEFAULT NULL,
  `subject` varchar(45) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` varchar(45) DEFAULT 'Unconfirmed',
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guest_book_guest_book1_idx` (`parent_id`),
  KEY `fk_guest_book_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `guest_book`
--

INSERT INTO `guest_book` (`id`, `user_id`, `parent_id`, `name`, `email`, `web_site`, `subject`, `content`, `status`, `create_et`, `update_et`) VALUES
(1, NULL, NULL, 'ozan rock', 'oz4n.rock@gmail.com', 'http://google.com', 'Motipasi dalam diri', 'Parsley amaranth tigernut silver beet maize fennel spinach. Ricebean black-eyed pea maize scallion green bean spinach cabbage jícama bell pepper carrot onion corn plantain garbanzo. Sierra leone bologi komatsuna celery peanut swiss chard silver beet squas', 'Publish', '2014-06-04 00:00:00', '2014-06-04 00:00:00'),
(2, NULL, NULL, 'fauzan', 'facebook.oz4n@gmail.com', 'http://google.com', 'hidup itu segalanya', 'Parsley amaranth tigernut silver beet maize fennel spinach. Ricebean black-eyed pea maize scallion green bean spinach cabbage jícama bell pepper carrot onion corn plantain garbanzo. Sierra leone bologi komatsuna celery peanut swiss chard silver beet squas', 'Publish', '2014-06-04 00:00:00', '2014-06-04 00:00:00'),
(3, NULL, NULL, 'melengo', 'm3l3ngok@gmail.com', 'http://google.com', 'dunia itu milik kita berdua', 'Parsley amaranth tigernut silver beet maize fennel spinach. Ricebean black-eyed pea maize scallion green bean spinach cabbage jícama bell pepper carrot onion corn plantain garbanzo. Sierra leone bologi komatsuna celery peanut swiss chard silver beet squas', 'Publish', '2014-06-04 00:00:00', '2014-06-04 00:00:00'),
(4, NULL, NULL, 'ahmad zaini', 'ozan.rock@gmail.com', NULL, 'bisnis apa yang di kerjakan paskibra', 'bisnis apa yang di kerjakan paskibra et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, ', 'Publish', '2014-06-04 13:08:45', '2014-06-04 13:08:45'),
(5, NULL, NULL, 'holillulloh', 'ozan.rock@yahoo.co.id', NULL, 'mereka masih di jalan', 'Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit landitiis.', 'Publish', '2014-06-04 13:10:45', '2014-06-04 13:10:45'),
(6, NULL, NULL, 'nune erfan', 'nunenuh@gmail.com', NULL, 'masak iya harus mengubah dana', 'et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit landitiis.\r\n', 'Publish', '2014-06-04 13:14:36', '2014-06-04 13:14:36'),
(7, NULL, NULL, 'nune erfan', 'nunenuh@gmail.com', NULL, 'masak iya harus mengubah dana', 'et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit landitiis.\r\n', 'Publish', '2014-06-04 13:15:42', '2014-06-04 13:15:42'),
(8, NULL, NULL, 'fauzan', 'ozan.rock@yahoo.co.id', NULL, 'melengo inem oli', 'Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit landitiis.', 'Publish', '2014-06-04 13:35:45', '2014-06-04 13:35:45'),
(9, NULL, NULL, 'dagul', 'moh.fauzan.azim@gmail.com', '', 'saran yang membangun pada form berikut ini.', 'Info! Silakan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', 'Publish', '2014-06-04 13:44:05', '2014-06-04 13:44:05'),
(10, NULL, NULL, 'ozan rock', 'ozan.rock@yahoo.co.id', NULL, 'Silahkan para pengunjung sekalian', 'Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini. bisnis apa yang di kerjakan paskibra et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti', 'Unconfirmed', '2014-06-04 15:05:57', '2014-06-04 15:05:57'),
(11, NULL, NULL, 'Nuari', 'nuari@gmail.com', NULL, 'saran', 'maju terus ppi lombok tengah. jangan ragu dan jangan malu.', 'Unconfirmed', '2014-06-05 02:49:42', '2014-06-05 02:49:42'),
(13, NULL, NULL, 'malik', 'malik@gmail.com', NULL, 'Silahkan para pengunjung sekalian ', 'Info! Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', 'Unconfirmed', '2014-06-05 18:05:22', '2014-06-05 18:05:22'),
(14, NULL, NULL, 'ozan rock', 'ozan.rock@yahoo.co.id', NULL, 'saran yang membangun pada form berikut ini.', 'Info! Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', 'Unconfirmed', '2014-06-05 18:06:13', '2014-06-05 18:06:13'),
(15, NULL, NULL, 'melengo', 'oz4n.rock@yahoo.co.id', NULL, 'bisnis apa yang di kerjakan paskibra', 'bisnis apa yang di kerjakan paskibra et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet,', 'Unconfirmed', '2014-06-05 18:07:03', '2014-06-05 18:07:03'),
(16, NULL, NULL, 'nunenuh', 'nunenuh@gmail.com', NULL, 'expedita distinctio lorem ipsum', 'bisnis apa yang di kerjakan paskibra et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet,', 'Unconfirmed', '2014-06-05 18:08:43', '2014-06-05 18:08:43'),
(17, NULL, NULL, 'zaini', 'zainiaroni@gmail.com', NULL, 'dunia kita satu kenapa tidak bersatu', 'Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', 'Unconfirmed', '2014-06-05 20:53:27', '2014-06-05 20:53:27'),
(18, NULL, NULL, 'mariam', 'mariam@gmail.com', NULL, 'Bisnis Apa Yang Di Kerjakan Paskibra', 'mariam belina merupakan orang yang sangat baik akan tetapi sering mengalami lemah jantung', 'Unconfirmed', '2014-06-05 20:56:40', '2014-06-05 20:56:40'),
(19, NULL, NULL, 'meong', 'meong@gmail.com', NULL, 'kritik dan saran yang membangun pada', 'Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', 'Unconfirmed', '2014-06-05 21:17:34', '2014-06-05 21:17:34'),
(20, NULL, NULL, 'Nuari', 'nuari@gmail.com', NULL, 'fasilitas', 'kapan semua akan di tindak lanjuti', 'Unconfirmed', '2014-06-08 14:55:36', '2014-06-08 14:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nra` varchar(32) NOT NULL,
  `name` varchar(45) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `front_photo` mediumtext,
  `side_photo` mediumtext,
  `address` varchar(255) NOT NULL,
  `birth` varchar(25) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `age` int(3) DEFAULT '0',
  `marital_status` varchar(15) NOT NULL,
  `job` varchar(45) DEFAULT NULL,
  `income_member` varchar(45) DEFAULT NULL,
  `blood_group` varchar(25) NOT NULL,
  `father_name` varchar(45) NOT NULL,
  `mother_name` varchar(45) NOT NULL,
  `father_work` varchar(45) DEFAULT NULL,
  `mother_work` varchar(45) DEFAULT NULL,
  `income_father` varchar(45) DEFAULT NULL,
  `income_mothers` varchar(45) DEFAULT NULL,
  `number_of_brothers` int(2) DEFAULT NULL,
  `number_of_sisters` int(2) DEFAULT NULL,
  `number_of_children` int(2) DEFAULT NULL,
  `educational_status` varchar(15) NOT NULL,
  `zip_code` varchar(15) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `other_phone_number` varchar(15) NOT NULL,
  `relationship_phone_number` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `organizational_experience` varchar(45) DEFAULT NULL,
  `year` varchar(45) NOT NULL,
  `illness` varchar(45) NOT NULL,
  `height_body` varchar(5) NOT NULL,
  `weight_body` varchar(5) NOT NULL,
  `dress_size` varchar(5) DEFAULT NULL,
  `pants_size` varchar(5) DEFAULT NULL,
  `shoe_size` varchar(5) DEFAULT NULL,
  `hat_size` varchar(5) DEFAULT NULL,
  `brevetaward` text,
  `lifeskill` text,
  `languageskill` text,
  `membership_status` varchar(25) NOT NULL,
  `status_organization` varchar(25) NOT NULL,
  `type_member` varchar(25) DEFAULT NULL,
  `tribal_members` varchar(45) NOT NULL,
  `identity_card` text,
  `certificate_of_organization` text,
  `identity_card_number` varchar(25) NOT NULL,
  `names_recommended` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `other_content` text,
  `slug` text,
  `save_status` varchar(45) NOT NULL,
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_member_school1_idx` (`school_id`),
  KEY `fk_member_user1_idx` (`user_id`),
  KEY `fk_member_taxonomy1_idx` (`taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `taxonomy_id`, `school_id`, `user_id`, `nra`, `name`, `nickname`, `front_photo`, `side_photo`, `address`, `birth`, `nationality`, `religion`, `gender`, `age`, `marital_status`, `job`, `income_member`, `blood_group`, `father_name`, `mother_name`, `father_work`, `mother_work`, `income_father`, `income_mothers`, `number_of_brothers`, `number_of_sisters`, `number_of_children`, `educational_status`, `zip_code`, `phone_number`, `other_phone_number`, `relationship_phone_number`, `email`, `organizational_experience`, `year`, `illness`, `height_body`, `weight_body`, `dress_size`, `pants_size`, `shoe_size`, `hat_size`, `brevetaward`, `lifeskill`, `languageskill`, `membership_status`, `status_organization`, `type_member`, `tribal_members`, `identity_card`, `certificate_of_organization`, `identity_card_number`, `names_recommended`, `note`, `other_content`, `slug`, `save_status`, `create_et`, `update_et`) VALUES
(1, 114, 1, 2, '085678234', 'Moh Fauzan Azim', 'Fauzan', '20140531030843-402767357-raline_shah_169.jpg', '20140604210225-795444153-o-KATY-PERRY-570.jpg', 'jln suasembada 11 no 25', '17 Juni 1990', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'ahmad dahlan', 'suryati', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 5, 5, 5, 'SMA', '8145', '0818345070', '0818347812', 'Orang Tua', 'fauzan@gmail.com', 'Mapala', '2011', 'insomenia', '67', '43', 'L', '45', '45', '45', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'indonesia', '20140531012324-907791745-katy-perry-konser-di-jakarta.jpg', '20140530171040-645105076-adaaas.jpg', '08637219', NULL, 'sering mendapatkan uang', NULL, NULL, 'Publish', '2014-06-04 18:58:45', '2014-06-04 21:02:39'),
(2, 114, 1, 2, '085678431', 'jailani ahmad', 'ahmad', '20140531031930-983344209-Raline_Shah.jpg', '20140604210441-223811301-Screenshot-from-2014-04-22-02:29:06.png', 'jln suasembada 11 no 25', '17 Juni 1990', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'ahmad dahlan', 'suryati', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 5, 5, 5, 'SMA', '8145', '0818345070', '0818347812', 'Orang Tua', 'fauzan@gmail.com', 'Mapala', '2011', 'insomenia', '67', '43', 'L', '45', '45', '45', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'indonesia', '20140604210423-599980427-melengo-oli-.jpg', '20140604210511-200681084-Screenshot-from-2014-04-24-17:03:08.png', '08637219', NULL, 'sering mendapatkan uang', NULL, NULL, 'Publish', '2014-06-04 19:15:05', '2014-06-05 00:04:10'),
(3, 114, 1, 2, '085678432', 'zaini aroni', 'zaini', '20140605000603-811315412-raline-shah.jpg', '20140531030840-478484231-Feature-Darling-Ralinshah-2-790x1024.jpg', 'jln suasembada 11 no 25', '17 Juni 1990', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'ahmad dahlan', 'suryati', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 5, 5, 5, 'SMA', '8145', '0818345070', '0818347812', 'Orang Tua', 'fauzan@gmail.com', 'Mapala', '2011', 'insomenia', '67', '43', 'L', '45', '45', '45', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'indonesia', '20140531024551-83850435-zahara2.jpg', '20140601151500-255932468-DSCN5334.JPG', '08637219', NULL, 'sering mendapatkan uang', NULL, NULL, 'Publish', '2014-06-04 19:33:41', '2014-06-05 00:06:12'),
(4, 114, 1, 2, '085678432', 'halillulloh', 'holil', '20140531030612-413906439-zahara.jpg', '20140530220459-216301044-katy-perry-67a.jpg', 'jln suasembada 11 no 25', '17 Juni 1990', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'ahmad dahlan', 'suryati', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 5, 5, 5, 'SMA', '8145', '0818345070', '0818347812', 'Orang Tua', 'fauzan@gmail.com', 'Mapala', '2011', 'insomenia', '67', '43', 'L', '45', '45', '45', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'indonesia', '20140530171040-645105076-adaaas.jpg', '20140531031930-983344209-Raline_Shah.jpg', '08637219', NULL, 'sering mendapatkan uang', NULL, NULL, 'Publish', '2014-06-04 19:35:40', '2014-06-05 00:04:58'),
(5, 112, 1, 2, '199091', 'vina pandawinata', 'vina', '20140604212356-830060245-katy_perry_smile_earrings_blac_hd_photo.jpg', '20140604234817-468208685-LeahDizon-Hawaii.jpg', 'jln suasembada 11 no 25', '23 Juni 1990', 'Indonesia', 'Katholik', 'Perempuan', 78, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'Khairudin', 'husniwati', 'PNS', 'PNS', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 3, 3, 3, 'SMA', '8314', '0818345021', '0813214561', 'Orang Tua', 'vina@gmail.com', 'mapala', '2011', 'Insomnia', '87', '76', 'S', '9', '5', '5', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'sasak', '20140604212428-902121412-mulan.jpg', '20140604212530-594438251-luna-maya.jpg', '8273199298', NULL, 'melengo inem oli', NULL, NULL, 'Publish', '2014-06-04 21:22:36', '2014-06-04 23:51:34'),
(6, 114, 1, 2, '87629372', 'juli hari astiawan', 'juli', '20140531030843-402767357-raline_shah_169.jpg', '20140604215706-25328297-katy_perry_i_kissed_a_girl_screen.jpg', 'jln musium city mataram', '18 Juni 1989', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah AB', 'julianwar', 'juli kasih', 'PNS', 'PNS', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 5, 1, 2, 'SMA', '8314', '9123829209', '9120839102', 'Adik', 'juli@hari.com', 'mapala', '2011', 'insomnia', '87', '89', 'XL', '23', '21', '32', 'Intelegen', NULL, NULL, 'Anggota Biasa', 'Aktif', 'Paskibra', 'sasak', '20140604215719-103433871-katy_perry04.jpg', '20140604215804-653830323-mulan-jameela-kl.jpg', '904239847190238', NULL, '34 thun saya belajar', NULL, NULL, 'Publish', '2014-06-04 21:56:12', '2014-06-04 23:56:58'),
(7, 114, 1, 2, '876293721', 'budi anduk', 'budi', '20140604212428-902121412-mulan.jpg', '20140604220026-475211448-600full-leah-dizon.jpg', 'jln musium city mataram', '18 Juni 1989', 'indonesia', 'Islam', 'Laki-Laki', 24, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah AB', 'julianwar', 'juli kasih', 'PNS', 'PNS', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 5, 1, 2, 'SMA', '8314', '9123829209', '9120839102', 'Adik', 'juli@hari.com', 'mapala', '2011', 'insomnia', '87', '89', 'XL', '23', '21', '32', 'Intelegen', NULL, NULL, 'Anggota Biasa', 'Aktif', 'Paskibra', 'sasak', '20140604220046-574119606-beauty-bleah-bdizon-682782186.jpg', '20140604220152-589114130-leah-dizon-swimsuit-1421611113.jpg', '904239847190238', NULL, 'maling uang rakyat', NULL, NULL, 'Publish', '2014-06-04 22:02:31', '2014-06-05 00:07:49'),
(8, 112, 1, 2, '10983129038', 'katy parry', 'katy', '20140604210225-795444153-o-KATY-PERRY-570.jpg', '20140604221118-69512727-Leah-Dizon-Wallpaper-Abyss.jpg', 'jln suasembada 11 25', '04 Juni 1981', 'indonesia', 'Islam', 'Laki-Laki', 21, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah A', 'kalil gibran', 'kalil ihsan', 'PNS', 'PNS', 'Rp.11000000 s/d Rp.13000000', 'Rp.4000000 s/d Rp.7000000', 12, 1, 1, 'SMA', '81921', '19823798', '823749823', 'Keluarga', 'ozan@gmail.com', 'mapala', '2011', 'insomnia', '81', '21', 'XL', '34', '34', '21', 'Intelegen', 'Membunuh', 'Jepang', 'Anggota Biasa', 'Aktif', 'Capas', 'sasak', '20140604221147-496352183-leah-dizon-me.jpg', '20140604212331-707017235-222167_luna_maya_scaled.jpg', '12893192389', NULL, 'sering makan ati', NULL, NULL, 'Publish', '2014-06-04 22:15:30', '2014-06-05 00:32:55'),
(10, 114, 1, 2, '098888', 'Zulham Mubarak', 'zulham', '20140531030612-413906439-zahara.jpg', '20140605001722-958776462-jabtakhaijannbd72.Ganool.com.mkv_002923874.jpg', 'jalan udayana mataram', '10 Desember 2014', 'WNI', 'Islam', 'Laki-Laki', 17, 'Menikah', 'PNS', NULL, 'Golongan Darah A', 'sahar', 'rini', 'TNI/PORLI', 'Ibu Rumah Tangga', 'Rp.17000000 s/d Rp.19000000', 'Rp.12000000 s/d Rp.16000000', 3, 4, 4, 'S1', '83113', '0892999292929', '098989898', 'Kakak', 'a@gmail.com', 'Ketua Osis', '2011', 'tidak ada', '170', '50', 'S', '30', '42', 'M', 'Intelegen', 'makan, Mutilasi', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'SUMBAWA', '20140605001751-938254590-Screenshot-from-2014-06-03-22:21:27.png', '20140605185959-177480467-4.jpg', '09888288282828282882', NULL, 'nothing is mather', NULL, NULL, 'Publish', '2014-06-05 00:18:33', '2014-06-05 21:57:44'),
(11, 112, 1, 2, '78878787', 'muhammad junaidi', 'juna', '20140605215942-945144821-sexs.jpg', '20140605215942-663642740-fix.jpg', 'Gerung Lombok barat', '11 Juni 1989', 'WNI', 'Budha', 'Perempuan', 34, 'Janda', 'Pelajar/Mahasisawa', NULL, 'Golongan Darah B', 'sahar', 'rini', 'PNS', 'TNI/PORLI', 'Rp.8000000 s/d Rp.10000000', 'Rp.8000000 s/d Rp.10000000', 5, 4, 4, 'D2', '822333', '0892999292929', '444444', 'Adik', 's@gmail.com', 'Ketua Osis', '2011', 'NOTING', '170', '50', 'XL', '30', '42', 'M', 'Intelegen', 'makan, mocu', 'Jepang', 'Anggota Kehormatan', 'Non Aktif', 'PPI', 'BIMA', '20140605001751-938254590-Screenshot-from-2014-06-03-22:21:27.png', '20140605185959-719676503-1.jpg', '8828278237', NULL, 'noting', NULL, NULL, 'Publish', '2014-06-05 00:29:44', '2014-06-05 22:01:59'),
(12, 112, 1, 2, '646564', 'AL Gifary', 'fari', '20140605003644-181463322-trax-raline-shah.jpg', '20140605003521-797334803-raline-shah-art.jpg', 'jalan ali baba mataram', '16 April 1989', 'WNI', 'Protestan', 'Perempuan', 18, 'Menikah', 'TNI/PORLI', NULL, 'Golongan Darah B', 'sabarudin', 'tia', 'Wiraswasta', 'Wiraswasta', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 45, 6, 3, 'SMK', '83113', '0892999292929', '444444', 'Teman', 'b@gmail.com', 'Anggota Osis', '2011', 'malaria', '170', '45', 'M', '32', '43', '6', 'Intelegen', 'mocu, mocu, mocu', 'Jepang', 'Anggota Biasa', 'PDTH', 'PPI', 'jawa', '20140605003521-249462676-raline-shah-014.jpg', '20140605001751-938254590-Screenshot-from-2014-06-03-22:21:27.png', '6535343333333', NULL, 'mencoba', NULL, NULL, 'Publish', '2014-06-05 00:39:09', '2014-06-05 00:39:09'),
(13, 142, 2, 2, '98989898', 'Lanang Pamungkas', 'lanang', '20140605004408-283442257-travis.jpg', '', 'mataram ajja', '12 Juni 1990', 'WNI', 'Islam', 'Laki-Laki', 18, 'Duda', 'Wiraswasta', NULL, 'Golongan Darah AB', 'sahar', 'rini', 'Guru/Dosen', 'Ibu Rumah Tangga', 'Rp.11000000 s/d Rp.13000000', 'Rp.4000000 s/d Rp.7000000', 3, 6, 4, 'MA', '83113', '0892999292929', '444444', 'Teman', 'a@gmail.com', 'Anggota Bem', '2011', 'jantung', '165', '45', 'XS', '29', '42', 'M', 'Sniper, Kapten', 'silat, Karate, Karate', 'Jepang', 'Anggota Biasa', 'Aktif', 'PPI', 'jawa', '', '', '8989898989', NULL, 'hanya kamu saja', NULL, NULL, 'Publish', '2014-06-05 00:57:43', '2014-06-05 00:57:43'),
(14, 143, 4, 2, '76767676', 'Rana Rini', 'rna', '20140605004608-438023728-travisss.jpg', '', 'mataram lombok', '03 Juni 2014', 'WNI', 'Hindu', 'Perempuan', 17, 'Janda', 'Guru/Dosen', NULL, 'Golongan Darah A', 'sahar', 'rini', 'Guru/Dosen', 'Wiraswasta', 'Rp.11000000 s/d Rp.13000000', 'Rp.8000000 s/d Rp.10000000', 45, 4, 4, 'SMK', '83113', '0892999292929', '444444', 'Teman', 'a@gmail.com', 'Anggota Bem', '2010', 'jantung', '170', '50', 'L', '30', '42', 'M', 'Assist', 'Karate, Karate, Karate', 'inggris', 'Pengurus Kota', 'Aktif', 'PPI', 'sasak', '', '', '6535343333333', NULL, 'ffff', NULL, NULL, 'Publish', '2014-06-05 01:05:00', '2014-06-05 01:05:00'),
(15, 141, 3, 2, '89898989', 'SEVIA asiana ', 'sel', '20140605215941-513215581-ayu.jpg', '', 'gunung sari', '12 Juni 1989', 'WNI', 'Islam', 'Perempuan', 18, 'Menikah', 'Karyawan Swasta', NULL, 'Golongan Darah AB', 'ali', 'ila', 'Pelajar/Mahasisawa', 'TNI/PORLI', 'Rp.11000000 s/d Rp.13000000', 'Rp.4000000 s/d Rp.7000000', 3, 4, 4, 'MA', '83113', '0892999292929', '444444', 'Keluarga', 'a@gmail.com', 'Ketua Osis', '2009', 'hati', '160', '50', 'M', '30', '42', 'M', 'Kapten', 'silat, renang', 'spanyol', 'Pengurus Pusat', 'Aktif', 'PPI', 'SUMBAWA', '', '', '09888288282828282882', NULL, 'nakjnj', NULL, NULL, 'Publish', '2014-06-05 01:08:26', '2014-06-05 22:04:21'),
(16, 142, 3, 3, '53333', 'Arifin', 'arif', '20140605004515-376829885-travis-b.jpg', '20140606142517-225886704-katy_perry_2012-wallpaper-1024x768.jpg', 'pejeruk', '01 April 2014', 'WNI', 'Islam', 'Perempuan', 18, 'Menikah', 'Ibu Rumah Tangga', NULL, 'Golongan Darah A', 'ali', 'ila', 'TNI/PORLI', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.11000000 s/d Rp.13000000', 45, 4, 4, 'MA', '822333', '0892999292929', '444444', 'Orang Tua', 'b@gmail.com', 'Ketua Osis', '2011', 'tidak ada', '160', '50', 'XXL', '30', '42', 'M', 'Assist', 'makan, renang', 'melayu', 'Pengurus Provinsi', 'PDTH', 'PPI', 'BIMA', '20140605004608-438023728-travisss.jpg', '20140605215942-663642740-fix.jpg', '09888288282828282882', NULL, 'rsd', NULL, NULL, 'Publish', '2014-06-05 01:13:36', '2014-06-07 04:02:06'),
(17, 114, 2, 2, '53645646746', 'Diah Lmana', 'arif', '20140605004408-283442257-travis.jpg', '', 'lingsar', '09 April 2014', 'WNA', 'Islam', 'Laki-Laki', 18, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah A', 'ali', 'tia', 'Wiraswasta', 'Ibu Rumah Tangga', 'Rp.4000000 s/d Rp.7000000', 'Rp.1000000 s/d Rp.3000000', 3, 4, 4, 'S3', '83113', '0892999292929', '444444', 'Teman', 'a@gmail.com', 'Anggota Bem', '2010', 'jantung', '170', '50', 'XXXL', '30', '42', 'M', 'Intelegen', NULL, NULL, 'Pengurus Kab', 'Mutasi', 'PPI', 'sasak', '', '', '6535343333333', NULL, 'ADSDA', NULL, NULL, 'Publish', '2014-06-05 01:17:29', '2014-06-05 01:17:29'),
(18, 142, 3, 2, '98989898', 'Lalu Lintas', 'rna', '20140605004529-351420224-travis-barker-portada-libro.jpg', '', 'asasa', '18 Juni 2014', 'WNA', 'Islam', 'Perempuan', 18, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah AB', 'sahar', 'rini', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', '0', 3, 4, 4, 'SMA', '83113', '0892999292929', '444444', 'Keluarga', 'a@gmail.com', 'Ketua Osis', '2011', 'tidak ada', '170', '50', 'S', '29', '42', 'M', 'Assist', 'makan, berlari, berlari', 'inggris', 'Anggota Biasa', 'Aktif', 'PPI', 'SUMBAWA', '', '', '6535343333333', NULL, 'saaa', NULL, NULL, 'Publish', '2014-06-05 01:20:36', '2014-06-05 01:20:36'),
(19, 143, 2, 2, '9898989898', 'SAFARI', 'SAFAR', '20140605003521-59467688-Raline_Shah.jpg', '', 'MATARAM', '30 Juli 2014', 'WNI', 'Islam', 'Laki-Laki', 18, 'Belum Menikah', 'Pelajar/Mahasisawa', NULL, 'Golongan Darah AB', 'sahar', 'ila', 'PNS', 'PNS', '0', '0', 45, 4, 4, 'SMA', '83113', '0892999292929', '444444', 'Teman', 'a@gmail.com', 'Anggota Bem', '2019', 'jantung', '170', '45', 'M', '29', '43', 'M', 'Sniper', 'Karate, makan, makan', 'spanyol', 'Pengurus Kab', 'Non Aktif', 'PPI', 'SUMBAWA', '', '', '8989898989', NULL, 'hbhb', NULL, NULL, 'Publish', '2014-06-05 01:24:28', '2014-06-05 01:24:28'),
(20, 141, 2, 2, '782782748372', 'Nuari Jasa Maulana', 'ari', '20140605004609-26534044-travisbbb.jpg', '', 'pejeruk ampenan', '24 Juni 1989', 'WNI', 'Islam', 'Laki-Laki', 23, 'Menikah', 'PNS', NULL, 'Golongan Darah A', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.17000000 s/d Rp.19000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2019', 'jantung', '171', '61', 'M', '43', '54', '33', 'Assist', 'silat, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'SASAK', '', '', '878723847328347287', NULL, 'gggg', NULL, NULL, 'Publish', '2014-06-05 01:38:43', '2014-06-05 01:38:43'),
(21, 112, 3, 2, '827827827827', 'Juli AJJA', 'AJJA', '20140605004404-169171441-barker-600-1361197712.jpg', '', 'MATARAM NUSA TENGGRARA BARAT JALAN KH HAJI MANSUR INDONESIA KECAMATAN MATARAM', '11 Juli 1989', 'WNA', 'Islam', 'Laki-Laki', 21, 'Menikah', 'PNS', NULL, 'Golongan Darah A', 'nuari', 'siti hubai', 'Karyawan Swasta', 'Pelajar/Mahasisawa', 'Rp.17000000 s/d Rp.19000000', 'Rp.11000000 s/d Rp.13000000', 2, 2, 4, 'SMK', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2019', 'Hati', '171', '61', 'M', '43', '54', '33', 'Intelegen', 'silat, jumping, jumping', 'china', 'Anggota Kehormatan', 'Non Aktif', 'Paskibra', 'SASAK', '', '', '9742873823782782', NULL, 'fffffhrrt', NULL, NULL, 'Publish', '2014-06-05 01:44:00', '2014-06-05 01:44:00'),
(22, 112, 4, 2, '872837287238472', 'Nune Erfan', 'AJJA', '20140605004408-420571554-blink182.jpg', '', 'kecamatan lingsar', '11 Juni 1989', 'WNA', 'Islam', 'Laki-Laki', 20, 'Menikah', 'Karyawan Swasta', NULL, 'Golongan Darah A', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.12000000 s/d Rp.16000000', 'Rp.17000000 s/d Rp.19000000', 2, 2, 4, 'S3', '83113', '9898392898', '12384198198', 'Adik', 'k@gmail.com', 'Panitia Osis', '2010', 'jantung', '171', '61', 'XL', '43', '54', '33', 'Kapten', 'silat, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'ytyyt', NULL, NULL, 'Publish', '2014-06-05 01:47:38', '2014-06-05 01:47:38'),
(23, 142, 2, 2, '8787878787', 'Nur Azizah', 'ari', '20140605003644-181463322-trax-raline-shah.jpg', '', 'mataram', '10 Juni 2014', 'WNI', 'Islam', 'Perempuan', 21, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah AB', 'nuari', 'siti hubai', 'Guru/Dosen', 'Ibu Rumah Tangga', 'Rp.4000000 s/d Rp.7000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Kakak', 'k@gmail.com', 'Panitia Osis', '2010', 'jantung', '171', '61', 'XL', '43', '54', '33', 'Sniper', 'makan, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'yghyghgh', NULL, NULL, 'Publish', '2014-06-05 01:51:13', '2014-06-05 01:51:13'),
(24, 114, 1, 2, '787827384728', 'Muhammad AL gAZALI', 'AJJA', '20140605215942-663642740-fix.jpg', '', 'MATARAM NUSA DUA', '24 Juni 1989', 'WNA', 'Islam', 'Laki-Laki', 23, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah B', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.12000000 s/d Rp.16000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2014', 'Hati', '171', '61', 'M', '43', '54', '33', 'Kapten', 'makan, jumping', 'spanyol', 'Pengurus Provinsi', 'Non Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'FGFGF', NULL, NULL, 'Publish', '2014-06-05 01:54:00', '2014-06-06 03:49:50'),
(25, 141, 1, 2, '8777827847287', 'Nassruddin', 'ari', '20140605004515-376829885-travis-b.jpg', '', 'ampenan batu layar', '25 Juni 1878', 'WNA', 'Islam', 'Perempuan', 20, 'Belum Menikah', 'TNI/PORLI', NULL, 'Golongan Darah AB', 'nuari', 'siti hubai', 'PNS', 'TNI/PORLI', 'Rp.4000000 s/d Rp.7000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2011', 'jantung', '171', '61', 'S', '43', '54', '33', NULL, 'silat, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'SASAK', '', '', '878723847328347287', NULL, 'yygy', NULL, NULL, 'Publish', '2014-06-05 01:57:31', '2014-06-05 01:57:31'),
(26, 143, 2, 2, '99898989898', 'Nia Ramadani', 'AJJA', '20140605004408-999676856-blink-182_174.jpg', '', 'gunung sari', '24 Juni 1990', 'WNI', 'Islam', 'Perempuan', 20, 'Menikah', 'Guru/Dosen', NULL, 'Golongan Darah A', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.4000000 s/d Rp.7000000', 2, 2, 4, 'S3', '83113', '9898392898', '12384198198', 'Keluarga', 'k@gmail.com', 'Panitia Osis', '2014', 'jantung', '171', '61', 'S', '43', '54', '33', 'Sniper', 'silat, jumping, jumping', 'spanyol', 'Pengurus Pusat', 'Non Aktif', 'Paskibra', 'SsUMBAWA', '', '', '878723847328347287', NULL, 'DFSFSDF', NULL, NULL, 'Publish', '2014-06-05 02:00:26', '2014-06-05 02:00:26'),
(27, 114, 4, 2, '767767656544454', 'awedsa', 'AJJA', '20140604221118-69512727-Leah-Dizon-Wallpaper-Abyss.jpg', '', 'mataram', '04 Juni 1990', 'WNI', 'Budha', 'Perempuan', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2009', 'jantung', '171', '61', 'S', '43', '54', '33', 'Assist', 'Karate, jumping, jumping', 'inggris', 'Pengurus Pusat', 'PDTH', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'llll', NULL, NULL, 'Publish', '2014-06-05 02:04:56', '2014-06-05 02:04:56'),
(28, 143, 3, 2, '09090909090988', 'Setatra', 'AJJA', '20140604220152-589114130-leah-dizon-swimsuit-1421611113.jpg', '', 'mataram indonesia', '26 Juni 1990', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah A', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.12000000 s/d Rp.16000000', 'Rp.12000000 s/d Rp.16000000', 2, 2, 4, 'S1', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2011', 'jantung', '171', '61', 'S', '43', '54', '33', NULL, 'silat, jumping, jumping', 'inggris', 'Anggota Biasa', 'Aktif', 'Paskibra', 'SASAK', '', '', '9742873823782782', NULL, 'ghghg', NULL, NULL, 'Publish', '2014-06-05 02:08:52', '2014-06-05 02:08:52'),
(29, 143, 1, 2, '2937287827287', 'Uzumaki Naruto', 'ari', '20140605021229-152848315-Naruto_and_Kurama-wallpaper-10107492.jpg', '', 'kecamatan batu laayar nusa tenggara barat', '24 Juni 1989', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Teman', 'k@gmail.com', 'Panitia Osis', '2009', 'jantung', '171', '61', 'S', '43', '54', '33', 'Assist', 'silat, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'gfgdd', NULL, NULL, 'Publish', '2014-06-05 02:12:54', '2014-06-05 02:12:54'),
(30, 141, 4, 2, '837826726676', 'Uciha Madara', 'AJJA', '20140605215941-513215581-ayu.jpg', '', 'Lombok utara', '11 Juni 1990', 'WNI', 'Islam', 'Laki-Laki', 23, 'Janda', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'Ibu Rumah Tangga', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Kakak', 'k@gmail.com', 'Panitia Osis', '2009', 'jantung', '171', '61', 'S', '43', '54', '33', 'Kapten', 'silat, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'gfgd', NULL, NULL, 'Publish', '2014-06-05 02:16:12', '2014-06-06 03:49:11'),
(31, 143, 1, 2, '98989893883', 'Uciha Itachi', 'AJJA', '20140605022119-446947243-Itachi_Sharingan-wallpaper-9734776.jpg', '', 'kuang city hnter', '07 Maret 1991', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.4000000 s/d Rp.7000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Keluarga', 'k@gmail.com', 'Panitia Osis', '2019', 'jantung', '171', '61', 'S', '43', '54', '33', 'Assist', 'makan, jumping, jumping', 'china', 'Anggota Biasa', 'Aktif', 'Paskibra', 'SASAK', '', '', '878723847328347287', NULL, 'gddf', NULL, NULL, 'Publish', '2014-06-05 02:21:50', '2014-06-05 02:21:50'),
(32, 142, 4, 2, '378278278728', 'Hatake Kakashi', 'AJJA', '20140605022538-535625549-Naruto-wallpaper-9713758.jpg', '', 'jepang', '16 April 2015', 'WNI', 'Islam', 'Perempuan', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.4000000 s/d Rp.7000000', 'Rp.4000000 s/d Rp.7000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2014', 'jantung', '171', '61', 'S', '43', '54', '33', 'Intelegen, Sniper', 'mocu, jumping, jumping', 'inggris', 'Pengurus Provinsi', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'dfgdgd', NULL, NULL, 'Publish', '2014-06-05 02:26:21', '2014-06-05 02:26:21'),
(33, 114, 1, 2, '24252422', 'Uciha Obito', 'AJJA', '20140605022911-298852902-Naruto-wallpaper-9450816.jpg', '', 'konoha', '20 Maret 2014', 'WNI', 'Islam', 'Laki-Laki', 20, 'Duda', 'PNS', NULL, 'Golongan Darah B', 'nuari', 'siti hubai', 'TNI/PORLI', 'PNS', 'Rp.12000000 s/d Rp.16000000', 'Rp.4000000 s/d Rp.7000000', 2, 2, 4, 'S1', '83113', '9898392898', '12384198198', 'Kakak', 'k@gmail.com', 'Panitia Osis', '2019', 'jantung', '171', '61', 'XL', '43', '54', '33', 'Intelegen', 'silat, jumping, jumping', 'inggris', 'Pengurus Kota', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'fg', NULL, NULL, 'Publish', '2014-06-05 02:29:46', '2014-06-05 02:29:46'),
(34, 142, 3, 2, '0909049230929', 'Gara Master', 'AJJA', '20140605023319-416156737-Sasuke_Uchiha-wallpaper-9671597.jpg', '', 'kupang', '24 Februari 1998', 'WNA', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', 'Rp.12000000 s/d Rp.16000000', 'Rp.11000000 s/d Rp.13000000', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2011', 'jantung', '171', '61', 'S', '43', '54', '33', 'Assist', 'silat, jumping, jumping', 'china', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'gaghag', NULL, NULL, 'Publish', '2014-06-05 02:33:45', '2014-06-05 02:33:45'),
(35, 112, 1, 2, '3728728782378287878', 'Konoha', 'AJJA', '20140605023629-472132955-Kakashi-wallpaper-8533288.jpg', '', 'mataram', '05 Maret 2014', 'WNI', 'Hindu', 'Perempuan', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'nuari', 'siti hubai', 'PNS', 'PNS', '0', '0', 2, 2, 4, 'SMA', '83113', '9898392898', '12384198198', 'Orang Tua', 'k@gmail.com', 'Panitia Osis', '2019', 'jantung', '171', '61', 'S', '43', '54', '33', 'Assist', 'makan, jumping, jumping', 'spanyol', 'Anggota Biasa', 'Aktif', 'Paskibra', 'Bima', '', '', '878723847328347287', NULL, 'rgdgdbd', NULL, NULL, 'Publish', '2014-06-05 02:36:59', '2014-06-05 02:36:59'),
(36, 112, 3, 2, '293892892898', 'M Fauzan ', 'barker', '20140605022911-298852902-Naruto-wallpaper-9450816.jpg', '', 'mataram nusa tenggara barat', '04 Desember 2013', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'Pelajar/Mahasisawa', NULL, 'Golongan Darah O', 'Awan', 'Rian', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '081809876678', '347287287827', 'Kakak', 'n@yahoo.com', 'Ketua Osis', '2011', 'Jantung', '165', '51', 'S', '39', '42', '33', 'Kapten', 'silat, mengejar matahari, mengejar matahari', 'spanyol', 'Anggota Biasa', 'Aktif', 'Capas', 'Sasak', '', '', '827837287287', NULL, 'sfwfs', NULL, NULL, 'Publish', '2014-06-05 02:43:55', '2014-06-05 02:43:55'),
(37, 143, 3, 2, '3984938493839', 'M Fauzan Gazali', 'barker', '20140605025646-690652204-C360_2014-05-25-20-11-12-873.jpg', '', 'sekarbele bro', '05 Juni 2013', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah AB', 'Awan', 'Rian', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '081809876678', '347287287827', 'Teman', 'n@yahoo.com', 'Ketua Osis', '2009', 'Jantung', '165', '51', 'XXL', '39', '42', '33', 'Assist', 'makan, mengejar matahari', 'china', 'Pengurus Kota', 'Aktif', 'Capas', 'Sasak', '', '', '827837287287', NULL, 'fdgdfg', NULL, NULL, 'Publish', '2014-06-05 02:55:43', '2014-06-05 02:57:21'),
(38, 112, 1, 2, '87878787878000', 'Gambit Al Furkon', 'barker', '20140605023319-416156737-Sasuke_Uchiha-wallpaper-9671597.jpg', '', 'karang pule', '08 Februari 2006', 'WNI', 'Islam', 'Laki-Laki', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah O', 'Awan', 'Rian', 'PNS', 'PNS', 'Rp.17000000 s/d Rp.19000000', 'Rp.1000000 s/d Rp.3000000', 2, 2, 4, 'SMA', '83113', '081809876678', '347287287827', 'Kakak', 'n@yahoo.com', 'Ketua Osis', '2010', 'Jantung', '165', '51', 'S', '39', '42', '33', 'Assist', 'Membunuh, mengejar matahari', 'spanyol', 'Anggota Biasa', 'Aktif', 'Capas', 'Sasak', '', '', '827837287287', NULL, 'hghghg', NULL, NULL, 'Publish', '2014-06-05 03:00:57', '2014-06-05 03:05:38'),
(39, 143, 4, 2, '39849384938398787', 'Awan AL lADIN', 'barker', '20140605004529-351420224-travis-barker-portada-libro.jpg', '', 'LOMBOK BRAT', '29 Februari 2012', 'WNI', 'Islam', 'Perempuan', 20, 'Belum Menikah', 'PNS', NULL, 'Golongan Darah A', 'Awan', 'Rian', 'PNS', 'PNS', 'Rp.1000000 s/d Rp.3000000', 'Rp.11000000 s/d Rp.13000000', 2, 2, 4, 'SMA', '83113', '081809876678', '347287287827', 'Orang Tua', 'n@yahoo.com', 'Ketua Osis', '2009', 'Jantung', '165', '51', 'S', '39', '42', '33', 'Assist', 'Karate, mengejar matahari', 'spanyol', 'Anggota Biasa', 'Aktif', 'Capas', 'Sasak', '', '', '827837287287', NULL, 'HGHGH', NULL, NULL, 'Publish', '2014-06-05 03:04:19', '2014-06-05 03:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `update_et` datetime NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`parent_id`),
  KEY `fk_user_has_user_user2_idx` (`parent_id`),
  KEY `fk_user_has_user_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` varchar(45) NOT NULL DEFAULT 'info',
  `slug` text NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Draft',
  `layout` varchar(45) DEFAULT NULL,
  `image` text,
  `other_content` longtext,
  `comment_status` varchar(15) DEFAULT 'Enable',
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `content`, `type`, `slug`, `status`, `layout`, `image`, `other_content`, `comment_status`, `create_et`, `update_et`) VALUES
(6, 2, 'Antara Aktor Bisu, Saya dan Seniman Coding Yang G pernah mandi', '<p style="text-align: justify;">\r\n	Hembusan angina malam waktu itu (October 2012), Dibalik dinding yang g bertepi, dikerumini landasan dan sejumlah alur cerita yang berbeda. Apa yang kau buat kawan? Apa kau tidak bosan akan semua ini? Antara aktor yang bisu kau terus menulis waktu, hari kau terus menulis seniman yang g tau arah itulah julukan mu kawan.</p><p>\r\n	<img class="img-responsive" src="/resources/images/original/20140530171040-736380622-asdasd.jpg"></p><p style="text-align: justify;">\r\n	Aktor yang terus berjalan tersandat diantara cerita yang kau buat dengan warna hitam sedikit mengelurkan bau, Hai Seniman sainganmu sudah banyak, baumu sudah tak sanggup ku hirup lagi.&nbsp;</p>\r\n<table class="table">\r\n<tbody>\r\n<tr>\r\n	<td>\r\n		Nama\r\n	</td>\r\n	<td>\r\n		Alamat\r\n	</td>\r\n	<td>\r\n		Skolah\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		nuari jasa maulana\r\n	</td>\r\n	<td>\r\n		ampenan\r\n	</td>\r\n	<td>\r\n		stmiki\r\n	</td>\r\n</tr>\r\n</tbody>\r\n</table><p style="text-align: justify;">\r\n	05:23 tgl 9 bulan October 2012 kau mulai tersenyum apakah tulisanmu sudah kelar or ceritamu masih panjang, Seniman menoleh sambil menjawap “belum” dan seniman pun mulai berbalik arah 90 derjat dari aktor yang bisu. Kami pun memulai, 5 mata dan dua bibir yang sedikit diangkat Seniman pun mulai bertanya? Berikut dialog Antara Aktor, Saya dan seniman.</p>\r\n<table class="table">\r\n<tbody>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Apa maumu kawan? setiap hari kau datang, kau selalu bertanya apa kau sudah makan?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Belum kawan, tetapi bisakah kau membuatkan aku secangkir kopi? “\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		iya’ kau tunggu sebentar, “Seniman pun bergegas ke dapur untuk membuatkanku secangkir kopi”\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Aku pun menunggu sambil mengajak sang Aktor bisu bicara dengan isarat “Hai bisu sudah berapa lama kau bersama seniman?”\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Aktor</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Diam’ tampa tanda Tanya (?)\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Sambil menekan dagu, sambil menatap mata sang aktor yang daya hitam g mempunyai bulu mata, kau tampak cantik hari ini?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		15 menit berlalu, Seniman g ada kabar?\r\n	</td>\r\n</tr>\r\n</tbody>\r\n</table><p>\r\n	Aku pun memegang tangan sang Aktor dan membaca apa yang di tulis seniman, akan tetapi Aku tak tau harus mulai dari mana, aku tak tau harus membaca apa! Di tanganku duka di tangan ku suka, mencari dan mencari, menunggu apa yang di tunggu aku merasa di kejar waktu. 45 menit berlalu’ Seniman pun datang.</p><p>\r\n	<img src="/resources/images/original/20140530220459-216301044-katy-perry-67a.jpg" class="img-responsive"></p>\r\n<table class="table">\r\n<tbody>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Sudah kemana kau kawan? Hampir satu jam aku menunggumu dan sekarang mana secangkir kopi yang kau buat?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Waduh saya lupa? “sambil tersenyum” dan berbalik arah untuk membuat kopi.\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Menunggu 5 menit seniman pun kembali ditemani 2 cangkir kopi?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Mau tau saya kemana tadi?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Mana aku tau kawan!\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Tapi kau ada teman kawan. Nih sibisu?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Iya’ kawan sih ada. tapi g bisa ngomong.\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Namanya aja bisu. Tapi kau gak ngapa-ngapain dia kan?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Cuman megang tangan nya doing kok “sambil tersenyum”\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		“tersenyum” sebenarnya tadi aku mandi dulu abis nih badan udah ¾ minggu kagak pernah mand!\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Pantesan aja udah jarak 5 meter aja, udah keluar tuh bau badan? Terus kau mandi kok lama banget?\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Seniman</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Ya iya lah ngerokin daki dulu pakek lulur.\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n		<strong>Saya</strong>\r\n	</td>\r\n	<td>\r\n		:\r\n	</td>\r\n	<td>\r\n		Sialan Seniman pakek lulur? “tertawa terbahak-bahakk”\r\n	</td>\r\n</tr>\r\n</tbody>\r\n</table><p style="text-align: justify;">\r\n	Tak habis pikir aku tak percaya mengapa ada orang seperti ini. Hanya karna cerita semata atau demi kesenangan dan nama. Bagi kita rakyat sipil’ tak berdaya, hanya berdoa yang kita bisa.</p>', 'info', 'antara-aktor-bisu-saya-dan-seniman-coding-yang-g-pernah-mandi', 'Publish', NULL, NULL, '{"category":[{"id":12,"name":"Pengumuman","slug":"pengumuman"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"},{"id":71,"name":"melengo","slug":"melengo"}]}', 'Enable', '2014-05-30 16:26:19', '2014-06-06 00:41:42'),
(7, 2, 'Tiga tahun akhir nya gw selingkuh', '<p style="text-align: justify;">Tiga tahun waktu yang lumayan lama untuk tetap diam dan berdiri sambil tersenyum menatap indahnya dunia yang sangat kecil untuk sang pencipta semesta alam dan isinya. siang, malam terus berganti kenapa kita tidak berfikir sesuai isi hati dan pikiran yang kotor akan kegelapan yang terus melanda hidup ini.</p><p><img src="/resources/images/original/20140601151500-255932468-DSCN5334.JPG" class="img-responsive"></p><p>Seiring waktu yang terus berganti dan terus berganti hingga akal dan pikiran kadang-kadang menjadi satu pemikiran dengan yang lainya. itukah yang namanya hidup? kadang idialis, kadang kita tidak sadar sedang menjilat ludah sendiri, kadang kita tersesat akan semua ini, sampai kapa harus seperti ini.</p><p style="text-align: justify;">Apakah semua ini cuman masalah waktu atau masalah dengan pemikiran sendiri yang terus berusaha dan terus berusaha untuk melindungi diri senderi dengan cara yang salah, ataupun benar sekarang tinggal memilih apa yang ada untuk saat ini. itukah yang namanya perjuangan atau berpikir apa yang akan dihadapi besok, lusa, dua minggu yang akan datang, satu tahun yang akan datang, hingga akhir dari perjuangan ini, sampa mulut ini  tidak lagi memakan makanan yang kita makan saat ini. diam berpikir sejenak dan ucapkan dalam hati'' gw bisa, gw pasti bisa, apa dengan berkata seperti itu kita akan bisa. yang jelas kita tau apa yang harus di lakukan .</p><p style="text-align: justify;">Waktu ini Untuk hidup <strong><em> time for live</em> OR <em>time for money </em></strong>apakah diantara yang kedua ini kita berpikir, berpikir dan memenangkan hari ini dan hari yang akan datang, apa cuman itu akhir dari perjuangan ini.</p>', 'info', 'tiga-tahun-akhir-nya-gw-selingkuh', 'Publish', NULL, NULL, '{"category":[{"id":12,"name":"Pengumuman","slug":"pengumuman"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-05-30 17:32:16', '2014-06-06 00:41:23'),
(8, 2, 'Generate Module dan Controller Pada Zend Framework 2', '<p>Module merupakan sebuah konsep yang diambil dari konsep HMVC yang dimana sebuah model, view dan controller berdiri sendiri (independent). Untuk genarate module anda bisa memanfaatkan module zftool yang sudah tersedia. berikut langkah@@ pembuatan module pada ZF2.</p><p><img src="/resources/images/original/20140530171040-645105076-adaaas.jpg" class="img-responsive"></p><p>Perintah membuat module pada console (CMD,TERMINAL)  dengan nama User.</p><p>php ./vendor/zendframework/zftool/zf.php create module User\r\nDengan perintah maka akan terbentuk struktur directory dan file .php didalam directory module. dan juga pastikan module sudah terdaftar pada file /config/application.config.php</p><p>Struktur Directory User Module</p><p>Tahap selanjutnya membuat sebuah controller dengan nama UserController dengan perintah berikut ini.</p><p>php ./vendor/zendframework/zftool/zf.php create controller User User\r\nDengan perintah diatas maka controller akan terbentuk pada directory User/src/User/Controller/UserController.php dan sebuah file dengan nama index.phtml pada directory User/view/user/user/index.phtml kemudian tahap selanutnya mengatur routing pada file User/config/module.config.php dengan isi sebagai berikut:</p><p>Penulisan pengaturan diatas berbeda dengan penulisan array setandar dari ZF2 akan tetapi maksutnya sama dan jangan coba@@ menulis dengan gaya menulis array seperti diatas pada php V5.4 kebawah (5.3 &lt; 5.4). Setalah melewati langkah-langkah diatas anda bisa mengakses module tersebut dengan alamat URL http://<host-anda style="line-height: 1.6em;">/user</host-anda></p>', 'info', 'generate-module-dan-controller-pada-zend-framework-2', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":71,"name":"melengo","slug":"melengo"}]}', 'Enable', '2014-05-30 23:00:21', '2014-05-31 09:10:06'),
(11, 2, 'Pk PRABOWO SUBIANTO di depan para Kyai besar NU', '<p style="text-align: justify;">Mengawali Juma''at ynag AGUNG ini, berikut saya coba hadirkan apa yang pernah disampaikan Pk PRABOWO SUBIANTO di depan para Kyai besar NU.</p><p><img src="/resources/images/original/20140531031930-983344209-Raline_Shah.jpg" class="img-responsive"></p><p style="text-align: justify;">"Demi Allah, saya tidak haus atau rakus jabatan. Saya hanya tidak tega melihat bangsa ini hancur. Jadi sy minta mandat rakyat, kalau rakyat tidak memberi mandat sy, bagi saya juga tdk masalah," katanya dengan mata berkaca-kaca"</p><p style="text-align: justify;">Dan ingatlah, bahwa Ir. SOEKARNO pernah berkata:</p><p style="text-align: justify;">Ingatlah, ingatlah, ingatlah pesanku ini<br>"Jika engkau memilih pemimpin, pilihlah pemimpin yang ditakuti, dibenci, dicacimaki dan dan disegani ASING, karena itu benar.<br>Pemimipin tersebut akan membelamu diatas kepentingan asing itu, dan janganlah memilih pemimipin yang dipuji-puji asing, karena ia akan memperdayaimu"</p><p style="text-align: justify;">Saya GEMA (Gerakan Muda Indonesia) untuk Pro-Hatta dan begitu juga dengan teman-teman</p>', 'info', 'pk-prabowo-subianto-di-depan-para-kyai-besar-nu', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":71,"name":"melengo","slug":"melengo"}]}', 'Enable', '2014-05-30 23:08:42', '2014-06-04 13:47:58'),
(12, 2, 'linux inem oli kaken tai', '<p>Apakah semua ini cuman masalah waktu atau masalah dengan pemikiran sendiri yang terus berusaha dan terus berusaha untuk melindungi diri senderi dengan cara yang salah, ataupn benar sekarang tinggal memilih apa yang ada untuk saat ini itukah yang namanya waktu atu berpikir apa yang akan di hadapi besok,lusa, dua minggu yang akan datang, satu tahun yang akan datang, hingga akhir dari perjuangan ini sampa mulut ini  tidak lagi memakan makanan yang kita makan saat ini. diam berpikir sejenak dan ucapkan dalam hati gw bisa, gw pasti bisa, apa dengan berkata seperti itu kita akan bisa. yang jelas kita tau apa yang harus di lakukan .</p><p><img src="/resources/images/original/20140530220459-216301044-katy-perry-67a.jpg" class="img-responsive"></p><p>Waktu ini Untuk hidup <strong><em> time for live</em> OR <em>time for money </em></strong>apakah diantara yang kedua ini kita berpikir, berpikir dan memenangkan hari ini dan hari yang akan datang, apa cuman itu akhir dari perjuangan ini.</p>', 'info', 'linux-inem-oli-kaken-tai', 'Publish', NULL, NULL, '{"category":[{"id":12,"name":"Pengumuman","slug":"pengumuman"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-05-30 23:51:08', '2014-06-06 00:41:55'),
(13, 2, 'Istri di Saudi bunuh suami agar bebas selingkuh', '<p style="text-align: justify;">Apakah semua ini cuman masalah waktu atau masalah dengan pemikiran sendiri yang terus berusaha dan terus berusaha untuk melindungi diri senderi dengan cara yang salah, ataupn benar sekarang tinggal memilih apa yang ada untuk saat ini itukah yang namanya waktu atu berpikir apa yang akan di hadapi besok,lusa, dua minggu yang akan datang, satu tahun yang akan datang, hingga akhir dari perjuangan ini sampa mulut ini  tidak lagi memakan makanan yang kita makan saat ini. diam berpikir sejenak dan ucapkan dalam hati gw bisa, gw pasti bisa, apa dengan berkata seperti itu kita akan bisa. yang jelas kita tau apa yang harus di lakukan .</p><p><img src="/resources/images/original/20140531030612-413906439-zahara.jpg" class="img-responsive"></p><p style="text-align: justify;">Waktu ini Untuk hidup <strong><em> time for live</em> OR <em>time for money </em></strong>apakah diantara yang kedua ini kita berpikir, berpikir dan memenangkan hari ini dan hari yang akan datang, apa cuman itu akhir dari perjuangan ini.</p><p style="text-align: justify;">Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.</p><p style="text-align: justify;">Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.</p><p style="text-align: justify;">Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.</p><p style="text-align: justify;">Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.</p>', 'info', 'istri-di-saudi-bunuh-suami-agar-bebas-selingkuh', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-05-31 07:59:04', '2014-05-31 10:26:49'),
(14, 2, 'Situs emirates247.com melaporkan, Selasa (18/2), perempuan', '<p style="text-align: justify;">Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.</p><p><img src="/resources/images/original/20140531030854-282324478-raline-shah.jpg" class="img-responsive"></p><p style="text-align: justify;">Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.</p><p style="text-align: justify;">Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.</p><p style="text-align: justify;">Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.</p>', 'info', 'situs-emirates247-com-melaporkan-selasa-18-2-perempuan', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}]}', 'Enable', '2014-05-31 08:01:22', '2014-05-31 09:07:39'),
(15, 2, 'Tiga tahun waktu yang lumayan lama untuk tetap diam', '<p>Tiga tahun waktu yang lumayan lama untuk tetap diam dan berdiri sambil tersenyum menatap indahnya dunia yang sangat kecil untuk sang pencipta semesta alam dan isinya, siang, malam terus berganti bagaikan  seorang administrator yang ingin mengkonfig ataupun mengcoding sesuai isi hati dan pikiranya.</p><p><img src="/resources/images/original/20140531030840-478484231-Feature-Darling-Ralinshah-2-790x1024.jpg" class="img-responsive"></p><p>Seiring waktu yang terus berganti dan terus berganti hingga akal dan pikiran kadang-kadang menjadi satu pemeikiran dengan yang lainya. itukah yang namanya hidup kadang idialis, kadang kita tidak sadar sedang menjilat ludah sendiri, kadang kita tersesat akan semua ini, dan entah sampai kapa harus seperti ini.&nbsp;pakah semua ini</p>', 'info', 'tiga-tahun-waktu-yang-lumayan-lama-untuk-tetap-diam', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}]}', 'Enable', '2014-05-31 08:05:51', '2014-05-31 09:07:42'),
(16, 2, 'Agar bebas berselingkuh dengan sang kekasih', '<p>Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.</p><p><img src="/resources/images/original/20140531031930-983344209-Raline_Shah.jpg" class="img-responsive"></p><p>Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.</p><p>Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.</p><p>Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.</p>', 'info', 'agar-bebas-berselingkuh-dengan-sang-kekasih', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}]}', 'Enable', '2014-05-31 08:06:36', '2014-05-31 10:15:42'),
(17, 2, 'Perempuan itu bersandiwara dengan melapor ke polisi di Ibu', '<p>Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.</p><p><img src="/resources/images/original/20140531030843-402767357-raline_shah_169.jpg" class="img-responsive"></p><p>Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.</p><p>Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.</p><p>Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.</p>', 'info', 'dia-berpura-pura-minta-diajak-piknik-ke-daerah-gurun', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-05-31 08:07:38', '2014-06-03 08:01:34'),
(18, 2, 'Dia berpura-pura minta diajak piknik ke daerah gurun', '<p>Agar bebas berselingkuh dengan sang kekasih, seorang perempuan Suriah membunuh suaminya asal Arab Saudi. Dia berpura-pura minta diajak piknik ke daerah gurun dan disanalah dia mengeksekusi suaminya.</p><p>Situs emirates247.com melaporkan, Selasa (18/2), perempuan tidak disebutkan namanya itu menembak sang suami dengan pistol koleksinya. Dia merencanakan itu bersama pacarnya.</p><p>Perempuan itu bersandiwara dengan melapor ke polisi di Ibu Kota Riyadh. Dia berbohong dengan mengatakan dirinya dan suami diserang perampok bersenjata berjumlah tiga orang. Mereka menembak mati si suami.</p><p>Namun para ahli forensik curiga dan memeriksa senjata digunakan untuk membunuh. Ternyata diketahui senjata itu milik sang suami. "Setelah perempuan itu diinterogasi lebih lanjut dia dan pacarnya mengaku telah membunuh suaminya," ujar juru bicara kepolisian Brigadir Nassir Al Qahtani.</p><p><img src="/resources/images/original/20140531030612-413906439-zahara.jpg" class="img-responsive"></p><p>Apakah semua ini cuman masalah waktu atau masalah dengan pemikiran sendiri yang terus berusaha dan terus berusaha untuk melindungi diri senderi dengan cara yang salah, ataupn benar sekarang tinggal memilih apa yang ada untuk saat ini itukah yang namanya waktu atu berpikir apa yang akan di hadapi besok,lusa, dua minggu yang akan datang, satu tahun yang akan datang, hingga akhir dari perjuangan ini sampa mulut ini  tidak lagi memakan makanan yang kita makan saat ini. diam berpikir sejenak dan ucapkan dalam hati gw bisa, gw pasti bisa, apa dengan berkata seperti itu kita akan bisa. yang jelas kita tau apa yang harus di lakukan . Erika matahari akan aelalu ada&nbsp;</p><p><img src="/resources/images/original/20140606035751-929602171-adasdasd.jpg" class="img-responsive"></p>', 'info', 'dia-berpura-pura-minta-diajak-piknik-ke-daerah-gurun-2', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":71,"name":"melengo","slug":"melengo"}]}', 'Enable', '2014-05-31 08:09:42', '2014-06-07 19:43:12'),
(19, 2, 'Tentang Kami', '<p style="text-align: justify;"></p>', 'page', 'tentang-kami', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-05-31 11:24:15', '2014-06-02 11:12:48'),
(21, NULL, 'Sejarah', '<p style="text-align: justify;">Gagasan Paskibraka lahir pada tahun 1946, pada saat ibukota Indonesia dipindahkan ke Yogyakarta. Memperingati HUT Proklamasi Kemerdekaan RI yang ke-1, Presiden Soekarno memerintahkan salah satu ajudannya, Mayor (Laut) Husein Mutahar, untuk menyiapkan pengibaran bendera pusaka di halaman Istana Gedung Agung Yogyakarta. Pada saat itulah, di benak Mutahar terlintas suatu gagasan bahwa sebaiknya pengibaran bendera pusaka dilakukan oleh para pemuda dari seluruh penjuru Tanah Air, karena mereka adalah generasi penerus perjuangan bangsa yang bertugas.</p><p style="text-align: justify;">Tetapi, karena gagasan itu tidak mungkin terlaksana, maka Mutahar hanya bisa menghadirkan lima orang pemuda (3 putra dan 2 putri) yang berasal dari berbagai daerah dan kebertulan sedang berada di Yogyakarta. Lima orang tersebut melambangkan Pancasila. Sejak itu, sampai tahun 1949, pengibaran bendera di Yogyakarta tetap dilaksanakan dengan cara yang sama.</p><p style="text-align: justify;">Ketika Ibukota dikembalikan ke Jakarta pada tahun 1950, Mutahar tidak lagi menangani pengibaran bendera pusaka. Pengibaran bendera pusaka pada setiap 17 Agustus di Istana Merdeka dilaksanakan oleh Rumah Tangga Kepresidenan sampai tahun 1966. Selama periode itu, para pengibar bendera diambil dari para pelajar dan mahasiswa yang ada di Jakarta.</p>', 'page', 'sejarah', 'Publish', 'right', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-01 00:47:07', '2014-06-06 13:47:41'),
(22, NULL, 'Visi misi', '<p>VISI</p><p>Memberikan pengetahuan tentang unsur dasar PBB dan memberikan pengarahan kepada setiap anggota Paskibra untuk berdisiplin</p><p>MISI</p><ol>\r\n<li>Membentuk pribadi yang disiplin</li><li>Mempererat tali persaudaraan antar anggota Paskibra</li><li>Membekali pengetahuan tentang PBB kepada setiap anggota Paskibra.</li><li>Membentuk mental yang kuat.</li></ol>', 'page', 'visim-misi', 'Publish', 'right', NULL, '{"imgsliderstatus":"Enable","imgslider":["20140605004408-420571554-blink182.jpg","20140606035757-467425999-sadasd.jpg","20140606035751-340310200-asdasd.jpg"]}', 'Enable', '2014-06-01 00:49:11', '2014-06-06 14:28:57'),
(23, NULL, 'Anggota PPI', '', 'pagehelper', 'site-member-ppi', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 06:45:40', '2014-06-04 06:58:15'),
(24, NULL, 'Anggota Paskibra', '', 'pagehelper', 'site-member-paskibra', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 06:58:02', '2014-06-04 06:58:02'),
(25, NULL, 'Anggota Capas', '', 'pagehelper', 'site-member-capas', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 06:58:36', '2014-06-04 06:58:36'),
(26, NULL, 'Buku Tamu', '', 'pagehelper', 'site-guestbook-index', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 07:02:52', '2014-06-04 07:02:52'),
(27, NULL, 'Kontak', '', 'pagehelper', 'site-contact-index', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 07:03:40', '2014-06-04 07:03:40'),
(28, 2, 'Beranda', '', 'pagehelper', 'site-site-index', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-05-31 11:50:43', '2014-06-04 09:29:46'),
(30, NULL, 'Anggota', '', 'page', 'member', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 16:28:27', '2014-06-04 16:28:37'),
(31, NULL, 'informasi', '<p>Information</p>', 'page', 'information', 'Publish', 'full', NULL, '{"imgsliderstatus":"Disable"}', 'Enable', '2014-06-04 16:30:25', '2014-06-04 16:31:11'),
(32, 2, 'Akhirnya gw nulis lagi ?', '<p style="text-align: justify;">Bnyak yang bertanya? what are you doing body? gw jawab, I again write the contents of my mind. angin genit menghelus jariku yang sedikit kaku karna bingung , mari kita coba apa ini akan terus berkibar sampai kita bisa tunjukan pada dunia bahwa kita mampu.</p><p><img src="/resources/images/original/20140605215942-945144821-sexs.jpg" class="img-responsive"></p><p style="text-align: justify;">Apa kebanyakan orang terus berpikir untuk mengikuti atau sebaliknya, coba kita diam sejenak dan melihat what is happening around us. asap kematian dan bau daging terbakar terus menggelapar dalam ingatan. hatiku rasa bukan takdir tuhan karna aku yakin itu tak mungkin.</p><p style="text-align: justify;">Banyak korban tergelepar demi peringatan manusia. apa ini harus terjadi karna salah kita sendir! and now what we have to do apa iya harus diam dan terus dibodohi, menatap dan terus menghayal akan semua itu.</p><p style="text-align: justify;">Sudah beberapa tahun seiring hari dan musim terus berlalu aku mencari dan mencari sampai lidah ku beku aku merasa dikejar waktu. sudah cukup jauh perjalanan ini lewati duka lewati tawa lewati segala persoalan. kucoba berkaca pada jejak yang ada ternyata aku sudah tertinggal bahkan jauh tertinggal dari mana kamu datang aku tak mendengar langkahmu.</p><p style="text-align: justify;">Tak sanggup ku melihat luka mu kawan tak kuat ku mendengar jeritmu kawan melebihi dentum meriam. mari kita mulai walaupun pikiran kita sama akan kerbau yang ada di sawah negara ini.</p>', 'info', 'akhirnya-gw-nulis-lagi', 'Publish', NULL, NULL, '{"category":[{"id":12,"name":"Pengumuman","slug":"pengumuman"}]}', 'Enable', '2014-06-06 02:18:13', '2014-06-06 02:34:13'),
(33, 2, 'Associations Php ActiveRecord Pada Codeigniter', '<p style="text-align: justify;">Udah beberapa bulan ini kagak pernah nyobak codeigniter ternyata ada librari baru nih untuk menglola database sesuai dengan namanya PhpActiveRecord. PhpActiveRecord memudahkan bagi perogremer codeigniter dalam membuat CRUD bahkan lebih dari itu. Untuk lebih mudah memahami PhpActiveRecord setidaknya anda familiar dengan  <a href="http://en.wikipedia.org/wiki/Object-oriented_programming">Object oriented programming (OOP) </a>+ <a href="http://en.wikipedia.org/wiki/Object-relational_mapping">Object relational mapping (ORM)</a>. oke pada artikel kali ini saya akan mecoba untuk mebahas tentang Associations phpactiverecord dengan kasus tabel seperti gambar di bawah ini:</p><p><img src="/resources/images/original/20140605215942-663642740-fix.jpg" class="img-responsive"></p><p style="text-align: justify;">Untuk menginstall phpactiverecord pada codeigniter silahkan berkunjung ke alamat situs <a href="http://getsparks.org/packages/php-activerecord/versions/HEAD/show">ini</a>. kemudian buat 3 (tiga)  model dengan nama <strong>Post,Catagory,Posthascatagory </strong>kemudian isikan dengan code dibawah ini :</p><p style="text-align: justify;">Untuk di ketahui ketika anda mulai membangun suatu aplikasi mengunakan PhpActiveRecord anda tidak akan terlalu banyak menuliskan code pada bagian model karna phpactiverecord yang akan mengerjakannya seperti update,delete, medapatkan id/key yang akan diubah maupun di update dll silahkan anda baca dokumentasi phpactive record untuk lebih jelasnya bagaimana caramengunakannya.</p><p style="text-align: justify;">Kemudian untuk mecoba ke 3(tiga) model tersebut silahkan membuat Satu controller untuk mecobanya seperti sampel code di bawah iniSekian semoga bermampaat untuk Associations phpactiverecord yang lain akan dibahas pada artikel selanjutnya :</p>', 'info', 'associations-php-activerecord-pada-codeigniter', 'Publish', NULL, NULL, '{"category":[{"id":0,"name":"Informasi","slug":"info"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-06-06 02:47:44', '2014-06-06 03:52:35'),
(34, 9, 'Prabowo Bersama Titiek Ziarah Makam Soeharto di Solo', '<p><img src="/resources/images/original/20140608154827-651111828-254234_prabowo-kunjungi-ponpes-al-qodiri_663_382.jpg" class="img-responsive" alt="" style="float: left; margin: 0px 10px 10px 0px;"></p><p><strong>VIVAnews</strong> - Calon Presiden Prabowo Subianto hari ini berziarah ke makam mantan mertuanya, Soeharto, di Astana Giribangun, Solo, Jawa Tengah, Minggu 8 Juni 2014. Dalam kegiatan ziarah itu Prabowo didampingi Ketua Umum partai Golkar Aburizal Bakrie (ARB) bersama jajaran Pengurus DPP Golkar dan tim kampanye nasional pemenangan Prabowo-Hatta.</p><p>Dalam agendanya, Prabowo dijadwalkan kunjungan ke makam Presiden II RI Soeharto pukul 10.45 WIB. Setelah dari makam mertuanya itu, Prabowo bersama rombongan langsung menyambangi Kraton Solo dan Salat Zuhur di Masjid Agung komplek pasar Klewer. Mantan danjen Kopassus itu akan makan siang dengan menu makanan khas Solo di pasar batik terbesar di pulau Jawa tersebut.</p><p>Dalam kunjungannya di pasar Klewer, capres nomor urut 1 itu juga akan berinteraksi dengan para pedagang.</p><p><strong>Bersama Titiek Soeharto</strong></p><p>Ketua Harian  Koalisi Merah Putih Tim Pemenangan Prabowo - Hatta Kota Solo, Al Amin mengatakan kunjungan Prabowo berziarah ke makam Pak Harto bertepatan dengan peringatan hari kelahiran presiden kedua Republik Indonesia yang jatuh pada tanggal 8 Juni.</p><p>"Informasinya, Pak Prabowo dan Bu Titiek akan bertemu untuk ziarah bersama," kata dia di Solo.</p><p>Selanjutnya, Al Amin mengungkapkan setelah selesai acara ziarah, kemudian capres nomor urut 1 itu direncanakan akan lusukan ke pusat perdagangan batik di Solo, yakni Pasar Klewer. Sebelum itu, Prabowo akan ke Masjid Agung Keraton Surakarta untuk melaksanakan shalat dhuhur.</p><p>"Setelah dari masjid, dia akan menyantap kuliner khas yang ada di depan Pasar Klewer, tengkleng. Kemudian melanjutkan untuk blusukan di Pasar Klewer. Pak Prabowo akan membeli batik dan oleh-oleh khas Solo di pasar itu," ujarnya. (ita)</p>', 'info', 'prabowo-bersama-titiek-ziarah-makam-soeharto-di-solo', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-06-08 15:49:55', '2014-06-08 15:50:55'),
(35, 9, 'Tim Pemenangan Prabowo-Hatta di Kulonprogo Targetkan 60 Persen Suara', '<p><strong><br></strong></p><p><img src="/resources/images/original/20140608155229-433173289-254421_prabowo-di-solo-_663_382.jpg" class="img-responsive"></p><p><strong>VIVAnews </strong>- Tim pemenangan capres Prabowo dan cawapres Hatta Rajasa di Kulonprogo, DI Yogyakarta menargetkan perolehan 60 persen atau 157 ribu suara dari 263 ribu pemilih.</p><p>"Kami akan kerja keras untuk memenangkan suara bagi Prabowo-Hatta," kata Ketua Pelaksana Harian Pemenangan Prabowo-Hatto, Kabupaten Kulonprogo, Sudarminto, Minggu 8 Juni 2014.</p><p>Saat ini tim pemenangan sudah terbentuk di 12 kecamatan dan 88 desa di wilayah Kulonprogi.</p><p>"Kami akan melakukan kampanye, sosialisasi untuk pasangan Prabowo-Hatta kepada masyarakat di Kulonprogo," ujarnya.</p><p>Sebelumnya, Ketua Tim Pemenangan Prabowo-Hatta Di Yogyakarta, Herry Zudianto menegaskan tim akan menjalankan semua mesin partai koaliasi untuk bisa meraih suara 60 persen di DI Yogyakarta.</p><p>"Tekad kami bersama partai koalisi adalah meraih 60 persen suara untuk Prabowo-Hatta. Dan saat ini di kota dan kabupaten di DIY sudah terbentuk tim pemenangan yang akan bekerja," kata Herry yang mantan Wali Kota Yogyakarta itu. (ita)</p>', 'info', 'tim-pemenangan-prabowo-hatta-di-kulonprogo-targetkan-60-persen-suara', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-06-08 15:52:52', '2014-06-08 15:52:52'),
(36, 9, 'Inggris Bisa Jadi Kuda Hitam di Piala Dunia', '<p><img src="/resources/images/original/20140608155538-307573553-254483_skuad-timnas-inggris-saat-melawan-honduras-_663_382.JPG" class="img-responsive"></p><p style="text-align: justify;"><strong style="background-color: initial;">VIVAbola –</strong> Perjalanan timnas Inggris di setiap ajang Piala Dunia memang tak terlalu cemerlang, setelah terakhir kali juara di tahun 1966. Namun, pemain timnas Italia, Ignazio Abate, memprediksi bahwa Inggris akan memberikan kejutan pada Piala Dunia 2014.</p><p style="text-align: justify;">Abate menilai skuad Tiga Singa sudah mengalami banyak perkembangan. Skuad Roy Hodgson yang mayoritas berisikan pemain-pemain muda, dipercaya bisa berpadu sempurna dengan pemain senior.</p><p style="text-align: justify;">"Mereka sudah menciptakan perpaduan yang bagus dan mereka bisa jadi kuda hitam di Piala Dunia ini," ujar Abate, seperti dilansir Football Italia.</p><p style="text-align: justify;">Inggris dan Italia sendiri berada dalam satu grup di Grup D pada babak penyisihan nanti, bersama Uruguay dan Kosta Rika. Inggris dan Italia akan langsung berduel di laga perdana yang berlangsung 15 Juni mendatang.</p><p style="text-align: justify;">Abate menilai laga tersebut akan berjalan cukup sulit bagi kedua tim. Akan tetapi, pemain AC Milan itu menegaskan bahwa skuad Gli Azzurri sudah siap melakoni laga tersebut dengan kondisi fisik dan mental yang terbaik.</p><p style="text-align: justify;">Inggris sendiri baru saja melakoni dua laga uji coba di Miami, Amerika Serikat, dengan melawan Ekuador dan Honduras. Sayang, Wayne Rooney cs harus puas bermain imbang dengan kedua tim tersebut. (ita)</p>', 'info', 'inggris-bisa-jadi-kuda-hitam-di-piala-dunia', 'Publish', NULL, NULL, '{"category":[{"id":12,"name":"Pengumuman","slug":"pengumuman"}],"tag":[{"id":70,"name":"ubuntu","slug":"ubuntu"}]}', 'Enable', '2014-06-08 15:56:25', '2014-06-08 15:57:26'),
(37, 9, 'Gol Messi Lengkapi Kemenangan Argentina di Uji Coba Terakhir', '<p><img src="/resources/images/original/20140608155913-451054430-197707_lionel-messi--kiri--dan-gonzalo-higuain--tengah--rayakan-gol-argentina_663_382.jpg" class="img-responsive"></p><p style="text-align: justify;"><strong>VIVAbola </strong>- Argentina memetik hasil memuaskan pada laga uji coba terakhir sebelum tampil di Piala Dunia 2014. Berhadapan dengan Slovenia, anak-anak asuh Alejandro Sabela menang 2-0.</p><p style="text-align: justify;">Bertanding di Estadio Ciudad de La Plata, Sabtu, 6 Juni 2014, atau Minggu dini hari waktu Indonesia, Argentina yang tampil dominan langsung unggul 1-0 di babak pertama,</p><p style="text-align: justify;">Bahkan mereka sudah berhasil mengoyak jala gawang Slovenia ketika pertandingan baru berjalan 12 menit. Gelandang Inter Milan, Ricky Alvarez mencatatkan namanya di papan skor. Dia melepaskan tendangan kaki kiri yang tak mampu dibendung kiper lawan.</p><p style="text-align: justify;">Tim Tango coba meningkatkan intensitas serangan di babak kedua dengan memasukan Lionel Messi. Benar saja, di menit 76 bintang <a href="http://barcelona.tim.bola.viva.co.id/">Barcelona</a> itu berhasil menggandakan keunggulan timnya.</p><p style="text-align: justify;">Messi bekerja sama dengan Sergio Aguero di dalam kotak penalti lawan dan sepakan tak sanggup dibendung kiper lawan. Skor 2-0 buat Albiceleste itu bertahan sampai wasit meniup peluit panjang.</p><p style="text-align: justify;"><strong>Susunan pemain:</strong><br>Argentina: Romero; Rojo, Basanta, Fernandez, Perez, Mascherano, Rodriguez, Fernandez, Alvarez, Biglia, Lavezzi.</p><p style="text-align: justify;">Slovenia: Oblak; Samardzic, Jokic, Cesar, Brecko, Lazarevic, Kurtic, Stevanovic, Illicic, Novakovic, Kirm.</p>', 'info', 'gol-messi-lengkapi-kemenangan-argentina-di-uji-coba-terakhir', 'Publish', NULL, NULL, '{"category":[{"id":11,"name":"Berita","slug":"berita"}],"tag":[{"id":71,"name":"melengo","slug":"melengo"}]}', 'Enable', '2014-06-08 16:00:09', '2014-06-08 16:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `postrelations`
--

CREATE TABLE IF NOT EXISTS `postrelations` (
  `post_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`parent_id`),
  KEY `fk_post_has_post_post2_idx` (`parent_id`),
  KEY `fk_post_has_post_post1_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(8, NULL, NULL, 'ozan.rock@noizing.com', 'd498b5b27c143c0015baffeb87658a27', NULL, NULL, NULL),
(9, NULL, NULL, 'nuarijasamaulana@noizing.com', '3920707d9d69bd5f4c9e1d57fcaab7f4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_school_taxonomy1_idx` (`taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `taxonomy_id`, `name`, `type`, `address`, `email`, `zip_code`, `phone_number`, `create_et`, `update_et`) VALUES
(1, 112, 'SMA 1 MATARAM', 'Negeri', 'Jln udayana no 25 mataram', 'sma1@gmail.com', '83114', '0818345070', '2014-06-03 03:51:41', '2014-06-03 03:55:02'),
(2, 114, 'SMA 7 MATARAM', 'Negeri', 'jalan adi sucipto mataram', 'a@gmail.com', '83113', '6281', '2014-06-05 00:41:05', '2014-06-05 00:41:05'),
(3, 114, 'SMA 8 MATARAM', 'Negeri', 'JALAN BANDA', '1@GMAIL.COM', '83113', '464', '2014-06-05 00:42:31', '2014-06-05 00:42:31'),
(4, 114, 'SMA 2 MATARAM', 'Negeri', 'JALAN BUKIT BARU', '1@GMAIL.COM', '83113', '464', '2014-06-05 00:51:43', '2014-06-05 00:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext,
  `status` varchar(45) DEFAULT NULL,
  `create_et` datetime DEFAULT NULL,
  `update_et` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taxfilerelations`
--

CREATE TABLE IF NOT EXISTS `taxfilerelations` (
  `tax_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`tax_id`,`file_id`),
  KEY `fk_taxonomy_has_file_file1_idx` (`file_id`),
  KEY `fk_taxonomy_has_file_taxonomy1_idx` (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxfilerelations`
--

INSERT INTO `taxfilerelations` (`tax_id`, `file_id`) VALUES
(64, 1),
(64, 2),
(64, 6),
(69, 8),
(69, 11),
(69, 12),
(69, 13),
(69, 14),
(69, 15),
(69, 16),
(69, 17),
(64, 28),
(64, 29),
(64, 31),
(69, 32),
(69, 33),
(69, 35),
(69, 36),
(80, 39),
(69, 40),
(80, 46),
(80, 47),
(80, 48),
(80, 49),
(80, 50),
(80, 51),
(80, 52),
(80, 53),
(80, 54),
(80, 55),
(80, 56),
(80, 57),
(80, 58),
(80, 59),
(80, 60),
(80, 61),
(80, 62),
(80, 63),
(80, 64),
(80, 65),
(80, 66),
(80, 67);

-- --------------------------------------------------------

--
-- Table structure for table `taxmemberrelations`
--

CREATE TABLE IF NOT EXISTS `taxmemberrelations` (
  `member_id` int(11) NOT NULL,
  `taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`,`taxonomy_id`),
  KEY `fk_member_has_taxonomy_taxonomy1_idx` (`taxonomy_id`),
  KEY `fk_member_has_taxonomy_member1_idx` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxmemberrelations`
--

INSERT INTO `taxmemberrelations` (`member_id`, `taxonomy_id`) VALUES
(1, 116),
(2, 116),
(3, 116),
(4, 116),
(5, 116),
(8, 116),
(10, 116),
(11, 116),
(12, 116),
(13, 116),
(1, 117),
(2, 117),
(3, 117),
(4, 117),
(5, 117),
(8, 117),
(38, 117),
(10, 118),
(1, 119),
(2, 119),
(3, 119),
(4, 119),
(5, 119),
(6, 119),
(7, 119),
(8, 119),
(10, 119),
(11, 119),
(12, 119),
(17, 119),
(21, 119),
(32, 119),
(33, 119),
(18, 132),
(23, 132),
(24, 132),
(31, 132),
(37, 132),
(10, 133),
(11, 133),
(16, 133),
(35, 133),
(11, 134),
(12, 134),
(12, 135),
(32, 135),
(13, 136),
(19, 136),
(23, 136),
(26, 136),
(32, 136),
(13, 137),
(15, 137),
(22, 137),
(24, 137),
(30, 137),
(36, 137),
(20, 138),
(31, 138),
(14, 139),
(16, 139),
(18, 139),
(27, 139),
(29, 139),
(34, 139),
(35, 139),
(37, 139),
(38, 139),
(39, 139),
(13, 140),
(15, 140),
(20, 140),
(21, 140),
(22, 140),
(25, 140),
(26, 140),
(28, 140),
(29, 140),
(30, 140),
(33, 140),
(34, 140),
(36, 140),
(13, 151),
(14, 151),
(19, 151),
(27, 151),
(39, 151),
(21, 152),
(31, 152),
(34, 152),
(37, 152),
(16, 153),
(14, 155),
(18, 155),
(27, 155),
(28, 155),
(32, 155),
(33, 155),
(15, 157),
(19, 157),
(20, 157),
(22, 157),
(23, 157),
(24, 157),
(25, 157),
(26, 157),
(29, 157),
(30, 157),
(35, 157),
(36, 157),
(38, 157),
(39, 157),
(14, 158),
(15, 159),
(16, 160),
(18, 161),
(19, 162),
(20, 164),
(21, 165),
(22, 166),
(23, 167),
(24, 168),
(25, 169),
(26, 170),
(27, 171),
(28, 172),
(29, 173),
(30, 174),
(31, 175),
(32, 176),
(33, 177),
(34, 178),
(35, 179),
(36, 180),
(37, 181),
(38, 182),
(39, 183);

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy`
--

CREATE TABLE IF NOT EXISTS `taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `taxmenu` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'Publish',
  `position` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_term_taxonomy_terminologi1_idx` (`term_id`),
  KEY `fk_term_taxonomy_term_taxonomy1_idx` (`parent_id`),
  KEY `fk_taxonomy_taxonomy1_idx` (`taxmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Dumping data for table `taxonomy`
--

INSERT INTO `taxonomy` (`id`, `parent_id`, `taxmenu`, `term_id`, `name`, `type`, `description`, `count`, `slug`, `status`, `position`, `lft`, `rgt`, `root`, `level`, `create_et`, `update_et`) VALUES
(2, NULL, NULL, 18, 'Menu (Header)', 'menuterm', 'Menu header', NULL, 'menu-utama', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-29 00:00:00', '2014-06-04 16:31:38'),
(11, NULL, NULL, 13, 'Berita', NULL, 'Berita', NULL, 'berita', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-30 02:12:34', '2014-05-30 02:12:34'),
(12, NULL, NULL, 13, 'Pengumuman', NULL, 'Pengumuman', NULL, 'pengumuman', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-30 02:12:45', '2014-05-30 02:12:45'),
(62, 131, 2, 17, 'Berita', 'menuitem', 'Menu item Berita', NULL, 'berita', 'Publish', 6, NULL, NULL, NULL, NULL, '2014-05-30 16:35:42', '2014-05-30 16:35:42'),
(63, 131, 2, 17, 'Pengumuman', 'menuitem', 'Menu item Pengumuman', NULL, 'pengumuman', 'Publish', 5, NULL, NULL, NULL, NULL, '2014-05-30 16:35:42', '2014-05-30 16:35:42'),
(64, NULL, NULL, 16, 'PPI', 'album', 'PPI', NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-30 17:10:24', '2014-05-30 17:10:24'),
(67, NULL, NULL, 13, 'Linux', NULL, 'linux', NULL, 'linux', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-30 23:48:25', '2014-05-30 23:48:25'),
(69, NULL, NULL, 16, 'zahra', NULL, 'zahra', NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-31 02:45:08', '2014-05-31 02:45:08'),
(70, NULL, NULL, 14, 'ubuntu', NULL, 'tag ubuntu untuk postingan', NULL, 'ubuntu', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-31 08:35:34', '2014-05-31 08:37:55'),
(71, NULL, NULL, 14, 'melengo', NULL, 'tag melengo', NULL, 'melengo', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-05-31 08:52:15', '2014-05-31 08:52:15'),
(72, NULL, 2, 17, 'Tentang Kami', 'menupage', 'Menu item Tentang Kami', NULL, 'tentang-kami', 'Publish', 1, NULL, NULL, NULL, NULL, '2014-05-31 13:49:37', '2014-05-31 13:49:37'),
(74, 72, 2, 17, 'Sejarah', 'menupage', 'Menu item Sejarah', NULL, 'sejarah', 'Publish', 3, NULL, NULL, NULL, NULL, '2014-06-01 00:47:24', '2014-06-01 00:47:24'),
(79, 72, 2, 17, 'Visi misi', 'menupage', 'Menu item Visi misi', NULL, 'visim-misi', 'Publish', 2, NULL, NULL, NULL, NULL, '2014-06-01 03:46:51', '2014-06-01 03:46:51'),
(80, NULL, NULL, 16, 'Slider', NULL, 'poto untuk Slider', NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-01 04:07:25', '2014-06-01 04:07:25'),
(111, NULL, NULL, 5, '2011', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, NULL, NULL, 6, 'NTB', NULL, 'Nusa Tenggara Barat', NULL, 'ntb', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 03:32:17', '2014-06-03 03:32:17'),
(113, NULL, NULL, 8, 'Sasak', NULL, 'Suku daerah untuk daerah  lombok', NULL, 'sasak', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 03:33:03', '2014-06-03 03:33:03'),
(114, 112, NULL, 6, 'Mataram', NULL, 'Kota mataram daerah NTB', NULL, 'mataram', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 03:59:15', '2014-06-03 03:59:15'),
(115, NULL, NULL, 2, 'Asia', NULL, 'bahasa Asia', NULL, 'asia', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 04:00:14', '2014-06-03 04:00:14'),
(116, 115, NULL, 2, 'Jepang', NULL, 'Jepang', NULL, 'jepang', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 04:00:34', '2014-06-03 04:00:34'),
(117, NULL, NULL, 1, 'Membunuh', NULL, 'Membunuh', NULL, 'membunuh', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 04:03:18', '2014-06-03 04:03:18'),
(118, 117, NULL, 1, 'Mutilasi', NULL, 'Mutilasi', NULL, 'mutilasi', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 04:03:32', '2014-06-03 04:03:32'),
(119, NULL, NULL, 7, 'Intelegen', NULL, 'mendapatkan penghargaan dari amerika', NULL, 'intelegen', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-03 04:04:07', '2014-06-03 04:04:07'),
(121, 130, 2, 17, 'Anggota PPI', 'menuhelper', 'Menu item Anggota PPI', NULL, '/site/member/ppi', 'Publish', 8, NULL, NULL, NULL, NULL, '2014-06-04 07:00:50', '2014-06-04 07:00:50'),
(122, 130, 2, 17, 'Anggota Paskibra', 'menuhelper', 'Menu item Anggota Paskibra', NULL, '/site/member/paskibra', 'Publish', 9, NULL, NULL, NULL, NULL, '2014-06-04 07:00:50', '2014-06-04 07:00:50'),
(123, 130, 2, 17, 'Anggota Capas', 'menuhelper', 'Menu item Anggota Capas', NULL, '/site/member/capas', 'Publish', 10, NULL, NULL, NULL, NULL, '2014-06-04 07:00:50', '2014-06-04 07:00:50'),
(125, NULL, 2, 17, 'Buku Tamu', 'menuhelper', 'Menu item Buku Tamu', NULL, '/site/guestbook/index', 'Publish', 11, NULL, NULL, NULL, NULL, '2014-06-04 07:06:22', '2014-06-04 07:06:22'),
(126, NULL, 2, 17, 'Kontak', 'menuhelper', 'Menu item Kontak', NULL, '/site/contact/index', 'Publish', 12, NULL, NULL, NULL, NULL, '2014-06-04 07:06:22', '2014-06-04 07:06:22'),
(128, NULL, 2, 17, 'Beranda', 'menuhelper', 'Menu item Beranda', NULL, '/site/site/index', 'Publish', 0, NULL, NULL, NULL, NULL, '2014-06-04 09:30:05', '2014-06-04 09:30:05'),
(130, NULL, 2, 17, 'Anggota', 'menupage', 'Menu item Anggota', NULL, 'member', 'Publish', 7, NULL, NULL, NULL, NULL, '2014-06-04 16:28:52', '2014-06-04 16:28:52'),
(131, NULL, 2, 17, 'informasi', 'menupage', 'Menu item informasi', NULL, 'information', 'Publish', 4, NULL, NULL, NULL, NULL, '2014-06-04 16:31:19', '2014-06-04 16:31:19'),
(132, NULL, NULL, 1, 'makan', NULL, 'Kemampuan makan', NULL, 'makan', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:18:31', '2014-06-05 00:18:31'),
(133, NULL, NULL, 1, 'makan', NULL, 'Kemampuan makan', NULL, 'makan-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:18:35', '2014-06-05 00:18:35'),
(134, NULL, NULL, 1, 'mocu', NULL, 'Kemampuan mocu', NULL, 'mocu', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:29:46', '2014-06-05 00:29:46'),
(135, NULL, NULL, 1, 'mocu', NULL, 'Kemampuan mocu', NULL, 'mocu-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:39:20', '2014-06-05 00:39:20'),
(136, NULL, NULL, 7, 'Sniper', NULL, 'test', NULL, 'sniper', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:43:16', '2014-06-05 00:43:16'),
(137, NULL, NULL, 7, 'Kapten', NULL, 'test', NULL, 'kapten', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:43:49', '2014-06-05 00:43:49'),
(138, NULL, NULL, 7, 'Assist', NULL, 'test', NULL, 'assist', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:45:15', '2014-06-05 00:45:15'),
(139, NULL, NULL, 7, 'Assist', NULL, 'test', NULL, 'assist-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:45:17', '2014-06-05 00:45:17'),
(140, NULL, NULL, 1, 'silat', NULL, 'silat', NULL, 'silat', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:48:05', '2014-06-05 00:48:05'),
(141, NULL, NULL, 6, 'Ampenan', NULL, '', NULL, 'ampenan', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:49:00', '2014-06-05 00:49:00'),
(142, NULL, NULL, 6, 'sekarbele', NULL, '', NULL, 'sekarbele', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:49:20', '2014-06-05 00:49:20'),
(143, NULL, NULL, 6, 'Gunung Sari', NULL, '', NULL, 'gunung-sari', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:49:38', '2014-06-05 00:49:38'),
(144, NULL, NULL, 8, 'bima', NULL, 'ntb', NULL, 'bima', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:50:02', '2014-06-05 16:35:48'),
(145, NULL, NULL, 8, 'sumbawa', NULL, 'suku daerah untuk daerah ntb', NULL, 'sumbawa', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:50:32', '2014-06-05 16:36:02'),
(146, NULL, NULL, 5, '2010', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, NULL, NULL, 5, '2009', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, NULL, NULL, 5, '2014', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, NULL, NULL, 5, '2019', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, NULL, NULL, 5, '2010', NULL, NULL, NULL, NULL, 'Publish', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, NULL, NULL, 1, 'Karate', NULL, 'Kemampuan Karate', NULL, 'karate', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:57:46', '2014-06-05 00:57:46'),
(152, 115, NULL, 2, 'china', NULL, 'ee', NULL, 'china', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:58:44', '2014-06-05 00:58:44'),
(153, 115, NULL, 2, 'melayu', NULL, 'ee', NULL, 'melayu', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:59:02', '2014-06-05 00:59:02'),
(155, 156, NULL, 2, 'inggris', NULL, 'nn', NULL, 'inggris', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 00:59:44', '2014-06-05 01:00:33'),
(156, NULL, NULL, 2, 'eropa', NULL, 'ajij', NULL, 'eropa', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:00:17', '2014-06-05 01:00:17'),
(157, 156, NULL, 2, 'spanyol', NULL, 'dd', NULL, 'spanyol', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:00:54', '2014-06-05 01:00:54'),
(158, NULL, NULL, 1, 'Karate', NULL, 'Kemampuan Karate', NULL, 'karate-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:05:01', '2014-06-05 01:05:01'),
(159, NULL, NULL, 1, 'renang', NULL, 'Kemampuan renang', NULL, 'renang', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:08:53', '2014-06-05 01:08:53'),
(160, NULL, NULL, 1, 'renang', NULL, 'Kemampuan renang', NULL, 'renang-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:13:38', '2014-06-05 01:13:38'),
(161, NULL, NULL, 1, 'berlari', NULL, 'Kemampuan berlari', NULL, 'berlari', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:20:39', '2014-06-05 01:20:39'),
(162, NULL, NULL, 1, 'makan', NULL, 'Kemampuan makan', NULL, 'makan-3', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:24:30', '2014-06-05 01:24:30'),
(163, NULL, NULL, 1, 'makan', NULL, 'Kemampuan makan', NULL, 'makan-4', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:28:12', '2014-06-05 01:28:12'),
(164, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:38:45', '2014-06-05 01:38:45'),
(165, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:44:01', '2014-06-05 01:44:01'),
(166, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-3', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:47:40', '2014-06-05 01:47:40'),
(167, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-4', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:51:14', '2014-06-05 01:51:14'),
(168, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-5', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:54:26', '2014-06-05 01:54:26'),
(169, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-6', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 01:57:33', '2014-06-05 01:57:33'),
(170, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-7', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:00:28', '2014-06-05 02:00:28'),
(171, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-8', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:04:57', '2014-06-05 02:04:57'),
(172, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-9', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:08:55', '2014-06-05 02:08:55'),
(173, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-10', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:12:55', '2014-06-05 02:12:55'),
(174, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-11', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:16:13', '2014-06-05 02:16:13'),
(175, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-12', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:21:51', '2014-06-05 02:21:51'),
(176, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-13', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:26:22', '2014-06-05 02:26:22'),
(177, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-14', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:29:47', '2014-06-05 02:29:47'),
(178, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-15', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:33:46', '2014-06-05 02:33:46'),
(179, NULL, NULL, 1, 'jumping', NULL, 'Kemampuan jumping', NULL, 'jumping-16', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:37:00', '2014-06-05 02:37:00'),
(180, NULL, NULL, 1, 'mengejar matahari', NULL, 'Kemampuan mengejar matahari', NULL, 'mengejar-matahari', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:43:56', '2014-06-05 02:43:56'),
(181, NULL, NULL, 1, 'mengejar matahari', NULL, 'Kemampuan mengejar matahari', NULL, 'mengejar-matahari-2', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 02:55:43', '2014-06-05 02:55:43'),
(182, NULL, NULL, 1, 'mengejar matahari', NULL, 'Kemampuan mengejar matahari', NULL, 'mengejar-matahari-3', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 03:00:58', '2014-06-05 03:00:58'),
(183, NULL, NULL, 1, 'mengejar matahari', NULL, 'Kemampuan mengejar matahari', NULL, 'mengejar-matahari-4', 'Publish', NULL, NULL, NULL, NULL, NULL, '2014-06-05 03:04:21', '2014-06-05 03:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `taxpostrelations`
--

CREATE TABLE IF NOT EXISTS `taxpostrelations` (
  `post_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tax_id`),
  KEY `fk_post_has_term_taxonomy_term_taxonomy1_idx` (`tax_id`),
  KEY `fk_post_has_term_taxonomy_post1_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxpostrelations`
--

INSERT INTO `taxpostrelations` (`post_id`, `tax_id`) VALUES
(6, 11),
(7, 11),
(8, 11),
(11, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(17, 11),
(18, 11),
(34, 11),
(35, 11),
(37, 11),
(6, 12),
(7, 12),
(12, 12),
(32, 12),
(36, 12),
(12, 67),
(6, 70),
(7, 70),
(12, 70),
(13, 70),
(17, 70),
(33, 70),
(34, 70),
(35, 70),
(36, 70),
(6, 71),
(8, 71),
(11, 71),
(18, 71),
(37, 71);

-- --------------------------------------------------------

--
-- Table structure for table `taxuserlogrelations`
--

CREATE TABLE IF NOT EXISTS `taxuserlogrelations` (
  `user_log_id` int(11) NOT NULL,
  `taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`user_log_id`,`taxonomy_id`),
  KEY `fk_user_log_has_taxonomy_taxonomy1_idx` (`taxonomy_id`),
  KEY `fk_user_log_has_taxonomy_user_log1_idx` (`user_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terminologi`
--

CREATE TABLE IF NOT EXISTS `terminologi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `terminologi`
--

INSERT INTO `terminologi` (`id`, `name`, `description`) VALUES
(1, 'Kemampuan Personal Anggota', 'Kemampuan Personal Untuk Anggota PPI'),
(2, 'Kemapuan Bahasa Asing Anggota', 'Kemapuan Bahasa Asing Untuk Anggota PPI'),
(3, 'Pekerjaan Anggota', 'Pekerjaan Untuk Anggota PPI'),
(4, 'Golongan Darah ', 'Golongan Darah Untuk Anggta PPI'),
(5, 'Tahun', 'Tahun Angkatan Angota'),
(6, 'Daerah Anggota', 'Daerah Anggota PPI'),
(7, 'Brevet penghargaan', 'Brevet penghargaan Anggota'),
(8, 'Suku bangsa', 'Suku bangsa untuk Anggota'),
(9, 'Aksi', 'Log Untuk User'),
(10, 'Save', 'Log Untuk User'),
(11, 'Update', 'Log Untuk User'),
(12, 'Delete', 'Log Untuk User'),
(13, 'Kategory', 'Kategory Untuk Artikel'),
(14, 'Tag', 'Tag Untuk Artikel'),
(15, 'Suku', 'Suku Untuk Anggota'),
(16, 'Images', 'Images'),
(17, 'Menu Item', 'Tampilan Menu'),
(18, 'Menu Utama (Header)', 'Tampilan Menu'),
(19, 'Menu Kedua (Footer)', 'Tampilan Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmation_token` varchar(32) DEFAULT NULL,
  `confirmation_sent_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `recovery_token` varchar(32) DEFAULT NULL,
  `recovery_sent_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `registered_from` int(11) DEFAULT NULL,
  `logged_in_from` int(11) DEFAULT NULL,
  `logged_in_at` int(11) DEFAULT NULL,
  `slug` text,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmation_token`, `confirmation_sent_at`, `confirmed_at`, `unconfirmed_email`, `recovery_token`, `recovery_sent_at`, `blocked_at`, `role`, `registered_from`, `logged_in_from`, `logged_in_at`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'ozan.rock@yahoo.co.id', '$2y$12$n1qA7QfcWDUG7.7Rp1P8Qe.46yoX/VoxBx00/lK.eC1JtTScGJWs2', 'HbqqMaEFsmnt2lWAAf9NNtCOqV0NvvIs', NULL, NULL, 1402208051, NULL, NULL, NULL, NULL, 'administrator', 2130706433, 2130706433, 1402235062, NULL, 1402108498, 1402235062),
(2, 'ozan', 'oz4n.rock@gmail.com', '$2y$19$U7o1y62MYqWttCeWV2lveOFBwsz3mnQhrKv6pbamyv6IIBYtXW3re', 'tMIxjc5uUScgQa-u05Kwd4b5ZS6TNwce', NULL, NULL, 1402207118, NULL, NULL, NULL, 1402209160, 'adminppe', 2130706433, 2130706433, 1402207185, NULL, 1401361790, 1402209160),
(3, 'melengo', 'melengo@gmail.com', '$2y$12$TawysBLs3XwInLCQCbhY0ulOgM5JYfStZjzC9csfJWqNKi84OWbqe', 'vqNasjfRvN1ymWtweCoX8xvrfSt7B87Z', NULL, NULL, 1402209148, NULL, NULL, NULL, 1402209164, 'subadminppe', 2130706433, 2130706433, 1402128514, NULL, 1402039731, 1402209164),
(8, 'fauzan', 'ozan.rock@noizing.com', '$2y$19$X97dbMczGs/O7dySEISz6OVac41FmbA7pgtGUdeVoib0LfFPiCTay', 'KEhmdztK-DU5l9mZWWvp_rDtb8L0kg3I', NULL, NULL, 1402164379, NULL, NULL, NULL, 1402209166, 'member', 2130706433, 2130706433, 1402164616, NULL, 1402164357, 1402214059),
(9, 'nuari', 'nuarijasamaulana@noizing.com', '$2y$19$IHlizIeB4uXQ7/TrnBUOo.I44G0W2kJfp9fHhMxJCiJPLo9QBYqey', 'nBvmNZd3nXHOqcRVZ_xqlW5ScCSHljOs', NULL, NULL, 1402210205, NULL, NULL, NULL, NULL, 'subadminppe', 2130706433, 2147483647, 1402235042, NULL, 1402209312, 1402235042);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_ip` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext,
  `absolute_url` text NOT NULL,
  `user_agent` text NOT NULL,
  `action_method` varchar(45) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `contry` varchar(255) NOT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `browser` varchar(255) NOT NULL,
  `browser_version` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `time_zone` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_log_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `user_ip`, `title`, `content`, `absolute_url`, `user_agent`, `action_method`, `platform`, `contry`, `country_code`, `region`, `city`, `zip_code`, `browser`, `browser_version`, `latitude`, `longitude`, `time_zone`, `create_at`, `update_et`) VALUES
(161, 2, '36.75.176.125', 'List data anggota PPI', '{"username":"ozan","action":"member-ppi-list"}', 'http://www.yii2.loc/dashboard/member/ppi/index/member-ppi-list', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:10:13', '2014-06-07 19:10:13'),
(162, 2, '36.75.176.125', 'List data anggota PPI', '{"username":"ozan","action":"member-ppi-list"}', 'http://www.yii2.loc/dashboard/member/ppi/index/member-ppi-list', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:10:39', '2014-06-07 19:10:39'),
(163, 2, '36.75.176.125', 'List data anggota PPI', '{"username":"ozan","action":"member-ppi-list"}', 'http://www.yii2.loc/dashboard/member/ppi/index/member-ppi-list', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:10:49', '2014-06-07 19:10:49'),
(164, 2, '36.75.176.125', 'Form penambahan data anggota PPI', '{"username":"ozan","action":"member-ppi-create"}', 'http://www.yii2.loc/dashboard/member/ppi/create/member-ppi-create', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:10:53', '2014-06-07 19:10:53'),
(165, 2, '36.75.176.125', 'List data anggota PPI', '{"username":"ozan","action":"member-ppi-list"}', 'http://www.yii2.loc/dashboard/member/ppi/index/member-ppi-list', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:12:00', '2014-06-07 19:12:00'),
(166, 2, '36.75.176.125', 'Form penambahan data anggota PPI', '{"username":"ozan","action":"member-ppi-create"}', 'http://www.yii2.loc/dashboard/member/ppi/create/member-ppi-create', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:12:07', '2014-06-07 19:12:07'),
(167, 2, '36.75.176.125', 'List data anggota PPI', '{"username":"ozan","action":"member-ppi-list"}', 'http://www.yii2.loc/dashboard/member/ppi/index/member-ppi-list', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 'GET', 'Linux', 'Indonesia', 'ID', 'Nusa Tenggara Barat', 'Mataram', '-', 'Chrome', '34.0.1847.132', '-8.58333', '116.117', '+08:00', '2014-06-07 19:13:37', '2014-06-07 19:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `content` text NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `create_et` datetime NOT NULL,
  `update_et` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `name`, `content`, `status`, `position`, `type`, `create_et`, `update_et`) VALUES
(1, 'Pencarion', 'PostSerch', 'Publish', 0, 'PostSerch', '2014-06-02 00:00:00', '2014-06-12 00:00:00'),
(2, 'Informasi Terbaru', 'RecentPosts', 'Publish', 1, 'RecentPosts', '2014-06-02 00:00:00', '2014-06-12 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auth_assignment_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_comment1` FOREIGN KEY (`parent_id`) REFERENCES `comment` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `fk_file_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest_book`
--
ALTER TABLE `guest_book`
  ADD CONSTRAINT `fk_guest_book_guest_book1` FOREIGN KEY (`parent_id`) REFERENCES `guest_book` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_guest_book_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_member_school1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_member_taxonomy1` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_member_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_user_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_user_user2` FOREIGN KEY (`parent_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `postrelations`
--
ALTER TABLE `postrelations`
  ADD CONSTRAINT `fk_post_has_post_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_has_post_post2` FOREIGN KEY (`parent_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `fk_school_taxonomy1` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `taxfilerelations`
--
ALTER TABLE `taxfilerelations`
  ADD CONSTRAINT `fk_taxonomy_has_file_file1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_taxonomy_has_file_taxonomy1` FOREIGN KEY (`tax_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxmemberrelations`
--
ALTER TABLE `taxmemberrelations`
  ADD CONSTRAINT `fk_member_has_taxonomy_member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member_has_taxonomy_taxonomy1` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD CONSTRAINT `fk_taxonomy_taxonomy1` FOREIGN KEY (`taxmenu`) REFERENCES `taxonomy` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_term_taxonomy_terminologi1` FOREIGN KEY (`term_id`) REFERENCES `terminologi` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_term_taxonomy_term_taxonomy1` FOREIGN KEY (`parent_id`) REFERENCES `taxonomy` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `taxpostrelations`
--
ALTER TABLE `taxpostrelations`
  ADD CONSTRAINT `fk_post_has_term_taxonomy_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_has_term_taxonomy_term_taxonomy1` FOREIGN KEY (`tax_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxuserlogrelations`
--
ALTER TABLE `taxuserlogrelations`
  ADD CONSTRAINT `fk_user_log_has_taxonomy_taxonomy1` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_log_has_taxonomy_user_log1` FOREIGN KEY (`user_log_id`) REFERENCES `user_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `fk_user_log_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
