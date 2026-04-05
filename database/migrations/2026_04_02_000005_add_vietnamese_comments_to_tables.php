<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Bang nguoi dung (users)
        DB::statement("ALTER TABLE `users` COMMENT = 'Bảng người dùng'");
        DB::statement("ALTER TABLE `users` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã người dùng'");
        DB::statement("ALTER TABLE `users` MODIFY `name` VARCHAR(255) NOT NULL COMMENT 'Họ và tên'");
        DB::statement("ALTER TABLE `users` MODIFY `email` VARCHAR(255) NOT NULL COMMENT 'Địa chỉ email'");
        DB::statement("ALTER TABLE `users` MODIFY `email_verified_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Thời gian xác thực email'");
        DB::statement("ALTER TABLE `users` MODIFY `password` VARCHAR(255) NOT NULL COMMENT 'Mật khẩu (đã mã hóa)'");
        DB::statement("ALTER TABLE `users` MODIFY `remember_token` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Token ghi nhớ đăng nhập'");
        DB::statement("ALTER TABLE `users` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày tạo tài khoản'");
        DB::statement("ALTER TABLE `users` MODIFY `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày cập nhật gần nhất'");

        // Bang danh muc (categories)
        DB::statement("ALTER TABLE `categories` COMMENT = 'Bảng danh mục sản phẩm'");
        DB::statement("ALTER TABLE `categories` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã danh mục'");
        DB::statement("ALTER TABLE `categories` MODIFY `name` VARCHAR(255) NOT NULL COMMENT 'Tên danh mục'");
        DB::statement("ALTER TABLE `categories` MODIFY `slug` VARCHAR(255) NOT NULL COMMENT 'Đường dẫn thân thiện (URL slug)'");
        DB::statement("ALTER TABLE `categories` MODIFY `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Biểu tượng danh mục'");
        DB::statement("ALTER TABLE `categories` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày tạo'");
        DB::statement("ALTER TABLE `categories` MODIFY `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày cập nhật'");

        // Bang san pham (products)
        DB::statement("ALTER TABLE `products` COMMENT = 'Bảng sản phẩm đồ ăn vặt'");
        DB::statement("ALTER TABLE `products` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm'");
        DB::statement("ALTER TABLE `products` MODIFY `category_id` BIGINT UNSIGNED NULL DEFAULT NULL COMMENT 'Mã danh mục (khóa ngoại)'");
        DB::statement("ALTER TABLE `products` MODIFY `name` VARCHAR(255) NOT NULL COMMENT 'Tên sản phẩm'");
        DB::statement("ALTER TABLE `products` MODIFY `description` TEXT NULL DEFAULT NULL COMMENT 'Mô tả sản phẩm'");
        DB::statement("ALTER TABLE `products` MODIFY `price` INT NOT NULL COMMENT 'Giá sản phẩm (VNĐ)'");
        DB::statement("ALTER TABLE `products` MODIFY `image` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Đường dẫn hình ảnh'");
        DB::statement("ALTER TABLE `products` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày tạo'");
        DB::statement("ALTER TABLE `products` MODIFY `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày cập nhật'");

        // Bang don hang (orders)
        DB::statement("ALTER TABLE `orders` COMMENT = 'Bảng đơn hàng'");
        DB::statement("ALTER TABLE `orders` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng'");
        DB::statement("ALTER TABLE `orders` MODIFY `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'Mã người đặt (khóa ngoại)'");
        DB::statement("ALTER TABLE `orders` MODIFY `status` VARCHAR(255) NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái đơn hàng (pending/confirmed/shipping/completed/cancelled)'");
        DB::statement("ALTER TABLE `orders` MODIFY `total` INT NOT NULL COMMENT 'Tổng tiền đơn hàng (VNĐ)'");
        DB::statement("ALTER TABLE `orders` MODIFY `note` TEXT NULL DEFAULT NULL COMMENT 'Ghi chú của khách hàng'");
        DB::statement("ALTER TABLE `orders` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày đặt hàng'");
        DB::statement("ALTER TABLE `orders` MODIFY `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày cập nhật đơn'");

        // Bang chi tiet don hang (order_items)
        DB::statement("ALTER TABLE `order_items` COMMENT = 'Bảng chi tiết đơn hàng'");
        DB::statement("ALTER TABLE `order_items` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chi tiết'");
        DB::statement("ALTER TABLE `order_items` MODIFY `order_id` BIGINT UNSIGNED NOT NULL COMMENT 'Mã đơn hàng (khóa ngoại)'");
        DB::statement("ALTER TABLE `order_items` MODIFY `product_id` BIGINT UNSIGNED NOT NULL COMMENT 'Mã sản phẩm (khóa ngoại)'");
        DB::statement("ALTER TABLE `order_items` MODIFY `quantity` INT NOT NULL COMMENT 'Số lượng'");
        DB::statement("ALTER TABLE `order_items` MODIFY `price` INT NOT NULL COMMENT 'Giá tại thời điểm mua (VNĐ)'");
        DB::statement("ALTER TABLE `order_items` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày tạo'");
        DB::statement("ALTER TABLE `order_items` MODIFY `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày cập nhật'");

        // Bang password_reset_tokens
        DB::statement("ALTER TABLE `password_reset_tokens` COMMENT = 'Bảng token đặt lại mật khẩu'");
        DB::statement("ALTER TABLE `password_reset_tokens` MODIFY `email` VARCHAR(255) NOT NULL COMMENT 'Email người dùng'");
        DB::statement("ALTER TABLE `password_reset_tokens` MODIFY `token` VARCHAR(255) NOT NULL COMMENT 'Token đặt lại mật khẩu'");
        DB::statement("ALTER TABLE `password_reset_tokens` MODIFY `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Ngày tạo token'");
    }

    public function down(): void
    {
        // Xoa comment (dat lai ve rong)
        $tables = ['users', 'categories', 'products', 'orders', 'order_items', 'password_reset_tokens'];
        foreach ($tables as $table) {
            DB::statement("ALTER TABLE `{$table}` COMMENT = ''");
        }
    }
};
