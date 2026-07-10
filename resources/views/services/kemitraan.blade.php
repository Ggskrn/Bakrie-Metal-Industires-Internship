@extends('layouts.app')

@section('title', 'Kemitraan Usaha - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-amber-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Layanan</a> &gt;
                <span class="text-bakrie-dark font-semibold">Kemitraan Usaha</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Kolaborasi</span>
                <h1 class="section-title text-center inline-block">Kemitraan Usaha</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Program kemitraan dengan UMKM dan distributor lokal untuk menyediakan produk berkualitas dengan harga kompetitif.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">🤝</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Supplier Terpercaya</h4>
                    <p class="text-sm text-gray-600 mt-2">Mitra pemasok bahan baku dan produk jadi dengan kualitas terjamin.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">📦</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Harga Grosir</h4>
                    <p class="text-sm text-gray-600 mt-2">Harga khusus untuk anggota dan mitra dengan volume pembelian tertentu.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">🌐</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Jaringan Luas</h4>
                    <p class="text-sm text-gray-600 mt-2">Akses ke jaringan pemasaran dan distribusi yang terintegrasi.</p>
                </div>
            </div>

            <div class="mt-12 bg-bakrie-dark text-white p-8 rounded-2xl text-center">
                <h3 class="text-2xl font-heading font-bold text-bakrie-gold">Bergabung sebagai Mitra</h3>
                <p class="text-gray-300 mt-2">Kami membuka peluang kemitraan untuk UMKM dan distributor di seluruh Indonesia.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block bg-bakrie-gold text-bakrie-dark px-8 py-3 rounded-lg font-semibold hover:bg-amber-400 transition">Daftar Mitra</a>
            </div>
        </div>
    </div>
</section>
@endsection