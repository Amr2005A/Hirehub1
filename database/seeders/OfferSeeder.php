<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::create([
            'project_id' => 1,
            'creator_by' => 1,
            'suggested_price' => 4500,
            'description' => 'I can complete this project within the specified budget and timeline.',
            'count_of_days' => 45,
        ]);
    }
}
