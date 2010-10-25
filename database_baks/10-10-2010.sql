-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2010 at 05:58 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dancerialto`
--
CREATE DATABASE `dancerialto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dancerialto`;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `ts_created` datetime NOT NULL,
  `ev_created` datetime NOT NULL,
  `ev_ended` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `blog_posts_url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blog_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_category`
--

CREATE TABLE IF NOT EXISTS `blog_posts_category` (
  `post_id` bigint(20) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_images`
--

CREATE TABLE IF NOT EXISTS `blog_posts_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_id` (`image_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blog_posts_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_orders`
--

CREATE TABLE IF NOT EXISTS `blog_posts_orders` (
  `post_id` int(10) NOT NULL,
  `tier` varchar(100) NOT NULL,
  `rank` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts_orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_profile`
--

CREATE TABLE IF NOT EXISTS `blog_posts_profile` (
  `post_id` bigint(20) unsigned NOT NULL,
  `profile_key` varchar(255) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`post_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_tags`
--

CREATE TABLE IF NOT EXISTS `blog_posts_tags` (
  `post_id` bigint(20) unsigned NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `custom_attribute`
--

CREATE TABLE IF NOT EXISTS `custom_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_of_set` varchar(30) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `custom_attribute`
--

INSERT INTO `custom_attribute` (`id`, `name_of_set`, `uploader_id`, `ts_created`) VALUES
(1, 'side_stripe', 1, '2010-08-19 02:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `custom_attribute_details`
--

CREATE TABLE IF NOT EXISTS `custom_attribute_details` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) NOT NULL,
  `details_name` varchar(50) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) NOT NULL,
  `price_offset` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `custom_attribute_details`
--

INSERT INTO `custom_attribute_details` (`id`, `set_id`, `details_name`, `image_name`, `filename`, `username`, `ranking`, `price_offset`) VALUES
(1, 1, 'No side stripe', '', NULL, 'proballroomshoes', 1, 0),
(2, 1, 'Side stripe', '', NULL, 'proballroomshoes', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fabric_set`
--

CREATE TABLE IF NOT EXISTS `fabric_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_of_set` varchar(30) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_of_set` (`name_of_set`,`uploader_id`),
  KEY `name_of_set_2` (`name_of_set`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fabric_set`
--

INSERT INTO `fabric_set` (`id`, `name_of_set`, `uploader_id`, `ts_created`) VALUES
(1, 'pants_fabric', 1, '2010-08-19 02:33:34'),
(2, 'Aaron_shoe_fabric', 1, '2010-08-27 17:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `fabric_set_details`
--

CREATE TABLE IF NOT EXISTS `fabric_set_details` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) NOT NULL,
  `details_name` varchar(50) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) NOT NULL,
  `price_offset` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fabric_set_details`
--

INSERT INTO `fabric_set_details` (`id`, `set_id`, `details_name`, `image_name`, `filename`, `username`, `ranking`, `price_offset`) VALUES
(1, 1, 'black', '', NULL, 'proballroomshoes', 1, 0),
(2, 1, 'yellow', '', NULL, 'proballroomshoes', 2, 0),
(3, 1, 'blue', '', NULL, 'proballroomshoes', 3, 0),
(4, 2, 'Leopard', '', NULL, 'proballroomshoes', 1, 5),
(5, 2, 'Tiger fabric', '', NULL, 'proballroomshoes', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `image_attribute`
--

CREATE TABLE IF NOT EXISTS `image_attribute` (
  `image_attribute_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(30) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `product_type_table` varchar(30) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) NOT NULL,
  `price_adjustment` double NOT NULL,
  PRIMARY KEY (`image_attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `image_attribute`
--


-- --------------------------------------------------------

--
-- Table structure for table `inventory_images`
--

CREATE TABLE IF NOT EXISTS `inventory_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Product_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `post_id` (`Product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inventory_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `inventory_products`
--

CREATE TABLE IF NOT EXISTS `inventory_products` (
  `inventory_products_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_type_table` varchar(30) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `inventory_name` varchar(100) NOT NULL,
  `User_id` bigint(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `filename` varchar(300) DEFAULT NULL,
  `video` varchar(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`inventory_products_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inventory_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `inventory_products_profile`
--

CREATE TABLE IF NOT EXISTS `inventory_products_profile` (
  `inventory_products_id` int(11) NOT NULL,
  `profile_key` varchar(300) NOT NULL,
  `profile_value` varchar(300) NOT NULL,
  UNIQUE KEY `inventory_product_unique attribute` (`inventory_products_id`,`profile_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_products_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `measurement_attribute`
--

CREATE TABLE IF NOT EXISTS `measurement_attribute` (
  `measurement_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `measurement_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `product_type_table` varchar(50) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `beginning_measurement` double NOT NULL,
  `ending_measurement` double NOT NULL,
  `incremental_measurement` double NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `video_youtube` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `price_adjustment` double NOT NULL,
  PRIMARY KEY (`measurement_attribute_id`),
  UNIQUE KEY `unique_measurment` (`username`,`product_type_table`,`product_id`,`measurement_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `measurement_attribute`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_profile`
--

CREATE TABLE IF NOT EXISTS `order_profile` (
  `order_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_unique_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_inventory_id` int(11) DEFAULT NULL,
  `product_type` varchar(50) NOT NULL,
  `purchase_type` varchar(20) NOT NULL,
  `uploader_username` varchar(255) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_tag` varchar(100) NOT NULL,
  `product_image_id` int(11) DEFAULT NULL,
  `inventory_attribute_table` varchar(30) NOT NULL,
  `uploader_email` varchar(255) NOT NULL,
  `product_country_origin` varchar(50) NOT NULL,
  `domestic_shipping_rate` double NOT NULL,
  `international_shipping_rate` double NOT NULL,
  `current_shipping_rate` double NOT NULL,
  `product_type_added_to_shopping_cart` varchar(30) NOT NULL,
  `reward_points_awarded` int(11) NOT NULL,
  `backorder_time` varchar(20) NOT NULL,
  `product_price` double NOT NULL,
  `seller_receivable` double NOT NULL,
  `ts_created` datetime NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `buyer_country` varchar(50) NOT NULL,
  PRIMARY KEY (`order_profile_id`),
  KEY `order_unique_id` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `order_profile`
--

INSERT INTO `order_profile` (`order_profile_id`, `order_id`, `order_unique_id`, `product_id`, `product_inventory_id`, `product_type`, `purchase_type`, `uploader_username`, `uploader_id`, `product_name`, `product_tag`, `product_image_id`, `inventory_attribute_table`, `uploader_email`, `product_country_origin`, `domestic_shipping_rate`, `international_shipping_rate`, `current_shipping_rate`, `product_type_added_to_shopping_cart`, `reward_points_awarded`, `backorder_time`, `product_price`, `seller_receivable`, `ts_created`, `order_shipping_id`, `buyer_name`, `buyer_id`, `buyer_username`, `buyer_email`, `buyer_country`) VALUES
(1, 1, 'SUdebIvCqffyODZY', 10, NULL, 'Pants', 'Customizable', 'proballroomshoes', 1, 'Black gaberdine latin pants', 'Pants', 18, 'bottom', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 16, 'NA', 135, 135.7, '2010-08-29 17:13:55', 1, 'vincent zhang', 5, 'test4', 'vinzha3@gmail.com', 'Independent'),
(2, 2, 'mQlWhoIvRJoPqkpm', 14, 36, 'Shoes', 'Buy_now', 'test3', 4, 'Ladies standard shoes', 'Ladies standard shoes', 24, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 8.95, 'Inventory', 32, 'NA', 65, 64.2, '2010-09-02 16:48:48', 2, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(3, 2, 'mQlWhoIvRJoPqkpm', 10, NULL, 'Pants', 'Customizable', 'proballroomshoes', 1, 'Black gaberdine latin pants', 'Pants', 18, 'bottom', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 88, 'NA', 135, 135.7, '2010-09-02 16:48:48', 2, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(4, 3, 'DGHGSHcYjMQBRCwT', 9, NULL, 'Tops', 'Customizable', 'proballroomshoes', 1, 'Ladies top 1', 'Ladies top', 17, 'top', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 4, '4 weeks', 45, 59.2, '2010-09-02 17:12:56', 3, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(5, 4, 'CxdAfKcBcSiYAUVT', 13, 35, 'Shoes', 'Buy_now', 'test3', 4, 'Women''s latin shoes', 'Ladies latin shoes', 23, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 8.95, 'Inventory', 12, 'NA', 120, 110.95, '2010-09-28 21:03:49', 4, 'vincent zhang', 9, 'test5', 'vinzha5@gmail.com', '	Alluring ballroom	'),
(6, 5, 'gdLeFKVHuNKiBvGy', 13, 35, 'Shoes', 'Buy_now', 'test3', 4, 'Women''s latin shoes', 'Ladies latin shoes', 23, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 8.95, 'Inventory', 12, 'NA', 120, 110.95, '2010-09-28 21:06:46', 5, 'vincent zhang', 9, 'test5', 'vinzha5@gmail.com', '	Alluring ballroom	'),
(7, 5, 'gdLeFKVHuNKiBvGy', 13, 35, 'Shoes', 'Buy_now', 'test3', 4, 'Women''s latin shoes', 'Ladies latin shoes', 23, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 8.95, 'Inventory', 12, 'NA', 120, 110.95, '2010-09-28 21:06:46', 5, 'vincent zhang', 9, 'test5', 'vinzha5@gmail.com', '	Alluring ballroom	'),
(8, 5, 'gdLeFKVHuNKiBvGy', 6, NULL, 'Shoes', 'Customizable', 'proballroomshoes', 1, 'Stephanie Professional 94001', 'Ladies latin shoes', 14, 'shoes', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 12, '5 weeks', 115, 118.7, '2010-09-28 21:06:46', 5, 'vincent zhang', 9, 'test5', 'vinzha5@gmail.com', '	Alluring ballroom	'),
(9, 5, 'gdLeFKVHuNKiBvGy', 2, NULL, 'Shoes', 'Customizable', 'proballroomshoes', 1, 'stuff 2', 'Ladies latin shoes', 9, 'shoes', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 24, 'NA', 200, 190.95, '2010-09-28 21:06:46', 5, 'vincent zhang', 9, 'test5', 'vinzha5@gmail.com', '	Alluring ballroom	'),
(10, 6, 'kiImrCIpUDKVWSLm', 14, 36, 'Shoes', 'Buy_now', 'test3', 4, 'Ladies standard shoes', 'Ladies standard shoes', 24, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 20.95, 'Inventory', 9, 'NA', 65, 76.2, '2010-10-02 17:17:46', 7, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(11, 6, 'kiImrCIpUDKVWSLm', 15, 37, 'Shoes', 'Buy_now', 'test1', 2, 'asdfe', 'Ladies latin shoes', NULL, 'shoes', 'vinzha21321@gmail.com', 'usa', 8.95, 20.95, 20.95, 'Inventory', 12, 'NA', 120, 122.95, '2010-10-02 17:17:46', 7, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(12, 6, 'kiImrCIpUDKVWSLm', 3, 12, 'Dresses', 'Buy_now', 'proballroomshoes', 1, 'Dress 1', 'Latin competition dress', 11, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Inventory', 20, 'NA', 180, 173.95, '2010-10-02 17:17:46', 7, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(13, 6, 'kiImrCIpUDKVWSLm', 7, NULL, 'Dresses', 'Customizable', 'proballroomshoes', 1, 'Latin competition dress', 'Latin competition dress', 15, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 8, 'NA', 85, 93.2, '2010-10-02 17:17:46', 7, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(14, 7, 'rjuWePgcxlJQMWOD', 7, NULL, 'Dresses', 'Customizable', 'proballroomshoes', 1, 'Latin competition dress', 'Latin competition dress', 15, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 8, '5 weeks', 85, 93.2, '2010-10-02 17:31:43', 8, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(15, 7, 'rjuWePgcxlJQMWOD', 3, 12, 'Dresses', 'Buy_now', 'proballroomshoes', 1, 'Dress 1', 'Latin competition dress', 11, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Inventory', 20, 'NA', 180, 173.95, '2010-10-02 17:31:43', 8, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(16, 7, 'rjuWePgcxlJQMWOD', 14, 36, 'Shoes', 'Buy_now', 'test3', 4, 'Ladies standard shoes', 'Ladies standard shoes', 24, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 20.95, 'Inventory', 9, 'NA', 65, 76.2, '2010-10-02 17:31:43', 8, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent');

-- --------------------------------------------------------

--
-- Table structure for table `order_profile_attribute`
--

CREATE TABLE IF NOT EXISTS `order_profile_attribute` (
  `order_profile_attribute_id` int(11) NOT NULL,
  `profile_key` varchar(250) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`order_profile_attribute_id`,`profile_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_profile_attribute`
--

INSERT INTO `order_profile_attribute` (`order_profile_attribute_id`, `profile_key`, `profile_value`) VALUES
(1, 'additional_instructions', 'asdfase'),
(1, 'brand', 'Supadance'),
(1, 'color', 'Pin_stripe'),
(1, 'Measurement_body_height', '234'),
(1, 'Measurement_hip', '123'),
(1, 'Measurement_inseam', '123'),
(1, 'Measurement_waist', '123'),
(1, 'Measurement_waist_to_floor', '123'),
(2, 'brand', 'Supadance'),
(2, 'sys_color', 'Light_tan'),
(2, 'sys_shoe_heel', '1 inch'),
(2, 'sys_shoe_metric', 'EU'),
(2, 'sys_shoe_size', '38'),
(3, 'additional_instructions', ''),
(3, 'brand', 'Supadance'),
(3, 'color', 'Black'),
(3, 'Measurement_body_height', '321'),
(3, 'Measurement_hip', '12'),
(3, 'Measurement_inseam', '32'),
(3, 'Measurement_waist', '123'),
(3, 'Measurement_waist_to_floor', '124'),
(4, 'additional_instructions', ''),
(4, 'brand', 'Supadance'),
(4, 'color', 'Black'),
(4, 'Measurement_armpit_circumference', '34'),
(4, 'Measurement_arm_length', '234'),
(4, 'Measurement_body_height', '23'),
(4, 'Measurement_chest_or_bust', '234'),
(4, 'Measurement_neck', '324'),
(4, 'Measurement_shoulder', '436'),
(4, 'Measurement_shoulder_to_chest_or_bust', '34'),
(4, 'Measurement_shoulder_to_waist', '235'),
(4, 'Measurement_waist', '23'),
(4, 'Measurement_wrist', '23'),
(5, 'brand', 'Supadance'),
(5, 'sys_color', 'Light_tan'),
(5, 'sys_shoe_heel', '1 inch'),
(5, 'sys_shoe_metric', 'US'),
(5, 'sys_shoe_size', '7'),
(6, 'brand', 'Supadance'),
(6, 'sys_color', 'Light_tan'),
(6, 'sys_shoe_heel', '1 inch'),
(6, 'sys_shoe_metric', 'US'),
(6, 'sys_shoe_size', '7'),
(7, 'brand', 'Supadance'),
(7, 'sys_color', 'Light_tan'),
(7, 'sys_shoe_heel', '1 inch'),
(7, 'sys_shoe_metric', 'US'),
(7, 'sys_shoe_size', '7'),
(8, 'additional_instructions', ''),
(8, 'brand', 'STP'),
(8, 'color', 'Black'),
(8, 'sys_shoe_heel', '2.5 inch'),
(8, 'sys_shoe_metric', 'US'),
(8, 'sys_shoe_size', '8'),
(9, 'additional_instructions', ''),
(9, 'brand', 'Supadance'),
(9, 'color', 'Pin_stripe'),
(9, 'pants_fabric', 'yellow'),
(9, 'side_stripe', 'No side stripe'),
(9, 'sys_shoe_heel', '2 inch'),
(9, 'sys_shoe_metric', 'BR'),
(9, 'sys_shoe_size', '2.5'),
(10, 'brand', 'Supadance'),
(10, 'sys_color', 'Light_tan'),
(10, 'sys_shoe_heel', '1 inch'),
(10, 'sys_shoe_metric', 'EU'),
(10, 'sys_shoe_size', '38'),
(11, 'brand', 'Supadance'),
(11, 'sys_color', 'Black'),
(11, 'sys_shoe_heel', '1 inch'),
(11, 'sys_shoe_metric', 'BR'),
(11, 'sys_shoe_size', '1.5'),
(12, 'brand', 'Supadance'),
(12, 'Chest or bust', '71 cm'),
(12, 'Height of wearer', '165 cm'),
(12, 'Hip', '62 cm'),
(12, 'Length of garment', '98 cm'),
(12, 'Shoulder', '48 cm'),
(12, 'sys_color', 'Pin_stripe'),
(12, 'sys_fullbody_size', 'XS'),
(12, 'Waist', '61 cm'),
(13, 'additional_instructions', 'Whats going on?'),
(13, 'brand', 'Supadance'),
(13, 'color', 'Black'),
(13, 'Measurement_armpit_circumference', '234'),
(13, 'Measurement_arm_length', '12'),
(13, 'Measurement_body_height', '234'),
(13, 'Measurement_chest_or_bust', '14'),
(13, 'Measurement_hip', '234'),
(13, 'Measurement_inseam', '1'),
(13, 'Measurement_neck', '23'),
(13, 'Measurement_shoulder', '234'),
(13, 'Measurement_shoulder_to_chest_or_bust', '234'),
(13, 'Measurement_shoulder_to_waist', '234'),
(13, 'Measurement_thigh_circumference', '2134'),
(13, 'Measurement_waist', '23'),
(13, 'Measurement_waist_to_floor', '234'),
(13, 'Measurement_wrist', '23'),
(14, 'additional_instructions', 'what is going on?'),
(14, 'brand', 'Supadance'),
(14, 'color', 'Red'),
(14, 'Measurement_armpit_circumference', '23'),
(14, 'Measurement_arm_length', '12'),
(14, 'Measurement_body_height', '32'),
(14, 'Measurement_chest_or_bust', '34'),
(14, 'Measurement_hip', '124'),
(14, 'Measurement_inseam', '321'),
(14, 'Measurement_neck', '23'),
(14, 'Measurement_shoulder', '12'),
(14, 'Measurement_shoulder_to_chest_or_bust', '231'),
(14, 'Measurement_shoulder_to_waist', '324'),
(14, 'Measurement_thigh_circumference', '123'),
(14, 'Measurement_waist', '23'),
(14, 'Measurement_waist_to_floor', '14'),
(14, 'Measurement_wrist', '324'),
(15, 'brand', 'Supadance'),
(15, 'Chest or bust', '71 cm'),
(15, 'Height of wearer', '165 cm'),
(15, 'Hip', '62 cm'),
(15, 'Length of garment', '98 cm'),
(15, 'Shoulder', '48 cm'),
(15, 'sys_color', 'Pin_stripe'),
(15, 'sys_fullbody_size', 'XS'),
(15, 'Waist', '61 cm'),
(16, 'brand', 'Supadance'),
(16, 'sys_color', 'Light_tan'),
(16, 'sys_shoe_heel', '1 inch'),
(16, 'sys_shoe_metric', 'EU'),
(16, 'sys_shoe_size', '38');

-- --------------------------------------------------------

--
-- Table structure for table `order_profile_status_and_delivery`
--

CREATE TABLE IF NOT EXISTS `order_profile_status_and_delivery` (
  `order_profile_status_and_delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_profile_id` int(11) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `product_tracking` varchar(50) DEFAULT NULL,
  `product_tracking_carrier` varchar(50) DEFAULT NULL,
  `product_shipping_date` datetime DEFAULT NULL,
  `product_warning_delivery_date` datetime DEFAULT NULL,
  `product_latest_delivery_date` datetime DEFAULT NULL,
  `product_delivered_date` datetime DEFAULT NULL,
  `product_completion_date` datetime DEFAULT NULL,
  `product_returned` tinyint(1) NOT NULL,
  `product_return_tracking` varchar(50) DEFAULT NULL,
  `product_return_tracking_carrier` varchar(50) DEFAULT NULL,
  `product_return_shipping_date` datetime DEFAULT NULL,
  `product_return_latest_delivery_date` datetime DEFAULT NULL,
  `product_return_delivered_date` datetime DEFAULT NULL,
  `product_return_completion_date` datetime DEFAULT NULL,
  `product_fund_allocation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_profile_status_and_delivery_id`),
  UNIQUE KEY `order_profile_id` (`order_profile_id`),
  KEY `order_status` (`order_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `order_profile_status_and_delivery`
--

INSERT INTO `order_profile_status_and_delivery` (`order_profile_status_and_delivery_id`, `order_profile_id`, `order_status`, `product_tracking`, `product_tracking_carrier`, `product_shipping_date`, `product_warning_delivery_date`, `product_latest_delivery_date`, `product_delivered_date`, `product_completion_date`, `product_returned`, `product_return_tracking`, `product_return_tracking_carrier`, `product_return_shipping_date`, `product_return_latest_delivery_date`, `product_return_delivered_date`, `product_return_completion_date`, `product_fund_allocation_date`) VALUES
(1, 1, 'COMPLETED_AND_PAYMENT_TRANSFERED', '1Z9508730350260043', 'UPS', '2010-09-01 13:40:01', '2010-09-02 17:13:55', '2010-09-04 17:13:55', NULL, '2010-09-02 00:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2010-09-02 15:49:27'),
(2, 2, 'UNSHIPPED', NULL, NULL, NULL, '2010-09-06 16:48:48', '2010-09-08 16:48:48', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'RETURN_SHIPPED', '03092880000237779441', 'USPS', '2010-09-27 20:33:32', '2010-09-06 16:48:48', '2010-09-08 16:48:48', '2010-09-29 00:00:00', '2010-10-13 00:00:00', 1, '03092880000237779441', 'USPS', '2010-09-30 02:57:37', NULL, NULL, NULL, NULL),
(4, 4, 'SHIPPED', '03092880000237779441', 'USPS', '2010-09-29 17:13:04', '2010-09-06 17:12:56', '2010-09-08 17:12:56', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-02 21:03:49', '2010-10-04 21:03:49', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-02 21:06:46', '2010-10-04 21:06:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-02 21:06:46', '2010-10-04 21:06:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-02 21:06:46', '2010-10-04 21:06:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-02 21:06:46', '2010-10-04 21:06:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-06 17:17:46', '2010-10-08 17:17:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-06 17:17:46', '2010-10-08 17:17:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, 'SHIPPED', '03092880000237779441', 'UPS', '2010-10-02 18:15:19', '2010-10-06 17:17:46', '2010-10-08 17:17:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 13, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-06 17:17:46', '2010-10-08 17:17:46', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 14, 'SHIPPED', '03092880000237779441', 'USPS', '2010-10-02 17:50:24', '2010-10-06 17:31:43', '2010-10-08 17:31:43', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 15, 'SHIPPED', '03092880000237779441', 'FEDEX', '2010-10-02 18:12:41', '2010-10-06 17:31:43', '2010-10-08 17:31:43', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 16, 'UNSHIPPED', NULL, NULL, NULL, '2010-10-06 17:31:43', '2010-10-08 17:31:43', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping_address`
--

CREATE TABLE IF NOT EXISTS `order_shipping_address` (
  `address_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `order_shipping_address`
--

INSERT INTO `order_shipping_address` (`address_id`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`, `ts_created`) VALUES
(1, '200 East Davis', '', 'ann arbor', 'mi', 'usa', '48104', '2010-08-29 17:13:44'),
(2, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', '2010-09-02 16:48:43'),
(3, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', '2010-09-02 17:12:51'),
(4, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', '2010-09-28 21:03:43'),
(5, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', '2010-09-28 21:06:31'),
(6, '2403 bishop', '#5', 'ann arbor', 'mi', 'us', '48104', '2010-10-02 17:17:23'),
(7, '2403 bishop', '#5', 'ann arbor', 'mi', 'us', '48104', '2010-10-02 17:17:37'),
(8, '2403 bishop', '#5', 'ann arbor', 'mi', 'us', '48104', '2010-10-02 17:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_unique_id` varchar(20) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_email` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `total_number_items` smallint(6) NOT NULL,
  `cart_costs` double NOT NULL,
  `total_costs` double NOT NULL,
  `total_shipping_costs` double NOT NULL,
  `reward_points_used` int(11) NOT NULL,
  `reward_amount_deducted` int(11) NOT NULL,
  `reward_points_awarded` int(11) NOT NULL,
  `promotion_code_used` varchar(20) NOT NULL,
  `promotion_amount_deducted` double NOT NULL,
  `final_total_costs` double NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_unique_id_2` (`order_unique_id`),
  KEY `order_unique_id` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_unique_id`, `buyer_username`, `buyer_id`, `buyer_email`, `buyer_name`, `total_number_items`, `cart_costs`, `total_costs`, `total_shipping_costs`, `reward_points_used`, `reward_amount_deducted`, `reward_points_awarded`, `promotion_code_used`, `promotion_amount_deducted`, `final_total_costs`, `order_shipping_id`, `ts_created`) VALUES
(1, 'SUdebIvCqffyODZY', 'test4', 5, 'vinzha3@gmail.com', 'vincent zhang', 1, 135, 150.95, 20.95, 20, 5, 16, '', 0, 130, 1, '2010-08-29 17:13:55'),
(2, 'mQlWhoIvRJoPqkpm', 'test1', 2, 'vinzha21321@gmail.com', 'vincent zhang', 2, 200, 214.9, 29.9, 60, 15, 120, '', 0, 185, 2, '2010-09-02 16:48:48'),
(3, 'DGHGSHcYjMQBRCwT', 'test1', 2, 'vinzha21321@gmail.com', 'vincent zhang', 1, 45, 53.95, 20.95, 48, 12, 4, '', 0, 33, 3, '2010-09-02 17:12:56'),
(4, 'CxdAfKcBcSiYAUVT', 'test5', 9, 'vinzha5@gmail.com', 'vincent zhang', 1, 120, 128.95, 8.95, 0, 0, 12, '', 0, 120, 4, '2010-09-28 21:03:49'),
(5, 'gdLeFKVHuNKiBvGy', 'test5', 9, 'vinzha5@gmail.com', 'vincent zhang', 4, 555, 614.8, 59.8, 0, 0, 60, '', 0, 941.85, 5, '2010-09-28 21:06:46'),
(6, 'kiImrCIpUDKVWSLm', 'test1', 2, 'vinzha21321@gmail.com', 'vincent zhang', 4, 450, 527.8, 83.8, 24, 6, 49, '', 0, 444, 7, '2010-10-02 17:17:46'),
(7, 'rjuWePgcxlJQMWOD', 'test1', 2, 'vinzha21321@gmail.com', 'vincent zhang', 3, 330, 387.85, 62.85, 20, 5, 37, '', 0, 601.9, 8, '2010-10-02 17:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `pending_paypal_cart_to_order`
--

CREATE TABLE IF NOT EXISTS `pending_paypal_cart_to_order` (
  `pending_paypal_cart_to_order_id` int(11) NOT NULL,
  `order_unique_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_paypal_cart_to_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE IF NOT EXISTS `product_colors` (
  `product_id` int(11) NOT NULL,
  `Black` tinyint(1) NOT NULL,
  `Pin_stripe` tinyint(1) NOT NULL,
  `Light_tan` tinyint(1) NOT NULL,
  `Dark_tan` tinyint(1) NOT NULL,
  `Brown` tinyint(1) NOT NULL,
  `Silver` tinyint(1) NOT NULL,
  `Gold` tinyint(1) NOT NULL,
  `Gray` tinyint(1) NOT NULL,
  `White` tinyint(1) NOT NULL,
  `Red` tinyint(1) NOT NULL,
  `Pink` tinyint(1) NOT NULL,
  `Orange` tinyint(1) NOT NULL,
  `Yellow` tinyint(1) NOT NULL,
  `Green` tinyint(1) NOT NULL,
  `Cyan` tinyint(1) NOT NULL,
  `Blue` tinyint(1) NOT NULL,
  `Magenta` tinyint(1) NOT NULL,
  `Purple` tinyint(1) NOT NULL,
  `Clear` tinyint(1) NOT NULL,
  `Multicolor` tinyint(1) NOT NULL,
  `Monocolor` tinyint(1) NOT NULL,
  UNIQUE KEY `product_id_3` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`product_id`, `Black`, `Pin_stripe`, `Light_tan`, `Dark_tan`, `Brown`, `Silver`, `Gold`, `Gray`, `White`, `Red`, `Pink`, `Orange`, `Yellow`, `Green`, `Cyan`, `Blue`, `Magenta`, `Purple`, `Clear`, `Multicolor`, `Monocolor`) VALUES
(1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(3, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 1, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(11, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(13, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_custom_attribute`
--

CREATE TABLE IF NOT EXISTS `product_custom_attribute` (
  `product_custom_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `custom_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`product_custom_attribute_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_custom_attribute`
--

INSERT INTO `product_custom_attribute` (`product_custom_attribute_id`, `product_id`, `custom_attribute_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_fabric_set`
--

CREATE TABLE IF NOT EXISTS `product_fabric_set` (
  `product_fabric_set_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `fabric_set_id` int(11) NOT NULL,
  PRIMARY KEY (`product_fabric_set_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_fabric_set`
--

INSERT INTO `product_fabric_set` (`product_fabric_set_id`, `product_id`, `fabric_set_id`) VALUES
(1, 2, 1),
(2, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Product_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `post_id` (`Product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `filename`, `name`, `Product_id`, `username`, `ranking`) VALUES
(8, 'sk-art27.jpg', 'shoes', 1, 'proballroomshoes', 1),
(9, 'br762156-00vliv01.jpg', 'stuff 2', 2, 'proballroomshoes', 1),
(10, 'br762156-00p02v01.jpg', 'stuff 2', 2, 'proballroomshoes', 2),
(11, 'forever21.jpg', 'Dress 1', 3, 'proballroomshoes', 1),
(12, 'Forever21 skirts.jpg', 'Skirts', 4, 'proballroomshoes', 1),
(13, 'Dancenaturals.jpg', 'Patricia', 5, 'proballroomshoes', 1),
(14, 'Stephanie Professional Dance Shoes 92001-75 - Copper Tan Satin.jpg', 'Stephanie Professional 94001', 6, 'proballroomshoes', 1),
(15, 'DSC_2319-S5.jpg', 'Latin competition dress', 7, 'proballroomshoes', 1),
(16, 'DSCF1609-Y22 B28.jpg', 'latin skirt cust', 8, 'proballroomshoes', 1),
(17, 'red skirt.jpg', 'Ladies top 1', 9, 'proballroomshoes', 1),
(18, 'Igor2.jpg', 'Black gaberdine latin pants', 10, 'proballroomshoes', 1),
(19, '302.jpg', 'Aaron shoes', 11, 'proballroomshoes', 1),
(20, '302.jpg', 'Aaron customizable shoe', 12, 'proballroomshoes', 1),
(21, '305.jpg', 'Aaron customizable shoe', 12, 'proballroomshoes', 2),
(22, '315.jpg', 'Aaron customizable shoe', 12, 'proballroomshoes', 3),
(23, '243.gif', 'Women''s latin shoes', 13, 'test3', 1),
(24, '149.jpg', 'Ladies standard shoes', 14, 'test3', 1),
(25, 'Humpback Whale.jpg', 'Black pants', 16, 'proballroomshoes', 1),
(26, 'Oryx Antelope.jpg', 'Black pants', 16, 'proballroomshoes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventories`
--

CREATE TABLE IF NOT EXISTS `product_inventories` (
  `product_inventory_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `sys_name` varchar(100) NOT NULL,
  `sys_shoe_metric` varchar(10) DEFAULT NULL,
  `sys_shoe_size` double DEFAULT NULL,
  `sys_shoe_heel` varchar(30) DEFAULT NULL,
  `sys_fullbody_size` varchar(10) DEFAULT NULL,
  `sys_top_size` varchar(10) DEFAULT NULL,
  `sys_bottom_size` varchar(10) DEFAULT NULL,
  `sys_price` double NOT NULL,
  `sys_video` varchar(20) DEFAULT NULL,
  `sys_quantity` int(11) NOT NULL,
  `sys_description` text,
  `sys_conditions` varchar(20) NOT NULL,
  `sys_color` varchar(20) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`product_inventory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `product_inventories`
--

INSERT INTO `product_inventories` (`product_inventory_id`, `product_id`, `uploader_id`, `sys_name`, `sys_shoe_metric`, `sys_shoe_size`, `sys_shoe_heel`, `sys_fullbody_size`, `sys_top_size`, `sys_bottom_size`, `sys_price`, `sys_video`, `sys_quantity`, `sys_description`, `sys_conditions`, `sys_color`, `ts_created`) VALUES
(11, 1, 1, 'shoes', 'EU', 36, '3 inch', NULL, NULL, NULL, 180, NULL, 2, NULL, 'Like new', 'Dark_tan', '2010-08-19 18:21:03'),
(14, 4, 1, '', NULL, NULL, NULL, NULL, NULL, 'S', 0, NULL, 1, NULL, 'New', 'Brown', '2010-08-19 20:39:41'),
(13, 2, 1, 'stuff 2', 'BR', 4, '2 inch', NULL, NULL, NULL, 200, NULL, 1, '', 'New', 'Black', '2010-08-19 20:11:45'),
(12, 3, 1, 'Dress 1', NULL, NULL, NULL, 'XS', NULL, NULL, 180, NULL, 1, NULL, 'New', 'Pin_stripe', '2010-08-19 18:31:36'),
(10, 2, 1, 'stuff 2', 'BR', 1, '2 inch', NULL, NULL, NULL, 200, NULL, 1, '', 'New', 'Black', '2010-08-19 13:20:08'),
(28, 5, 1, 'Patricia', 'BR', 4, '3 inch', NULL, NULL, NULL, 90, NULL, 1, NULL, 'New', 'Dark_tan', '2010-08-25 17:28:23'),
(16, 6, 1, 'Stephanie Professional 94001', 'US', 6.5, '2.5 inch', NULL, NULL, NULL, 115, NULL, 0, '', 'New', 'Light_tan', '2010-08-22 15:25:58'),
(23, 7, 1, 'Latin competition dress', NULL, NULL, NULL, 'S', NULL, NULL, 85, NULL, 1, '', 'New', 'Red', '2010-08-23 01:22:59'),
(18, 6, 1, 'Stephanie Professional 94001', 'US', 7.5, '2 inch', NULL, NULL, NULL, 115, NULL, 1, '', 'New', 'Light_tan', '2010-08-22 15:26:45'),
(19, 6, 1, 'Stephanie Professional 94001', 'US', 7.5, '2.5 inch', NULL, NULL, NULL, 115, NULL, 4, '', 'New', 'Black', '2010-08-22 15:26:54'),
(20, 6, 1, 'Stephanie Professional 94001', 'US', 8, '2 inch', NULL, NULL, NULL, 115, NULL, 4, '', 'New', 'Black', '2010-08-22 15:27:10'),
(21, 6, 1, 'Stephanie Professional 94001', 'US', 8.5, '3 inch', NULL, NULL, NULL, 115, NULL, 4, '', 'New', 'Black', '2010-08-22 15:27:28'),
(22, 6, 1, 'Stephanie Professional 94001', 'US', 6, '2 inch', NULL, NULL, NULL, 115, NULL, 0, '', 'New', 'Black', '2010-08-22 15:27:58'),
(24, 7, 1, 'Latin competition dress', NULL, NULL, NULL, 'S', NULL, NULL, 85, NULL, 1, '', 'New', 'Black', '2010-08-23 13:29:32'),
(26, 9, 1, 'Ladies top 1', NULL, NULL, NULL, NULL, 'S', NULL, 45, NULL, 1, '', 'New', 'Black', '2010-08-24 14:36:52'),
(27, 10, 1, 'Black gaberdine latin pants', NULL, NULL, NULL, NULL, NULL, '50 cm', 135, NULL, 1, '', 'New', 'Black', '2010-08-24 14:53:35'),
(29, 11, 1, '', 'US', 9.5, '1 inch', NULL, NULL, NULL, 0, NULL, 5, NULL, 'Like new', 'Black', '2010-08-27 17:40:06'),
(30, 12, 1, 'Aaron customizable shoe', 'US', 8, '1 inch', NULL, NULL, NULL, 200, NULL, 1, '', 'New', 'Black', '2010-08-27 17:45:44'),
(31, 12, 1, 'Aaron customizable shoe', 'US', 9, '1 inch', NULL, NULL, NULL, 200, NULL, 5, '', 'New', 'Black', '2010-08-27 17:45:49'),
(32, 12, 1, 'Aaron customizable shoe', 'US', 10, '1 inch', NULL, NULL, NULL, 200, NULL, 2, '', 'New', 'Black', '2010-08-27 17:45:53'),
(33, 12, 1, 'Aaron customizable shoe', 'US', 10.5, '1 inch', NULL, NULL, NULL, 200, NULL, 1, '', 'New', 'Black', '2010-08-27 17:45:57'),
(34, 12, 1, 'Aaron customizable shoe', 'US', 11.5, '1 inch', NULL, NULL, NULL, 200, NULL, 2, '', 'New', 'Silver', '2010-08-27 17:46:03'),
(35, 13, 4, '', 'US', 7, '1 inch', NULL, NULL, NULL, 120, NULL, 1, NULL, 'New', 'Light_tan', '2010-08-27 22:48:36'),
(36, 14, 4, '', 'EU', 38, '1 inch', NULL, NULL, NULL, 65, NULL, 1, NULL, 'New', 'Light_tan', '2010-08-27 23:07:37'),
(37, 15, 2, '', 'BR', 1.5, '1 inch', NULL, NULL, NULL, 120, NULL, 1, NULL, 'New', 'Black', '2010-09-02 16:42:49'),
(38, 16, 1, '', NULL, NULL, NULL, NULL, NULL, '74 cm', 135, NULL, 1, NULL, 'New', 'Black', '2010-10-02 00:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory_images`
--

CREATE TABLE IF NOT EXISTS `product_inventory_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Product_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `post_id` (`Product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_inventory_images`
--

INSERT INTO `product_inventory_images` (`image_id`, `filename`, `name`, `Product_id`, `username`, `ranking`) VALUES
(4, 'forever21.jpg', 'stuff 2', 13, 'proballroomshoes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory_profile`
--

CREATE TABLE IF NOT EXISTS `product_inventory_profile` (
  `product_inventory_profile_id` int(11) NOT NULL,
  `profile_key` varchar(300) NOT NULL,
  `profile_value` varchar(300) NOT NULL,
  UNIQUE KEY `inventory_product_unique attribute` (`product_inventory_profile_id`,`profile_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_inventory_profile`
--

INSERT INTO `product_inventory_profile` (`product_inventory_profile_id`, `profile_key`, `profile_value`) VALUES
(14, 'Height of wearer', '175 cm'),
(14, 'Waist', '62 cm'),
(13, 'Attr_color__1_pants_fabric', 'black'),
(13, 'Attr_1_side_stripe', 'No side stripe'),
(12, 'Length of garment', '98 cm'),
(12, 'Hip', '62 cm'),
(12, 'Waist', '61 cm'),
(12, 'Chest or bust', '71 cm'),
(12, 'Shoulder', '48 cm'),
(12, 'Height of wearer', '165 cm'),
(10, 'Attr_color__1_pants_fabric', 'black'),
(10, 'Attr_1_side_stripe', 'No side stripe'),
(14, 'Hip', '64 cm'),
(14, 'Length of garment', '97 cm'),
(23, 'Height_of_wearer', '170 cm'),
(23, 'Shoulder', '39 cm'),
(23, 'Chest_or_bust', '88 cm'),
(23, 'Waist', '75 cm'),
(23, 'Hip', '80 cm'),
(23, 'Length_of_garment', '108 cm'),
(24, 'Height_of_wearer', '75 cm'),
(24, 'Shoulder', '20 cm'),
(24, 'Chest_or_bust', '40 cm'),
(24, 'Waist', '45 cm'),
(24, 'Hip', '45 cm'),
(24, 'Length_of_garment', '45 cm'),
(26, 'Shoulder', '20 cm'),
(26, 'Height_of_wearer', '75 cm'),
(26, 'Chest_or_bust', '40 cm'),
(26, 'Waist', '45 cm'),
(27, 'Height_of_wearer', 'Flexible cm'),
(27, 'Waist', '81 cm'),
(27, 'Hip', '69 cm'),
(27, 'Length_of_garment', '86 cm'),
(30, 'Attr_color__1_Aaron_shoe_fabric', 'Leopard'),
(31, 'Attr_color__1_Aaron_shoe_fabric', 'Leopard'),
(32, 'Attr_color__1_Aaron_shoe_fabric', 'Leopard'),
(33, 'Attr_color__1_Aaron_shoe_fabric', 'Leopard'),
(34, 'Attr_color__1_Aaron_shoe_fabric', 'Leopard'),
(38, 'Height of wearer', 'Flexible cm'),
(38, 'Waist', '73 cm'),
(38, 'Hip', 'Flexible cm'),
(38, 'Length of garment', 'Flexible cm');

-- --------------------------------------------------------

--
-- Table structure for table `product_profiles`
--

CREATE TABLE IF NOT EXISTS `product_profiles` (
  `Product_id` bigint(20) NOT NULL,
  `profile_key` varchar(200) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`Product_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_profiles`
--

INSERT INTO `product_profiles` (`Product_id`, `profile_key`, `profile_value`) VALUES
(1, 'description', '<p>adfasdf asdf a;slkdfj ;ekwl&nbsp;</p>'),
(2, 'description', '<p>stuff shoes 2&nbsp;</p>'),
(3, 'description', '<p>asdf;lasdfeadsfw ewqe fwqe f&nbsp;</p>'),
(4, 'description', '<p>Skirts two&nbsp;</p>'),
(5, 'description', '<p>&nbsp;I just bought this pair. it did not fit me. selling it right now.&nbsp;</p>'),
(6, 'description', '<p>&nbsp;<span class="Apple-style-span" style="font-family: Arial, Helvetica, sans-serif; color: rgb(96, 105, 94); ">\r\n<table style="width: 386px; height: 133px; ">\r\n    <tbody>\r\n        <tr>\r\n            <td height="25" class="ProductTitle" style="padding-bottom: 16px; ">Stephanie Professional Dance Shoes 92001-45, New Dark Tan&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td class="PimgSmall">Stephanie Professional Dance Shoes 92001, New Dark Tan *Real leather interior material for extra skin comfort. *Special exterior fabrication/satin made for WATER/OIL/DIRT RESISTANCE (3R = 3 Resistance) *Memory padding for super extra comfort, made with special padding material provides both comfort and long lasting (very strong and thick padding against decompression that last 5 times longer than every leading brand)<br />\r\n            <p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; "><b>Heel :&nbsp;</b>2.5 inches&nbsp;<font color="#cccccc">|</font>&nbsp;3 inches</p>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">Delivers in 1-2 weeks</p>\r\n</span></p>'),
(7, 'description', '<p>&nbsp;This latin dress is very good.</p>'),
(8, 'description', '<p>&nbsp;Great skirt for salsa and other social dancing occasions.&nbsp;</p>'),
(9, 'description', '<p>&nbsp;Great piece of clothing</p>'),
(10, 'description', '<p>These pants are absolutely wonderfull. &nbsp;</p>'),
(11, 'description', '<p>&nbsp;Hi guys, this is a great product. My name is Aaron Lee. You should buy from me.&nbsp;</p>'),
(12, 'description', '<p>aaron customizable shoe</p>'),
(13, 'description', '<p>This is a great pair of shoes!&nbsp;</p>'),
(14, 'description', '<p>This shoe is great for everything.&nbsp;</p>'),
(15, 'description', '<p>sadfefasf&nbsp;</p>'),
(16, 'description', '<p>&nbsp;This item rock!</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE IF NOT EXISTS `product_rating` (
  `product_rating_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `products_id` bigint(20) NOT NULL,
  `5_star` smallint(6) DEFAULT NULL,
  `4_star` smallint(6) DEFAULT NULL,
  `3_star` smallint(6) DEFAULT NULL,
  `2_star` smallint(6) DEFAULT NULL,
  `1_star` smallint(6) DEFAULT NULL,
  `total_number_review` int(11) DEFAULT NULL,
  `average_rating` double DEFAULT NULL,
  PRIMARY KEY (`product_rating_id`),
  UNIQUE KEY `rating_unique` (`products_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_shoes_attributes`
--

CREATE TABLE IF NOT EXISTS `product_shoes_attributes` (
  `product_id` int(11) NOT NULL,
  `shoes_metric` varchar(20) NOT NULL,
  `min_size` int(11) NOT NULL,
  `max_size` int(11) NOT NULL,
  `size_interval` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  UNIQUE KEY `products_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_shoes_attributes`
--

INSERT INTO `product_shoes_attributes` (`product_id`, `shoes_metric`, `min_size`, `max_size`, `size_interval`, `ts_created`) VALUES
(2, 'BR', 0, 13, 1, '2010-08-19 12:11:10'),
(6, 'US', 6, 12, 1, '2010-08-22 15:25:36'),
(12, 'US', 7, 13, 1, '2010-08-27 17:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_shoes_heel`
--

CREATE TABLE IF NOT EXISTS `product_shoes_heel` (
  `product_id` int(11) NOT NULL,
  `one_inch` tinyint(1) NOT NULL,
  `one_half_inch` tinyint(1) NOT NULL,
  `two_inch` tinyint(1) NOT NULL,
  `two_half_inch` tinyint(1) NOT NULL,
  `three_inch` tinyint(1) NOT NULL,
  `three_half_inch` tinyint(1) NOT NULL,
  `heel_50_mm` tinyint(1) NOT NULL,
  `heel_70_mm` tinyint(1) NOT NULL,
  `heel_90_mm` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_shoes_heel`
--

INSERT INTO `product_shoes_heel` (`product_id`, `one_inch`, `one_half_inch`, `two_inch`, `two_half_inch`, `three_inch`, `three_half_inch`, `heel_50_mm`, `heel_70_mm`, `heel_90_mm`) VALUES
(2, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(6, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(12, 1, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_shoutouts`
--

CREATE TABLE IF NOT EXISTS `product_shoutouts` (
  `product_shoutout_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `shoutout_name` varchar(100) NOT NULL,
  `shoutout_email` varchar(100) NOT NULL,
  `shoutout_username` varchar(100) DEFAULT NULL,
  `shoutout_user_id` int(11) DEFAULT NULL,
  `shoutout_message` varchar(400) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`product_shoutout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `product_shoutouts`
--

INSERT INTO `product_shoutouts` (`product_shoutout_id`, `product_id`, `uploader_id`, `shoutout_name`, `shoutout_email`, `shoutout_username`, `shoutout_user_id`, `shoutout_message`, `ts_created`) VALUES
(1, 2, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'Whats up?', '2010-08-20 21:58:30'),
(2, 2, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-20 22:22:49'),
(3, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asfwezcxvzcvzxcvsd', '2010-08-21 18:13:52'),
(4, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-21 18:30:47'),
(5, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'what do you think about this item?', '2010-08-21 18:31:59'),
(6, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'what do you think about this item?', '2010-08-21 18:32:11'),
(7, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfew', '2010-08-21 18:33:41'),
(8, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'afdew', '2010-08-21 18:34:19'),
(9, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfwe', '2010-08-21 18:42:57'),
(10, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-21 18:46:21'),
(11, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'what is this?', '2010-08-21 18:47:53'),
(12, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, ';kjl;kj;', '2010-08-21 18:48:38'),
(13, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'whos', '2010-08-21 18:50:16'),
(14, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfae', '2010-08-21 18:51:47'),
(15, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'whats up', '2010-08-21 18:53:22'),
(16, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asfwe', '2010-08-21 18:54:27'),
(17, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'yeah?', '2010-08-21 18:55:11'),
(18, 2, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'whats up', '2010-08-21 18:58:06'),
(19, 2, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'whats up', '2010-08-21 18:58:15'),
(20, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfwe', '2010-08-21 18:58:21'),
(21, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asfe', '2010-08-21 18:58:38'),
(22, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-21 18:59:00'),
(23, 5, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-21 18:59:27'),
(24, 5, 0, 'asdf', 'asdf', NULL, NULL, 'asdf', '2010-08-21 19:23:20'),
(25, 5, 0, 'asdf', 'asdf', NULL, NULL, 'sadfasdf', '2010-08-21 19:24:12'),
(26, 5, 0, 'asdf', 'adsf', NULL, NULL, 'adsfsadf', '2010-08-21 19:29:49'),
(27, 5, 0, 'asdf', 'adsf', NULL, NULL, 'adsfsadf', '2010-08-21 19:30:09'),
(28, 5, 0, 'asdf', 'adsf', NULL, NULL, 'asdfase', '2010-08-21 19:30:17'),
(29, 5, 0, 'asdf', 'asdf', NULL, NULL, 'asdfadsf', '2010-08-21 19:30:27'),
(30, 5, 0, 'asdf', 'asdfa', NULL, NULL, 'sadfadsf', '2010-08-21 19:32:05'),
(31, 5, 0, 'asdfe', 'asdfe', NULL, NULL, 'asfee', '2010-08-21 19:36:14'),
(32, 5, 0, 'Vincent', 'zhang', NULL, NULL, 'asdaesrse', '2010-08-21 19:36:41'),
(33, 5, 0, 'asfe', 'asdfase', NULL, NULL, 'asdfseafse', '2010-08-21 19:37:37'),
(34, 1, 0, 'asfae', 'asfeef', NULL, NULL, 'asfefwe', '2010-08-21 19:38:30'),
(35, 5, 0, 'asdfefe', 'asdfasfe', NULL, NULL, 'asfasfew', '2010-08-21 19:39:46'),
(36, 5, 0, 'asdfefe', 'asdfasfe', NULL, NULL, 'asfasfew', '2010-08-21 19:40:03'),
(37, 1, 0, 'asdfe', 'asea', NULL, NULL, 'asfsef', '2010-08-21 19:44:30'),
(38, 1, 0, 'asfe', 'asefasef', NULL, NULL, 'asfasfsefa', '2010-08-21 19:47:41'),
(39, 5, 0, 'Svitlana', 'poo@gmail.com', NULL, NULL, 'what is this? why is this expensive?', '2010-08-21 20:03:31'),
(40, 5, 0, 'Svitlana', 'poo@gmail.com', NULL, NULL, 'what is this? why is this expensive?', '2010-08-21 20:04:01'),
(41, 5, 0, 'vincent', 'zhang@gmail.com', NULL, NULL, 'because it is the best shoe ever!', '2010-08-21 20:04:27'),
(42, 1, 0, 'new', 'new stuff', NULL, NULL, 'asdkfesfr', '2010-08-21 20:07:39'),
(43, 5, 0, 'Vincent', 'vince@gmail.com', NULL, NULL, 'asfefs', '2010-08-21 20:50:11'),
(44, 4, 0, 'Vincent', 'vinzha@gmail.com', NULL, NULL, 'Is this skirt good?', '2010-08-22 14:27:58'),
(45, 6, 0, 'Vincent Zhang', 'vinzha@gmail.com', NULL, NULL, 'I would like to ask whether this shoe come in wide or narrow?', '2010-08-22 23:41:00'),
(46, 6, 0, 'vincet zhang', 'vinzha@gmail.com', NULL, NULL, 'blah blah', '2010-08-22 23:51:10'),
(47, 7, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'asdfe', '2010-08-23 01:26:38'),
(48, 6, 0, 'proballroomshoes', 'vinzha@gmail.com', 'proballroomshoes', 1, 'what is the situation like?', '2010-08-25 19:34:36'),
(49, 10, 0, 'test2', 'vinzha2@gmail.com', 'test2', 3, 'Nice pants', '2010-08-26 13:13:40'),
(50, 6, 0, 'Aaron', 'aaron@gmail.com', NULL, NULL, 'If I order now, when can i get the shoes?', '2010-08-27 17:30:22'),
(51, 10, 1, 'vincent', 'vinzha@gmail.com', NULL, NULL, 'awhat', '2010-08-29 16:39:42'),
(52, 14, 4, 'test3', 'vinzha1@gmail.com', 'test3', 4, 'asfe', '2010-08-31 23:15:19'),
(53, 2, 1, 'test1', 'vinzha21321@gmail.com', 'test1', 2, 'zsdgvsdg', '2010-10-01 23:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE IF NOT EXISTS `product_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `Products_id` bigint(20) NOT NULL,
  `User_id` int(11) NOT NULL,
  `tag` varchar(200) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `Products_id` (`Products_id`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_type` varchar(20) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `inventory_attribute_table` varchar(30) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_tag` varchar(100) NOT NULL,
  `product_price_range` varchar(20) NOT NULL,
  `domestic_shipping_rate` double NOT NULL,
  `international_shipping_rate` float DEFAULT NULL,
  `uploader_id` bigint(20) NOT NULL,
  `uploader_username` varchar(300) NOT NULL,
  `uploader_network` varchar(150) NOT NULL,
  `uploader_email` varchar(250) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `on_sale` tinyint(1) NOT NULL,
  `sales_price` double DEFAULT NULL,
  `brand` varchar(100) NOT NULL,
  `inventory_reference` varchar(30) NOT NULL,
  `uniqueIdentifierForJS` varchar(10) NOT NULL,
  `return_allowed` tinyint(1) NOT NULL,
  `flagged` tinyint(1) NOT NULL,
  `ts_created` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `listing_type` varchar(20) DEFAULT NULL,
  `new` tinyint(1) NOT NULL,
  `video_youtube` varchar(30) DEFAULT NULL,
  `reward_point` int(11) NOT NULL,
  `backorder_time` varchar(20) NOT NULL,
  `social_usage` varchar(3) NOT NULL,
  `competition_usage` varchar(3) NOT NULL,
  `last_status_change` datetime NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `status` (`status`),
  KEY `uniqueIdentifierForJS` (`uniqueIdentifierForJS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `purchase_type`, `product_category`, `inventory_attribute_table`, `product_type`, `product_tag`, `product_price_range`, `domestic_shipping_rate`, `international_shipping_rate`, `uploader_id`, `uploader_username`, `uploader_network`, `uploader_email`, `url`, `name`, `price`, `on_sale`, `sales_price`, `brand`, `inventory_reference`, `uniqueIdentifierForJS`, `return_allowed`, `flagged`, `ts_created`, `status`, `listing_type`, `new`, `video_youtube`, `reward_point`, `backorder_time`, `social_usage`, `competition_usage`, `last_status_change`) VALUES
(1, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'shoes', 'shoes', 180, 0, NULL, 'Supadance', 'sajiatouci', 'phihialaeu', 1, 0, '2010-08-19 02:18:19', 'Listed', NULL, 0, '', 20, 'NA', 'off', 'on', '2010-08-19 02:18:19'),
(2, 'Customizable', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'stuff-2', 'stuff 2', 200, 0, NULL, 'Supadance', 'laebouloun', 'wanauaisou', 1, 0, '2010-08-19 02:32:34', 'Listed', NULL, 0, 'QwY5_IqsDyI', 24, 'NA', 'off', 'on', '2010-08-19 02:32:34'),
(3, 'Buy_now', 'Women', 'fullbody', 'Dresses', 'Latin competition dress', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'dress-1', 'Dress 1', 180, 0, NULL, 'Supadance', 'thouchiapi', 'gireajotou', 1, 0, '2010-08-19 12:29:29', 'Listed', NULL, 0, '', 20, 'NA', 'off', 'on', '2010-08-19 12:29:29'),
(4, 'Buy_now', 'Women', 'bottom', 'Skirts', 'Latin skirt', 'price_category_1', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'skirts', 'Skirts', 85, 0, NULL, 'Supadance', 'triodrewra', 'teakiothef', 1, 0, '2010-08-19 20:39:39', 'Listed', NULL, 0, '', 8, 'NA', 'on', 'on', '2010-08-19 20:39:39'),
(5, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_1', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'patricia', 'Patricia', 90, 0, NULL, 'Supadance', 'thaicioria', 'cheapaimae', 1, 0, '2010-08-20 15:14:11', 'Listed', NULL, 0, '', 8, 'NA', 'off', 'on', '2010-08-20 15:14:11'),
(6, 'Customizable', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'stephanie-professional-94001', 'Stephanie Professional 94001', 115, 0, NULL, 'STP', 'stochenaeh', 'wuthouwrae', 1, 0, '2010-08-22 15:24:42', 'Listed', NULL, 0, '', 12, '5 weeks', 'on', 'on', '2010-08-22 15:24:42'),
(7, 'Customizable', 'Women', 'fullbody', 'Dresses', 'Latin competition dress', 'price_category_1', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'latin-competition-dress', 'Latin competition dress', 85, 0, NULL, 'Supadance', 'phuhebopad', 'croupucrio', 1, 0, '2010-08-23 01:21:36', 'Listed', NULL, 0, '', 8, '5 weeks', 'on', 'off', '2010-08-23 01:21:36'),
(8, 'Customizable', 'Women', 'bottom', 'Skirts', 'Latin skirt', 'price_category_1', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'latin-skirt-cust', 'latin skirt cust', 75, 0, NULL, 'BDdance', 'rousliobio', 'hephousiot', 1, 0, '2010-08-23 12:35:14', 'Unlisted', NULL, 0, '', 8, '5 weeks', 'on', 'on', '2010-08-23 12:35:14'),
(9, 'Customizable', 'Women', 'top', 'Tops', 'Ladies top', 'price_category_1', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'ladies-top-1', 'Ladies top 1', 45, 0, NULL, 'Supadance', 'buphuclicl', 'coucloucra', 1, 0, '2010-08-23 12:56:24', 'Listed', NULL, 0, '', 4, '4 weeks', 'on', 'off', '2010-08-23 12:56:24'),
(10, 'Customizable', 'Men', 'bottom', 'Pants', 'Pants', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'black-gaberdine-latin-pants', 'Black gaberdine latin pants', 135, 0, NULL, 'Supadance', 'pousudodri', 'geanaichof', 1, 0, '2010-08-24 14:48:07', 'Listed', NULL, 0, '', 16, 'NA', 'off', 'on', '2010-08-24 14:48:07'),
(11, 'Buy_now', 'Men', 'shoes', 'Shoes', 'Men standard shoes', 'price_category_2', 20, 20, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'aaron-shoes', 'Aaron shoes', 200, 0, NULL, 'Rayrose', 'phousaenea', 'couotaipha', 0, 0, '2010-08-27 17:40:04', 'Listed', NULL, 0, '', 24, 'NA', 'on', 'off', '2010-08-27 17:40:04'),
(12, 'Customizable', 'Men', 'shoes', 'Shoes', 'Men standard shoes', 'price_category_2', 20, 20, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'aaron-customizable-shoe', 'Aaron customizable shoe', 200, 0, NULL, 'Rayrose', 'paneaceuai', 'friostevea', 0, 0, '2010-08-27 17:43:34', 'Removed', NULL, 0, '', 24, '4 weeks', 'on', 'off', '2010-08-27 17:43:34'),
(13, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 8.95, 20.95, 4, 'test3', 'usa', 'vinzha1@gmail.com', 'women-s-latin-shoes', 'Women''s latin shoes', 120, 0, NULL, 'Supadance', 'cliawrowea', 'priraliose', 1, 0, '2010-08-27 22:48:31', 'Listed', NULL, 0, '', 12, 'NA', 'on', 'off', '2010-08-27 22:48:31'),
(14, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies standard shoes', 'price_category_1', 8.95, 20.95, 4, 'test3', 'usa', 'vinzha1@gmail.com', 'ladies-standard-shoes', 'Ladies standard shoes', 65, 0, NULL, 'Supadance', 'roujislocr', 'joutriofri', 1, 0, '2010-08-27 23:07:35', 'Listed', NULL, 0, '', 9, 'NA', 'on', 'off', '2010-08-27 23:07:35'),
(15, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 8.95, 20.95, 2, 'test1', 'usa', 'vinzha21321@gmail.com', 'asdfe', 'asdfe', 120, 0, NULL, 'Supadance', 'phalapraip', 'chouvobiom', 1, 0, '2010-09-02 16:42:48', 'Listed', NULL, 0, '', 12, 'NA', 'on', 'on', '2010-09-02 16:42:48'),
(16, 'Buy_now', 'Men', 'bottom', 'Pants', 'Pants', 'price_category_2', 8.95, 20.95, 1, 'proballroomshoes', 'france', 'vinzha@gmail.com', 'black-pants', 'Black pants', 135, 0, NULL, 'Other', 'lougudutra', 'frouslouco', 1, 0, '2010-10-02 00:12:20', 'Listed', NULL, 0, '', 16, 'NA', 'on', 'on', '2010-10-02 00:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `promotions_profile`
--

CREATE TABLE IF NOT EXISTS `promotions_profile` (
  `promotion_id` bigint(20) NOT NULL,
  `promotion_key` varchar(255) NOT NULL,
  `promotion_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotions_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `promotions_tags`
--

CREATE TABLE IF NOT EXISTS `promotions_tags` (
  `promotion_id` bigint(20) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotions_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `receiver_message`
--

CREATE TABLE IF NOT EXISTS `receiver_message` (
  `receiver_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_User_id` int(11) DEFAULT NULL,
  `receiver_email` varchar(150) NOT NULL,
  `receiver_username` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(150) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_subject` varchar(200) NOT NULL,
  `sender_username` varchar(100) DEFAULT NULL,
  `sender_user_id` int(11) DEFAULT NULL,
  `sender_message` varchar(400) NOT NULL,
  `message_read` tinyint(1) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`receiver_message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `receiver_message`
--

INSERT INTO `receiver_message` (`receiver_message_id`, `receiver_User_id`, `receiver_email`, `receiver_username`, `receiver_name`, `product_id`, `sender_name`, `sender_email`, `sender_subject`, `sender_username`, `sender_user_id`, `sender_message`, `message_read`, `ts_created`) VALUES
(1, 1, 'vinzha@gmail.com', NULL, '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:45:59'),
(2, 1, 'vinzha@gmail.com', NULL, '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:48:35'),
(3, 1, 'vinzha@gmail.com', NULL, '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:49:05'),
(4, 4, 'vinzha1@gmail.com', NULL, '', 14, 'proballroomshoes', 'info@professionalballroomshoes.com', 'sdfase', 'proballroomshoes', 1, 'asdfef', 0, '2010-08-31 22:24:46'),
(5, 1, 'vinzha@gmail.com', NULL, ' ', 10, 'proballroomshoes', 'info@professionalballroomshoes.com', 'Message good?', 'proballroomshoes', 1, 'is this message good?', 0, '2010-08-31 22:55:02'),
(6, 1, 'vinzha@gmail.com', NULL, 'Vincent Zhang', 10, 'proballroomshoes', 'info@professionalballroomshoes.com', 'test message 3', 'proballroomshoes', 1, 'Alright test message 3', 0, '2010-08-31 23:05:44'),
(7, 5, 'vinzha3@gmail.com', NULL, NULL, 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'What is this?', 0, '2010-08-31 23:40:02'),
(8, 5, 'vinzha3@gmail.com', NULL, NULL, 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'Oh yeah. do you like it?', 0, '2010-08-31 23:46:37'),
(9, 5, 'vinzha3@gmail.com', NULL, 'vincent zhang', 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'asfe', 0, '2010-08-31 23:47:16'),
(10, 4, 'vinzha1@gmail.com', NULL, 'vincent zhang', 14, 'proballroomshoes', 'vinzha@gmail.com', 'adfas', 'proballroomshoes', 1, 'adsf', 0, '2010-09-02 17:01:50'),
(11, 4, 'vinzha1@gmail.com', NULL, 'vincent zhang', 14, 'Bob', 'bob@umich.edu', 'whats up?', NULL, NULL, 'what', 0, '2010-09-02 17:03:03'),
(12, 1, 'vinzha@gmail.com', NULL, 'Vincent Zhang', 10, 'asdf', 'asdf@gmail.com', 'asdfas', NULL, NULL, 'asdfsadf', 0, '2010-09-02 17:03:25'),
(13, 1, 'vinzha@gmail.com', NULL, '', 9, 'test1', 'vinzha21321@gmail.com', 'orderID: DGHGSHcYjMQBRCwT', 'test1', 2, 'is this working', 0, '2010-09-29 18:59:50'),
(14, 1, 'vinzha@gmail.com', NULL, 'proballroomshoes', 9, 'test1', 'vinzha21321@gmail.com', 'orderID: DGHGSHcYjMQBRCwT', 'test1', 2, 'asdfaef', 0, '2010-09-29 19:01:34'),
(15, 1, 'vinzha@gmail.com', NULL, 'proballroomshoes', 10, 'test1', 'vinzha21321@gmail.com', 'orderID: mQlWhoIvRJoPqkpm', 'test1', 2, 'Thank you for your shoes. We love it!', 0, '2010-09-29 19:17:51'),
(16, 4, 'vinzha1@gmail.com', NULL, 'test3', 14, 'test1', 'vinzha21321@gmail.com', 'orderID: mQlWhoIvRJoPqkpm', 'test1', 2, 'Please ship this item immediately!', 0, '2010-09-30 00:52:42'),
(17, 2, 'vinzha21321@gmail.com', NULL, 'vincent zhang', 7, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: rjuWePgcxlJQMWOD', 'proballroomshoes', 1, 'what do you like about this?', 0, '2010-10-02 18:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `reward_point_tracking`
--

CREATE TABLE IF NOT EXISTS `reward_point_tracking` (
  `reward_point_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_points_added` varchar(20) NOT NULL,
  `point` int(10) NOT NULL,
  `name_of_event` varchar(300) NOT NULL,
  `location_id` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_caused_point_addition` varchar(20) DEFAULT NULL,
  `user_caused_Username` varchar(150) NOT NULL,
  `user_caused_id` int(11) NOT NULL,
  PRIMARY KEY (`reward_point_tracking_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reward_point_tracking`
--


-- --------------------------------------------------------

--
-- Table structure for table `search_clubs`
--

CREATE TABLE IF NOT EXISTS `search_clubs` (
  `userID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `public_club_name` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `user_id` (`userID`),
  FULLTEXT KEY `public_club_name` (`public_club_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `search_clubs`
--


-- --------------------------------------------------------

--
-- Table structure for table `sellerinformation`
--

CREATE TABLE IF NOT EXISTS `sellerinformation` (
  `User_id` bigint(20) unsigned NOT NULL,
  `unique_identifier` varchar(20) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `items_description` text NOT NULL,
  `store_description` text NOT NULL,
  `ts_created` datetime NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerinformation`
--

INSERT INTO `sellerinformation` (`User_id`, `unique_identifier`, `verified`, `paypal_email`, `phone_number`, `type`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`, `items_description`, `store_description`, `ts_created`, `status`) VALUES
(1, 'S1uqQM6JxM', 1, 'info@professionalballroomshoes.com', '615-957-4320', 'storeSeller', '200 East Davis', '', 'ann arbor', 'mi', 'france', '48104', 'no items description', 'no store description', '2010-04-19 16:42:06', 'pending'),
(2, 'giQfhdKRmk', 1, 'test1@gmail.com', '615-957-4320', 'generalSeller', '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-07-25 17:18:57', 'pending'),
(3, 'q0R8OBADMh', 1, 'vinzha@gmail.com', '615-957-4320', 'generalSeller', '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-04-22 19:21:56', 'pending'),
(4, 'edXFGUd5O0', 1, 'Aaron@gmail.com', '615-957-4320', 'generalSeller', '1307 state street', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-08-27 17:35:10', 'pending'),
(8, 'DHAbK010Mq', 1, 'vedancewear@gmail.com', '615-957-4320', 'generalSeller', '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-05-06 13:12:41', 'pending'),
(9, 'xDkrxob0xy', 1, 'paypal@paypal.com', '615-957-4320', 'generalSeller', '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-05-17 16:26:13', 'pending'),
(10, 'VrUSTz2aig', 1, 'svitlana_bundyk@mail.ru', '734.218.3353', 'generalSeller', '905 Church st apt 7', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-05-24 16:40:30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `sender_message`
--

CREATE TABLE IF NOT EXISTS `sender_message` (
  `sender_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_User_id` int(11) DEFAULT NULL,
  `receiver_email` varchar(150) NOT NULL,
  `receiver_name` varchar(150) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_subject` varchar(200) NOT NULL,
  `sender_username` varchar(100) DEFAULT NULL,
  `sender_user_id` int(11) DEFAULT NULL,
  `sender_message` varchar(400) NOT NULL,
  `message_read` tinyint(1) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`sender_message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `sender_message`
--

INSERT INTO `sender_message` (`sender_message_id`, `receiver_User_id`, `receiver_email`, `receiver_name`, `product_id`, `sender_name`, `sender_email`, `sender_subject`, `sender_username`, `sender_user_id`, `sender_message`, `message_read`, `ts_created`) VALUES
(1, 1, 'vinzha@gmail.com', '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:45:59'),
(2, 1, 'vinzha@gmail.com', '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:48:35'),
(3, 1, 'vinzha@gmail.com', '', 5, 'Vincent Zhang', 'asdfe@gasdf.com', 'asfe', NULL, NULL, 'Whats up?', 0, '2010-08-21 22:49:05'),
(4, 4, 'vinzha1@gmail.com', '', 14, 'proballroomshoes', 'info@professionalballroomshoes.com', 'sdfase', 'proballroomshoes', 1, 'asdfef', 0, '2010-08-31 22:24:46'),
(5, 1, 'vinzha@gmail.com', ' ', 10, 'proballroomshoes', 'info@professionalballroomshoes.com', 'Message good?', 'proballroomshoes', 1, 'is this message good?', 0, '2010-08-31 22:55:02'),
(6, 1, 'vinzha@gmail.com', 'Vincent Zhang', 10, 'proballroomshoes', 'info@professionalballroomshoes.com', 'test message 3', 'proballroomshoes', 1, 'Alright test message 3', 0, '2010-08-31 23:05:44'),
(7, 5, 'vinzha3@gmail.com', NULL, 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'What is this?', 0, '2010-08-31 23:40:02'),
(8, 5, 'vinzha3@gmail.com', NULL, 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'Oh yeah. do you like it?', 0, '2010-08-31 23:46:37'),
(9, 5, 'vinzha3@gmail.com', 'vincent zhang', 10, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: SUdebIvCqffyODZY', 'proballroomshoes', 1, 'asfe', 0, '2010-08-31 23:47:16'),
(10, 4, 'vinzha1@gmail.com', 'vincent zhang', 14, 'proballroomshoes', 'vinzha@gmail.com', 'adfas', 'proballroomshoes', 1, 'adsf', 0, '2010-09-02 17:01:50'),
(11, 4, 'vinzha1@gmail.com', 'vincent zhang', 14, 'Bob', 'bob@umich.edu', 'whats up?', NULL, NULL, 'what', 0, '2010-09-02 17:03:03'),
(12, 1, 'vinzha@gmail.com', 'Vincent Zhang', 10, 'asdf', 'asdf@gmail.com', 'asdfas', NULL, NULL, 'asdfsadf', 0, '2010-09-02 17:03:25'),
(13, 1, 'vinzha@gmail.com', '', 9, 'test1', 'vinzha21321@gmail.com', 'orderID: DGHGSHcYjMQBRCwT', 'test1', 2, 'is this working', 0, '2010-09-29 18:59:50'),
(14, 1, 'vinzha@gmail.com', 'proballroomshoes', 9, 'test1', 'vinzha21321@gmail.com', 'orderID: DGHGSHcYjMQBRCwT', 'test1', 2, 'asdfaef', 0, '2010-09-29 19:01:34'),
(15, 1, 'vinzha@gmail.com', 'proballroomshoes', 10, 'test1', 'vinzha21321@gmail.com', 'orderID: mQlWhoIvRJoPqkpm', 'test1', 2, 'Thank you for your shoes. We love it!', 0, '2010-09-29 19:17:51'),
(16, 4, 'vinzha1@gmail.com', 'test3', 14, 'test1', 'vinzha21321@gmail.com', 'orderID: mQlWhoIvRJoPqkpm', 'test1', 2, 'Please ship this item immediately!', 0, '2010-09-30 00:52:42'),
(17, 2, 'vinzha21321@gmail.com', 'vincent zhang', 7, 'proballroomshoes', 'vinzha@gmail.com', 'orderID: rjuWePgcxlJQMWOD', 'proballroomshoes', 1, 'what do you like about this?', 0, '2010-10-02 18:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `shippingaddress`
--

CREATE TABLE IF NOT EXISTS `shippingaddress` (
  `address_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` bigint(20) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `shippingaddress`
--

INSERT INTO `shippingaddress` (`address_id`, `User_id`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`) VALUES
(1, 2, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(2, 1, '500 east davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(3, 4, '400 east davis', '', 'anna rbor', 'mi', 'usa', '48104'),
(4, 5, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(5, 5, '400 East Davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(11, 3, '200 East Davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(7, 2, '300 east davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(8, 9, '200 east davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(9, 10, '905 Church st apt 7', '', 'ann arbor mi', 'mi', 'usa', '48104'),
(10, 1, '200 East Davis', '', 'ann arbor', 'mi', 'usa', '49102'),
(12, 4, '328 catherine', '', 'ann arbor', 'mi', 'usa', '48104'),
(13, 3, '328 Catherine street', '', 'ann arbor', 'mi', 'france', '48104'),
(14, 5, '500 catherine', '', 'ann arbor', 'mi', 'usa', '48104'),
(15, 5, '200 East Davis', '', 'ann arbor', 'mi', 'usa', '48104'),
(16, 5, '1307 state street', '', 'ann arbor', 'mi', 'usa', '48104'),
(17, 2, '2403 bishop', '#5', 'ann arbor', 'mi', 'us', '48104');

-- --------------------------------------------------------

--
-- Table structure for table `shoes_attributes`
--

CREATE TABLE IF NOT EXISTS `shoes_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `color` varchar(30) NOT NULL,
  `heel` varchar(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `shoes_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_unique_id` varchar(20) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_email` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `total_number_items` smallint(6) NOT NULL,
  `cart_costs` double NOT NULL,
  `total_costs` double NOT NULL,
  `total_shipping_costs` double NOT NULL,
  `reward_points_used` int(11) NOT NULL,
  `reward_amount_deducted` int(11) NOT NULL,
  `reward_points_awarded` int(11) NOT NULL,
  `promotion_code_used` varchar(20) NOT NULL,
  `promotion_amount_deducted` double NOT NULL,
  `final_total_costs` double NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `order_unique_id_2` (`order_unique_id`),
  KEY `order_unique_id` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `order_unique_id`, `buyer_username`, `buyer_id`, `buyer_email`, `buyer_name`, `total_number_items`, `cart_costs`, `total_costs`, `total_shipping_costs`, `reward_points_used`, `reward_amount_deducted`, `reward_points_awarded`, `promotion_code_used`, `promotion_amount_deducted`, `final_total_costs`, `order_shipping_id`, `ts_created`) VALUES
(6, 'tTMsHoVyqQegiQHn', 'test1', 2, 'vinzha21321@gmail.com', 'vincent zhang', 4, 450, 527.8, 83.8, 24, 6, 49, '', 0, 444, 6, '2010-10-02 17:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_profile`
--

CREATE TABLE IF NOT EXISTS `shopping_cart_profile` (
  `shopping_cart_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `order_unique_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_inventory_id` int(11) DEFAULT NULL,
  `product_type` varchar(50) NOT NULL,
  `purchase_type` varchar(20) NOT NULL,
  `uploader_username` varchar(255) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_tag` varchar(100) NOT NULL,
  `product_image_id` int(11) DEFAULT NULL,
  `inventory_attribute_table` varchar(30) NOT NULL,
  `uploader_email` varchar(255) NOT NULL,
  `product_country_origin` varchar(50) NOT NULL,
  `domestic_shipping_rate` double NOT NULL,
  `international_shipping_rate` double NOT NULL,
  `current_shipping_rate` double NOT NULL,
  `product_type_added_to_shopping_cart` varchar(30) NOT NULL,
  `reward_points_awarded` int(11) NOT NULL,
  `backorder_time` varchar(20) NOT NULL,
  `product_price` double NOT NULL,
  `seller_receivable` double NOT NULL,
  `ts_created` datetime NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `buyer_country` varchar(50) NOT NULL,
  PRIMARY KEY (`shopping_cart_profile_id`),
  KEY `order_unique_id` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `shopping_cart_profile`
--

INSERT INTO `shopping_cart_profile` (`shopping_cart_profile_id`, `cart_id`, `order_unique_id`, `product_id`, `product_inventory_id`, `product_type`, `purchase_type`, `uploader_username`, `uploader_id`, `product_name`, `product_tag`, `product_image_id`, `inventory_attribute_table`, `uploader_email`, `product_country_origin`, `domestic_shipping_rate`, `international_shipping_rate`, `current_shipping_rate`, `product_type_added_to_shopping_cart`, `reward_points_awarded`, `backorder_time`, `product_price`, `seller_receivable`, `ts_created`, `order_shipping_id`, `buyer_name`, `buyer_id`, `buyer_username`, `buyer_email`, `buyer_country`) VALUES
(13, 6, 'tTMsHoVyqQegiQHn', 7, NULL, 'Dresses', 'Customizable', 'proballroomshoes', 1, 'Latin competition dress', 'Latin competition dress', 15, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Customize', 8, 'NA', 85, 93.2, '2010-10-02 17:17:23', 6, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(11, 6, 'tTMsHoVyqQegiQHn', 15, 37, 'Shoes', 'Buy_now', 'test1', 2, 'asdfe', 'Ladies latin shoes', NULL, 'shoes', 'vinzha21321@gmail.com', 'usa', 8.95, 20.95, 20.95, 'Inventory', 12, 'NA', 120, 122.95, '2010-10-02 17:17:23', 6, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(12, 6, 'tTMsHoVyqQegiQHn', 3, 12, 'Dresses', 'Buy_now', 'proballroomshoes', 1, 'Dress 1', 'Latin competition dress', 11, 'fullbody', 'vinzha@gmail.com', 'france', 8.95, 20.95, 20.95, 'Inventory', 20, 'NA', 180, 173.95, '2010-10-02 17:17:23', 6, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent'),
(10, 6, 'tTMsHoVyqQegiQHn', 14, 36, 'Shoes', 'Buy_now', 'test3', 4, 'Ladies standard shoes', 'Ladies standard shoes', 24, 'shoes', 'vinzha1@gmail.com', 'usa', 8.95, 20.95, 20.95, 'Inventory', 9, 'NA', 65, 76.2, '2010-10-02 17:17:23', 6, 'vincent zhang', 2, 'test1', 'vinzha21321@gmail.com', 'Independent');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_profile_attribute`
--

CREATE TABLE IF NOT EXISTS `shopping_cart_profile_attribute` (
  `shopping_cart_profile_attribute_id` int(11) NOT NULL,
  `profile_key` varchar(250) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`shopping_cart_profile_attribute_id`,`profile_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart_profile_attribute`
--

INSERT INTO `shopping_cart_profile_attribute` (`shopping_cart_profile_attribute_id`, `profile_key`, `profile_value`) VALUES
(13, 'brand', 'Supadance'),
(13, 'Measurement_body_height', '234'),
(13, 'Measurement_neck', '23'),
(13, 'Measurement_arm_length', '12'),
(12, 'Waist', '61 cm'),
(12, 'Shoulder', '48 cm'),
(11, 'brand', 'Supadance'),
(12, 'sys_fullbody_size', 'XS'),
(12, 'sys_color', 'Pin_stripe'),
(12, 'brand', 'Supadance'),
(12, 'Chest or bust', '71 cm'),
(12, 'Height of wearer', '165 cm'),
(12, 'Hip', '62 cm'),
(12, 'Length of garment', '98 cm'),
(11, 'sys_color', 'Black'),
(11, 'sys_shoe_heel', '1 inch'),
(11, 'sys_shoe_metric', 'BR'),
(11, 'sys_shoe_size', '1.5'),
(10, 'brand', 'Supadance'),
(10, 'sys_color', 'Light_tan'),
(10, 'sys_shoe_heel', '1 inch'),
(10, 'sys_shoe_metric', 'EU'),
(10, 'sys_shoe_size', '38'),
(13, 'Measurement_wrist', '23'),
(13, 'Measurement_armpit_circumference', '234'),
(13, 'Measurement_shoulder', '234'),
(13, 'Measurement_chest_or_bust', '14'),
(13, 'Measurement_shoulder_to_chest_or_bust', '234'),
(13, 'Measurement_waist', '23'),
(13, 'Measurement_shoulder_to_waist', '234'),
(13, 'Measurement_waist_to_floor', '234'),
(13, 'Measurement_hip', '234'),
(13, 'Measurement_inseam', '1'),
(13, 'Measurement_thigh_circumference', '2134'),
(13, 'color', 'Black'),
(13, 'additional_instructions', 'Whats going on?');

-- --------------------------------------------------------

--
-- Table structure for table `size_attribute`
--

CREATE TABLE IF NOT EXISTS `size_attribute` (
  `size_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `product_type_table` varchar(50) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `size_name` varchar(50) NOT NULL,
  `price_adjustment` double NOT NULL,
  PRIMARY KEY (`size_attribute_id`),
  UNIQUE KEY `size_attribute_unique` (`attribute_name`,`product_type_table`,`product_id`,`size_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `size_attribute`
--


-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illnois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'New Hampshire'),
(30, 'New Jersey'),
(31, 'New Mexico'),
(32, 'New York'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'West Virginia'),
(49, 'Wisconsin'),
(50, 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `system_variables`
--

CREATE TABLE IF NOT EXISTS `system_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable_key` varchar(100) NOT NULL,
  `variable_value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `system_variables`
--


-- --------------------------------------------------------

--
-- Table structure for table `universal_dues`
--

CREATE TABLE IF NOT EXISTS `universal_dues` (
  `universal_dues_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `ts_created` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`universal_dues_id`),
  KEY `product_url` (`url`),
  KEY `product_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `universal_dues`
--


-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `university_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `university_name` varchar(255) NOT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `club_number` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=285 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`university_id`, `university_name`, `state_id`, `club_number`) VALUES
(1, '	A Time to Dance 	', NULL, NULL),
(2, '	Academy of Dancesport 	', NULL, NULL),
(3, '	Academy Of Performing And Creative Arts 	', NULL, NULL),
(4, '	Albany	', NULL, NULL),
(5, '	Albert Einstein Academy School 29	', NULL, NULL),
(6, '	Albert Einstein College of Medicine 	', NULL, NULL),
(7, '	Alluring ballroom	', NULL, NULL),
(8, '	American University	', NULL, NULL),
(9, '	Arizona State University 	', NULL, NULL),
(10, '	Art & Style Dance Studio	', NULL, NULL),
(11, '	Arthur Murray - Saratoga 	', NULL, NULL),
(12, '	Arthur Murray - Fishers	', NULL, NULL),
(13, '	Arthur Murray - Saratoga	', NULL, NULL),
(14, '	Arthur Murray-Carmel 	', NULL, NULL),
(15, '	Atlantic Ballroom	', NULL, NULL),
(16, '	Atlantic Ballroom - Brooklyn 	', NULL, NULL),
(17, '	Ballroom Dance Company	', NULL, NULL),
(18, '	Ballroom on 5th Ave 	', NULL, NULL),
(19, '	Baruch college 	', NULL, NULL),
(20, '	Basic Ballroom	', NULL, NULL),
(21, '	Bates College	', NULL, NULL),
(22, '	Battista Dance Studio 	', NULL, NULL),
(23, 'Binghamton Independent', NULL, NULL),
(24, '	Binghamton Un Alumni 	', NULL, NULL),
(25, '	Binghamton University	', NULL, NULL),
(26, '	Boston University	', NULL, NULL),
(27, 'Botsford School of Dance ', NULL, NULL),
(28, '	Bowling Green State University	', NULL, NULL),
(29, '	Brookdale Community College 	', NULL, NULL),
(30, '	Brooklyn College	', NULL, NULL),
(31, '	Brown University 	', NULL, NULL),
(32, '	BYU 	', NULL, NULL),
(33, '	California Institute of Technology  	', NULL, NULL),
(34, '	Calloway Dance Studios 	', NULL, NULL),
(35, '	Cambridge 	', NULL, NULL),
(36, '	Camelot Ballroom 	', NULL, NULL),
(37, '	Capital District Competition Team	', NULL, NULL),
(38, '	Carnegie Mellon University 	', NULL, NULL),
(39, '	Case Western Reserve University	', NULL, NULL),
(40, '	Case Western School of Medicine 	', NULL, NULL),
(41, '	Catholic University of America 	', NULL, NULL),
(42, '	Centerline Dancesport	', NULL, NULL),
(43, '	Central Peidmont Community College	', NULL, NULL),
(44, '	Central Piedmont Community College	', NULL, NULL),
(45, '	Central School 	', NULL, NULL),
(46, '	Centre Ballroom Dancesport	', NULL, NULL),
(47, '	Centre Ballroom Decesport	', NULL, NULL),
(48, 'Champions Dance Center ', NULL, NULL),
(49, '	Charlotte Dancesport	', NULL, NULL),
(50, '	Chesapeake College	', NULL, NULL),
(51, '	Chevy Chase Ballroom	', NULL, NULL),
(52, '	Christopher Newport University	', NULL, NULL),
(53, '	Cinema Ballroom 	', NULL, NULL),
(54, '	Claremont Colleges	', NULL, NULL),
(55, '	Clinton Academy of Fine Arts	', NULL, NULL),
(56, '	College of William and Mary	', NULL, NULL),
(57, '	College of William and Mary Alumni Team	', NULL, NULL),
(58, '	Columbia University	', NULL, NULL),
(59, '	Columbia University Alumni 	', NULL, NULL),
(60, '	Columbus State Community College	', NULL, NULL),
(61, '	Come Dancing Ballroom	', NULL, NULL),
(62, '	Cornell University	', NULL, NULL),
(63, '	Cornell University DanceSport 	', NULL, NULL),
(64, '	Crim Elementary	', NULL, NULL),
(65, '	Crystal Coast Ballroom Academy	', NULL, NULL),
(66, '	Crystal Coast School of the Arts 	', NULL, NULL),
(67, '	Crystal Dansport	', NULL, NULL),
(68, '	Dance 101	', NULL, NULL),
(69, '	Dance Chelsea 	', NULL, NULL),
(70, '	Dance Chelsea New York	', NULL, NULL),
(71, '	Dance Fever	', NULL, NULL),
(72, '	Dance Fusion 	', NULL, NULL),
(73, '	Dance Magic, Oklahoma City	', NULL, NULL),
(74, '	Dance New York 	', NULL, NULL),
(75, '	Dance Passion	', NULL, NULL),
(76, '	Dance Republic 	', NULL, NULL),
(77, '	Dance Zone USA	', NULL, NULL),
(78, '	Dancesport - Manhattan	', NULL, NULL),
(79, '	DanceSport Foundation	', NULL, NULL),
(80, '	Dancing Made Easy	', NULL, NULL),
(81, '	Davidson College	', NULL, NULL),
(82, '	Dominion High School	', NULL, NULL),
(83, '	Dr. Dance 	', NULL, NULL),
(84, '	Drexel University	', NULL, NULL),
(85, '	Dryden Dance Center	', NULL, NULL),
(86, '	Du-Shor Dance Studio 	', NULL, NULL),
(87, '	Duke University	', NULL, NULL),
(88, '	Eastern Kentucky University	', NULL, NULL),
(89, '	Eastern Michigan University	', NULL, NULL),
(90, '	Elan DanceSport Center	', NULL, NULL),
(91, '	Elena Frolova 	', NULL, NULL),
(92, '	Elon University	', NULL, NULL),
(93, '	Emerald Ballroom	', NULL, NULL),
(94, '	Emerald City Ballroom	', NULL, NULL),
(95, '	Eugene and Maria 	', NULL, NULL),
(96, '	Eugene Katsevman	', NULL, NULL),
(97, '	Eugene&Maria	', NULL, NULL),
(98, '	Everybody Dance	', NULL, NULL),
(99, '	Extreme Dancesport	', NULL, NULL),
(100, '	FADS, Albany, New York 	', NULL, NULL),
(101, '	Fairmont State College	', NULL, NULL),
(102, '	Fashion Institute of Technology	', NULL, NULL),
(103, '	Fordham University 	', NULL, NULL),
(104, '	Fred Astaire Hanover, MA 	', NULL, NULL),
(105, '	Fred Astaire Rochester	', NULL, NULL),
(106, '	Fred Astaire Syracuse	', NULL, NULL),
(107, '	Fred Astaire, Latham	', NULL, NULL),
(108, '	Fred Astaire, Upper Montclair, NJ	', NULL, NULL),
(109, '	Fred Astaire. Mt Clair.	', NULL, NULL),
(110, '	George Mason University	', NULL, NULL),
(111, '	George Washington University 	', NULL, NULL),
(112, '	Georgetown University 	', NULL, NULL),
(113, '	Graduate of NYU Law School 	', NULL, NULL),
(114, '	Graduate of NYU Stern Business School 	', NULL, NULL),
(115, '	Hamilton College	', NULL, NULL),
(116, '	Hartwick College	', NULL, NULL),
(117, '	Harvard University 	', NULL, NULL),
(118, '	Harvey Mudd College	', NULL, NULL),
(119, '	Illinois Institute of Technology 	', NULL, NULL),
(120, '	Imperial Dance Club 	', NULL, NULL),
(121, '	Independent	', NULL, NULL),
(122, 'Indiana University ', NULL, NULL),
(123, '	Iowa State University	', NULL, NULL),
(124, '	Ithaca College	', NULL, NULL),
(125, '	Johns Hopkins University	', NULL, NULL),
(126, '	Johnson & Wales	', NULL, NULL),
(127, '	Joseph''s Dance Studio 	', NULL, NULL),
(128, '	Kaiser Dance Sport Club	', NULL, NULL),
(129, '	Kaiser Dancesport 	', NULL, NULL),
(130, '	Kasper Dance Studio	', NULL, NULL),
(131, '	Kent State University 	', NULL, NULL),
(132, '	Kenyon College 	', NULL, NULL),
(133, '	King''s Dance Sport Center	', NULL, NULL),
(134, '	Knox College	', NULL, NULL),
(135, '	Latin Ballroom DC	', NULL, NULL),
(136, '	Latin Fiesta 	', NULL, NULL),
(137, '	Let''s Dance	', NULL, NULL),
(138, '	Lets Dance In Rhythm 	', NULL, NULL),
(139, '	Loyola College 	', NULL, NULL),
(140, '	Magic Ballroom	', NULL, NULL),
(141, '	Massachusetts Bay Community College 	', NULL, NULL),
(142, '	Massachusetts Institute of Technology 	', NULL, NULL),
(143, '	Menchville High School 	', NULL, NULL),
(144, '	Middlebury College 	', NULL, NULL),
(145, '	Modern Steps School of Dance	', NULL, NULL),
(146, '	Monroe Community College 	', NULL, NULL),
(147, '	Montgomery College	', NULL, NULL),
(148, '	Natalia Lemishka	', NULL, NULL),
(149, '	Nazareth College	', NULL, NULL),
(150, '	New England College of Law	', NULL, NULL),
(151, '	New York Film Academy 	', NULL, NULL),
(152, '	New York University	', NULL, NULL),
(153, '	North Carolina State University 	', NULL, NULL),
(154, '	North Carolina State University Alumnus 	', NULL, NULL),
(155, '	Northwestern University 	', NULL, NULL),
(156, '	NY Dancesport Centre 	', NULL, NULL),
(157, '	Nyemchek''s Dance Centre	', NULL, NULL),
(158, '	NYUSABDA 	', NULL, NULL),
(159, '	Ohio State University	', NULL, NULL),
(160, '	Old Dominion University	', NULL, NULL),
(161, '	Olga Barashina	', NULL, NULL),
(162, '	Oxford University, England	', NULL, NULL),
(163, '	Penn State University	', NULL, NULL),
(164, '	Phillips dance kingdom	', NULL, NULL),
(165, '	Phillips Dance Studio 	', NULL, NULL),
(166, '	Philly Dance Sport Academy	', NULL, NULL),
(167, '	Polytechnic University	', NULL, NULL),
(168, '	Princeton 	', NULL, NULL),
(169, '	Promenade Dancesport	', NULL, NULL),
(170, '	Providence High School 	', NULL, NULL),
(171, '	Purdue University 	', NULL, NULL),
(172, '	Queen City Ballroom	', NULL, NULL),
(173, '	Queen of Peace	', NULL, NULL),
(174, '	Rensselaer Polytechnic Institute (RPI) 	', NULL, NULL),
(175, '	Rhode Island College	', NULL, NULL),
(176, '	Rhode Island Dancesport	', NULL, NULL),
(177, '	Richard''s School of Dance	', NULL, NULL),
(178, '	Rising Stars Dance Academy 	', NULL, NULL),
(179, '	Rita Gekhman 	', NULL, NULL),
(180, '	Roberto''s Dance Studio	', NULL, NULL),
(181, '	Rochester Institute of Technology 	', NULL, NULL),
(182, '	Rogers Dance Sport	', NULL, NULL),
(183, '	Rogers Dancesport	', NULL, NULL),
(184, '	Rollins College 	', NULL, NULL),
(185, '	Rose-Hulman Institute of Technology 	', NULL, NULL),
(186, '	Rutgers	', NULL, NULL),
(187, '	Rutgers Alumni 	', NULL, NULL),
(188, '	Saint Mary''s College	', NULL, NULL),
(189, '	Sarah Lawrence College	', NULL, NULL),
(190, '	Sergiev Dancesport	', NULL, NULL),
(191, '	Shepherd University 	', NULL, NULL),
(192, '	Silva Dance	', NULL, NULL),
(193, '	Siti Dance Studio	', NULL, NULL),
(194, '	Smiths Dancing School	', NULL, NULL),
(195, '	Southern Connecticut (SCSU)	', NULL, NULL),
(196, '	Southern Highschool 	', NULL, NULL),
(197, '	Southwest Missouri State University	', NULL, NULL),
(198, '	Spencer Nyemcheck Dance Sport	', NULL, NULL),
(199, '	Spencer & E .Nyemcheck Studio 	', NULL, NULL),
(200, '	Spencer & E Nyemchek Studio	', NULL, NULL),
(201, '	Spencer Nyemchek Dance Sport	', NULL, NULL),
(202, '	Spotlight Dance center	', NULL, NULL),
(203, '	St. John''s University	', NULL, NULL),
(204, '	Stanford University	', NULL, NULL),
(205, '	Stardust Ballroom	', NULL, NULL),
(206, '	Starlite Ballroom	', NULL, NULL),
(207, '	Starlite Dance Center	', NULL, NULL),
(208, '	Steppingout Studios	', NULL, NULL),
(209, '	Strictly Stars	', NULL, NULL),
(210, '	Studio One	', NULL, NULL),
(211, '	SUNY - Purchase	', NULL, NULL),
(212, '	SUNY - Stony Brook	', NULL, NULL),
(213, '	SUNY Geneseo	', NULL, NULL),
(214, '	Syracuse University	', NULL, NULL),
(215, '	Talent Academy 	', NULL, NULL),
(216, '	Tates'' Dance Center 	', NULL, NULL),
(217, '	Team Awesome	', NULL, NULL),
(218, '	Telemark Dancesport 	', NULL, NULL),
(219, '	The Catholic University of America	', NULL, NULL),
(220, '	The Center for Artistic Development 	', NULL, NULL),
(221, '	The Clinton Academy of Performing and Creative Arts	', NULL, NULL),
(222, '	The Juilliard School 	', NULL, NULL),
(223, '	The Ohio State University 	', NULL, NULL),
(224, '	The Ohio State University - DTUD	', NULL, NULL),
(225, '	The University of Akron	', NULL, NULL),
(226, '	Tidewater Community College	', NULL, NULL),
(227, '	Towson University 	', NULL, NULL),
(228, '	Trebun Academy of Dance	', NULL, NULL),
(229, '	Tufts University	', NULL, NULL),
(230, '	Tulane University	', NULL, NULL),
(231, '	UIC 	', NULL, NULL),
(232, '	UNC-Charlotte 	', NULL, NULL),
(233, '	University of Akron	', NULL, NULL),
(234, '	University of Alabama at Birmingham	', NULL, NULL),
(235, '	University of Bridgeport	', NULL, NULL),
(236, '	University of California Irvine 	', NULL, NULL),
(237, '	University of Chicago 	', NULL, NULL),
(238, '	University of Cincinnatti 	', NULL, NULL),
(239, '	University of Connecticut 	', NULL, NULL),
(240, '	University of Delaware	', NULL, NULL),
(241, '	University of Exeter, United Kingdom 	', NULL, NULL),
(242, '	University of Houston - Alumni 	', NULL, NULL),
(243, '	University of Illinois at Urbana Champaign	', NULL, NULL),
(244, '	University of Iowa	', NULL, NULL),
(245, '	University of Kansas	', NULL, NULL),
(246, '	university of kentucky	', NULL, NULL),
(247, '	University of Louisville	', NULL, NULL),
(248, '	University of Maryland at Baltimore	', NULL, NULL),
(249, '	University of Maryland University College	', NULL, NULL),
(250, '	University of Maryland, Baltimore County (UMBC) 	', NULL, NULL),
(251, '	University of Maryland, College Park	', NULL, NULL),
(252, '	University of Massachucettes--Amherst	', NULL, NULL),
(253, '	University of Michigan	', NULL, NULL),
(254, '	University of Minnesota 	', NULL, NULL),
(255, '	University of Missouri - Columbia 	', NULL, NULL),
(256, '	University of North Carolina at Chapel Hill 	', NULL, NULL),
(257, '	University of North Carolina at Charlotte 	', NULL, NULL),
(258, '	University of Notre Dame 	', NULL, NULL),
(259, '	University of Oklahoma	', NULL, NULL),
(260, '	University of Pennsylvania 	', NULL, NULL),
(261, '	University of Rhode Island 	', NULL, NULL),
(262, '	University of South Carolina	', NULL, NULL),
(263, '	University of Toledo 	', NULL, NULL),
(264, '	University of Vermont	', NULL, NULL),
(265, '	University of Virginia 	', NULL, NULL),
(266, '	University of Wisconsin-Madison	', NULL, NULL),
(267, '	Valparaiso University 	', NULL, NULL),
(268, '	Vermont DanceSport Academy 	', NULL, NULL),
(269, '	Vinge Brust Studio, Throop, PA	', NULL, NULL),
(270, '	Virginia Polytechnic Institute and State University	', NULL, NULL),
(271, '	Vlada Martinek 	', NULL, NULL),
(272, '	Wake Forest University	', NULL, NULL),
(273, '	Washington and Lee University	', NULL, NULL),
(274, '	Wayne State University	', NULL, NULL),
(275, '	Wendi Davies	', NULL, NULL),
(276, '	Westchester Ballroom 	', NULL, NULL),
(277, '	William Mason High School	', NULL, NULL),
(278, '	William Paterson University 	', NULL, NULL),
(279, '	Worcester Polytechnic Institute 	', NULL, NULL),
(280, '	Yale 	', NULL, NULL),
(281, '	YCN National 	', NULL, NULL),
(282, '	Youngstown State University 	', NULL, NULL),
(283, 'Independent', NULL, NULL),
(284, 'DancewearRialto', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_body_measurement`
--

CREATE TABLE IF NOT EXISTS `user_body_measurement` (
  `user_body_measurement_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `body_height` int(11) NOT NULL,
  `chest` int(11) NOT NULL,
  `hip` int(11) NOT NULL,
  `length_pants` int(11) NOT NULL,
  `neck` int(11) NOT NULL,
  `shoulder` int(11) NOT NULL,
  `shoulder_to_waist` int(11) NOT NULL,
  `thigh` int(11) NOT NULL,
  `waist` int(11) NOT NULL,
  `waist_floor` int(11) NOT NULL,
  `armpit_circumference` int(11) NOT NULL,
  `arm_length` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`user_body_measurement_id`),
  UNIQUE KEY `User_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_body_measurement`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_compare_list`
--

CREATE TABLE IF NOT EXISTS `user_compare_list` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_table` varchar(30) NOT NULL,
  `ts_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_compare_list_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_compare_list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user_compare_list`
--

INSERT INTO `user_compare_list` (`user_id`, `product_id`, `product_table`, `ts_created`, `user_compare_list_id`) VALUES
(4, 11, 'inventory', '2010-08-24 13:48:21', 19),
(4, 22, 'inventory', '2010-08-24 13:42:31', 18),
(5, 10, 'inventory', '2010-08-23 20:30:41', 15),
(4, 20, 'inventory', '2010-08-24 13:42:31', 16),
(5, 24, 'inventory', '2010-08-23 20:30:41', 13),
(5, 11, 'inventory', '2010-08-23 20:30:41', 12),
(5, 15, 'inventory', '2010-08-23 20:30:41', 11),
(4, 24, 'inventory', '2010-08-24 13:48:21', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE IF NOT EXISTS `user_review` (
  `user_review_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `order_profile_id` int(11) NOT NULL,
  `order_unique_id` varchar(20) NOT NULL,
  `order_product_name` varchar(255) NOT NULL,
  `User_id` int(11) NOT NULL,
  `ts_created` datetime NOT NULL,
  PRIMARY KEY (`user_review_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`user_review_id`, `rating`, `description`, `order_profile_id`, `order_unique_id`, `order_product_name`, `User_id`, `ts_created`) VALUES
(1, '3.50', 'Thank you for the product! fast shipping!', 2, '08dD95KmCIdhxPph', 'Men black Jacket A', 1, '2010-05-04 15:53:43'),
(2, '4.50', 'thanks for the order. fast delivery', 8, 'QPDIGygaiioIUbX1', 'stephanie-men-s-ballroom-shoes-94001', 1, '2010-05-16 23:21:00'),
(3, '5.00', 'This seller shipped fast and the product was amazing. Thank you very much!', 25, '2YZ6ZwV3kEvjSpTV', 'Dance naturals', 1, '2010-05-24 02:27:41'),
(4, '4.50', 'These items are wonderful thank you very much!', 24, 'i2qFrN6bYLEVxXVu', 'Dance naturals', 1, '2010-05-24 02:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referral_id` varchar(10) DEFAULT NULL,
  `referee_id` varchar(10) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `measurement` tinyint(1) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `is_instructor` tinyint(1) DEFAULT NULL,
  `finding_partner` tinyint(1) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `reward_point` int(11) NOT NULL,
  `verification` varchar(15) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `review_count` int(11) NOT NULL,
  `review_average_score` decimal(10,2) NOT NULL,
  `review_total_score` double NOT NULL,
  `ts_created` datetime NOT NULL,
  `ts_last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `referral_id`, `referee_id`, `username`, `password`, `email`, `sex`, `measurement`, `first_name`, `last_name`, `user_type`, `is_instructor`, `finding_partner`, `status`, `reward_point`, `verification`, `type_id`, `review_count`, `review_average_score`, `review_total_score`, `ts_created`, `ts_last_login`) VALUES
(1, NULL, 'IY0phC2BIp', 'proballroomshoes', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha@gmail.com', 'man', 0, 'Vincent', 'Zhang', 'storeSeller', NULL, NULL, 'L', 88, 'unverified', 0, 4, '4.40', 17.5, '2010-04-19 16:41:22', '2010-10-02 17:27:04'),
(2, NULL, 'D1LIEUVhlI', 'test1', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha21321@gmail.com', 'man', 0, 'vincent', 'zhang', 'generalSeller', NULL, NULL, 'L', 72, 'unverified', 0, 0, '0.00', 0, '2010-04-22 17:52:10', '2010-10-02 17:08:46'),
(3, NULL, 'G30L1Plq56', 'test2', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha2@gmail.com', 'man', 0, 'vincent', 'zhang', 'generalSeller', NULL, NULL, 'L', 4, 'unverified', 0, 0, '0.00', 0, '2010-04-22 19:21:10', '2010-09-15 18:56:07'),
(4, NULL, 'ltSewQV1m2', 'test3', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha1@gmail.com', 'woman', 1, 'vincent', 'zhang', 'generalSeller', NULL, NULL, 'L', 32, 'unverified', 0, 0, '0.00', 0, '2010-04-23 04:16:13', '2010-08-31 23:14:54'),
(5, NULL, 'BMsz9v7uCt', 'test4', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha3@gmail.com', 'woman', 1, 'vincent', 'zhang', 'member', NULL, NULL, 'L', 32, 'unverified', 0, 0, '0.00', 0, '2010-04-23 04:18:18', '2010-08-31 23:37:03'),
(7, NULL, 'LcChX2iOHL', 'vinzha', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha4@gmail.com', 'woman', 0, 'vincent', 'zhang', 'member', NULL, NULL, 'L', 16, 'unverified', 0, 0, '0.00', 0, '2010-04-26 19:22:31', '2010-04-26 19:23:29'),
(8, NULL, 'LxS2M4pGa3', 'DancewearRialto', 'e8b1eb4daed8cf3cdd4742ad44a5efd0', 'info@dancewearRialto.com', 'man', 0, 'vincent', 'zhang', 'admin', NULL, NULL, 'L', 16, 'unverified', 0, 0, '0.00', 0, '2010-05-06 13:10:14', '2010-09-29 17:00:55'),
(9, NULL, 'umSpsnTAf9', 'test5', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha5@gmail.com', 'man', 0, 'vincent', 'zhang', 'generalSeller', NULL, NULL, 'L', 2, 'unverified', 0, 0, '0.00', 0, '2010-05-17 16:24:32', '2010-09-28 21:01:28'),
(10, NULL, 'WzGMYDp0cz', 'sbundyk', '0fcd67d925b8eabd967f052cb3b2aa70', 'sbundyk@emich.edu', 'woman', 0, 'Svitlana', 'Bundyk', 'generalSeller', NULL, NULL, 'L', 0, 'unverified', 0, 0, '0.00', 0, '2010-05-24 16:15:42', '2010-06-03 20:07:54'),
(11, NULL, '6MGCGwbqPz', 'test9', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'test9@gmail.com', 'woman', 0, 'vincet', 'zhang', 'member', NULL, NULL, 'L', 16, 'unverified', 0, 0, '0.00', 0, '2010-08-07 19:47:24', '2010-08-07 19:47:40'),
(12, 'BMsz9v7uCt', 'SNu4PZZoVN', 'test10', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'vinzha10@gmail.com', 'woman', 0, 'vincent', 'zhang', 'member', NULL, NULL, 'L', 16, 'unverified', 0, 0, '0.00', 0, '2010-08-23 15:24:01', '2010-08-23 15:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `users_profiles`
--

CREATE TABLE IF NOT EXISTS `users_profiles` (
  `userID` bigint(20) unsigned NOT NULL,
  `profile_key` varchar(225) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`userID`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_profiles`
--

INSERT INTO `users_profiles` (`userID`, `profile_key`, `profile_value`) VALUES
(1, 'affiliation', 'DancewearRialto'),
(1, 'defaultShippingAddress', '10'),
(1, 'experience', 'amature'),
(1, 'hear_about_us', 'other'),
(1, 'registrationIP', '127.0.0.1'),
(2, 'affiliation', 'Independent'),
(2, 'defaultShippingAddress', '17'),
(2, 'experience', 'beginner'),
(2, 'hear_about_us', 'local ballroom community'),
(2, 'registrationIP', '127.0.0.1'),
(3, 'affiliation', 'Independent'),
(3, 'defaultShippingAddress', '11'),
(3, 'experience', 'collegiate'),
(3, 'hear_about_us', 'friends'),
(3, 'registrationIP', '127.0.0.1'),
(4, 'affiliation', 'Independent'),
(4, 'defaultShippingAddress', '3'),
(4, 'experience', 'beginner'),
(4, 'hear_about_us', 'friends'),
(4, 'registrationIP', '::1'),
(5, 'affiliation', 'Independent'),
(5, 'defaultShippingAddress', '15'),
(5, 'experience', 'beginner'),
(5, 'hear_about_us', 'friends'),
(5, 'registrationIP', '::1'),
(7, 'affiliation', '	University of Michigan	'),
(7, 'experience', 'collegiate'),
(7, 'hear_about_us', 'google'),
(7, 'registrationIP', '67.194.4.55'),
(8, 'affiliation', 'DancewearRialto'),
(8, 'experience', 'collegiate'),
(8, 'hear_about_us', 'other'),
(8, 'registrationIP', '67.194.5.249'),
(9, 'affiliation', '	Alluring ballroom	'),
(9, 'defaultShippingAddress', '8'),
(9, 'experience', 'beginner'),
(9, 'hear_about_us', 'facebook'),
(9, 'registrationIP', '67.194.1.160'),
(10, 'affiliation', 'University of Michigan'),
(10, 'defaultShippingAddress', '9'),
(10, 'experience', 'collegiate'),
(10, 'hear_about_us', 'friends'),
(10, 'registrationIP', '67.194.8.101'),
(11, 'affiliation', 'Independent'),
(11, 'experience', 'beginner'),
(11, 'hear_about_us', 'friends'),
(11, 'registrationIP', '127.0.0.1'),
(12, 'affiliation', 'Independent'),
(12, 'experience', 'amature'),
(12, 'hear_about_us', 'friends'),
(12, 'registrationIP', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `users_profiles_images`
--

CREATE TABLE IF NOT EXISTS `users_profiles_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `ranking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_id` (`image_id`),
  KEY `post_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users_profiles_images`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `sellerinformation`
--
ALTER TABLE `sellerinformation`
  ADD CONSTRAINT `SellerInformation_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD CONSTRAINT `users_profiles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
