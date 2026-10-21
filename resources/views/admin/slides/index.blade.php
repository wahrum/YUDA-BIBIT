@extends('layouts.admin')

@section('title', 'Kelola Foto Beranda')
@section('header', 'Kelola Foto Beranda')

@section('content')

{{-- ── TAB NAVIGATION ──────────────────────────────────────────────────────── --}}
<div class="flex gap-2 mb-6">
    <button onclick="switchTab('hero')" id="tab-hero"
            class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition bg-forest text-white shadow-sm">
        🖼️ Foto Beranda (Header)
    </button>
    <button onclick="switchTab('about')" id="tab-about"
            class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">
        🌿 Foto Tentang Kami
    </button>
</div>

{{-- ══════════════════════════════════════════════════════════════════════════ --}}
{{-- SECTION HERO                                                              --}}
{{-- ══════════════════════════════════════════════════════════════════════════ --}}
<div id="panel-hero">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Upload --}}
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-forest mb-1">Upload Foto Header</h3>
                <p class="text-xs text-gray-400 mb-5">Foto tampil sebagai slider fullscreen di bagian atas beranda.</p>

                <form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="hero">

                    <div id="hero-preview-area" class="hidden">
                        <p class="text-xs font-medium text-gray-500 mb-2">Preview:</p>
                        <div id="hero-preview-grid" class="grid grid-cols-3 gap-2 mb-3"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Foto <span class="text-red-500">*</span></label>
                        <input type="file" name="images[]" id="hero-images" multiple
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 4MB. Landscape 1200×600px.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="title"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="Contoh: Temukan Tanaman Impian Anda">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="subtitle"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="Keterangan singkat di bawah judul">
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-forest hover:bg-primary-800 text-white font-semibold py-3 rounded-xl text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Upload Foto Header
                    </button>
                </form>
            </div>

            <div class="bg-primary-50 border border-primary-100 rounded-2xl p-4">
                <p class="text-xs font-semibold text-primary-800 mb-2">💡 Tips Foto Header</p>
                <ul class="text-xs text-primary-700 space-y-1 list-disc list-inside">
                    <li>Landscape (horizontal), min 1200×500px</li>
                    <li>Tampilkan suasana kebun atau produk</li>
                    <li>Kontras tinggi agar teks terbaca</li>
                    <li>Format JPG lebih ringan</li>
                </ul>
            </div>
        </div>

        {{-- Daftar foto hero --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Foto Header ({{ $heroSlides->count() }})</h3>
                    <span class="text-xs text-gray-400">{{ $heroSlides->where('is_active', true)->count() }} aktif</span>
                </div>

                @if($heroSlides->count())
                    <div class="divide-y divide-gray-50">
                        @foreach($heroSlides as $slide)
                            @include('admin.slides.partials.slide-item', ['slide' => $slide])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-14 text-gray-400">
                        <div class="text-4xl mb-3">🖼️</div>
                        <p class="font-medium text-sm">Belum ada foto header</p>
                        <p class="text-xs mt-1">Upload foto di panel kiri untuk mulai</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════════════ --}}
{{-- SECTION ABOUT                                                             --}}
{{-- ══════════════════════════════════════════════════════════════════════════ --}}
<div id="panel-about" class="hidden">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Upload --}}
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-forest mb-1">Upload Foto Tentang Kami</h3>
                <p class="text-xs text-gray-400 mb-5">Foto tampil sebagai slider di section Tentang Kami pada beranda.</p>

                <form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="about">

                    <div id="about-preview-area" class="hidden">
                        <p class="text-xs font-medium text-gray-500 mb-2">Preview:</p>
                        <div id="about-preview-grid" class="grid grid-cols-3 gap-2 mb-3"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Foto <span class="text-red-500">*</span></label>
                        <input type="file" name="images[]" id="about-images" multiple
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 4MB. Min 800×600px.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="title"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="Contoh: Kebun Kami">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="subtitle"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 text-sm"
                               placeholder="Keterangan singkat">
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-forest hover:bg-primary-800 text-white font-semibold py-3 rounded-xl text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Upload Foto Tentang Kami
                    </button>
                </form>
            </div>

            <div class="bg-primary-50 border border-primary-100 rounded-2xl p-4">
                <p class="text-xs font-semibold text-primary-800 mb-2">💡 Tips Foto Tentang Kami</p>
                <ul class="text-xs text-primary-700 space-y-1 list-disc list-inside">
                    <li>Tampilkan kebun, proses, atau tim</li>
                    <li>Landscape lebih baik, min 800×600px</li>
                    <li>Foto nyata lebih dipercaya pengunjung</li>
                    <li>Bisa upload beberapa sekaligus</li>
                </ul>
            </div>
        </div>

        {{-- Daftar foto about --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Foto Tentang Kami ({{ $aboutSlides->count() }})</h3>
                    <span class="text-xs text-gray-400">{{ $aboutSlides->where('is_active', true)->count() }} aktif</span>
                </div>

                @if($aboutSlides->count())
                    <div class="divide-y divide-gray-50">
                        @foreach($aboutSlides as $slide)
                            @include('admin.slides.partials.slide-item', ['slide' => $slide])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-14 text-gray-400">
                        <div class="text-4xl mb-3">🌿</div>
                        <p class="font-medium text-sm">Belum ada foto Tentang Kami</p>
                        <p class="text-xs mt-1">Upload foto di panel kiri untuk mulai</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Script tab + preview --}}
<script>
function switchTab(tab) {
    // Panel
    document.getElementById('panel-hero').classList.toggle('hidden', tab !== 'hero');
    document.getElementById('panel-about').classList.toggle('hidden', tab !== 'about');
    // Tombol tab
    const active   = 'bg-forest text-white shadow-sm';
    const inactive = 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50';
    document.getElementById('tab-hero').className  = 'tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition ' + (tab==='hero'  ? active : inactive);
    document.getElementById('tab-about').className = 'tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition ' + (tab==='about' ? active : inactive);
}

function makePreview(inputId, gridId, areaId) {
    document.getElementById(inputId)?.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        const grid  = document.getElementById(gridId);
        const area  = document.getElementById(areaId);
        grid.innerHTML = '';
        if (!files.length) { area.classList.add('hidden'); return; }
        area.classList.remove('hidden');
        files.forEach(f => {
            const r = new FileReader();
            r.onload = evt => {
                const d = document.createElement('div');
                d.className = 'aspect-video rounded-lg overflow-hidden bg-gray-100';
                d.innerHTML = `<img src="${evt.target.result}" class="w-full h-full object-cover">`;
                grid.appendChild(d);
            };
            r.readAsDataURL(f);
        });
    });
}

makePreview('hero-images',  'hero-preview-grid',  'hero-preview-area');
makePreview('about-images', 'about-preview-grid', 'about-preview-area');
</script>

@endsection
