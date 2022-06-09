-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 11:48 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `module` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `nama_menu`, `parent_id`, `module`) VALUES
(8, 'Admin Menu', 20, 'menu'),
(9, 'Admin User', 20, 'useradmin'),
(12, 'Module About Us', 0, 'aboutus'),
(13, 'Module Join Us', 0, 'joinus'),
(14, 'Module Slideshow', 0, 'crud_slideshow'),
(16, 'Module Product Category', 0, 'crud_kategoriproduk'),
(18, 'Module Question Answer', 0, 'questionanswer'),
(19, 'Website Config', 0, 'datasingle'),
(20, 'Admin Config', 0, '#');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_privilege`
--

CREATE TABLE `tbl_menu_privilege` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu_privilege`
--

INSERT INTO `tbl_menu_privilege` (`id`, `id_menu`, `id_user`) VALUES
(20, 8, 14),
(21, 9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_admin`
--

CREATE TABLE `tbl_user_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_admin`
--

INSERT INTO `tbl_user_admin` (`id`, `username`, `password`) VALUES
(1, 'usertest', 'usertest'),
(14, 'Coba', 'Coba');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aboutus`
--

CREATE TABLE `tb_aboutus` (
  `Id_AboutUs` int(11) NOT NULL,
  `Gambar_AboutUs` text,
  `Text_AboutUs` longtext,
  `is_Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_aboutus`
--

INSERT INTO `tb_aboutus` (`Id_AboutUs`, `Gambar_AboutUs`, `Text_AboutUs`, `is_Active`) VALUES
(4, 'ABOUTUS20181020135422.jpg', '<h3>Donec et mi eu massa ultrices scelerisque.</h3>\r\n                <p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis.</p>\r\n                <ul class=\"styled-list arrow\">\r\n                  <li><strong>Donec et mi eu massa ultrices scelerisque. </strong></li>\r\n                  <li><strong> Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </strong></li>\r\n                  <li><strong>Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </strong></li>\r\n                  <li><strong>Fusce tincidunt, justo congue egestas</strong></li>\r\n                </ul>\r\n                <p>Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. <br></p><br>', 1),
(5, 'ABOUTUS20181020135422.jpg', '<h3>Donec et mi eu massa ultrices scelerisque.</h3>\r\n                <p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis.</p>\r\n                <ul class=\"styled-list arrow\">\r\n                  <li><strong>Donec et mi eu massa ultrices scelerisque. </strong></li>\r\n                  <li><strong> Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </strong></li>\r\n                  <li><strong>Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </strong></li>\r\n                  <li><strong>Fusce tincidunt, justo congue egestas</strong></li>\r\n                </ul>\r\n                <p>Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. <br></p><br>', 1),
(6, 'ABOUTUS20181020135422.jpg', '<h3>Donec et mi eu massa ultrices scelerisque.</h3>\n<p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis.</p>\n<ul class=\"styled-list arrow\">\n<li><strong>Donec et mi eu massa ultrices scelerisque. </strong></li>\n<li><strong> Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </strong></li>\n<li><strong>Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </strong></li>\n<li><strong>Fusce tincidunt, justo congue egestas</strong></li>\n</ul>\n<p>Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>\n<p> </p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cartdetail`
--

CREATE TABLE `tb_cartdetail` (
  `Id_CartDetail` int(11) NOT NULL,
  `Id_CartHeader` int(11) DEFAULT NULL,
  `Id_Produk` int(11) DEFAULT NULL,
  `Jumlah_CartDetail` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cartdetail`
--

INSERT INTO `tb_cartdetail` (`Id_CartDetail`, `Id_CartHeader`, `Id_Produk`, `Jumlah_CartDetail`) VALUES
(34, 15, 45, '1'),
(88, 15, 42, '19'),
(123, 61, 44, '1'),
(124, 61, 43, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cartheader`
--

CREATE TABLE `tb_cartheader` (
  `Id_CartHeader` int(11) NOT NULL,
  `Id_User` int(11) DEFAULT NULL,
  `Tanggal_CartHeader` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cartheader`
--

INSERT INTO `tb_cartheader` (`Id_CartHeader`, `Id_User`, `Tanggal_CartHeader`) VALUES
(15, 52, '2018-11-01 04:07:03'),
(61, 59, '2018-11-09 14:55:48'),
(67, 62, '2018-11-10 14:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customerservice`
--

CREATE TABLE `tb_customerservice` (
  `Id_CustomerService` int(11) NOT NULL,
  `Topic_CustomerService` text,
  `Desc_CustomerService` longtext,
  `Name_CustomerService` varchar(100) DEFAULT NULL,
  `Email_CustomerService` varchar(1000) DEFAULT NULL,
  `Is_Answered` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_datasingle`
--

CREATE TABLE `tb_datasingle` (
  `Id_dataSingle` int(11) NOT NULL,
  `PathLogo_dataSingle` text,
  `PathLogoSmall_dataSingle` text,
  `PathLogoFooter_dataSingle` text,
  `Phone_dataSingle` text,
  `Address_dataSingle` text,
  `Email_dataSingle` text,
  `facebook_dataSingle` text,
  `twitter_dataSingle` text,
  `googleplus_dataSingle` text,
  `linkedin_dataSingle` text,
  `youtube_dataSingle` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_datasingle`
--

INSERT INTO `tb_datasingle` (`Id_dataSingle`, `PathLogo_dataSingle`, `PathLogoSmall_dataSingle`, `PathLogoFooter_dataSingle`, `Phone_dataSingle`, `Address_dataSingle`, `Email_dataSingle`, `facebook_dataSingle`, `twitter_dataSingle`, `googleplus_dataSingle`, `linkedin_dataSingle`, `youtube_dataSingle`) VALUES
(1, 'logo.png', 'logo-small.png', 'footer-logo.png', '08812216790', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 'foodsupply@lapergue.com', 'Facebook Test', 'Twitter Test', 'Google Plus Test', 'Linkedin Test', 'Youtube Test');

-- --------------------------------------------------------

--
-- Table structure for table `tb_joinus`
--

CREATE TABLE `tb_joinus` (
  `Id_JoinUs` int(11) NOT NULL,
  `Gambar_JoinUs` text,
  `Text_JoinUs` longtext,
  `Is_Active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_joinus`
--

INSERT INTO `tb_joinus` (`Id_JoinUs`, `Gambar_JoinUs`, `Text_JoinUs`, `Is_Active`) VALUES
(2, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 1),
(3, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 0),
(4, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 1),
(5, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 0),
(6, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 0),
(7, 'JOINUS20181021101735.JPG', '<p>Lorem Ipsum dolor sit amet</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoriprodukadmin`
--

CREATE TABLE `tb_kategoriprodukadmin` (
  `Id_KategoriProdukAdmin` int(11) NOT NULL,
  `Text_KategoriProduk` longtext,
  `Is_Active` tinyint(1) DEFAULT NULL,
  `LastEdit_KategoriProduk` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Pathgambar_KategoriProduk` varchar(1000) DEFAULT NULL,
  `Is_feature` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategoriprodukadmin`
--

INSERT INTO `tb_kategoriprodukadmin` (`Id_KategoriProdukAdmin`, `Text_KategoriProduk`, `Is_Active`, `LastEdit_KategoriProduk`, `Pathgambar_KategoriProduk`, `Is_feature`) VALUES
(6, 'Pizza', 1, '2018-10-28 09:59:48', 'KATEGORIPRODUKADMIN20181024023738.jpg', 1),
(7, 'Burger', 1, '2018-10-28 09:59:49', 'KATEGORIPRODUKADMIN20181024160452.jpg', 1),
(8, 'Chips', 1, '2018-10-28 09:59:51', 'KATEGORIPRODUKADMIN20181024160452.jpg', 1),
(9, 'Steak', 1, NULL, 'KATEGORIPRODUKADMIN20181027082324.jpg', NULL),
(10, 'Pasta', 1, '2018-10-30 00:12:17', 'KATEGORIPRODUKADMIN20181028110623.jpeg', 1),
(11, 'Dessert', 1, '2018-10-30 00:12:33', 'KATEGORIPRODUKADMIN20181028111253.jpg', 1),
(12, 'Coba', 0, '2018-10-30 00:39:26', 'KATEGORIPRODUKADMIN20181030003750.jpg', 1),
(13, 'Coba Lagi', 0, NULL, 'KATEGORIPRODUKADMIN20181030003900.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoriprodukpenjual`
--

CREATE TABLE `tb_kategoriprodukpenjual` (
  `Id_KategoriProdukPenjual` int(11) NOT NULL,
  `Text_KategoriProduk` varchar(100) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT NULL,
  `LastEdit_KategoriProduk` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Pathgambar_KategoriProduk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategoriprodukpenjual`
--

INSERT INTO `tb_kategoriprodukpenjual` (`Id_KategoriProdukPenjual`, `Text_KategoriProduk`, `Is_Active`, `LastEdit_KategoriProduk`, `Pathgambar_KategoriProduk`) VALUES
(1, 'Kategori 1', 1, '0000-00-00 00:00:00', 'Kategori 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif_detail`
--

CREATE TABLE `tb_notif_detail` (
  `Id_Notif_Header` int(11) NOT NULL,
  `Id_Notif_Detail` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL,
  `Id_Toko` int(11) NOT NULL,
  `Status_History` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_notif_detail`
--

INSERT INTO `tb_notif_detail` (`Id_Notif_Header`, `Id_Notif_Detail`, `Id_User`, `Id_Toko`, `Status_History`) VALUES
(14, 3, 48, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif_header`
--

CREATE TABLE `tb_notif_header` (
  `Id_Notif_Header` int(11) NOT NULL,
  `Status_Notif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_notif_header`
--

INSERT INTO `tb_notif_header` (`Id_Notif_Header`, `Status_Notif`) VALUES
(14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `Id_Produk` int(11) NOT NULL,
  `Judul_Produk` text,
  `Desc_Produk` longtext,
  `DescLong_Produk` longtext,
  `Stok_Produk` int(11) DEFAULT NULL,
  `Harga_Produk` decimal(10,0) DEFAULT NULL,
  `Is_Feature` tinyint(1) DEFAULT NULL,
  `Is_Discount` tinyint(1) DEFAULT NULL,
  `Discountfrom_Produk` date DEFAULT NULL,
  `Discountuntil_Produk` date DEFAULT NULL,
  `Dilihatcounter_Produk` int(11) DEFAULT NULL,
  `Tanggallastedit_Produk` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `DiscountPercent_Produk` int(11) DEFAULT NULL,
  `AvailStart_Produk` datetime DEFAULT NULL,
  `AvailEnd_Produk` datetime DEFAULT NULL,
  `Id_User` int(11) DEFAULT NULL,
  `Id_KategoriProdukAdmin` int(11) DEFAULT NULL,
  `Id_KategoriProdukPenjual` int(11) DEFAULT NULL,
  `Id_Toko` int(11) DEFAULT NULL,
  `AvgRating_Produk` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`Id_Produk`, `Judul_Produk`, `Desc_Produk`, `DescLong_Produk`, `Stok_Produk`, `Harga_Produk`, `Is_Feature`, `Is_Discount`, `Discountfrom_Produk`, `Discountuntil_Produk`, `Dilihatcounter_Produk`, `Tanggallastedit_Produk`, `DiscountPercent_Produk`, `AvailStart_Produk`, `AvailEnd_Produk`, `Id_User`, `Id_KategoriProdukAdmin`, `Id_KategoriProdukPenjual`, `Id_Toko`, `AvgRating_Produk`) VALUES
(31, 'Irvin chips', 'The best chips in singapore', NULL, 2, '8', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 15:24:12', 0, '2018-10-23 01:01:00', '2018-10-26 01:01:00', 48, 8, 1, 5, NULL),
(32, 'Pork burger', 'The best spicy pork burger', NULL, 10, '7', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-10 09:11:19', 0, '2018-10-26 01:01:00', '2018-10-31 01:01:00', 53, 7, 1, 6, 3.33333),
(33, 'Steak', 'Spicy steak.', NULL, -3, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-08 16:24:44', 0, '2018-10-26 01:01:00', '2018-10-27 01:01:00', 53, 9, 1, 6, 4),
(34, 'Pork Steak', 'Tasty pork steak', NULL, 0, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 15:21:13', 0, '2018-10-29 01:01:00', '2018-10-31 01:01:00', 53, 9, 1, 6, NULL),
(36, 'Cake', 'yummy cake', NULL, 39, '5', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-05 16:20:06', 0, '2018-10-28 01:01:00', '2018-10-29 01:01:00', 53, 11, 1, 6, NULL),
(37, 'Puddding', 'best dessert', NULL, 26, '8', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-10 11:48:29', 0, '2018-10-21 01:01:00', '2019-01-29 01:01:00', 53, 11, 1, 6, NULL),
(38, 'Waffle', 'best dessert', NULL, 10, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-07 13:08:28', 0, '2018-10-24 01:01:00', '2018-10-31 01:01:00', 53, 11, 1, 6, NULL),
(39, 'Fettucini', 'best pasta', NULL, 34, '7', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 14:13:53', 0, '2018-10-21 01:01:00', '2018-10-30 01:01:00', 53, 10, 1, 6, NULL),
(40, 'Spaghetti', 'best pasta', NULL, 20, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 14:13:53', 0, '2018-10-22 01:01:00', '2018-10-31 01:01:00', 53, 10, 1, 6, NULL),
(41, 'Irvin chips spicy', 'test', NULL, 5, '8', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 14:40:58', 0, '2018-10-23 01:01:00', '2018-10-31 01:01:00', 57, 8, 1, 8, NULL),
(42, 'Steak', 'test', NULL, 197, '9', 0, 0, '2018-10-09', '2018-10-12', 0, '2018-11-10 08:17:55', 20, '2018-10-26 01:01:00', '2018-10-27 01:01:00', 52, 7, 1, 7, NULL),
(43, 'Pizza yum yum', 'test', NULL, 23, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-10 09:12:09', 0, '2018-10-01 01:01:00', '2018-10-31 01:01:00', 58, 6, 1, 9, 5),
(44, 'burger yumyum', 'test', NULL, 28, '7', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 07:52:30', 0, '2018-10-01 01:01:00', '2018-11-01 01:01:00', 59, 7, 1, 10, NULL),
(45, 'Irvin chips', 'test', NULL, 27, '9', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-07 11:44:05', 0, '2018-10-02 01:01:00', '2018-10-31 01:01:00', 59, 8, 1, 10, NULL),
(46, 'Melt Cake Update', 'Melt Cake Short Desc Update.', '<p>Melt Cake Long Desc Update.</p>\n<p>Melt Cake Long Desc Update.</p>\n<p>Melt Cake Long Desc Update.</p>\n<p>Melt Cake Long Desc Update.</p>', 93, '15', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-09 14:00:24', 10, '2018-07-26 01:01:00', '2018-10-27 01:01:00', 52, 11, 1, 7, NULL),
(47, 'Carbonara', 'Delicious home made Carbonara 100% with fresh Italian ', '<h3 id=\"ingredients\">INGREDIENTS:</h3>\n<div class=\"ingredients\">\n<ul>\n<li class=\"ingredient\">8 ounces spaghetti</li>\n<li class=\"ingredient\">2 large eggs</li>\n<li class=\"ingredient\">1/2 cup freshly grated Parmesan</li>\n<li class=\"ingredient\">4 slices bacon, diced</li>\n<li class=\"ingredient\">4 cloves garlic, minced</li>\n<li class=\"ingredient\">Kosher salt and freshly ground black pepper, to taste</li>\n<li class=\"ingredient\">2 tablespoons chopped fresh parsley leaves</li>\n</ul>\n</div>', 28, '25', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-10 09:13:40', 0, '2018-11-11 01:01:00', '2018-12-01 01:01:00', 51, 10, 1, 11, 5),
(52, 'Homecooked Chicken Nugget With Rice', 'Homecooked chicken nuggets with rice', '<p>Homecooked meal are the best, they always will have a spot at your tastebuds and heart.</p>\n<p> </p>\n<p>We decide to sell our homecooked meal.</p>\n<p>Chicken nuggets are our go-to emergency food when theres no other food at home</p>\n<p>We hope our homecooked meal will remind you of home.</p>\n<p> </p>\n<p>Enjoy your meal, and have a nice day.</p>', 2147483646, '1', 0, 0, '0000-00-00', '0000-00-00', 0, '2018-11-11 04:53:42', 0, '2018-11-11 01:01:00', '2050-12-11 01:01:00', 63, 8, 1, 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produkgambar`
--

CREATE TABLE `tb_produkgambar` (
  `Id_ProdukGambar` int(11) NOT NULL,
  `pathgambar_ProdukGambar` varchar(1000) DEFAULT NULL,
  `Id_Produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produkgambar`
--

INSERT INTO `tb_produkgambar` (`Id_ProdukGambar`, `pathgambar_ProdukGambar`, `Id_Produk`) VALUES
(18, 'PRODUK_0_20181027044941.jpg', 31),
(19, 'PRODUK_1_20181027044941.jpg', 31),
(20, 'PRODUK_0_20181027081909.jpg', 32),
(21, 'PRODUK_0_20181027082403.jpg', 33),
(22, 'PRODUK_0_20181027082455.jpg', 34),
(24, 'PRODUK_0_20181028111647.jpg', 36),
(25, 'PRODUK_0_20181028111728.jpg', 37),
(26, 'PRODUK_0_20181028111809.jpg', 38),
(27, 'PRODUK_0_20181028111954.jpeg', 39),
(28, 'PRODUK_0_20181028112047.jpg', 40),
(29, 'PRODUK_0_20181030143206.jpg', 41),
(30, 'PRODUK_0_20181030145959.jpg', 42),
(31, 'PRODUK_0_20181030145959.jpg', 42),
(32, 'PRODUK_0_20181030145959.jpg', 43),
(33, 'PRODUK_0_20181030150816.jpg', 44),
(34, 'PRODUK_0_20181030150855.jpg', 45),
(35, 'PRODUK_0_20181030154733.jpg', 46),
(36, 'PRODUK_1_20181030154733.jpg', 46),
(37, 'PRODUK_0_20181110084422.JPG', 47),
(40, 'PRODUK_0_20181111044839.jpg', 52);

-- --------------------------------------------------------

--
-- Table structure for table `tb_questionanswer`
--

CREATE TABLE `tb_questionanswer` (
  `Id_QuestionAnswer` int(11) NOT NULL,
  `Question_QuestionAnswer` text,
  `Answer_QuestionAnswer` text,
  `is_Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_questionanswer`
--

INSERT INTO `tb_questionanswer` (`Id_QuestionAnswer`, `Question_QuestionAnswer`, `Answer_QuestionAnswer`, `is_Active`) VALUES
(5, 'Test Ask for question ?', '<p>Test Answer the question.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_slideshow`
--

CREATE TABLE `tb_slideshow` (
  `Id_Slideshow` int(11) NOT NULL,
  `Judul_Slideshow` text,
  `Text_Slideshow` longtext,
  `Link_Slideshow` varchar(1000) DEFAULT NULL,
  `gambar_Slideshow` varchar(1000) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_slideshow`
--

INSERT INTO `tb_slideshow` (`Id_Slideshow`, `Judul_Slideshow`, `Text_Slideshow`, `Link_Slideshow`, `gambar_Slideshow`, `Is_Active`) VALUES
(4, 'Pizza', '<p>best food</p>', '', 'SLIDESHOW20181024023824.jpg', 1),
(5, 'Burger', '<p>best burger</p>', '', 'SLIDESHOW20181024024031.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_toko`
--

CREATE TABLE `tb_toko` (
  `Id_Toko` int(11) NOT NULL,
  `Nama_Toko` varchar(1000) DEFAULT NULL,
  `Alamat_Toko` longtext,
  `Notelpon_Toko` varchar(50) DEFAULT NULL,
  `Gambar_Toko` varchar(100) DEFAULT NULL,
  `Gambar_Header` varchar(100) NOT NULL,
  `Waktubuka_Toko` longtext,
  `Is_Active` tinyint(1) DEFAULT NULL,
  `Id_User` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`Id_Toko`, `Nama_Toko`, `Alamat_Toko`, `Notelpon_Toko`, `Gambar_Toko`, `Gambar_Header`, `Waktubuka_Toko`, `Is_Active`, `Id_User`) VALUES
(5, 'Katsu Store', 'asdasd', '83898199792', 'PHOTO_20181024022423.jpg', 'HEADER_20181024022423.jpg', '08:00 20:00', 1, 48),
(6, 'my store', 'adressssssss', '83898199792', 'PHOTO_20181027081732.jpg', 'HEADER_20181027081732.jpg', '08:00 20:00', 1, 53),
(7, 'Ikhsan Store', 'Ikhsan Store', '08812216790', 'PHOTO_20181030142912.jpg', 'HEADER_20181030142912.jpg', '08:00 - 12:00', 1, 52),
(8, 'taksu kitchen', 'taksu address', '083898199792', 'PHOTO_20181030143055.jpg', 'HEADER_20181030143055.jpg', '08:00 20:00', 1, 57),
(9, 'pizza store', 'pizza place', '83898199792', 'PHOTO_20181030145825.jpeg', 'HEADER_20181030145825.jpg', '08:00 20:00', 1, 58),
(10, 'bayar ini itu store', 'bugis street', '83898199792', 'PHOTO_20181030150723.jpg', 'HEADER_20181030150723.jpg', '08:00 20:00', 1, 59),
(11, 'Cat and Food!', 'Washington DC', '0111111', '../../image/image_store/PHOTO_20181110082710.jpg', 'HEADER_20181110082936.jpg', '08:00 - 12:00', 1, 51),
(12, 'katsu food', 'katsu 1', '0881293819', 'PHOTO_20181110145854.', 'HEADER_20181110145854.', '09-09', 1, 62),
(13, 'Toko Makanan', 'Terra', '08123456789', 'PHOTO_20181111045928.jpg', 'HEADER_20181111045928.jpg', '10.00-9.00', 1, 63);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `Id_User` int(11) NOT NULL,
  `Username_user` varchar(1000) DEFAULT NULL,
  `Password_user` varchar(1000) DEFAULT NULL,
  `Email_user` varchar(1000) DEFAULT NULL,
  `Alamat_user` varchar(1000) DEFAULT NULL,
  `phone_user` varchar(20) DEFAULT NULL,
  `Fullname_user` varchar(1000) DEFAULT NULL,
  `Is_Seller` tinyint(1) DEFAULT NULL,
  `Is_Buyer` tinyint(1) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT NULL,
  `Is_verify` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Id_User`, `Username_user`, `Password_user`, `Email_user`, `Alamat_user`, `phone_user`, `Fullname_user`, `Is_Seller`, `Is_Buyer`, `Is_Active`, `Is_verify`) VALUES
(48, 'dimas', 'dimas', 'dimas_216@yahoo.com', 'Jalan Rawasari Barat X No 17 B', '83898199792', 'Dimas Priyasmito Nugroho', 1, 1, 1, 1),
(51, 'Taksu', 'katsu', 'taksuwijaya07@gmail.com', 'Ciputat, Tangerang, Komplek Astyapuri 2 no.A09, Jl. Kertamukti\nDekat kampus UIN 2', '081880', 'Taksu WIJAYA', 0, NULL, 1, 1),
(52, 'ikhsan', 'ikhsan', 'ikhsanbahar@gmail.com', 'Komplek Depkes Kemayoran Bendungan Jago.', '+628812216790', 'Ikhsan Bahar', 0, 1, 1, 1),
(53, 'dominicsavio', 'dominicsavio', 'dimas.umn@gmail.com', 'Jalan Rawasari Barat X No 17 B', '83898199792', 'Dimas Priyasmito Nugroho', 0, NULL, 1, 1),
(56, 'Katsu', 'taksu', 'taksuwijayacora@yahoo.com', 'Tangerang', '081880', 'Taksu Wijaya', 0, 1, 1, 1),
(57, 'bossbuku', 'bossbuku', 'bossbuku@yahoo.com', 'Jl. Puri mutiara 1 No 247', '83898199792', 'boss buku', 0, 1, 1, 1),
(58, 'oceanimagine', 'oceanimagine', 'contactus@oceanimagine.com', 'Jalan Rawasari Barat X No 17 B', '83898199792', 'Dimas Priyasmito Nugroho', 0, 1, 1, 1),
(59, 'bayariniitu', 'bayariniitu', 'contactus@bayariniitu.com', 'Jalan Rawasari Barat X No 17 B', '83898199792', 'Dimas Priyasmito Nugroho', 0, 1, 1, 1),
(61, 'taksu01', 'taksu', 'ign.taksu@student.umn.ac.id', 'Ciputat, Tangerang, Komplek Astyapuri 2 no.A09, Jl. Kertamukti\nDekat kampus UIN 2', '081880', 'Taksu WIJAYA', 0, 1, 1, 1),
(62, 'jackfrost24', 'Gatx105r', 'randystvn@gmail.com', 'Griya cinere 2 jln azalea raya blok 44 no 7', '81282329937', 'Randy Steven Zein', 0, 1, 1, 1),
(63, 'agi.andaru', 'agiandaru036', 'agiandaru@gmail.com', 'Pamulang', '082112611147', 'agi andaru', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_checkoutdetail`
--

CREATE TABLE `tr_checkoutdetail` (
  `Id_CheckOutDetail` int(11) NOT NULL,
  `Id_CheckOutHeader` int(11) DEFAULT NULL,
  `Id_Produk` int(11) DEFAULT NULL,
  `jumlah_CheckOutDetail` int(11) DEFAULT NULL,
  `Harga_CheckOutDetail` decimal(10,0) DEFAULT NULL,
  `Status_Notif` int(11) NOT NULL DEFAULT '0',
  `Status_History` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_checkoutdetail`
--

INSERT INTO `tr_checkoutdetail` (`Id_CheckOutDetail`, `Id_CheckOutHeader`, `Id_Produk`, `jumlah_CheckOutDetail`, `Harga_CheckOutDetail`, `Status_Notif`, `Status_History`) VALUES
(53, 66, 32, 1, '7', 0, 0),
(54, 67, 34, 1, '9', 0, 0),
(55, 68, 33, 2, '18', 0, 0),
(56, 69, 33, 3, '27', 1, 0),
(57, 69, 34, 3, '27', 1, 0),
(58, 69, 31, 3, '24', 1, 4),
(59, 70, 32, 1, '7', 1, 0),
(60, 71, 32, 1, '7', 1, 0),
(61, 71, 43, 1, '9', 1, 0),
(62, 72, 32, 1, '7', 1, 0),
(63, 77, 46, 3, '45', 1, 0),
(64, 77, 33, 3, '27', 1, 0),
(65, 79, 46, 2, '30', 1, 0),
(66, 85, 41, 1, '8', 1, 0),
(67, 89, 32, 2, '14', 0, 0),
(68, 90, 32, 1, '7', 0, 0),
(69, 91, 31, 1, '8', 1, 2),
(70, 92, 32, 1, '7', 1, 0),
(71, 94, 41, 1, '8', 1, 0),
(72, 95, 41, 1, '8', 1, 0),
(73, 96, 46, 1, '15', 1, 0),
(74, 96, 43, 1, '9', 1, 0),
(75, 97, 39, 2, '14', 1, 0),
(76, 97, 40, 7, '63', 1, 0),
(77, 99, 42, 1, '9', 1, 0),
(78, 100, 43, 1, '9', 1, 0),
(79, 101, 47, 1, '25', 1, 4),
(80, 102, 32, 1, '7', 0, 0),
(81, 103, 43, 1, '9', 0, 0),
(82, 104, 37, 3, '24', 1, 0),
(83, 110, 52, 1, '1', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tr_checkoutheader`
--

CREATE TABLE `tr_checkoutheader` (
  `Id_CheckOutHeader` int(11) NOT NULL,
  `Tanggal_CheckOutHeader` timestamp NULL DEFAULT NULL,
  `Id_user` int(11) DEFAULT NULL,
  `Status_CheckOutHeader` varchar(100) DEFAULT NULL,
  `MetodePayment_CheckOutHeader` varchar(100) DEFAULT NULL,
  `Total_Harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_checkoutheader`
--

INSERT INTO `tr_checkoutheader` (`Id_CheckOutHeader`, `Tanggal_CheckOutHeader`, `Id_user`, `Status_CheckOutHeader`, `MetodePayment_CheckOutHeader`, `Total_Harga`) VALUES
(60, '2018-11-07 11:57:01', 48, 'Order received', 'By Transfer', 16),
(61, '2018-11-07 12:01:36', 48, 'Order received', 'By Transfer', 16),
(62, '2018-11-07 12:39:41', 51, 'Order received', 'By Cash', 7),
(63, '2018-11-07 12:56:30', 51, 'Order received', 'By Cash', 14),
(64, '2018-11-07 12:59:29', 51, 'Order received', 'By Cash', 45),
(65, '2018-11-07 13:00:57', 51, 'Order received', 'By Cash', 7),
(66, '2018-11-07 13:03:46', 51, 'Order received', 'By Cash', 41),
(67, '2018-11-07 13:08:42', 51, 'Order received', 'By Cash', 26),
(68, '2018-11-07 13:13:57', 51, 'Order received', 'By Cash', 77),
(69, '2018-11-07 13:19:40', 51, 'Order received', 'By Cash', 78),
(70, '2018-11-07 14:09:35', 51, 'Order received', 'By Cash', 7),
(71, '2018-11-08 10:51:12', 48, 'Order received', 'By Transfer', 16),
(72, '2018-11-08 10:56:21', 48, 'Order received', 'By Transfer', 7),
(73, '2018-11-08 10:59:20', 48, 'Order received', 'By Transfer', 7),
(74, '2018-11-08 11:05:16', 48, 'Order received', 'By Transfer', 7),
(75, '2018-11-08 11:07:11', 48, 'Order received', 'By Transfer', 7),
(76, '2018-11-08 16:13:54', NULL, 'Order received', 'By Transfer', 0),
(77, '2018-11-08 16:24:44', 59, 'Order received', 'By Cash', 72),
(78, '2018-11-08 16:24:45', 59, 'Order received', NULL, 0),
(79, '2018-11-09 13:06:22', 59, 'Order received', 'By Cash', 30),
(80, '2018-11-09 13:06:23', 59, 'Order received', NULL, 0),
(81, '2018-11-09 13:08:08', 59, 'Order received', NULL, 0),
(82, '2018-11-09 13:08:15', 59, 'Order received', 'By Cash', 30),
(83, '2018-11-09 13:08:18', 59, 'Order received', NULL, 0),
(84, '2018-11-09 13:08:49', 59, 'Order received', NULL, 0),
(85, '2018-11-09 13:25:34', 59, 'Order received', 'By Cash', 8),
(86, '2018-11-09 13:25:34', 59, 'Order received', NULL, 0),
(87, '2018-11-09 13:26:03', 59, 'Order received', 'By Cash', 8),
(88, '2018-11-09 13:26:06', 59, 'Order received', NULL, 0),
(89, '2018-11-09 13:27:04', 51, 'Order received', 'By Cash', 14),
(90, '2018-11-09 13:43:06', 51, 'Order received', 'By Credit Card', 7),
(91, '2018-11-09 13:44:01', 51, 'Order received', 'By Cash', 8),
(92, '2018-11-09 13:46:18', 51, 'Order received', 'By Cash', 7),
(93, '2018-11-09 13:47:04', 51, 'Order received', 'By Cash', 8),
(94, '2018-11-09 13:47:34', 51, 'Order received', 'By Cash', 8),
(95, '2018-11-09 13:54:21', 51, 'Order received', 'By Cash', 8),
(96, '2018-11-09 14:00:24', 51, 'Order received', 'By Cash', 24),
(97, '2018-11-09 14:13:53', 59, 'Order received', 'By Cash', 77),
(98, '2018-11-09 14:13:56', 59, 'Order received', NULL, 0),
(99, '2018-11-10 08:17:55', 51, 'Order received', 'By Cash', 9),
(100, '2018-11-10 08:20:26', 51, 'Order received', 'By Cash', 9),
(101, '2018-11-10 08:50:32', 61, 'Order received', 'By Cash', 25),
(102, '2018-11-10 09:11:19', 61, 'Order received', 'By Cash', 7),
(103, '2018-11-10 09:12:09', 61, 'Order received', 'By Cash', 9),
(104, '2018-11-10 11:48:29', 48, 'Order received', 'By Transfer', 24),
(105, '2018-11-10 11:48:44', 48, 'Order received', 'By Transfer', 24),
(106, '2018-11-10 11:49:41', 48, 'Order received', 'By Transfer', 24),
(107, '2018-11-10 11:55:36', 48, 'Order received', 'By Transfer', 24),
(108, '2018-11-10 11:56:26', 48, 'Order received', 'By Transfer', 24),
(109, '2018-11-10 11:56:57', 48, 'Order received', 'By Transfer', 24),
(110, '2018-11-11 04:53:42', 51, 'Order received', 'By Cash', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_ratingproduk`
--

CREATE TABLE `tr_ratingproduk` (
  `Id_RatingProduk` int(11) NOT NULL,
  `Rating_RatingProduk` float DEFAULT NULL,
  `Id_User` int(11) DEFAULT NULL,
  `Id_Produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_ratingproduk`
--

INSERT INTO `tr_ratingproduk` (`Id_RatingProduk`, `Rating_RatingProduk`, `Id_User`, `Id_Produk`) VALUES
(2, 3, 51, 32),
(3, 5, 51, 32),
(4, 3, 51, 33),
(5, 4, 51, 33),
(6, 2, 51, 32),
(7, 5, 51, 43),
(8, 5, 61, 47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu_privilege`
--
ALTER TABLE `tbl_menu_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_aboutus`
--
ALTER TABLE `tb_aboutus`
  ADD PRIMARY KEY (`Id_AboutUs`);

--
-- Indexes for table `tb_cartdetail`
--
ALTER TABLE `tb_cartdetail`
  ADD PRIMARY KEY (`Id_CartDetail`),
  ADD KEY `Id_CartHeader` (`Id_CartHeader`);

--
-- Indexes for table `tb_cartheader`
--
ALTER TABLE `tb_cartheader`
  ADD PRIMARY KEY (`Id_CartHeader`),
  ADD KEY `Id_User` (`Id_User`);

--
-- Indexes for table `tb_customerservice`
--
ALTER TABLE `tb_customerservice`
  ADD PRIMARY KEY (`Id_CustomerService`);

--
-- Indexes for table `tb_datasingle`
--
ALTER TABLE `tb_datasingle`
  ADD KEY `Id_dataSingle` (`Id_dataSingle`);

--
-- Indexes for table `tb_joinus`
--
ALTER TABLE `tb_joinus`
  ADD PRIMARY KEY (`Id_JoinUs`);

--
-- Indexes for table `tb_kategoriprodukadmin`
--
ALTER TABLE `tb_kategoriprodukadmin`
  ADD PRIMARY KEY (`Id_KategoriProdukAdmin`);

--
-- Indexes for table `tb_kategoriprodukpenjual`
--
ALTER TABLE `tb_kategoriprodukpenjual`
  ADD PRIMARY KEY (`Id_KategoriProdukPenjual`);

--
-- Indexes for table `tb_notif_detail`
--
ALTER TABLE `tb_notif_detail`
  ADD PRIMARY KEY (`Id_Notif_Header`,`Id_Notif_Detail`),
  ADD KEY `Id_Notif_Detail` (`Id_Notif_Detail`),
  ADD KEY `Id_User` (`Id_User`),
  ADD KEY `Id_Toko` (`Id_Toko`);

--
-- Indexes for table `tb_notif_header`
--
ALTER TABLE `tb_notif_header`
  ADD PRIMARY KEY (`Id_Notif_Header`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`Id_Produk`),
  ADD KEY `Id_User` (`Id_User`),
  ADD KEY `Id_KategoriProduk` (`Id_KategoriProdukAdmin`),
  ADD KEY `Id_Toko` (`Id_Toko`),
  ADD KEY `Id_KategoriProdukPenjual` (`Id_KategoriProdukPenjual`);

--
-- Indexes for table `tb_produkgambar`
--
ALTER TABLE `tb_produkgambar`
  ADD PRIMARY KEY (`Id_ProdukGambar`),
  ADD KEY `Id_Produk` (`Id_Produk`);

--
-- Indexes for table `tb_questionanswer`
--
ALTER TABLE `tb_questionanswer`
  ADD PRIMARY KEY (`Id_QuestionAnswer`);

--
-- Indexes for table `tb_slideshow`
--
ALTER TABLE `tb_slideshow`
  ADD PRIMARY KEY (`Id_Slideshow`);

--
-- Indexes for table `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`Id_Toko`),
  ADD KEY `Id_User` (`Id_User`) USING BTREE;

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id_User`);

--
-- Indexes for table `tr_checkoutdetail`
--
ALTER TABLE `tr_checkoutdetail`
  ADD PRIMARY KEY (`Id_CheckOutDetail`),
  ADD KEY `Id_CheckOutHeader` (`Id_CheckOutHeader`);

--
-- Indexes for table `tr_checkoutheader`
--
ALTER TABLE `tr_checkoutheader`
  ADD PRIMARY KEY (`Id_CheckOutHeader`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Indexes for table `tr_ratingproduk`
--
ALTER TABLE `tr_ratingproduk`
  ADD PRIMARY KEY (`Id_RatingProduk`),
  ADD KEY `Id_User` (`Id_User`),
  ADD KEY `Id_Produk` (`Id_Produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_menu_privilege`
--
ALTER TABLE `tbl_menu_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_aboutus`
--
ALTER TABLE `tb_aboutus`
  MODIFY `Id_AboutUs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_cartdetail`
--
ALTER TABLE `tb_cartdetail`
  MODIFY `Id_CartDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tb_cartheader`
--
ALTER TABLE `tb_cartheader`
  MODIFY `Id_CartHeader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_customerservice`
--
ALTER TABLE `tb_customerservice`
  MODIFY `Id_CustomerService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_datasingle`
--
ALTER TABLE `tb_datasingle`
  MODIFY `Id_dataSingle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_joinus`
--
ALTER TABLE `tb_joinus`
  MODIFY `Id_JoinUs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kategoriprodukadmin`
--
ALTER TABLE `tb_kategoriprodukadmin`
  MODIFY `Id_KategoriProdukAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_kategoriprodukpenjual`
--
ALTER TABLE `tb_kategoriprodukpenjual`
  MODIFY `Id_KategoriProdukPenjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_notif_detail`
--
ALTER TABLE `tb_notif_detail`
  MODIFY `Id_Notif_Detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_notif_header`
--
ALTER TABLE `tb_notif_header`
  MODIFY `Id_Notif_Header` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `Id_Produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_produkgambar`
--
ALTER TABLE `tb_produkgambar`
  MODIFY `Id_ProdukGambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_questionanswer`
--
ALTER TABLE `tb_questionanswer`
  MODIFY `Id_QuestionAnswer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_slideshow`
--
ALTER TABLE `tb_slideshow`
  MODIFY `Id_Slideshow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `Id_Toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tr_checkoutdetail`
--
ALTER TABLE `tr_checkoutdetail`
  MODIFY `Id_CheckOutDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tr_checkoutheader`
--
ALTER TABLE `tr_checkoutheader`
  MODIFY `Id_CheckOutHeader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tr_ratingproduk`
--
ALTER TABLE `tr_ratingproduk`
  MODIFY `Id_RatingProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cartdetail`
--
ALTER TABLE `tb_cartdetail`
  ADD CONSTRAINT `tb_CartDetail_ibfk_1` FOREIGN KEY (`Id_CartHeader`) REFERENCES `tb_cartheader` (`Id_CartHeader`);

--
-- Constraints for table `tb_cartheader`
--
ALTER TABLE `tb_cartheader`
  ADD CONSTRAINT `tb_CartHeader_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `tb_user` (`Id_User`);

--
-- Constraints for table `tb_notif_detail`
--
ALTER TABLE `tb_notif_detail`
  ADD CONSTRAINT `tb_notif_detail_ibfk_1` FOREIGN KEY (`Id_Notif_Header`) REFERENCES `tb_notif_header` (`Id_Notif_Header`),
  ADD CONSTRAINT `tb_notif_detail_ibfk_2` FOREIGN KEY (`Id_User`) REFERENCES `tb_user` (`Id_User`),
  ADD CONSTRAINT `tb_notif_detail_ibfk_3` FOREIGN KEY (`Id_Toko`) REFERENCES `tb_toko` (`Id_Toko`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_Produk_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `tb_user` (`Id_User`),
  ADD CONSTRAINT `tb_Produk_ibfk_2` FOREIGN KEY (`Id_KategoriProdukAdmin`) REFERENCES `tb_kategoriprodukadmin` (`Id_KategoriProdukAdmin`),
  ADD CONSTRAINT `tb_Produk_ibfk_3` FOREIGN KEY (`Id_Toko`) REFERENCES `tb_toko` (`Id_Toko`),
  ADD CONSTRAINT `tb_Produk_ibfk_4` FOREIGN KEY (`Id_KategoriProdukPenjual`) REFERENCES `tb_kategoriprodukpenjual` (`Id_KategoriProdukPenjual`);

--
-- Constraints for table `tb_produkgambar`
--
ALTER TABLE `tb_produkgambar`
  ADD CONSTRAINT `tb_ProdukGambar_ibfk_1` FOREIGN KEY (`Id_Produk`) REFERENCES `tb_produk` (`Id_Produk`);

--
-- Constraints for table `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD CONSTRAINT `tb_Toko_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `tb_user` (`Id_User`);

--
-- Constraints for table `tr_checkoutdetail`
--
ALTER TABLE `tr_checkoutdetail`
  ADD CONSTRAINT `tr_CheckOutDetail_ibfk_1` FOREIGN KEY (`Id_CheckOutHeader`) REFERENCES `tr_checkoutheader` (`Id_CheckOutHeader`);

--
-- Constraints for table `tr_checkoutheader`
--
ALTER TABLE `tr_checkoutheader`
  ADD CONSTRAINT `tr_CheckOutHeader_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `tb_user` (`Id_User`);

--
-- Constraints for table `tr_ratingproduk`
--
ALTER TABLE `tr_ratingproduk`
  ADD CONSTRAINT `tr_RatingProduk_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `tb_user` (`Id_User`),
  ADD CONSTRAINT `tr_RatingProduk_ibfk_2` FOREIGN KEY (`Id_Produk`) REFERENCES `tb_produk` (`Id_Produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
