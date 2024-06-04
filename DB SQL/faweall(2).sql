-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 09:23 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faweall`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `expiration`) VALUES
(0, 'harrymuthee254@gmail.com', '64d3a272581f0', '2023-08-09 18:28:02'),
(0, 'harrymuthee254@gmail.com', '64d3a300337e5', '2023-08-09 18:30:24'),
(0, 'harrisonmuthee254@gmail.com', '64d3a457028b9', '2023-08-09 18:36:07'),
(0, 'harrisonmuthee254@gmail.com', '64d3a51cc59d7', '2023-08-09 18:39:24'),
(0, 'harrisonmuthee254@gmail.com', '64d3a5e8e0f17', '2023-08-09 18:42:48'),
(0, 'harrymuthee254@gmail.com', '64d3a84c4b70a', '2023-08-09 18:53:00'),
(0, 'harrisonmuthee254@gmail.com', '64d3a859ef329', '2023-08-09 18:53:13'),
(0, 'harrymuthee254@gmail.com', '64d3a91f4f0b9', '2023-08-09 18:56:31'),
(0, 'harrymuthee254@gmail.com', '64d3c1366392c', '2023-08-09 20:39:18'),
(0, 'harrymuthee254@gmail.com', '64d48eb17f419', '2023-08-10 11:16:01'),
(0, 'harrymuthee254@gmail.com', '64d48fa0417c5', '2023-08-10 11:20:00'),
(0, 'harrymuthee254@gmail.com', '64d490e666c5b', '2023-08-10 11:25:26'),
(0, 'harrymuthee254@gmail.com', '64d49a1257bf0', '2023-08-10 12:04:34'),
(0, 'harrymuthee254@gmail.com', '64d49defc7b74', '2023-08-10 12:21:03'),
(0, 'harrymuthee254@gmail.com', '64d4a226b218e', '2023-08-10 12:39:02'),
(0, 'harrymuthee254@gmail.com', '64d4a2b6e0873', '2023-08-10 12:41:26'),
(0, 'harrymuthee254@gmail.com', '64d4a2bbe90fb', '2023-08-10 12:41:31'),
(0, 'harrymuthee254@gmail.com', '64d4a31a9a661', '2023-08-10 12:43:06'),
(0, 'harrymuthee254@gmail.com', '64d4a33a53763', '2023-08-10 12:43:38'),
(0, 'harrymuthee254@gmail.com', '64d4a39f302d20.65723771', '2023-08-10 12:45:19'),
(0, 'harrymuthee254@gmail.com', '64d4a437bdf3d7.29980641', '2023-08-10 12:47:51'),
(0, 'harrymuthee254@gmail.com', '64d4a4724f21e0.78809182', '2023-08-10 12:48:50'),
(0, 'harrymuthee254@gmail.com', '64d4a49c7fd789.59486006', '2023-08-10 12:49:32'),
(0, 'harrymuthee254@gmail.com', '64d4a49cdd8aa5.79453647', '2023-08-10 12:49:32'),
(0, 'harrymuthee254@gmail.com', '64d4a49d34aaa7.27187659', '2023-08-10 12:49:33'),
(0, 'harrymuthee254@gmail.com', '64d4b252897316.56584801', '2023-08-10 13:48:02'),
(0, 'harrymuthee254@gmail.com', '64d4b2650867f0.20854690', '2023-08-10 13:48:21'),
(0, 'harrymuthee254@gmail.com', '64d4b299926658.00318562', '2023-08-10 13:49:13'),
(0, 'harrymuthee254@gmail.com', '64d4b2ff1a1574.43284002', '2023-08-10 13:50:55'),
(0, 'harrymuthee254@gmail.com', '64d4b30c5338e6.96513334', '2023-08-10 13:51:08'),
(0, 'harrymuthee254@gmail.com', '64d4b3d139aa22.80706731', '2023-08-10 13:54:25'),
(0, 'harrisonmuthee254@gmail.com', '64d4b486c9c810.37178148', '2023-08-10 13:57:26'),
(0, 'harrymuthee254@gmail.com', '64d4b4ac172012.03157401', '2023-08-10 13:58:04'),
(0, 'harrymuthee254@gmail.com', '64d4b537be13b6.95371785', '2023-08-10 14:00:23'),
(0, 'harrymuthee254@gmail.com', '64d4c4c1b602b5.22894741', '2023-08-10 15:06:41'),
(0, 'harrymuthee254@gmail.com', '64d4c65d0beb59.35253537', '2023-08-10 15:13:33'),
(0, 'harrymuthee254@gmail.com', '64d4eb9f700a35.55578754', '2023-08-10 17:52:31'),
(0, 'harrymuthee254@gmail.com', '64d4eba1065fd6.96166488', '2023-08-10 17:52:33'),
(0, 'harrymuthee254@gmail.com', '64d4eba214aac2.41395996', '2023-08-10 17:52:34'),
(0, 'harrymuthee254@gmail.com', '64d4eba233b185.12385188', '2023-08-10 17:52:34'),
(0, 'harrymuthee254@gmail.com', '64d4eba266f912.46299478', '2023-08-10 17:52:34'),
(0, 'harrymuthee254@gmail.com', '64d4ebb30efb98.33635735', '2023-08-10 17:52:51'),
(0, 'harrymuthee254@gmail.com', '64d4ebb47c5d45.55464224', '2023-08-10 17:52:52'),
(0, 'harrymuthee254@gmail.com', '64d4ebb4b89886.07304587', '2023-08-10 17:52:52'),
(0, 'harrymuthee254@gmail.com', '64d4ebb4e8c983.48950930', '2023-08-10 17:52:52'),
(0, 'harrymuthee254@gmail.com', '64d4ebb52e2131.00431819', '2023-08-10 17:52:53'),
(0, 'harrymuthee254@gmail.com', '64d4ebb55b3be1.32439026', '2023-08-10 17:52:53'),
(0, 'harrymuthee254@gmail.com', '64d4ec71ece598.85842079', '2023-08-10 17:56:01'),
(0, 'harrymuthee254@gmail.com', '64d4ec7392ef24.49643605', '2023-08-10 17:56:03'),
(0, 'harrymuthee254@gmail.com', '64d4ec73add8c7.66507359', '2023-08-10 17:56:03'),
(0, 'harrymuthee254@gmail.com', '64d4ec73e7af08.91791135', '2023-08-10 17:56:03'),
(0, 'harrymuthee254@gmail.com', '64d4ec7470a2d9.39954130', '2023-08-10 17:56:04'),
(0, 'harrymuthee254@gmail.com', '64d4ec74a74650.08650595', '2023-08-10 17:56:04'),
(0, 'harrymuthee254@gmail.com', '64d4ec74dbd097.90977389', '2023-08-10 17:56:04'),
(0, 'harrymuthee254@gmail.com', '64d4ec7f70d022.93060710', '2023-08-10 17:56:15'),
(0, 'harrymuthee254@gmail.com', '64d4ecb14d8b32.61512158', '2023-08-10 17:57:05'),
(0, 'harrymuthee254@gmail.com', 'f644824e67e09daceebb9403c487fb3b', '2023-08-10 18:02:28'),
(0, 'harrymuthee254@gmail.com', 'd6082186c6713d47897062c66a65799c', '2023-08-10 18:02:29'),
(0, 'harrymuthee254@gmail.com', 'b50943a619a8a9c1b80cde14a19a9626', '2023-08-10 18:02:40'),
(0, 'harrymuthee254@gmail.com', '7780f2f93053d099d23a5ebe09e7e58f', '2023-08-10 18:04:04'),
(0, 'harrymuthee254@gmail.com', 'dab5668f3feb183e31b63537b37f4140', '2023-08-10 18:06:21'),
(0, 'harrymuthee254@gmail.com', 'bfec1fd682b1fea138325889bf650d90', '2023-08-10 18:06:46'),
(0, 'harrymuthee254@gmail.com', '5c3d03b63d82d78840cd3cd48ee35fbc', '2023-08-10 18:08:01'),
(0, 'harrymuthee254@gmail.com', '6ed2e0ad6bee80881375720e8ccf19c3', '2023-08-10 18:09:10'),
(0, 'harrymuthee254@gmail.com', 'fed498864810c2764cc26c0969791e51', '2023-08-10 18:09:12'),
(0, 'harrymuthee254@gmail.com', 'f938c4212a6d447573949d30a11c1bdf', '2023-08-10 18:12:34'),
(0, 'harrymuthee254@gmail.com', '3bf89d2a08f7e887458a5a08dd325ba3', '2023-08-10 18:13:32'),
(0, 'harrymuthee254@gmail.com', 'bbb955a13655aee49b8350c82e3b5ecb', '2023-08-10 18:14:22'),
(0, 'harrymuthee254@gmail.com', '650effaf93e27fdeebb37ea0057f0551', '2023-08-10 18:15:13'),
(0, 'hsdjhsd@hsdjh.com', 'b0a24a961441c983df33da396b57a321', '2023-08-10 18:15:30'),
(0, 'hsdjjhsd@uyasduy.com', '1c15f6553925e8b4a7d884d64a90981e', '2023-08-10 18:15:50'),
(0, 'harrymuthee254@gmail.com', 'a1d230d04937cb553f568e1103986868', '2023-08-10 18:25:15'),
(0, 'ghdfj@ajdjkds.com', '757e3ca997d0351105511afd7275747b', '2023-08-10 18:25:35'),
(0, 'harrymuthee254@gmail.com', '717ca9754ea7fffa1f82c84f85d894e4', '2023-08-10 18:40:48'),
(0, 'harrisonmuthee254@gmail.com', '530641fae8f261d4b39f29e15e27ec77', '2023-08-10 18:41:20'),
(0, 'harrymuthee254@gmail.com', '60a2481c9ba0091c03574fbcf0b9fad4', '2023-08-10 18:43:11'),
(0, 'harrymuthee254@gmail.com', '5ab39f55b5f5feeeb5083c5988c31588', '2023-08-10 19:56:06'),
(0, 'harrymuthee254@gmail.com', 'a812134dddcd596feaad8cd3a64259bf', '2023-08-11 11:06:37'),
(0, 'harrymuthee254@gmail.com', 'da6d183404e53ac6e04a999a807a7751', '2023-08-11 11:37:47'),
(0, 'harrymuthee254@gmail.com', '6d92dff7dfbe2b0fcb355b1a76aa5072', '2023-08-11 12:38:32'),
(0, 'harrymuthee254@gmail.com', 'af114b9bdad36915ad557bdad3f551be', '2023-08-11 12:59:25'),
(0, 'harrymuthee254@gmail.com', '497dcb406e41891041919a140689c0e3', '2023-08-11 13:01:13'),
(0, 'harrymuthee254@gmail.com', '2b90c54ef73234cb72b0900bee9b7c65', '2023-08-11 13:42:06'),
(0, 'harrymuthee254@gmail.com', '25c1459865713dbe7f44095f3f8cade8', '2023-08-11 14:05:12'),
(0, 'harrymuthee254@gmail.com', '4616412e239fe6a8cae9af4b414472fb', '2023-08-11 15:08:46'),
(0, 'atterobert@gmail.com', '374d3def65966eee0bbe65f8293f0b88', '2023-10-17 17:26:06'),
(0, 'atterobert@gmail.com', 'a6632b8111fe6aa13aaf544a9217527b', '2023-10-18 18:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int UNSIGNED NOT NULL,
  `perm_desc` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `perm_desc`) VALUES
(8, 'create_post'),
(10, 'delete_post'),
(9, 'edit_post');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int UNSIGNED NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(6, 'Admin'),
(7, 'Editor'),
(8, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE `role_perm` (
  `role_id` int UNSIGNED NOT NULL,
  `perm_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` (`role_id`, `perm_id`) VALUES
(6, 8),
(6, 9),
(6, 10),
(7, 8),
(7, 9),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int NOT NULL,
  `school_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `county` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_county` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `school_level` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `county`, `sub_county`, `school_level`, `created`, `modified`) VALUES
(23, 'Laiser Hill Academy', 'Kajiado', 'Kajiado North', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:00:34'),
(24, 'Murang\'a High', 'Elgeyo-Marakwet', 'Keiyo North', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:57:54'),
(25, 'Mang\'u High', 'Bungoma', 'Kanduyi', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:57:54'),
(26, 'Moi Girls', 'Bungoma', 'Bumula', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:57:54'),
(29, 'dsdgh', 'Bungoma', 'Kabuchai', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:57:54'),
(30, 'Starehe Girls', 'Nairobi City', 'Starehe', 'Secondary', '0000-00-00 00:00:00', '2023-08-13 21:57:54'),
(31, 'Kamiti', 'Baringo', 'Baringo South', 'Secondary', '2023-08-13 20:59:58', '2023-08-13 21:09:16'),
(32, 'Shimo la tewa', 'Kajiado', 'Isinya', 'Secondary', '2023-08-14 09:30:30', '2023-08-14 09:30:30'),
(33, 'Noonkopir Girls', 'Kajiado', 'Mashuuru', 'Secondary', '2023-08-14 09:31:24', '2023-08-14 09:31:24'),
(34, 'Nakeel Boys', 'Kajiado', 'Kajiado North', 'Secondary', '2023-08-14 09:32:07', '2023-08-14 09:32:07'),
(35, 'Oloitoktok Boys High Schools', 'Kajiado', 'Loitokitok', 'Secondary', '2023-08-14 14:31:27', '2023-08-14 14:31:27'),
(36, 'Olekejuado Boys High School', 'Kajiado', 'Kajiado Central', 'Secondary', '2023-08-14 14:32:31', '2023-08-14 14:32:31'),
(37, 'jael okello', 'Baringo', 'Baringo North', 'Primary', '2023-10-18 10:25:23', '2023-10-18 10:25:23'),
(38, 'fawe', 'Baringo', 'Baringo Central', 'Secondary', '2023-10-18 10:32:02', '2023-10-18 10:32:02'),
(39, 'Joel Omino', 'Kisumu', 'Kisumu Central', 'Secondary', '2023-10-18 14:07:43', '2023-10-18 14:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int NOT NULL,
  `sponsor_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_of_origin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sponsor_type` enum('Individual','Organization','Family') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `additional_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `sponsor_name`, `email`, `phone_number`, `country_of_origin`, `sponsor_type`, `additional_info`, `created`, `modified`) VALUES
(1, 'Fawe school', 'fawe@gmail.com', '0768556666', 'Kenya', 'Organization', 'none', '2023-10-19 15:50:08', '2023-10-19 15:50:08'),
(2, 'tadeo', 'tadeo@oslabs.cpom', '07838448443', 'USA', 'Individual', 'none', '2023-10-19 15:58:28', '2023-10-19 15:58:28'),
(3, 'Robert Ate Aringo', 'atterobert9@gmail.com', '076823323', 'Malawi', 'Family', 'none', '2023-10-21 11:49:11', '2023-10-21 11:49:11'),
(4, 'Isaac Shaloom', 'shalom@gmail.com', '07659549434', 'Uganda', 'Family', 'none', '2023-10-21 11:54:04', '2023-10-21 11:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `guardian_first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `guardian_middle_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `date_of_birth` date NOT NULL,
  `school_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `expected_completion_date` date NOT NULL,
  `student_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `dropout_reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `other_dropout_reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `school_id` int DEFAULT NULL,
  `primary_sponsor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `guardian_first_name`, `guardian_middle_name`, `guardian_last_name`, `age`, `date_of_birth`, `school_name`, `expected_completion_date`, `student_status`, `dropout_reason`, `other_dropout_reason`, `created`, `modified`, `school_id`, `primary_sponsor_id`) VALUES
(107, 'kelvin', 'Maina', 'njoro', 'male', 'samoei', 'aringo', 'aaa', 7, '2016-10-12', 'fawe', '2023-10-05', 'dropout', 'Pregnancy', '', '2023-10-18 16:32:49', '2023-10-18 16:32:49', NULL, NULL),
(108, 'Joan', 'Anyango', 'Abonyo', 'Female', 'Ann', 'Anyango', 'Abonyo', 19, '2004-10-12', 'Starehe Girls', '2023-10-27', 'ongoing', NULL, NULL, '2023-10-19 14:37:22', '2023-10-19 14:37:22', NULL, NULL),
(109, 'Milicent', 'cheruiyot', 'Akengo', 'Female', 'Molly', 'Kotieno', 'Kodindo', 14, '2009-09-12', 'Kamiti', '2023-10-05', 'ongoing', NULL, NULL, '2023-10-21 10:41:07', '2023-10-21 10:41:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_sponsor`
--

CREATE TABLE `student_sponsor` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `sponsor_id` int NOT NULL,
  `sponsor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_sponsor`
--

INSERT INTO `student_sponsor` (`id`, `student_id`, `sponsor_id`, `sponsor_name`, `created`, `modified`) VALUES
(17, 107, 1, 'Fawe school', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `profile_image` longblob NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `reset_token` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `profile_image`, `password`, `reset_token`, `created`, `modified`, `status`) VALUES
(1, 'harry', 'carter', 'harrymuthee254@gmail.com', 0x757365725f36346462336365343335663136332e32313438383433382e6a7067, '86807ca0fad4162bf65a9e56f9b44cdd', '', '2023-07-10 15:04:10', '2023-07-14 10:31:09', 1),
(5, 'harry', 'carter', 'a23@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '2023-07-11 09:33:44', '2023-07-11 09:33:44', 1),
(8, 'harry', 'carter', 'hhassa@hashash.com', '', '625432e6510a9ece7aad4f354d6635ca', '', '2023-07-11 10:53:24', '2023-07-11 10:53:24', 1),
(9, 'harry', 'carter', 'hwe@fasf.com', '', 'b102858ec80ca0d9152dafc8b2038d58', '', '2023-07-11 13:37:08', '2023-07-11 13:37:08', 1),
(10, 'harry', 'carter', 'hh@fgfg.bbn', '', 'b5bd8bbcea3551aa283a892d65f93426', '', '2023-07-11 14:04:31', '2023-07-11 14:04:31', 1),
(11, 'Harry', 'Mayolo', 'ndabia.students@jkuat.ac.ke', '', 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-07-14 10:29:08', '2023-07-14 10:29:08', 1),
(12, 'harry', 'carter', 'editor@gmail.com', 0x757365725f36346434393962663939316162322e32363831383839302e6a7067, 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-08-09 14:15:30', '2023-08-09 14:15:30', 1),
(13, 'rob', 'carter', 'harrisonmuthee254@gmail.com', '', 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-08-09 16:32:00', '2023-08-09 16:32:00', 1),
(14, 'user', 'carter', 'user@gmail.com', 0x757365725f36346462336537373530363661342e32313537333933302e6a7067, 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-08-10 11:12:13', '2023-08-10 11:12:13', 1),
(17, 'harry', 'carter', 'harrymuthee@gmail.com', '', 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-08-12 10:15:34', '2023-08-12 10:15:34', 1),
(18, 'john', 'omollo', 'dorineatte@gmail.com', '', '7cd43b9dc4a39f697c51510f9c4feb3c', '', '2023-08-12 10:19:10', '2023-08-12 10:19:10', 1),
(19, 'James', 'carter', 'harrymuthe@gmail.com', '', 'dd5d01bc8fb0fe85bd0ca360058f24ce', '', '2023-08-13 17:46:16', '2023-08-13 17:46:16', 1),
(24, 'Kenedy', 'Rapudo', 'rob@gmail.com', '', '7cd43b9dc4a39f697c51510f9c4feb3c', '', '2023-08-16 07:56:55', '2023-08-16 07:56:55', 1),
(26, 'Robert', 'ted', 'robertbillatte@gmail.com', '', '7cd43b9dc4a39f697c51510f9c4feb3c', '', '2023-08-16 08:05:32', '2023-08-16 08:05:32', 1),
(27, 'Robert', 'Ate', 'atterobert@gmail.com', '', '9c759f1a814c46aa543d7d84d8b9ae4d', '', '2023-10-17 15:25:59', '2023-10-17 15:25:59', 1),
(28, 'Isaac', 'Shalom', 'isac@gmail.com', '', '6115329b9f3cd4febd30906e5f7fabea', '', '2023-10-21 10:28:04', '2023-10-21 10:28:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 6),
(1, 7),
(1, 8),
(12, 7),
(14, 8),
(17, 8),
(18, 8),
(24, 8),
(27, 6),
(28, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`),
  ADD UNIQUE KEY `perm_desc` (`perm_desc`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD UNIQUE KEY `role_id_2` (`role_id`,`perm_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `role_perm_ibfk_2` (`perm_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `student_fk_primary_sponsor` (`primary_sponsor_id`);

--
-- Indexes for table `student_sponsor`
--
ALTER TABLE `student_sponsor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sponsor_id` (`sponsor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD UNIQUE KEY `user_id_2` (`user_id`,`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `perm_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `student_sponsor`
--
ALTER TABLE `student_sponsor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD CONSTRAINT `role_perm_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `role_perm_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_fk_primary_sponsor` FOREIGN KEY (`primary_sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_sponsor`
--
ALTER TABLE `student_sponsor`
  ADD CONSTRAINT `student_sponsor_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_sponsor_ibfk_2` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
