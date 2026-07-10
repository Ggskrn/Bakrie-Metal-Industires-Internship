@extends('layouts.app')

@section('title', 'Produk Sembako - Koperasi AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-bakrie-gold">Beranda</a> &gt;
                <a href="#" class="hover:text-bakrie-gold">Produk</a> &gt;
                <span class="text-bakrie-dark font-semibold">Sembako</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-dark">Sembako Berkualitas</h1>
            <div class="w-20 h-1 bg-bakrie-gold rounded-full mt-4"></div>
            <p class="text-gray-600 text-lg mt-6 leading-relaxed">Kebutuhan pokok sehari-hari dengan harga khusus untuk anggota.</p>

            <!-- Daftar produk sembako (sama seperti sebelumnya) -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                    <img src="{{ asset('images/'.$product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-heading font-bold text-bakrie-dark">{{ $product['name'] }}</h3>
                        <p class="text-gray-600 text-sm mt-2">{{ $product['desc'] }}</p>
                        <ul class="mt-4 space-y-1 text-sm text-gray-500">
                            @foreach($product['details'] as $detail)
                            <li>✓ {{ $detail }}</li>
                            @endforeach
                        </ul>
                        <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection