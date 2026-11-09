<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | {{ \App\Models\SiteSetting::get('site_name', 'Yuda Bibit') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-forest min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        {{-- Logo / Brand --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary-400 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-forest font-bold text-2xl">🌿</span>
            </div>
            <h1 class="text-2xl font-bold text-white">{{ \App\Models\SiteSetting::get('site_name', 'Yuda Bibit') }}</h1>
            <p class="text-primary-300 text-sm mt-1">Panel Admin</p>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-lg font-bold text-forest mb-4 text-center">Masuk ke Dashboard</h2>

            {{-- Noted hanya admin --}}
            <div class="flex items-start gap-2 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mb-5">
                <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs text-amber-700 leading-relaxed">
                    Halaman ini <span class="font-semibold">hanya untuk Admin</span>. Jika Anda bukan admin, silakan
                    <a href="{{ route('home') }}" class="underline hover:text-amber-900">kembali ke website</a>.
                </p>
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="email"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent text-sm transition @error('email') border-red-400 @enderror"
                           placeholder="admin@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent text-sm transition"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-primary-600">
                    <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                </div>

                <button type="submit"
                        class="w-full bg-forest hover:bg-primary-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-primary-400 text-xs mt-6">
            <a href="{{ route('home') }}" class="hover:text-white transition">← Kembali ke Website</a>
        </p>
    </div>

</body>
</html>
