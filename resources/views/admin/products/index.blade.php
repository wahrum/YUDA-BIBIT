@extends('layouts.admin')

@section('title', 'Produk')
@section('header', 'Manajemen Produk')

@section('content')

<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
    <p class="text-sm text-gray-500">{{ $products->total() }} produk terdaftar</p>
    <a href="{{ route('admin.products.create') }}"
       class="flex items-center gap-2 bg-forest hover:bg-primary-800 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Produk
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left hidden md:table-cell">Kategori</th>
                    <th class="px-6 py-3 text-right hidden sm:table-cell">Harga</th>
                    <th class="px-6 py-3 text-center">Unggulan</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-primary-50 flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xl">🌿</div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 truncate max-w-xs">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 hidden md:table-cell">
                            <span class="bg-primary-100 text-primary-700 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-right hidden sm:table-cell">
                            <span class="font-semibold text-forest text-sm">{{ $product->formatted_price }}</span>
                            @if($product->price)
                                <span class="text-xs text-gray-400 block">/ {{ $product->unit }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center">
                            @if($product->is_featured)
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full">
                                    <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </span>
                            @else
                                <span class="text-gray-300 text-sm">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->is_active ? '● Aktif' : '○ Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('product.detail', $product->slug) }}" target="_blank"
                                   class="text-gray-400 hover:text-gray-600 p-1.5 hover:bg-gray-50 rounded-lg transition" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-primary-600 hover:text-primary-800 p-1.5 hover:bg-primary-50 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                      onsubmit="return confirm('Hapus produk \'{{ $product->name }}\'? Semua foto akan ikut terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1.5 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-3">🌱</div>
                            <p>Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-primary-600 hover:underline">Tambah sekarang</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
