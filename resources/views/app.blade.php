<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Portfolio - Web Developer & Designer</title>
    @vite('resources/css/app.css')
  </head>
  <body class="bg-gray-950 text-gray-100 antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full bg-gray-900/80 backdrop-blur-md z-50 border-b border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex-shrink-0">
            <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Portfolio</span>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-8">
              <a href="#home" class="text-gray-300 hover:text-cyan-400 transition-colors px-3 py-2 text-sm font-medium">Home</a>
              <a href="#about" class="text-gray-300 hover:text-cyan-400 transition-colors px-3 py-2 text-sm font-medium">About</a>
              <a href="#stack" class="text-gray-300 hover:text-cyan-400 transition-colors px-3 py-2 text-sm font-medium">Tech Stack</a>
              <a href="#projects" class="text-gray-300 hover:text-cyan-400 transition-colors px-3 py-2 text-sm font-medium">Projects</a>
              <a href="#contact" class="text-gray-300 hover:text-cyan-400 transition-colors px-3 py-2 text-sm font-medium">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 min-h-screen flex items-center">
      <div class="max-w-7xl mx-auto w-full">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <!-- Text Content -->
          <div class="space-y-6">
            <div class="space-y-2">
              <p class="text-cyan-400 text-lg font-medium">Hi, I'm</p>
              <h1 class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">
                {{ $profile->name ?? 'Your Name' }}
              </h1>
              <p class="text-2xl md:text-3xl text-gray-400 font-light">{{ $profile->title ?? 'Full Stack Developer' }}</p>
            </div>
            <p class="text-gray-400 text-lg leading-relaxed">
              {{ $profile->bio ?? 'I craft beautiful, responsive web experiences with modern technologies. Passionate about clean code and innovative solutions.' }}
            </p>
            <div class="flex gap-4 pt-4">
              <a href="#projects" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1">
                View Projects
              </a>
              <a href="#contact" class="px-8 py-3 border-2 border-cyan-500 rounded-lg font-semibold hover:bg-cyan-500/10 transition-all duration-300">
                Get in Touch
              </a>
            </div>
          </div>

          <!-- Profile Image -->
          <div class="flex justify-center">
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full blur-2xl opacity-50 animate-pulse"></div>
              <div class="relative w-72 h-72 md:w-96 md:h-96">
                <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : '/images/profile.jpg' }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full border-4 border-cyan-500/50 shadow-2xl shadow-cyan-500/30">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-900/50">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-12">
          <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">About Me</span>
        </h2>
        <div class="max-w-3xl mx-auto text-center">
          <p class="text-gray-400 text-lg leading-relaxed">
            {{ $profile->about_description ?? "I'm a passionate developer with expertise in building modern web applications. With a strong foundation in both frontend and backend technologies, I love turning ideas into reality through code. My journey in web development has equipped me with a diverse skill set and a problem-solving mindset. I'm always eager to learn new technologies and take on challenging projects." }}
          </p>
        </div>
      </div>
    </section>

    <!-- Tech Stack Section -->
    <section id="stack" class="py-20 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-4">
          <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Tech Stack</span>
        </h2>
        <p class="text-gray-400 text-center mb-12">Technologies I work with</p>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          @forelse($techStacks as $stack)
            <div class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex flex-col items-center space-y-3">
                <div class="w-16 h-16 flex items-center justify-center">
                  <img src="{{ $stack->icon_url }}" alt="{{ $stack->name }}" class="w-full h-full object-contain">
                </div>
                <span class="text-gray-300 font-medium group-hover:text-cyan-400 transition-colors">{{ $stack->name }}</span>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12">
              <p class="text-gray-400 text-lg">No tech stacks added yet.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-900/50">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-4">
          <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Recent Projects</span>
        </h2>
        <p class="text-gray-400 text-center mb-12">Some of my recent work and creations</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          @forelse($projects as $project)
            <div class="group bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <!-- Project Image -->
              <div class="relative h-48 bg-gradient-to-br from-cyan-500 to-blue-600 overflow-hidden cursor-pointer"
                   onclick="openLightbox({{ $project->id }}, 0)">
                @if($project->images->first())
                  <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                       alt="{{ $project->title }}"
                       class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                  <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent opacity-60"></div>

                  @if($project->images->count() > 1)
                    <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                      {{ $project->images->count() }}
                    </div>
                  @endif
                @else
                  <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                @endif
              </div>

              <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-cyan-400 transition-colors">{{ $project->title }}</h3>
                <p class="text-gray-400 mb-4 text-sm line-clamp-3">{{ $project->description }}</p>

                <!-- Tags -->
                @if($project->tags->count() > 0)
                  <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($project->tags as $tag)
                      <span class="px-3 py-1 rounded-full text-xs font-medium text-white"
                            style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                        {{ $tag->name }}
                      </span>
                    @endforeach
                  </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex gap-3">
                  @if($project->demo_url)
                    <a href="{{ $project->demo_url }}"
                       target="_blank"
                       class="flex-1 text-center px-4 py-2 bg-cyan-500/10 text-cyan-400 rounded-lg hover:bg-cyan-500/20 transition-colors text-sm font-medium">
                      Live Demo
                    </a>
                  @endif

                  @if($project->code_url)
                    <a href="{{ $project->code_url }}"
                       target="_blank"
                       class="flex-1 text-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                      View Code
                    </a>
                  @endif

                  @if(!$project->demo_url && !$project->code_url)
                    <button onclick="openLightbox({{ $project->id }}, 0)"
                            class="w-full text-center px-4 py-2 bg-cyan-500/10 text-cyan-400 rounded-lg hover:bg-cyan-500/20 transition-colors text-sm font-medium">
                      View Images
                    </button>
                  @endif
                </div>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12">
              <p class="text-gray-400 text-lg">No projects added yet.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Links & Contact Section -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-4">
          <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Let's Connect</span>
        </h2>
        <p class="text-gray-400 text-center mb-12">Find me on the web</p>

        <div class="max-w-4xl mx-auto">
          <!-- Social Links -->
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @if($profile->github_url)
            <!-- GitHub -->
            <a href="{{ $profile->github_url }}" target="_blank" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">GitHub</h3>
                  <p class="text-sm text-gray-500">View Projects</p>
                </div>
              </div>
            </a>
            @endif

            @if($profile->linkedin_url)
            <!-- LinkedIn -->
            <a href="{{ $profile->linkedin_url }}" target="_blank" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">LinkedIn</h3>
                  <p class="text-sm text-gray-500">Connect</p>
                </div>
              </div>
            </a>
            @endif

            @if($profile->website_url)
            <!-- Portfolio Website -->
            <a href="{{ $profile->website_url }}" target="_blank" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">Website</h3>
                  <p class="text-sm text-gray-500">Visit</p>
                </div>
              </div>
            </a>
            @endif

            <!-- Email -->
            <a href="mailto:{{ $profile->email }}" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">Email</h3>
                  <p class="text-sm text-gray-500 truncate">{{ $profile->email }}</p>
                </div>
              </div>
            </a>

            @if($profile->twitter_url)
            <!-- Twitter/X -->
            <a href="{{ $profile->twitter_url }}" target="_blank" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">Twitter/X</h3>
                  <p class="text-sm text-gray-500">Follow</p>
                </div>
              </div>
            </a>
            @endif

            @if($profile->youtube_url)
            <!-- YouTube -->
            <a href="{{ $profile->youtube_url }}" target="_blank" class="group bg-gray-900 p-6 rounded-xl border border-gray-800 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 hover:-translate-y-2">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">YouTube</h3>
                  <p class="text-sm text-gray-500">Subscribe</p>
                </div>
              </div>
            </a>
            @endif
          </div>

          <!-- Contact Form -->
          <div class="bg-gray-900 p-8 rounded-xl border border-gray-800">
            <h3 class="text-2xl font-bold mb-6 text-center">Send me a message</h3>
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-lg text-green-400">
              {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-lg">
              <ul class="list-disc list-inside text-red-400">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
              @csrf
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                  <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200" placeholder="Your name">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200" placeholder="your.email@example.com">
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Message</label>
                <textarea name="message" rows="4" required class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-cyan-500 transition-colors text-gray-200 resize-none" placeholder="Your message here...">{{ old('message') }}</textarea>
              </div>
              <button type="submit" class="w-full px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 transform hover:-translate-y-1">
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 py-8 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto text-center">
        <p class="text-gray-400">
          &copy; 2025 Charles Jaeric. Built with <span class="text-red-500">❤</span> using Laravel & Tailwind CSS
        </p>
      </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 z-50 transform translate-x-[500px] transition-transform duration-500 ease-out">
      <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 min-w-[320px]">
        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
          <p class="font-semibold">Message Sent Successfully!</p>
          <p class="text-sm text-green-100">I'll get back to you soon.</p>
        </div>
      </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
      <div class="relative max-w-7xl w-full h-full flex items-center justify-center">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-4 right-4 z-50 w-12 h-12 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>

        <!-- Previous Button -->
        <button onclick="previousImage()" class="absolute left-4 z-50 w-12 h-12 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>

        <!-- Image Container -->
        <div class="relative max-w-5xl max-h-[80vh] flex items-center justify-center">
          <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">

          <!-- Image Counter -->
          <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/70 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
            <span id="current-image">1</span> / <span id="total-images">1</span>
          </div>
        </div>

        <!-- Next Button -->
        <button onclick="nextImage()" class="absolute right-4 z-50 w-12 h-12 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </div>

    <script>
      // Projects data for lightbox
      const projectsData = {!! json_encode($projects->map(function($project) {
        return [
          'id' => $project->id,
          'title' => $project->title,
          'images' => $project->images->map(function($image) {
            return asset('storage/' . $image->image_path);
          })
        ];
      })) !!};

      let currentProject = null;
      let currentImageIndex = 0;

      function openLightbox(projectId, imageIndex = 0) {
        currentProject = projectsData.find(p => p.id === projectId);
        if (!currentProject || currentProject.images.length === 0) return;

        currentImageIndex = imageIndex;
        updateLightboxImage();

        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
      }

      function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
        currentProject = null;
        currentImageIndex = 0;
      }

      function nextImage() {
        if (!currentProject) return;
        currentImageIndex = (currentImageIndex + 1) % currentProject.images.length;
        updateLightboxImage();
      }

      function previousImage() {
        if (!currentProject) return;
        currentImageIndex = (currentImageIndex - 1 + currentProject.images.length) % currentProject.images.length;
        updateLightboxImage();
      }

      function updateLightboxImage() {
        if (!currentProject) return;

        const image = document.getElementById('lightbox-image');
        image.src = currentProject.images[currentImageIndex];
        image.alt = currentProject.title;

        document.getElementById('current-image').textContent = currentImageIndex + 1;
        document.getElementById('total-images').textContent = currentProject.images.length;
      }

      // Keyboard navigation
      document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('flex')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'ArrowRight') nextImage();
      });

      // Close on outside click
      document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
      });

      // Toast notification function
      @if(session('success'))
      function showToast() {
        const toast = document.getElementById('toast');
        toast.style.transform = 'translateX(0)';
        
        setTimeout(() => {
          toast.style.transform = 'translateX(500px)';
        }, 4000);
      }
      
      // Show toast on page load if there's a success message
      window.addEventListener('DOMContentLoaded', showToast);
      @endif
    </script>

  </body>
</html>
