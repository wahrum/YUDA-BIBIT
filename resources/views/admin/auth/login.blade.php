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
            <h2 class="text-lg font-bold text-forest mb-6 text-center">Masuk ke Dashboard</h2>

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
