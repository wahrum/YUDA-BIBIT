@extends('layouts.public')

@section('title', ($activeCategory ? $activeCategory->name . ' - ' : '') . 'Produk | ' . \App\Models\SiteSetting::get('site_name', 'Yuda Bibit'))

@section('content')

{{-- ── Header halaman ──────────────────────────────────────────────────────────── --}}
<div class="bg-forest py-10 text-center relative">
    {{-- Tombol Back --}}
    <button onclick="history.back()"
            class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 inline-flex items-center gap-2 text-sm text-primary-200 hover:text-white font-medium transition group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="hidden sm:inline">Kembali</span>
    </button>

    <h1 class="text-3xl font-bold text-white mb-2">
        {{ $activeCategory ? $activeCategory->name : 'Semua Produk' }}
    </h1>
    <p class="text-primary-200">
        {{ $activeCategory ? $activeCategory->description : 'Temukan semua tanaman dan bibit pilihan kami' }}
    </p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ── Filter Mobile: search + dropdown kategori (tampil hanya di mobile) ── --}}
    <div class="lg:hidden mb-6 space-y-3">
        {{-- Search mobile --}}
        <form method="GET" action="{{ route('products') }}">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari tanaman..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm bg-white shadow-sm">
                <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </form>

        {{-- Dropdown kategori mobile --}}
        <div class="relative">
            <button id="mobile-cat-btn"
                    onclick="toggleMobileCategory()"
                    class="w-full flex items-center justify-between bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-medium text-forest shadow-sm">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    {{ $activeCategory ? $activeCategory->name : 'Semua Kategori' }}
                </span>
                <svg id="mobile-cat-arrow" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Dropdown panel --}}
            <div id="mobile-cat-panel"
                 class="hidden absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-lg z-30 overflow-hidden">
                <a href="{{ route('products', request('search') ? ['search' => request('search')] : []) }}"
                   class="flex items-center gap-2 px-4 py-3 text-sm transition
                          {{ !request('category') ? 'bg-primary-50 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <span>🌿</span> Semua Kategori
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products', array_filter(['category' => $cat->slug, 'search' => request('search')])) }}"
                       class="flex items-center gap-2 px-4 py-3 text-sm border-t border-gray-50 transition
                              {{ request('category') == $cat->slug ? 'bg-primary-50 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── Sidebar Desktop (hidden di mobile) ─────────────────────────────── --}}
        <aside class="hidden lg:block w-64 flex-shrink-0">
            {{-- Search desktop --}}
            <form method="GET" action="{{ route('products') }}" class="mb-6">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari tanaman..."
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                    <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>

            {{-- List kategori desktop --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                <h3 class="font-bold text-forest mb-4">Kategori</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products', request('search') ? ['search' => request('search')] : []) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
                                  {{ !request('category') ? 'bg-primary-100 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            🌿 Semua Produk
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products', array_filter(['category' => $cat->slug, 'search' => request('search')])) }}"
                               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
                                      {{ request('category') == $cat->slug ? 'bg-primary-100 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- ── Daftar Produk ────────────────────────────────────────────────────── --}}
        <div class="flex-1 min-w-0">
            @if($products->count())
                <p class="text-sm text-gray-400 mb-5">
                    Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $product)
                        @include('public.partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20 text-gray-400">
                    <div class="text-6xl mb-4">🌱</div>
                    <p class="text-lg font-medium">Belum ada produk</p>
                    <p class="text-sm mt-1">Coba cari dengan kata kunci lain atau pilih kategori berbeda</p>
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-primary-600 hover:underline text-sm">
                        Lihat semua produk
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Script dropdown mobile --}}
<script>
function toggleMobileCategory() {
    const panel = document.getElementById('mobile-cat-panel');
    const arrow = document.getElementById('mobile-cat-arrow');
    const isHidden = panel.classList.contains('hidden');

    panel.classList.toggle('hidden', !isHidden);
    arrow.style.transform = isHidden ? 'rotate(180deg)' : '';
}

// Tutup dropdown saat klik di luar
document.addEventListener('click', function(e) {
    const btn   = document.getElementById('mobile-cat-btn');
    const panel = document.getElementById('mobile-cat-panel');
    if (btn && panel && !btn.contains(e.target) && !panel.contains(e.target)) {
        panel.classList.add('hidden');
        document.getElementById('mobile-cat-arrow').style.transform = '';
    }
});
</script>

@endsection
