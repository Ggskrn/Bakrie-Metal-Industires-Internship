@extends('layouts.app')

@section('title', 'KOP AJS – Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center bg-bakrie-dark overflow-hidden pt-20">
    <div class="absolute inset-0 opacity-20">
        <img src="{{ asset('images/hero-sembako.jpg') }}" alt="Sembako" class="w-full h-full object-cover">
    </div>
    <div class="container-custom relative z-10">
        <div class="max-w-3xl">
            <span class="inline-block bg-bakrie-gold text-bakrie-dark px-4 py-1 rounded-full text-sm font-semibold mb-6">
                🛒 Koperasi Karyawan BMI
            </span>
            <h1 class="text-4xl md:text-6xl font-heading font-extrabold text-white leading-tight">
                {{ $kontenBeranda->title ?? 'Sembako Berkualitas untuk Semua' }}
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mt-6 leading-relaxed max-w-2xl">
                {{ $kontenBeranda->description ?? 'Koperasi BMI menyediakan sembako murah dan berkualitas bagi karyawan, keluarga, dan masyarakat sekitar. Bergabunglah dan nikmati manfaatnya!' }}
            </p>
            <div class="flex flex-wrap gap-4 mt-8">
                <a href="{{ route('products.sembako') }}" class="btn-primary">Lihat Produk</a>
                <a href="{{ route('contact') }}" class="btn-outline">Daftar Anggota</a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Statistik Koperasi -->
<section class="py-16 bg-white border-b border-gray-100">
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-gold">{{ number_format($totalAnggota) }}+</p>
                <p class="text-gray-600 font-semibold mt-1">Anggota Aktif</p>
            </div>
            <div>
                <p class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-gold">Rp 2.5M</p>
                <p class="text-gray-600 font-semibold mt-1">SHU (2025)</p>
            </div>
            <div>
                <p class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-gold">50+</p>
                <p class="text-gray-600 font-semibold mt-1">Produk Sembako</p>
            </div>
            <div>
                <p class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-gold">100%</p>
                <p class="text-gray-600 font-semibold mt-1">Kepuasan Anggota</p>
            </div>
        </div>
    </div>
</section>



<!-- Program Unggulan -->
<section class="py-20 bg-bakrie-dark text-white">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Program</span>
            <h2 class="section-title text-center inline-block text-white">Kegiatan Koperasi</h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Berbagai program untuk kesejahteraan anggota dan masyarakat.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/program-1.jpg') }}" alt="Pasar Murah" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h4 class="font-heading font-bold text-lg">Pasar Murah</h4>
                    <p class="text-gray-300 text-sm">Setiap bulan untuk anggota</p>
                </div>
            </div>
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/program-2.jpg') }}" alt="Bantuan Sembako" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h4 class="font-heading font-bold text-lg">Bantuan Sembako</h4>
                    <p class="text-gray-300 text-sm">Untuk karyawan yang membutuhkan</p>
                </div>
            </div>
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/program-3.jpg') }}" alt="Pelatihan Usaha" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h4 class="font-heading font-bold text-lg">Pelatihan Wirausaha</h4>
                    <p class="text-gray-300 text-sm">Bagi anggota dan masyarakat</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('projects') }}" class="btn-primary">Lihat Semua Program</a>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section class="py-20 bg-gray-50">
    <div class="container-custom text-center">
        <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Testimoni</span>
        <h2 class="section-title text-center inline-block">Apa Kata Anggota</h2>
        <div class="grid md:grid-cols-3 gap-8 mt-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <p class="text-gray-600 italic">"Sembako di koperasi murah dan kualitasnya bagus. Sangat membantu kebutuhan keluarga."</p>
                <p class="font-bold text-bakrie-dark mt-4">- Andi, Karyawan BMI</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <p class="text-gray-600 italic">"SHU yang dibagikan setiap tahun benar-benar bermanfaat. Koperasi BMI terbaik!"</p>
                <p class="font-bold text-bakrie-dark mt-4">- Siti, Anggota Koperasi</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <p class="text-gray-600 italic">"Pelatihan usaha dari koperasi membantu saya memulai toko kelontong."</p>
                <p class="font-bold text-bakrie-dark mt-4">- Rudi, Masyarakat sekitar</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-bakrie-gold">
    <div class="container-custom text-center">
        <h2 class="text-3xl md:text-4xl font-heading font-extrabold text-bakrie-dark">Bergabung Menjadi Anggota</h2>
        <p class="text-bakrie-dark/80 text-lg mt-4 max-w-2xl mx-auto">Dapatkan akses sembako murah dan berbagai manfaat lainnya.</p>
        <a href="{{ route('contact') }}" class="mt-8 inline-block bg-bakrie-dark text-white font-semibold px-8 py-4 rounded-lg hover:bg-black transition">Daftar Sekarang</a>
    </div>
</section>
@endsection