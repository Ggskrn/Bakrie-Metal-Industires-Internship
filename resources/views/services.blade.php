@extends('layouts.app')

@section('title', 'Layanan - Koperasi BMI')

@section('content')
<section class="pt-32 pb-20 bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <span class="text-bakrie-gold font-semibold text-sm tracking-wider uppercase">Layanan</span>
            <h1 class="section-title text-center inline-block">Layanan Koperasi BMI</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Berbagai layanan kami hadir untuk mendukung kesejahteraan anggota dan kemitraan usaha.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Layanan 1: Koperasi -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">🏢</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Koperasi Simpan Pinjam</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Fasilitas simpan pinjam dengan bunga ringan untuk anggota, membantu kebutuhan darurat dan pengembangan usaha.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Bunga rendah</li>
                    <li>✓ Proses cepat</li>
                    <li>✓ Tenor fleksibel</li>
                </ul>
            </div>

            <!-- Layanan 2: Kemitraan Usaha -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">🤝</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Kemitraan Usaha</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Program kemitraan dengan UMKM dan distributor lokal untuk menyediakan sembako berkualitas dengan harga kompetitif.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Supplier terpercaya</li>
                    <li>✓ Harga grosir</li>
                    <li>✓ Jaringan luas</li>
                </ul>
            </div>

            <!-- Layanan 3: Konsultasi -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">📊</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Konsultasi Keuangan</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Layanan konsultasi keuangan dan manajemen usaha bagi anggota yang ingin mengembangkan bisnis atau mengatur keuangan keluarga.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Konselor profesional</li>
                    <li>✓ Gratis untuk anggota</li>
                    <li>✓ Jadwal fleksibel</li>
                </ul>
            </div>

            <!-- Layanan 4: Pelayanan Anggota -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">🛍️</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Pelayanan Anggota</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Pendaftaran anggota, pembaruan data, dan informasi program koperasi dengan layanan ramah dan cepat.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Pendaftaran mudah</li>
                    <li>✓ Update berkala</li>
                    <li>✓ Customer service 24/7</li>
                </ul>
            </div>

            <!-- Layanan 5: Pemasaran Produk -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">📦</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Pemasaran Produk</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Bantuan pemasaran untuk produk UMKM binaan melalui jaringan koperasi dan platform digital.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Promosi di toko koperasi</li>
                    <li>✓ Marketplace online</li>
                    <li>✓ Event pameran</li>
                </ul>
            </div>

            <!-- Layanan 6: Pelatihan -->
            <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100 transition hover:shadow-md">
                <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-3xl">🎓</span>
                </div>
                <h3 class="text-xl font-heading font-bold text-bakrie-dark">Pelatihan & Edukasi</h3>
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    Workshop dan pelatihan kewirausahaan, literasi keuangan, dan manajemen usaha untuk anggota dan masyarakat.
                </p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✓ Trainer berpengalaman</li>
                    <li>✓ Sertifikat</li>
                    <li>✓ Kelas gratis</li>
                </ul>
            </div>
        </div>

        <!-- CTA Daftar Anggota -->
        <div class="mt-16 text-center">
            <h3 class="text-2xl font-heading font-bold text-bakrie-dark">Tertarik Menjadi Anggota?</h3>
            <p class="text-gray-600 mt-2">Dapatkan akses ke semua layanan dan kemudahan berbelanja sembako.</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-4 inline-block">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection