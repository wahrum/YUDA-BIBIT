<div class="flex gap-4 p-4 hover:bg-gray-50 transition">
    {{-- Thumbnail --}}
    <div class="w-32 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
        <img src="{{ $slide->image_url }}" alt="Slide #{{ $slide->id }}"
             class="w-full h-full object-cover">
    </div>

    {{-- Info + aksi --}}
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2">
            <div class="min-w-0">
                <p class="font-medium text-gray-800 text-sm truncate">
                    {{ $slide->title ?? 'Slide #' . $slide->id }}
                </p>
                @if($slide->subtitle)
                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ $slide->subtitle }}</p>
                @endif
                <p class="text-xs text-gray-300 mt-1">{{ $slide->created_at->diffForHumans() }}</p>
            </div>

            {{-- Toggle aktif --}}
            <form method="POST" action="{{ route('admin.slides.toggle', $slide) }}" class="flex-shrink-0">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium transition
                               {{ $slide->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                    {{ $slide->is_active ? '● Aktif' : '○ Nonaktif' }}
                </button>
            </form>
        </div>

        {{-- Edit & Hapus --}}
        <div class="mt-2 flex items-center gap-2">
            <button onclick="toggleEdit('slide-edit-{{ $slide->id }}')"
                    class="text-xs text-primary-600 hover:text-primary-800 font-medium">
                Edit judul
            </button>
            <span class="text-gray-200">|</span>
            <form method="POST" action="{{ route('admin.slides.destroy', $slide) }}"
                  onsubmit="return confirm('Hapus foto ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus</button>
            </form>
        </div>

        {{-- Form edit judul (tersembunyi) --}}
        <div id="slide-edit-{{ $slide->id }}" class="hidden mt-3">
            <form method="POST" action="{{ route('admin.slides.update', $slide) }}" class="flex gap-2">
                @csrf
                @method('PUT')
                <div class="flex-1 space-y-1.5">
                    <input type="text" name="title" value="{{ $slide->title }}"
                           class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-primary-400"
                           placeholder="Judul...">
                    <input type="text" name="subtitle" value="{{ $slide->subtitle }}"
                           class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-primary-400"
                           placeholder="Keterangan...">
                </div>
                <button type="submit"
                        class="flex-shrink-0 bg-forest text-white text-xs px-3 py-1.5 rounded-lg hover:bg-primary-800 transition self-start">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
