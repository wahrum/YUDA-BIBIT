@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

{{-- ── Stats Cards ─────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 xl:grid-cols-5 gap-3 lg:gap-5 mb-6">

    <div class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs lg:text-sm text-gray-500 leading-tight">Total Produk</p>
            <div class="w-9 h-9 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-lg">📦</span>
            </div>
        </div>
        <p class="text-2xl lg:text-3xl font-bold text-forest">{{ $stats['total_products'] }}</p>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs lg:text-sm text-gray-500 leading-tight">Produk Aktif</p>
            <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-lg">✅</span>
            </div>
        </div>
        <p class="text-2xl lg:text-3xl font-bold text-green-600">{{ $stats['active_products'] }}</p>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs lg:text-sm text-gray-500 leading-tight">Unggulan</p>
            <div class="w-9 h-9 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-lg">⭐</span>
            </div>
        </div>
        <p class="text-2xl lg:text-3xl font-bold text-yellow-600">{{ $stats['featured_products'] }}</p>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs lg:text-sm text-gray-500 leading-tight">Foto Aktif</p>
            <div class="w-9 h-9 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-lg">🖼️</span>
            </div>
        </div>
        <p class="text-2xl lg:text-3xl font-bold text-purple-600">{{ $stats['active_slides'] }}</p>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs lg:text-sm text-gray-500 leading-tight">Kategori</p>
            <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-lg">🏷️</span>
            </div>
        </div>
        <p class="text-2xl lg:text-3xl font-bold text-blue-600">{{ $stats['total_categories'] }}</p>
    </div>

</div>

{{-- ── Konten Bawah ─────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6">

    {{-- Produk Terbaru --}}
    <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-4 lg:px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-sm lg:text-base">Produk Terbaru</h3>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-primary-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($latestProducts as $product)
                <div class="flex items-center gap-3 px-4 lg:px-6 py-3">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl overflow-hidden bg-primary-50 flex-shrink-0">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-lg">🌿</div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 text-sm truncate">{{ $product->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $product->category->name }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-xs lg:text-sm font-semibold text-forest">{{ $product->formatted_price }}</p>
                        <span class="text-xs {{ $product->is_active ? 'text-green-500' : 'text-gray-400' }}">
                            {{ $product->is_active ? '● Aktif' : '● Nonaktif' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-gray-400 text-sm">Belum ada produk.</p>
                    <a href="{{ route('admin.products.create') }}" class="text-primary-600 text-xs hover:underline mt-1 block">+ Tambah produk</a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 lg:p-6">
        <h3 class="font-bold text-gray-800 mb-4 text-sm lg:text-base">Aksi Cepat</h3>
        <div class="space-y-2 lg:space-y-3">

            <a href="{{ route('admin.slides.index') }}"
               class="flex items-center gap-3 p-3 bg-primary-50 hover:bg-primary-100 rounded-xl transition">
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-forest">Kelola Foto Beranda</span>
            </a>

            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-3 p-3 bg-primary-50 hover:bg-primary-100 rounded-xl transition">
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-forest">Tambah Produk</span>
            </a>

            <a href="{{ route('admin.categories.create') }}"
               class="flex items-center gap-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-blue-700">Tambah Kategori</span>
            </a>

            <a href="{{ route('admin.settings') }}"
               class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-gray-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Pengaturan Situs</span>
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 p-3 bg-green-50 hover:bg-green-100 rounded-xl transition">
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-green-700">Lihat Website</span>
            </a>

        </div>
    </div>
</div>

@endsection
