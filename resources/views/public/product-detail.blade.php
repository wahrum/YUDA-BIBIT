@extends('layouts.public')

@section('title', $product->name . ' | ' . \App\Models\SiteSetting::get('site_name', 'Yuda Bibit'))

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-400 mb-6 flex flex-wrap items-center gap-1">
        <a href="{{ route('home') }}" class="hover:text-primary-700">Beranda</a>
        <span>/</span>
        <a href="{{ route('products') }}" class="hover:text-primary-700">Produk</a>
        <span>/</span>
        <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-primary-700">{{ $product->category->name }}</a>
        <span>/</span>
        <span class="text-gray-600 truncate max-w-xs">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- ── Galeri Foto ────────────────────────────────────────────────────── --}}
        <div>
            {{-- Foto utama --}}
            <div class="aspect-square rounded-2xl overflow-hidden bg-primary-50 mb-3" id="main-image-wrap">
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         id="main-image"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-8xl">🌿</div>
                @endif
            </div>

            {{-- Galeri thumbnail --}}
            @if($product->images->count())
                <div class="flex gap-2 overflow-x-auto pb-2">
                    @if($product->image)
                        <button onclick="changeImage('{{ $product->image_url }}')"
                                class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 border-primary-400 focus:outline-none">
                            <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                        </button>
                    @endif
                    @foreach($product->images as $img)
                        <button onclick="changeImage('{{ $img->image_url }}')"
                                class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary-400 focus:outline-none transition">
                            <img src="{{ $img->image_url }}" alt="{{ $img->caption }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── Info Produk ─────────────────────────────────────────────────────── --}}
        <div>
            <span class="inline-block bg-primary-100 text-primary-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                {{ $product->category->name }}
            </span>

            @if($product->is_featured)
                <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full mb-3 ml-1">⭐ Unggulan</span>
            @endif

            <h1 class="text-2xl md:text-3xl font-bold text-forest mb-4">{{ $product->name }}</h1>

            @if($product->short_description)
                <p class="text-gray-600 text-base mb-5 leading-relaxed">{{ $product->short_description }}</p>
            @endif

            {{-- Harga --}}
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-3xl font-bold text-primary-700">{{ $product->formatted_price }}</span>
                @if($product->price)
                    <span class="text-gray-400 text-sm">/ {{ $product->unit }}</span>
                @endif
            </div>

            {{-- Tombol WA --}}
            @php $waNumber = \App\Models\SiteSetting::get('site_whatsapp', ''); @endphp
            @if($waNumber)
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo Yuda Bibit, saya ingin memesan: ' . $product->name . '. Apakah stok tersedia?') }}"
                   target="_blank"
                   class="flex items-center justify-center gap-3 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-2xl text-lg transition-all duration-200 shadow-md hover:shadow-lg mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16.003 2.667C8.64 2.667 2.667 8.64 2.667 16c0 2.373.624 4.699 1.813 6.752L2.667 29.333l6.752-1.771A13.3 13.3 0 0016.003 29.333c7.36 0 13.33-5.973 13.33-13.333S23.363 2.667 16.003 2.667zm6.035 16.432c-.33-.165-1.952-.963-2.255-1.072-.304-.11-.525-.165-.747.165s-.856 1.072-1.05 1.293c-.193.22-.385.247-.716.083-.33-.165-1.395-.514-2.658-1.64-.981-.873-1.645-1.953-1.838-2.283-.193-.33-.021-.509.145-.673.149-.148.33-.385.495-.578.165-.193.22-.33.33-.55.11-.22.055-.413-.027-.578-.083-.165-.747-1.8-1.023-2.466-.27-.648-.543-.56-.747-.57l-.637-.011a1.22 1.22 0 00-.885.413c-.303.33-1.157 1.13-1.157 2.757s1.185 3.198 1.35 3.418c.165.22 2.332 3.563 5.65 4.994.79.34 1.406.543 1.886.695.793.25 1.515.215 2.086.13.636-.094 1.952-.798 2.228-1.568.275-.77.275-1.43.193-1.568-.082-.138-.303-.22-.633-.385z"/>
                    </svg>
                    Pesan via WhatsApp
                </a>
            @endif

            {{-- Info tambahan --}}
            <div class="bg-primary-50 rounded-2xl p-5 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Kategori</span>
                    <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="font-medium text-forest hover:underline">
                        {{ $product->category->name }}
                    </a>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Satuan</span>
                    <span class="font-medium text-gray-700">Per {{ $product->unit }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="font-medium text-green-600">✓ Tersedia</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Deskripsi Lengkap ──────────────────────────────────────────────────── --}}
    @if($product->description)
        <div class="mt-12">
            <h2 class="text-xl font-bold text-forest mb-4 pb-2 border-b border-gray-100">Deskripsi Produk</h2>
            <div class="prose prose-green max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    @endif

    {{-- ── Produk Terkait ─────────────────────────────────────────────────────── --}}
    @if($relatedProducts->count())
        <div class="mt-16">
            <h2 class="text-xl font-bold text-forest mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                @foreach($relatedProducts as $product)
                    @include('public.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    @endif

</div>

<script>
function changeImage(url) {
    const img = document.getElementById('main-image');
    if (img) img.src = url;
}
</script>

@endsection
