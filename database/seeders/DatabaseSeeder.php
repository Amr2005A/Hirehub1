<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            SkillSeeder::class,
            UserProfileSeeder::class,
            SkillUserProfileSeeder::class,
            ProjectSeeder::class,
            TagSeeder::class,
            ProjectTagSeeder::class,
            OfferSeeder::class

        ]);

    }
}
