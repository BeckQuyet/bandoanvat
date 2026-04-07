<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        $products = [
            // Do chien & Nuong
            [
                'name' => 'Xúc xích Đức nướng',
                'description' => 'Xúc xích Đức thơm lừng, vỏ giòn thịt mọng nước. Nướng trên than hồng, chấm tương ớt cay nồng.',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-chien-nuong',
            ],
            [
                'name' => 'Gà viên chiên giòn',
                'description' => 'Gà viên tẩm bột chiên vàng giòn rụm, bên trong mềm thơm. Ăn kèm sốt chua ngọt tuyệt hảo.',
                'price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-chien-nuong',
            ],
            [
                'name' => 'Khoai tây lốc xoáy',
                'description' => 'Khoai tây cắt xoắn chiên giòn, rắc bột phô mai thơm lừng. Món ăn vặt hot nhất đường phố.',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-chien-nuong',
            ],
            [
                'name' => 'Pizza cuộn mini',
                'description' => 'Pizza thơm lừng với lớp phô mai béo ngậy tan chảy. Size mini vừa ăn, tiện lợi mang đi.',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-chien-nuong',
            ],

            // Do uong
            [
                'name' => 'Trà sữa trân châu đường đen',
                'description' => 'Trà sữa thơm béo cùng trân châu dai dai ngọt ngào. Thức uống giải khát số 1 giới trẻ.',
                'price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1558857563-b37102e95e29?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-uong',
            ],
            [
                'name' => 'Nước ép cam tươi',
                'description' => 'Cam vắt tươi nguyên chất 100%, không đường hóa học. Bổ sung vitamin C tự nhiên cho ngày dài.',
                'price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-uong',
            ],
            [
                'name' => 'Sữa chua trân châu',
                'description' => 'Sữa chua mát lạnh kết hợp trân châu dẻo thơm và topping trái cây tươi ngon.',
                'price' => 22000,
                'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'do-uong',
            ],

            // Banh & Keo
            [
                'name' => 'Kẹo mút Chupa Chups',
                'description' => 'Kẹo mút trái cây thơm ngọt, tuổi thơ dữ dội. Đủ vị: dâu, cam, nho, cola.',
                'price' => 2000,
                'image' => 'https://images.unsplash.com/photo-1499195333224-3ce974eecb47?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'banh-keo',
            ],
            [
                'name' => 'Bánh gấu nhân kem',
                'description' => 'Bánh gấu giòn xốp với nhân kem socola béo ngậy bên trong. Ăn một cái là muốn ăn thêm.',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'banh-keo',
            ],
            [
                'name' => 'Bánh plan caramel',
                'description' => 'Bánh plan mềm mịn như mây, phủ lớp caramel ngọt thanh thơm lừng.',
                'price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1528975604071-b4dc52a2d18c?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'banh-keo',
            ],

            // Snack & Bim bim
            [
                'name' => 'Bim bim Oishi tôm cay',
                'description' => 'Bim bim Oishi tôm cay giòn rụm, ăn là nghiền. Gói lớn chia sẻ cùng bạn bè.',
                'price' => 5000,
                'image' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'snack-bim-bim',
            ],
            [
                'name' => 'Bắp rang bơ caramel',
                'description' => 'Bắp rang vàng ươm phủ caramel ngọt ngào, giòn tan trong miệng. Lý tưởng cho buổi xem phim.',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1585735175002-0ae085d83738?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'snack-bim-bim',
            ],
            [
                'name' => 'Que cay Hàn Quốc',
                'description' => 'Que snack cay nồng kiểu Hàn, vị cay tê lưỡi cực đã. Ăn vặt đêm không gì bằng.',
                'price' => 8000,
                'image' => 'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'snack-bim-bim',
            ],

            // Mon tron
            [
                'name' => 'Bánh tráng trộn Nam Bộ',
                'description' => 'Đậm vị chua cay mặn ngọt, thêm khô bò, trứng cút tuyệt hảo. Đặc sản đường phố Sài Gòn.',
                'price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1627308595229-7830f5c9c66e?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'mon-tron',
            ],
            [
                'name' => 'Gỏi cuốn tôm thịt',
                'description' => 'Gỏi cuốn tươi mát với tôm, thịt luộc, bún và rau sống. Chấm nước mắm chua ngọt hấp dẫn.',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1562967916-eb82221dfb44?q=80&w=400&auto=format&fit=crop',
                'category_slug' => 'mon-tron',
            ],
        ];

        foreach ($products as $productData) {
            $slug = $productData['category_slug'];
            unset($productData['category_slug']);
            $productData['category_id'] = $categories->get($slug)?->id;
            $productData['quantity'] = rand(10, 50);
            Product::create($productData);
        }
    }
}
