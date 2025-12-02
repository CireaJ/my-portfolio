<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techStacks = [
            ['name' => 'Laravel', 'icon_url' => 'https://cdn.simpleicons.org/laravel/FF2D20', 'order' => 1],
            ['name' => 'React', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg', 'order' => 2],
            ['name' => 'Vue.js', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'order' => 3],
            ['name' => 'Tailwind CSS', 'icon_url' => 'https://cdn.simpleicons.org/tailwindcss/06B6D4', 'order' => 4],
            ['name' => 'JavaScript', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'order' => 5],
            ['name' => 'PHP', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'order' => 6],
            ['name' => 'MySQL', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'order' => 7],
            ['name' => 'Git', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg', 'order' => 8],
        ];

        foreach ($techStacks as $stack) {
            TechStack::create($stack);
        }
    }
}
