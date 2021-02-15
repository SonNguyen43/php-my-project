-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 04:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haisan`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_rooms`
--

CREATE TABLE `book_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_number` int(11) NOT NULL,
  `kind_of_room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_rooms`
--

INSERT INTO `book_rooms` (`id`, `name`, `phone_number`, `time`, `people_number`, `kind_of_room`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Nguyễn Bình Hồng Sơn', '0766899363', '21/12/2019 - 22h', 1, 'Phòng vip', 'not approved', '2019-12-20 06:26:53', '2019-12-20 06:42:16'),
(8, 'Nguyễn Bình Hồng Sơn', '0916524328', '22/12/2019 - 10h', 1, 'Phòng vip', 'not approved', '2019-12-20 21:51:33', '2019-12-21 03:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hải sản', 'haisan_1576924552.jpg', '2019-12-14 17:00:00', '2020-07-02 11:57:32'),
(2, 'Các món mực', 'muc_1576737107.jpg', '2019-12-14 17:00:00', '2019-12-18 23:31:47'),
(3, 'Các món tôm', 'tom_1576737115.jpg', '2019-12-14 17:00:00', '2019-12-18 23:31:55'),
(6, 'Đặc sản sông nước', 'dacsansongnuoc_1576737122.jpg', '2019-12-14 17:00:00', '2019-12-18 23:32:02'),
(14, 'Tráng miệng', 'trangmieng_1576737130.jpg', '2019-12-16 06:22:20', '2019-12-18 23:32:10'),
(19, 'Gỏi', 'goi_1576737142.jpg', '2019-12-16 21:40:18', '2019-12-18 23:32:22'),
(21, 'Đặc biệt', 'datbiet_1576737149.jpg', '2019-12-17 23:36:41', '2019-12-18 23:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(5555) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `highlights` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `categories_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `image`, `highlights`, `categories_id`, `created_at`, `updated_at`) VALUES
(4, 'Gỏi xầu đâu', '<p><strong>Đ&acirc;y l&agrave; một</strong> m&oacute;n ăn d&acirc;n d&atilde; quen thuộc của người d&acirc;n miền T&acirc;y, được chế biến bằng nguy&ecirc;n liệu ch&iacute;nh l&agrave; l&aacute; sầu đ&acirc;u v&agrave; kh&ocirc; c&aacute; sặc, ba chỉ luộc.</p>\r\n\r\n<p>Người mới ăn m&oacute;n sầu đ&acirc;u lần đầu c&oacute; thể thấy hơi đắng, nhưng khi nhai kỹ th&igrave; sẽ cảm nhận được vị ngọt thanh trong cuống họng,<span style=\"font-size:26px\"> c&agrave;ng ăn c&agrave;ng nghiện.&nbsp;</span></p>', 'goisaudaukhocasac-1-1565658463763_1576557657.jpg', 'false', '19', '2019-12-16 21:40:57', '2020-07-02 11:58:07'),
(5, 'Sashimi thần lửa', '<p>&Ocirc;ng bố đảm đang n&agrave;y cũng d&agrave;nh thời gian chia sẻ c&aacute;c t&aacute;c phẩm l&ecirc;n trang c&aacute; nh&acirc;n, nơi đang thu h&uacute;t h&agrave;ng chục ngh&igrave;n người theo d&otilde;i. Chủ đề của Mikyoui00&nbsp; rất đa dạng, từ những khoảnh khắc đời thường, cho tới nh&acirc;n vật hoạt h&igrave;nh. Tất cả đều được người h&acirc;m mộ đ&oacute;n nhận h&agrave;o hứng.</p>', 'nhung-dia-do-an-dep-toi-kho-tin-khien-chang-ai-no-thuong-thuc_1576557743.jpeg', 'true', '1', '2019-12-16 21:42:23', '2020-05-15 02:22:48'),
(6, 'Nước mắm cơm tấm', '<p>40ml nước dừa,30g đường, 20ml nước mắm Vị Xưa 20 độ đạm10g tỏi, ớt băm</p>\r\n\r\n<p><strong>Thực hiện:</strong></p>\r\n\r\n<p><em><strong>Bước 1:</strong></em></p>\r\n\r\n<p>Đun s&ocirc;i đến khi sệt hỗn hợp: nước dừa, nước mắm Vị Xưa 20 độ đạm, đường.</p>\r\n\r\n<p>Để nguội hỗn hợp</p>\r\n\r\n<p><em><strong>Bước 2:</strong></em></p>\r\n\r\n<p>Cho ớt v&agrave; tỏi băm v&agrave;o hỗn hợp</p>\r\n\r\n<p>D&ugrave;ng chung với cơm tấm sườn</p>\r\n\r\n<p><strong>M&aacute;ch nhỏ: Lấy nước dừa thay cho nước lọc để&nbsp;</strong><strong>tăng độ ngọt thanh cho nước chấm</strong></p>', 'pha-nuoc-mam-com-tam_1576557882.jpg', 'true', '6', '2019-12-16 21:44:42', '2019-12-18 05:09:23'),
(7, 'Cá lóc kho tộ', '<p>C&aacute; l&oacute;c kho tộ lu&ocirc;n l&agrave; m&oacute;n ăn quen thuộc v&agrave; hấp dẫn trong bữa cơm h&agrave;ng ng&agrave;y của gia đ&igrave;nh người Việt Nam, một đĩa c&aacute; l&oacute;c kho tộ, một b&aacute;t canh rau, một ch&eacute;n nhỏ c&agrave; muối lu&ocirc;n tạo cho ch&uacute;ng ta những niềm cảm hứng đặc biệt khi thưởng thức. Ch&iacute;nh v&igrave; thế, ch&uacute;ng t&ocirc;i sẽ chia sẻ cho c&aacute;c bạn&nbsp;<strong>hướng dẫn</strong>&nbsp;<strong>c&aacute;ch l&agrave;m c&aacute; l&oacute;c kho tộ thơm ngon&nbsp;</strong>cho cả gia đ&igrave;nh. H&atilde;y v&agrave;o bếp l&agrave;m m&oacute;n ngon n&agrave;y mỗi cuối tuần để chi&ecirc;u đ&atilde;i cả nh&agrave; bạn nh&eacute;!</p>', 'ca-loc-kho-to_1576558492.jpg', 'false', '6', '2019-12-16 21:54:52', '2019-12-17 05:18:14'),
(8, 'Gỏi mực kiểu Thái', '<p>C&agrave; rốt gọt vỏ v&agrave; rửa sach, b&agrave;o sợi mỏng v&agrave; đem ng&acirc;m nước rồi vớt ra để r&aacute;o.</p>\r\n\r\n<p>Dưa chuột rửa sạch rồi gọt vỏ, th&aacute;i l&aacute;t mỏng đem ng&acirc;m với nước muối nhạt v&agrave; vớt ra để r&aacute;o</p>\r\n\r\n<p>Sả b&oacute;c lớp vỏ ngo&agrave;i, rửa sạch rồi đem th&aacute;i l&aacute;t nhỏ.</p>\r\n\r\n<p>&nbsp;Pha nước mắm chua ngọt theo tỉ lệ: 3 th&igrave;a nước lọc, 2 th&igrave;a nước mắm ngon, 1 th&igrave;a caf&eacute; m&igrave; ch&iacute;nh, nước cốt chanh, ớt tươi trộn đều sau đ&oacute; cho v&agrave;o hỗn hợp gỏi mực.</p>', 'goi-1144_1576558702.jpg', 'true', '19', '2019-12-16 21:58:22', '2019-12-19 05:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(5555) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `images`, `created_at`, `updated_at`) VALUES
(18, NULL, 'ca-loc-kho-to_1576924769_13da20ded2125edbd47eca7f.jpg', '2019-12-21 03:39:29', '2019-12-21 03:39:29'),
(19, NULL, 'goisaudaukhocasac-1-1565658463763_1576557657_1593441407_aea3dcfcc1f747cf77019fc2.jpg', '2020-06-29 07:36:47', '2020-06-29 07:36:47'),
(21, NULL, 'nhung-dia-do-an-dep-toi-kho-tin-khien-chang-ai-no-thuong-thuc_1576557743_1593441418_01d6c2bd653d7acfc0d8be4a.jpeg', '2020-06-29 07:36:58', '2020-06-29 07:36:58'),
(22, NULL, 'muc_1576737107_1593441430_f2bc88fc421801dddd334411.jpg', '2020-06-29 07:37:10', '2020-06-29 07:37:10'),
(23, NULL, 'haisan_1576924552_1593441446_d80cb9ee281490ff14038f73.jpg', '2020-06-29 07:37:27', '2020-06-29 07:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_12_15_031839_create_categories_table', 1),
(14, '2019_12_15_031850_create_foods_table', 1),
(15, '2019_12_15_031906_create_rooms_table', 1),
(16, '2019_12_15_033737_create_guests_table', 1),
(17, '2019_12_15_150301_create_book_rooms_table', 2),
(18, '2019_12_15_151012_create_feedback_table', 3),
(19, '2019_12_20_015125_create_images_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nbhson43@gmail.com', '$2y$10$yxpzUtDjhXCBvcuht64ZhOvjQ.Qdiw0Cpef3Crebh0/QYmhNyxON2', '2019-12-17 06:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kind_of_room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `kind_of_room`, `created_at`, `updated_at`) VALUES
(1, 'Phòng thường', '2019-12-17 05:29:49', '2019-12-21 23:45:54'),
(2, 'Phòng vip', '2019-12-17 05:38:10', '2019-12-18 18:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Sơn Nguyễn', 'nbhson43@gmail.com', NULL, '$2y$10$Mf.m3Oq6zotWnPeYozT4aOWRnVfhR.iyM68Zoh9kq5m6jovj4ADPC', '19e97b1779b294eccda3.jpg', NULL, NULL, '2020-07-11 22:13:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_rooms`
--
ALTER TABLE `book_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `book_rooms`
--
ALTER TABLE `book_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
