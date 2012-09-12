-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2012 at 02:48 AM
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


