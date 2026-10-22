@extends('layouts.admin')

@section('title', 'Pengaturan Situs')
@section('header', 'Pengaturan Situs')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Informasi Utama --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-forest mb-5 pb-2 border-b border-gray-100">Informasi Brand</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Situs <span class="text-red-500">*</span></label>
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                    <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="Slogan singkat bisnis Anda">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Situs</label>
                    <textarea name="site_description" rows="3"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none">{{ old('site_description', $settings['site_description']) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo Situs</label>
                    @if($settings['site_logo'])
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-12 object-contain">
                            <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="site_logo" accept="image/jpg,image/jpeg,image/png,image/webp,image/svg+xml"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="text-xs text-gray-400 mt-1">SVG, PNG, JPG. Maks 1MB. Direkomendasikan PNG transparan.</p>
                </div>
            </div>
        </div>

        {{-- Tentang Kami --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-forest mb-5 pb-2 border-b border-gray-100">Tentang Kami</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Tentang Kami</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konten Tentang Kami</label>
                    <textarea name="about_content" rows="4"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none">{{ old('about_content', $settings['about_content']) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kontak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-forest mb-5 pb-2 border-b border-gray-100">Informasi Kontak</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                    <input type="text" name="site_address" value="{{ old('site_address', $settings['site_address']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                    <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="081234567890">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm">
                </div>
            </div>
        </div>

        {{-- WhatsApp & Sosial Media --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-forest mb-5 pb-2 border-b border-gray-100">WhatsApp & Sosial Media</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nomor WhatsApp <span class="text-red-500">*</span>
                        <span class="text-gray-400 font-normal ml-1">(format: 628xxxx)</span>
                    </label>
                    <input type="text" name="site_whatsapp" value="{{ old('site_whatsapp', $settings['site_whatsapp']) }}" required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="6281234567890">
                    <p class="text-xs text-gray-400 mt-1">Gunakan format internasional tanpa tanda +. Contoh: 6281234567890</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pesan Default WhatsApp</label>
                    <textarea name="whatsapp_message" rows="2"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm resize-none">{{ old('whatsapp_message', $settings['whatsapp_message']) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Instagram</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400 text-sm">@</span>
                        <input type="text" name="site_instagram" value="{{ old('site_instagram', $settings['site_instagram']) }}"
                               class="w-full pl-7 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="username">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Facebook</label>
                    <input type="text" name="site_facebook" value="{{ old('site_facebook', $settings['site_facebook']) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                           placeholder="nama halaman facebook">
                </div>
            </div>
        </div>

    </div>

    <div class="mt-6">
        <button type="submit"
                class="bg-forest hover:bg-primary-800 text-white font-semibold px-8 py-3 rounded-xl text-sm transition shadow-sm">
            Simpan Semua Pengaturan
        </button>
    </div>

</form>

@endsection
