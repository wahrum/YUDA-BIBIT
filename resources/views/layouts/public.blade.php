<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ \App\Models\SiteSetting::get('site_description', '') }}">
    <title>@yield('title', \App\Models\SiteSetting::get('site_name', 'Yuda Bibit'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 antialiased">

    {{-- ── Navbar ──────────────────────────────────────────────────────────── --}}
    @php
        $siteName = \App\Models\SiteSetting::get('site_name', 'Yuda Bibit');
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
    @endphp

    <header class="bg-forest sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo / Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if($siteLogo)
                        <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-auto">
                    @else
                        <div class="w-9 h-9 bg-primary-400 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-forest" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm0 3a1 1 0 011 1v1.586l1.707 1.707a1 1 0 01-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 01-1.414-1.414L8 8.586V6a1 1 0 011-1z"/>
                            </svg>
                        </div>
                    @endif
                    <span class="text-white font-bold text-xl">{{ $siteName }}</span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-primary-200 hover:text-white transition font-medium {{ request()->routeIs('home') ? 'text-white' : '' }}">Beranda</a>
                    <a href="{{ route('products') }}" class="text-primary-200 hover:text-white transition font-medium {{ request()->routeIs('products*') ? 'text-white' : '' }}">Produk</a>
                    <a href="{{ route('home') }}#tentang" class="text-primary-200 hover:text-white transition font-medium">Tentang</a>
                    <a href="{{ route('home') }}#kontak" class="text-primary-200 hover:text-white transition font-medium">Kontak</a>

                    {{-- Tombol Login Admin --}}
                    <a href="{{ route('admin.login') }}"
                       class="flex items-center gap-1.5 text-primary-200 hover:text-white border border-primary-400/40 hover:border-white/60 px-3 py-1.5 rounded-lg text-sm transition font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Admin
                    </a>
                </nav>

                {{-- Mobile hamburger --}}
                <button id="mobile-menu-btn" class="md:hidden text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Nav --}}
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block text-primary-200 hover:text-white py-2 font-medium">Beranda</a>
                <a href="{{ route('products') }}" class="block text-primary-200 hover:text-white py-2 font-medium">Produk</a>
                <a href="{{ route('home') }}#tentang" class="block text-primary-200 hover:text-white py-2 font-medium">Tentang</a>
                <a href="{{ route('home') }}#kontak" class="block text-primary-200 hover:text-white py-2 font-medium">Kontak</a>
                {{-- Login Admin Mobile --}}
                <div class="border-t border-primary-800/40 pt-2 mt-2">
                    <a href="{{ route('admin.login') }}"
                       class="flex items-center gap-2 text-primary-300 hover:text-white py-2 font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- ── Konten Utama ─────────────────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── Footer ──────────────────────────────────────────────────────────── --}}
    <footer class="bg-forest-dark text-primary-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Brand --}}
                <div>
                    <h3 class="text-white font-bold text-xl mb-3">{{ $siteName }}</h3>
                    <p class="text-sm leading-relaxed">{{ \App\Models\SiteSetting::get('site_tagline', '') }}</p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="text-white font-semibold mb-3">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('products') }}" class="hover:text-white transition">Produk</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#kontak" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div id="kontak">
                    <h4 class="text-white font-semibold mb-3">Kontak Kami</h4>
                    <ul class="space-y-2 text-sm">
                        @if(\App\Models\SiteSetting::get('site_address'))
                            <li class="flex gap-2">
                                <span>📍</span>
                                <span>{{ \App\Models\SiteSetting::get('site_address') }}</span>
                            </li>
                        @endif
                        @if(\App\Models\SiteSetting::get('site_phone'))
                            <li class="flex gap-2">
                                <span>📞</span>
                                <a href="tel:{{ \App\Models\SiteSetting::get('site_phone') }}" class="hover:text-white transition">
                                    {{ \App\Models\SiteSetting::get('site_phone') }}
                                </a>
                            </li>
                        @endif
                        @if(\App\Models\SiteSetting::get('site_email'))
                            <li class="flex gap-2">
                                <span>✉️</span>
                                <a href="mailto:{{ \App\Models\SiteSetting::get('site_email') }}" class="hover:text-white transition">
                                    {{ \App\Models\SiteSetting::get('site_email') }}
                                </a>
                            </li>
                        @endif
                        @if(\App\Models\SiteSetting::get('site_instagram'))
                            <li class="flex gap-2">
                                <span>📷</span>
                                <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('site_instagram') }}" target="_blank" class="hover:text-white transition">
                                    {{ '@' . \App\Models\SiteSetting::get('site_instagram') }}
                                </a>
                            </li>
                        @endif
                        @if(\App\Models\SiteSetting::get('site_facebook'))
                            <li class="flex gap-2">
                                <span>👥</span>
                                <a href="https://facebook.com/{{ \App\Models\SiteSetting::get('site_facebook') }}" target="_blank" class="hover:text-white transition">
                                    {{ \App\Models\SiteSetting::get('site_facebook') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-primary-900 mt-8 pt-6 text-center text-xs text-primary-400">
                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- ── Tombol WhatsApp Floating ─────────────────────────────────────────── --}}
    @php
        $waNumber  = \App\Models\SiteSetting::get('site_whatsapp', '');
        $waMessage = \App\Models\SiteSetting::get('whatsapp_message', 'Halo, saya ingin bertanya.');
    @endphp
    @if($waNumber)
        <div class="whatsapp-float">
            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}"
               target="_blank"
               rel="noopener noreferrer"
               class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white pl-4 pr-3 py-3 rounded-full shadow-lg transition-all duration-300 group"
               title="Chat di WhatsApp">
                <span class="text-sm font-semibold whitespace-nowrap hidden sm:inline">Butuh Bantuan? Chat di WA</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 flex-shrink-0" viewBox="0 0 32 32" fill="currentColor">
                    <path d="M16.003 2.667C8.64 2.667 2.667 8.64 2.667 16c0 2.373.624 4.699 1.813 6.752L2.667 29.333l6.752-1.771A13.3 13.3 0 0016.003 29.333c7.36 0 13.33-5.973 13.33-13.333S23.363 2.667 16.003 2.667zm0 24.267a11 11 0 01-5.627-1.547l-.403-.24-4.005 1.051 1.067-3.893-.264-.413a10.967 10.967 0 01-1.68-5.893c0-6.075 4.944-11.013 11.013-11.013 6.072 0 11.013 4.938 11.013 11.013 0 6.072-4.941 11.013-11.013 11.013v-.08zm6.035-8.235c-.33-.165-1.952-.963-2.255-1.072-.304-.11-.525-.165-.747.165s-.856 1.072-1.05 1.293c-.193.22-.385.247-.716.083-.33-.165-1.395-.514-2.658-1.64-.981-.873-1.645-1.953-1.838-2.283-.193-.33-.021-.509.145-.673.149-.148.33-.385.495-.578.165-.193.22-.33.33-.55.11-.22.055-.413-.027-.578-.083-.165-.747-1.8-1.023-2.466-.27-.648-.543-.56-.747-.57l-.637-.011a1.22 1.22 0 00-.885.413c-.303.33-1.157 1.13-1.157 2.757s1.185 3.198 1.35 3.418c.165.22 2.332 3.563 5.65 4.994.79.34 1.406.543 1.886.695.793.25 1.515.215 2.086.13.636-.094 1.952-.798 2.228-1.568.275-.77.275-1.43.193-1.568-.082-.138-.303-.22-.633-.385z"/>
                </svg>
            </a>
        </div>
    @endif

    {{-- ── Scripts ──────────────────────────────────────────────────────────── --}}
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
