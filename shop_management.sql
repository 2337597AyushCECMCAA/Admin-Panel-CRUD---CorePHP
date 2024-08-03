-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 01:29 PM
-- Server version: 8.0.35
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `business_name`, `owner_name`, `location`, `address`, `mobile_no`, `created_at`) VALUES
(103, 10004, 'Awesome Life', 'Rocket Awesome', 'Jupiter', 'Solar System', '47880897889', '2024-07-18 09:55:22'),
(104, 10004, 'C se Chirag', 'Chirag Jin', 'Egypt', 'Alladin ke ghar ke pass', '73654863758', '2024-07-18 09:56:48'),
(105, 10004, 'Janta Ka Malik', 'Mukul Malik', 'MalikNagar', 'Sabse Badi Haweli\r\n', '66238356253', '2024-07-18 10:07:55'),
(106, 10005, 'ABC Technicals', 'ABC', 'Amritsar', 'Amritsar', '8656796780', '2024-07-18 10:12:06'),
(107, 10006, 'XYZ Machineries', 'XYZ', 'Pune', 'Pune', '7532539829', '2024-07-18 10:13:40'),
(108, 10004, 'Ok', 'Mastu', 'Taaron ke pass', 'satellite', '7657777079', '2024-07-19 05:21:32'),
(109, 10007, 'Bindaas Life', 'Lucky Bindaas', 'Bindass Nagar', 'Lucky Palace', '89768632379', '2024-07-20 07:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `userpass`, `contactno`, `emailid`, `is_admin`) VALUES
(10001, 'admin', 'admin', '09876543211', 'admin@admin', 1),
(10004, 'user3', '$2y$10$c9cb6wzo8/mIpBOtk4MCCep96XkZUzztlYsJPvLcN5utPoxOKQhp2', '64675768', 'user3@user', 0),
(10005, 'user4', '$2y$10$ddXmBoQAEoipXfVR/ErUqOKeV9zG7IGqMrXf2xwCrAgvJrcz6PaKW', '7890696954', 'user4@user', 0),
(10006, 'user5', '$2y$10$M3qiP9pEw3izN2NZKYu58e0Nuk4JlKlK5WO2LkTKdT06KU/u7IkPa', '5555556970', 'user5@user', 0),
(10007, 'user1', '$2y$10$kJugzd7iSgmFT0.4aCjjYuSogpnw6NV1IB6xMrls3BwVMJbOdE3wm', '6646498687', 'user1@user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
