-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 10:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` bigint(30) NOT NULL,
  `name` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `category`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Carpentary', 'Woodwork', "Woodwork that wows!", 'uploads/services/1.png?v=1682479354', 1, '2023-04-26 11:22:34', '0000-00-00 00:00:00'),
(2, 'Masonry', 'Construction', "Building solid foundations!", 'uploads/services/2.png?v=1682479557', 1, '2023-04-26 11:25:55', '0000-00-00 00:00:00'),
(3, 'Electrical installations', 'Electrical', "Wired for perfection!", 'uploads/services/3.png?v=1682479953', 1, '2023-04-26 11:32:33', '0000-00-00 00:00:00'),
(4, 'Waterworks', 'Plumbing', "We fix what flows!", 'uploads/services/4.png?v=1682481428', 1, '2023-04-26 11:54:43', '0000-00-00 00:00:00');

-- INSERT INTO `service_list` (`id`, `name`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
-- (1, 'Carpentary', "Woodwork that wows!", 'uploads/services/1.png?v=1682479354', 1, '2023-04-26 11:22:34', '0000-00-00 00:00:00'),
-- (2, 'Masonry', "Building solid foundations!", 'uploads/services/2.png?v=1682479557', 1, '2023-04-26 11:25:55', '0000-00-00 00:00:00');
-- INSERT INTO `service_list` (`id`, `name`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
-- (3, 'Electrical installations', "Wired for perfection!", 'uploads/services/3.png?v=1682479953', 1, '2023-04-26 11:32:33', '0000-00-00 00:00:00'),
-- (4, 'Waterworks', "We fix what flows!", 'uploads/services/4.png?v=1682481428', 1, '2023-04-26 11:54:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'BuildBuddy'),
(6, 'short_name', 'BuildBuddy'),
(11, 'logo', 'uploads/logo.png?v=1682490747'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1682490747'),
(17, 'phone', '456-987-1231'),
(18, 'mobile', '09123456987 / 094563212222 '),
(19, 'email', 'info@serviceprovider.com'),
(20, 'address', '2690 Frederick Street, Sacramento, California, 58147');

-- --------------------------------------------------------

--
--


--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--

--
-- AUTO_INCREMENT for dumped tables
--

--

-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;


