@extends('layouts.public')

@section('title', \App\Models\SiteSetting::get('site_name', 'Yuda Bibit') . ' - ' . \App\Models\SiteSetting::get('site_tagline', 'Toko Tanaman & Bibit'))

@section('content')

{{-- ── Hero Section ──────────────────────────────────────────────────────────── --}}
@if($heroSlides->count())

{{-- Ada foto hero: tampilkan slider --}}
<section class="relative overflow-hidden bg-forest" style="height:520px;min-height:320px;">
    <div id="hero-slider" class="relative w-full h-full">
        @foreach($heroSlides as $i => $slide)
            <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                <img src="{{ $slide->image_url }}"
                     alt="{{ $slide->title ?? 'Slide ' . ($i + 1) }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent"></div>
                @if($slide->title || $slide->subtitle)
                    <div class="absolute inset-0 flex flex-col items-center justify-end pb-20 px-6 text-center z-10">
                        @if($slide->title)
                            <h2 class="text-white text-2xl md:text-4xl font-bold drop-shadow-lg mb-2">{{ $slide->title }}</h2>
                        @endif
                        @if($slide->subtitle)
                            <p class="text-white/90 text-sm md:text-lg drop-shadow max-w-xl">{{ $slide->subtitle }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach

        @if($heroSlides->count() > 1)
            <button onclick="prevHero()"
                    class="absolute left-3 md:left-5 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-black/30 hover:bg-black/50 backdrop-blur-sm text-white rounded-full flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button onclick="nextHero()"
                    class="absolute right-3 md:right-5 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-black/30 hover:bg-black/50 backdrop-blur-sm text-white rounded-full flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                @foreach($heroSlides as $i => $s)
                    <button onclick="goToHero({{ $i }})"
                            class="hero-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-white w-6' : 'bg-white/50 w-2' }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- CTA --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex flex-col sm:flex-row gap-3 w-full px-6 justify-center">
        <a href="{{ route('products') }}"
           class="bg-primary-500 hover:bg-primary-400 text-white font-semibold px-7 py-3 rounded-full transition shadow-lg text-sm text-center whitespace-nowrap">
            Lihat Semua Produk
        </a>
        @php $waNumber = \App\Models\SiteSetting::get('site_whatsapp', ''); @endphp
        @if($waNumber)
            <a href="https://wa.me/{{ $waNumber }}" target="_blank"
               class="bg-white/20 hover:bg-white/30 text-white font-semibold px-7 py-3 rounded-full border border-white/40 transition text-sm text-center whitespace-nowrap backdrop-blur-sm">
                Hubungi Kami
            </a>
        @endif
    </div>
</section>

<script>
(function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    const total  = slides.length;
    let current  = 0, timer;
    if (total <= 1) return;
    function goTo(i) {
        slides[current].classList.replace('opacity-100','opacity-0'); slides[current].classList.replace('z-10','z-0');
        if(dots[current]){dots[current].classList.remove('bg-white','w-6');dots[current].classList.add('bg-white/50','w-2');}
        current = (i+total)%total;
        slides[current].classList.replace('opacity-0','opacity-100'); slides[current].classList.replace('z-0','z-10');
        if(dots[current]){dots[current].classList.remove('bg-white/50','w-2');dots[current].classList.add('bg-white','w-6');}
    }
    function startAuto(){ timer = setInterval(()=>goTo(current+1), 4500); }
    function resetAuto(){ clearInterval(timer); startAuto(); }
    window.nextHero  = ()=>{goTo(current+1);resetAuto();};
    window.prevHero  = ()=>{goTo(current-1);resetAuto();};
    window.goToHero  = (i)=>{goTo(i);resetAuto();};
    startAuto();
})();
</script>

@else

{{-- Fallback hero --}}
<section class="relative bg-forest overflow-hidden">
    <div class="absolute inset-0 opacity-20"
         style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%2322c55e\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 text-center">
        <span class="inline-block bg-primary-400 text-forest text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">
            🌿 Toko Tanaman & Bibit Terpercaya
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
            {{ \App\Models\SiteSetting::get('hero_title', 'Temukan Tanaman Impian Anda') }}
        </h1>
        <p class="text-primary-200 text-lg md:text-xl max-w-2xl mx-auto mb-10">
            {{ \App\Models\SiteSetting::get('hero_subtitle', 'Koleksi tanaman hias & bibit berkualitas untuk rumah dan taman Anda') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products') }}" class="bg-primary-500 hover:bg-primary-400 text-white font-semibold px-8 py-4 rounded-full transition shadow-lg">
                Lihat Semua Produk
            </a>
            @php $waNumber = \App\Models\SiteSetting::get('site_whatsapp', ''); @endphp
            @if($waNumber)
                <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                   class="bg-white/10 hover:bg-white/20 text-white font-semibold px-8 py-4 rounded-full border border-white/30 transition">
                    Hubungi Kami
                </a>
            @endif
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L1440 60L1440 30C1440 30 1080 0 720 0C360 0 0 30 0 30L0 60Z" fill="white"/>
        </svg>
    </div>
</section>

@endif

{{-- ── Kategori ──────────────────────────────────────────────────────────────── --}}
@if($categories->count())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-forest mb-3">Kategori Produk</h2>
            <p class="text-gray-500">Temukan tanaman yang Anda butuhkan dari berbagai kategori kami</p>
        </div>
        {{-- Desktop: grid --}}
        <div class="hidden sm:grid sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}"
                   class="group bg-primary-50 hover:bg-primary-100 rounded-2xl p-5 text-center transition-all duration-200 hover:shadow-md border border-primary-100">
                    @if($category->image_url)
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full overflow-hidden bg-primary-200">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    @else
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-primary-200 flex items-center justify-center">
                            <span class="text-2xl">🌿</span>
                        </div>
                    @endif
                    <h3 class="font-semibold text-forest text-sm">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $category->active_products_count }} produk</p>
                </a>
            @endforeach
        </div>
        {{-- Mobile: horizontal scroll --}}
        <div class="flex sm:hidden gap-3 overflow-x-auto pb-3 -mx-4 px-4 scrollbar-hide">
            @foreach($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}"
                   class="flex-shrink-0 group bg-primary-50 hover:bg-primary-100 rounded-2xl px-4 py-4 text-center transition-all duration-200 border border-primary-100 w-32">
                    @if($category->image_url)
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full overflow-hidden bg-primary-200">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-primary-200 flex items-center justify-center">
                            <span class="text-xl">🌿</span>
                        </div>
                    @endif
                    <h3 class="font-semibold text-forest text-xs leading-tight">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $category->active_products_count }} produk</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Produk Unggulan ───────────────────────────────────────────────────────── --}}
@if($featuredProducts->count())
<section class="py-16 bg-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-forest mb-2">Produk Unggulan</h2>
                <p class="text-gray-500">Pilihan terbaik dari koleksi kami</p>
            </div>
            <a href="{{ route('products') }}" class="text-primary-700 hover:text-primary-800 font-semibold text-sm hidden sm:flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($featuredProducts as $product)
                @include('public.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Tentang Kami ──────────────────────────────────────────────────────────── --}}
<section id="tentang" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Teks kiri --}}
            <div>
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-forest mt-2 mb-5">
                    {{ \App\Models\SiteSetting::get('about_title', 'Tentang Yuda Bibit') }}
                </h2>
                <p class="text-gray-600 leading-relaxed text-lg mb-6">
                    {{ \App\Models\SiteSetting::get('about_content', '') }}
                </p>
                <div class="grid grid-cols-3 gap-4 mt-8">
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <div class="text-2xl font-bold text-forest">{{ \App\Models\Product::where('is_active', true)->count() }}+</div>
                        <div class="text-xs text-gray-500 mt-1">Produk</div>
                    </div>
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <div class="text-2xl font-bold text-forest">{{ \App\Models\Category::where('is_active', true)->count() }}</div>
                        <div class="text-xs text-gray-500 mt-1">Kategori</div>
                    </div>
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <div class="text-2xl font-bold text-forest">100%</div>
                        <div class="text-xs text-gray-500 mt-1">Kualitas</div>
                    </div>
                </div>
            </div>

            {{-- Slider foto Tentang Kami (kanan) --}}
            <div class="relative">
                @if($aboutSlides->count())
                    <div id="about-slider" class="relative rounded-3xl overflow-hidden shadow-xl" style="height:380px;">
                        @foreach($aboutSlides as $i => $slide)
                            <div class="about-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                                <img src="{{ $slide->image_url }}"
                                     alt="{{ $slide->title ?? 'Foto ' . ($i + 1) }}"
                                     class="w-full h-full object-cover">
                                @if($slide->title)
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent px-5 py-4">
                                        <p class="text-white font-semibold text-sm">{{ $slide->title }}</p>
                                        @if($slide->subtitle)
                                            <p class="text-white/80 text-xs mt-0.5">{{ $slide->subtitle }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        @if($aboutSlides->count() > 1)
                            <button onclick="prevAbout()"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-black/30 hover:bg-black/50 text-white rounded-full flex items-center justify-center transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button onclick="nextAbout()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-black/30 hover:bg-black/50 text-white rounded-full flex items-center justify-center transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-20 flex gap-1.5">
                                @foreach($aboutSlides as $i => $s)
                                    <button onclick="goToAbout({{ $i }})"
                                            class="about-dot h-1.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-white w-5' : 'bg-white/50 w-1.5' }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <script>
                    (function(){
                        const slides = document.querySelectorAll('.about-slide');
                        const dots   = document.querySelectorAll('.about-dot');
                        const total  = slides.length;
                        let current  = 0, timer;
                        if(total<=1) return;
                        function goTo(i){
                            slides[current].classList.replace('opacity-100','opacity-0'); slides[current].classList.replace('z-10','z-0');
                            if(dots[current]){dots[current].classList.remove('bg-white','w-5');dots[current].classList.add('bg-white/50','w-1.5');}
                            current=(i+total)%total;
                            slides[current].classList.replace('opacity-0','opacity-100'); slides[current].classList.replace('z-0','z-10');
                            if(dots[current]){dots[current].classList.remove('bg-white/50','w-1.5');dots[current].classList.add('bg-white','w-5');}
                        }
                        function startAuto(){ timer=setInterval(()=>goTo(current+1),4000); }
                        function resetAuto(){ clearInterval(timer); startAuto(); }
                        window.nextAbout = ()=>{goTo(current+1);resetAuto();};
                        window.prevAbout = ()=>{goTo(current-1);resetAuto();};
                        window.goToAbout = (i)=>{goTo(i);resetAuto();};
                        startAuto();
                    })();
                    </script>

                @else
                    {{-- Fallback kotak hijau --}}
                    <div class="bg-forest rounded-3xl p-8 text-center text-white">
                        <div class="text-8xl mb-4">🌱</div>
                        <h3 class="text-xl font-bold mb-2">Tanaman Berkualitas</h3>
                        <p class="text-primary-200 text-sm">Setiap tanaman dipilih dengan cermat untuk memastikan kualitas terbaik sampai ke tangan Anda</p>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary-400 rounded-2xl opacity-30 -z-10"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-primary-600 rounded-full opacity-20 -z-10"></div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── Produk Terbaru ────────────────────────────────────────────────────────── --}}
@if($latestProducts->count())
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-forest mb-2">Produk Terbaru</h2>
                <p class="text-gray-500">Koleksi terbaru yang baru kami tambahkan</p>
            </div>
            <a href="{{ route('products') }}" class="text-primary-700 hover:text-primary-800 font-semibold text-sm hidden sm:flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
            @foreach($latestProducts as $product)
                @include('public.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── CTA WhatsApp ──────────────────────────────────────────────────────────── --}}
@php $waNumber = \App\Models\SiteSetting::get('site_whatsapp', ''); @endphp
@if($waNumber)
<section class="py-16 bg-forest">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ada Pertanyaan?</h2>
        <p class="text-primary-200 mb-8">Hubungi kami langsung melalui WhatsApp. Kami siap membantu Anda memilih tanaman yang tepat.</p>
        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode(\App\Models\SiteSetting::get('whatsapp_message', 'Halo, saya ingin bertanya.')) }}"
           target="_blank"
           class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-400 text-white font-bold px-8 py-4 rounded-full text-lg transition shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 32 32" fill="currentColor">
                <path d="M16.003 2.667C8.64 2.667 2.667 8.64 2.667 16c0 2.373.624 4.699 1.813 6.752L2.667 29.333l6.752-1.771A13.3 13.3 0 0016.003 29.333c7.36 0 13.33-5.973 13.33-13.333S23.363 2.667 16.003 2.667zm6.035 16.432c-.33-.165-1.952-.963-2.255-1.072-.304-.11-.525-.165-.747.165s-.856 1.072-1.05 1.293c-.193.22-.385.247-.716.083-.33-.165-1.395-.514-2.658-1.64-.981-.873-1.645-1.953-1.838-2.283-.193-.33-.021-.509.145-.673.149-.148.33-.385.495-.578.165-.193.22-.33.33-.55.11-.22.055-.413-.027-.578-.083-.165-.747-1.8-1.023-2.466-.27-.648-.543-.56-.747-.57l-.637-.011a1.22 1.22 0 00-.885.413c-.303.33-1.157 1.13-1.157 2.757s1.185 3.198 1.35 3.418c.165.22 2.332 3.563 5.65 4.994.79.34 1.406.543 1.886.695.793.25 1.515.215 2.086.13.636-.094 1.952-.798 2.228-1.568.275-.77.275-1.43.193-1.568-.082-.138-.303-.22-.633-.385z"/>
            </svg>
            Chat WhatsApp Sekarang
        </a>
    </div>
</section>
@endif

@endsection
