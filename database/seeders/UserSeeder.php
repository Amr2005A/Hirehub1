<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Amr Mohissen',
            'email' => 'amrmohissen.b@gmail.com',
            'password' => bcrypt('12345678'),
            'city_id' => 1,
            'role_id' => 1,
        ]);
    }
}
