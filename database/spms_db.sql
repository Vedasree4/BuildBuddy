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
  `company_address` text NOT NULL,
  `company_contact` varchar(20) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `image_path` text DEFAULT NULL,
  `price_details` text NOT NULL,
  `price_type` ENUM('fixed', 'negotiable') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--
INSERT INTO `service_list` 
(`id`, `name`, `category`, `description`, `company_address`, `company_contact`, `company_email`, `image_path`, `price_details`, `price_type`, `status`, `created_at`, `updated_at`) 
VALUES
(1, 'Carpentry', 'Woodwork', "Woodwork that wows!", "123 Wood Street, Cityville", "9876543210", "carpentry@example.com", 'uploads/services/1.png?v=1682479354', 'Starting at $50 per hour, additional cost based on material quality', 'negotiable', 1, '2023-04-26 11:22:34', '2023-04-26 11:22:34'),

(2, 'Masonry', 'Construction', "Building solid foundations!", "456 Brick Lane, Townsville", "8765432109", "masonry@example.com", 'uploads/services/2.png?v=1682479557', 'Base price of $200 per square meter, varies with complexity', 'fixed', 1, '2023-04-26 11:25:55', '2023-04-26 11:25:55'),

(3, 'Electrical Installations', 'Electrical', "Wired for perfection!", "789 Electric Ave, Metropolis", "7654321098", "electrical@example.com", 'uploads/services/3.png?v=1682479953', 'Installation starts at $100 per point, additional charges for premium fittings', 'negotiable', 1, '2023-04-26 11:32:33', '2023-04-26 11:32:33'),

(4, 'Waterworks', 'Plumbing', "We fix what flows!", "101 Plumbing St, Water City", "6543210987", "plumbing@example.com", 'uploads/services/4.png?v=1682481428', 'Basic repairs start at $30, larger projects quoted on request', 'fixed', 1, '2023-04-26 11:54:43', '2023-04-26 11:54:43'),

(6, "Coloring", "Painting", "Painting lives with vibrant colors!", "202 Paint Road, Color Town", "5432109876", "painting@example.com", "uploads/services/6.png?v=1738302277", "Starting at $5 per sq. ft., premium paints available at additional cost", "negotiable", 1, '2025-01-31 11:14:35', '2025-01-31 11:14:35'),

(7, "Masonry Service 2", "Construction", "Second sample service for masonry.", "303 Builder Lane, Brick City", "4321098765", "masonry2@example.com", "", "Base price of $180 per square meter, custom projects quoted separately", "fixed", 1, '2025-01-31 11:36:28', '2025-01-31 11:36:28'),

(8, "XYZ Tiling Company", "Tiling", "Expert flooring solutions.", "404 Tile Street, Floorville", "3210987654", "tiling@example.com", "uploads/services/8.png?v=1738835939", "Installation starts at $15 per sq. ft., price varies with tile type", "negotiable", 1, '2025-02-06 15:28:59', '2025-02-06 15:28:59');

--
-- Dumping data for table `service_list`
--


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


