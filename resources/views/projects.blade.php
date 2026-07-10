@extends('layouts.app')

@section('title', 'Proyek - PT Bakrie Metal Industries')

@section('content')
<section class="pt-32 pb-20 bg-white">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Portofolio</span>
            <h1 class="section-title text-center inline-block">Proyek Unggulan BMI</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Kami telah mengerjakan berbagai proyek strategis nasional dengan melibatkan koperasi dan mitra lokal.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Proyek 1 -->
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/project-1.jpg') }}" alt="JPO Mas Mansyur" class="w-full h-80 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="font-heading font-bold text-xl text-white">JPO Mas Mansyur</h3>
                    <p class="text-gray-300 text-sm">Jakarta Pusat</p>
                    <span class="inline-block mt-2 bg-bakrie-gold text-bakrie-dark text-xs font-semibold px-5 py-3 rounded-full">Koperasi & Mitra</span>
                </div>
            </div>

            <!-- Proyek 2 -->
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/project-2.jpg') }}" alt="Jembatan Mahakam" class="w-full h-80 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="font-heading font-bold text-xl text-white">Jembatan Mahakam</h3>
                    <p class="text-gray-300 text-sm">Kaltim</p>
                    <span class="inline-block mt-2 bg-bakrie-gold text-bakrie-dark text-xs font-semibold px-5 py-3 rounded-full">Koperasi & Mitra</span>
                </div>
            </div>

            <!-- Proyek 3 -->
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/project-3.jpg') }}" alt="Proyek Geothermal" class="w-full h-80 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="font-heading font-bold text-xl text-white">Proyek Geothermal</h3>
                    <p class="text-gray-300 text-sm">Energi Terbarukan</p>
                    <span class="inline-block mt-2 bg-bakrie-gold text-bakrie-dark text-xs font-semibold px-5 py-3 rounded-full">Koperasi & Mitra</span>
                </div>
            </div>

            <!-- Proyek 4 -->
            <div class="group relative overflow-hidden rounded-xl">
                <img src="{{ asset('images/project-4.JPEG') }}" alt="Jalan Tol Cipularang" class="w-full h-80 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-bakrie-dark via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="font-heading font-bold text-xl text-white">Jalan Tol Cipularang</h3>
                    <p class="text-gray-300 text-sm">Jawa Barat</p>
                    <span class="inline-block mt-2 bg-bakrie-gold text-bakrie-dark text-xs font-semibold px-5 py-3 rounded-full">Koperasi & Mitra</span>
                </div>
            </div>
        </div>

        <!-- CTA Kerjasama -->
        <div class="mt-16 text-center">
            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Tertarik untuk Mitra Koperasi?</h3>
            <p class="text-gray-600 mt-2">Hubungi tim kami untuk informasi kemitraan dan program koperasi binaan.</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-4 inline-block">Hubungi Kami</a>
        </div>
    </div>
</section>
@endsection