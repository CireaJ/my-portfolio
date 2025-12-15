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
            // Backend Languages
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'Python', 'color' => '#3776AB'],
            ['name' => 'Java', 'color' => '#007396'],
            ['name' => 'C#', 'color' => '#239120'],
            ['name' => 'Ruby', 'color' => '#CC342D'],
            ['name' => 'Go', 'color' => '#00ADD8'],
            ['name' => 'Rust', 'color' => '#000000'],

            // Frontend Languages
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'TypeScript', 'color' => '#3178C6'],
            ['name' => 'HTML', 'color' => '#E34F26'],
            ['name' => 'CSS', 'color' => '#1572B6'],

            // Backend Frameworks
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'Django', 'color' => '#092E20'],
            ['name' => 'Flask', 'color' => '#000000'],
            ['name' => 'Spring Boot', 'color' => '#6DB33F'],
            ['name' => 'Express.js', 'color' => '#000000'],
            ['name' => 'Node.js', 'color' => '#339933'],
            ['name' => 'ASP.NET', 'color' => '#512BD4'],
            ['name' => 'Ruby on Rails', 'color' => '#CC0000'],

            // Frontend Frameworks
            ['name' => 'React', 'color' => '#61DAFB'],
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'Angular', 'color' => '#DD0031'],
            ['name' => 'Next.js', 'color' => '#000000'],
            ['name' => 'Nuxt.js', 'color' => '#00DC82'],
            ['name' => 'Svelte', 'color' => '#FF3E00'],

            // Mobile Development
            ['name' => 'Flutter', 'color' => '#02569B'],
            ['name' => 'React Native', 'color' => '#61DAFB'],
            ['name' => 'Swift', 'color' => '#FA7343'],
            ['name' => 'Kotlin', 'color' => '#7F52FF'],
            ['name' => 'Android', 'color' => '#3DDC84'],
            ['name' => 'iOS', 'color' => '#000000'],
            ['name' => 'Ionic', 'color' => '#3880FF'],
            ['name' => 'Xamarin', 'color' => '#3498DB'],

            // CSS Frameworks
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'Bootstrap', 'color' => '#7952B3'],
            ['name' => 'Material UI', 'color' => '#007FFF'],
            ['name' => 'Sass', 'color' => '#CC6699'],

            // Databases
            ['name' => 'MySQL', 'color' => '#4479A1'],
            ['name' => 'PostgreSQL', 'color' => '#336791'],
            ['name' => 'MongoDB', 'color' => '#47A248'],
            ['name' => 'SQLite', 'color' => '#003B57'],
            ['name' => 'Redis', 'color' => '#DC382D'],
            ['name' => 'Firebase', 'color' => '#FFCA28'],

            // Cloud & DevOps
            ['name' => 'AWS', 'color' => '#FF9900'],
            ['name' => 'Azure', 'color' => '#0089D6'],
            ['name' => 'Docker', 'color' => '#2496ED'],
            ['name' => 'Kubernetes', 'color' => '#326CE5'],
            ['name' => 'Git', 'color' => '#F05032'],

            // Tools & Others
            ['name' => 'API', 'color' => '#0EA5E9'],
            ['name' => 'REST API', 'color' => '#009688'],
            ['name' => 'GraphQL', 'color' => '#E10098'],
            ['name' => 'UI/UX', 'color' => '#EC4899'],
            ['name' => 'WordPress', 'color' => '#21759B'],
            ['name' => 'Figma', 'color' => '#F24E1E'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['name' => $tag['name']], // Check if exists by name
                ['color' => $tag['color']] // Create with color if not exists
            );
        }
    }
}

