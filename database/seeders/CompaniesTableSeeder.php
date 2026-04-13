<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            [
                'company_name' => 'Coca-Cola',
                'street_address' => '東京都渋谷区1-1-1',
                'representative_name' => '山田 太郎',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'サントリー',
                'street_address' => '東京都港区2-2-2',
                'representative_name' => '山田 一郎',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'キリン',
                'street_address' => '東京都新宿区3-3-3',
                'representative_name' => '山田 二郎',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'meiji',
                'street_address' => '東京都新宿区4-4-4',
                'representative_name' => '山田 三郎',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}