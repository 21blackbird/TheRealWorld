-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 04:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `name`) VALUES
(1, 3, 'Subaru R-Class'),
(2, 1, 'Maybach Electra'),
(3, 2, 'Subaru S4'),
(4, 4, 'Acura Galant'),
(5, 2, 'Lincoln Grand Vitara'),
(6, 1, 'Subaru DB9'),
(7, 1, 'Oldsmobile Bronco'),
(8, 2, 'Volkswagen Envoy'),
(9, 4, 'Buick Countryman'),
(10, 1, 'Cadillac Fit'),
(11, 2, 'Mercedes-Benz Corrado'),
(12, 1, 'BMW Intrepid'),
(13, 4, 'Bentley Fox'),
(14, 3, 'Bentley Caravan'),
(15, 1, 'Volkswagen Impala'),
(16, 3, 'BMW Park Avenue'),
(17, 1, 'Cadillac Ram 1500'),
(18, 1, 'Chevrolet 745'),
(19, 2, 'Mazda NX'),
(20, 3, 'Chevrolet F-Series Super Duty');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `phone` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`) VALUES
(1, 'egeleman0', 'mdadson0@economist.com', '$2y$10$grpUABXNDInBS3Ojy31nfOIi/I6SPDavomSJQOwxQckspUjOjzoYW', '3088360882'),
(2, 'tshannon1', 'rfloyed1@nationalgeographic.com', '$2y$10$lIgMbio/9Ng7pW/8zWzOFu2PiCBRFV262aRqfSqj3JidHa.1wcS3y', '6997434804'),
(3, 'jgilardone2', 'laspden2@squidoo.com', '$2y$10$jDmQk.qFdaScvnRWcSiHV.nmqOBRE.S7HhZ2YzYlYMOEHIIhmWNbO', '2091588704'),
(4, 'myersin3', 'nstealy3@dion.ne.jp', '$2y$10$ijc6XbgN6wQfAhe.RPGn0O6/Yep0ZtzFQK/4wwvqHHvl2523fmVf6', '9622157186');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_constraint_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `foreign_constraint_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
