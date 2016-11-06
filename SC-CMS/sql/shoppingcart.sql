-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2010 at 09:49 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartproducts`
--

CREATE TABLE IF NOT EXISTS `cartproducts` (
  `PID` int(6) NOT NULL AUTO_INCREMENT,
  `PTitle` varchar(255) DEFAULT NULL,
  `PName` varchar(100) DEFAULT NULL,
  `PDesc` longtext,
  `PImage` varchar(255) DEFAULT NULL,
  `PPrice` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `cartproducts`
--

INSERT INTO `cartproducts` (`PID`, `PTitle`, `PName`, `PDesc`, `PImage`, `PPrice`) VALUES
(1, 'Sheep Key Ring - with Pink Ribbon', 'Sheep Key Ring', 'Sheep Key Ring - white with pink bow tie', '1.jpg', '35.00'),
(2, 'Cute Kiwi - with brown scarf', 'Cute Kiwi', 'A cute KIWI,must for those soft people out there', '2.jpg', '12.35'),
(3, 'NZ Sheep- White with black bow tie', 'NZ Sheep', 'New Zealand Ru Sheep - White color with black bow tie', '3.jpg', '10.95'),
(4, 'Sheep Key Ring - white with green bow tie', 'Sheep Key Ring', 'Sheep Key Ring - white with green bow tie', '4.jpg', '21.00'),
(50, 'test', 'test', 'test', '50.jpg', '45.00'),
(44, 'again', 'again', 'again', '44.jpg', '22.00'),
(60, 'test again', 'test again', 'test again', '60.jpg', '22.00'),
(37, 'changed title', 'changed name', 'changed dec', '37.jpg', '15.00'),
(59, 'fghgfh', 'gghfgh', 'ghfg', '59.jpg', '11.00');

-- --------------------------------------------------------

--
-- Table structure for table `orderedproducts`
--

CREATE TABLE IF NOT EXISTS `orderedproducts` (
  `OrdProdID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`OrdProdID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `orderedproducts`
--

INSERT INTO `orderedproducts` (`OrdProdID`, `OrderID`, `ProductID`, `ProductPrice`, `Quantity`) VALUES
(5, 4, 1, '35.00', 1),
(6, 5, 2, '12.35', 2),
(7, 5, 4, '21.00', 1),
(8, 6, 1, '35.00', 1),
(9, 7, 3, '10.95', 1),
(10, 7, 4, '21.00', 2),
(11, 8, 3, '10.95', 1),
(12, 9, 2, '12.35', 1),
(13, 10, 1, '35.00', 1),
(14, 11, 1, '35.00', 1),
(15, 12, 37, '15.00', 1),
(16, 12, 2, '12.35', 1),
(17, 12, 44, '22.00', 1),
(18, 13, 4, '21.00', 1),
(19, 13, 1, '35.00', 1),
(20, 13, 2, '12.35', 1),
(21, 14, 1, '35.00', 1),
(22, 15, 2, '12.35', 1),
(23, 16, 2, '12.35', 1),
(24, 17, 2, '12.35', 1),
(25, 18, 2, '12.35', 1),
(26, 19, 3, '10.95', 1),
(27, 20, 1, '35.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(105) NOT NULL,
  `UserEmail` varchar(105) DEFAULT NULL,
  `UserPhone` varchar(21) DEFAULT NULL,
  `UserHnoSt` varchar(255) NOT NULL,
  `UserSuburb` varchar(105) DEFAULT NULL,
  `UserCity` varchar(105) NOT NULL,
  `UserCountry` varchar(105) NOT NULL,
  `UserShipHnoSt` varchar(255) DEFAULT NULL,
  `UserShipSuburb` varchar(105) DEFAULT NULL,
  `UserShipCity` varchar(105) DEFAULT NULL,
  `UserShipCountry` varchar(105) DEFAULT NULL,
  `ReceiptNumber` varchar(40) NOT NULL,
  `TotalValue` decimal(10,2) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `OrderStatus` enum('approved','declined','dispatched') NOT NULL,
  `OrderDispatchDate` date NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserName`, `UserEmail`, `UserPhone`, `UserHnoSt`, `UserSuburb`, `UserCity`, `UserCountry`, `UserShipHnoSt`, `UserShipSuburb`, `UserShipCity`, `UserShipCountry`, `ReceiptNumber`, `TotalValue`, `OrderDate`, `OrderStatus`, `OrderDispatchDate`) VALUES
(4, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '35.00', '2010-08-02 11:40:31', '', '0000-00-00'),
(5, 'Maria Jones', 'mjones@gmail.com', '1222333', '10 Some st', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '45.70', '2010-08-02 11:46:08', '', '0000-00-00'),
(6, 'test', 'test@xx.xx', '111111111111', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '35.00', '2010-08-02 12:38:40', '', '0000-00-00'),
(7, 'John Doe', 'john@hotmail.com', '041111111', '12 some st', 'Johnsonville', 'Wellington', 'New Zealand', '15 some st', 'Petone', 'Palmerston North', 'New Zealand', '123NTST456', '52.95', '2010-08-03 08:47:28', '', '0000-00-00'),
(8, 'Julia ', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '10.95', '2010-08-05 09:34:57', '', '0000-00-00'),
(9, 'last test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '12.35', '2010-08-06 08:39:04', '', '0000-00-00'),
(10, 'jane', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '35.00', '2010-08-06 14:40:53', '', '0000-00-00'),
(11, 'aaa', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '35.00', '2010-08-06 15:16:19', '', '0000-00-00'),
(12, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '49.35', '2010-08-12 09:51:25', '', '0000-00-00'),
(13, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '68.35', '2010-08-12 10:59:41', '', '0000-00-00'),
(14, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', 'OR4ca013c3e61e7', '35.00', '2010-09-27 16:47:15', '', '0000-00-00'),
(15, 'testxx', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', 'OR4ca0157bdaacb', '12.35', '2010-09-27 16:54:35', 'approved', '0000-00-00'),
(16, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '123NTST456', '12.35', '2010-09-28 09:17:10', '', '0000-00-00'),
(17, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '', '12.35', '2010-09-28 11:09:20', '', '0000-00-00'),
(18, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', 'OR4ca11681684a9', '12.35', '2010-09-28 11:11:13', 'approved', '0000-00-00'),
(19, 'John Doe', 'john@hotmail.com', '041111111', '12 Some st.', 'Petone', 'Wellington', 'New Zealand', '', '', '', 'New Zealand', 'OR4ca118024a387', '10.95', '2010-09-28 11:17:38', 'approved', '0000-00-00'),
(20, 'test', '', '', '', '', '', 'New Zealand', '', '', '', 'New Zealand', '', '35.00', '2010-10-07 09:42:12', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `PgID` smallint(6) NOT NULL AUTO_INCREMENT,
  `PageID` varchar(15) NOT NULL,
  `PageTitle` varchar(40) NOT NULL,
  `PageHeading` varchar(30) NOT NULL,
  `PageKeywords` varchar(255) NOT NULL,
  `PageDescription` varchar(255) NOT NULL,
  `PageContent` text NOT NULL,
  PRIMARY KEY (`PgID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`PgID`, `PageID`, `PageTitle`, `PageHeading`, `PageKeywords`, `PageDescription`, `PageContent`) VALUES
(1, 'home', 'The Stuff Shoppe Homepage', 'Welcome ', 'stuff toys x', 'The Stuff Shoppe sells stuff toys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae turpis magna. Vivamus lacinia porttitor interdum. Etiam sed enim elit. Aliquam ut mi convallis mauris mollis dignissim. Pellentesque vulputate orci a metus fringilla iaculis. Donec et turpis ac dui mattis viverra id id tortor. Vivamus quam justo, pulvinar vel mollis in, vestibulum ut lorem. Duis rhoncus magna quis lorem accumsan cursus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed eu tellus ipsum. Aliquam mi nibh, auctor et tincidunt vitae, volutpat et diam. Proin in lacinia turpis. Pellentesque justo nisl, tristique sed fermentum id, rhoncus id erat. Vivamus eu dolor in nisl posuere cursus. Nulla in convallis leo. Quisque ac imperdiet urna. In hac habitasse platea dictumst. Ut condimentum metus et velit laoreet et lacinia mauris tempus. Nunc placerat blandit metus, at blandit diam pharetra convallis. In eget odio purus.alert("this is an XSS vulnerability");'),
(2, 'gallery', 'The Stuff Shoppe Product Gallery', 'Product Catalogue', 'stuff toys, The Stuff Shoppe Product Gallery', 'The Stuff Shoppe Product Gallery', ''),
(3, 'productView', 'The Stuff Shoppe Product Page', 'The Stuff Shoppe Product Page', 'stuff toys, The Stuff Shoppe Products', 'The Stuff Shoppe sells stuff toys', ''),
(4, 'viewCart', 'The Stuff Shoppe Cart Page', 'Your Cart', 'stuff toys, The Stuff Shoppe Cart', 'The Stuff Shoppe sells stuff toys', ''),
(5, 'checkout', 'The Stuff Shoppe Checkout Page', 'Checkout', 'stuff toys, The Stuff Shoppe Checkout', 'The Stuff Shoppe sells stuff toys', ''),
(6, 'login', 'The Stuff Shoppe Admin Page', 'Login Form', '', '', ''),
(7, 'editView', 'The Stuff Shoppe Admin Page', 'Edit Page Form', '', '', ''),
(8, 'addProduct', 'The Stuff Shoppe Admin Page', 'Add Product Form', '', '', ''),
(9, 'editProduct', 'The Stuff Shoppe Admin Page', 'Edit Product', '', '', ''),
(10, 'deleteProduct', 'The Stuff Shoppe Admin Page', 'Delete Product', '', '', ''),
(11, 'contact', 'The Stuff Shoppe Contact Page', 'Our Location', 'The Stuff Shoppe Location', 'The Stuff Shoppe Location', ''),
(12, 'imageGallery', 'The Stuff Shoppe Image Gallery', 'Image Gallery', '', '', ''),
(13, 'imageCrop', 'The Stuff Shoppe Admin Page', 'Crop Image', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL,
  `UserPass` varchar(40) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserPass`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
