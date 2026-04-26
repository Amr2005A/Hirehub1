<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'دمشق',       'country_id' => 1],
            ['name' => 'حلب',        'country_id' => 1],
            ['name' => 'حمص',        'country_id' => 1],
            ['name' => 'اللاذقية',   'country_id' => 1],
            ['name' => 'حماة',       'country_id' => 1],
            ['name' => 'بيروت',      'country_id' => 2],
            ['name' => 'طرابلس',     'country_id' => 2],
            ['name' => 'صيدا',       'country_id' => 2],
            ['name' => 'عمّان',      'country_id' => 3],
            ['name' => 'إربد',       'country_id' => 3],
            ['name' => 'الزرقاء',    'country_id' => 3],
            ['name' => 'بغداد',      'country_id' => 4],
            ['name' => 'البصرة',     'country_id' => 4],
            ['name' => 'أربيل',      'country_id' => 4],
            ['name' => 'القاهرة',    'country_id' => 5],
            ['name' => 'الإسكندرية', 'country_id' => 5],
            ['name' => 'الجيزة',     'country_id' => 5],
            ['name' => 'الرياض',     'country_id' => 6],
            ['name' => 'جدة',        'country_id' => 6],
            ['name' => 'مكة المكرمة','country_id' => 6],
            ['name' => 'دبي',        'country_id' => 7],
            ['name' => 'أبوظبي',     'country_id' => 7],
            ['name' => 'الشارقة',    'country_id' => 7],
            ['name' => 'الكويت',     'country_id' => 8],
            ['name' => 'حولي',       'country_id' => 8],
            ['name' => 'الدوحة',     'country_id' => 9],
            ['name' => 'الريان',     'country_id' => 9],
            ['name' => 'المنامة',    'country_id' => 10],
            ['name' => 'المحرق',     'country_id' => 10],
            ['name' => 'الرفاع',     'country_id' => 10],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name'       => $city['name'],
                'country_id' => $city['country_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
