-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2026 at 05:24 PM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdoanvat`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã danh mục',
  `name` varchar(255) NOT NULL COMMENT 'Tên danh mục',
  `slug` varchar(255) NOT NULL COMMENT 'Đường dẫn thân thiện (URL slug)',
  `icon` varchar(255) DEFAULT NULL COMMENT 'Biểu tượng danh mục',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng danh mục sản phẩm';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Đồ chiên & Nướng', 'do-chien-nuong', '🍗', '2026-04-06 20:53:12', '2026-04-06 20:53:12'),
(2, 'Đồ uống', 'do-uong', '🧋', '2026-04-06 20:53:12', '2026-04-06 20:53:12'),
(3, 'Bánh & Kẹo', 'banh-keo', '🍰', '2026-04-06 20:53:12', '2026-04-06 20:53:12'),
(4, 'Snack & Bim bim', 'snack-bim-bim', '🍿', '2026-04-06 20:53:12', '2026-04-06 20:53:12'),
(5, 'Món trộn', 'mon-tron', '🥗', '2026-04-06 20:53:12', '2026-04-06 20:53:12');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_04_01_021538_create_products_table', 1),
(6, '2026_04_02_000001_create_categories_table', 2),
(7, '2026_04_02_000002_add_category_id_to_products_table', 2),
(8, '2026_04_02_000003_create_orders_table', 3),
(9, '2026_04_02_000004_create_order_items_table', 3),
(11, '2026_04_02_000005_add_vietnamese_comments_to_tables', 4),
(12, '2026_04_02_000006_add_role_to_users_table', 5),
(13, '2026_04_02_000007_add_quantity_to_products_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã người đặt (khóa ngoại)',
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái đơn hàng (pending/confirmed/shipping/completed/cancelled)',
  `total` int(11) NOT NULL COMMENT 'Tổng tiền đơn hàng (VNĐ)',
  `note` text DEFAULT NULL COMMENT 'Ghi chú của khách hàng',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày đặt hàng',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày cập nhật đơn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng đơn hàng';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'completed', 500000, 'okkkk', '2026-04-06 21:52:26', '2026-04-06 22:35:46'),
(2, 1, 'completed', 45000, NULL, '2026-04-06 22:35:59', '2026-04-06 22:42:56'),
(3, 2, 'completed', 15000, NULL, '2026-04-07 09:57:20', '2026-04-07 09:57:49'),
(4, 2, 'pending', 40000, 'OKKKK 123', '2026-04-07 17:00:08', '2026-04-07 17:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chi tiết',
  `order_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng (khóa ngoại)',
  `product_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm (khóa ngoại)',
  `quantity` int(11) NOT NULL COMMENT 'Số lượng',
  `price` int(11) NOT NULL COMMENT 'Giá tại thời điểm mua (VNĐ)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng chi tiết đơn hàng';

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 20, 25000, '2026-04-06 21:52:26', '2026-04-06 21:52:26'),
(2, 2, 2, 1, 20000, '2026-04-06 22:35:59', '2026-04-06 22:35:59'),
(3, 2, 3, 1, 25000, '2026-04-06 22:35:59', '2026-04-06 22:35:59'),
(4, 3, 1, 1, 15000, '2026-04-07 09:57:20', '2026-04-07 09:57:20'),
(5, 4, 2, 2, 20000, '2026-04-07 17:00:08', '2026-04-07 17:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL COMMENT 'Email người dùng',
  `token` varchar(255) NOT NULL COMMENT 'Token đặt lại mật khẩu',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày tạo token'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng token đặt lại mật khẩu';

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Mã danh mục (khóa ngoại)',
  `name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `description` text DEFAULT NULL COMMENT 'Mô tả sản phẩm',
  `price` int(11) NOT NULL COMMENT 'Giá sản phẩm (VNĐ)',
  `quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'So luong ton kho',
  `image` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn hình ảnh',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng sản phẩm đồ ăn vặt';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Xúc xích Đức nướng', 'Xúc xích', 15000, 0, 'https://res.cloudinary.com/dbkm4sgyu/image/upload/v1775580431/snackstore/products/xjqaqt6hsm2itwalcnpu.png', '2026-04-06 20:53:42', '2026-04-07 09:57:20'),
(2, 1, 'Gà viên chiên giòn', 'Gà viên tẩm bột chiên vàng giòn rụm, bên trong mềm thơm. Ăn kèm sốt chua ngọt tuyệt hảo.', 20000, 35, 'https://images.unsplash.com/photo-1562967914-608f82629710?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 17:00:08'),
(3, 1, 'Khoai tây lốc xoáy', 'Khoai tây cắt xoắn chiên giòn, rắc bột phô mai thơm lừng. Món ăn vặt hot nhất đường phố.', 25000, 37, 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(4, 1, 'Pizza cuộn mini', 'Pizza thơm lừng với lớp phô mai béo ngậy tan chảy. Size mini vừa ăn, tiện lợi mang đi.', 25000, 37, 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(5, 2, 'Trà sữa trân châu đường đen', 'Trà sữa thơm béo cùng trân châu dai dai ngọt ngào. Thức uống giải khát số 1 giới trẻ.', 30000, 37, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJbx09sDpjd7kLZYopquWH_0B6I0pp2wDVTua79cL4OHwidI0_Pve7_ekrbmAfaOSffRiz7k9l081loDicMLKsRrCueiYpDNS7Aiuk7oLfOg&s=10', '2026-04-06 20:53:42', '2026-04-07 17:00:58'),
(6, 2, 'Nước ép cam tươi', 'Cam vắt tươi nguyên chất 100%, không đường hóa học. Bổ sung vitamin C tự nhiên cho ngày dài.', 20000, 37, 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/Nuoc_ep_cam_0ae1447a8f.jpg', '2026-04-06 20:53:42', '2026-04-07 17:03:19'),
(7, 2, 'Sữa chua trân châu', 'Sữa chua mát lạnh kết hợp trân châu dẻo thơm và topping trái cây tươi ngon.', 22000, 37, 'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(8, 3, 'Kẹo mút Chupa Chups', 'Kẹo mút trái cây thơm ngọt, tuổi thơ dữ dội. Đủ vị: dâu, cam, nho, cola.', 2000, 37, 'https://www.lottemart.vn/media/catalog/product/cache/0x0/8/9/8935001716969.jpg.webp', '2026-04-06 20:53:42', '2026-04-07 17:04:09'),
(9, 3, 'Bánh gấu nhân kem', 'Bánh gấu giòn xốp với nhân kem socola béo ngậy bên trong. Ăn một cái là muốn ăn thêm.', 12000, 37, 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(10, 3, 'Bánh plan caramel', 'Bánh plan mềm mịn như mây, phủ lớp caramel ngọt thanh thơm lừng.', 18000, 37, 'https://images.unsplash.com/photo-1528975604071-b4dc52a2d18c?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(11, 4, 'Bim bim Oishi tôm cay', 'Bim bim Oishi tôm cay giòn rụm, ăn là nghiền. Gói lớn chia sẻ cùng bạn bè.', 5000, 37, 'https://www.lottemart.vn/media/catalog/product/cache/0x0/8/9/8934803040272-1.jpg.webp', '2026-04-06 20:53:42', '2026-04-07 17:02:58'),
(12, 4, 'Bắp rang bơ caramel', 'Bắp rang vàng ươm phủ caramel ngọt ngào, giòn tan trong miệng. Lý tưởng cho buổi xem phim.', 15000, 37, 'https://sieuthinguyenlieu.com/assets/uploads/images/7m2haUXc1f6d_ca-phe-da-xay-bap-rang-bo-sot-caramel-3.jpg', '2026-04-06 20:53:42', '2026-04-07 17:01:40'),
(13, 4, 'Que cay Hàn Quốc', 'Que snack cay nồng kiểu Hàn, vị cay tê lưỡi cực đã. Ăn vặt đêm không gì bằng.', 8000, 37, 'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?q=80&w=400&auto=format&fit=crop', '2026-04-06 20:53:42', '2026-04-07 09:54:51'),
(14, 5, 'Bánh tráng trộn Nam Bộ', 'Đậm vị chua cay mặn ngọt, thêm khô bò, trứng cút tuyệt hảo. Đặc sản đường phố Sài Gòn.', 20000, 37, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMarJNGet-IWpRQCCW83Qymyag5Y4UEIixUA&s', '2026-04-06 20:53:42', '2026-04-07 17:02:09'),
(15, 5, 'Gỏi cuốn tôm thịt', 'Gỏi cuốn tươi mát với tôm, thịt luộc, bún và rau sống. Chấm nước mắm chua ngọt hấp dẫn.', 25000, 37, 'https://i-giadinh.vnecdn.net/2025/12/09/Goi-cuon-tom-thit-7-vnexpress-2800-5342-1765272698.jpg', '2026-04-06 20:53:42', '2026-04-07 17:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã người dùng',
  `name` varchar(255) NOT NULL COMMENT 'Họ và tên',
  `email` varchar(255) NOT NULL COMMENT 'Địa chỉ email',
  `email_verified_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian xác thực email',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu (đã mã hóa)',
  `remember_token` varchar(100) DEFAULT NULL COMMENT 'Token ghi nhớ đăng nhập',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày tạo tài khoản',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Ngày cập nhật gần nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng người dùng';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Khắc Quyết', 'quyet123@yopmail.com', NULL, '$2y$12$sroZfY5.T1Lp2vwyuqiVhOQxP/qPUJNbimmrPs/3VyLF5ba6W2vhi', NULL, 'user', '2026-03-31 19:31:33', '2026-04-07 00:20:07'),
(2, 'Admin', 'admin@mail.com', NULL, '$2y$12$M6gJOT0kkeF4P.jF0Zx3Y.9jGlaMGis8KdPQq31Vfz8lILSgMV0EG', NULL, 'admin', '2026-04-06 22:18:12', '2026-04-06 22:18:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  ADD KEY `products_category_id_foreign` (`category_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã danh mục', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chi tiết', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã người dùng', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
