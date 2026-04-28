-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2026 at 02:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `porscheapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `car_model_id`, `name`, `price`) VALUES
(1, 1, 'Sport Chrono Package', 1490),
(2, 1, 'Carbon Ceramic Brakes (PCCB)', 8150),
(3, 1, 'Rear Wiper Delete', 100),
(4, 1, 'Fire Extinguisher (Onboard)', 380),
(5, 1, 'Porsche Crest on Headrests', 850),
(6, 2, 'Custom Luggage Set', 3200),
(7, 2, 'Carbon Fiber Engine Cover', 11000),
(8, 2, 'Bose Sound System', 1950),
(9, 2, 'Porsche Crest on Headrests', 850),
(10, 2, 'Carbon Ceramic Brakes (PCCB)', 12500),
(11, 3, 'Whale Tail Rear Spoiler', 5500),
(12, 3, 'Sunroof', 4500),
(13, 3, 'Air Conditioning', 2000),
(14, 3, 'Fuchs Alloy Wheels', 5000),
(15, 3, 'Limited Slip Differential', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

CREATE TABLE `car_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `base_price` int(11) NOT NULL,
  `model_file` text NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_models`
--

INSERT INTO `car_models` (`id`, `name`, `year`, `description`, `base_price`, `model_file`, `image_url`) VALUES
(1, 'GT3 997.2', '2009-2011', 'The 2010–2012 Porsche 911 GT3 (997.2) is a revered, analog driver’s car featuring a 3.8L naturally aspirated \"Mezger\" flat-six engine (435 hp) and a 6-speed manual transmission. It is known for its high-revving nature (8,400 rpm), hydraulic steering, and raw, engaging performance. As a final, relatively compact narrow-body GT3, it represents a \"sweet spot\" for collectors.', 200000, '3dModels/GT3_997-2.glb', 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/GT3%20997.2.png'),
(2, 'Carrera GT', '2003-2006', '', 2000000, '3dModels/Carrera_GT.glb', 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/Carrera%20GT.png'),
(3, '930 Turbo', '1978-1989', '', 150000, '3dModels/930_Turbo.glb', 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/930%20Turbo.png');

-- --------------------------------------------------------

--
-- Table structure for table `car_specs`
--

CREATE TABLE `car_specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `acceleration` double NOT NULL,
  `power` int(11) NOT NULL,
  `top_speed` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `displacement` int(11) NOT NULL,
  `cylinders` int(11) NOT NULL,
  `transmission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_specs`
--

INSERT INTO `car_specs` (`id`, `car_model_id`, `acceleration`, `power`, `top_speed`, `weight`, `displacement`, `cylinders`, `transmission`) VALUES
(1, 1, 4, 435, 312, 1395, 3800, 6, '6-speed manual'),
(2, 2, 3.9, 612, 330, 1380, 5733, 10, '6-speed manual'),
(3, 3, 5.2, 300, 260, 1335, 3299, 6, '5-speed manual');

-- --------------------------------------------------------

--
-- Table structure for table `color__options`
--

CREATE TABLE `color__options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `hex_code` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color__options`
--

INSERT INTO `color__options` (`id`, `car_model_id`, `name`, `hex_code`, `price`) VALUES
(1, 1, 'Pearl White', '#F5F5DC', 4997),
(2, 1, 'GT Silver Metallic', '#9E9E9E', 5490),
(3, 1, 'Guards Red', '#AE1C28', 0),
(4, 1, 'Basalt Black Metallic', '#2B2B2B', 5490),
(5, 2, 'Pearl White', '#F5F5DC', 4997),
(6, 2, 'Fayence Yellow', '#C8A84B', 6200),
(7, 2, 'Slate Grey Metallic', '#6B6B6B', 5490),
(8, 2, 'Carmine Red', '#8B1A1A', 5990),
(9, 3, 'Pearl White', '#F5F5DC', 4997),
(10, 3, 'Copper Brown Metallic', '#7B4F2E', 5200),
(11, 3, 'Minerva Blue Metallic', '#3B5F8A', 5200),
(12, 3, 'Olive Green Metallic', '#4A5240', 4800);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `color_option_id` bigint(20) UNSIGNED NOT NULL,
  `wheel_option_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `user_id`, `car_model_id`, `color_option_id`, `wheel_option_id`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 2, 237380, '2026-04-27 10:12:58', '2026-04-27 10:12:58'),
(2, 1, 2, 6, 5, 2059900, '2026-04-27 10:13:33', '2026-04-27 10:13:33'),
(3, 1, 3, 11, 10, 183900, '2026-04-27 10:13:59', '2026-04-27 10:13:59'),
(4, 1, 1, 4, 3, 244030, '2026-04-27 10:14:21', '2026-04-27 10:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `config_accessory`
--

CREATE TABLE `config_accessory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `config_id` bigint(20) UNSIGNED NOT NULL,
  `accessory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config_accessory`
--

INSERT INTO `config_accessory` (`id`, `config_id`, `accessory_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 2, 6, NULL, NULL),
(5, 2, 7, NULL, NULL),
(6, 2, 8, NULL, NULL),
(7, 2, 9, NULL, NULL),
(8, 2, 10, NULL, NULL),
(9, 3, 12, NULL, NULL),
(10, 3, 13, NULL, NULL),
(11, 3, 14, NULL, NULL),
(12, 4, 1, NULL, NULL),
(13, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_interior_option`
--

CREATE TABLE `config_interior_option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `config_id` bigint(20) UNSIGNED NOT NULL,
  `interior_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config_interior_option`
--

INSERT INTO `config_interior_option` (`id`, `config_id`, `interior_option_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 3, NULL, NULL),
(3, 1, 4, NULL, NULL),
(4, 2, 6, NULL, NULL),
(5, 2, 7, NULL, NULL),
(6, 2, 8, NULL, NULL),
(7, 3, 10, NULL, NULL),
(8, 3, 11, NULL, NULL),
(9, 3, 12, NULL, NULL),
(10, 4, 2, NULL, NULL),
(11, 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interior__options`
--

CREATE TABLE `interior__options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interior__options`
--

INSERT INTO `interior__options` (`id`, `car_model_id`, `part_name`, `material`, `color`, `price`) VALUES
(1, 1, 'Seat Upholstery', 'Full Leather', 'Black', 5000),
(2, 1, 'Seat Upholstery', 'Alcantara', 'Guards Red', 5000),
(3, 1, 'Steering Wheel', 'Alcantara', 'Black', 950),
(4, 1, 'Dashboard Trim', 'Carbon Fiber', 'Gloss Black', 1200),
(5, 2, 'Seat Upholstery', 'Full Leather', 'Metropol Blue', 5000),
(6, 2, 'Seat Upholstery', 'Full Leather', 'Beige', 5000),
(7, 2, 'Steering Wheel', 'Leather', 'Black', 1400),
(8, 2, 'Door Panel Trim', 'Carbon Fiber', 'Gloss Black', 2800),
(9, 3, 'Seat Upholstery', 'Tartan Fabric', 'Pepita Check', 5000),
(10, 3, 'Seat Upholstery', 'Full Leather', 'Cognac', 5000),
(11, 3, 'Steering Wheel', 'Leather', 'Black', 1200),
(12, 3, 'Dashboard Trim', 'Brushed Aluminum', 'Silver', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_16_105323_create_car_models_table', 1),
(5, '2026_03_16_105438_create_color__options_table', 1),
(6, '2026_03_16_105446_create_wheel__options_table', 1),
(7, '2026_03_16_105452_create_interior__options_table', 1),
(8, '2026_03_16_105462_create_accessories_table', 1),
(9, '2026_03_16_105504_create_configs_table', 1),
(10, '2026_03_16_105624_create_orders_table', 1),
(11, '2026_03_18_091749_create_personal_access_tokens_table', 1),
(12, '2026_03_18_095729_create_car_specs_table', 1),
(13, '2026_04_26_181500_create_config_pivot_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `config_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `message` varchar(255) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `config_id`, `status`, `message`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pending', 'Order is waiting for approval.', 237380, '2026-04-27 10:12:58', '2026-04-27 10:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', 'dedc0fdd69f90eccb3b818e53cd6777d91bdc4da319d2c5a59414ec45f600a82', '[\"user\"]', '2026-04-27 10:14:31', NULL, '2026-04-27 10:12:32', '2026-04-27 10:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@gmail.com', 'user', NULL, '$2y$12$HLcJV7cY64Gl4UUwWaTzeuNY/ksZgDefg9hGaFtq1uA7fNApE8p16', NULL, '2026-04-27 10:11:37', '2026-04-27 10:11:37'),
(2, 'admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$gIolKR7sccUtltOiYkU.KO5s4AeOoRMJPzu5IeL26y2Px/YM4kvG2', NULL, '2026-04-27 10:11:37', '2026-04-27 10:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `wheel__options`
--

CREATE TABLE `wheel__options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wheel__options`
--

INSERT INTO `wheel__options` (`id`, `car_model_id`, `name`, `color`, `material`, `size`, `price`, `img_url`) VALUES
(1, 1, 'BBS LM', 'Triple Chrome', 'Aluminum', 19, 25000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp'),
(2, 1, 'HRE S2H', 'Frozen Gold center, Polished Dark Clear outer and inner.', 'Aluminum', 19, 15000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png'),
(3, 1, 'HRE HX100', 'Gloss Black center, Carbon Fiber outer and inner.', 'Aluminum, Carbon Fiber', 19, 30000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png'),
(4, 2, 'BBS LM', 'Triple Chrome', 'Aluminum', 18, 25000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp'),
(5, 2, 'HRE S2H', 'Frozen Gold center, Polished Dark Clear outer and inner.', 'Aluminum', 18, 15000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png'),
(6, 2, 'HRE HX100', 'Gloss Black center, Carbon Fiber outer and inner.', 'Aluminum, Carbon Fiber', 18, 30000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png'),
(7, 3, 'BBS LM', 'Triple Chrome', 'Aluminum', 12, 25000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp'),
(8, 3, 'HRE S2H', 'Frozen Gold center, Polished Dark Clear outer and inner.', 'Aluminum', 12, 15000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png'),
(9, 3, 'HRE HX100', 'Gloss Black center, Carbon Fiber outer and inner.', 'Aluminum, Carbon Fiber', 12, 30000, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png'),
(10, 3, 'Fuchs', 'Two tone', 'Alloy', 9, 8500, 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/fuchs.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessories_car_model_id_foreign` (`car_model_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_models_name_unique` (`name`);

--
-- Indexes for table `car_specs`
--
ALTER TABLE `car_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_specs_car_model_id_foreign` (`car_model_id`);

--
-- Indexes for table `color__options`
--
ALTER TABLE `color__options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color__options_car_model_id_foreign` (`car_model_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configs_user_id_foreign` (`user_id`),
  ADD KEY `configs_car_model_id_foreign` (`car_model_id`),
  ADD KEY `configs_color_option_id_foreign` (`color_option_id`),
  ADD KEY `configs_wheel_option_id_foreign` (`wheel_option_id`);

--
-- Indexes for table `config_accessory`
--
ALTER TABLE `config_accessory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `config_accessory_config_id_foreign` (`config_id`),
  ADD KEY `config_accessory_accessory_id_foreign` (`accessory_id`);

--
-- Indexes for table `config_interior_option`
--
ALTER TABLE `config_interior_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `config_interior_option_config_id_foreign` (`config_id`),
  ADD KEY `config_interior_option_interior_option_id_foreign` (`interior_option_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interior__options`
--
ALTER TABLE `interior__options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interior__options_car_model_id_foreign` (`car_model_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_id_unique` (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_config_id_foreign` (`config_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wheel__options`
--
ALTER TABLE `wheel__options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wheel__options_car_model_id_foreign` (`car_model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_specs`
--
ALTER TABLE `car_specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `color__options`
--
ALTER TABLE `color__options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `config_accessory`
--
ALTER TABLE `config_accessory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `config_interior_option`
--
ALTER TABLE `config_interior_option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interior__options`
--
ALTER TABLE `interior__options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wheel__options`
--
ALTER TABLE `wheel__options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `car_specs`
--
ALTER TABLE `car_specs`
  ADD CONSTRAINT `car_specs_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `color__options`
--
ALTER TABLE `color__options`
  ADD CONSTRAINT `color__options_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `configs`
--
ALTER TABLE `configs`
  ADD CONSTRAINT `configs_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `configs_color_option_id_foreign` FOREIGN KEY (`color_option_id`) REFERENCES `color__options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `configs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `configs_wheel_option_id_foreign` FOREIGN KEY (`wheel_option_id`) REFERENCES `wheel__options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `config_accessory`
--
ALTER TABLE `config_accessory`
  ADD CONSTRAINT `config_accessory_accessory_id_foreign` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `config_accessory_config_id_foreign` FOREIGN KEY (`config_id`) REFERENCES `configs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `config_interior_option`
--
ALTER TABLE `config_interior_option`
  ADD CONSTRAINT `config_interior_option_config_id_foreign` FOREIGN KEY (`config_id`) REFERENCES `configs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `config_interior_option_interior_option_id_foreign` FOREIGN KEY (`interior_option_id`) REFERENCES `interior__options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interior__options`
--
ALTER TABLE `interior__options`
  ADD CONSTRAINT `interior__options_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_config_id_foreign` FOREIGN KEY (`config_id`) REFERENCES `configs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wheel__options`
--
ALTER TABLE `wheel__options`
  ADD CONSTRAINT `wheel__options_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
