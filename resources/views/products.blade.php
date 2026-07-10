@extends('layouts.app')

@section('title', 'Produk Sembako - Koperasi AJS')

@section('content')
<section class="pt-32 pb-20 bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Belanja</span>
            <h1 class="section-title text-center inline-block">Daftar Sembako</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Semua kebutuhan pokok tersedia dengan harga khusus untuk anggota.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Produk 1: Beras -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-beras.jpeg') }}" alt="Beras Premium" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Beras Premium</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Beras kualitas super, pulen, kemasan 5kg dan 10kg.</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 5kg: Rp 65.000</li>
                        <li>✓ 10kg: Rp 125.000</li>
                        <li>✓ Asli dari petani lokal</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>

            <!-- Produk 2: Minyak Goreng -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-minyak.jpg') }}" alt="Minyak Goreng" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Minyak Goreng</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Minyak goreng berkualitas, kemasan 1L dan 2L.</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 1L: Rp 18.000</li>
                        <li>✓ 2L: Rp 35.000</li>
                        <li>✓ Bebas kolesterol</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>

            <!-- Produk 3: Gula Pasir -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-gula.jpg') }}" alt="Gula Pasir" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Gula Pasir</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Gula pasir putih berkualitas, kemasan 1kg.</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 1kg: Rp 17.000</li>
                        <li>✓ Bersih dan manis</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>

            <!-- Produk 4: Telur Ayam -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-telur.JPEG') }}" alt="Telur Ayam" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Telur Ayam</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Telur ayam segar, kemasan 1 tray (30 butir).</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 1 tray: Rp 55.000</li>
                        <li>✓ Segar dari peternak lokal</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>

            <!-- Produk 5: Tepung Terigu -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-terigu.jpg') }}" alt="Tepung Terigu" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Tepung Terigu</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Tepung terigu serbaguna, kemasan 1kg.</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 1kg: Rp 12.000</li>
                        <li>✓ Untuk roti, kue, dan gorengan</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>

            <!-- Produk 6: Susu Kental Manis -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                <img src="{{ asset('images/product-susu.JPEG') }}" alt="Susu Kental Manis" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-heading font-bold text-bakrie-dark">Susu Kental Manis</h3>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">Susu kental manis kemasan 380ml.</p>
                    <ul class="mt-4 space-y-1 text-sm text-gray-500">
                        <li>✓ 380ml: Rp 15.000</li>
                        <li>✓ Manis dan bergizi</li>
                    </ul>
                    <span class="mt-3 inline-block bg-bakrie-gold/20 text-bakrie-dark text-xs font-semibold px-3 py-1 rounded-full">Stok Tersedia</span>
                </div>
            </div>
        </div>

        <!-- Info Keuntungan Anggota -->
        <div class="mt-16 bg-bakrie-dark text-white p-8 rounded-2xl">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-2xl font-heading font-bold text-bakrie-gold">Keuntungan Anggota</h3>
                    <p class="text-gray-300 mt-2 leading-relaxed">Harga khusus, diskon tambahan, dan bagi hasil (SHU) setiap tahun untuk anggota aktif.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-3xl font-heading font-bold text-bakrie-gold">10%</p>
                        <p class="text-sm text-gray-400">Diskon untuk anggota</p>
                    </div>
                    <div>
                        <p class="text-3xl font-heading font-bold text-bakrie-gold">Rp 500K</p>
                        <p class="text-sm text-gray-400">Rata-rata SHU/tahun</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection