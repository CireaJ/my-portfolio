<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Tech Stack - Admin</title>
    @vite('resources/css/app.css')
  </head>
  <body class="bg-gray-950 text-gray-100 antialiased">

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Add Tech Stack</span>
          </h1>
          <p class="text-gray-400">Add a new technology to your stack</p>
          <a href="{{ route('admin.tech-stack.index') }}" class="inline-block mt-4 text-cyan-400 hover:text-cyan-300 transition-colors">
            ← Back to Tech Stack List
          </a>
        </div>

        <!-- Form -->
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-8">
          <form action="{{ route('admin.tech-stack.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-6">
              <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Technology Name</label>
              <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('name') border-red-500 @enderror"
                placeholder="e.g., Laravel, React, Vue.js"
                required
              >
              @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Icon URL -->
            <div class="mb-6">
              <label for="icon_url" class="block text-sm font-medium text-gray-300 mb-2">Icon URL</label>

              <!-- Icon Preview -->
              <div id="icon-preview" class="mb-4 hidden">
                <div class="flex items-center gap-4 p-4 bg-gray-800 rounded-lg border border-gray-700">
                  <img id="preview-image" src="" alt="Icon preview" class="w-16 h-16 object-contain" onerror="this.parentElement.parentElement.classList.add('hidden')">
                  <span class="text-sm text-gray-400">Preview</span>
                </div>
              </div>

              <input
                type="url"
                id="icon_url"
                name="icon_url"
                value="{{ old('icon_url') }}"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('icon_url') border-red-500 @enderror"
                placeholder="Paste icon URL or use icon picker below"
                required
              >

              <!-- Quick Icon Picker -->
              <div class="mt-4 p-4 bg-gray-800/50 rounded-lg border border-gray-700">
                <p class="text-sm font-medium text-gray-300 mb-3">Quick Pick Popular Icons:</p>
                <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-3">
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Laravel" data-icon="https://cdn.simpleicons.org/laravel/FF2D20" title="Laravel">
                    <img src="https://cdn.simpleicons.org/laravel/FF2D20" alt="Laravel" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="React" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" title="React">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Vue.js" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" title="Vue.js">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue.js" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Angular" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg" title="Angular">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg" alt="Angular" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Node.js" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" title="Node.js">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Python" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" title="Python">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="Python" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="PHP" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" title="PHP">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="JavaScript" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" title="JavaScript">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="TypeScript" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" title="TypeScript">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="TypeScript" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Tailwind CSS" data-icon="https://cdn.simpleicons.org/tailwindcss/06B6D4" title="Tailwind CSS">
                    <img src="https://cdn.simpleicons.org/tailwindcss/06B6D4" alt="Tailwind CSS" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Bootstrap" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" title="Bootstrap">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="MySQL" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" title="MySQL">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="PostgreSQL" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" title="PostgreSQL">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" alt="PostgreSQL" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="MongoDB" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg" title="MongoDB">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg" alt="MongoDB" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Docker" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" title="Docker">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" alt="Docker" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Git" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" title="Git">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="GitHub" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" title="GitHub">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="GitHub" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Figma" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg" title="Figma">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg" alt="Figma" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="AWS" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" title="AWS">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" alt="AWS" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Redis" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg" title="Redis">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg" alt="Redis" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Sass" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sass/sass-original.svg" title="Sass">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sass/sass-original.svg" alt="Sass" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Webpack" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/webpack/webpack-original.svg" title="Webpack">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/webpack/webpack-original.svg" alt="Webpack" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Vite" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vitejs/vitejs-original.svg" title="Vite">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vitejs/vitejs-original.svg" alt="Vite" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                  <button type="button" class="icon-option p-3 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 hover:border-cyan-500 transition-all" data-name="Next.js" data-icon="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" title="Next.js">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" alt="Next.js" class="w-full h-10 object-contain" onerror="this.parentElement.style.display='none'">
                  </button>
                </div>
                <p class="mt-3 text-xs text-gray-500">Click an icon to auto-fill. Or find more at <a href="https://devicon.dev/" target="_blank" class="text-cyan-400 hover:text-cyan-300">devicon.dev</a> or <a href="https://simpleicons.org/" target="_blank" class="text-cyan-400 hover:text-cyan-300">simpleicons.org</a></p>
              </div>

              @error('icon_url')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <script>
              // Icon picker functionality
              document.querySelectorAll('.icon-option').forEach(button => {
                button.addEventListener('click', function(e) {
                  e.preventDefault();
                  const iconUrl = this.dataset.icon;
                  const name = this.dataset.name;

                  // Fill the input
                  document.getElementById('icon_url').value = iconUrl;

                  // Fill name if empty
                  const nameInput = document.getElementById('name');
                  if (!nameInput.value) {
                    nameInput.value = name;
                  }

                  // Show preview
                  showPreview(iconUrl);

                  // Visual feedback
                  document.querySelectorAll('.icon-option').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-cyan-500');
                  });
                  this.classList.add('ring-2', 'ring-cyan-500');
                });
              });

              // Preview on input
              document.getElementById('icon_url').addEventListener('input', function() {
                showPreview(this.value);
              });

              function showPreview(url) {
                if (url) {
                  const preview = document.getElementById('icon-preview');
                  const previewImg = document.getElementById('preview-image');
                  previewImg.src = url;
                  preview.classList.remove('hidden');
                }
              }

              // Show preview on load if value exists
              const existingUrl = document.getElementById('icon_url').value;
              if (existingUrl) {
                showPreview(existingUrl);
              }
            </script>

            <!-- Order -->
            <div class="mb-6">
              <label for="order" class="block text-sm font-medium text-gray-300 mb-2">Display Order</label>
              <input
                type="number"
                id="order"
                name="order"
                value="{{ old('order', 0) }}"
                min="0"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('order') border-red-500 @enderror"
                placeholder="0"
              >
              <p class="mt-2 text-sm text-gray-400">Lower numbers appear first</p>
              @error('order')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
              <button
                type="submit"
                class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1"
              >
                Add Tech Stack
              </button>
              <a
                href="{{ route('admin.tech-stack.index') }}"
                class="px-8 py-3 border-2 border-gray-700 rounded-lg font-semibold hover:bg-gray-800 transition-all duration-300 text-center"
              >
                Cancel
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
