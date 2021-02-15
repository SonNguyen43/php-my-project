-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 04:24 PM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(9510) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `forum_id`, `user_id`, `created_at`, `updated_at`) VALUES
(24, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat voluptates natus id nobis explicabo fugit numquam dolore perspiciatis quis necessitatibus mollitia dignissimos ab excepturi eveniet, beatae maxime! Iusto, labore unde.', 36, 4, '2020-06-29 06:36:55', '2020-06-29 06:36:55'),
(25, 'xxx', 36, 4, '2020-07-02 12:01:55', '2020-07-02 12:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(9999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''noImage.png''',
  `images` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImage.png',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not approved',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `body`, `cover_image`, `images`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(36, 'Cà phê đắng và mưa', '<p>Lorem,&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;</p>\r\n\r\n<p>Dignissimos&nbsp;ratione&nbsp;atque&nbsp;in&nbsp;suscipit&nbsp;saepe&nbsp;neque&nbsp;harum&nbsp;laudantium&nbsp;at&nbsp;corrupti&nbsp;quidem&nbsp;ex&nbsp;dolorum&nbsp;tempora,&nbsp;quas&nbsp;excepturi&nbsp;</p>\r\n\r\n<p>beatae&nbsp;accusamus&nbsp;ipsum&nbsp;aliquid!&nbsp;Laborum&nbsp;eaque&nbsp;dignissimos&nbsp;distinctio&nbsp;ipsum?&nbsp;Ducimus&nbsp;corrupti&nbsp;at&nbsp;incidunt&nbsp;non&nbsp;dolore&nbsp;autem&nbsp;necessitatibus</p>\r\n\r\n<p>&nbsp;aspernatur&nbsp;itaque&nbsp;ratione&nbsp;molestiae,&nbsp;</p>\r\n\r\n<p>aperiam&nbsp;mollitia&nbsp;laudantium!&nbsp;Ea&nbsp;repellendus&nbsp;fugiat&nbsp;nam&nbsp;sed,&nbsp;velit&nbsp;hic&nbsp;enim&nbsp;voluptatum&nbsp;odio,&nbsp;expedita&nbsp;id&nbsp;consectetur&nbsp;voluptatem?&nbsp;</p>\r\n\r\n<p>Aliquam,&nbsp;porro&nbsp;ut.&nbsp;Magni&nbsp;in&nbsp;quae&nbsp;numquam&nbsp;cupiditate&nbsp;laborum&nbsp;nisi&nbsp;quas&nbsp;omnis&nbsp;consectetur&nbsp;inventore&nbsp;labore,&nbsp;blanditiis,</p>\r\n\r\n<p>&nbsp;alias&nbsp;ducimus&nbsp;quis&nbsp;sequi&nbsp;voluptatibus&nbsp;nam&nbsp;tenetur&nbsp;exercitationem,&nbsp;velit&nbsp;cumque!&nbsp;Dolorem&nbsp;voluptas&nbsp;sequi&nbsp;enim&nbsp;quis&nbsp;modi&nbsp;eius&nbsp;sint&nbsp;fuga&nbsp;dignissimos&nbsp;officiis.</p>', 'Bsodwindows10_1593437729_74a2069e6f084f323e2d7117.png', '[\"ef9ee8f20a8bf7d5ae9a_1593437729_74a2069e6f084f323e2d7117.jpg\",\"ws_Turquoise_and_Orange_BG_2560x1440_1593437729_74a2069e6f084f323e2d7117.jpg\"]', 'approved', 4, '2020-06-29 06:37:12', '2020-06-29 06:37:12'),
(39, 'Đây là tiêu đề', '<p>&aacute;dasasdasasasdsd</p>', 'ws_Turquoise_and_Orange_BG_2560x1440_1593597247_fb2a588b48e7f4c6fc270efe.jpg', '[\"106695937_285757356115408_1708678797950862530_o_1593597247_fb2a588b48e7f4c6fc270efe.jpg\"]', 'approved', 6, '2020-07-01 02:54:47', '2020-07-01 02:54:47');

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
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2019_11_25_030834_create_posts_table', 1),
(13, '2019_11_25_030901_create_comments_table', 1),
(14, '2019_11_30_034618_add_col_images_to_posts', 1),
(16, '2019_12_02_070858_create_forums_table', 2),
(17, '2019_12_02_074516_add_cover_image_to_forums', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(9510) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(22, 'Ngày tôi quay trở lại', '<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Ullam&nbsp;non&nbsp;aspernatur&nbsp;exercitationem,&nbsp;</p>\r\n\r\n<p>molestiae&nbsp;harum&nbsp;ad!&nbsp;Vel&nbsp;veniam&nbsp;rerum&nbsp;esse&nbsp;illo&nbsp;dolorem&nbsp;accusamus,&nbsp;</p>\r\n\r\n<p>perferendis&nbsp;temporibus&nbsp;placeat,&nbsp;pariatur&nbsp;consequuntur&nbsp;reprehenderit&nbsp;aperiam&nbsp;aliquam&nbsp;nisi&nbsp;consectetur!</p>\r\n\r\n<p>&nbsp;Consequuntur&nbsp;amet&nbsp;reiciendis&nbsp;unde&nbsp;explicabo&nbsp;quaerat&nbsp;dignissimos,&nbsp;necessitatibus&nbsp;voluptas&nbsp;cum&nbsp;aut&nbsp;laboriosam&nbsp;animi&nbsp;commodi&nbsp;eligendi&nbsp;provident.&nbsp;</p>\r\n\r\n<p>Totam,&nbsp;quo&nbsp;doloribus.&nbsp;Doloribus,&nbsp;recusandae?&nbsp;Magni&nbsp;temporibus&nbsp;praesentium&nbsp;veritatis,&nbsp;</p>\r\n\r\n<p>ratione&nbsp;ut&nbsp;ipsam&nbsp;iusto&nbsp;ullam&nbsp;maiores&nbsp;voluptatibus&nbsp;aspernatur&nbsp;quae&nbsp;tempora&nbsp;tenetur&nbsp;beatae&nbsp;</p>\r\n\r\n<p>quos&nbsp;modi&nbsp;autem&nbsp;recusandae&nbsp;sunt&nbsp;unde&nbsp;voluptate&nbsp;esse&nbsp;maxime&nbsp;ipsa&nbsp;placeat.&nbsp;Maxime&nbsp;ullam,&nbsp;</p>\r\n\r\n<p>repellendus&nbsp;minima&nbsp;architecto&nbsp;asperiores&nbsp;quaerat&nbsp;tempore&nbsp;laborum&nbsp;cum&nbsp;earum&nbsp;officiis,</p>\r\n\r\n<p>&nbsp;id&nbsp;adipisci&nbsp;deserunt&nbsp;ab&nbsp;ut&nbsp;placeat,&nbsp;quibusdam&nbsp;mollitia.</p>\r\n\r\n<p><img alt=\"\" src=\"/Blog/public/storage/images/posts/images/Bsodwindows10.png\" style=\"height:900px; width:1600px\" /></p>', 4, '2020-06-29 06:24:29', '2020-06-29 06:31:35');

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
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'noAvatar.png',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Sơn Nguyễn', 'nbhson43@gmail.com', NULL, '$2y$10$Mf.m3Oq6zotWnPeYozT4aOWRnVfhR.iyM68Zoh9kq5m6jovj4ADPC', 'Bsodwindows10.png', 'admin', NULL, '2020-01-01 01:15:14', '2020-06-29 06:21:52'),
(5, 'Người Thích Đùa', 'ntdua@gmail.com', NULL, '$2y$10$N1ggwfCyWVkJ32fXqR4hZO2hMgWaaNbyoej5VauC/BsHLY5/9IuZe', 'noAvatar.png', 'user', NULL, '2020-06-29 06:44:14', '2020-06-29 06:44:14'),
(6, 'Luân', 'luan@gmail.com', NULL, '$2y$10$tUN0ZaG60kh68GiSeTbtmeQXYAV/vby51kiqe9i2rPX239SrSqqBq', 'noAvatar.png', 'user', NULL, '2020-07-01 02:53:10', '2020-07-01 02:53:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
