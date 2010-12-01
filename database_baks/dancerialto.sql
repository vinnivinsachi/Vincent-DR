-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2010 at 11:00 PM
-- Server version: 5.1.50
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dancerialto`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountrewardpointsandbalancesummary`
--

CREATE TABLE IF NOT EXISTS `accountrewardpointsandbalancesummary` (
  `accountRewardPointsAndBalanceSummaryID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `availableRewardPoints` int(11) NOT NULL,
  `ledgerRewardPoints` int(11) NOT NULL,
  `availableBalance` double NOT NULL,
  `ledgerBalance` double NOT NULL,
  PRIMARY KEY (`accountRewardPointsAndBalanceSummaryID`),
  UNIQUE KEY `user_id` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accountrewardpointsandbalancesummary`
--


-- --------------------------------------------------------

--
-- Table structure for table `exampleProfiles`
--

CREATE TABLE IF NOT EXISTS `exampleProfiles` (
  `profileID` int(11) NOT NULL AUTO_INCREMENT,
  `profileKey` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `profileValue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`profileID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `exampleProfiles`
--

INSERT INTO `exampleProfiles` (`profileID`, `profileKey`, `profileValue`, `userID`) VALUES
(1, 'color', 'blue', 64),
(2, 'size', 'small', 64);

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE IF NOT EXISTS `productimages` (
  `productImageID` int(11) NOT NULL AUTO_INCREMENT,
  `sourceName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sourceTypeTitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sourceTypeName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sourceID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL,
  `flagged` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`productImageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `productimages`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productID` bigint(20) NOT NULL AUTO_INCREMENT,
  `productUniqueID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `purchaseType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `productCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `inventoryAttributeTable` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `productTag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `productPriceRange` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `domesticShippingRate` double NOT NULL,
  `internationalShippingRate` float DEFAULT NULL,
  `sellerType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sellerDisplayName` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sellerName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `onSale` tinyint(1) NOT NULL,
  `salesPrice` double DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `returnAllowed` tinyint(1) NOT NULL,
  `flagged` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `listingType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `videoYoutube` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rewardPoint` int(11) NOT NULL,
  `backorderTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `socialUsage` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `competitionUsage` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `lastStatusChange` datetime NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productUniqueID`, `purchaseType`, `productCategory`, `inventoryAttributeTable`, `productTag`, `productPriceRange`, `domesticShippingRate`, `internationalShippingRate`, `sellerType`, `sellerDisplayName`, `sellerName`, `url`, `name`, `price`, `onSale`, `salesPrice`, `brand`, `returnAllowed`, `flagged`, `dateCreated`, `status`, `listingType`, `videoYoutube`, `rewardPoint`, `backorderTime`, `socialUsage`, `competitionUsage`, `lastStatusChange`) VALUES
(36, '0', 'CUSTOMIZE', 'WOMEN', 'shoes', 'Ladies latin shoes', 'productPrice1', 8.95, 12.95, 'asdfe', 'professional ballroom shoes - Ann Arbor', 'professional-ballroom-shoes-ann-arbor', 'asdfe', 'asdfe', 65.95, 0, NULL, 'DanceNaturals', 1, 0, '2010-11-28 04:16:35', 'UNLISTED', NULL, NULL, 4, '5 weeks', '1', '1', '2010-11-28 04:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `storeID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeUniqueID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `storeName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `storeDisplayName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `defaultShippingAddressID` int(11) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `storePhone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `storeFax` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `storeEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`storeID`),
  UNIQUE KEY `storeUniqueID` (`storeUniqueID`),
  KEY `storeName` (`storeName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeID`, `storeUniqueID`, `storeName`, `storeDisplayName`, `dateCreated`, `defaultShippingAddressID`, `dateUpdated`, `storePhone`, `storeFax`, `storeEmail`) VALUES
(3, 'kGyCfAxLxB', 'dance-wear-ann-arbor', 'Dance  Wear - Ann Arbor', '2010-11-18 23:53:00', 1, '2010-11-18 23:53:00', '6159574320', '6159574320', 'vinhza@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `storesShippingAddresses`
--

CREATE TABLE IF NOT EXISTS `storesShippingAddresses` (
  `shippingAddressID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeID` bigint(20) NOT NULL,
  `addressOne` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressTwo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`shippingAddressID`),
  KEY `storeID` (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `storesShippingAddresses`
--

INSERT INTO `storesShippingAddresses` (`shippingAddressID`, `storeID`, `addressOne`, `addressTwo`, `city`, `state`, `country`, `zip`, `dateCreated`, `dateUpdated`) VALUES
(1, 3, 'Vincent Street', 'Apt 5', 'Ann Arbor', 'MI', 'USA', '48104', '2010-11-27 00:40:05', '2010-11-27 00:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `storesUsersLinks`
--

CREATE TABLE IF NOT EXISTS `storesUsersLinks` (
  `linkID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeID` bigint(20) unsigned NOT NULL,
  `userID` bigint(20) unsigned NOT NULL,
  `linkRole` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`linkID`),
  KEY `userID` (`userID`),
  KEY `storeID` (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `storesUsersLinks`
--

INSERT INTO `storesUsersLinks` (`linkID`, `storeID`, `userID`, `linkRole`) VALUES
(1, 3, 64, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `userPendingRewardPointAndBalanceTracking`
--

CREATE TABLE IF NOT EXISTS `userPendingRewardPointAndBalanceTracking` (
  `userPendingRewardPointAndBalanceTrackingID` int(11) NOT NULL AUTO_INCREMENT,
  `userPendingRewardPointAndBalanceTrackingUniqueID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userID` int(11) NOT NULL,
  `trackingType` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `causedByType` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `fromOrderID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fromOrderProfileID` int(11) DEFAULT NULL,
  `causedByUserID` int(11) DEFAULT NULL,
  `addedRewardPoints` int(11) DEFAULT NULL,
  `deductedRewardPoints` int(11) DEFAULT NULL,
  `addedDollarAmount` double DEFAULT NULL,
  `deductedDollarAmount` double DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY (`userPendingRewardPointAndBalanceTrackingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `userPendingRewardPointAndBalanceTracking`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referrerID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userUniqueID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `measurement` tinyint(1) DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isInstructor` tinyint(1) DEFAULT NULL,
  `findingPartner` tinyint(1) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rewardPoints` int(11) DEFAULT NULL,
  `verification` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewCount` int(11) DEFAULT NULL,
  `reviewAverageScore` decimal(10,2) DEFAULT NULL,
  `reviewTotalScore` double DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `salt` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `affiliation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `defaultShippingAddressID` int(11) DEFAULT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userUniqueID` (`userUniqueID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `referrerID`, `userUniqueID`, `username`, `password`, `email`, `sex`, `measurement`, `firstName`, `lastName`, `role`, `isInstructor`, `findingPartner`, `status`, `rewardPoints`, `verification`, `reviewCount`, `reviewAverageScore`, `reviewTotalScore`, `lastLogin`, `salt`, `affiliation`, `experience`, `defaultShippingAddressID`, `dateUpdated`, `dateCreated`) VALUES
(64, NULL, 'xqOEDbcKnA', 'mark', '92a9694d9fb7a60e0d19ef996123114102e8abd8', NULL, NULL, NULL, 'Mark', 'Swanson', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0e4368c026972967d6685948153b21b45689ee89', 'U of M', 'Social', 4, '2010-12-01 12:35:01', '0000-00-00 00:00:00'),
(66, NULL, 'i0mS1YldfW', 'admin', 'cb3e81a41dd9b4fddd5ca1f5aa59c2b6c4726dfb', NULL, NULL, NULL, 'Mark', 'Swanson', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ceec8f9e81ce02f4d2901967cf103cb2c1b98f29', 'Dance Rialto', 'Collegiate', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usersPasswordResets`
--

CREATE TABLE IF NOT EXISTS `usersPasswordResets` (
  `resetID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resetUniqueID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `expiration` datetime NOT NULL,
  PRIMARY KEY (`resetID`),
  UNIQUE KEY `resetUniqueID` (`resetUniqueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `usersPasswordResets`
--


-- --------------------------------------------------------

--
-- Table structure for table `usersShippingAddresses`
--

CREATE TABLE IF NOT EXISTS `usersShippingAddresses` (
  `shippingAddressID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userID` bigint(20) NOT NULL,
  `addressOne` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressTwo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`shippingAddressID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `usersShippingAddresses`
--

INSERT INTO `usersShippingAddresses` (`shippingAddressID`, `userID`, `addressOne`, `addressTwo`, `city`, `state`, `country`, `zip`, `dateUpdated`, `dateCreated`) VALUES
(4, 64, '7937 E Ellsworth Ave', 'Apt. 4', 'Denver', 'CO', 'USA', '80230', '2010-11-19 08:34:21', '2010-11-19 08:34:21'),
(5, 64, '411 E William St', '', 'Ann Arbor', 'MI', 'USA', '48104', '2010-11-19 09:38:58', '2010-11-19 09:38:58');
