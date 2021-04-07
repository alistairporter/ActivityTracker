-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 05, 2021 at 01:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fitfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `goalWeight` decimal(6,0) DEFAULT NULL,
  `totalLost` decimal(6,0) DEFAULT NULL,
  `currentWeight` decimal(6,0) DEFAULT NULL,
  `id` int(5) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`goalWeight`, `totalLost`, `currentWeight`, `id`, `userid`) VALUES
('50', NULL, '60', 6, 1),
('50', NULL, '45', 11, 1),
('70', NULL, '50', 12, 1),
('70', NULL, '80', 13, 1),
('70', NULL, '70', 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `weight`
--
ALTER TABLE `weight`
  ADD CONSTRAINT `weight_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
