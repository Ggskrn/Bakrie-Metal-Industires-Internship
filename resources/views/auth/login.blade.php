<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KOP AJS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-white via-amber-50/20 to-blue-50/30 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-bakrie-dark to-slate-900 px-8 py-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-bakrie-gold rounded-lg flex items-center justify-center font-heading font-extrabold text-bakrie-dark text-sm">AJS</div>
                <div><p class="font-heading font-bold text-white text-lg leading-tight">KOP AJS</p><p class="text-[10px] text-gray-300 font-semibold tracking-wider">ANDAL · JAYA · SEJAHTERA</p></div>
            </div>
        </div>
        <div class="p-8">
            <h2 class="text-2xl font-heading font-bold text-bakrie-dark">Selamat Datang</h2>
            <p class="text-gray-500 text-sm mt-1">Masuk ke akun Koperasi Anda</p>
            <form method="POST" action="{{ route('login') }}" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 transition">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 transition">
                </div>
                <button type="submit" class="w-full bg-bakrie-gold text-bakrie-dark font-bold py-3 rounded-xl hover:bg-amber-400 transition shadow-lg">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>