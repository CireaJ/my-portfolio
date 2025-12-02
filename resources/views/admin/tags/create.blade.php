<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tag - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Tag</h1>
            <p class="mt-2 text-sm text-gray-600">Add a new tag for your projects</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf

                <!-- Tag Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tag Name *</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color Picker -->
                <div class="mb-6">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Tag Color *</label>
                    <div class="flex items-center gap-4">
                        <input
                            type="color"
                            name="color"
                            id="color"
                            value="{{ old('color', '#3b82f6') }}"
                            class="h-12 w-24 border border-gray-300 rounded cursor-pointer"
                            required
                        >
                        <input
                            type="text"
                            id="color-hex"
                            value="{{ old('color', '#3b82f6') }}"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 font-mono text-sm"
                            readonly
                        >
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Choose a color for the tag badge</p>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Color Presets -->
                    <div class="mt-4">
                        <p class="text-xs font-medium text-gray-700 mb-2">Quick Colors:</p>
                        <div class="flex gap-2 flex-wrap">
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #ef4444" onclick="setColor('#ef4444')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #f97316" onclick="setColor('#f97316')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #f59e0b" onclick="setColor('#f59e0b')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #eab308" onclick="setColor('#eab308')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #84cc16" onclick="setColor('#84cc16')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #22c55e" onclick="setColor('#22c55e')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #10b981" onclick="setColor('#10b981')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #14b8a6" onclick="setColor('#14b8a6')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #06b6d4" onclick="setColor('#06b6d4')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #0ea5e9" onclick="setColor('#0ea5e9')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #3b82f6" onclick="setColor('#3b82f6')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #6366f1" onclick="setColor('#6366f1')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #8b5cf6" onclick="setColor('#8b5cf6')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #a855f7" onclick="setColor('#a855f7')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #d946ef" onclick="setColor('#d946ef')"></button>
                            <button type="button" class="w-10 h-10 rounded border-2 border-gray-300 hover:border-gray-500" style="background-color: #ec4899" onclick="setColor('#ec4899')"></button>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-xs font-medium text-gray-700 mb-2">Preview:</p>
                        <span id="tag-preview" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white" style="background-color: #3b82f6">
                            <span id="preview-name">Sample Tag</span>
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        Create Tag
                    </button>
                    <a href="{{ route('admin.tags.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const colorInput = document.getElementById('color');
        const colorHex = document.getElementById('color-hex');
        const tagPreview = document.getElementById('tag-preview');
        const nameInput = document.getElementById('name');
        const previewName = document.getElementById('preview-name');

        function setColor(color) {
            colorInput.value = color;
            colorHex.value = color;
            tagPreview.style.backgroundColor = color;
        }

        colorInput.addEventListener('input', function() {
            colorHex.value = this.value;
            tagPreview.style.backgroundColor = this.value;
        });

        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || 'Sample Tag';
        });
    </script>
</body>
</html>
