<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile - Admin</title>
    @vite('resources/css/app.css')
  </head>
  <body class="bg-gray-950 text-gray-100 antialiased">

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Edit Profile</span>
          </h1>
          <p class="text-gray-400">Update your portfolio information</p>
          <a href="{{ route('portfolio.index') }}" class="inline-block mt-4 text-cyan-400 hover:text-cyan-300 transition-colors">
            ← Back to Portfolio
          </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
          <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-lg">
            {{ session('success') }}
          </div>
        @endif

        <!-- Edit Form -->
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-8">
          <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
              <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
              <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $profile->name ?? '') }}"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('name') border-red-500 @enderror"
                required
              >
              @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Title -->
            <div class="mb-6">
              <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Job Title</label>
              <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $profile->title ?? '') }}"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('title') border-red-500 @enderror"
                placeholder="e.g., Full Stack Developer"
                required
              >
              @error('title')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Bio -->
            <div class="mb-6">
              <label for="bio" class="block text-sm font-medium text-gray-300 mb-2">Bio (Hero Section)</label>
              <textarea
                id="bio"
                name="bio"
                rows="3"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 resize-none @error('bio') border-red-500 @enderror"
                required
              >{{ old('bio', $profile->bio ?? '') }}</textarea>
              @error('bio')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- About Description -->
            <div class="mb-6">
              <label for="about_description" class="block text-sm font-medium text-gray-300 mb-2">About Description</label>
              <textarea
                id="about_description"
                name="about_description"
                rows="5"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 resize-none @error('about_description') border-red-500 @enderror"
                required
              >{{ old('about_description', $profile->about_description ?? '') }}</textarea>
              @error('about_description')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
              <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $profile->email ?? '') }}"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('email') border-red-500 @enderror"
                placeholder="your.email@example.com"
              >
              @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Social Links Section -->
            <div class="mb-8 pt-6 border-t border-gray-800">
              <h3 class="text-xl font-semibold mb-4 text-cyan-400">Social Links</h3>
              <p class="text-sm text-gray-400 mb-6">Add your social media profiles (optional)</p>

              <div class="grid md:grid-cols-2 gap-6">
                <!-- GitHub -->
                <div>
                  <label for="github_url" class="block text-sm font-medium text-gray-300 mb-2">GitHub URL</label>
                  <input
                    type="url"
                    id="github_url"
                    name="github_url"
                    value="{{ old('github_url', $profile->github_url ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('github_url') border-red-500 @enderror"
                    placeholder="https://github.com/yourusername"
                  >
                  @error('github_url')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>

                <!-- LinkedIn -->
                <div>
                  <label for="linkedin_url" class="block text-sm font-medium text-gray-300 mb-2">LinkedIn URL</label>
                  <input
                    type="url"
                    id="linkedin_url"
                    name="linkedin_url"
                    value="{{ old('linkedin_url', $profile->linkedin_url ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('linkedin_url') border-red-500 @enderror"
                    placeholder="https://linkedin.com/in/yourusername"
                  >
                  @error('linkedin_url')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Twitter/X -->
                <div>
                  <label for="twitter_url" class="block text-sm font-medium text-gray-300 mb-2">Twitter/X URL</label>
                  <input
                    type="url"
                    id="twitter_url"
                    name="twitter_url"
                    value="{{ old('twitter_url', $profile->twitter_url ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('twitter_url') border-red-500 @enderror"
                    placeholder="https://twitter.com/yourusername"
                  >
                  @error('twitter_url')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>

                <!-- YouTube -->
                <div>
                  <label for="youtube_url" class="block text-sm font-medium text-gray-300 mb-2">YouTube URL</label>
                  <input
                    type="url"
                    id="youtube_url"
                    name="youtube_url"
                    value="{{ old('youtube_url', $profile->youtube_url ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('youtube_url') border-red-500 @enderror"
                    placeholder="https://youtube.com/@yourusername"
                  >
                  @error('youtube_url')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Website -->
                <div class="md:col-span-2">
                  <label for="website_url" class="block text-sm font-medium text-gray-300 mb-2">Website URL</label>
                  <input
                    type="url"
                    id="website_url"
                    name="website_url"
                    value="{{ old('website_url', $profile->website_url ?? '') }}"
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 @error('website_url') border-red-500 @enderror"
                    placeholder="https://yourwebsite.com"
                  >
                  @error('website_url')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Profile Image -->
            <div class="mb-6">
              <label for="profile_image" class="block text-sm font-medium text-gray-300 mb-2">Profile Image</label>

              @if($profile && $profile->profile_image)
                <div class="mb-4">
                  <img
                    src="{{ asset('storage/' . $profile->profile_image) }}"
                    alt="Current profile"
                    class="w-32 h-32 object-cover rounded-full border-2 border-cyan-500/50"
                  >
                  <p class="text-sm text-gray-400 mt-2">Current profile image</p>
                </div>
              @endif

              <input
                type="file"
                id="profile_image"
                name="profile_image"
                accept="image/jpeg,image/png,image/jpg,image/gif"
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 @error('profile_image') border-red-500 @enderror"
              >
              <p class="mt-2 text-sm text-gray-400">Maximum file size: 2MB. Formats: JPEG, PNG, JPG, GIF</p>
              @error('profile_image')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
              <button
                type="submit"
                class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1"
              >
                Update Profile
              </button>
              <a
                href="{{ route('portfolio.index') }}"
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
