<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'name' => 'Your Name',
            'title' => 'Full Stack Developer',
            'bio' => 'I craft beautiful, responsive web experiences with modern technologies. Passionate about clean code and innovative solutions.',
            'about_description' => "I'm a passionate developer with expertise in building modern web applications. With a strong foundation in both frontend and backend technologies, I love turning ideas into reality through code. My journey in web development has equipped me with a diverse skill set and a problem-solving mindset. I'm always eager to learn new technologies and take on challenging projects.",
            'email' => 'Charles.Jaeric@gmail.com',
            'github_url' => 'https://github.com/yourusername',
            'linkedin_url' => 'https://linkedin.com/in/yourusername',
            'twitter_url' => 'https://twitter.com/yourusername',
            'youtube_url' => 'https://youtube.com/@yourusername',
            'website_url' => 'https://yourwebsite.com',
        ]);
    }
}
