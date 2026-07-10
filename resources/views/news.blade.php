@extends('layouts.app')

@section('title', 'Berita & Kegiatan - KOP-AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-white via-slate-50 to-amber-50/10 min-h-screen">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="text-bakrie-gold font-bold text-xs tracking-widest uppercase bg-amber-50 px-4 py-1.5 rounded-full border border-amber-200">Kabar Terbaru</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-dark mt-4">Berita &amp; Kegiatan</h1>
            <div class="w-20 h-1 bg-bakrie-gold rounded-full mx-auto mt-4"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Informasi terakurat seputar perkembangan, program, dan transparansi kegiatan di KOP-AJS.</p>
        </div>

        @php
            // Ambil berita dinamis yang statusnya 'approved'
            $dbBeritas = \App\Models\Berita::where('status', 'approved')->latest()->get();
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($dbBeritas as $news)
            <div class="bg-white rounded-3xl shadow-lg hover:shadow-xl overflow-hidden border border-gray-200 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="h-56 bg-slate-100 relative">
                        @if($news->image)
                            <img src="{{ asset('images/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 text-5xl">📰</div>
                        @endif
                        <span class="absolute top-4 left-4 bg-bakrie-gold text-bakrie-dark text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full shadow">
                            Info Koperasi
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <p class="text-xs text-gray-400 font-semibold">{{ $news->created_at->format('d M Y') }}</p>
                        <h3 class="text-xl font-heading font-extrabold text-bakrie-dark leading-snug hover:text-bakrie-gold transition">{{ $news->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed truncate-3-lines">{{ $news->content }}</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-xs text-slate-400">Oleh: Admin</span>
                        <span class="text-bakrie-gold font-bold text-xs hover:underline cursor-pointer">Baca Selengkapnya &rarr;</span>
                    </div>
                </div>
            </div>
            @empty
            <!-- Default / Fallback Berita Estetik -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-200 flex flex-col justify-between">
                <div class="h-56 bg-slate-100 relative flex items-center justify-center text-4xl">📊</div>
                <div class="p-6">
                    <span class="text-xs bg-amber-50 text-bakrie-gold font-bold px-3 py-1 rounded-full">Koperasi</span>
                    <h3 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Pembagian SHU KOP-AJS Berjalan Lancar</h3>
                    <p class="text-gray-600 text-sm mt-2">KOP-AJS telah mendistribusikan SHU secara transparan kepada seluruh anggota koperasi aktif untuk kesejahteraan bersama.</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-200 flex flex-col justify-between">
                <div class="h-56 bg-slate-100 relative flex items-center justify-center text-4xl">🛒</div>
                <div class="p-6">
                    <span class="text-xs bg-amber-50 text-bakrie-gold font-bold px-3 py-1 rounded-full">Sembako</span>
                    <h3 class="text-lg font-heading font-bold text-bakrie-dark mt-3">Pasar Murah Bulanan Karyawan</h3>
                    <p class="text-gray-600 text-sm mt-2">Penyediaan beras, minyak, dan gula dengan harga subsidi khusus untuk anggota KOP-AJS.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection