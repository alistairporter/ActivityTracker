-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 28, 2021 at 11:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fitfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  --`sex` varchar(100) default NULL,
 -- `height` decimal(6,0),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `weight`
--
DROP TABLE IF EXISTS `weight`;
CREATE TABLE `weight` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `goalWeight` decimal(6,0) DEFAULT NULL,
  `currentWeight` decimal(6,0) DEFAULT NULL,
  `totalLost` decimal(6,0) DEFAULT NULL,
  `timestamp` TIMESTAMP DEFAULT now(),
  PRIMARY KEY (`id`),
  CONSTRAINT `weight_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `route`
--
DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `data` varchar(1024) DEFAULT NULL,
  `creationtime` TIMESTAMP NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `route_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `activity`
--
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `routeid` int(5) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `distance` decimal(6,0) DEFAULT NULL,
  `starttime` TIMESTAMP DEFAULT now(),
  `finishtime` TIMESTAMP,
  `averagespeed` decimal(6,0) DEFAULT NULL,
  `heightclimbed` decimal(6,0) DEFAULT NULL,
  `caloriesburnt` int(11) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`routeid`) REFERENCES `route` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `activityschedule`
--
DROP TABLE IF EXISTS `activityschedule`;
CREATE TABLE `activityschedule` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `activityid` int(5) NOT NULL,
  `schedulename` varchar(100) DEFAULT NULL,
  `remindertime` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `activityschedule_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  CONSTRAINT `activityschedule_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
