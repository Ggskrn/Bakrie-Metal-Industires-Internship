@extends('layouts.app')

@section('title', 'Pengadaan & Logistik - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-blue-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Produk</a> &gt;
                <span class="text-bakrie-dark font-semibold">Pengadaan & Logistik</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Produk Korporat</span>
                <h1 class="section-title text-center inline-block">Pengadaan & Logistik</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Solusi pengadaan skala industri dan logistik untuk korporasi dan mitra bisnis.</p>
            </div>

            <!-- Konten Utama -->
            <div class="space-y-8">
                <!-- Komoditas & Bahan Baku -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">🌾</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Komoditas & Bahan Baku</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Pengadaan bahan baku skala industri seperti CPO, hasil perkebunan, atau komponen manufaktur dalam jumlah besar (grosir) untuk kebutuhan lini produksi korporasi.</p>
                            <span class="inline-block mt-3 text-sm text-bakrie-gold font-semibold">📍 pasardana.id</span>
                        </div>
                    </div>
                </div>

                <!-- Aset Mesin & Alat Berat -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">🏗️</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Aset Mesin & Alat Berat</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Penyediaan atau penyewaan mesin, kendaraan operasional, dan peralatan berat (biasanya melalui skema pengadaan bersama antar-koperasi skala besar).</p>
                        </div>
                    </div>
                </div>

                <!-- Produk Finansial Skala Korporat -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">💰</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Fasilitas Pembiayaan Korporasi</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Pinjaman likuiditas jangka pendek hingga menengah atau fasilitas kredit modal kerja untuk mitra bisnis rantai pasok (vendor/supplier) perusahaan Anda.</p>
                            <span class="inline-block mt-3 text-sm text-bakrie-gold font-semibold">📍 KSP Delta Surya Purnama</span>
                        </div>
                    </div>
                </div>

                <!-- Reksa Dana & Penyertaan Modal -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl">📈</span>
                        <div>
                            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Reksa Dana & Penyertaan Modal</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">Produk investasi bagi hasil di mana korporasi dapat menanamkan modal atau membeli instrumen surat utang/obligasi yang diterbitkan oleh koperasi berskala besar.</p>
                            <span class="inline-block mt-3 text-sm text-bakrie-gold font-semibold">📍 Wikipedia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="mt-12 bg-gradient-to-r from-bakrie-dark to-gray-900 text-white p-8 rounded-2xl text-center">
                <h3 class="text-2xl font-heading font-bold text-bakrie-gold">Butuh Solusi Logistik Korporasi?</h3>
                <p class="text-gray-300 mt-2">Hubungi tim kami untuk konsultasi dan penawaran khusus.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block bg-bakrie-gold text-bakrie-dark px-8 py-3 rounded-lg font-semibold hover:bg-amber-400 transition">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>
@endsection