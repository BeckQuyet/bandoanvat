<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Đồ chiên & Nướng', 'slug' => 'do-chien-nuong', 'icon' => '🍗'],
            ['name' => 'Đồ uống', 'slug' => 'do-uong', 'icon' => '🧋'],
            ['name' => 'Bánh & Kẹo', 'slug' => 'banh-keo', 'icon' => '🍰'],
            ['name' => 'Snack & Bim bim', 'slug' => 'snack-bim-bim', 'icon' => '🍿'],
            ['name' => 'Món trộn', 'slug' => 'mon-tron', 'icon' => '🥗'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
