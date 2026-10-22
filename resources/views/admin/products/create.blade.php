@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="Contoh: Bonsai Beringin">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Satuan <span class="text-red-500">*</span></label>
                    <input type="text" name="unit" value="{{ old('unit', 'pohon') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="pohon, batang, biji, polybag...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga <span class="text-gray-400 font-normal">(kosongkan jika "Hubungi Kami")</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400 text-sm">Rp</span>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" step="100"
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="50000">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat</label>
                <input type="text" name="short_description" value="{{ old('short_description') }}" maxlength="300"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                       placeholder="Ringkasan 1-2 kalimat untuk ditampilkan di kartu produk">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                <textarea name="description" rows="5"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none"
                          placeholder="Deskripsi lengkap produk...">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Utama</label>
                <input type="file" name="image" id="main-photo" accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 3MB.</p>
                <div id="main-preview" class="mt-2 hidden">
                    <img id="main-preview-img" src="" alt="" class="w-32 h-32 object-cover rounded-xl border border-gray-200">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Galeri Foto <span class="text-gray-400 font-normal">(opsional, bisa banyak)</span></label>
                <input type="file" name="gallery[]" multiple accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="text-xs text-gray-400 mt-1">Pilih beberapa foto sekaligus. Maks 3MB per foto.</p>
            </div>

            <div class="flex gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                           class="w-5 h-5 accent-primary-600">
                    <span class="text-sm font-medium text-gray-700">Produk Aktif</span>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') == '1' ? 'checked' : '' }}
                           class="w-5 h-5 accent-yellow-500">
                    <span class="text-sm font-medium text-gray-700">⭐ Produk Unggulan</span>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-forest hover:bg-primary-800 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-sm">
                    Simpan Produk
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

<script>
document.getElementById('main-photo')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
            document.getElementById('main-preview-img').src = evt.target.result;
            document.getElementById('main-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
