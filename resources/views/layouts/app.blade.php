<!DOCTYPE html>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Koperasi PT Bakrie Metal Industries - Sembako Berkualitas untuk Semua">
    <title>@yield('title', 'KOP AJS – Koperasi Andal Jaya Sejahtera')</title>
    <meta name="description" content="KOP AJS – Koperasi terpercaya yang menyediakan produk sembako, layanan keuangan, dan kemitraan usaha untuk kesejahteraan anggota dan masyarakat.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-white via-slate-50 to-amber-50/10 text-gray-800 antialiased min-h-screen">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-24rem)]">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>