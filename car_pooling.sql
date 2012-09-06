-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2012 at 01:09 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car_pooling`
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
  FOREIGN KEY ('userId') REFERENCES user(userId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`reservationId`)
  FOREIGN KEY ('userId') REFERENCES user(userId)
  FOREIGN KEY ('vinNumber') REFERENCES vehicle(vinNumber)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `ssn` int(12) NOT NULL,
  `homeAddress` varchar(20) NOT NULL,
  `workAddress` varchar(20) NOT NULL,
  `contactNumber` varchar(12) NOT NULL,
  `conctactMethod` varchar(2) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `carName` varchar(20) NOT NULL,
  PRIMARY KEY (`userId`,`fbId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`vinNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
