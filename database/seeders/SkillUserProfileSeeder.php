<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillUserProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = DB::table('user_profiles')->pluck('id')->toArray();
        $skills   = DB::table('skills')->pluck('id')->toArray();

        $inserted = [];

        foreach ($profiles as $profileId) {
            $count          = rand(2, 5);
            $shuffled       = $skills;
            shuffle($shuffled);
            $selectedSkills = array_slice($shuffled, 0, $count);

            foreach ($selectedSkills as $skillId) {
                $key = $profileId . '-' . $skillId;
                if (isset($inserted[$key])) {
                    continue;
                }
                $inserted[$key] = true;

                DB::table('skill_user_profile')->insert([
                    'user_profile_id'   => $profileId,
                    'skill_id'          => $skillId,
                    'years_of_experience' => rand(1, 10),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
}
