<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\TechStack;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $techStacks = TechStack::orderBy('order')->get();
        $projects = Project::with(['images' => function($query) {
            $query->orderBy('order');
        }, 'tags'])->orderBy('order')->get();

        return view('app', compact('profile', 'techStacks', 'projects'));
    }
}

