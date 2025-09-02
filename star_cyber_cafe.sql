-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2025 at 07:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star cyber cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`) VALUES
(9, 'Jobs', '-Jobs', '2025-06-15 11:49:32'),
(10, 'Admit Card', 'Current Admit Card', '2025-06-15 11:49:41'),
(11, 'Results', 'Results', '2025-06-15 11:49:50'),
(13, 'Current Job', 'All Vacancy Details', '2025-06-22 04:13:40'),
(15, 'SCHOLARSHIP', 'All type of scholarship', '2025-07-18 06:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_filename`, `description`, `upload_date`) VALUES
(1, '6861840bc994d.jpg', 'test', '2025-06-29 14:50:59'),
(2, '68618424c5dfc.jpg', 'test', '2025-06-29 14:51:24'),
(3, '6873d6cd59c36.jpg', 'test', '2025-07-13 12:24:53'),
(4, '6873d6d4815c2.jpg', 'test', '2025-07-13 12:25:00'),
(5, '6873d6db22f4a.jpg', 'test', '2025-07-13 12:25:07'),
(6, '6873d6e21e5f5.png', 'test', '2025-07-13 12:25:14'),
(7, '6873d6edaca8b.jpg', 'test', '2025-07-13 12:25:25'),
(8, '6873d6f524674.png', 'test', '2025-07-13 12:25:33'),
(9, '6873d6fd2ebbd.PNG', 'manav kalyan', '2025-07-13 12:25:41'),
(10, '6873d702d8005.jpg', 'mysy', '2025-07-13 12:25:46'),
(11, '6873d70a69c69.jpg', 'nsp', '2025-07-13 12:25:54'),
(12, '6873d712ded2f.png', 'passport', '2025-07-13 12:26:02'),
(13, '6873d71cabbc8.jpg', 'pm', '2025-07-13 12:26:12'),
(14, '6873d724761c2.jpg', 'ration', '2025-07-13 12:26:20'),
(15, '6873d72b0685b.JPG', 'rte', '2025-07-13 12:26:27'),
(16, '6873d731a805f.jpg', 'v card', '2025-07-13 12:26:33'),
(17, '6873d739685f7.jpg', 'vidhya mandir', '2025-07-13 12:26:41'),
(18, '6873d7418a208.jpeg', 'whatsapp data', '2025-07-13 12:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `vacancy_count` int(11) DEFAULT NULL,
  `education_required` varchar(255) DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `age_between` varchar(50) DEFAULT NULL,
  `age_relaxation` text DEFAULT NULL,
  `application_fee` varchar(100) DEFAULT NULL,
  `documents_required` text DEFAULT NULL,
  `file_attachment` varchar(255) DEFAULT NULL,
  `rich_text_description` longtext DEFAULT NULL,
  `external_link` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `is_featured` tinyint(1) DEFAULT 0,
  `auto_delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `vacancy_count`, `education_required`, `date_posted`, `age_between`, `age_relaxation`, `application_fee`, `documents_required`, `file_attachment`, `rich_text_description`, `external_link`, `status`, `is_featured`, `auto_delete_date`) VALUES
(10, 9, 'Junior Clerk Recruitment 2025', 2500, 'NUll', '2025-06-19 18:30:00', 'age 1 to 5', 'obc 1 to 5', '1500', 'null of ', '6861288ecce6d.pdf', 'test test test test test test test ', 'https://example.com/apply1', 'active', 1, NULL),
(11, 9, 'Railway Group D Vacancy', NULL, NULL, '2025-06-17 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/apply2', 'active', 1, NULL),
(12, 9, 'Forest Guard Bharti 2025', NULL, NULL, '2025-06-18 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/apply3', 'active', 0, NULL),
(13, 9, 'Post Office GDS Jobs', NULL, NULL, '2025-06-16 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/apply4', 'active', 0, NULL),
(15, 10, 'SSC CGL Admit Card 2025', NULL, NULL, '2025-06-14 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/ssc-cgl', 'active', 1, NULL),
(16, 10, 'UPSC Prelims Admit Card', NULL, NULL, '2025-06-13 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/upsc', 'active', 0, NULL),
(17, 10, 'Bank PO Admit Card', NULL, NULL, '2025-06-12 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/bankpo', 'active', 0, NULL),
(18, 10, 'Railway NTPC Admit Card', NULL, NULL, '2025-06-11 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/ntpc', 'active', 0, NULL),
(19, 10, 'State Police Exam Admit Card', NULL, NULL, '2025-06-10 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/police', 'active', 0, NULL),
(20, 11, 'SSC CGL 2024 Result', NULL, NULL, '2025-06-09 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/ssc-result', 'active', 1, NULL),
(21, 11, 'UPSC Final Result 2024', NULL, NULL, '2025-06-08 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/upsc-result', 'active', 0, NULL),
(22, 11, 'Bank Clerk Result', NULL, NULL, '2025-06-07 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/bank-result', 'active', 0, NULL),
(23, 11, 'Railway Group D Result', NULL, NULL, '2025-06-06 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/railway-result', 'active', 0, NULL),
(24, 11, 'Forest Guard 2024 Result', NULL, NULL, '2025-06-05 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/forest-result', 'active', 0, NULL),
(32, 9, 'Staff Nurse Recruitment 2025', NULL, NULL, '2025-06-20 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/staff-nurse', 'active', 1, NULL),
(33, 9, 'Defense Civilian Jobs', 1500, '15', '2025-06-20 18:30:00', 'kh45', '', '0', '', NULL, '', 'https://example.com/defense', 'active', 0, NULL),
(34, 9, 'AAI Junior Executive Recruitment', NULL, NULL, '2025-06-19 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/aai', 'active', 0, NULL),
(36, 10, 'State Engineering Exam Admit Card', 5, '', '2025-06-17 18:30:00', 'jg;j\'k', 'sdhs', '6454654654654', '', '6873d5a335d02.pdf', 'mdhfjhd\r\n', 'https://www.instagram.com/p/DLXi2M3yONx/', 'active', 0, NULL),
(37, 10, 'NEET UG Admit Card', 0, '', '2025-06-16 18:30:00', '', '', '200', '', NULL, '', 'https://example.com/neet', 'active', 1, NULL),
(38, 10, 'JEE Mains Admit Card 2025', NULL, NULL, '2025-06-15 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/jee', 'active', 0, NULL),
(39, 10, 'Gujarat TAT Admit Card', NULL, NULL, '2025-06-14 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/tat', 'active', 0, NULL),
(40, 11, 'NEET Result 2025', NULL, NULL, '2025-06-19 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/neet-result', 'active', 0, NULL),
(41, 11, 'JEE Mains 2025 Result', NULL, NULL, '2025-06-18 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/jee-result', 'active', 1, NULL),
(42, 11, 'Police Constable Result', NULL, NULL, '2025-06-17 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/police-result', 'active', 0, NULL),
(43, 11, 'SSC CHSL Final Result', NULL, NULL, '2025-06-16 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/chsl', 'active', 0, NULL),
(44, 11, 'Bank PO Result 2024', NULL, NULL, '2025-06-15 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/bankpo-result', 'active', 0, NULL),
(50, 13, 'test', NULL, NULL, '2025-05-31 18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'https://example.com/income-tax', 'active', 0, NULL),
(69, 15, 'ttt', 0, '', '2025-07-18 10:08:28', '', '', '0', '', '687d201b5578d.jpg', '', '', 'active', 0, '2025-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `post_custom_dates`
--

CREATE TABLE `post_custom_dates` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date_type` varchar(255) NOT NULL,
  `date_value` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_custom_dates`
--

INSERT INTO `post_custom_dates` (`id`, `post_id`, `date_type`, `date_value`) VALUES
(44, 10, 'Last Date', '2000-01-01'),
(45, 10, 'Last Date', '2222-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `created_at`) VALUES
(9, 'Browsing & Internet Access', 'ast and secure internet access for all your needs.\r\n\r\nOnl', 'fas fa-globe', '2025-06-29 12:39:00'),
(10, 'ast and secure internet access for all your needs.  Onl', 'ast and secure internet access for all your needs.\r\n\r\nOnl', 'fas fa-file-alt', '2025-06-29 12:40:29'),
(11, 'test', 'test', 'fas fa-id-card', '2025-06-29 12:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Alice Johnson', 'admin', 'admin123', 'admin', '2025-06-15 11:26:37'),
(2, 'Bob Smith', 'bobsmith', 'hashedpassword2', 'staff', '2025-06-15 11:26:37'),
(3, 'Charlie Brown', 'charlieb', 'hashedpassword3', 'staff', '2025-06-15 11:26:37'),
(4, 'Dana White', 'danaw', 'hashedpassword4', 'admin', '2025-06-15 11:26:37'),
(5, 'Eve Davis', 'eved', 'hashedpassword5', 'staff', '2025-06-15 11:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `visit_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`) VALUES
(1, '::1', '2025-06-29 18:50:31'),
(2, '172.16.0.25', '2024-07-01 11:15:01'),
(3, '10.0.0.123', '2024-07-01 12:40:55'),
(4, '203.0.113.77', '2024-07-01 14:02:18'),
(5, '198.51.100.15', '2024-07-01 15:23:45'),
(6, '192.168.1.100', '2024-07-01 16:35:10'),
(7, '172.16.0.50', '2024-07-02 09:00:05'),
(8, '10.0.0.1', '2024-07-02 10:10:20'),
(9, '203.0.113.10', '2024-07-02 11:25:30'),
(10, '198.51.100.200', '2024-07-02 13:00:00'),
(11, '192.168.1.5', '2024-07-02 14:12:34'),
(12, '172.16.0.10', '2024-07-03 08:30:15'),
(13, '10.0.0.250', '2024-07-03 09:45:00'),
(14, '203.0.113.1', '2024-07-03 11:05:07'),
(15, '198.51.100.5', '2024-07-03 12:20:30'),
(16, '192.168.1.20', '2024-07-03 13:30:40'),
(17, '172.16.0.75', '2024-07-04 07:50:00'),
(18, '10.0.0.150', '2024-07-04 09:05:10'),
(19, '203.0.113.25', '2024-07-04 10:15:25'),
(20, '198.51.100.120', '2024-07-04 11:30:50'),
(21, '192.168.1.30', '2024-07-04 12:40:00'),
(22, '172.16.0.99', '2024-07-05 06:10:20'),
(23, '10.0.0.200', '2024-07-05 07:25:35'),
(24, '203.0.113.40', '2024-07-05 08:40:50'),
(25, '198.51.100.80', '2024-07-05 09:55:00'),
(26, '192.168.1.40', '2024-07-05 11:10:15'),
(27, '172.16.0.110', '2024-07-06 05:00:00'),
(28, '10.0.0.25', '2024-07-06 06:15:30'),
(29, '203.0.113.55', '2024-07-06 07:30:45'),
(30, '198.51.100.10', '2024-07-06 08:45:00'),
(31, '192.168.1.60', '2024-07-06 10:00:10'),
(32, '172.16.0.130', '2024-07-07 04:20:00'),
(33, '10.0.0.33', '2024-07-07 05:35:10'),
(34, '203.0.113.70', '2024-07-07 06:50:20'),
(35, '198.51.100.30', '2024-07-07 08:05:30'),
(36, '192.168.1.80', '2024-07-07 09:20:40'),
(37, '172.16.0.150', '2024-07-08 03:00:00'),
(38, '10.0.0.44', '2024-07-08 04:15:05'),
(39, '203.0.113.85', '2024-07-08 05:30:10'),
(40, '198.51.100.45', '2024-07-08 06:45:15'),
(41, '192.168.1.90', '2024-07-08 08:00:20'),
(42, '172.16.0.170', '2024-07-09 02:00:00'),
(43, '10.0.0.55', '2024-07-09 03:10:05'),
(44, '203.0.113.100', '2024-07-09 04:20:10'),
(45, '198.51.100.60', '2024-07-09 05:30:15'),
(46, '192.168.1.110', '2024-07-09 06:40:20'),
(47, '172.16.0.190', '2024-07-10 01:00:00'),
(48, '10.0.0.66', '2024-07-10 02:05:05'),
(49, '203.0.113.115', '2024-07-10 03:10:10'),
(50, '198.51.100.75', '2024-07-10 04:15:15'),
(51, '192.168.1.120', '2024-07-10 05:20:20'),
(52, '172.16.0.210', '2024-07-11 00:00:00'),
(53, '10.0.0.77', '2024-07-11 01:00:05'),
(54, '203.0.113.130', '2024-07-11 02:00:10'),
(55, '198.51.100.90', '2024-07-11 03:00:15'),
(56, '192.168.1.130', '2024-07-11 04:00:20'),
(57, '172.16.0.230', '2024-07-12 23:00:00'),
(58, '10.0.0.88', '2024-07-12 23:30:05'),
(59, '203.0.113.145', '2024-07-13 00:00:10'),
(60, '198.51.100.105', '2024-07-13 00:30:15'),
(61, '192.168.1.140', '2024-07-13 01:00:20'),
(62, '172.16.0.240', '2024-07-13 22:00:00'),
(63, '10.0.0.99', '2024-07-13 22:15:05'),
(64, '203.0.113.160', '2024-07-13 22:30:10'),
(65, '198.51.100.130', '2024-07-13 22:45:15'),
(66, '192.168.1.150', '2024-07-13 23:00:20'),
(67, '172.16.0.250', '2024-07-14 21:00:00'),
(68, '10.0.0.111', '2024-07-14 21:10:05'),
(69, '203.0.113.175', '2024-07-14 21:20:10'),
(70, '198.51.100.145', '2024-07-14 21:30:15'),
(71, '192.168.1.160', '2024-07-14 21:40:20'),
(72, '172.16.0.255', '2024-07-15 20:00:00'),
(73, '10.0.0.121', '2024-07-15 20:05:05'),
(74, '203.0.113.190', '2024-07-15 20:10:10'),
(75, '198.51.100.160', '2024-07-15 20:15:15'),
(76, '192.168.1.170', '2024-07-15 20:20:20'),
(77, '172.16.1.1', '2024-07-16 19:00:00'),
(78, '10.0.0.133', '2024-07-16 19:02:05'),
(79, '203.0.113.205', '2024-07-16 19:04:10'),
(80, '198.51.100.175', '2024-07-16 19:06:15'),
(81, '192.168.1.180', '2024-07-16 19:08:20'),
(82, '172.16.1.10', '2024-07-17 18:00:00'),
(83, '10.0.0.144', '2024-07-17 18:01:05'),
(84, '203.0.113.220', '2024-07-17 18:02:10'),
(85, '198.51.100.190', '2024-07-17 18:03:15'),
(86, '192.168.1.190', '2024-07-17 18:04:20'),
(87, '172.16.1.20', '2024-07-18 17:00:00'),
(88, '10.0.0.155', '2024-07-18 17:00:30'),
(89, '203.0.113.235', '2024-07-18 17:01:00'),
(90, '198.51.100.210', '2024-07-18 17:01:30'),
(91, '192.168.1.200', '2024-07-18 17:02:00'),
(92, '172.16.1.30', '2024-07-19 16:00:00'),
(93, '10.0.0.166', '2024-07-19 16:00:10'),
(94, '203.0.113.250', '2024-07-19 16:00:20'),
(95, '198.51.100.225', '2024-07-19 16:00:30'),
(96, '192.168.1.210', '2024-07-19 16:00:40'),
(97, '172.16.1.40', '2024-07-20 15:00:00'),
(98, '10.0.0.177', '2024-07-20 15:00:05'),
(99, '198.51.100.240', '2024-07-20 15:00:10'),
(100, '192.168.1.220', '2024-07-20 15:00:15'),
(101, '192.168.1.10', '2024-07-01 10:05:32'),
(102, '172.20.5.33', '2025-06-29 10:05:45'),
(103, '10.0.1.150', '2025-06-29 11:30:10'),
(104, '203.0.113.88', '2025-06-29 12:40:00'),
(105, '198.51.100.22', '2025-06-29 13:55:30'),
(106, '192.168.0.25', '2025-06-29 14:10:05'),
(107, '172.20.5.42', '2025-06-29 15:20:15'),
(108, '10.0.1.180', '2025-06-29 16:35:50'),
(109, '203.0.113.99', '2025-06-29 17:45:00'),
(110, '198.51.100.37', '2025-06-29 18:00:22'),
(111, '192.168.0.10', '2025-06-29 09:15:20'),
(112, '::1', '2025-06-29 21:50:18'),
(113, '::1', '2025-06-29 22:21:37'),
(114, '::1', '2025-06-29 22:52:01'),
(115, '::1', '2025-06-29 23:27:25'),
(116, '::1', '2025-06-29 23:59:17'),
(117, '::1', '2025-06-30 19:53:01'),
(118, '::1', '2025-06-30 20:23:20'),
(119, '::1', '2025-07-06 18:30:10'),
(120, '::1', '2025-07-06 19:04:11'),
(121, '::1', '2025-07-11 21:35:14'),
(122, '::1', '2025-07-11 22:48:20'),
(123, '::1', '2025-07-13 14:51:57'),
(124, '::1', '2025-07-13 20:11:22'),
(125, '::1', '2025-07-13 20:48:37'),
(126, '::1', '2025-07-13 21:20:01'),
(127, '::1', '2025-07-13 22:06:18'),
(128, '::1', '2025-07-18 15:19:19'),
(129, '127.0.0.1', '2025-07-18 15:21:52'),
(130, '::1', '2025-07-18 15:51:25'),
(131, '::1', '2025-07-20 05:53:13'),
(132, '::1', '2025-07-20 11:09:27'),
(133, '::1', '2025-07-20 11:39:33'),
(134, '::1', '2025-07-20 12:10:31'),
(135, '::1', '2025-07-20 12:40:39'),
(136, '::1', '2025-07-20 13:10:40'),
(137, '::1', '2025-07-20 14:06:15'),
(138, '::1', '2025-07-20 14:37:28'),
(139, '::1', '2025-07-20 15:09:32'),
(140, '::1', '2025-07-20 15:39:58'),
(141, '::1', '2025-07-20 17:07:27'),
(142, '::1', '2025-07-20 18:00:40'),
(143, '::1', '2025-07-20 22:04:41'),
(144, '::1', '2025-08-14 21:08:42'),
(145, '::1', '2025-08-22 22:40:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_custom_dates`
--
ALTER TABLE `post_custom_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `post_custom_dates`
--
ALTER TABLE `post_custom_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_custom_dates`
--
ALTER TABLE `post_custom_dates`
  ADD CONSTRAINT `post_custom_dates_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
