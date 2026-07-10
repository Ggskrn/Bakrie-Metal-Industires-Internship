@extends('layouts.app')

@section('title', 'Konsultasi Keuangan - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-indigo-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Layanan</a> &gt;
                <span class="text-bakrie-dark font-semibold">Konsultasi Keuangan</span>
            </nav>

            <div class="text-center mb-12">
                <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Edukasi</span>
                <h1 class="section-title text-center inline-block">Konsultasi Keuangan</h1>
                <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-2"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Layanan konsultasi keuangan dan manajemen usaha bagi anggota yang ingin mengembangkan bisnis atau mengatur keuangan keluarga.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Layanan</h3>
                    <ul class="mt-4 space-y-3 text-gray-600">
                        <li>✓ Perencanaan keuangan pribadi</li>
                        <li>✓ Manajemen arus kas usaha</li>
                        <li>✓ Analisis investasi</li>
                        <li>✓ Strategi pengelolaan utang</li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Keuntungan</h3>
                    <ul class="mt-4 space-y-3 text-gray-600">
                        <li>✓ Konselor profesional bersertifikat</li>
                        <li>✓ Gratis untuk anggota aktif</li>
                        <li>✓ Jadwal fleksibel (online/offline)</li>
                        <li>✓ Materi disesuaikan kebutuhan</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('contact') }}" class="btn-primary inline-block">Jadwalkan Konsultasi</a>
            </div>
        </div>
    </div>
</section>
@endsection