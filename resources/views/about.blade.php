@extends('layouts.app')

@section('title', 'Tentang Koperasi BMI')

@section('content')
<section class="pt-32 pb-20 bg-gray-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Tentang Kami</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-dark mt-2">
                {{ $kontenTentang->title ?? 'Koperasi Sejahtera BMI' }}
            </h1>
            <div class="w-20 h-1 bg-bakrie-gold rounded-full mt-4"></div>

            <div class="mt-10 space-y-6 text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                {{ $kontenTentang->description ?? 'Koperasi Karyawan PT Bakrie Metal Industries didirikan pada tahun 1995 dengan tujuan meningkatkan kesejahteraan karyawan melalui penyediaan sembako berkualitas, simpan pinjam, dan program pemberdayaan ekonomi.' }}
            </div>

            <!-- Visi & Misi -->
            <div class="grid md:grid-cols-2 gap-8 mt-16">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-bakrie-gold/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-bakrie-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Visi</h3>
                    <p class="text-gray-600 mt-2 leading-relaxed">Menjadi koperasi karyawan terbaik di Indonesia yang mandiri dan profesional.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-bakrie-gold/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-bakrie-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Misi</h3>
                    <ul class="text-gray-600 mt-2 space-y-2 list-disc list-inside">
                        <li>Menyediakan sembako berkualitas dengan harga terjangkau</li>
                        <li>Mengembangkan usaha simpan pinjam untuk anggota</li>
                        <li>Memberdayakan anggota melalui pelatihan dan program usaha</li>
                        <li>Menjaga transparansi dan akuntabilitas koperasi</li>
                    </ul>
                </div>
            </div>

            <!-- Struktur Pengurus -->
            <div class="mt-16 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-2xl font-heading font-bold text-bakrie-dark text-center mb-6">Pengurus Koperasi</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-center">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="font-bold text-bakrie-dark">Ketua</p>
                        <p class="text-sm text-gray-600">Bapak A. Hidayat</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="font-bold text-bakrie-dark">Sekretaris</p>
                        <p class="text-sm text-gray-600">Ibu S. Rahayu</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="font-bold text-bakrie-dark">Bendahara</p>
                        <p class="text-sm text-gray-600">Bapak T. Wijaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection