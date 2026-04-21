<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProfile;
use App\Models\Skill;



class SkillUserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run()
{
    $profiles = UserProfile::all();
    $skills = Skill::all();

    foreach ($profiles as $profile) {

        $randomSkills = $skills->random(3);

        foreach ($randomSkills as $skill) {
            $profile->skills()->attach($skill->id, [
                'years_of_experience' => rand(1, 5)
            ]);
        }
    }
}
}
