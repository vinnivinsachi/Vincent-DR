-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2010 at 03:26 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accountrewardpointsandbalancesummary`
--


-- --------------------------------------------------------

--
-- Table structure for table `exampleProfiles`
--

CREATE TABLE IF NOT EXISTS `exampleProfiles` (
  `profileID` int(11) NOT NULL AUTO_INCREMENT,
  `profileKey` varchar(50) NOT NULL,
  `profileValue` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`profileID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `sourceName` varchar(50) NOT NULL,
  `sourceTypeTitle` varchar(100) NOT NULL,
  `sourceTypeName` varchar(100) NOT NULL,
  `sourceID` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `imageOrder` int(11) NOT NULL,
  `flagged` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`productImageID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `productimages`
--


-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `storeID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeUniqueID` varchar(10) NOT NULL,
  `storeName` varchar(200) NOT NULL,
  `storeDisplayName` varchar(255) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `defaultShippingAddressID` int(11) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `storePhone` varchar(15) NOT NULL,
  `storeFax` varchar(15) NOT NULL,
  `storeEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`storeID`),
  UNIQUE KEY `storeUniqueID` (`storeUniqueID`),
  KEY `storeName` (`storeName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `addressOne` varchar(255) NOT NULL,
  `addressTwo` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`shippingAddressID`),
  KEY `storeID` (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
  `linkRole` varchar(20) NOT NULL,
  PRIMARY KEY (`linkID`),
  KEY `userID` (`userID`),
  KEY `storeID` (`storeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `userPendingRewardPointAndBalanceTrackingUniqueID` varchar(20) NOT NULL,
  `userID` int(11) NOT NULL,
  `trackingType` varchar(40) NOT NULL,
  `causedByType` varchar(25) NOT NULL,
  `fromOrderID` varchar(20) DEFAULT NULL,
  `fromOrderProfileID` int(11) DEFAULT NULL,
  `causedByUserID` int(11) DEFAULT NULL,
  `addedRewardPoints` int(11) DEFAULT NULL,
  `deductedRewardPoints` int(11) DEFAULT NULL,
  `addedDollarAmount` double DEFAULT NULL,
  `deductedDollarAmount` double DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime NOT NULL,
  PRIMARY KEY (`userPendingRewardPointAndBalanceTrackingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `userPendingRewardPointAndBalanceTracking`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referrerID` varchar(10) DEFAULT NULL,
  `userUniqueID` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `measurement` tinyint(1) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `isInstructor` tinyint(1) DEFAULT NULL,
  `findingPartner` tinyint(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `rewardPoints` int(11) DEFAULT NULL,
  `verification` varchar(15) DEFAULT NULL,
  `reviewCount` int(11) DEFAULT NULL,
  `reviewAverageScore` decimal(10,2) DEFAULT NULL,
  `reviewTotalScore` double DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `salt` varchar(50) NOT NULL,
  `affiliation` varchar(100) DEFAULT NULL,
  `experience` varchar(30) DEFAULT NULL,
  `defaultShippingAddressID` int(11) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `userUniqueID` (`userUniqueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `referrerID`, `userUniqueID`, `username`, `password`, `email`, `sex`, `measurement`, `firstName`, `lastName`, `role`, `isInstructor`, `findingPartner`, `status`, `rewardPoints`, `verification`, `reviewCount`, `reviewAverageScore`, `reviewTotalScore`, `dateCreated`, `lastLogin`, `salt`, `affiliation`, `experience`, `defaultShippingAddressID`, `dateUpdated`) VALUES
(64, NULL, 'xqOEDbcKnA', 'mark', '92a9694d9fb7a60e0d19ef996123114102e8abd8', NULL, NULL, NULL, 'Mark', 'Swanson', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-18 19:00:35', NULL, '0e4368c026972967d6685948153b21b45689ee89', 'U of M', 'Social', 4, NULL),
(65, NULL, 'MhbwYy3CWk', 'mark2', '88ac63ed6960619816a50318a8326acdc7e8dfd8', NULL, NULL, NULL, NULL, NULL, 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-11 03:09:13', NULL, 'c9feba30304d2331681d0dc03f32fd97bab3d1b1', NULL, NULL, NULL, NULL),
(66, NULL, 'i0mS1YldfW', 'admin', 'cb3e81a41dd9b4fddd5ca1f5aa59c2b6c4726dfb', NULL, NULL, NULL, 'Mark', 'Swanson', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-21 22:42:42', NULL, 'ceec8f9e81ce02f4d2901967cf103cb2c1b98f29', 'Dance Rialto', 'Collegiate', NULL, '2010-11-21 22:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `usersShippingAddresses`
--

CREATE TABLE IF NOT EXISTS `usersShippingAddresses` (
  `shippingAddressID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userID` bigint(20) NOT NULL,
  `addressOne` varchar(255) NOT NULL,
  `addressTwo` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`shippingAddressID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usersShippingAddresses`
--

INSERT INTO `usersShippingAddresses` (`shippingAddressID`, `userID`, `addressOne`, `addressTwo`, `city`, `state`, `country`, `zip`, `dateUpdated`, `dateCreated`) VALUES
(4, 64, '7937 E Ellsworth Ave', 'Apt. 4', 'Denver', 'CO', 'USA', '80230', '2010-11-19 08:34:21', '2010-11-19 08:34:21'),
(5, 64, '411 E William St', '', 'Ann Arbor', 'MI', 'USA', '48104', '2010-11-19 09:38:58', '2010-11-19 09:38:58');
