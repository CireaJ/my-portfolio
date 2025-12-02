<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Tech Stack - Admin</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
  </head>
  <body class="bg-gray-950 text-gray-100 antialiased">

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
          <div>
            <h1 class="text-4xl font-bold mb-2">
              <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Tech Stack</span>
            </h1>
            <p class="text-gray-400">Drag to reorder • Click to edit</p>
          </div>
          <div class="flex gap-4">
            <a href="{{ route('portfolio.index') }}" class="px-6 py-3 border-2 border-gray-700 rounded-lg font-semibold hover:bg-gray-800 transition-all duration-300">
              ← Portfolio
            </a>
            <a href="{{ route('admin.tech-stack.create') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300">
              + Add New
            </a>
          </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
          <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-lg">
            {{ session('success') }}
          </div>
        @endif

        <!-- Tech Stack List -->
        <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
          @if($techStacks->count() > 0)
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-800/50 border-b border-gray-700">
                  <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 w-12"></th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Icon</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Order</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">Actions</th>
                  </tr>
                </thead>
                <tbody id="sortable-tech-stack" class="divide-y divide-gray-800">
                  @foreach($techStacks as $stack)
                    <tr class="hover:bg-gray-800/30 transition-colors cursor-move" data-id="{{ $stack->id }}">
                      <td class="px-6 py-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                      </td>
                      <td class="px-6 py-4">
                        <img src="{{ $stack->icon_url }}" alt="{{ $stack->name }}" class="w-12 h-12 object-contain">
                      </td>
                      <td class="px-6 py-4 text-gray-200 font-medium">
                        {{ $stack->name }}
                      </td>
                      <td class="px-6 py-4 text-gray-400">
                        <span class="order-number">{{ $stack->order }}</span>
                      </td>
                      <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                          <a href="{{ route('admin.tech-stack.edit', $stack) }}" class="px-4 py-2 bg-cyan-500/10 text-cyan-400 rounded-lg hover:bg-cyan-500/20 transition-colors text-sm font-medium">
                            Edit
                          </a>
                          <form action="{{ route('admin.tech-stack.destroy', $stack) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tech stack?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors text-sm font-medium">
                              Delete
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="p-12 text-center">
              <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
              <p class="text-gray-400 text-lg mb-4">No tech stacks added yet</p>
              <a href="{{ route('admin.tech-stack.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300">
                Add Your First Tech Stack
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>

    <script>
      // Initialize SortableJS
      const tbody = document.getElementById('sortable-tech-stack');

      if (tbody) {
        const sortable = new Sortable(tbody, {
          animation: 150,
          handle: 'tr',
          ghostClass: 'sortable-ghost',
          dragClass: 'sortable-drag',
          onEnd: function(evt) {
            // Get all rows in new order
            const rows = tbody.querySelectorAll('tr');
            const orderData = [];

            rows.forEach((row, index) => {
              const id = row.dataset.id;
              const newOrder = index + 1;

              // Update order number in UI
              row.querySelector('.order-number').textContent = newOrder;

              orderData.push({
                id: id,
                order: newOrder
              });
            });

            // Send AJAX request to update order
            fetch('{{ route("admin.tech-stack.reorder") }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: JSON.stringify({ order: orderData })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Show success feedback
                showNotification('Order updated successfully!', 'success');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              showNotification('Failed to update order', 'error');
            });
          }
        });
      }

      // Notification function
      function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 transition-all ${
          type === 'success' ? 'bg-green-500/10 border border-green-500/50 text-green-400' : 'bg-red-500/10 border border-red-500/50 text-red-400'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
          notification.style.opacity = '0';
          setTimeout(() => notification.remove(), 300);
        }, 3000);
      }
    </script>

    <style>
      .sortable-ghost {
        opacity: 0.4;
        background: rgba(6, 182, 212, 0.1);
      }

      .sortable-drag {
        background: rgba(17, 24, 39, 0.95);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      }

      #sortable-tech-stack tr {
        transition: all 0.15s ease;
      }
    </style>

  </body>
</html>
