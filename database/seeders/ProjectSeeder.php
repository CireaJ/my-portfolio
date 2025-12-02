<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Project 1
        $project1 = Project::create([
            'title' => 'E-Commerce Platform',
            'description' => 'A full-featured e-commerce platform built with Laravel and Vue.js. Features include product management, shopping cart, payment integration, and order tracking.',
            'demo_url' => 'https://example.com/demo1',
            'code_url' => 'https://github.com/username/ecommerce',
            'order' => 1,
        ]);
        $project1->tags()->attach(Tag::whereIn('name', ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL'])->pluck('id'));

        // Sample Project 2
        $project2 = Project::create([
            'title' => 'Task Management App',
            'description' => 'A collaborative task management application with real-time updates. Built using React and Node.js with MongoDB for data persistence.',
            'demo_url' => 'https://example.com/demo2',
            'code_url' => 'https://github.com/username/taskapp',
            'order' => 2,
        ]);
        $project2->tags()->attach(Tag::whereIn('name', ['React', 'Node.js', 'MongoDB', 'API'])->pluck('id'));

        // Sample Project 3
        $project3 = Project::create([
            'title' => 'Portfolio Website',
            'description' => 'A modern, responsive portfolio website with beautiful animations and smooth scrolling. Showcases projects, skills, and contact information.',
            'demo_url' => null,
            'code_url' => 'https://github.com/username/portfolio',
            'order' => 3,
        ]);
        $project3->tags()->attach(Tag::whereIn('name', ['HTML', 'JavaScript', 'Tailwind CSS', 'UI/UX'])->pluck('id'));

        // Note: You'll need to manually add images through the admin panel
        // or create placeholder images in storage/app/public/projects/
    }
}

