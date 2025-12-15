<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['images', 'tags'])->orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.projects.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'demo_url' => 'nullable|url',
            'code_url' => 'nullable|url',
            'show_demo_button' => 'boolean',
            'show_code_button' => 'boolean',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Get the highest order and add 1
        $maxOrder = Project::max('order') ?? 0;

        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'demo_url' => $validated['demo_url'] ?? null,
            'code_url' => $validated['code_url'] ?? null,
            'show_demo_button' => $request->has('show_demo_button'),
            'show_code_button' => $request->has('show_code_button'),
            'order' => $maxOrder + 1,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create([
                    'image_path' => $path,
                    'order' => $index + 1
                ]);
            }
        }

        // Attach tags
        if (isset($validated['tags'])) {
            $project->tags()->attach($validated['tags']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $tags = Tag::all();
        $project->load(['images', 'tags']);
        return view('admin.projects.edit', compact('project', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'demo_url' => 'nullable|url',
            'code_url' => 'nullable|url',
            'show_demo_button' => 'boolean',
            'show_code_button' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'demo_url' => $validated['demo_url'] ?? null,
            'code_url' => $validated['code_url'] ?? null,
            'show_demo_button' => $request->has('show_demo_button'),
            'show_code_button' => $request->has('show_code_button'),
        ]);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentMaxOrder = $project->images()->max('order') ?? 0;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create([
                    'image_path' => $path,
                    'order' => $currentMaxOrder + $index + 1
                ]);
            }
        }

        // Sync tags
        if (isset($validated['tags'])) {
            $project->tags()->sync($validated['tags']);
        } else {
            $project->tags()->detach();
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete all associated images from storage
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    /**
     * Delete a single project image
     */
    public function deleteImage($imageId)
    {
        $image = \App\Models\ProjectImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Reorder projects
     */
    public function reorder(Request $request)
    {
        $orders = $request->input('orders');

        foreach ($orders as $item) {
            Project::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Reorder project images
     */
    public function reorderImages(Request $request, Project $project)
    {
        $orders = $request->input('orders');

        foreach ($orders as $item) {
            $project->images()->where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
