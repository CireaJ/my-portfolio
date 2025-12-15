<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Project - Admin</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold">
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Edit Project</span>
            </h1>
            <p class="mt-2 text-gray-400">Update project details</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $project->title) }}"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200"
                        required
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 resize-none"
                        required
                    >{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Existing Images -->
                @if($project->images->count() > 0)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Current Images (Drag to reorder)</label>
                        <div id="existing-images" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($project->images->sortBy('order') as $image)
                                <div class="relative group cursor-move image-item border border-gray-700 rounded-lg overflow-hidden hover:border-cyan-500 transition-colors" data-id="{{ $image->id }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                         class="w-full h-32 object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-70 flex items-center justify-center transition-all">
                                        <button
                                            type="button"
                                            onclick="deleteImage({{ $image->id }}, this)"
                                            class="opacity-0 group-hover:opacity-100 px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded transition-all">
                                            Delete
                                        </button>
                                    </div>
                                    <div class="absolute top-2 left-2 bg-cyan-500 text-white text-xs px-2 py-1 rounded flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 3h2v2H9V3zm0 4h2v2H9V7zm0 4h2v2H9v-2zm0 4h2v2H9v-2zm0 4h2v2H9v-2zm4-16h2v2h-2V3zm0 4h2v2h-2V7zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Add New Images -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Add More Images (Optional)</label>
                    <div class="border-2 border-dashed border-gray-700 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors bg-gray-800/50">
                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            accept="image/*"
                            multiple
                            class="hidden"
                        >
                        <label for="images" class="cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-300">Click to upload images or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 2MB each</p>
                        </label>
                    </div>
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- New Image Previews -->
                    <div id="image-previews" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
                </div>

                <!-- Demo URL -->
                <div class="mb-6">
                    <label for="demo_url" class="block text-sm font-medium text-gray-300 mb-2">Demo URL (Optional)</label>
                    <input
                        type="url"
                        name="demo_url"
                        id="demo_url"
                        value="{{ old('demo_url', $project->demo_url) }}"
                        placeholder="https://example.com"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200"
                    >
                    @error('demo_url')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Code URL -->
                <div class="mb-6">
                    <label for="code_url" class="block text-sm font-medium text-gray-300 mb-2">Code URL (Optional)</label>
                    <input
                        type="url"
                        name="code_url"
                        id="code_url"
                        value="{{ old('code_url', $project->code_url) }}"
                        placeholder="https://github.com/username/repo"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200"
                    >
                    @error('code_url')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button Visibility Options -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-3">Button Display Options</label>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer group">
                            <input
                                type="checkbox"
                                name="show_demo_button"
                                value="1"
                                {{ old('show_demo_button', $project->show_demo_button) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-900"
                            >
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Show "Live Demo" button</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input
                                type="checkbox"
                                name="show_code_button"
                                value="1"
                                {{ old('show_code_button', $project->show_code_button) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-900"
                            >
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Show "View Code" button</span>
                        </label>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Uncheck to hide buttons even if URLs are provided</p>
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Tags (Optional)</label>
                    @if($tags->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <label class="inline-flex items-center cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="tags[]"
                                        value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $project->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="hidden peer"
                                    >
                                    <span class="px-3 py-1 rounded-full text-sm font-medium text-white opacity-50 peer-checked:opacity-100 peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-900 transition-all" style="background-color: {{ $tag->color }}">
                                        {{ $tag->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Click tags to select/deselect</p>
                    @else
                        <p class="text-sm text-gray-400">No tags available. <a href="{{ route('admin.tags.create') }}" class="text-cyan-400 hover:text-cyan-300">Create tags first</a></p>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-6 border-t border-gray-800">
                    <button type="submit" class="flex-1 px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1">
                        Update Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 rounded-lg font-medium transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview for new uploads
        const imageInput = document.getElementById('images');
        const imagePreviewsContainer = document.getElementById('image-previews');

        imageInput.addEventListener('change', function(e) {
            imagePreviewsContainer.innerHTML = '';
            const files = Array.from(e.target.files);

            if (files.length > 0) {
                imagePreviewsContainer.classList.remove('hidden');

                files.forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'relative group';
                        preview.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                <span class="text-white text-xs">New Image ${index + 1}</span>
                            </div>
                        `;
                        imagePreviewsContainer.appendChild(preview);
                    };

                    reader.readAsDataURL(file);
                });
            } else {
                imagePreviewsContainer.classList.add('hidden');
            }
        });

        // Delete image function
        function deleteImage(imageId, button) {
            if (!confirm('Are you sure you want to delete this image?')) {
                return;
            }

            fetch(`/admin/projects/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.closest('.image-item').remove();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Sortable for existing images
        const existingImages = document.getElementById('existing-images');
        if (existingImages) {
            const sortable = new Sortable(existingImages, {
                animation: 150,
                handle: '.image-item',
                onEnd: function(evt) {
                    const items = existingImages.querySelectorAll('.image-item');
                    const orders = Array.from(items).map((item, index) => ({
                        id: item.dataset.id,
                        order: index + 1
                    }));

                    fetch(`/admin/projects/{{ $project->id }}/images/reorder`, {
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
                            console.log('Image order updated');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    </script>
</body>
</html>
