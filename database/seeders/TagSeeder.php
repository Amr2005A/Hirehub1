<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'PHP',
            'Laravel',
            'JavaScript',
            'Vue.js',
            'React',
            'Node.js',
            'Python',
            'Django',
            'Flutter',
            'Swift',
            'Kotlin',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Redis',
            'Docker',
            'AWS',
            'Figma',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'WordPress',
            'Shopify',
            'SEO',
            'UI/UX',
            'REST API',
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name'       => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
