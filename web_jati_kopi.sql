-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2025 at 01:12 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_jati_kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2025-05-04 04:56:48', '2025-05-04 04:56:48'),
(2, 'Minuman', '2025-05-04 04:56:57', '2025-05-04 04:56:57');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_26_045720_create_sales_table', 1),
(5, '2025_04_26_045736_create_categories_table', 1),
(6, '2025_04_26_045740_raw_materials', 1),
(7, '2025_04_26_045833_create_products_table', 1),
(8, '2025_04_26_045834_sale_items', 1),
(10, '2025_04_26_050034_create_recipes_table', 1),
(11, '2025_04_26_045925_stock_movements', 2);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nasi Lemak', 13000, 14, '2025-05-04 04:59:21', '2025-05-04 04:59:21'),
(2, 1, 'Roti Jalak', 8000, 40, '2025-05-04 05:00:18', '2025-05-04 05:00:18'),
(3, 1, 'Nasi Goreng', 14000, 25, '2025-05-07 08:27:07', '2025-05-07 08:27:07'),
(4, 2, 'Teh Tarik', 10000, 30, '2025-05-15 04:42:39', '2025-05-15 04:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `name`, `price`, `stock`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Susu', 1500000, 19250, 'mililiter', '2025-05-04 04:57:43', '2025-05-15 04:50:48'),
(2, 'Tepung', 750000, 30000, 'gram', '2025-05-04 04:58:05', '2025-05-04 04:58:05'),
(3, 'Nasi', 300000, 100, 'gram', '2025-05-04 04:58:33', '2025-05-07 07:02:08'),
(4, 'Bawang Merah', 1500000, 50000, 'gram', '2025-05-07 07:43:03', '2025-05-15 04:41:11'),
(5, 'Gandum', 1400000, 40000, 'gram', '2025-05-07 07:55:59', '2025-05-07 07:55:59'),
(6, 'Garam', 50000, 2000, 'gram', '2025-05-07 08:24:32', '2025-05-07 08:24:32'),
(8, 'Teh', 1300000, 9400, 'gram', '2025-05-15 04:44:41', '2025-05-15 04:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `raw_material_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `product_id`, `raw_material_id`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 150, 'mililiter', '2025-05-04 05:47:39', '2025-05-04 05:48:05'),
(4, 2, 2, 350, 'gram', '2025-05-04 05:47:39', '2025-05-04 05:47:39'),
(5, 1, 3, 350, 'mililiter', '2025-05-05 05:20:18', '2025-05-05 05:20:18'),
(6, 3, 3, 250, 'mililiter', '2025-05-07 08:28:45', '2025-05-07 08:28:45'),
(7, 3, 6, 100, 'mililiter', '2025-05-07 08:28:45', '2025-05-07 08:28:45'),
(9, 4, 1, 200, 'mililiter', '2025-05-15 04:46:04', '2025-05-15 04:52:52'),
(10, 4, 8, 200, 'gram', '2025-05-15 04:46:04', '2025-05-15 04:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `total`, `created_at`, `updated_at`) VALUES
(3, 1, 13000, '2025-05-05 05:03:27', '2025-05-05 05:03:27'),
(4, 1, 13000, '2025-05-05 05:05:34', '2025-05-05 05:05:34'),
(5, 1, 13000, '2025-05-05 05:11:16', '2025-05-05 05:11:16'),
(6, 1, 13000, '2025-05-05 05:15:02', '2025-05-05 05:15:02'),
(7, 1, 13000, '2025-05-05 05:16:02', '2025-05-05 05:16:02'),
(8, 1, 13000, '2025-05-05 05:17:23', '2025-05-05 05:17:23'),
(9, 1, 13000, '2025-05-05 05:20:32', '2025-05-05 05:20:32'),
(10, 1, 13000, '2025-05-05 05:23:17', '2025-05-05 05:23:17'),
(11, 1, 13000, '2025-05-05 05:23:37', '2025-05-05 05:23:37'),
(12, 1, 39000, '2025-05-06 08:24:04', '2025-05-06 08:24:04'),
(13, 1, 26000, '2025-05-07 05:34:31', '2025-05-07 05:34:31'),
(14, 1, 10000, '2025-05-15 04:47:42', '2025-05-15 04:47:42'),
(15, 1, 10000, '2025-05-15 04:50:20', '2025-05-15 04:50:20'),
(16, 1, 10000, '2025-05-15 04:50:48', '2025-05-15 04:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 13000, '2025-05-05 05:03:27', '2025-05-05 05:03:27'),
(2, 5, 1, 1, 13000, '2025-05-05 05:11:16', '2025-05-05 05:11:16'),
(3, 10, 1, 1, 13000, '2025-05-05 05:23:17', '2025-05-05 05:23:17'),
(4, 11, 1, 1, 13000, '2025-05-05 05:23:37', '2025-05-05 05:23:37'),
(5, 12, 1, 1, 13000, '2025-05-06 08:24:04', '2025-05-06 08:24:04'),
(6, 12, 1, 1, 13000, '2025-05-06 08:24:04', '2025-05-06 08:24:04'),
(7, 12, 1, 1, 13000, '2025-05-06 08:24:04', '2025-05-06 08:24:04'),
(8, 13, 1, 2, 13000, '2025-05-07 05:34:31', '2025-05-07 05:34:31'),
(9, 14, 4, 1, 10000, '2025-05-15 04:47:42', '2025-05-15 04:47:42'),
(10, 15, 4, 1, 10000, '2025-05-15 04:50:20', '2025-05-15 04:50:20'),
(11, 16, 4, 1, 10000, '2025-05-15 04:50:48', '2025-05-15 04:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EnAO39Hkm6KdyAZGF2GmXSlQGwfoAGjMjO5Sqvxm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHZDZVI2UVhDZ1lyWnFSUHZ4V3llUXB0bWJTaG81UkFzczZSNHg0ciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1747311169);

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint UNSIGNED NOT NULL,
  `raw_material_id` bigint UNSIGNED NOT NULL,
  `change` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `raw_material_id`, `change`, `type`, `note`, `created_at`, `updated_at`) VALUES
(1, 5, 40000, 'in', 'Restock', '2025-05-07 07:55:59', '2025-05-07 07:55:59'),
(2, 6, 2000, 'in', 'Restock', '2025-05-07 08:24:32', '2025-05-07 08:24:32'),
(4, 4, 50000, 'out', 'Edit Stock', '2025-05-15 04:41:11', '2025-05-15 04:41:11'),
(6, 8, 10000, 'restock', 'Restock', '2025-05-15 04:44:41', '2025-05-15 04:44:41'),
(7, 1, -250, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:47:42', '2025-05-15 04:47:42'),
(8, 8, -200, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:47:42', '2025-05-15 04:47:42'),
(9, 1, -250, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:50:20', '2025-05-15 04:50:20'),
(10, 8, -200, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:50:20', '2025-05-15 04:50:20'),
(11, 1, -250, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:50:48', '2025-05-15 04:50:48'),
(12, 8, -200, 'out', 'Digunakan untuk penjualan produk: Teh Tarik', '2025-05-15 04:50:48', '2025-05-15 04:50:48');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aoi', 'Aoi@gmail.com', '2025-05-05 12:01:30', '123456', NULL, '2025-05-05 12:01:30', '2025-05-05 12:01:30'),
(2, 'Admin', 'admin@example.com', NULL, '$2y$12$AwGd8Mq0.3S1mWjqHXvIIO.LtgvN5hb5.vkCXyzH32FQVkp1osmkW', NULL, '2025-05-08 08:17:26', '2025-05-08 08:17:26'),
(3, 'oki', 'oki@gmail.com', NULL, '$2y$12$IDAZUC7gJ7kyyq1o20xeY.FJSFGvsTKv/J.e6MfbTSg4O1y.hJY06', NULL, '2025-05-15 05:12:05', '2025-05-15 05:12:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipes_product_id_foreign` (`product_id`),
  ADD KEY `recipes_raw_material_id_foreign` (`raw_material_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_raw_material_id_foreign` (`raw_material_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipes_raw_material_id_foreign` FOREIGN KEY (`raw_material_id`) REFERENCES `raw_materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_raw_material_id_foreign` FOREIGN KEY (`raw_material_id`) REFERENCES `raw_materials` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
