@extends('layouts.app')

@section('title', 'Pelayanan Anggota - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-purple-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Layanan</a> &gt;
                <span class="text-bakrie-dark font-semibold">Pelayanan Anggota</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Layanan</span>
                <h1 class="section-title text-center inline-block">Pelayanan Anggota</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Pendaftaran anggota, pembaruan data, dan informasi program koperasi dengan layanan ramah dan cepat.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">📝</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Pendaftaran</h4>
                    <p class="text-sm text-gray-600 mt-2">Proses pendaftaran mudah, cukup bawa KTP dan fotokopi.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">🔄</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Update Data</h4>
                    <p class="text-sm text-gray-600 mt-2">Perbarui data diri dan keanggotaan secara berkala.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center border border-gray-100">
                    <span class="text-4xl">📢</span>
                    <h4 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Informasi</h4>
                    <p class="text-sm text-gray-600 mt-2">Dapatkan info terbaru tentang program dan kegiatan koperasi.</p>
                </div>
            </div>

            <div class="mt-10 bg-bakrie-gold/10 p-8 rounded-2xl border border-bakrie-gold/20">
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Jam Layanan</h3>
                <p class="text-gray-600 mt-2">Senin – Jumat: 08.00 – 16.00 WIB (kecuali hari libur nasional)</p>
                <p class="text-gray-600">Sabtu & Minggu: Tutup (layanan darurat via WhatsApp)</p>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('contact') }}" class="btn-primary inline-block">Daftar Anggota</a>
            </div>
        </div>
    </div>
</section>
@endsection