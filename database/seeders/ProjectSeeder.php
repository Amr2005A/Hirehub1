<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'user_id' => 1,
            'title' => 'E-commerce Website',
            'description' => 'Developed a full-featured e-commerce website using Laravel and Vue.js.',
            'budget_type' => 'fixed',
            'hourly_price' => 0,
            'fixed_price' => 5000,
            'date' => '2022-01-01',
        ]);
    }
}
