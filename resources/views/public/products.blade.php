@extends('layouts.public')

@section('title', ($activeCategory ? $activeCategory->name . ' - ' : '') . 'Produk | ' . \App\Models\SiteSetting::get('site_name', 'Yuda Bibit'))

@section('content')

{{-- ── Header halaman ─────────────────────────────────────────────────────────── --}}
<div class="bg-forest py-12 text-center">
    <h1 class="text-3xl font-bold text-white mb-2">
        {{ $activeCategory ? $activeCategory->name : 'Semua Produk' }}
    </h1>
    <p class="text-primary-200">
        {{ $activeCategory ? $activeCategory->description : 'Temukan semua tanaman dan bibit pilihan kami' }}
    </p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── Sidebar Filter ──────────────────────────────────────────────────── --}}
        <aside class="w-full lg:w-64 flex-shrink-0">
            {{-- Search --}}
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

            {{-- Kategori --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                <h3 class="font-bold text-forest mb-4">Kategori</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products') }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-primary-100 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            🌿 Semua Produk
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products', ['category' => $cat->slug]) }}"
                               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition {{ request('category') == $cat->slug ? 'bg-primary-100 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- ── Daftar Produk ────────────────────────────────────────────────────── --}}
        <div class="flex-1">
            @if($products->count())
                <p class="text-sm text-gray-400 mb-5">Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-5">
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
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-primary-600 hover:underline text-sm">Lihat semua produk</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
