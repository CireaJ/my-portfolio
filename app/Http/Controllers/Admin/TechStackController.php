<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techStacks = TechStack::orderBy('order')->get();
        return view('admin.tech-stack.index', compact('techStacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tech-stack.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon_url' => 'required|url|max:500',
            'order' => 'nullable|integer|min:0',
        ]);

        TechStack::create($validated);

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stack.edit', compact('techStack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TechStack $techStack)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon_url' => 'required|url|max:500',
            'order' => 'nullable|integer|min:0',
        ]);

        $techStack->update($validated);

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TechStack $techStack)
    {
        $techStack->delete();

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack deleted successfully!');
    }

    /**
     * Reorder tech stacks via drag and drop.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:tech_stacks,id',
            'order.*.order' => 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            TechStack::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
