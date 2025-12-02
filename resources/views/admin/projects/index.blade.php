<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Projects - Admin</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-4xl md:text-5xl font-bold">
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Manage Projects</span>
                </h1>
                <a href="{{ route('portfolio.index') }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 rounded-lg transition-colors">
                    ← Portfolio
                </a>
            </div>
            <p class="text-gray-400">Create and manage your portfolio projects (drag to reorder)</p>

            <div class="mt-6">
                <a href="{{ route('admin.projects.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1">
                    + New Project
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-cyan-500/10 border border-cyan-500/50 text-cyan-400 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Projects Grid -->
        @if($projects->count() > 0)
            <div id="projects-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="project-item group bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 cursor-move" data-id="{{ $project->id }}">
                        <!-- Image Preview -->
                        <div class="aspect-video bg-gray-800 relative overflow-hidden">
                            @if($project->images->first())
                                <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @if($project->images->count() > 1)
                                    <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-sm text-cyan-400 text-xs px-2 py-1 rounded-full flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $project->images->count() }}
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-cyan-400 transition-colors">{{ $project->title }}</h3>
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>

                            <!-- Tags -->
                            @if($project->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($project->tags as $tag)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium"
                                              style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Links -->
                            @if($project->demo_url || $project->code_url)
                                <div class="flex gap-2 mb-4 text-xs">
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" class="text-cyan-400 hover:text-cyan-300 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Demo
                                        </a>
                                    @endif
                                    @if($project->code_url)
                                        <a href="{{ $project->code_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                            </svg>
                                            Code
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex gap-2 pt-4 border-t border-gray-800">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="flex-1 px-4 py-2 bg-cyan-500/10 text-cyan-400 text-center rounded-lg hover:bg-cyan-500/20 transition-colors text-sm font-medium border border-cyan-500/30">
                                    Edit
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure? This will delete all images.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors text-sm font-medium border border-red-500/30">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Drag Handle -->
                        <div class="px-6 py-2 bg-gray-800/50 border-t border-gray-800 text-center text-xs text-gray-500 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 3h2v2H9V3zm0 4h2v2H9V7zm0 4h2v2H9v-2zm0 4h2v2H9v-2zm0 4h2v2H9v-2zm4-16h2v2h-2V3zm0 4h2v2h-2V7zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                            </svg>
                            Drag to reorder
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-900 border border-gray-800 rounded-xl shadow p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-lg font-medium mb-2">No projects yet</h3>
                <p class="text-gray-400 mb-6">Get started by creating your first project</p>
                <a href="{{ route('admin.projects.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1">
                    Create Project
                </a>
            </div>
        @endif

        <!-- Quick Links -->
        <div class="mt-8 flex gap-4 text-sm">
            <a href="{{ route('admin.tags.index') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">→ Manage Tags</a>
            <a href="{{ route('admin.tech-stack.index') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">→ Manage Tech Stack</a>
            <a href="{{ route('admin.profile.edit') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">→ Edit Profile</a>
        </div>
    </div>

    <script>
        const projectsList = document.getElementById('projects-list');

        if (projectsList) {
            const sortable = new Sortable(projectsList, {
                animation: 150,
                handle: '.project-item',
                onEnd: function(evt) {
                    const items = projectsList.querySelectorAll('.project-item');
                    const orders = Array.from(items).map((item, index) => ({
                        id: item.dataset.id,
                        order: index + 1
                    }));

                    fetch('{{ route('admin.projects.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ orders })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Order updated successfully');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    </script>
</body>
</html>
