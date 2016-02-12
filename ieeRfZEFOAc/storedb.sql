-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2013 at 05:23 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `storedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_desc` mediumtext NOT NULL,
  `category_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`, `category_status`) VALUES
(1, 'Bodyboards', 'All bodyboards are included in this section.', 0),
(2, 'Swim Fins', 'All swim fins are included in this section.', 1),
(3, 'Clothing', 'Find fresh clothing, shirts, shorts, tees, wear, gear from all brands.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_seo` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_seo`, `product_price`, `product_category_id`, `product_status`) VALUES
(2, 'Ally Fins', 'ally-swim-fins', 39.99, 2, 1),
(3, 'Custom X X1', 'custom-x-x1-bodyboard', 189.99, 1, 1),
(4, 'Turbo IV', 'turbo-iv-bodyboard', 199.99, 1, 1),
(5, 'Churchill''s', 'churchill-fins', 59.99, 2, 1),
(6, 'Deluxe Fins', 'deluxe-fins', 59.99, 2, 1),
(7, 'Toobs', 'toobs-bodyboard', 240.99, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_first_login` datetime NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip_address` varchar(20) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_password`, `user_first_login`, `user_last_login`, `user_ip_address`, `user_email`, `user_status`) VALUES
(2, 'Admin', 'admin', 'admin', '2013-09-05 02:49:18', '2013-09-05 00:49:44', '127.0.0.1', 'cuenta@proveedor.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
