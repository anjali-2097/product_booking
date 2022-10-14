-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2020 at 08:46 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `exp_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `password`, `phone_number`, `otp`, `exp_time`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

DROP TABLE IF EXISTS `company_details`;
CREATE TABLE IF NOT EXISTS `company_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `festival_details`
--

DROP TABLE IF EXISTS `festival_details`;
CREATE TABLE IF NOT EXISTS `festival_details` (
  `id` int(11) NOT NULL,
  `festival_name` varchar(255) NOT NULL,
  `last_order_date` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_mob_no` varchar(20) NOT NULL,
  `packing_size` int(11) NOT NULL,
  `total_price` decimal(10,3) NOT NULL,
  `pickup_location_id` int(11) NOT NULL,
  `pick_up_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_name`, `user_mob_no`, `packing_size`, `total_price`, `pickup_location_id`, `pick_up_date`, `status`) VALUES
(1, 'uhhuihj', '9876543210', 0, '1081.340', 3, '2020-03-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sub_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orders_id`, `product_id`, `sub_product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 2, 2, '40.670'),
(2, 1, 2, 5, 2, '500.000');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_location_master`
--

DROP TABLE IF EXISTS `pickup_location_master`;
CREATE TABLE IF NOT EXISTS `pickup_location_master` (
  `id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_address` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

DROP TABLE IF EXISTS `product_master`;
CREATE TABLE IF NOT EXISTS `product_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `unit_price` decimal(10,3) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`id`, `product_name`, `product_image`, `unit`, `unit_price`, `stock_quantity`, `status`) VALUES
(1, 'Fruits', 'Fruits', 'Kg', '200.000', 25, 1),
(2, 'Colors', 'Colors', 'rgb', '100.000', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory_master`
--

DROP TABLE IF EXISTS `product_subcategory_master`;
CREATE TABLE IF NOT EXISTS `product_subcategory_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_cat_id` int(11) NOT NULL,
  `subcat_name` varchar(255) NOT NULL,
  `subcat_img` varchar(255) NOT NULL,
  `subcat_unit` varchar(20) NOT NULL,
  `subcat_unit_price` decimal(10,2) NOT NULL,
  `subcat_stock_quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_subcategory_master`
--

INSERT INTO `product_subcategory_master` (`id`, `pdt_cat_id`, `subcat_name`, `subcat_img`, `subcat_unit`, `subcat_unit_price`, `subcat_stock_quantity`, `status`) VALUES
(1, 1, 'Apple', 'Apple', 'Kg', '80.00', 25, 1),
(2, 1, 'Banana', 'Banana', 'Kg', '40.67', 20, 1),
(3, 2, 'Crayon', 'Crayon', 'rgb', '200.50', 25, 1),
(5, 2, 'Water Color', 'Water Color', 'rgb', '500.00', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_details`
--

DROP TABLE IF EXISTS `sms_details`;
CREATE TABLE IF NOT EXISTS `sms_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_status` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
