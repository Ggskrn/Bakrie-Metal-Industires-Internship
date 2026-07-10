    @extends('layouts.app')

    @section('title', 'Simpan Pinjam - KOP AJS')

    @section('content')
    <section class="pt-32 pb-20 bg-gradient-to-br from-white via-amber-50/20 to-blue-50/30 relative overflow-hidden">
        <!-- Ornamen Latar Belakang (Aesthetic Background Ornaments) -->
        <div class="absolute top-20 right-0 w-96 h-96 bg-bakrie-gold/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-10 left-0 w-80 h-80 bg-blue-100/30 rounded-full blur-3xl -z-10"></div>
        
        <!-- Grid pattern ornament -->
        <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px] opacity-40 -z-10"></div>

        <div class="container-custom relative">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb dengan ornamen modern -->
                <nav class="text-xs text-gray-500 mb-6 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hover:text-bakrie-gold transition font-medium">Beranda</a> 
                    <span class="text-gray-300">/</span>
                    <a href="{{ route('services') }}" class="hover:text-bakrie-gold transition font-medium">Layanan</a> 
                    <span class="text-gray-300">/</span>
                    <span class="text-bakrie-dark font-semibold">Simpan Pinjam</span>
                </nav>

                <!-- Header Utama dengan Badge Verifikasi/Kepercayaan -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase mb-4 border border-emerald-200 shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 11.37h1.581a5.554 5.554 0 005.455 5.008 5.14 5.14 0 003.542-1.39l1.077 1.077a7.14 7.14 0 01-4.619 1.813c-3.666 0-6.7-2.73-7.036-6.508zM17.834 8.63h-1.581a5.554 5.554 0 00-5.455-5.007 5.14 5.14 0 00-3.542 1.39L5.179 3.936a7.14 7.14 0 014.619-1.813c3.666 0 6.7 2.73 7.036 6.508z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Resmi & Terverifikasi Kemenkop UKM
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-dark leading-tight">
                        Koperasi <span class="text-bakrie-gold">Simpan Pinjam</span>
                    </h1>
                    <div class="w-24 h-1 bg-bakrie-gold rounded-full mx-auto mt-4"></div>
                    <p class="text-gray-600 text-lg mt-6 leading-relaxed max-w-2xl mx-auto">
                        Fasilitas keuangan mandiri khusus anggota untuk membantu kebutuhan darurat, pendidikan, serta permodalan pengembangan usaha dengan bunga super ringan.
                    </p>
                </div>

                <!-- Box Layanan Simpanan & Pinjaman (Lebih Terang, Eye-Catching) -->
                <div class="grid md:grid-cols-2 gap-8 mb-10">
                    <!-- Card Simpanan -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl border-t-4 border-bakrie-gold border-x border-b border-gray-100/80 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-inner">
                                🏦
                            </div>
                            <h3 class="text-2xl font-heading font-extrabold text-bakrie-dark">Simpanan Anggota</h3>
                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">Menabung aman dengan imbal hasil bagi hasil (SHU) yang transparan.</p>
                            
                            <ul class="mt-6 space-y-4">
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-bakrie-gold text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Simpanan Pokok <span class="text-xs text-gray-400 font-normal">(dibayar sekali saat daftar)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-bakrie-gold text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Simpanan Wajib <span class="text-xs text-gray-400 font-normal">(iuran bulanan berkala)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-bakrie-gold text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Simpanan Sukarela <span class="text-xs text-gray-400 font-normal">(setoran bebas kapan saja)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-bakrie-gold text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Simpanan Berjangka <span class="text-xs text-gray-400 font-normal">(deposito bagi hasil optimal)</span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-4 border-t border-gray-50 text-xs text-gray-400 flex items-center gap-2">
                            <span>🛡️ Simpanan aman dijamin Koperasi BMI</span>
                        </div>
                    </div>

                    <!-- Card Pinjaman -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl border-t-4 border-bakrie-gold border-x border-b border-gray-100/80 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-inner">
                                💸
                            </div>
                            <h3 class="text-2xl font-heading font-extrabold text-bakrie-dark">Pinjaman Amanah</h3>
                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">Solusi dana segar darurat & modal usaha dengan cicilan tetap.</p>
                            
                            <ul class="mt-6 space-y-4">
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Pinjaman Karyawan <span class="text-xs text-emerald-600 font-normal">(tanpa agunan tambahan)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Pinjaman Usaha <span class="text-xs text-gray-400 font-normal">(bantuan permodalan UMKM)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold">✓</span>
                                    <span class="text-gray-700 font-medium">Pinjaman Multiguna <span class="text-xs text-gray-400 font-normal">(kebutuhan darurat / sekolah)</span></span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold">✓</span>
                                    <span class="text-emerald-700 font-bold">Bunga Rendah Mulai 1% <span class="text-xs text-emerald-600 font-normal">(tenur fleksibel)</span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-4 border-t border-gray-50 text-xs text-gray-400 flex items-center gap-2">
                            <span>🛡️ Proses pengajuan cepat & transparan</span>
                        </div>
                    </div>
                </div>

                <!-- Syarat & Ketentuan (Desain Lebih Rapi & Profesional) -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100/90 shadow-lg relative overflow-hidden mb-12">
                    <!-- Decorative Gold Accent Strip -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-bakrie-gold to-yellow-400"></div>
                    
                    <h3 class="text-xl font-heading font-extrabold text-bakrie-dark mb-4 flex items-center gap-2">
                        📋 Syarat & Ketentuan Pengajuan
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-600 mt-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-bakrie-gold rounded-full"></span>
                                <span>Telah terdaftar sebagai anggota aktif minimal 6 bulan.</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-bakrie-gold rounded-full"></span>
                                <span>Melunasi simpanan pokok dan wajib secara berkala.</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-bakrie-gold rounded-full"></span>
                                <span>Mengisi formulir pengajuan resmi yang disediakan pengurus.</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-bakrie-gold rounded-full"></span>
                                <span>Melampirkan KTP, Slip Gaji terbaru, dan rekomendasi HRD.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ornamen Badge Kepercayaan Baru (Trust & Credibility Banners) -->
                <div class="bg-gradient-to-r from-bakrie-dark to-slate-900 text-white p-8 rounded-3xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-3xl">
                            🔒
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-lg text-bakrie-gold">Keamanan Terjamin</h4>
                            <p class="text-xs text-gray-300 mt-1 max-w-md">Koperasi AJS PT Bakrie Metal Industries beroperasi secara transparan dan berbadan hukum resmi.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="btn-primary px-8 py-3 rounded-xl hover:shadow-lg transition-all duration-300">Ajukan Sekarang</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endsection