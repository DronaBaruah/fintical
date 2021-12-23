-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2021 at 05:13 PM
-- Server version: 10.1.48-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assamnew_fintical`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deposit_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `fine` double(20,2) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposit_id`, `user_id`, `society_id`, `month`, `date`, `amount`, `fine`, `remark`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(11, 'D100000001', 28, 'S1002', 'February', '2021-08-27', 1110.00, 0.00, NULL, 'yes', 28, '2021-08-27 16:41:12', '2021-08-27 16:41:12'),
(12, 'D100000002', 25, 'S1001', 'January', '2021-08-28', 300.00, 0.00, NULL, 'no', 25, '2021-08-28 09:06:49', '2021-08-28 09:07:27'),
(13, 'D100000003', 25, 'S1001', 'January', '2021-08-29', 300.00, 0.00, NULL, 'yes', 25, '2021-08-29 13:08:46', '2021-08-29 13:08:46'),
(14, 'D100000004', 26, 'S1001', 'February', '2021-08-30', 400.00, 100.00, 'hi', 'yes', 25, '2021-08-30 16:03:10', '2021-08-30 16:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `disburses`
--

CREATE TABLE `disburses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disburse_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disburses`
--

INSERT INTO `disburses` (`id`, `disburse_id`, `user_id`, `society_id`, `date`, `amount`, `remark`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(5, 'DB10000001', 28, 'S1002', '2021-08-27', 50000.00, NULL, 'yes', 28, '2021-08-27 16:42:57', '2021-08-27 16:42:57'),
(6, 'DB10000002', 25, 'S1001', '2021-08-28', 5000.00, NULL, 'yes', 25, '2021-08-28 09:05:22', '2021-08-28 09:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expenditure_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `expenditure_id`, `society_id`, `date`, `amount`, `remark`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(4, 'E1000001', 'S1001', '2021-08-28', 200.00, NULL, 'yes', 25, '2021-08-28 09:08:45', '2021-08-28 09:08:45'),
(5, 'E1000002', 'S1001', '2021-08-27', 340.00, NULL, 'yes', 25, '2021-08-28 21:27:42', '2021-08-28 21:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interestnonpays`
--

CREATE TABLE `interestnonpays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `interest_non_pay_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `interest_non_pay` double(20,2) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `interest_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `interest_amount` double(20,2) NOT NULL,
  `previous_interest` double(20,2) DEFAULT NULL,
  `lif_amount` double(20,2) NOT NULL,
  `total_interest` double(20,2) DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interest_id`, `user_id`, `society_id`, `date`, `interest_amount`, `previous_interest`, `lif_amount`, `total_interest`, `remark`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(7, 'IN10000001', 25, 'S1001', '2021-08-28', 20.00, 0.00, 0.00, 20.00, NULL, 'yes', 25, '2021-08-28 09:06:24', '2021-08-28 09:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan_id`, `user_id`, `society_id`, `date`, `amount`, `remark`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(6, 'L100000001', 28, 'S1002', '2021-08-27', 50000.00, NULL, 'yes', 28, '2021-08-27 16:41:52', '2021-08-27 16:41:52'),
(7, 'L100000002', 25, 'S1001', '2021-08-28', 6000.00, NULL, 'yes', 25, '2021-08-28 09:04:44', '2021-08-28 09:04:44');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_13_085509_laratrust_setup_tables', 1),
(5, '2021_07_14_155838_create_societies_table', 1),
(6, '2021_07_19_054334_create_deposits_table', 2),
(7, '2021_07_19_143002_drop_deposits_table', 3),
(8, '2021_07_19_143208_create_deposits_table', 4),
(9, '2021_07_21_080546_create_loans_table', 5),
(10, '2021_07_21_092352_drop_loans_table', 6),
(11, '2021_07_21_092505_create_loans_table', 7),
(12, '2021_07_22_084141_create_disburses_table', 8),
(13, '2021_07_22_104206_create_interests_table', 9),
(14, '2021_07_27_134214_create_expenditures_table', 10),
(15, '2021_08_11_212811_create__interestnonpays_table', 11),
(16, '2021_08_11_213118_create_nterestnonpays_table', 12),
(17, '2021_08_11_213210_create_interestnonpays_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shasankadas262@gmail.com', '$2y$10$dqeysDWJIZ7mNiTeHqd0w.cMkwju17sqPUk3p4kH9uCXUT85bMQz2', '2021-08-23 21:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(5, 'profile-read', 'Read Profile', 'Read Profile', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(6, 'profile-update', 'Update Profile', 'Update Profile', '2021-07-15 05:33:53', '2021-07-15 05:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2021-07-15 05:33:53', '2021-07-15 05:33:53'),
(2, 'member', 'Member', 'Member', '2021-07-15 05:33:53', '2021-07-15 05:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 25, 'App\\Models\\User'),
(2, 26, 'App\\Models\\User'),
(2, 27, 'App\\Models\\User'),
(1, 28, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `societies`
--

CREATE TABLE `societies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `share_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lending_interest_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_start` date NOT NULL,
  `society_end` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `societies`
--

INSERT INTO `societies` (`id`, `name`, `society_id`, `address`, `share_value`, `society_type`, `phone_no`, `lending_interest_rate`, `society_start`, `society_end`, `status`, `created_at`, `updated_at`) VALUES
(3, 'INNABS', 'S1001', 'SUALKUCHI', '100', 'Monthly', '9864763781', '2', '2021-08-15', '2022-08-15', 'yes', '2021-08-15 11:37:05', '2021-08-15 11:37:05'),
(4, 'khairul baser alam', 'S1002', 'sk bhuyan road', '555', 'Monthly', '1234567890', '2', '2021-08-27', '2022-08-27', 'yes', '2021-08-27 16:39:19', '2021-08-27 16:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `society_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `share_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `society_id`, `name`, `email`, `email_verified_at`, `address`, `phone_no`, `user_name`, `password`, `society_member`, `share_no`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 'S1001', 'SHASANKA DAS', 'shasankadas262@gmail.com', NULL, 'BONGSHAR', '7002605604', 'shasanka', '$2y$10$hDuIyJDl0xT.2xwl.umQNOmR946BzGiLQyAJJA0R7O4anwJBh4A7C', 'yes', '3', 'yes', 'S5jWThETEDDV77Vp9ubE8lavQzgiX6IFyUNUXw8edk72J1CmJORVITM7J6vf', '2021-08-15 11:37:49', '2021-08-17 09:05:36'),
(26, 'S1001', 'Drona', 'drona@gmail.com', NULL, 'darrang', '768765565', 'drona', '$2y$10$g17jlLJCiPUE1Oho21fhKeLoF3LLSjuGnoT8gF41jiGcOJfe/cxFK', 'yes', '4', 'yes', NULL, '2021-08-15 11:40:58', '2021-08-15 16:00:55'),
(27, 'S1001', 'Rahul', 'rahul@email.com', NULL, 'Guwahati', '9864763781', 'rahul', '$2y$10$xr5lbNnx70OfpWQkDHuQv.FjiIsuPoK7NCKcoHDZxzbChijp1fqea', 'yes', '5', 'no', NULL, '2021-08-26 16:41:34', '2021-08-26 16:42:22'),
(28, 'S1002', 'khairul baser alam', 'khairulalam37@gmail.com', NULL, 'sk bhuyan road', '5252525252', 'khairul', '$2y$10$CduGykHFO47cZsQqVU5KCOdgF1xk61HVv3jxlfUTXBl7JE2kyaOLC', 'yes', '2', 'yes', NULL, '2021-08-27 16:39:20', '2021-08-27 16:40:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deposit_id` (`deposit_id`),
  ADD KEY `deposits_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `disburses`
--
ALTER TABLE `disburses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disburse_id` (`disburse_id`),
  ADD KEY `disburses_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expenditure_id` (`expenditure_id`),
  ADD KEY `expenditures_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interestnonpays`
--
ALTER TABLE `interestnonpays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interest_non_pay_id` (`interest_non_pay_id`),
  ADD KEY `interestnonpays_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interest_id` (`interest_id`),
  ADD KEY `interests_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loans_loan_id_unique` (`loan_id`),
  ADD KEY `loans_admin_id_foreign` (`admin_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `societies`
--
ALTER TABLE `societies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `societies_society_id_unique` (`society_id`),
  ADD UNIQUE KEY `societies_phone_no_unique` (`phone_no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `disburses`
--
ALTER TABLE `disburses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interestnonpays`
--
ALTER TABLE `interestnonpays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `societies`
--
ALTER TABLE `societies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `disburses`
--
ALTER TABLE `disburses`
  ADD CONSTRAINT `disburses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD CONSTRAINT `expenditures_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `interestnonpays`
--
ALTER TABLE `interestnonpays`
  ADD CONSTRAINT `interestnonpays_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `interests_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
