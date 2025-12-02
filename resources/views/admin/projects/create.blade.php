<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold">
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Create New Project</span>
            </h1>
            <p class="mt-2 text-gray-400">Add a new project to your portfolio</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
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
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Images Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Images * (Multiple)</label>
                    <div class="border-2 border-dashed border-gray-700 rounded-lg p-6 text-center hover:border-cyan-500 transition-colors bg-gray-800/50">
                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            accept="image/*"
                            multiple
                            class="hidden"
                            required
                        >
                        <label for="images" class="cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-300">Click to upload images or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 2MB each</p>
                        </label>
                    </div>
                    @error('images')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- Image Previews -->
                    <div id="image-previews" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
                </div>

                <!-- Demo URL -->
                <div class="mb-6">
                    <label for="demo_url" class="block text-sm font-medium text-gray-300 mb-2">Demo URL (Optional)</label>
                    <input
                        type="url"
                        name="demo_url"
                        id="demo_url"
                        value="{{ old('demo_url') }}"
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
                        value="{{ old('code_url') }}"
                        placeholder="https://github.com/username/repo"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200"
                    >
                    @error('code_url')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
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
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
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
                        Create Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 rounded-lg font-medium transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
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
                                <span class="text-white text-xs">Image ${index + 1}</span>
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
    </script>
</body>
</html>
