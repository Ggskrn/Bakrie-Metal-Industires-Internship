@extends('layouts.app')

@section('title', 'Dashboard Publik - KOP AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-white via-slate-50 to-amber-50/10 min-h-screen">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <!-- Header Dashboard -->
            <div class="bg-gradient-to-r from-bakrie-dark to-slate-900 text-white p-8 rounded-3xl shadow-xl mb-8 flex items-center justify-between">
                <div>
                    <span class="inline-block bg-bakrie-gold text-bakrie-dark px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase mb-3">
                        Dashboard Publik
                    </span>
                    <h1 class="text-3xl font-heading font-bold">Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-300 text-sm mt-1">Anda masuk sebagai <strong class="text-bakrie-gold">Anggota/Klien/Mitra</strong> KOP AJS</p>
                </div>
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-3xl">
                    👋
                </div>
            </div>

            <!-- Layanan Utama & Keanggotaan -->
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <!-- Info Status -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100/85">
                    <h3 class="text-xl font-heading font-extrabold text-bakrie-dark mb-4">ℹ️ Status Akun & Keanggotaan</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-2">
                            <span class="text-gray-500 text-sm">Status Anggota</span>
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-2">
                            <span class="text-gray-500 text-sm">Nomor Anggota</span>
                            <span class="font-mono text-sm text-gray-800">AJS-{{ str_pad(auth()->id(), 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Email Terdaftar</span>
                            <span class="text-sm text-gray-800">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- Program Menarik -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100/85">
                    <h3 class="text-xl font-heading font-extrabold text-bakrie-dark mb-4">🤝 Pengajuan Cepat</h3>
                    <p class="text-sm text-gray-500 mb-6">Ajukan program kemitraan atau pinjaman dengan proses online cepat.</p>
                    <div class="flex gap-4">
                        <a href="{{ route('services.simpanpinjam') }}" class="btn-primary flex-1 text-center py-3 text-sm">
                            Simpan Pinjam
                        </a>
                        <a href="{{ route('services.kemitraan') }}" class="btn-outline flex-1 text-center py-3 text-sm">
                            Kemitraan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ornamen Informasi Dashboard -->
            <div class="bg-amber-50/70 border border-amber-200/60 p-6 rounded-3xl flex items-start gap-4">
                <span class="text-2xl mt-1">💡</span>
                <div>
                    <h4 class="font-bold text-amber-900 text-sm">Informasi Pelayanan KOP AJS</h4>
                    <p class="text-amber-800 text-xs mt-1 leading-relaxed">
                        Terima kasih telah mempercayakan kebutuhan finansial dan sembako Anda kepada KOP AJS. Silakan hubungi kami melalui tombol WhatsApp jika Anda memerlukan bantuan operasional lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
