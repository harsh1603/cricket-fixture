-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2020 at 06:10 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket_fixture`
--

-- --------------------------------------------------------

--
-- Table structure for table `cricket_match`
--

CREATE TABLE `cricket_match` (
  `id` int(11) NOT NULL,
  `team_a_id` int(11) DEFAULT NULL,
  `team_b_id` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `match_date` date DEFAULT NULL,
  `match_status` varchar(255) DEFAULT NULL,
  `win_team_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cricket_match`
--

INSERT INTO `cricket_match` (`id`, `team_a_id`, `team_b_id`, `venue`, `match_date`, `match_status`, `win_team_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Newlands', '2020-08-20', 'Not Available', NULL, 1, '2020-08-06 11:51:59', '2020-08-06 18:21:59'),
(2, 1, 4, 'Newlands', '2020-08-09', 'Australia win by 16 runs', 1, 1, '2020-08-06 11:52:13', '2020-08-06 18:22:13'),
(3, 4, 3, 'Newlands', '2020-08-08', 'India win by 16 runs', 3, 1, '2020-08-06 11:52:18', '2020-08-06 18:22:18'),
(4, 1, 3, 'Kolkata', '2020-09-08', 'Not Available', NULL, 1, '2020-08-06 11:52:23', '2020-08-06 18:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `cricket_players`
--

CREATE TABLE `cricket_players` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jersey_no` int(11) DEFAULT NULL,
  `no_of_match` int(11) DEFAULT NULL,
  `no_of_run` int(11) DEFAULT NULL,
  `no_of_six` int(11) DEFAULT NULL,
  `no_of_four` int(11) DEFAULT NULL,
  `no_of_wicket` int(11) DEFAULT NULL,
  `highest_score` int(11) DEFAULT NULL,
  `no_of_catch` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cricket_players`
--

INSERT INTO `cricket_players` (`id`, `first_name`, `last_name`, `name`, `specialist`, `jersey_no`, `no_of_match`, `no_of_run`, `no_of_six`, `no_of_four`, `no_of_wicket`, `highest_score`, `no_of_catch`, `team_id`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Sanath', 'Jayasuriya', 'Sanath Jayasuriya', 'Batsman', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(2, 'Shaun', 'Pollock', 'Shaun Pollock', 'Bowler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(3, 'Denagamage', 'Jayawardene', 'Mahela Jayawardene', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(4, 'Mark', 'Boucher', 'Mark Boucher', 'Wicket Keeper', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(5, 'Mohammad', 'Yousuf', 'Mohammad Yousuf', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(6, 'Harbhajan', 'Singh', 'Harbhajan Singh', 'Bowler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(7, 'Shahid', 'Afridi', 'Shahid Afridi', 'All-rounder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(8, 'Imran', 'Nazir', 'Imran Nazir', 'Opening Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(9, 'Hendrik', 'Dippenaar', 'Boeta Dippenaar', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(10, 'Tillakaratne', 'Dilshan', 'Tillakaratne Dilshan', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(11, 'Mohammad', 'Rafique', 'Mohammad Rafique', 'Bowler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(12, 'Justin', 'Kemp', 'Justin Kemp', 'All-rounder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(13, 'Peter', 'Ongondo', 'Peter Ongondo', 'Bowler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(14, 'Virender', 'Sehwag', 'Virender Sehwag', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(15, 'Shoaib', 'Malik', 'Shoaib Malik', 'All-rounder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(16, 'Stephen', 'Tikolo', 'Steve Tikolo', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(17, 'Yuvraj', 'Singh', 'Yuvraj Singh', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(18, 'Mohammad', 'Ashraful', 'Mohammad Ashraful', 'Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(19, 'Mashrafe', 'Mortaza', 'Mashrafe Mortaza', 'Bowler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(20, 'Kamran', 'Akmal', 'Kamran Akmal', 'Wicket Keeper', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(21, 'Vusimuzi', 'Sibanda', 'Vusi Sibanda', 'Opening Batsman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48'),
(22, 'Elton', 'Chigumbura', 'Elton Chigumbura', 'All-rounder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dummy.png', 1, NULL, NULL, '2020-08-06 03:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `cricket_points`
--

CREATE TABLE `cricket_points` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `played` int(11) DEFAULT 0,
  `match_tied` int(11) DEFAULT 0,
  `match_won` int(11) DEFAULT 0,
  `match_lose` int(11) DEFAULT 0,
  `match_id` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cricket_points`
--

INSERT INTO `cricket_points` (`id`, `team_id`, `played`, `match_tied`, `match_won`, `match_lose`, `match_id`, `points`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 0, 1, 0, '2020-08-06 18:22:48'),
(2, 3, 1, 0, 0, 0, 1, 0, '2020-08-06 18:22:51'),
(3, 1, 1, 0, 0, 1, 2, 0, '2020-08-06 18:24:35'),
(4, 4, 1, 0, 1, 0, 2, 10, '2020-08-06 18:22:55'),
(5, 4, 1, 0, 1, 0, 3, 10, '2020-08-06 18:22:56'),
(6, 3, 1, 0, 0, 1, 3, 0, '2020-08-06 18:24:38'),
(7, 1, 1, 0, 0, 0, 4, 0, '2020-08-06 18:23:02'),
(8, 3, 1, 0, 0, 0, 4, 0, '2020-08-06 18:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `cricket_teams`
--

CREATE TABLE `cricket_teams` (
  `id` int(10) NOT NULL,
  `SYMID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active,0:deactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cricket_teams`
--

INSERT INTO `cricket_teams` (`id`, `SYMID`, `name`, `short_name`, `image`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AUS', 'Australia', 'AUS', '1596634966.jpg', 1, 1, '2020-08-05 07:12:46', '2020-08-05 13:42:46'),
(2, 'ENG', 'England', 'ENG', '1596634994.jpg', 1, 1, '2020-08-05 07:13:14', '2020-08-05 13:43:14'),
(3, 'IND', 'India', 'IND', '1596635003.jpg', 1, 1, '2020-08-05 07:13:23', '2020-08-05 13:43:23'),
(4, 'NZL', 'New Zealand', 'NZ', '1596635105.jpg', 1, 1, '2020-08-05 07:15:05', '2020-08-05 13:45:05'),
(5, 'PAK', 'Pakistan', 'PAK', '1596635115.jpg', 1, 1, '2020-08-05 07:15:15', '2020-08-05 13:45:15'),
(6, 'SAF', 'South Africa', 'SA', '1596635127.jpg', 1, 1, '2020-08-05 07:15:27', '2020-08-05 13:45:27'),
(7, 'SRL', 'Sri Lanka', 'SL', '1596635143.jpg', 1, 1, '2020-08-05 07:15:43', '2020-08-05 13:45:43'),
(8, 'WIN', 'West Indies', 'WI', '1596635157.jpg', 1, 1, '2020-08-05 07:15:57', '2020-08-05 13:45:57'),
(10, 'BAN', 'Bangladesh', 'BAN', '1596634953.jpg', 1, 1, '2020-08-05 07:12:33', '2020-08-05 13:42:33'),
(95, 'AFG', 'Afghanistan', 'AFG', '1596634975.jpg', 1, 1, '2020-08-05 07:12:55', '2020-08-05 13:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_04_15_191331679173_create_1555355612601_permissions_table', 1),
(3, '2019_04_15_191331731390_create_1555355612581_roles_table', 1),
(4, '2019_04_15_191331779537_create_1555355612782_users_table', 1),
(5, '2019_04_15_191332603432_create_1555355612603_permission_role_pivot_table', 1),
(6, '2019_04_15_191332791021_create_1555355612790_role_user_pivot_table', 1),
(7, '2019_04_15_191441675085_create_1555355681975_products_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(2, 'permission_create', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(3, 'permission_edit', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(4, 'permission_show', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(5, 'permission_delete', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(6, 'permission_access', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(7, 'role_create', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(8, 'role_edit', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(9, 'role_show', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(10, 'role_delete', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(11, 'role_access', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(12, 'user_create', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(13, 'user_edit', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(14, 'user_show', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(15, 'user_delete', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(16, 'user_access', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(17, 'product_create', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(18, 'product_edit', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(19, 'product_show', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(20, 'product_delete', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(21, 'product_access', '2019-04-15 13:44:42', '2019-04-15 13:44:42', NULL),
(22, 'bill_access', '2020-06-18 08:34:01', '2020-06-18 08:34:01', NULL),
(23, 'bill_create', '2020-06-18 08:34:12', '2020-06-18 08:34:12', NULL),
(24, 'bill_edit', '2020-06-18 08:34:23', '2020-06-18 08:34:23', NULL),
(25, 'bill_show', '2020-06-18 08:34:39', '2020-06-18 08:34:39', NULL),
(26, 'bill_delete', '2020-06-18 08:34:46', '2020-06-18 08:34:46', NULL),
(27, 'purchase_bill_access', '2020-07-02 11:30:15', '2020-07-02 11:30:15', NULL),
(28, 'purchase_bill_show', '2020-07-02 11:30:44', '2020-07-02 11:30:44', NULL),
(29, 'purchase_bill_delete', '2020-07-02 11:31:02', '2020-07-02 11:31:02', NULL),
(30, 'purchase_bill_create', '2020-07-02 11:31:38', '2020-07-02 11:31:38', NULL),
(31, 'company_access', '2020-07-14 13:14:26', '2020-07-14 13:14:26', NULL),
(32, 'company_create', '2020-07-14 13:14:36', '2020-07-14 13:14:36', NULL),
(33, 'company_edit', '2020-07-14 13:14:48', '2020-07-14 13:14:48', NULL),
(34, 'company_delete', '2020-07-14 13:15:01', '2020-07-14 13:15:01', NULL),
(35, 'setting_access', '2020-07-14 13:15:16', '2020-07-14 13:15:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-04-15 13:43:32', '2019-04-15 13:43:32', NULL),
(2, 'User', '2019-04-15 13:43:32', '2019-04-15 13:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `mobile` varchar(190) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `company_name`, `mobile`, `email`, `address`, `gst`) VALUES
(1, 'Furniture Town', '9006392830, 6202281325,9905845758', NULL, 'Line Bazar Chowk, Hospital Road, Purnea (Bihar)', '10BYBPK4688J1ZC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO', NULL, '2019-04-15 13:43:32', '2019-04-15 13:43:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cricket_match`
--
ALTER TABLE `cricket_match`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_players`
--
ALTER TABLE `cricket_players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_points`
--
ALTER TABLE `cricket_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_teams`
--
ALTER TABLE `cricket_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cricket_match`
--
ALTER TABLE `cricket_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cricket_players`
--
ALTER TABLE `cricket_players`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cricket_points`
--
ALTER TABLE `cricket_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cricket_teams`
--
ALTER TABLE `cricket_teams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
