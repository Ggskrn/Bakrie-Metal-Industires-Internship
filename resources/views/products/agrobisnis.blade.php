@extends('layouts.app')

@section('title', 'Agrobisnis & Infrastruktur - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-green-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Produk</a> &gt;
                <span class="text-bakrie-dark font-semibold">Agrobisnis & Infrastruktur</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Produk Terpadu</span>
                <h1 class="section-title text-center inline-block">Agrobisnis & Infrastruktur</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Solusi rantai pasok agrobisnis dan fasilitas infrastruktur untuk mendukung industri pangan dan logistik.</p>
            </div>

            <div class="space-y-8">
                <!-- Silo & Cold Storage -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">🏭</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Silo, Pergudangan & Cold Storage</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Koperasi menyediakan sewa fasilitas penyimpanan berskala nasional, seperti fasilitas rantai dingin (cold storage) untuk logistik hasil bumi/makanan atau pergudangan logistik.</p>
                        </div>
                    </div>
                </div>

                <!-- Agro-Industri Terpadu -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">🌱</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Agro-Industri Terpadu</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Produk hasil olahan pertanian/perkebunan (misalnya: pupuk subsidi, pakan ternak, atau beras grosir) yang dibeli langsung oleh korporasi sebagai offtaker utama.</p>
                            <span class="inline-block mt-3 text-sm text-bakrie-gold font-semibold">📍 MICRA Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 bg-gradient-to-r from-bakrie-dark to-gray-900 text-white p-8 rounded-2xl text-center">
                <h3 class="text-2xl font-heading font-bold text-bakrie-gold">Kemitraan Strategis</h3>
                <p class="text-gray-300 mt-2">Kami siap menjadi mitra andal untuk kebutuhan agrobisnis dan infrastruktur Anda.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block bg-bakrie-gold text-bakrie-dark px-8 py-3 rounded-lg font-semibold hover:bg-amber-400 transition">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>
@endsection