-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Hazırlanma Vaxtı: 04 Noy, 2010 saat 10:21
-- Server versiyası: 5.1.41
-- PHP Versiyası: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Me'lumat Bazası: `dancerialto`
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
-- Sxemi çıxarılan cedvel `blog_posts`
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
-- Sxemi çıxarılan cedvel `blog_posts_category`
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
-- Sxemi çıxarılan cedvel `blog_posts_images`
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
-- Sxemi çıxarılan cedvel `blog_posts_orders`
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
-- Sxemi çıxarılan cedvel `blog_posts_profile`
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
-- Sxemi çıxarılan cedvel `blog_posts_tags`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `custom_attribute`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `custom_attribute_details`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `fabric_set`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `fabric_set_details`
--


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
-- Sxemi çıxarılan cedvel `image_attribute`
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
-- Sxemi çıxarılan cedvel `inventory_images`
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
-- Sxemi çıxarılan cedvel `inventory_products`
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
-- Sxemi çıxarılan cedvel `inventory_products_profile`
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
-- Sxemi çıxarılan cedvel `measurement_attribute`
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
  `dr_receivable` double NOT NULL,
  `ts_created` datetime NOT NULL,
  `return_allowed` tinyint(1) NOT NULL,
  `product_returned` tinyint(1) NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `buyer_country` varchar(50) NOT NULL,
  `buyer_return_claim_filed` tinyint(1) NOT NULL,
  `buyer_return_claim_filed_date` datetime DEFAULT NULL,
  `buyer_return_claim_approved` tinyint(1) NOT NULL,
  `seller_claim_filed` tinyint(1) NOT NULL,
  `seller_claim_filed_date` datetime DEFAULT NULL,
  `seller_claim_approved` tinyint(1) NOT NULL,
  `cancelled_by_buyer` tinyint(1) NOT NULL,
  `cancelled_by_buyer_date` datetime DEFAULT NULL,
  `cancelled_by_seller` tinyint(1) NOT NULL,
  `cancelled_by_seller_date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_profile_id`),
  KEY `order_unique_id` (`order_unique_id`),
  KEY `order_unique_id_2` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Sxemi çıxarılan cedvel `order_profile`
--

INSERT INTO `order_profile` (`order_profile_id`, `order_id`, `order_unique_id`, `product_id`, `product_inventory_id`, `product_type`, `purchase_type`, `uploader_username`, `uploader_id`, `product_name`, `product_tag`, `product_image_id`, `inventory_attribute_table`, `uploader_email`, `product_country_origin`, `domestic_shipping_rate`, `international_shipping_rate`, `current_shipping_rate`, `product_type_added_to_shopping_cart`, `reward_points_awarded`, `backorder_time`, `product_price`, `seller_receivable`, `dr_receivable`, `ts_created`, `return_allowed`, `product_returned`, `order_shipping_id`, `buyer_name`, `buyer_id`, `buyer_username`, `buyer_email`, `buyer_country`, `buyer_return_claim_filed`, `buyer_return_claim_filed_date`, `buyer_return_claim_approved`, `seller_claim_filed`, `seller_claim_filed_date`, `seller_claim_approved`, `cancelled_by_buyer`, `cancelled_by_buyer_date`, `cancelled_by_seller`, `cancelled_by_seller_date`) VALUES
(1, 1, 'p74689124', 1, 1, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product 1', 'Ladies latin shoes', 1, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-27 16:57:25', 1, 0, 1, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(2, 1, 'p74689124', 2, 2, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product 2', 'Ladies latin shoes', 2, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-27 16:57:25', 1, 0, 1, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(3, 2, 'Y68367721', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-27 19:24:20', 0, 0, 2, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(4, 3, 'b21960628', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-27 19:54:39', 0, 0, 3, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(5, 4, 'l20347934', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-28 01:28:19', 0, 0, 4, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(6, 5, 'i13932594', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-28 02:34:02', 0, 0, 6, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 0, NULL, 0, 0, NULL, 0, 0, NULL, 0, NULL),
(7, 6, 'D60602469', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, 20.25, '2010-10-28 03:02:50', 0, 0, 8, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent', 1, '2010-10-28 06:00:42', 0, 0, NULL, 0, 0, NULL, 0, NULL);

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
-- Sxemi çıxarılan cedvel `order_profile_attribute`
--

INSERT INTO `order_profile_attribute` (`order_profile_attribute_id`, `profile_key`, `profile_value`) VALUES
(1, 'brand', 'Rayrose'),
(1, 'sys_color', 'Light_tan'),
(1, 'sys_shoe_heel', '3 inch'),
(1, 'sys_shoe_metric', 'US'),
(1, 'sys_shoe_size', '7'),
(2, 'brand', 'Supadance'),
(2, 'sys_color', 'Black'),
(2, 'sys_shoe_heel', '70 mm'),
(2, 'sys_shoe_metric', 'EU'),
(2, 'sys_shoe_size', '35'),
(3, 'brand', 'DN'),
(3, 'sys_color', 'Black'),
(3, 'sys_shoe_heel', '1 inch'),
(3, 'sys_shoe_metric', 'EU'),
(3, 'sys_shoe_size', '0'),
(4, 'brand', 'DN'),
(4, 'sys_color', 'Black'),
(4, 'sys_shoe_heel', '1 inch'),
(4, 'sys_shoe_metric', 'EU'),
(4, 'sys_shoe_size', '0'),
(5, 'brand', 'DN'),
(5, 'sys_color', 'Black'),
(5, 'sys_shoe_heel', '1 inch'),
(5, 'sys_shoe_metric', 'EU'),
(5, 'sys_shoe_size', '0'),
(6, 'brand', 'DN'),
(6, 'sys_color', 'Black'),
(6, 'sys_shoe_heel', '1 inch'),
(6, 'sys_shoe_metric', 'EU'),
(6, 'sys_shoe_size', '0'),
(7, 'brand', 'DN'),
(7, 'sys_color', 'Black'),
(7, 'sys_shoe_heel', '1 inch'),
(7, 'sys_shoe_metric', 'EU'),
(7, 'sys_shoe_size', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order_profile_claims`
--

CREATE TABLE IF NOT EXISTS `order_profile_claims` (
  `order_profile_claims_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_profile_id` int(11) NOT NULL,
  `filed_by_type` varchar(20) NOT NULL,
  `filer_name` varchar(100) NOT NULL,
  `filing_reason` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `ts_created` datetime NOT NULL,
  `ts_updated` datetime NOT NULL,
  PRIMARY KEY (`order_profile_claims_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Sxemi çıxarılan cedvel `order_profile_claims`
--

INSERT INTO `order_profile_claims` (`order_profile_claims_id`, `order_profile_id`, `filed_by_type`, `filer_name`, `filing_reason`, `description`, `status`, `ts_created`, `ts_updated`) VALUES
(1, 1, 'buyer', 'bob', 'bad shoes', 'description is bad', 'status is good', '2010-10-28 04:40:02', '2010-10-28 04:40:02'),
(2, 7, 'buyer', 'test1 test1 last', 'Severely damaged', 'asdfasdfaasdfasdf a daf da dsfa', 'UNREVIEWED', '2010-10-28 06:00:42', '2010-10-28 06:00:42');

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
  `product_cancelled_date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_profile_status_and_delivery_id`),
  UNIQUE KEY `order_profile_id` (`order_profile_id`),
  KEY `order_status` (`order_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Sxemi çıxarılan cedvel `order_profile_status_and_delivery`
--

INSERT INTO `order_profile_status_and_delivery` (`order_profile_status_and_delivery_id`, `order_profile_id`, `order_status`, `product_tracking`, `product_tracking_carrier`, `product_shipping_date`, `product_warning_delivery_date`, `product_latest_delivery_date`, `product_delivered_date`, `product_completion_date`, `product_returned`, `product_return_tracking`, `product_return_tracking_carrier`, `product_return_shipping_date`, `product_return_latest_delivery_date`, `product_return_delivered_date`, `product_return_completion_date`, `product_fund_allocation_date`, `product_cancelled_date`) VALUES
(1, 1, 'DELIVERED', '1ZY801R80363222854', 'UPS', '2010-10-27 17:54:51', '2010-10-31 16:57:25', '2010-11-02 16:57:25', '2010-10-27 00:00:00', '2010-11-03 00:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'DELIVERED', '1ZY801R80363222854', 'UPS', '2010-10-27 17:55:09', '2010-10-31 16:57:25', '2010-11-02 16:57:25', '2010-10-27 00:00:00', '2010-11-03 00:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'DELIVERED', '1ZY801R80363222854', 'USPS', '2010-10-27 19:26:03', '2010-10-31 19:24:20', '2010-11-02 19:24:20', '2010-10-27 00:00:00', '2010-11-03 00:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 'BALANCE_REFUNDED', NULL, NULL, NULL, '2010-10-31 19:54:39', '2010-11-02 19:54:39', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 'BALANCE_REFUNDED', NULL, NULL, NULL, '2010-10-01 01:28:19', '2010-10-03 01:28:19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-10-28 01:43:43'),
(6, 6, 'BALANCE_REFUNDED', NULL, NULL, NULL, '2010-11-01 02:34:02', '2010-11-03 02:34:02', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-10-28 02:41:49'),
(7, 7, 'HELD_BY_BUYER_FOR_ARBITRATION', '1ZY801R80363222854', 'UPS', '2010-10-28 03:10:44', '2010-11-01 03:02:50', '2010-11-03 03:02:50', '2010-10-28 00:00:00', '2010-11-04 00:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_profile_status_tracking`
--

CREATE TABLE IF NOT EXISTS `order_profile_status_tracking` (
  `order_profile_status_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_profile_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_changed_date` datetime NOT NULL,
  `message` text,
  PRIMARY KEY (`order_profile_status_tracking_id`),
  KEY `order_profile_id` (`order_profile_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Sxemi çıxarılan cedvel `order_profile_status_tracking`
--

INSERT INTO `order_profile_status_tracking` (`order_profile_status_tracking_id`, `order_profile_id`, `status`, `status_changed_date`, `message`) VALUES
(1, 1, 'SHIPPED', '2010-10-27 17:54:51', 'This product is now shipped and awaits for delivery.'),
(2, 2, 'SHIPPED', '2010-10-27 17:55:09', 'This product is now shipped and awaits for delivery.'),
(3, 1, 'DELIVERED', '2010-10-27 18:23:05', 'This product is now delivered and will wait 7 days before it will be AUTOMATICALLY completed. Please confirm satisfaction or return this item by that time!'),
(4, 2, 'DELIVERED', '2010-10-27 18:23:09', 'This product is now delivered and will wait 7 days before it will be AUTOMATICALLY completed. Please confirm satisfaction or return this item by that time!'),
(5, 3, 'SHIPPED', '2010-10-27 19:26:03', 'This product is now shipped and awaits for delivery.'),
(6, 3, 'DELIVERED', '2010-10-27 19:37:31', 'This product is now delivered and will wait 7 days before it will be AUTOMATICALLY completed. Please confirm satisfaction or return this item by that time!'),
(7, 4, 'CANCELLED_BY_SELLER', '2010-10-27 20:47:20', 'This order is now cancelled by the seller. The amount of this order will be refunded to the buyer.'),
(8, 4, 'BALANCE_REFUNDED', '2010-10-27 21:57:40', 'The amount of this order had been refunded.'),
(9, 5, 'CANCELLED_BY_BUYER', '2010-10-28 01:43:44', 'This order is now cancelled by the buyer. The amount of this order will be refunded to the buyer.'),
(10, 5, 'BALANCE_REFUNDED', '2010-10-28 02:20:43', 'The amount of this order had been refunded.'),
(11, 6, 'CANCELLED_BY_SELLER', '2010-10-28 02:41:49', 'This order is now cancelled by the seller. The amount of this order will be refunded to the buyer.'),
(12, 6, 'BALANCE_REFUNDED', '2010-10-28 02:42:21', 'The amount of this order had been refunded.'),
(13, 7, 'SHIPPED', '2010-10-28 03:10:44', 'This product is now shipped and awaits for delivery.'),
(14, 7, 'DELIVERED', '2010-10-28 03:13:54', 'This product is now delivered and will wait 7 days before it will be AUTOMATICALLY completed. Please confirm satisfaction or return this item by that time!'),
(15, 7, 'HELD_BY_BUYER_FOR_ARBITRATION', '2010-10-28 06:00:42', 'This order is now held for arbitration by the buyer and awaits DanceRialto approval.');

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
-- Sxemi çıxarılan cedvel `order_shipping_address`
--

INSERT INTO `order_shipping_address` (`address_id`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`, `ts_created`) VALUES
(1, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-27 16:57:18'),
(2, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-27 19:24:17'),
(3, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-27 19:54:36'),
(4, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-28 01:28:14'),
(5, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-28 02:33:31'),
(6, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-28 02:33:59'),
(7, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-28 03:02:16'),
(8, '328 catherine', '', 'Ann Arbor', 'MI', 'US', '48104', '2010-10-28 03:02:47');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Sxemi çıxarılan cedvel `orders`
--

INSERT INTO `orders` (`order_id`, `order_unique_id`, `buyer_username`, `buyer_id`, `buyer_email`, `buyer_name`, `total_number_items`, `cart_costs`, `total_costs`, `total_shipping_costs`, `reward_points_used`, `reward_amount_deducted`, `reward_points_awarded`, `promotion_code_used`, `promotion_amount_deducted`, `final_total_costs`, `order_shipping_id`, `ts_created`) VALUES
(1, 'p74689124', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 2, 270, 310.9, 41.9, 4, 1, 32, '', 0, 269, 1, '2010-10-27 16:57:25'),
(2, 'Y68367721', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 155.95, 20.95, 0, 0, 16, '', 0, 445.9, 2, '2010-10-27 19:24:20'),
(3, 'b21960628', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 155.95, 20.95, 0, 0, 16, '', 0, 445.9, 3, '2010-10-27 19:54:39'),
(4, 'l20347934', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 155.95, 20.95, 0, 0, 16, '', 0, 445.9, 4, '2010-10-28 01:28:19'),
(5, 'i13932594', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 154.95, 20.95, 4, 1, 16, '', 0, 134, 6, '2010-10-28 02:34:02'),
(6, 'D60602469', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 154.95, 20.95, 4, 1, 16, '', 0, 134, 8, '2010-10-28 03:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `pending_paypal_cart_to_order`
--

CREATE TABLE IF NOT EXISTS `pending_paypal_cart_to_order` (
  `pending_paypal_cart_to_order_id` int(11) NOT NULL,
  `order_unique_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sxemi çıxarılan cedvel `pending_paypal_cart_to_order`
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
-- Sxemi çıxarılan cedvel `product_colors`
--

INSERT INTO `product_colors` (`product_id`, `Black`, `Pin_stripe`, `Light_tan`, `Dark_tan`, `Brown`, `Silver`, `Gold`, `Gray`, `White`, `Red`, `Pink`, `Orange`, `Yellow`, `Green`, `Cyan`, `Blue`, `Magenta`, `Purple`, `Clear`, `Multicolor`, `Monocolor`) VALUES
(1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_custom_attribute`
--

CREATE TABLE IF NOT EXISTS `product_custom_attribute` (
  `product_custom_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `custom_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`product_custom_attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `product_custom_attribute`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_fabric_set`
--

CREATE TABLE IF NOT EXISTS `product_fabric_set` (
  `product_fabric_set_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `fabric_set_id` int(11) NOT NULL,
  PRIMARY KEY (`product_fabric_set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `product_fabric_set`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Sxemi çıxarılan cedvel `product_images`
--

INSERT INTO `product_images` (`image_id`, `filename`, `name`, `Product_id`, `username`, `ranking`) VALUES
(1, 'Autumn Leaves.jpg', 'product 1', 1, 'proballroomshoes', 1),
(2, 'Desert Landscape.jpg', 'product 2', 2, 'proballroomshoes', 1),
(3, 'Autumn Leaves.jpg', 'product3', 3, 'proballroomshoes', 1),
(4, 'Humpback Whale.jpg', 'product3', 3, 'proballroomshoes', 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sxemi çıxarılan cedvel `product_inventories`
--

INSERT INTO `product_inventories` (`product_inventory_id`, `product_id`, `uploader_id`, `sys_name`, `sys_shoe_metric`, `sys_shoe_size`, `sys_shoe_heel`, `sys_fullbody_size`, `sys_top_size`, `sys_bottom_size`, `sys_price`, `sys_video`, `sys_quantity`, `sys_description`, `sys_conditions`, `sys_color`, `ts_created`) VALUES
(1, 1, 3, '', 'US', 7, '3 inch', NULL, NULL, NULL, 135, NULL, 1, NULL, 'New', 'Light_tan', '2010-10-26 05:06:01'),
(2, 2, 3, '', 'EU', 35, '70 mm', NULL, NULL, NULL, 135, NULL, 1, NULL, 'New', 'Black', '2010-10-26 05:10:02'),
(3, 3, 3, '', 'EU', 0, '1 inch', NULL, NULL, NULL, 135, NULL, 1, NULL, 'New', 'Black', '2010-10-27 18:49:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `product_inventory_images`
--


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
-- Sxemi çıxarılan cedvel `product_inventory_profile`
--


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
-- Sxemi çıxarılan cedvel `product_profiles`
--

INSERT INTO `product_profiles` (`Product_id`, `profile_key`, `profile_value`) VALUES
(1, 'description', '<p>good product</p>'),
(2, 'description', '<p>this product is the best as well</p>'),
(3, 'description', '<p>dasfasdfasdfasdf asdf asd fasd fasd f</p>');

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
-- Sxemi çıxarılan cedvel `product_rating`
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
-- Sxemi çıxarılan cedvel `product_shoes_attributes`
--


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
-- Sxemi çıxarılan cedvel `product_shoes_heel`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `product_shoutouts`
--


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
-- Sxemi çıxarılan cedvel `product_tags`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sxemi çıxarılan cedvel `products`
--

INSERT INTO `products` (`product_id`, `purchase_type`, `product_category`, `inventory_attribute_table`, `product_type`, `product_tag`, `product_price_range`, `domestic_shipping_rate`, `international_shipping_rate`, `uploader_id`, `uploader_username`, `uploader_network`, `uploader_email`, `url`, `name`, `price`, `on_sale`, `sales_price`, `brand`, `inventory_reference`, `uniqueIdentifierForJS`, `return_allowed`, `flagged`, `ts_created`, `status`, `listing_type`, `new`, `video_youtube`, `reward_point`, `backorder_time`, `social_usage`, `competition_usage`, `last_status_change`) VALUES
(1, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 7.95, 20.95, 3, 'proballroomshoes', 'usa', 'info@proballroomshoes.com', 'product-1', 'product 1', 135, 0, NULL, 'Rayrose', 'hiathoucec', 'hecrasliaj', 1, 0, '2010-10-26 05:05:55', 'Listed', NULL, 0, '', 16, 'NA', 'on', 'on', '2010-10-26 05:05:55'),
(2, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 7.95, 20.95, 3, 'proballroomshoes', 'usa', 'info@proballroomshoes.com', 'product-2', 'product 2', 135, 0, NULL, 'Supadance', 'wrouuiphio', 'stibitiawi', 1, 0, '2010-10-26 05:10:00', 'Listed', NULL, 0, '', 16, 'NA', 'off', 'on', '2010-10-26 05:10:00'),
(3, 'Buy_now', 'Women', 'shoes', 'Shoes', 'Ladies latin shoes', 'price_category_2', 7.95, 20.95, 3, 'proballroomshoes', 'usa', 'info@proballroomshoes.com', 'product3', 'product3', 135, 0, NULL, 'DN', 'crouliavac', 'paikocicle', 0, 0, '2010-10-27 18:49:19', 'Listed', NULL, 0, '', 16, 'NA', 'off', 'on', '2010-10-27 18:49:19');

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
-- Sxemi çıxarılan cedvel `promotions_profile`
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
-- Sxemi çıxarılan cedvel `promotions_tags`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Sxemi çıxarılan cedvel `receiver_message`
--

INSERT INTO `receiver_message` (`receiver_message_id`, `receiver_User_id`, `receiver_email`, `receiver_username`, `receiver_name`, `product_id`, `sender_name`, `sender_email`, `sender_subject`, `sender_username`, `sender_user_id`, `sender_message`, `message_read`, `ts_created`) VALUES
(1, 2, 'test@gmail.com', NULL, 'test1 test1 last', 1, 'proballroomshoes', 'info@proballroomshoes.com', 'orderID: yVRBSUAAlPBprvqA', 'proballroomshoes', 3, 'Hi this item is shipped', 0, '2010-10-26 17:30:04'),
(2, 2, 'test@gmail.com', NULL, 'test1 test1 last', 3, 'proballroomshoes', 'info@proballroomshoes.com', 'orderID: b21960628', 'proballroomshoes', 3, 'asdfase', 0, '2010-10-27 20:31:01');

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
-- Sxemi çıxarılan cedvel `reward_point_tracking`
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
-- Sxemi çıxarılan cedvel `search_clubs`
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
-- Sxemi çıxarılan cedvel `sellerinformation`
--

INSERT INTO `sellerinformation` (`User_id`, `unique_identifier`, `verified`, `paypal_email`, `phone_number`, `type`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`, `items_description`, `store_description`, `ts_created`, `status`) VALUES
(1, 'B6zgqfs6jF', 1, 'DanceRialto@gmail.com', '615-957-4320', 'generalSeller', '328 catherine st', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-10-25 22:10:08', 'pending'),
(3, 'QIW4rboQ6l', 1, 'info@professionalballroomshoes.com', '6159574320', 'generalSeller', '328 Catherine St', '', 'ann arbor', 'mi', 'usa', '48104', 'no items description', 'no store description', '2010-10-26 04:55:00', 'pending');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Sxemi çıxarılan cedvel `sender_message`
--

INSERT INTO `sender_message` (`sender_message_id`, `receiver_User_id`, `receiver_email`, `receiver_name`, `product_id`, `sender_name`, `sender_email`, `sender_subject`, `sender_username`, `sender_user_id`, `sender_message`, `message_read`, `ts_created`) VALUES
(1, 2, 'test@gmail.com', 'test1 test1 last', 3, 'proballroomshoes', 'info@proballroomshoes.com', 'orderID: b21960628', 'proballroomshoes', 3, 'asdfase', 0, '2010-10-27 20:31:01');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sxemi çıxarılan cedvel `shippingaddress`
--

INSERT INTO `shippingaddress` (`address_id`, `User_id`, `address_one`, `address_two`, `city`, `state`, `country`, `zip`) VALUES
(1, 2, 'test1 catherine', '', 'ann arbor', 'mi', 'usa', '48104'),
(2, 2, 'test1 catherine', '', 'ann arbor', 'mi', 'us', '48104'),
(3, 2, '328 catherine', '', 'ann arbor', 'mi', 'us', '48104');

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
-- Sxemi çıxarılan cedvel `shoes_attributes`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Sxemi çıxarılan cedvel `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `order_unique_id`, `buyer_username`, `buyer_id`, `buyer_email`, `buyer_name`, `total_number_items`, `cart_costs`, `total_costs`, `total_shipping_costs`, `reward_points_used`, `reward_amount_deducted`, `reward_points_awarded`, `promotion_code_used`, `promotion_amount_deducted`, `final_total_costs`, `order_shipping_id`, `ts_created`) VALUES
(24, 'z03914207', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 155.95, 20.95, 0, 0, 16, '', 0, 445.9, 5, '2010-10-28 02:33:31'),
(26, 'M40565868', 'test1', 2, 'test@gmail.com', 'test1 test1 last', 1, 135, 154.95, 20.95, 4, 1, 16, '', 0, 134, 7, '2010-10-28 03:02:16');

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
  `return_allowed` tinyint(1) NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_username` varchar(255) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `buyer_country` varchar(50) NOT NULL,
  PRIMARY KEY (`shopping_cart_profile_id`),
  KEY `order_unique_id` (`order_unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Sxemi çıxarılan cedvel `shopping_cart_profile`
--

INSERT INTO `shopping_cart_profile` (`shopping_cart_profile_id`, `cart_id`, `order_unique_id`, `product_id`, `product_inventory_id`, `product_type`, `purchase_type`, `uploader_username`, `uploader_id`, `product_name`, `product_tag`, `product_image_id`, `inventory_attribute_table`, `uploader_email`, `product_country_origin`, `domestic_shipping_rate`, `international_shipping_rate`, `current_shipping_rate`, `product_type_added_to_shopping_cart`, `reward_points_awarded`, `backorder_time`, `product_price`, `seller_receivable`, `ts_created`, `return_allowed`, `order_shipping_id`, `buyer_name`, `buyer_id`, `buyer_username`, `buyer_email`, `buyer_country`) VALUES
(46, 26, 'M40565868', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, '2010-10-28 03:02:16', 0, 7, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent'),
(44, 24, 'z03914207', 3, 3, 'Shoes', 'Buy_now', 'proballroomshoes', 3, 'product3', 'Ladies latin shoes', 3, 'shoes', 'info@proballroomshoes.com', 'usa', 7.95, 20.95, 20.95, 'Inventory', 16, 'NA', 135, 135.7, '2010-10-28 02:33:31', 0, 5, 'test1 test1 last', 2, 'test1', 'test@gmail.com', 'Independent');

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
-- Sxemi çıxarılan cedvel `shopping_cart_profile_attribute`
--

INSERT INTO `shopping_cart_profile_attribute` (`shopping_cart_profile_attribute_id`, `profile_key`, `profile_value`) VALUES
(46, 'brand', 'DN'),
(46, 'sys_color', 'Black'),
(46, 'sys_shoe_heel', '1 inch'),
(46, 'sys_shoe_metric', 'EU'),
(46, 'sys_shoe_size', '0'),
(44, 'brand', 'DN'),
(44, 'sys_color', 'Black'),
(44, 'sys_shoe_heel', '1 inch'),
(44, 'sys_shoe_metric', 'EU'),
(44, 'sys_shoe_size', '0');

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
-- Sxemi çıxarılan cedvel `size_attribute`
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
-- Sxemi çıxarılan cedvel `states`
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
-- Sxemi çıxarılan cedvel `system_variables`
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
-- Sxemi çıxarılan cedvel `universal_dues`
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
-- Sxemi çıxarılan cedvel `university`
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
-- Table structure for table `user_account_balance_summary`
--

CREATE TABLE IF NOT EXISTS `user_account_balance_summary` (
  `user_account_balance_summary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `available_reward_points` int(11) NOT NULL,
  `ledger_reward_points` int(11) NOT NULL,
  `available_balance` double NOT NULL,
  `ledger_balance` double NOT NULL,
  PRIMARY KEY (`user_account_balance_summary_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Sxemi çıxarılan cedvel `user_account_balance_summary`
--

INSERT INTO `user_account_balance_summary` (`user_account_balance_summary_id`, `user_id`, `available_reward_points`, `ledger_reward_points`, `available_balance`, `ledger_balance`) VALUES
(2, 2, 0, 72, 467.85, 467.85),
(3, 3, 8, 8, 0, 542.8),
(4, 1, 0, 0, 0, 81);

-- --------------------------------------------------------

--
-- Table structure for table `user_account_balance_withdraw_tracking`
--

CREATE TABLE IF NOT EXISTS `user_account_balance_withdraw_tracking` (
  `user_account_balance_withdraw_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance_withdraw_amount` double NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_of_request` datetime NOT NULL,
  `date_processed` datetime NOT NULL,
  PRIMARY KEY (`user_account_balance_withdraw_tracking_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `user_account_balance_withdraw_tracking`
--


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
-- Sxemi çıxarılan cedvel `user_body_measurement`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sxemi çıxarılan cedvel `user_compare_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_pending_reward_point_and_balance_tracking`
--

CREATE TABLE IF NOT EXISTS `user_pending_reward_point_and_balance_tracking` (
  `user_pending_reward_point_and_balance_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tracking_type` varchar(40) NOT NULL,
  `caused_by_type` varchar(25) NOT NULL,
  `from_order_id` varchar(20) DEFAULT NULL,
  `from_order_profile_id` int(11) DEFAULT NULL,
  `caused_by_user_id` int(11) DEFAULT NULL,
  `added_reward_points` int(11) DEFAULT NULL,
  `deducted_reward_points` int(11) DEFAULT NULL,
  `added_dollar_amount` double DEFAULT NULL,
  `deducted_dollar_amount` double DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `ts_updated` datetime NOT NULL,
  PRIMARY KEY (`user_pending_reward_point_and_balance_tracking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Sxemi çıxarılan cedvel `user_pending_reward_point_and_balance_tracking`
--

INSERT INTO `user_pending_reward_point_and_balance_tracking` (`user_pending_reward_point_and_balance_tracking_id`, `user_id`, `tracking_type`, `caused_by_type`, `from_order_id`, `from_order_profile_id`, `caused_by_user_id`, `added_reward_points`, `deducted_reward_points`, `added_dollar_amount`, `deducted_dollar_amount`, `status`, `description`, `date`, `ts_updated`) VALUES
(1, 2, 'REWARD_DEDUCTION', 'from_order_id', 'p74689124', NULL, NULL, NULL, 4, NULL, NULL, 'PENDING', 'Reward points used for the purchase of order id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(2, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 1, NULL, 16, NULL, NULL, NULL, 'PENDING', 'Reward points awarded for the purchase of product 1 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(3, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 1, NULL, NULL, NULL, 135.7, NULL, 'PENDING', 'Balance addition from the sale of product 1 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(4, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 1, NULL, NULL, NULL, 20.25, NULL, 'PENDING', 'Balance addition from the sale of product 1 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(5, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 2, NULL, 16, NULL, NULL, NULL, 'PENDING', 'Reward points awarded for the purchase of product 2 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(6, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 2, NULL, NULL, NULL, 135.7, NULL, 'PENDING', 'Balance addition from the sale of product 2 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(7, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 2, NULL, NULL, NULL, 20.25, NULL, 'PENDING', 'Balance addition from the sale of product 2 in order Id: p74689124', '2010-10-27 16:57:25', '2010-10-27 16:57:25'),
(8, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 3, NULL, 16, NULL, NULL, NULL, 'PENDING', 'Reward points awarded for the purchase of product3 in order Id: Y68367721', '2010-10-27 19:24:20', '2010-10-27 19:24:20'),
(9, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 3, NULL, NULL, NULL, 135.7, NULL, 'PENDING', 'Balance addition from the sale of product3 in order Id: Y68367721', '2010-10-27 19:24:20', '2010-10-27 19:24:20'),
(10, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 3, NULL, NULL, NULL, 20.25, NULL, 'PENDING', 'Balance addition from the sale of product3 in order Id: Y68367721', '2010-10-27 19:24:20', '2010-10-27 19:24:20'),
(11, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 4, NULL, 16, NULL, NULL, NULL, 'CANCELLED', 'Reward points awarded for the purchase of product3 in order Id: b21960628', '2010-10-27 19:54:39', '2010-10-27 21:57:41'),
(12, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 4, NULL, NULL, NULL, 135.7, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: b21960628', '2010-10-27 19:54:39', '2010-10-27 21:57:41'),
(13, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 4, NULL, NULL, NULL, 20.25, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: b21960628', '2010-10-27 19:54:39', '2010-10-27 21:57:41'),
(14, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 4, NULL, NULL, NULL, 155.95, NULL, 'POSTED', 'Balance addition from the refund of product3 in order Id: b21960628', '2010-10-27 21:57:40', '2010-10-27 21:57:40'),
(15, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 5, NULL, 16, NULL, NULL, NULL, 'CANCELLED', 'Reward points awarded for the purchase of product3 in order Id: l20347934', '2010-10-28 01:28:19', '2010-10-28 02:20:43'),
(16, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 5, NULL, NULL, NULL, 135.7, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: l20347934', '2010-10-28 01:28:19', '2010-10-28 02:20:43'),
(17, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 5, NULL, NULL, NULL, 20.25, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: l20347934', '2010-10-28 01:28:19', '2010-10-28 02:20:43'),
(18, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 5, NULL, NULL, NULL, 155.95, NULL, 'POSTED', 'Balance addition from the refund of product3 in order Id: l20347934', '2010-10-28 02:20:43', '2010-10-28 02:20:43'),
(19, 2, 'REWARD_DEDUCTION', 'from_order_id', 'i13932594', NULL, NULL, NULL, 4, NULL, NULL, 'CANCELLED', 'Reward points used for the purchase of order id: i13932594', '2010-10-28 02:34:02', '2010-10-28 02:42:21'),
(20, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 6, NULL, 16, NULL, NULL, NULL, 'CANCELLED', 'Reward points awarded for the purchase of product3 in order Id: i13932594', '2010-10-28 02:34:02', '2010-10-28 02:42:21'),
(21, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 6, NULL, NULL, NULL, 135.7, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: i13932594', '2010-10-28 02:34:02', '2010-10-28 02:42:21'),
(22, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 6, NULL, NULL, NULL, 20.25, NULL, 'CANCELLED', 'Balance addition from the sale of product3 in order Id: i13932594', '2010-10-28 02:34:02', '2010-10-28 02:42:21'),
(23, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 6, NULL, NULL, NULL, 155.95, NULL, 'POSTED', 'Balance addition from the refund of product3 in order Id: i13932594', '2010-10-28 02:42:21', '2010-10-28 02:42:21'),
(24, 2, 'REWARD_DEDUCTION', 'from_order_id', 'D60602469', NULL, NULL, NULL, 4, NULL, NULL, 'PENDING', 'Reward points used for the purchase of order id: D60602469', '2010-10-28 03:02:50', '2010-10-28 03:02:50'),
(25, 2, 'REWARD_ADDITION', 'from_order_profile_id', NULL, 7, NULL, 16, NULL, NULL, NULL, 'PENDING', 'Reward points awarded for the purchase of product3 in order Id: D60602469', '2010-10-28 03:02:50', '2010-10-28 03:02:50'),
(26, 3, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 7, NULL, NULL, NULL, 135.7, NULL, 'PENDING', 'Balance addition from the sale of product3 in order Id: D60602469', '2010-10-28 03:02:50', '2010-10-28 03:02:50'),
(27, 1, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 7, NULL, NULL, NULL, 20.25, NULL, 'PENDING', 'Balance addition from the sale of product3 in order Id: D60602469', '2010-10-28 03:02:50', '2010-10-28 03:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_posted_reward_point_and_balance_tracking`
--

CREATE TABLE IF NOT EXISTS `user_posted_reward_point_and_balance_tracking` (
  `user_posted_reward_point_and_balance_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_pending_reward_point_and_balance_tracking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_type` varchar(40) NOT NULL,
  `caused_by_type` varchar(25) NOT NULL,
  `from_order_id` varchar(20) DEFAULT NULL,
  `from_order_profile_id` int(11) DEFAULT NULL,
  `caused_by_user_id` int(11) DEFAULT NULL,
  `added_reward_points` int(11) DEFAULT NULL,
  `deducted_reward_points` int(11) DEFAULT NULL,
  `added_dollar_amount` double DEFAULT NULL,
  `deducted_dollar_amount` double DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`user_posted_reward_point_and_balance_tracking_id`),
  UNIQUE KEY `user_pending_reward_point_and_balance_tracking_id` (`user_pending_reward_point_and_balance_tracking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sxemi çıxarılan cedvel `user_posted_reward_point_and_balance_tracking`
--

INSERT INTO `user_posted_reward_point_and_balance_tracking` (`user_posted_reward_point_and_balance_tracking_id`, `user_pending_reward_point_and_balance_tracking_id`, `user_id`, `tracking_type`, `caused_by_type`, `from_order_id`, `from_order_profile_id`, `caused_by_user_id`, `added_reward_points`, `deducted_reward_points`, `added_dollar_amount`, `deducted_dollar_amount`, `description`, `date`) VALUES
(1, 14, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 4, NULL, NULL, NULL, 155.95, NULL, 'Balance addition from the refund of product3 in order Id: b21960628', '2010-10-27 21:57:40'),
(2, 18, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 5, NULL, NULL, NULL, 155.95, NULL, 'Balance addition from the refund of product3 in order Id: l20347934', '2010-10-28 02:20:43'),
(3, 23, 2, 'BALANCE_ADDITION', 'from_order_profile_id', NULL, 6, NULL, NULL, NULL, 155.95, NULL, 'Balance addition from the refund of product3 in order Id: i13932594', '2010-10-28 02:42:21');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Sxemi çıxarılan cedvel `user_review`
--

INSERT INTO `user_review` (`user_review_id`, `rating`, `description`, `order_profile_id`, `order_unique_id`, `order_product_name`, `User_id`, `ts_created`) VALUES
(1, '4.50', 'I have received this pair of shoes. thank you very much!', 1, 'yrVPinrcucPDQwbG', 'product 2', 3, '2010-10-26 05:52:11'),
(2, '4.50', 'I don''t like this one however', 2, 'yrVPinrcucPDQwbG', 'product 1', 3, '2010-10-26 05:52:51'),
(3, '5.00', 'good product', 3, 'qWbOWqKvbDOgPJXL', 'product 1', 3, '2010-10-26 16:09:51'),
(4, '4.00', 'This is the best', 4, 'qWbOWqKvbDOgPJXL', 'product 2', 3, '2010-10-26 16:13:26'),
(5, '4.50', 'This item didn''t fit', 5, 'LAyiYTicVkxBfboD', 'product 1', 3, '2010-10-26 16:19:53'),
(6, '5.00', 'yeah. this didn''t fit either', 6, 'LAyiYTicVkxBfboD', 'product 2', 3, '2010-10-26 16:21:22'),
(7, '4.50', 'Thanks for this item!', 1, 'yVRBSUAAlPBprvqA', 'product 1', 3, '2010-10-26 17:31:34'),
(8, '4.50', 'I am sorry, this item did not fit', 2, 'yVRBSUAAlPBprvqA', 'product 2', 3, '2010-10-26 17:31:58'),
(9, '5.00', 'asdf', 3, 'TRtARzYXtjRuZMxB', 'product 1', 3, '2010-10-26 19:07:10'),
(10, '5.00', 'asdfa', 4, 'TRtARzYXtjRuZMxB', 'product 2', 3, '2010-10-26 19:07:17'),
(11, '5.00', 'asdf', 5, 'kzsWuEtDlnxsupya', 'product 1', 3, '2010-10-26 19:15:24'),
(12, '5.00', 'asdfsadf', 6, 'kzsWuEtDlnxsupya', 'product 2', 3, '2010-10-26 19:15:30'),
(13, '5.00', 'adf', 7, 'iNzdNffplPOQsBXu', 'product 1', 3, '2010-10-26 19:52:20'),
(14, '5.00', 'adsfadf', 8, 'iNzdNffplPOQsBXu', 'product 2', 3, '2010-10-26 19:52:27'),
(15, '4.50', 'asdf', 1, 'G33847818-2585', 'product 1', 3, '2010-10-27 02:55:46'),
(16, '4.00', 'asdf', 2, 'G33847818-2585', 'product 2', 3, '2010-10-27 02:55:56'),
(17, '5.00', '', 3, 'N97773817-1083', 'product 1', 3, '2010-10-27 03:04:38'),
(18, '5.00', '', 4, 'N97773817-1083', 'product 2', 3, '2010-10-27 03:04:44'),
(19, '5.00', '', 5, 'q56083293-4758', 'product 1', 3, '2010-10-27 03:11:50'),
(20, '5.00', '', 6, 'q56083293-4758', 'product 2', 3, '2010-10-27 03:11:54'),
(21, '5.00', '', 9, 'C09384434', 'product 1', 3, '2010-10-27 03:40:46'),
(22, '5.00', '', 10, 'C09384434', 'product 2', 3, '2010-10-27 03:40:51'),
(23, '5.00', '', 11, 'S23600484', 'product 1', 3, '2010-10-27 03:47:12'),
(24, '4.50', '', 12, 'S23600484', 'product 2', 3, '2010-10-27 03:47:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sxemi çıxarılan cedvel `users`
--

INSERT INTO `users` (`userID`, `referral_id`, `referee_id`, `username`, `password`, `email`, `sex`, `measurement`, `first_name`, `last_name`, `user_type`, `is_instructor`, `finding_partner`, `status`, `reward_point`, `verification`, `type_id`, `review_count`, `review_average_score`, `review_total_score`, `ts_created`, `ts_last_login`) VALUES
(1, NULL, '1OpbfHgbDh', 'DanceRialto', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'DanceRialto@gmail.com', 'man', 0, 'Vincent', 'Zhang', 'admin', NULL, NULL, 'L', 0, 'unverified', 0, 0, '0.00', 0, '2010-10-25 22:09:15', '2010-10-27 19:34:40'),
(2, NULL, 'NT0gL40zrs', 'test1', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'test@gmail.com', 'man', 0, 'test1', 'test1 last', 'member', NULL, NULL, 'L', 0, 'unverified', 0, 0, '0.00', 0, '2010-10-26 04:37:03', '2010-10-27 16:29:06'),
(3, NULL, 'L6EGeMksUV', 'proballroomshoes', '8768c3f0cb7ee5dc6ea1eac22ddb96b2', 'info@proballroomshoes.com', 'man', 0, 'vincent', 'zhang', 'generalSeller', NULL, NULL, 'L', 0, 'unverified', 0, 24, '4.58', 114.5, '2010-10-26 04:40:50', '2010-10-27 19:32:03');

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
-- Sxemi çıxarılan cedvel `users_profiles`
--

INSERT INTO `users_profiles` (`userID`, `profile_key`, `profile_value`) VALUES
(1, 'affiliation', 'Independent'),
(1, 'experience', 'amature'),
(1, 'hear_about_us', 'other'),
(1, 'registrationIP', '127.0.0.1'),
(2, 'affiliation', 'Independent'),
(2, 'defaultShippingAddress', '3'),
(2, 'experience', 'beginner'),
(2, 'hear_about_us', 'yahoo'),
(2, 'registrationIP', '::1'),
(3, 'affiliation', 'Independent'),
(3, 'experience', 'beginner'),
(3, 'hear_about_us', 'yahoo'),
(3, 'registrationIP', '::1');

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
-- Sxemi çıxarılan cedvel `users_profiles_images`
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
