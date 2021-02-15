-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 03:59 PM
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
-- Database: `cshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `address` varchar(1991) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `business_code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `business_license` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `address`, `phone_number`, `email`, `business_code`, `business_license`) VALUES
(1, 'Tòa nhà trung tâm Lotte Hà Nội, 54 Liễu Giai, phường Cống Vị, Quận Ba Đình, Hà Nội', '19001221', 'cskh@hotro.shopee.vn', '0106773786', 'do Sở Kế hoạch & Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `total_price` float NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `total_price`, `user_id`) VALUES
(2, 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `cart_info`
--

CREATE TABLE `cart_info` (
  `id` int(11) NOT NULL,
  `selected_product_number` int(11) NOT NULL,
  `into_money` float NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_info`
--

INSERT INTO `cart_info` (`id`, `selected_product_number`, `into_money`, `product_id`, `cart_id`) VALUES
(9, 3, 1677000, 48, 2),
(10, 1, 15990000, 49, 2),
(13, 1, 118000, 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noImage.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(36, 'Đồng hồ', '649928360re-av0005l-01_1546483794.png'),
(37, 'Giày nam', '182284769213173990-3.jpg'),
(38, 'Quần áo', '1696215309quanao.png'),
(39, 'Điện thoại', '1019635822dienthoai.png'),
(40, 'Thiết bị điện tử', '1123649560đieu-hoa-onemart.jpg'),
(41, 'Máy ảnh', '1954157307may-anh-canon-eos-r-r24-105mm-usm-1.jpg'),
(42, 'Thời trang nữ', '1887504007images.jpg'),
(43, 'Ô tô xe máy', '1900665372vfYyFi.jpg'),
(44, 'Giày nữ', '2029595104giày-nữ-đẹp-rẻ-1.jpg'),
(45, 'Phụ kiện thời trang', '518048562article_1533285982_353.jpg'),
(46, 'Túi ví', '1620810658bo-tui-vi-minmin.jpg'),
(47, 'Làm đẹp', '107458385116450c8dc313fc768f934903e10b62d2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment_product`
--

CREATE TABLE `comment_product` (
  `id` int(11) NOT NULL,
  `contents` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL DEFAULT 5,
  `created_at` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_product`
--

INSERT INTO `comment_product` (`id`, `contents`, `rate`, `created_at`, `product_id`, `user_id`) VALUES
(7, 'Cũng ổn trong tầm giá, bắt mắt', 4, '2020-05-24 10:24:45', 51, 18),
(18, 'Áo đẹp cho 5 sao haha !', 4, '2020-06-30 21:22:10', 50, 18);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1991) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `images` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `images`) VALUES
(7, '1754471538cde71a79dcf9fef8357ed31540537ddd_xxhdpi.jpg'),
(8, '4567811262bb09a8606e7886ad88535f5d336a1ec_xxhdpi.jpg'),
(9, '5667488286e1682ad8fd50d8863e9a40aa1e3d424_xxhdpi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `new_info`
--

CREATE TABLE `new_info` (
  `id` int(11) NOT NULL,
  `content` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `new_info`
--

INSERT INTO `new_info` (`id`, `content`, `news_id`) VALUES
(2, '<figure class=\"image\"><img src=\"/ckfinder/userfiles/images/6-62107_bg-image-google-desktop-backgrounds.png\"></figure><p>Nguyễn Bình Hồng Sơn</p>', 2),
(3, '<figure class=\"image\"><img src=\"/ckfinder/userfiles/images/a5d4e9cd1323e97db032.jpg\"><figcaption>Thằng Sơn</figcaption></figure>', 3),
(4, '<p>A</p><figure class=\"image\"><img src=\"/DoAnPHP/public/ckfinder/userfiles/images/6-62107_bg-image-google-desktop-backgrounds.png\"></figure>', 5),
(5, '<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur,&nbsp;adipisicing&nbsp;elit.&nbsp;Libero&nbsp;nemo&nbsp;molestias&nbsp;atque&nbsp;magni&nbsp;veritatis&nbsp;dolorem&nbsp;a&nbsp;reprehenderit&nbsp;itaque&nbsp;voluptatem.&nbsp;Sint,&nbsp;aliquam!&nbsp;Doloremque&nbsp;magnam&nbsp;eum&nbsp;atque&nbsp;tempore&nbsp;porro.&nbsp;Rerum&nbsp;adipisci&nbsp;fugiat&nbsp;sapiente,&nbsp;quod&nbsp;repellat&nbsp;commodi&nbsp;voluptatum&nbsp;quaerat,&nbsp;dicta&nbsp;alias&nbsp;saepe&nbsp;excepturi&nbsp;voluptates,&nbsp;inventore&nbsp;nobis&nbsp;voluptatibus.&nbsp;Unde&nbsp;illum&nbsp;provident&nbsp;harum&nbsp;asperiores&nbsp;consequatur&nbsp;maiores&nbsp;beatae&nbsp;praesentium&nbsp;illo&nbsp;veritatis&nbsp;doloremque&nbsp;nihil,&nbsp;dolorum,&nbsp;esse&nbsp;quam&nbsp;porro&nbsp;omnis&nbsp;quo&nbsp;repudiandae&nbsp;rerum&nbsp;tempora&nbsp;tenetur&nbsp;ut&nbsp;et&nbsp;nam&nbsp;similique?&nbsp;Voluptates&nbsp;quia&nbsp;adipisci&nbsp;quisquam,&nbsp;sunt&nbsp;corporis&nbsp;a&nbsp;amet&nbsp;consectetur&nbsp;eligendi,&nbsp;reiciendis&nbsp;rem&nbsp;labore&nbsp;veritatis&nbsp;numquam&nbsp;laborum&nbsp;assumenda,&nbsp;maiores&nbsp;atque&nbsp;sapiente&nbsp;nemo?&nbsp;</p><p>Voluptatibus&nbsp;similique&nbsp;quasi&nbsp;adipisci&nbsp;sequi&nbsp;cumque,&nbsp;eum&nbsp;quae&nbsp;natus&nbsp;quia&nbsp;modi,&nbsp;neque&nbsp;dolores&nbsp;iure&nbsp;dolor&nbsp;possimus&nbsp;voluptate!&nbsp;Minus&nbsp;eaque&nbsp;impedit&nbsp;temporibus&nbsp;repudiandae&nbsp;ab&nbsp;quam&nbsp;id&nbsp;labore&nbsp;accusantium&nbsp;hic&nbsp;doloribus&nbsp;quas&nbsp;illum&nbsp;neque&nbsp;atque&nbsp;iure,&nbsp;vel&nbsp;odit,&nbsp;totam&nbsp;dolores&nbsp;odio&nbsp;delectus&nbsp;assumenda&nbsp;quis&nbsp;provident.&nbsp;Laborum&nbsp;est&nbsp;perferendis&nbsp;sapiente,&nbsp;veritatis&nbsp;nisi&nbsp;possimus&nbsp;ad&nbsp;aspernatur!&nbsp;Similique&nbsp;adipisci&nbsp;optio&nbsp;doloremque&nbsp;excepturi&nbsp;fugit&nbsp;earum&nbsp;dolor&nbsp;illum&nbsp;id&nbsp;ad&nbsp;ut,&nbsp;accusantium&nbsp;error&nbsp;porro&nbsp;odit&nbsp;neque&nbsp;veritatis&nbsp;esse,&nbsp;tempore&nbsp;rem&nbsp;facere&nbsp;iusto&nbsp;deserunt!&nbsp;Harum&nbsp;placeat&nbsp;exercitationem&nbsp;labore&nbsp;illo&nbsp;pariatur&nbsp;officia&nbsp;sit,&nbsp;reiciendis&nbsp;asperiores&nbsp;necessitatibus&nbsp;eius&nbsp;nobis,&nbsp;quas&nbsp;explicabo,&nbsp;nemo&nbsp;dolore&nbsp;expedita&nbsp;vero&nbsp;in&nbsp;corporis&nbsp;facere&nbsp;nulla&nbsp;tempora&nbsp;cum&nbsp;assumenda&nbsp;minus&nbsp;at&nbsp;aspernatur?&nbsp;Voluptas,&nbsp;possimus&nbsp;deserunt!</p>', 8),
(6, '<figure class=\"image\"><img src=\"/1.PHP-Project/DoAnPHP/public/ckfinder/userfiles/images/ws_Turquoise_and_Orange_BG_2560x1440.jpg\"></figure><p><strong>Lorem&nbsp;ipsum&nbsp;dolor</strong>,&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;In&nbsp;eos,&nbsp;sit&nbsp;molestias&nbsp;dolores,&nbsp;deserunt&nbsp;inventore&nbsp;alias&nbsp;atque&nbsp;assumenda&nbsp;eius&nbsp;facilis,&nbsp;quas&nbsp;omnis&nbsp;aspernatur.&nbsp;Et&nbsp;quod,&nbsp;nobis&nbsp;reicien<strong>dis&nbsp;alias&nbsp;iure&nbsp;officia&nbsp;exercitationem.&nbsp;Suscipit&nbsp;magni&nbsp;impedit&nbsp;sequi&nbsp;aliquam&nbsp;libero&nbsp;quisquam&nbsp;maiores,&nbsp;fuga&nbsp;voluptatum&nbsp;dolore!&nbsp;Minima,&nbsp;tenetur&nbsp;nobis.&nbsp;</strong>Eveniet&nbsp;fuga&nbsp;id&nbsp;laborum&nbsp;quidem&nbsp;nisi,&nbsp;voluptate&nbsp;aliquam&nbsp;tempore&nbsp;earum&nbsp;hic&nbsp;quaerat&nbsp;neque&nbsp;corporis&nbsp;in&nbsp;excepturi&nbsp;maiores&nbsp;adipisci&nbsp;blanditiis&nbsp;quos?&nbsp;Deserunt&nbsp;odio&nbsp;eos&nbsp;a&nbsp;aut&nbsp;architecto&nbsp;consectetur&nbsp;rem,&nbsp;aperiam&nbsp;optio&nbsp;deleniti&nbsp;obcaecati&nbsp;magni&nbsp;officia&nbsp;consequatur,&nbsp;voluptatum&nbsp;animi&nbsp;numquam,&nbsp;minima&nbsp;incidunt&nbsp;reiciendis.&nbsp;Harum&nbsp;perspiciatis&nbsp;possimus&nbsp;veniam&nbsp;autem,&nbsp;inventore&nbsp;molestias&nbsp;accusamus&nbsp;fugit&nbsp;doloremque&nbsp;repudiandae.&nbsp;Aperiam,&nbsp;amet&nbsp;ut!</p><p>Lorem&nbsp;ipsum&nbsp;dolor,&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;In&nbsp;eos,&nbsp;sit&nbsp;molestias&nbsp;dolores,&nbsp;deserunt&nbsp;inventore&nbsp;alias&nbsp;atque&nbsp;assumenda&nbsp;eius&nbsp;facilis,&nbsp;quas&nbsp;omnis&nbsp;aspernatur.&nbsp;Et&nbsp;quod,&nbsp;nobis&nbsp;reiciendis&nbsp;alias&nbsp;iure&nbsp;officia&nbsp;exercitationem.&nbsp;Suscipit&nbsp;magni&nbsp;impedit&nbsp;sequi&nbsp;aliquam&nbsp;libero&nbsp;quisquam&nbsp;maiores,&nbsp;fuga&nbsp;voluptatum&nbsp;dolore!&nbsp;Minima,&nbsp;tenetur&nbsp;nobis.&nbsp;Eveniet&amp;nbs</p>', 9),
(7, '<p>Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur,&nbsp;adipisicing&nbsp;elit.&nbsp;Libero&nbsp;nemo&nbsp;molestias&nbsp;atque&nbsp;magni&nbsp;veritatis&nbsp;dolorem&nbsp;a&nbsp;reprehenderit&nbsp;itaque&nbsp;voluptatem.&nbsp;Sint,&nbsp;aliquam!&nbsp;Doloremque&nbsp;magnam&nbsp;eum&nbsp;atque&nbsp;tempore&nbsp;porro.&nbsp;Rerum&nbsp;adipisci&nbsp;fugiat&nbsp;sapiente,&nbsp;quod&nbsp;repellat&nbsp;commodi&nbsp;voluptatum&nbsp;quaerat,&nbsp;dicta&nbsp;alias&nbsp;saepe&nbsp;excepturi&nbsp;voluptates,&nbsp;inventore&nbsp;nobis&nbsp;voluptatibus.&nbsp;Unde&nbsp;illum&nbsp;provident&nbsp;harum&nbsp;asperiores&nbsp;consequatur&nbsp;maiores&nbsp;beatae&nbsp;praesentium&nbsp;illo&nbsp;veritatis&nbsp;doloremque&nbsp;nihil,&nbsp;dolorum,&nbsp;esse&nbsp;quam&nbsp;porro&nbsp;omnis&nbsp;quo&nbsp;repudiandae&nbsp;rerum&nbsp;tempora&nbsp;tenetur&nbsp;ut&nbsp;et&nbsp;nam&nbsp;similique?&nbsp;Voluptates&nbsp;quia&nbsp;adipisci&nbsp;quisquam,&nbsp;sunt&nbsp;corporis&nbsp;a&nbsp;amet&nbsp;consectetur&nbsp;eligendi,&nbsp;reiciendis&nbsp;rem&nbsp;labore&nbsp;veritatis&nbsp;numquam&nbsp;laborum&nbsp;assumenda,&nbsp;maiores&nbsp;atque&nbsp;sapiente&nbsp;nemo? 123</p><p>Voluptatibus&nbsp;similique&nbsp;quasi&nbsp;adipisci&nbsp;sequi&nbsp;cumque,&nbsp;eum&nbsp;quae&nbsp;natus&nbsp;quia&nbsp;modi,&nbsp;neque&nbsp;dolores&nbsp;iure&nbsp;dolor&nbsp;possimus&nbsp;voluptate!&nbsp;Minus&nbsp;eaque&nbsp;impedit&nbsp;temporibus&nbsp;repudiandae&nbsp;ab&nbsp;quam&nbsp;id&nbsp;labore&nbsp;accusantium&nbsp;hic&nbsp;doloribus&nbsp;quas&nbsp;illum&nbsp;neque&nbsp;atque&nbsp;iure,&nbsp;vel&nbsp;odit,&nbsp;totam&nbsp;dolores&nbsp;odio&nbsp;delectus&nbsp;assumenda&nbsp;quis&nbsp;provident.&nbsp;Laborum&nbsp;est&nbsp;perferendis&nbsp;sapiente,&nbsp;veritatis&nbsp;nisi&nbsp;possimus&nbsp;ad&nbsp;aspernatur!&nbsp;Similique&nbsp;adipisci&nbsp;optio&nbsp;doloremque&nbsp;excepturi&nbsp;fugit&nbsp;earum&nbsp;dolor&nbsp;illum&nbsp;id&nbsp;ad&nbsp;ut,&nbsp;accusantium&nbsp;error&nbsp;porro&nbsp;odit&nbsp;neque&nbsp;veritatis&nbsp;esse,&nbsp;tempore&nbsp;rem&nbsp;facere&nbsp;iusto&nbsp;deserunt!&nbsp;Harum&nbsp;placeat&nbsp;exercitationem&nbsp;labore&nbsp;illo&nbsp;pariatur&nbsp;officia&nbsp;sit,&nbsp;reiciendis&nbsp;asperiores&nbsp;necessitatibus&nbsp;eius&nbsp;nobis,&nbsp;quas&nbsp;explicabo,&nbsp;nemo&nbsp;dolore&nbsp;expedita&nbsp;vero&nbsp;in&nbsp;corporis&nbsp;facere&nbsp;nulla&nbsp;tempora&nbsp;cum&nbsp;assumenda&nbsp;minus&nbsp;at&nbsp;aspernatur?&nbsp;Voluptas,&nbsp;possimus&nbsp;deserunt!</p>', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(1991) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noImage.png',
  `prices` float NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `images`, `prices`, `category_id`) VALUES
(47, 'Bộ đôi Senka sữa tắm hương hoa dịu ngọt và sữa rửa mặt đất sét trắng', '[\"207405508937a1dde955e83ba1521c6ae92e20417a.jpg\",\"787030863a9f9b3f9fc34987f04ef07b45f9828b8.jpg\",\"578698649eadd38845ae82d0db47e202e253aceb.jpg\",\"20821037912287189cbfa3170c609cbd8d9a7f5889.jpg\"]\r\n', 169000, 47),
(48, 'Son YSL Rouge Pur Couture The Slim', '[\"17236799709406b88298be4377dededf9bdc7dd8e9.jpg\",\"30883317a27ccd2a284f28c4045c0a97d1969430.jpg\",\"17014268056beeb314e43608b1983d72112da3e732.jpg\",\"1545502211636f868e434446e05d7bb95c1456a602.jpg\"]', 559000, 47),
(49, 'Điện thoại Samsung Galaxy S20 (128GB)', '[\"1836503984687b5e867091a878b59f1dad031dc304.jpg\",\"527264486679d3ae8400d7ad90da5da6534d31891.jpg\",\"1258488488cf437bcaaff72eda29105fe4067a7ba8.jpg\",\"542947957b263c07627124e7b9537514f4f6b71b4.jpg\"]\r\n', 15990000, 39),
(50, 'Áo Khoác Kaki Nam AKKNA02️ - Nhiều màu có thể lựa chọn', '[\"343965779c75803542bfb2706a9937972d2f56368 (1).jpg\",\"1168047982b362d3d360fde8f43109b39d5051043e.jpg\",\"387121060c75803542bfb2706a9937972d2f56368.jpg\",\"91573704787a6564eb638c635c97739fd093a0263.jpg\"]', 118000, 38),
(51, 'Tai nghe game thủ Wangming WM9800 giả lập 7.1 USB', '[\"5990235716a3610c78129ae4909d055c19a6003cd.jpg\",\"1921184143a27551bee02bed05eedbe9c34825ba09.jpg\",\"12557214708ee376032bd8bf502f79ea6cf8bd277c.jpg\",\"11117218131d5c21f6117c8cc6b87d890cb99e4530.jpg\"]', 245000, 40);

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `color` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enventory_number` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `final_updated` datetime NOT NULL,
  `description` varchar(1991) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `color`, `size`, `enventory_number`, `likes`, `final_updated`, `description`, `product_id`) VALUES
(2, 'Đỏ', '31', 72, 17, '2020-05-17 12:02:32', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nulla delectus id odit provident doloremque aspernatur laudantium. Aliquid facilis, sint recusandae quidem porro saepe rem illum ad numquam pariatur dicta eius laudantium dolor temporibus quod! Beatae soluta enim atque ipsam quidem sequi nisi placeat eos doloremque odit eaque explicabo veritatis molestiae nesciunt quibusdam obcaecati facilis, quo non odio. Quod aspernatur, quidem eos a accusantium magnam odio, in beatae praesentium pariatur repudiandae expedita asperiores itaque quasi deserunt ad impedit fugiat nobis officia labore, non obcaecati. Eaque pariatur laborum illum, vero unde, maxime numquam dicta illo praesentium enim magni? Mollitia, velit ipsum.\r\n', 44),
(5, 'Xanh', '25', 56, 12, '2020-05-21 21:27:33', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\n', 47),
(6, 'Vàng', '27', 27, 6, '2020-05-21 21:29:49', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\n', 48),
(7, 'Tím', '29', 103, 22, '2020-05-21 21:32:33', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\n', 49),
(8, 'Trắng', '26', 15, 41, '2020-05-22 12:35:19', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\n', 50),
(9, 'Đỏ', '30', 150, 32, '2020-05-22 12:37:07', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium suscipit quia tempore, itaque officia nemo a sint recusandae magnam dolor qui vel, laudantium nihil saepe debitis repudiandae ad cupiditate libero!\r\n', 51),
(10, NULL, NULL, NULL, NULL, '2020-05-31 13:14:17', NULL, 52);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `ship_address` varchar(1991) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noImage.png',
  `user_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `display_name`, `email`, `phone_number`, `sex`, `birthday`, `ship_address`, `avatar`, `user_type`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Sơn Nguyễn', 'nbhson43@gmail.com', '', '', '0000-00-00', '', 'noImage.png', 'admin'),
(18, 'sonnguyen', '6bfc3834d2b273d3479e084b78622adb', 'Sơn Nguyễn', 'nbhson43@gmail.com', '0766899363', 'Nam', '2020-06-25', 'Hẻm 6, đường Trần Vĩnh Kiết, Ninh Kiều - Cần Thơ', '146610342119e97b1779b294eccda3.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_info`
--
ALTER TABLE `cart_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_product`
--
ALTER TABLE `comment_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_info`
--
ALTER TABLE `new_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_info`
--
ALTER TABLE `cart_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `comment_product`
--
ALTER TABLE `comment_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `new_info`
--
ALTER TABLE `new_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
