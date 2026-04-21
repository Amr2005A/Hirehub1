<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         UserProfile::create([
            'user_id' => 1,
            'personal_info' => 'has 55 years old',
            'hourly_price' => 20,
            'phone_number' => '1234567890',
            'availability_status' => 'available',
        ]);
    }
}
