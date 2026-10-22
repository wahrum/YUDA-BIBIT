@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header', 'Edit: ' . $product->name)

@section('content')

<div class="max-w-3xl">

    {{-- Notifikasi error validasi --}}
    @if($errors->any())
        <div class="mb-5 bg-red-50 border border-red-200 rounded-2xl px-5 py-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan, silakan periksa kembali:</p>
                    <ul class="text-sm text-red-600 list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- ── FORM EDIT UTAMA ─────────────────────────────────────────────────── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form id="form-edit-produk" method="POST"
              action="{{ route('admin.products.update', $product) }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Nama Produk --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm
                                  {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" required
                            class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm bg-white
                                   {{ $errors->has('category_id') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Satuan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Satuan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" required
                           class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm
                                  {{ $errors->has('unit') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                           placeholder="pohon, batang, biji, polybag...">
                    @error('unit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Harga <span class="text-gray-400 font-normal">(kosongkan jika "Hubungi Kami")</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400 text-sm">Rp</span>
                        <input type="number" name="price"
                               value="{{ old('price', $product->price ? (int)$product->price : '') }}"
                               min="0" step="100"
                               class="w-full pl-10 pr-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm
                                      {{ $errors->has('price') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                               placeholder="50000">
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat</label>
                <input type="text" name="short_description"
                       value="{{ old('short_description', $product->short_description) }}"
                       maxlength="300"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                       placeholder="Ringkasan 1-2 kalimat untuk ditampilkan di kartu produk">
            </div>

            {{-- Deskripsi Lengkap --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                <textarea name="description" rows="5"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none"
                          placeholder="Deskripsi lengkap produk...">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Foto Utama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Utama</label>
                @if($product->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                        <p class="text-xs text-gray-400">Foto saat ini.<br>Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 3MB.</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tambah Foto Galeri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Tambah Foto Galeri
                    <span class="text-gray-400 font-normal">(opsional, bisa banyak)</span>
                </label>
                <input type="file" name="gallery[]" multiple accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="text-xs text-gray-400 mt-1">Pilih beberapa foto sekaligus. Maks 3MB per foto.</p>
            </div>

            {{-- Toggle Status --}}
            <div class="flex gap-6 pt-1">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                           class="w-5 h-5 accent-primary-600"
                           onchange="toggleFeatured(this)">
                    <span class="text-sm font-medium text-gray-700">Produk Aktif</span>
                </label>

                <label id="featured-label" class="flex items-center gap-3 {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? 'cursor-pointer' : 'cursor-not-allowed opacity-40' }}">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           {{ old('is_featured', $product->is_featured ? '1' : '0') == '1' ? 'checked' : '' }}
                           {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? '' : 'disabled' }}
                           class="w-5 h-5 accent-yellow-500">
                    <span class="text-sm font-medium text-gray-700">⭐ Produk Unggulan</span>
                </label>
            </div>

            <script>
            function toggleFeatured(checkbox) {
                const featuredInput = document.getElementById('is_featured');
                const featuredLabel = document.getElementById('featured-label');
                if (checkbox.checked) {
                    featuredInput.disabled = false;
                    featuredLabel.classList.remove('cursor-not-allowed', 'opacity-40');
                    featuredLabel.classList.add('cursor-pointer');
                } else {
                    featuredInput.disabled = true;
                    featuredInput.checked = false;
                    featuredLabel.classList.remove('cursor-pointer');
                    featuredLabel.classList.add('cursor-not-allowed', 'opacity-40');
                }
            }
            </script>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="flex items-center gap-2 bg-forest hover:bg-primary-800 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
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

    {{-- ── GALERI FOTO (di LUAR form edit) ─────────────────────────────────── --}}
    {{-- Form hapus galeri diletakkan di LUAR form utama agar tidak nested      --}}
    @if($product->images->count())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-4">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">
                Galeri Foto Saat Ini
                <span class="text-gray-400 font-normal">(hover untuk hapus)</span>
            </h3>
            <div class="flex flex-wrap gap-3">
                @foreach($product->images as $img)
                    <div class="relative group">
                        <img src="{{ $img->image_url }}" alt=""
                             class="w-24 h-24 object-cover rounded-xl border border-gray-200 group-hover:opacity-60 transition">
                        {{-- Form hapus galeri — SENGAJA di luar form edit utama --}}
                        <form method="POST"
                              action="{{ route('admin.products.images.destroy', $img) }}"
                              onsubmit="return confirm('Hapus foto ini?')"
                              class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full text-xs flex items-center justify-center shadow">
                                ✕
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection
