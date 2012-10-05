-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 28, 2012 at 01:39 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carpooling`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `street` varchar(40) NOT NULL,
  `aptNo` varchar(6) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `addressId` int(10) NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--


-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationId` varchar(20) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `timeDeparture` datetime NOT NULL,
  `origin` varchar(60) NOT NULL,
  `destination` varchar(60) NOT NULL,
  `vinNumber` varchar(17) NOT NULL,
  `startingGeoCordinate` varchar(300) NOT NULL,
  `endingGeoCordinate` varchar(300) NOT NULL,
  PRIMARY KEY (`reservationId`),
  KEY `userId` (`userId`),
  KEY `vinNumber` (`vinNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationId`, `userId`, `timeDeparture`, `origin`, `destination`, `vinNumber`, `startingGeoCordinate`, `endingGeoCordinate`) VALUES
('25', '0853221', '0000-00-00 00:00:00', 'fargo', 'chicago', '0892', '7777', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewId` varchar(20) NOT NULL,
  `reviewText` varchar(160) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `routeId` varchar(20) NOT NULL,
  `reviewNumber` int(1) NOT NULL,
  PRIMARY KEY (`reviewId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` varchar(20) NOT NULL,
  `fbId` varchar(40) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ssn` varchar(12) NOT NULL,
  `homeAddress` varchar(20) NOT NULL,
  `workAddress` varchar(20) NOT NULL,
  `contactNumber` varchar(12) NOT NULL,
  `conctactMethod` varchar(2) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `carName` varchar(20) NOT NULL,
  PRIMARY KEY (`userId`,`fbId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fbId`, `firstName`, `lastName`, `password`, `ssn`, `homeAddress`, `workAddress`, `contactNumber`, `conctactMethod`, `emailAddress`, `gender`, `carName`) VALUES
('0853221', 'akumar@email.com', 'ankit', 'kumar', 'behenchod', '2147483647', 'Niskanen', 'wennsoft', '7015522096', 'p', 'ankit@email.com', 'M', 'camry'),
('0864985', 'kalith@kumasaru.com', 'kalith', 'kumasaru', 'gandu', '501378946', 'University Village', 'union', '7012229989', 'p', 'kumasaru@gaandmeindanda.com', 'M', 'Dog I am paid'),
('0936421', 'asharma@preventice.com', 'akshat', 'sharma', 'madarchod', '1234567892', 'Niskanen', 'preventice', '7015401566', 'p', 'akshat.sharma@chutiya.com', 'M', 'Civic Hybrid');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `vinNumber` varchar(17) NOT NULL,
  `model` varchar(20) NOT NULL,
  `make` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `type` varchar(20) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `vehicleNickName` varchar(30) NOT NULL,
  PRIMARY KEY (`vinNumber`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vinNumber`, `model`, `make`, `color`, `year`, `type`, `userId`, `vehicleNickName`) VALUES
('0892', 'camry', 'toyota', 'red', 1992, 'sedan', '0853221', 'dikra');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`vinNumber`) REFERENCES `vehicle` (`vinNumber`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
