-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2010 at 01:16 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `mytest`
--

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE IF NOT EXISTS `users3` (
  `UserID` int(11) NOT NULL auto_increment,
  `UserName` varchar(11) NOT NULL,
  `UserPass` varchar(41) NOT NULL,
  `UserEmail` varchar(100) default NULL,
  PRIMARY KEY  (`UserID`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users2`
--

INSERT INTO `users3` (`UserID`, `UserName`, `UserPass`, `UserEmail`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@xx.xx'),
(3, 'Maria', '263bce650e68ab4e23f28263760b9fa5', 'maria@mm.mm'),
(5, 'John', '', 'john@xx.xx'),
(6, 'xxx', '', 'xxx@xx.xx'),
(7, 'O''Neal', '', 'oneal@xx.xx'),
(8, 'O''Brien', '', 'dsgdf@dfsdf.xx'),
(9, 'asd"xx''s"', '', 'fdgdf@fsf.xc');
