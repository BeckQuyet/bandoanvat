<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bim bim Oishi Cay',
                'description' => 'Bim bim Oishi tôm cay giòn rụm, ăn là nghiền.',
                'price' => 5000,
                'image' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Trà sữa trân châu đường đen',
                'description' => 'Trà sữa thơm béo cùng trân châu dai dai ngọt ngào.',
                'price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1558857563-b37102e95e29?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Bánh tráng trộn Nam Bộ',
                'description' => 'Đậm vị chua cay mặn ngọt, thêm khô bò, trứng cút tuyệt hảo.',
                'price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1627308595229-7830f5c9c66e?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Xúc xích Đức nướng',
                'description' => 'Xúc xích Đức thơm lừng, vỏ giòn thịt mọng nước.',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Kẹo mút Chupa Chups',
                'description' => 'Kẹo mút trái cây thơm ngọt, tuổi thơ dữ dội.',
                'price' => 2000,
                'image' => 'https://images.unsplash.com/photo-1499195333224-3ce974eecb47?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Pizza cuộn mini',
                'description' => 'Pizza thơm lừng với lớp phô mai béo ngậy tan chảy.',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=400&auto=format&fit=crop',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
