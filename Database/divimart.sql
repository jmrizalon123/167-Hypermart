-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 10:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `divimart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client_data`
--

CREATE TABLE `client_data` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `contact_number` char(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `are_you_currently_on_strict_quarantine` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `close_contact` varchar(100) NOT NULL,
  `positive_contact` varchar(100) NOT NULL,
  `quarantine_facility` varchar(100) NOT NULL,
  `quarantine_address` varchar(100) NOT NULL,
  `rapid_testing` varchar(100) NOT NULL,
  `test_result` varchar(100) NOT NULL,
  `test_date` varchar(100) NOT NULL,
  `test_location` varchar(100) NOT NULL,
  `swab_testing` varchar(100) NOT NULL,
  `swab_result` varchar(100) NOT NULL,
  `swab_date` varchar(100) NOT NULL,
  `swab_place` varchar(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `symptoms` varchar(100) NOT NULL,
  `other_symptoms` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_data`
--

INSERT INTO `client_data` (`id`, `fname`, `lname`, `middlename`, `contact_number`, `email`, `are_you_currently_on_strict_quarantine`, `start_date`, `end_date`, `close_contact`, `positive_contact`, `quarantine_facility`, `quarantine_address`, `rapid_testing`, `test_result`, `test_date`, `test_location`, `swab_testing`, `swab_result`, `swab_date`, `swab_place`, `temperature`, `symptoms`, `other_symptoms`, `date_created`) VALUES
(1, 'johnmark', 'Rizalon', 'Roldan', '09091893344', 'jmarkrizalon@gmail.com', 'NO', '', '', '', '', '', '', 'YES', 'Negative', '2020-10-28', 'Manila GrandStand Drive Thru Testing', 'NO', '', '', '', '36.5', 'Shortness of breath or difficult', '', '2020-11-20 06:25:28'),
(3, 'johnmark', 'Rizalon', 'Roldan', '09091893344', 'johnmarkrizalon@gmail.com', 'NO', '', '', '', '', '', '', 'YES', 'Negative', '2020-10-28', 'Manila GrandStand Drive Thru Testing', 'NO', '', '', '', '35.6', '', 'N/A', '2020-11-20 06:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `client_information`
--

CREATE TABLE `client_information` (
  `id` int(11) NOT NULL,
  `167_employee` varchar(100) NOT NULL,
  `store_code` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact_number` char(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city_municipality` varchar(100) NOT NULL,
  `barangay` varchar(200) NOT NULL,
  `zip` char(11) NOT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`id`, `167_employee`, `store_code`, `store_name`, `firstname`, `lastname`, `middlename`, `age`, `gender`, `contact_number`, `email`, `address2`, `city_municipality`, `barangay`, `zip`, `Create_at`) VALUES
(1, '', 'C54', 'U-Mart Zambales', 'johnmark', 'Rizalon', 'Roldan', 22, 'Male', '09091893344', 'jmarkrizalon@gmail.com', 'Manila', 'Pasay', '975 Quezon BlVD Sta. Cruz Manila', '002', '2020-11-14 03:22:37'),
(3, '', 'C13', '167 Hypermart San Pablo Laguna', 'johnmark', 'Rizalon', 'Roldan', 30, 'Female', '09091893344', 'johnmarkrizalon@gmail.com', 'Manila', 'Pasay', 'Manila Metro Manila', '002', '2020-11-19 07:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `place_visited`
--

CREATE TABLE `place_visited` (
  `id` int(11) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location_address` varchar(200) NOT NULL,
  `place_visited` varchar(100) NOT NULL,
  `date_visited` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `place_visited`
--

INSERT INTO `place_visited` (`id`, `temperature`, `username`, `email`, `location_address`, `place_visited`, `date_visited`) VALUES
(1, '36.5', '', 'jmarkrizalon@gmail.com', '738 Ongpin Street\r\n                            Manila 1006 Philippines', 'World Trade Echange Building (WTE)', '2020-11-20T08:43'),
(2, '36.5', '', 'jmarkrizalon@gmail.com', '738 Ongpin Street\r\n                            Manila\r\n                            1006\r\n                            Philippines', 'World Trade Echange Building (WTE)', '2020-11-20 10:25:19'),
(3, '36.5', '', 'johnmarkrizalon@gmail.com', '738 Ongpin Street\r\n                            Manila\r\n                            1006\r\n                            Philippines', 'World Trade Echange Building (WTE)', '2020-11-20 14:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `id` int(11) NOT NULL,
  `qrUsername` varchar(250) NOT NULL,
  `qrContent` varchar(250) NOT NULL,
  `qrImg` varchar(250) NOT NULL,
  `qrlink` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_log`
--

CREATE TABLE `report_log` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_log`
--

INSERT INTO `report_log` (`id`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'jmarkrizalon@gmail.com', 'Couldnt  scan QR ', 'QR credentials cant find', '2020-11-18 03:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `updated_symptoms`
--

CREATE TABLE `updated_symptoms` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `symptoms` varchar(100) NOT NULL,
  `other_symptoms` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updated_symptoms`
--

INSERT INTO `updated_symptoms` (`id`, `username`, `email`, `temperature`, `symptoms`, `other_symptoms`, `date_updated`) VALUES
(1, 'JM1001', 'johnmarkrizalon@gmail.com', '36.5', 'Shortness of breath or difficulty breathing, ', '', '2020-11-20 06:07:19'),
(2, 'JM1001', 'johnmarkrizalon@gmail.com', '40.7', 'Muscle pain, Chills, Headache, ', '', '2020-11-20 06:09:45'),
(3, 'JM1001', 'johnmarkrizalon@gmail.com', '', '', '', '2020-11-20 06:12:25'),
(4, 'JM1001', 'johnmarkrizalon@gmail.com', '', '', '', '2020-11-20 06:12:36'),
(5, 'JM1001', 'johnmarkrizalon@gmail.com', '', '', '', '2020-11-20 06:13:09'),
(6, 'JM1001', 'johnmarkrizalon@gmail.com', '', '', '', '2020-11-20 06:13:31'),
(7, 'JM1001', 'johnmarkrizalon@gmail.com', '35.6', 'Repeated shaking with chills, ', '', '2020-11-20 06:15:43'),
(8, 'JM1001', 'johnmarkrizalon@gmail.com', '35.6', 'Muscle pain, Chills, None, ', 'N/A', '2020-11-20 06:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `administrator` tinyint(100) NOT NULL,
  `account_type` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verified` tinyint(100) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `administrator`, `account_type`, `username`, `email`, `verified`, `token`, `password`) VALUES
(1, 1, 'Employee', 'IT-JONH', 'jmarkrizalon@gmail.com', 1, '2ccb264702ce10a06f8dfe709f0f229ebc11c9dd0545c037565333d9ce5266a24b67676b9abf0bbb943e8332c4cfcf517053', '$2y$10$t/XVcG5vbAVOE0qduyNsTOfrmAH.aRkvaToVmyWjA2dCl0DHTacvu'),
(3, 0, 'Client', 'JM1001', 'johnmarkrizalon@gmail.com', 1, '96f1570f86949b8665b7be5bd1b908155a3fabd00704bbbc72970e03b5881c99ec546469427e4c9992439f5f8266a57a3065', '$2y$10$XJ4GgrOAXrlgrH1i86EBzeX7AVU2lzO7QXpwinLQ9IwoX8fcUjhOK');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `email`, `profile_image`, `bio`, `Create_at`) VALUES
(1, 'jmarkrizalon@gmail.com ', '1605777897-jm.jpg', 'Im not a great programmer Im just a good programmer with great habits, Kent Beck', '2020-11-19 09:24:57'),
(4, 'johnmarkrizalon@gmail.com ', '1605860157-78-786207_user-avatar-png-user-avatar-icon-png-transparent.png', '“The most important property of a program is whether it accomplishes the intention of its user.”\r\n― C.A.R. Hoare', '2020-11-20 08:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `id` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify_email`
--

INSERT INTO `verify_email` (`id`, `code`, `email`, `Create_at`) VALUES
(2, '166080', 'johnmarkrizalon@gmail.com', '2020-11-18 08:04:57'),
(3, '179535', 'jmarkrizalon@gmail.com', '2020-11-18 08:47:01'),
(4, '712326', 'jmarkrizalon@gmail.com', '2020-11-18 08:48:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_data`
--
ALTER TABLE `client_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_information`
--
ALTER TABLE `client_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_visited`
--
ALTER TABLE `place_visited`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_log`
--
ALTER TABLE `report_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updated_symptoms`
--
ALTER TABLE `updated_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_data`
--
ALTER TABLE `client_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_information`
--
ALTER TABLE `client_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_visited`
--
ALTER TABLE `place_visited`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `report_log`
--
ALTER TABLE `report_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `updated_symptoms`
--
ALTER TABLE `updated_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
