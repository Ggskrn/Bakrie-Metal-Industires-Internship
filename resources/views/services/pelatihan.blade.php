@extends('layouts.app')

@section('title', 'Pelatihan & Edukasi - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-teal-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Layanan</a> &gt;
                <span class="text-bakrie-dark font-semibold">Pelatihan & Edukasi</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Pemberdayaan</span>
                <h1 class="section-title text-center inline-block">Pelatihan & Edukasi</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Workshop dan pelatihan kewirausahaan, literasi keuangan, dan manajemen usaha untuk anggota dan masyarakat.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Program Pelatihan</h3>
                    <ul class="mt-4 space-y-3 text-gray-600">
                        <li>✓ Kewirausahaan (memulai dan mengelola bisnis)</li>
                        <li>✓ Literasi keuangan (pengelolaan keuangan pribadi & usaha)</li>
                        <li>✓ Manajemen UMKM (operasional, pemasaran, keuangan)</li>
                        <li>✓ Digital marketing (media sosial, e-commerce)</li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Keunggulan</h3>
                    <ul class="mt-4 space-y-3 text-gray-600">
                        <li>✓ Trainer berpengalaman dan bersertifikat</li>
                        <li>✓ Sertifikat keikutsertaan</li>
                        <li>✓ Kelas gratis untuk anggota aktif</li>
                        <li>✓ Metode praktis dan studi kasus nyata</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 bg-bakrie-gold/10 p-8 rounded-2xl border border-bakrie-gold/20">
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Jadwal Pelatihan Mendatang</h3>
                <ul class="mt-3 space-y-2 text-gray-600">
                    <li>📅 15 Juli 2026: "Cara Memulai Usaha Sembako"</li>
                    <li>📅 22 Juli 2026: "Manajemen Keuangan untuk UMKM"</li>
                    <li>📅 29 Juli 2026: "Digital Marketing untuk Pemula"</li>
                </ul>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('contact') }}" class="btn-primary inline-block">Daftar Pelatihan</a>
            </div>
        </div>
    </div>
</section>
@endsection