-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2024 at 12:04 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homnay0610`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogues`
--

CREATE TABLE `catalogues` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogues`
--

INSERT INTO `catalogues` (`id`, `name`, `cover`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'hahahha', NULL, 1, NULL, NULL),
(2, 'hehehe', NULL, 1, NULL, NULL),
(3, 'alo', NULL, 1, '2024-10-12 07:28:06', '2024-10-12 07:28:06'),
(4, 'Áo GiGici', NULL, 1, '2024-10-14 01:17:49', '2024-10-14 01:17:49'),
(5, 'feffeafae', NULL, 1, '2024-10-27 07:31:19', '2024-10-27 07:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_03_143430_create_catalogues_table', 1),
(6, '2024_10_03_143433_create_products_table', 1),
(8, '2024_10_06_161432_update_to_products_table', 2),
(9, '2024_10_13_225246_update_users_table', 3),
(10, '2024_10_26_045552_create_variants_table', 3),
(11, '2024_10_27_101634_create_product__variants_table', 4),
(12, '2024_10_29_095739_create_product_galleries_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `catalogues_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `img_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_regular` double NOT NULL,
  `price_sale` double DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'chat lieu',
  `user_manual` text COLLATE utf8mb4_unicode_ci COMMENT 'huong dan sd',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `view` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_hot_deal` tinyint(1) NOT NULL DEFAULT '0',
  `is_good_deal` tinyint(1) NOT NULL DEFAULT '0',
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_show_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catalogues_id`, `name`, `slug`, `sku`, `quantity`, `img_thumbnail`, `price_regular`, `price_sale`, `description`, `content`, `material`, `user_manual`, `is_active`, `view`, `is_hot_deal`, `is_good_deal`, `is_new`, `is_show_home`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 1, 'Áo Ba Lỗ', 'xuadwdwddawdw-eaef', '8SO89TA6', 5, 'products/jsuErNsBV6NiMiWXIcNgpuY193H2qTwMk4ApLvcm.png', 7000000, 500000, 'qqqqqqqqq', '<p>fffefeaf</p>', 'VẢI Đểu', 'feaff', 1, 0, 0, 0, 0, 0, '2024-10-15 07:37:22', '2024-10-15 08:19:00', NULL),
(17, 1, 'Áo Len', 'edddddddddda', 'UFQ00PZJ', 5, 'products/Pk7w5ASvIyv4VVR474qG1JESq09PDu5HJgOCzLIN.png', 60000000, 4000000, 'wwwwwww', '<p>eeeeeeee</p>', 'VẢi Xịn', 'eeeeeeeeeeee', 1, 0, 1, 0, 0, 0, '2024-10-15 07:38:25', '2024-10-15 07:38:25', NULL),
(18, 1, 'Áo Nike', 'dddddddddd', '4MH3KTQW', 4, 'products/dVej51UHLMfJnQyzOlmSSiJaaVey2aP0CQcGumBR.png', 22222, 2222, 'sdfgh', '<p>eeeeeee</p>', 'vai da', 'eeeeeeeeee', 1, 0, 0, 0, 0, 0, '2024-10-18 02:01:26', '2024-10-18 02:01:26', NULL),
(19, 1, 'Áo PANDA', 'wwwwwwwww', 'QEYQQVCK', 3, 'products/ciVZ0YJU4lgThyhZQbw8OY0GMFkDCPy3Jh36kPFw.png', 33, 33, 'sssssssss', '<p>wwwwww</p>', 'cot tong', 'wwwwwww', 1, 0, 0, 0, 0, 0, '2024-10-18 02:02:09', '2024-10-18 02:02:09', NULL),
(20, 3, 'Áo SADI', 'dddddddd', 'W5F2AHUF', 221, 'products/3OjLje1vsN06FKkNPiqRJRj5KaIENYwoazP244aY.png', 33333, 3333, 'ddddddddd', '<p>ssssssssss</p>', 'cot tong', 'sssssssss', 1, 0, 0, 0, 0, 0, '2024-10-18 02:03:15', '2024-10-18 02:03:15', NULL),
(21, 1, 'Áo PUMA', 'ddddddddddddddvs', 'O94G869D', 22, 'products/SoEaZYO1UTtvwi7W1CpM1lXUNEAXRX8cmVAbntDM.png', 4456, 4243, 'ddddddddd', '<p>ddddddddd</p>', 'cot tong', 'dddddddd', 1, 0, 0, 0, 0, 0, '2024-10-18 02:04:40', '2024-10-18 02:04:40', NULL),
(22, 1, 'eee', 'ruaw', '9329Q4FD', 44, 'products/TyYRiz83O5i87kEXzD1amXn7H5ULv1cOHbxiIBou.png', 454, 45, 'aet', '<p>rẳ</p>', 'rârrawr', 'uawraw', 1, 0, 0, 0, 0, 0, '2024-10-23 02:25:23', '2024-10-23 02:25:23', NULL),
(23, 1, 'hhhhhhhh', 'gsrgse4tset4', 'ZX8TUYKW', 3424, 'products/bWewIsPkl2Vq0EItmC1PLmqJhdii8QIWt8YRl8aA.png', 443, 444343, 'rshxdhr', '<p>grg</p>', 'VẢi Xịn', 'gdgsgs', 1, 0, 0, 0, 0, 0, '2024-10-27 03:43:32', '2024-10-27 03:43:32', NULL),
(29, 1, 'cccccccc', 'rrhsrhwrh', '03Q7KUUS', 44, 'products/xU8jKvipcTDfQeFDY7lH7K49XVslROBRmqNxETsy.png', 4444, 444, 'fefa', '<p>faefaef</p>', 'VẢi Xịn', 'faefa', 1, 0, 0, 0, 0, 0, '2024-10-27 03:47:56', '2024-10-27 03:47:56', NULL),
(30, 1, 'ggggggggggg', 'gegseg-gegs', 'W1JC7K87', 44, 'products/Tc6CqjmpFQ6N7HSq379YauFrB8zx3YxvCw47SFtL.png', 44, 4, 'fefet', '<p>g&eacute;gs</p>', 'cot tong', 'egeg', 1, 0, 0, 0, 0, 0, '2024-10-27 07:27:50', '2024-10-27 07:27:50', NULL),
(31, 1, 'dddddddd', 'ruhsrhstk', 'XWO8SR18', 3525, 'products/lPAXJZUqXUnhObCrKD0zKj3FeFqVKUH5SJtpaaGQ.png', 325, 325, 'rhshjsrjsrj', '<p>zhrhsrh</p>', 'cot tong', 'dgsrh', 1, 0, 0, 0, 0, 0, '2024-10-29 05:17:52', '2024-10-29 05:17:52', NULL),
(32, 1, 'tttt', 'fawfawf', 'P29RO1GN', 3, 'products/1eIC4s4MzWCiU4Dw6H0sECUmIlNWD7NTIjwXneRC.png', 3, 3, 'fqfqef', '<p>faef</p>', 'Nhựa', 'faef', 1, 0, 0, 0, 0, 0, '2024-10-29 05:38:18', '2024-10-29 05:38:18', NULL),
(33, 1, 'yyyyyy', 'gaegaeg', 'MNXEZ5O3', 4, 'products/a8vMfbgQviQ7dLf5EWWITmzujnqN4q0KfOu4W6jH.png', 4, 4, 'rgsr', '<p>geg</p>', 'Nhựa', 'aesg', 1, 0, 0, 0, 0, 0, '2024-10-29 05:40:52', '2024-10-29 05:40:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 33, 'product_galleries/Fdh1MH05pkwGZ38qcji9m0ZMfUE66FwfLnKZQnkT.png', NULL, NULL),
(4, 33, 'product_galleries/xxRVhEOd0wjkwLvqoxebVlOqjQXHZ6yCrA07k7Ld.png', NULL, NULL),
(5, 33, 'product_galleries/u2eT4y2wL3enA9DkURHJCY6fP8pNqc8U8wZzpkOW.png', NULL, NULL),
(6, 33, 'product_galleries/cbtXvDAA2WrZBkfgMkkw7HwBOv86O4m3TIlyEzyl.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product__variants`
--

CREATE TABLE `product__variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `variants_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__variants`
--

INSERT INTO `product__variants` (`id`, `product_id`, `variants_id`, `created_at`, `updated_at`) VALUES
(4, 29, 5, '2024-10-27 03:47:56', '2024-10-27 03:47:56'),
(5, 29, 8, '2024-10-27 03:47:56', '2024-10-27 03:47:56'),
(6, 29, 7, '2024-10-27 03:47:56', '2024-10-27 03:47:56'),
(7, 29, 11, '2024-10-27 03:47:56', '2024-10-27 03:47:56'),
(13, 30, 5, NULL, NULL),
(14, 30, 7, NULL, NULL),
(15, 31, 5, '2024-10-29 05:17:52', '2024-10-29 05:17:52'),
(16, 31, 8, '2024-10-29 05:17:52', '2024-10-29 05:17:52'),
(17, 31, 7, '2024-10-29 05:17:52', '2024-10-29 05:17:52'),
(18, 31, 13, '2024-10-29 05:17:52', '2024-10-29 05:17:52'),
(19, 32, 5, '2024-10-29 05:38:18', '2024-10-29 05:38:18'),
(20, 32, 7, '2024-10-29 05:38:18', '2024-10-29 05:38:18'),
(21, 33, 14, '2024-10-29 05:40:52', '2024-10-29 05:40:52'),
(22, 33, 15, '2024-10-29 05:40:52', '2024-10-29 05:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','User') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(5, 'Color', '#000000', NULL, NULL),
(7, 'Size', 'L', NULL, NULL),
(8, 'Color', '#ff0000', NULL, NULL),
(13, 'Size', 'S', NULL, NULL),
(14, 'Color', '#0008fa', NULL, NULL),
(15, 'Size', 'MM', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_catalogues_id_foreign` (`catalogues_id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `product__variants`
--
ALTER TABLE `product__variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogues`
--
ALTER TABLE `catalogues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product__variants`
--
ALTER TABLE `product__variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_catalogues_id_foreign` FOREIGN KEY (`catalogues_id`) REFERENCES `catalogues` (`id`);

--
-- Constraints for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD CONSTRAINT `product_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
