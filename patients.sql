-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 10:58 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_type` enum('Cash','Credit','Cheque') NOT NULL,
  `receipt_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `phone`, `service`, `date`, `amount`, `payment_type`, `receipt_id`, `status`) VALUES
(1, 'test', '', '12123', '11122233', '2022-04-09', '500', 'Cash', 0, 1),
(2, 'test', '', '9879141099', 'asdad', '2022-04-21', '5000', 'Cheque', 0, 1),
(3, 'Jaymin Acharya', '', '7043793731', 'test', '2022-04-13', '5000', 'Credit', 0, 1),
(4, 'Jaymin Acharya', '', '7043793731', '11122233', '2022-04-14', '5000', 'Cash', 0, 1),
(5, 'Jaymin', '', '7043793731', 'qwerty', '2022-04-16', '5000', 'Credit', 0, 1),
(6, 'Hitarth', '', '9879141099', 'asdad', '2022-04-14', '5000', 'Credit', 0, 1),
(7, 'test', '', '12123', '11122233', '2022-04-09', '500', 'Cash', 0, 1),
(8, 'test', '', '9879141099', 'asdad', '2022-04-21', '5000', 'Cheque', 0, 1),
(9, 'Jaymin Acharya', '', '7043793731', 'test', '2022-04-13', '5000', 'Credit', 0, 1),
(10, 'Jaymin Acharya', '', '7043793731', '11122233', '2022-04-14', '5000', 'Cash', 0, 1),
(11, 'Jaymin', '', '7043793731', 'qwerty', '2022-04-16', '5000', 'Credit', 0, 1),
(12, 'Hitarth', '', '9879141099', 'asdad', '2022-04-14', '5000', 'Credit', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
