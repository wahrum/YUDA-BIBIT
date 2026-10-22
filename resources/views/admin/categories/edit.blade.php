@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori: ' . $category->name)

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none">{{ old('description', $category->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Kategori</label>
                @if($category->image_url)
                    <div class="mb-3">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                             class="w-32 h-32 object-cover rounded-xl border border-gray-200">
                        <p class="text-xs text-gray-400 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                               class="w-5 h-5 accent-primary-600 rounded">
                        <span class="text-sm font-medium text-gray-700">Aktifkan kategori</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-forest hover:bg-primary-800 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="javascript:history.back()"
                   class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-xl text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
