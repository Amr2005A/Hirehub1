<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTagSeeder extends Seeder
{
    public function run(): void
    {
        $projects = DB::table('projects')->pluck('id')->toArray();
        $tags     = DB::table('tags')->pluck('id')->toArray();
        $inserted = [];

        foreach ($projects as $projectId) {
            $count          = rand(2, 5);
            $shuffled       = $tags;
            shuffle($shuffled);
            $selectedTags   = array_slice($shuffled, 0, $count);

            foreach ($selectedTags as $tagId) {
                $key = $projectId . '-' . $tagId;
                if (isset($inserted[$key])) {
                    continue;
                }
                $inserted[$key] = true;

                DB::table('project_tag')->insert([
                    'project_id' => $projectId,
                    'tag_id'     => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
