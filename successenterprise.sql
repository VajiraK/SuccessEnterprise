-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2013 at 06:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `successenterprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `Name` varchar(60) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Contact` varchar(12) NOT NULL,
  `Message` varchar(300) NOT NULL,
  `Date` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` varchar(6) NOT NULL,
  `UserName` varchar(60) NOT NULL,
  `OrderStatus` varchar(12) NOT NULL,
  `OrderDate` bigint(20) NOT NULL,
  `ReleaseDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserName`, `OrderStatus`, `OrderDate`, `ReleaseDate`) VALUES
('OR-JLW', 'saman', 'Released', 1361806399, 1361806432),
('OR-ROC', 'saman', 'Released', 1360942974, 1360943002),
('OR-UUQ', 'sachee', 'Released', 1361271547, 1361271592),
('OR-YUV', 'saman', 'Released', 1360943043, 1360943068);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `OrderID` varchar(6) NOT NULL,
  `ItemCode` varchar(6) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OrderID`, `ItemCode`, `Quantity`) VALUES
('OR-RGV', 'ST-WXV', 2),
('OR-RGV', 'ST002', 2),
('OR-DFS', 'ST002', 4),
('OR-DFS', 'ST-WXV', 16),
('OR-MNS', 'ST-WXV', 1),
('OR-MNS', 'ST003', 1),
('OR-NXC', 'ST-WXV', 0),
('OR-DXY', 'ST-WXV', 0),
('OR-TAB', 'ST-WXV', 0),
('OR-HPW', 'ST-WXV', 0),
('OR-PGR', 'ST-WXV', 0),
('OR-CUC', 'ST003', 1),
('OR-CUC', 'ST-WXV', 0),
('OR-RME', 'ST-WXV', 0),
('OR-RME', 'ST003', 0),
('OR-BYT', 'ST-WXV', 0),
('OR-PQH', 'ST005', 6),
('OR-PQH', 'ST003', 3),
('OR-OVV', 'ST-KSE', 1),
('OR-MTD', 'ST-KSE', 1),
('OR-RGY', 'ST002', 1),
('OR-RGY', 'ST005', 1),
('OR-CFS', 'ST005', 1),
('OR-CFS', 'ST003', 1),
('OR-FRE', 'ST003', 1),
('OR-FRE', 'ST005', 1),
('OR-QBR', 'ST003', 1),
('OR-CPD', 'ST003', 1),
('OR-ROC', 'ST003', 1),
('OR-ROC', 'ST005', 1),
('OR-YUV', 'ST003', 1),
('OR-UUQ', 'ST003', 1),
('OR-UUQ', 'ST005', 1),
('OR-JLW', 'ST003', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `OrderID` varchar(6) NOT NULL,
  `ItemCode` varchar(6) NOT NULL,
  `OrderedQuantity` int(11) NOT NULL,
  `ReleasedQuantity` int(11) NOT NULL,
  `Profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`OrderID`, `ItemCode`, `OrderedQuantity`, `ReleasedQuantity`, `Profit`) VALUES
('OR-BYT', 'ST-WXV', 0, 0, 0),
('OR-BYT', 'ST-WXV', 0, 0, 0),
('OR-PQH', 'ST005', 6, 6, 300),
('OR-PQH', 'ST003', 3, 3, 150),
('OR-ROC', 'ST003', 1, 1, 400),
('OR-ROC', 'ST005', 1, 1, 50),
('OR-YUV', 'ST003', 1, 1, 400),
('OR-UUQ', 'ST003', 1, 1, 400),
('OR-UUQ', 'ST005', 1, 1, 50),
('OR-JLW', 'ST003', 2, 2, -108);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `ItemID` varchar(6) NOT NULL,
  `ItemName` varchar(60) NOT NULL,
  `HS_Price` int(11) NOT NULL,
  `RT_Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ItemID`, `ItemName`, `HS_Price`, `RT_Price`, `Quantity`) VALUES
('ST-OBG', 'dgdf', 544, 454, 4),
('ST-UDA', 'Tank', 200, 300, 20),
('ST003', 'Arpico CFL 8W', 454, 500, 10),
('ST005', 'Arpico CFL 14W', 400, 450, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(200) NOT NULL,
  `salted_hash` varchar(200) NOT NULL,
  `salt` varchar(5) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `salted_hash`, `salt`, `user_type`, `name`, `email`, `contact`, `address`) VALUES
('admin', '5cce9c026d813719fa2e181f6bfa8dce9569b3b9dc0a63849e41403c7dbcfde4', 'EFJAT', 'Administrator', 'System Administrator', 'admin@gmail.com', 'lsdflk', 'dflkkjsd'),
('Sachee', '5465084080dbd03b82a7f0353ced16ac21a7f11ba4054b56274248f2e9a10ee2', 'AVWOJ', 'Customer', 'Sachithra', 'sach@jsdj.kj', '423434', 'sdfkjsdflk'),
('Sales', '0969ae87c8ba4b1a6a2f8611ae6e113b112f63ac580daef9c3e3882e55b758f3', 'SXTNI', 'SalesAgent', 'Sales Man', 'sales@gmail.com', '3523', 'sdg'),
('saman', 'a85f1d43ce70131ff162d0707f151c6239d4a8692679fcb8e8b953f6d4a19022', 'WFWPB', 'Customer', 'Saman Fanando', 'vajeemail@gmail.com', '4444444', 'Matale');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
