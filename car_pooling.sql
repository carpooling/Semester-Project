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
  `Street` varchar(40) NOT NULL,
  `Apt_No` varchar(6) NOT NULL,
  `Zip_Code` varchar(10) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(2) NOT NULL,
  `User_Id` varchar(20) NOT NULL,
  `Address_Id` int(10) NOT NULL,
  PRIMARY KEY (`Address_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `Reservation_ID` varchar(20) NOT NULL,
  `User` varchar(20) NOT NULL,
  `Time_Departure` datetime NOT NULL,
  `Origin` varchar(60) NOT NULL,
  `Destination` varchar(60) NOT NULL,
  `Vin_Number` varchar(17) NOT NULL,
  PRIMARY KEY (`Reservation_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_Id` varchar(20) NOT NULL,
  `Fb_Twtr_Id` varchar(40) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Ssn` int(12) NOT NULL,
  `Home_Address` varchar(20) NOT NULL,
  `Work_Address` varchar(20) NOT NULL,
  `Contact_Number` varchar(12) NOT NULL,
  `Conctact_Method` varchar(2) NOT NULL,
  `Email_Address` varchar(40) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Car_Name` varchar(20) NOT NULL,
  PRIMARY KEY (`User_Id`,`Fb_Twtr_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `VIN_NUMBER` varchar(17) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `Make` varchar(20) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Year` int(4) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `User_ID` varchar(20) NOT NULL,
  `Vehicle_NickName` varchar(30) NOT NULL,
  PRIMARY KEY (`VIN_NUMBER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
