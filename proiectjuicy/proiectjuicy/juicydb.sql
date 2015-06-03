-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 May 2015 la 15:36
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `juicydb`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Salvarea datelor din tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Acidulate'),
(2, 'Neacidulate'),
(3, 'Bio');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `product_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `procent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresa` varchar(70) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `pc_id`, `data`, `adresa`, `complete`) VALUES
(1, 1, 1, '2015-05-29 20:26:10', 'acasa', 1),
(2, 1, 2, '2015-05-29 21:46:47', 'acasa2', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `pref_id` int(11) NOT NULL,
  `prodpref_id` int(11) NOT NULL,
  `cantitatepref` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Salvarea datelor din tabel `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `desc`) VALUES
(2, 'Coca-Cola ', 'idnaisndjiasndjnasjdnsaijndsja'),
(3, 'Pepsi', 'dasndhjasgduyahsdjbasdkbasd'),
(4, 'Fanta Struguri', 'jfasonasojndaskld'),
(5, 'Coca-Cola Zero', 'hayufbsjnoanfaoklsda'),
(6, 'Prigat Portocale', ''),
(7, 'Aloe Vera', ''),
(8, 'Cappy Portocale', ''),
(10, 'Mirinda2', ''),
(12, 'Fanta2', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 3),
(7, 3),
(8, 2),
(10, 1),
(12, 1),
(12, 1),
(12, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `product_info`
--

CREATE TABLE IF NOT EXISTS `product_info` (
  `piid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `w_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`piid`),
  KEY `piid` (`piid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Salvarea datelor din tabel `product_info`
--

INSERT INTO `product_info` (`piid`, `prod_id`, `price`, `w_id`, `data`) VALUES
(11, 1, 5, 2, '2015-05-23 19:12:32'),
(3, 3, 4, 3, '2015-05-23 19:13:32'),
(4, 4, 8, 5, '2015-05-23 19:13:32'),
(5, 5, 34, 3, '2015-05-23 19:13:32'),
(6, 6, 23, 1, '2015-05-23 19:13:32'),
(24, 2, 4, 1, '2015-05-29 19:34:31'),
(9, 2, 4, 4, '2015-05-23 19:13:32'),
(10, 1, 65, 3, '2015-05-23 19:13:32'),
(15, 10, 5, 1, '2015-05-29 18:40:49'),
(16, 10, 7, 3, '2015-05-29 18:40:49'),
(17, 10, 6, 4, '2015-05-29 18:40:49'),
(19, 12, 7, 4, '2015-05-29 18:41:18'),
(21, 12, 7, 4, '2015-05-29 18:52:50'),
(23, 12, 7, 4, '2015-05-29 19:00:30');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `produse_comandate`
--

CREATE TABLE IF NOT EXISTS `produse_comandate` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `piid` int(11) NOT NULL,
  `oid` int(10) unsigned NOT NULL,
  `cantitate` int(11) NOT NULL,
  PRIMARY KEY (`pc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `produse_comandate`
--

INSERT INTO `produse_comandate` (`pc_id`, `piid`, `oid`, `cantitate`) VALUES
(1, 24, 1, 5),
(2, 23, 1, 3),
(3, 23, 2, 48);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `stoc`
--

CREATE TABLE IF NOT EXISTS `stoc` (
  `product_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `security` int(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `gui` int(20) NOT NULL,
  `adress` varchar(150) NOT NULL,
  `phone` int(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `name` (`name`,`email`,`gui`,`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `security`, `email`, `gui`, `adress`, `phone`) VALUES
(1, 'valexandra94', 'bamboocha', 0, 'valexandra94@yahoo.com', 0, '', 0),
(2, 'sdasdkjsabkb', '1234', 0, 'bsadsandak@dsabdjhas.com', 0, '', 0),
(3, '1234', '1234', 0, '1234@1234.com', 0, '', 0);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `weight`
--

CREATE TABLE IF NOT EXISTS `weight` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `cantitate` float NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Salvarea datelor din tabel `weight`
--

INSERT INTO `weight` (`w_id`, `cantitate`) VALUES
(1, 0.5),
(2, 1),
(3, 1.5),
(4, 2),
(5, 2.5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
