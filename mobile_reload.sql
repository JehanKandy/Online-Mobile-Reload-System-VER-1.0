-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 06:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_reload`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_tbl`
--

CREATE TABLE `balance_tbl` (
  `b_id` int(10) NOT NULL,
  `pay_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `full_amount` int(255) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `holder_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance_tbl`
--

INSERT INTO `balance_tbl` (`b_id`, `pay_date`, `expire_date`, `amount`, `full_amount`, `card_number`, `holder_name`, `user_email`) VALUES
(1, '2022-04-08', '2022-12-08', '10000', 10000, '78541236985', 'jehan123', 'jehan@123'),
(2, '2022-04-08', '2022-05-08', '50', 50, 'Login Gift', 'Admin', 'nimal@123');

-- --------------------------------------------------------

--
-- Table structure for table `recharge_tbl`
--

CREATE TABLE `recharge_tbl` (
  `r_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `reload_amount` int(11) NOT NULL,
  `reload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recharge_tbl`
--

INSERT INTO `recharge_tbl` (`r_id`, `user_email`, `reload_amount`, `reload_date`) VALUES
(1, 'jehan@123', 1500, '2022-04-08'),
(2, 'nimal@123', 50, '2022-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(10) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `uaddress` varchar(255) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `user_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `uname`, `email`, `pass1`, `mobile_number`, `uaddress`, `user_type`, `user_status`) VALUES
(1, 'Jehan Kandy', 'jehan@123', '3018d736a1e3f9163eb00ac15ece7b20', '+94 711758851', 'Kandy', 'admin', 1),
(2, 'Nimal Kumara', 'nimal@123', '202cb962ac59075b964b07152d234b70', '+94 789456123', '88, Crosses Street, Kandy', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_tbl`
--
ALTER TABLE `balance_tbl`
  ADD PRIMARY KEY (`b_id`,`user_email`);

--
-- Indexes for table `recharge_tbl`
--
ALTER TABLE `recharge_tbl`
  ADD PRIMARY KEY (`r_id`,`user_email`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_tbl`
--
ALTER TABLE `balance_tbl`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recharge_tbl`
--
ALTER TABLE `recharge_tbl`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
