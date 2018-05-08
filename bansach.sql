-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table bansach.bills: ~0 rows (approximately)
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` (`id`, `bill_code`, `employee_code`, `created_at`, `updated_at`, `order_id`, `was_paid`) VALUES
	(1, 'B00001', 'E0022', NULL, NULL, 12, 1);
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;

-- Dumping data for table bansach.books: ~9 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `book_code`, `name`, `price`, `img`, `author`, `description`, `publisher`, `quantity`, `created_at`, `updated_at`, `discount`, `img_name`) VALUES
	(1, 'B0001', 'Nguyen Van Nam', 1231.00, 'public/img/a86b703984c4bf837cb1521044483b2595a1641ff1c94de4bfdbc898224ed482.jpg', '12312312a', 'asdasdasdasd', 'asdasdasdas', 14, '2018-03-28 14:06:41', '2018-04-23 08:19:24', 12.00, 'a86b703984c4bf837cb1521044483b2595a1641ff1c94de4bfdbc898224ed482.jpg'),
	(2, 'B0002', 'aaaaaaaa', 2131.00, 'img/undefined.png', 'Nguyen Van Nam aaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaa', 31, '2018-03-28 16:43:11', '2018-04-01 21:29:28', 12.00, 'undefinded.png'),
	(3, 'B0003', 'zzzzzzzz', 12312.00, 'public/img/aa1ca043c12201025ab75bd6f69c1aa935YprfY.jpg', 'zzzzzzzzza', 'Now that we can access all of a post\'s comments, let\'s define a relationship to allow a comment to access its parent post. To define the inverse of a hasMany relationship, define a relationship function on the child model which calls the belongsTo method:', 'zzzzzzz zzzzzzz zzzzzzz', 35, '2018-03-28 16:46:22', '2018-04-26 14:26:42', 12.00, 'aa1ca043c12201025ab75bd6f69c1aa935YprfY.jpg'),
	(4, 'B0004', 'vvvvv', 2000000.00, 'public/img/ddf4c791a13cfd0f39cb8f9992d386afuni seven.png', 'vvvvva', 'vvvv', 'vvvvv', 123, '2018-03-28 16:48:21', '2018-04-22 13:05:54', 23.00, 'ddf4c791a13cfd0f39cb8f9992d386afuni seven.png'),
	(15, 'B0005', 'dragon ball', 20000.00, 'img/undefined.png', 'akira toriyama', 'very good', 'Kim Dong', 12344, '2018-04-01 22:13:28', '2018-04-21 17:26:26', 0.00, 'undefinded.png'),
	(16, 'B0016', 'dragon ball', 20000000.00, 'public/img/92a1c70181a5111b2bd334d8f874ded7aK2Ajeb_700b.jpg', 'akira toriyama', 'very good', 'Kim Dong', 12345, '2018-04-01 22:14:07', '2018-04-09 01:27:06', 5.00, '92a1c70181a5111b2bd334d8f874ded7aK2Ajeb_700b.jpg'),
	(17, 'B0017', 'naruto', 20000.00, 'img/undefined.png', 'Nguyen Van Nam', 'Zlatan Ibrahimovic chỉ vào sân từ phút 71 trong trận ra mắt đội bóng mới LA Galaxy ở giải bóng đá nhà nghề Mỹ (MLS). Tuy nhiên, chân sút người Thụy Điển lập tức để lại dấu ấn với một siêu phẩm vô-lê từ rất xa rồi sau đó đánh đầu ghi bàn ấn định chiến thắng cho đội chủ nhà.', 'Kim Dong', 123456, '2018-04-01 22:15:01', '2018-04-01 23:13:22', 0.00, 'undefinded.png'),
	(18, 'B0018', '7 vien ngoc rong', 20000.00, 'public/img/bd793a71fadd581855b110bccb71a570dragonballz4.jpg', 'akira toriyama', 'Dragon Ball là một bộ truyện tranh nhiều tập được viết và vẽ minh họa bởi Toriyama Akira. Loạt truyện tranh bắt đầu xuất bản hàng tuần trong danh sách Shōnen từ năm 1984 đến 1995 với 519 chương và sau đó được xuất bản trong 42 tập truyện dày bởi nhà xuất bản Shueisha. Tương phản với tiểu thuyết Tây du ký của Trung Quốc, loạt truyện mô tả cuộc hành trình của Son Goku từ lúc bé đến trưởng thành, qua các lần tầm sư học võ và khám phá thế giới để truy tìm các viên ngọc rồng với điều ước từ rồng thiêng. Xuyên suốt hành trình của Son Goku, cậu đã gặp được nhiều bạn bè và chống lại những kẻ hung ác có ý định dùng điều ước từ rồng thiêng để làm bá chủ thế giới.', 'Kim Dong', 20000, '2018-04-09 13:58:22', '2018-04-09 14:10:27', 0.00, 'bd793a71fadd581855b110bccb71a570dragonballz4.jpg'),
	(19, 'B0019', 'Naruto', 20000.00, 'public/img/7d7da78aca420397427f06af2fb34beanb_game_thumb_408x314.jpg', 'Kishimoto Masashi', 'Naruto (—ナルト— NARUTO?) là loạt manga Nhật Bản bằng văn bản và minh họa bởi tác giả Kishimoto Masashi, đã được dựng thành anime (phim hoạt hình Nhật). Nhân vật chính là Uzumaki Naruto, một thiếu niên ồn ào, hiếu động, một ninja luôn muốn tìm cách khẳng định mình để được mọi người công nhận, rất muốn trở thành Hokage (Hỏa Ảnh) - người lãnh đạo ninja cả làng, được tất cả mọi người kính trọng. Kishimoto ban đầu đã phác hoạ Naruto trong một ấn bản Akamaru Jump vào tháng 8 năm 1997.[1] Sự khác biệt ở chỗ Naruto là chủ thể của Hồ Li Chín Đuôi được chính cha của mình phong ấn vào người, và câu chuyện được đặt trong bối cảnh hiện đại hơn.[2] Phiên bản ban đầu của Naruto này đã có khả năng biến thành một phụ nữ quyến rũ – nhưng khi cậu ta làm vậy, một cái đuôi cáo xuất hiện. Kishimoto sau đó mới sáng tác lại câu chuyện thành hiện trạng, và được phát hành lần đầu bởi Shueisha vào năm 1999 trong ấn bản thứ 43 của tạp chí Tuần san thiếu niên Jump tại Nhật. Đến tập 36, bộ manga đã bán được hơn 71 triệu bản tại Nhật.[3] Tập truyện được cấp giấy phép cho việc phát hành bản dịch sang tiếng Anh bởi Viz Media. Được đăng nhiều kỳ trên tạp chí Shonen Jump, Naruto đã trở thành loạt manga bán chạy nhất của công ty.[4] Cho đến 2 tháng 4 năm 2008, 28 tập đầu tiên của bộ truyện đã có mặt trong tiếng Anh.\r\n\r\nVà kể từ tháng 4 năm 2008, Bộ truyện nổi tiếng này đã chính thức được TVM Comics mua bản quyền và xuất bản phiên bản tiếng Việt tại thị trường Việt Nam.', 'Kim Đồng', 12342, '2018-04-23 08:25:02', '2018-04-23 08:27:31', 12.00, '7d7da78aca420397427f06af2fb34beanb_game_thumb_408x314.jpg');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping data for table bansach.book_category: ~16 rows (approximately)
/*!40000 ALTER TABLE `book_category` DISABLE KEYS */;
INSERT INTO `book_category` (`book_id`, `category_id`) VALUES
	(1, 4),
	(1, 8),
	(3, 7),
	(3, 9),
	(4, 7),
	(16, 3),
	(17, 3),
	(17, 7),
	(17, 8),
	(17, 9),
	(18, 3),
	(18, 4),
	(18, 6),
	(19, 3),
	(19, 4),
	(19, 6);
/*!40000 ALTER TABLE `book_category` ENABLE KEYS */;

-- Dumping data for table bansach.book_employee: ~0 rows (approximately)
/*!40000 ALTER TABLE `book_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_employee` ENABLE KEYS */;

-- Dumping data for table bansach.book_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `book_user` DISABLE KEYS */;
INSERT INTO `book_user` (`book_id`, `user_id`, `star`, `comment`, `isLike`, `created_at`, `updated_at`) VALUES
	(1, 23, NULL, NULL, 1, '2018-04-26 14:50:58', '2018-04-26 14:50:58'),
	(3, 23, 3, 'tàm tạm', 1, '2018-04-26 15:00:47', '2018-04-26 15:24:30');
/*!40000 ALTER TABLE `book_user` ENABLE KEYS */;

-- Dumping data for table bansach.cart: ~0 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping data for table bansach.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(3, 'action', '2018-03-29 05:59:40', '2018-03-29 05:59:40'),
	(4, 'comedy', '2018-03-30 08:24:50', '2018-03-30 08:24:50'),
	(6, 'adventure', '2018-03-30 08:25:37', '2018-03-30 08:25:37'),
	(7, 'documents', '2018-03-30 08:25:48', '2018-03-30 08:25:48'),
	(8, 'mathematic', '2018-03-30 08:26:03', '2018-03-30 08:26:03'),
	(9, 'chemistry', '2018-03-30 08:26:12', '2018-03-30 08:26:12');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping data for table bansach.employees: ~5 rows (approximately)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `employee_code`, `salary_level`, `dob`, `level`, `created_at`, `updated_at`, `position_id`) VALUES
	(1, 'E0001', 5.00, '1997-05-27', 1, NULL, NULL, 1),
	(17, 'E0017', 5.00, '1111-11-11', 1, '2018-04-02 16:14:41', '2018-04-02 20:51:43', 2),
	(20, 'E0018', 5.00, '2011-02-12', 1, '2018-04-02 19:24:37', '2018-04-02 19:24:37', 1),
	(21, 'E0021', 5.00, '4212-05-12', 1, '2018-04-02 19:25:03', '2018-04-02 20:51:50', 2),
	(22, 'E0022', 5.00, '3424-03-21', 1, '2018-04-02 19:25:26', '2018-04-02 19:25:26', 1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping data for table bansach.migrations: ~30 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(31, '2014_10_12_000000_create_users_table', 1),
	(32, '2014_10_12_100000_create_password_resets_table', 1),
	(33, '2018_02_19_143011_create_books_table', 1),
	(34, '2018_02_19_143128_create_employees_table', 1),
	(35, '2018_02_19_143330_create_bills_table', 1),
	(36, '2018_02_19_143417_create_publishers_table', 1),
	(37, '2018_02_19_143445_create_positions_table', 1),
	(38, '2018_02_19_143910_create_categories_table', 1),
	(39, '2018_02_20_143541_create_book_category_pivot_table', 1),
	(40, '2018_02_20_143623_create_book_user_pivot_table', 1),
	(41, '2018_02_20_143647_create_book_employee_pivot_table', 1),
	(42, '2018_02_20_144658_add_foreign_key_on_employees_table_references_to_positions_table', 1),
	(43, '2018_02_20_145114_add_foreign_key_on_employees_table_references_to_users_table', 1),
	(44, '2018_02_21_040642_create_book_user_cart_table', 1),
	(45, '2018_02_25_053255_create_carts_table', 1),
	(46, '2018_02_25_055346_rename_book_user_cart_table_to_book_cart_user', 1),
	(47, '2018_02_25_055458_add_foreign_key_on_book_cart_user_references_to_carts_table', 1),
	(48, '2018_02_25_055914_delete_publishers_table', 1),
	(49, '2018_03_05_152907_add_discount_column_in_books_table', 1),
	(50, '2018_03_28_132754_add_img_name_column_on_books_table', 1),
	(51, '2018_03_29_053902_change_categories_name_to_unique', 1),
	(52, '2018_04_02_144912_change_max_length_password_column_on_users_table', 1),
	(53, '2018_04_09_115256_add_is_like_column_on_book_user_table', 1),
	(54, '2018_04_10_011959_add_timestamps_on_book_user_table', 1),
	(55, '2018_04_14_130401_drop-cart-table', 1),
	(56, '2018_04_14_131127_rename_book_cart_user_table_to_cart_and_rename_cart_id_to_cart_code', 1),
	(57, '2018_04_19_214711_create_orders_table', 1),
	(58, '2018_04_19_215537_create_order_items_table', 1),
	(59, '2018_04_21_151918_create_user_information_table', 1),
	(60, '2018_04_22_104909_add_foreign_key_on_bills_table_references_to_orders_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table bansach.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
	(12, 23, 'Nguyễn Văn Nam', '0977214760', '275nam@gmail.com', 'Me Linh Ha Noi', '2018-04-26 14:26:42', '2018-04-26 14:26:42');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping data for table bansach.order_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`id`, `book_code`, `name`, `price`, `discount`, `quantity`, `created_at`, `updated_at`, `order_id`) VALUES
	(13, 'B0003', 'zzzzzzzz', 12312.00, 12, 4, '2018-04-26 14:26:42', '2018-04-26 14:26:42', 12);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Dumping data for table bansach.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table bansach.positions: ~2 rows (approximately)
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` (`id`, `position_code`, `name`, `base_salary_level`, `created_at`, `updated_at`) VALUES
	(1, 'P0001', 'giám đốc', 5.00, NULL, '2018-04-02 20:50:09'),
	(2, 'P0002', 'thu ngân', 2.40, '2018-04-02 20:49:42', '2018-04-02 20:49:42');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

-- Dumping data for table bansach.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_customer`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'nguyen van anm', 'rockman2996@gmail.com', '$2y$10$6ZFnT3hwBLk4LhWVWEIfluIzti4vO4ZMcf3KDZXwxz82rqNi/2zEy', 0, 'Wp3iFtfRAczNtjZJAPB20IBaLjo1ZOdbGefCSxspvpt1MOsBXgTsC6RAuoWc', NULL, NULL),
	(17, 'vu van tuong', 'afasdf@gmail.com', '$2y$10$cEv/m4TlUmXnCQCFVb.zYOfaSD0GLzaHMXzU6WvLpldHBbLgrXA3m', 0, NULL, '2018-04-02 16:14:41', '2018-04-02 20:51:43'),
	(20, 'nguyen ngoc anh', 'nna@gmail.com', '$2y$10$fL6MpPnvqqfRN1FfGqjQGOSONT5H42y2D.cFlO3PBqSR3IohJLqMu', 0, NULL, '2018-04-02 19:24:37', '2018-04-17 10:06:53'),
	(21, 'vu xuan luong', 'vxl@yahoo.com', '$2y$10$w0TpMYf4.Ol0BkydjIF5eerGLGRdOOSZyOjmbgxgilcmsPTeFf6nO', 0, NULL, '2018-04-02 19:25:03', '2018-04-02 20:51:50'),
	(22, 'nguyen dinh trung', 'ndt@gmail.com', '$2y$10$L/R4hwjNVSv3GD44pez8y.ZFdd89v5xvYlnujP8u5F2ynDfPwUuTO', 0, NULL, '2018-04-02 19:25:26', '2018-04-02 19:25:26'),
	(23, 'Nguyễn Văn Nam', '275nam@gmail.com', '$2y$10$VKadzBUY42b.HKSei1/vr.yZqLsDmuIra6DpoOw/9Uf83KS1DvTDW', 1, 'd04BvmWsNUeCbYN2iUbsl61LfPFIuF0gKOjVUjnejI9Bc3Cw1VZej0F1W7O1', '2018-04-09 22:58:06', '2018-04-22 12:51:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping data for table bansach.user_information: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_information` DISABLE KEYS */;
INSERT INTO `user_information` (`id`, `phone`, `gender`, `dob`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, '0977214760', 'nam', '1997-05-27', 23, '2018-04-22 12:51:00', '2018-04-22 12:51:30');
/*!40000 ALTER TABLE `user_information` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
