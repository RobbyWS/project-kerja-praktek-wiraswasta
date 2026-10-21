<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <a href="{{ url('/') }}" class="block text-center text-2xl font-bold text-yellow-400 mb-8">
            {{ config('app.name') }}
        </a>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-2xl font-bold mb-1">Masuk</h1>
            <p class="text-sm text-gray-500 mb-6">Silakan login ke akun Anda.</p>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded">
                    Ingat saya
                </label>

                <button type="submit"
                        class="w-full bg-yellow-400 text-gray-900 font-semibold py-3 rounded-lg hover:bg-yellow-300">
                    Masuk
                </button>
            </form>
        </div>

        <a href="{{ url('/') }}" class="block text-center text-sm text-gray-400 mt-6 hover:text-yellow-400">
            &larr; Kembali ke beranda
        </a>
    </div>

</body>
</html>