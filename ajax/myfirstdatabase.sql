-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2010 at 11:47 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myfirstdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyID` smallint(6) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) NOT NULL,
  `companyContact` text NOT NULL,
  `companyCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `companyName`, `companyContact`, `companyCreated`) VALUES
(1, 'smallCompany Inc', '1a Mount Street\r\nTe Aro\r\nWellington', '2010-06-28 09:38:41'),
(2, 'mediumCompany Inc', '74 Bealey Ave\r\nCentral City\r\nChristchurch\r\nNew Zealand', '2010-06-28 09:44:30'),
(3, 'BigCompany Inc', '3 Cornwall Road\r\nLyttleton\r\nBanks Penninsula\r\nNew Zealand', '2010-06-28 09:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `fname`, `email`, `phone`) VALUES
(1, 'test', 'test@www.com', '12345'),
(2, 'John Doe', 'test@www.com', '12345'),
(3, 'Jane', 'jane@xx.xx', '12345'),
(4, 'Chris', 'chris@mail.com', '111111111');

-- --------------------------------------------------------

--
-- Table structure for table `user1`
--

CREATE TABLE IF NOT EXISTS `user1` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `userPassword` varchar(40) NOT NULL,
  `userPrivilege` enum('user','admin') NOT NULL,
  `userBday` date NOT NULL,
  `signUpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user1`
--

INSERT INTO `user1` (`userID`, `userName`, `userPassword`, `userPrivilege`, `userBday`, `signUpDate`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', '1997-07-14', '2010-07-23 11:01:57'),
(2, 'maria', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'user', '1975-04-18', '2010-07-23 11:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` smallint(6) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `userAddress` text,
  `companyID` smallint(6) NOT NULL,
  `skill` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `companyID` (`companyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userAddress`, `companyID`, `skill`) VALUES
(1, 'Matt Evans', '21 Jump Street\r\nSt albans\r\nChristchurch', 3, ''),
(2, 'Steve Hutt', '1 Oak Park Ave\r\nTe Aro\r\nWellington', 1, ''),
(3, 'Jehan Fitisemanu', '23a Gimlie Drive\r\nKelburn\r\nWellington', 2, ''),
(4, 'Brett Taylor', '2 Ninetails drive\r\nNewmarket\r\nAuckland', 3, ''),
(5, 'Gavin Haines', '67 Alpaca street\r\nlonghorn cresent\r\nDunedin', 1, ''),
(6, 'Trevor Mcgrady', '901 Cuba Street\r\nWellington', 2, ''),
(7, 'Garry Glen', '21 jump street\r\ninvercargill', 3, ''),
(8, 'Trish Holmes', '56 Yoyo Street', 1, ''),
(9, 'Larry David', '21 jump street invercargill', 3, ''),
(10, 'Sandy Tipple', '56 Yoyo Street', 1, ''),
(11, 'Chaz Zilwig', '19 Oak Park Ave', 2, ''),
(12, 'James Moyle', '99 Bealey Ave Christchurch', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `users3`
--

CREATE TABLE IF NOT EXISTS `users3` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(11) NOT NULL,
  `UserPass` varchar(41) NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users3`
--

INSERT INTO `users3` (`UserID`, `UserName`, `UserPass`, `UserEmail`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@xx.xx'),
(3, 'Maria', '263bce650e68ab4e23f28263760b9fa5', 'maria@mm.mm'),
(5, 'John', '', 'john@xx.xx'),
(6, 'xxx', '', 'xxx@xx.xx'),
(7, 'O''Neal', '', 'oneal@xx.xx'),
(8, 'O''Brien', '', 'dsgdf@dfsdf.xx'),
(9, 'asd"xx''s"', '', 'fdgdf@fsf.xc'),
(11, 'me', '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
