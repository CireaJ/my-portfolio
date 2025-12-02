<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'React', 'color' => '#61DAFB'],
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'MySQL', 'color' => '#4479A1'],
            ['name' => 'Node.js', 'color' => '#339933'],
            ['name' => 'MongoDB', 'color' => '#47A248'],
            ['name' => 'Bootstrap', 'color' => '#7952B3'],
            ['name' => 'API', 'color' => '#0EA5E9'],
            ['name' => 'UI/UX', 'color' => '#EC4899'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}

