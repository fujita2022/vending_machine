<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'company_id' => 1,
                'product_name' => 'コーラ',
                'price' => 130,
                'stock' => 10,
                'comment' => '炭酸飲料',
                'img_path' => 'images/coke.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 2,
                'product_name' => 'お茶',
                'price' => 130,
                'stock' => 8,
                'comment' => '緑茶',
                'img_path' => 'images/tea.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 3,
                'product_name' => '水',
                'price' => 110,
                'stock' => 6,
                'comment' => 'ミネラルウォーター',
                'img_path' => 'images/water.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 4,
                'product_name' => '牛乳',
                'price' => 130,
                'stock' => 12,
                'comment' => '乳飲料',
                'img_path' => 'images/milk.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}