@extends('layouts.kepala')
@section('content')
<div class="p-8 space-y-8 transition-colors duration-200">

    {{-- NOTIFIKASI TOAST --}}
    @if(session('success_approval') || session('success_kepala_pesan') || session('success'))
    <div class="bg-white dark:bg-slate-800 border-l-4 border-blue-500 p-4 rounded-2xl shadow-md flex items-center justify-between border border-gray-100 dark:border-slate-700 animate-slide-in">
        <div class="flex items-center gap-3">
            <span class="text-xl">✨</span>
            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                {{ session('success_approval') ?? session('success_kepala_pesan') ?? session('success') }}
            </p>
        </div>
        <button class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    {{-- MODAL POP-UP BALASAN DARI ADMIN --}}
    @if(isset($unreadRepliesCount) && $unreadRepliesCount > 0)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm"
         x-data="{ showModal: true }" x-show="showModal">
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-md w-full shadow-2xl border border-blue-200 dark:border-slate-700 text-center">
            <div class="w-16 h-16 bg-blue-100 dark:bg-blue-950/30 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">💬</div>
            <h3 class="text-xl font-heading font-extrabold text-slate-800 dark:text-white">Balasan Klarifikasi Baru!</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm mt-2 leading-relaxed">
                Terdapat <strong class="text-emerald-600 dark:text-emerald-450">{{ $unreadRepliesCount }} balasan baru</strong> dari Administrator.
            </p>
            <button @click="showModal = false; setTab('riwayat')"
                    class="mt-6 w-full bg-blue-600 text-white font-extrabold py-3 rounded-xl hover:bg-blue-700 transition cursor-pointer">
                Lihat Balasan Sekarang
            </button>
        </div>
    </div>
    @endif

    {{-- ======================================================= --}}
    {{-- TAB: OVERVIEW                                           --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'overview'" class="space-y-8" x-cloak>
        {{-- Banner Selamat Datang --}}
        <div class="bg-gradient-to-r from-blue-100/40 via-indigo-50/10 to-transparent p-8 rounded-3xl border border-blue-200/40 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-4 text-left">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-md text-white">
                    👑
                </div>
                <div>
                    <h2 class="text-2xl font-heading font-extrabold text-bakrie-dark dark:text-white">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-0.5">Otorisasi persetujuan draft berita, stok sembako, rincian konten, dan kirim revisi ke Admin.</p>
                </div>
            </div>
            <span class="text-xs bg-blue-100 dark:bg-blue-950/50 text-blue-800 dark:text-blue-400 font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Kepala Koperasi KOP-AJS</span>
        </div>

        {{-- Ringkasan Status Pending Approval --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-amber-400 text-center">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Sembako Pending</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $pendingStoks->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-blue-400 text-center">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Berita Pending</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $pendingBeritas->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-emerald-400 text-center">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Minat Pending</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $pendingMinats->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-pink-400 text-center">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Konten Pending</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $pendingKontens->count() }}</p>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <button @click="setTab('approval')" class="bg-white dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-amber-200 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">⏳</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-blue-600">Menunggu Approval</h4>
                <p class="text-xs text-gray-400 mt-1">Review dan publish draft pending (Waiting List)</p>
            </button>
            <button @click="setTab('kirim')" class="bg-white dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-blue-100 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📢</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-blue-600">Kirim Catatan</h4>
                <p class="text-xs text-gray-400 mt-1">Kirim instruksi koreksi kepada Administrator</p>
            </button>
            <button @click="setTab('riwayat')" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-slate-200 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📋</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-blue-600">Riwayat Catatan</h4>
                <p class="text-xs text-gray-400 mt-1">Lihat balasan klarifikasi dari Admin</p>
            </button>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: WAITING LIST APPROVAL (Koleksi Menunggu Approval) --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'approval'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">⏳</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Waiting List Approval</h2>
                <p class="text-xs text-gray-400 mt-0.5">Semua permohonan pembaruan data dan informasi yang diajukan oleh Administrator.</p>
            </div>
        </div>

        <div class="space-y-8">
            
            {{-- 1. WAITING LIST: KONTEN PRODUK & LAYANAN --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-slate-800 dark:text-white border-b dark:border-slate-700 pb-3 flex items-center gap-2 text-left">
                    📝 Waiting List: Draft Konten &amp; Rincian Layanan
                    <span class="bg-indigo-100 dark:bg-indigo-950 text-indigo-800 dark:text-indigo-400 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingKontens->count() }}</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($pendingKontens as $konten)
                    <div class="bg-indigo-50/50 dark:bg-slate-900/30 border border-indigo-100 dark:border-slate-700 p-5 rounded-2xl space-y-3 text-left">
                        <div>
                            <span class="text-[9px] bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-400 font-extrabold px-2.5 py-1 rounded-lg">Draft Rincian</span>
                            <h4 class="font-extrabold text-sm text-slate-800 dark:text-white mt-3">{{ $konten->draft_title ?? $konten->title }}</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 italic">"{{ $konten->draft_description ?? $konten->description }}"</p>
                        </div>
                        <div class="text-xs space-y-1 bg-white dark:bg-slate-800 p-3 rounded-xl">
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Syarat:</p>
                            <p class="text-slate-700 dark:text-gray-300 font-medium">{{ $konten->draft_syarat ?? 'Tidak ada syarat khusus' }}</p>
                            <p class="text-[10px] text-gray-400 uppercase font-bold pt-2">Info Biaya / Harga:</p>
                            <p class="text-emerald-600 dark:text-emerald-450 font-bold">{{ $konten->draft_harga_info ?? 'Gratis' }}</p>
                        </div>
                        <div class="flex justify-end gap-2 pt-2 border-t dark:border-slate-700">
                            <form action="{{ route('kepala.konten.reject', $konten->id) }}" method="POST">
                                @csrf
                                <button class="bg-red-50 dark:bg-red-950/20 hover:bg-red-100 text-red-600 text-xs font-bold py-2 px-4 rounded-xl transition cursor-pointer">Tolak</button>
                            </form>
                            <form action="{{ route('kepala.konten.approve', $konten->id) }}" method="POST">
                                @csrf
                                <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2 px-5 rounded-xl transition cursor-pointer">Setujui &amp; Publish</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-400 text-xs py-4 col-span-2 text-center">Tidak ada antrean draft konten.</p>
                    @endforelse
                </div>
            </div>

            {{-- 2. WAITING LIST: STATISTIK MINAT ANGGOTA & MITRA --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-slate-800 dark:text-white border-b dark:border-slate-700 pb-3 flex items-center gap-2 text-left">
                    📊 Waiting List: Draft Statistik Peminat
                    <span class="bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-400 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingMinats->count() }}</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($pendingMinats as $minat)
                    @php
                        $cats = \App\Models\MinatData::categories();
                        $meta = $cats[$minat->category] ?? ['title' => $minat->category, 'icon' => '📂'];
                    @endphp
                    <div class="bg-emerald-50/50 dark:bg-slate-900/30 border border-emerald-100 dark:border-slate-700 p-5 rounded-2xl space-y-3 text-left">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">{{ $meta['icon'] }}</span>
                            <div>
                                <h4 class="font-bold text-xs text-slate-800 dark:text-white">{{ $meta['title'] }}</h4>
                                <p class="text-[10px] text-gray-400">Periode: {{ \App\Models\MinatData::monthName($minat->month) }} {{ $minat->year }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-center text-xs">
                            <div class="bg-white dark:bg-slate-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-400 font-bold">Anggota</p>
                                <strong class="text-blue-600 dark:text-blue-400 text-sm">{{ $minat->draft_anggota }}</strong>
                            </div>
                            <div class="bg-white dark:bg-slate-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-400 font-bold">Mitra</p>
                                <strong class="text-pink-600 dark:text-pink-400 text-sm">{{ $minat->draft_mitra }}</strong>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 pt-2 border-t dark:border-slate-700">
                            <form action="{{ route('kepala.minat.reject', $minat->id) }}" method="POST">
                                @csrf
                                <button class="bg-red-50 dark:bg-red-950/20 hover:bg-red-100 text-red-600 text-xs font-bold py-1.5 px-3 rounded-lg transition cursor-pointer">Tolak</button>
                            </form>
                            <form action="{{ route('kepala.minat.approve', $minat->id) }}" method="POST">
                                @csrf
                                <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-4 rounded-lg transition cursor-pointer">Setuju</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-400 text-xs py-4 col-span-3 text-center">Tidak ada antrean draft data minat.</p>
                    @endforelse
                </div>
            </div>

            {{-- 3. WAITING LIST: STOK & BERITA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Sembako Pending --}}
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white border-b dark:border-slate-700 pb-3 flex items-center gap-2 text-left">
                        🛒 Waiting List: Draft Sembako
                        <span class="bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-400 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingStoks->count() }}</span>
                    </h3>
                    <div class="space-y-4 max-h-[350px] overflow-y-auto">
                        @forelse($pendingStoks as $stok)
                        <div class="bg-amber-50/50 dark:bg-slate-900/30 border border-amber-200 dark:border-slate-700 p-4 rounded-2xl text-left space-y-3">
                            <h4 class="font-bold text-sm text-slate-800 dark:text-white">{{ $stok->draft_product_name ?? $stok->product_name }}</h4>
                            <div class="grid grid-cols-2 gap-2 text-xs text-center">
                                <div class="bg-white dark:bg-slate-800 p-2 rounded-lg">
                                    <p class="text-[9px] text-gray-400">Qty Baru</p>
                                    <strong class="text-slate-800 dark:text-white">{{ $stok->draft_qty ?? $stok->qty }}</strong>
                                </div>
                                <div class="bg-white dark:bg-slate-800 p-2 rounded-lg">
                                    <p class="text-[9px] text-gray-400">Harga Baru</p>
                                    <strong class="text-emerald-600 dark:text-emerald-450">Rp {{ number_format($stok->draft_price ?? $stok->price, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('kepala.stok.reject', $stok->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-red-50 dark:bg-red-950/20 hover:bg-red-100 text-red-600 text-xs font-bold py-1.5 px-3 rounded-lg transition cursor-pointer">Tolak</button>
                                </form>
                                <form action="{{ route('kepala.stok.approve', $stok->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-4 rounded-lg transition cursor-pointer">Setuju</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 text-xs py-8 text-center">Tidak ada draft sembako.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Berita Pending --}}
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white border-b dark:border-slate-700 pb-3 flex items-center gap-2 text-left">
                        📰 Waiting List: Draft Berita
                        <span class="bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-400 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingBeritas->count() }}</span>
                    </h3>
                    <div class="space-y-4 max-h-[350px] overflow-y-auto">
                        @forelse($pendingBeritas as $news)
                        <div class="bg-blue-50/50 dark:bg-slate-900/30 border border-blue-200 dark:border-slate-700 p-4 rounded-2xl text-left space-y-3">
                            <h4 class="font-bold text-sm text-slate-800 dark:text-white">{{ $news->draft_title ?? $news->title }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $news->draft_content ?? $news->content }}</p>
                            <div class="flex justify-end gap-2 pt-2 border-t dark:border-slate-700">
                                <form action="{{ route('kepala.berita.reject', $news->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-red-50 dark:bg-red-950/20 hover:bg-red-100 text-red-600 text-xs font-bold py-1.5 px-3 rounded-lg transition cursor-pointer">Tolak</button>
                                </form>
                                <form action="{{ route('kepala.berita.approve', $news->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-1.5 px-4 rounded-lg transition cursor-pointer">Setuju</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 text-xs py-8 text-center">Tidak ada draft berita.</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- ===================== TAB: HALAMAN UTAMA ===================== --}}
    <div x-show="['beranda', 'tentang', 'hubungi_kami', 'jumlah_anggota', 'halaman_utama'].includes(activeTab)" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         style="display:none;">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 p-6 md:p-8 shadow-xl mb-6">
            <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%221%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4z%22/%3E%3C/g%3E%3C/svg%3E')]"></div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Pantau Halaman Utama</h1>
                    <p class="mt-2 text-blue-100 text-sm md:text-base max-w-lg">
                        Lihat konten Beranda, Tentang, Hubungi Kami, dan Jumlah Anggota yang tampil di halaman utama website.
                    </p>
                </div>
                <div class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-xl px-4 py-3 text-white text-sm font-medium">
                    📅 {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        {{-- Grid Form Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Beranda --}}
            @php $kontenBeranda = $kontens['beranda'] ?? null; @endphp
            <div x-show="activeTab === 'beranda' || activeTab === 'halaman_utama'" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3 flex items-center gap-2">
                    <span class="text-white text-lg">🏠</span>
                    <h3 class="text-white font-bold text-sm">Konten Beranda</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Judul / Headline</label>
                        <input type="text" readonly value="{{ $kontenBeranda->draft_title ?? ($kontenBeranda->title ?? '') }}"
                               class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Deskripsi / Sub-headline</label>
                        <textarea rows="3" readonly
                                  class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white resize-none cursor-not-allowed">{{ $kontenBeranda->draft_description ?? ($kontenBeranda->description ?? '') }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        @if($kontenBeranda && $kontenBeranda->status === 'pending')
                            <span class="text-xs text-amber-600 dark:text-amber-400 font-semibold">⏳ Menunggu persetujuan Anda</span>
                        @else
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">✅ Terpublikasi</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tentang --}}
            @php $kontenTentang = $kontens['tentang'] ?? null; @endphp
            <div x-show="activeTab === 'tentang' || activeTab === 'halaman_utama'" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-5 py-3 flex items-center gap-2">
                    <span class="text-white text-lg">ℹ️</span>
                    <h3 class="text-white font-bold text-sm">Konten Tentang</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Judul</label>
                        <input type="text" readonly value="{{ $kontenTentang->draft_title ?? ($kontenTentang->title ?? '') }}"
                               class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Deskripsi</label>
                        <textarea rows="3" readonly
                                  class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white resize-none cursor-not-allowed">{{ $kontenTentang->draft_description ?? ($kontenTentang->description ?? '') }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        @if($kontenTentang && $kontenTentang->status === 'pending')
                            <span class="text-xs text-amber-600 dark:text-amber-400 font-semibold">⏳ Menunggu persetujuan Anda</span>
                        @else
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">✅ Terpublikasi</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Hubungi Kami --}}
            @php $kontenHubungi = $kontens['hubungi_kami'] ?? null; @endphp
            <div x-show="activeTab === 'hubungi_kami' || activeTab === 'halaman_utama'" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-5 py-3 flex items-center gap-2">
                    <span class="text-white text-lg">📞</span>
                    <h3 class="text-white font-bold text-sm">Konten Hubungi Kami</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Judul</label>
                        <input type="text" readonly value="{{ $kontenHubungi->draft_title ?? ($kontenHubungi->title ?? '') }}"
                               class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Deskripsi</label>
                        <textarea rows="3" readonly
                                  class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white resize-none cursor-not-allowed">{{ $kontenHubungi->draft_description ?? ($kontenHubungi->description ?? '') }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        @if($kontenHubungi && $kontenHubungi->status === 'pending')
                            <span class="text-xs text-amber-600 dark:text-amber-400 font-semibold">⏳ Menunggu persetujuan Anda</span>
                        @else
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">✅ Terpublikasi</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Jumlah Anggota --}}
            @php $kontenAnggota = $kontens['jumlah_anggota'] ?? null;
                 $dbMemberCount = $totalAnggota ?? 0;
            @endphp
            <div x-show="activeTab === 'jumlah_anggota' || activeTab === 'halaman_utama'" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-5 py-3 flex items-center gap-2">
                    <span class="text-white text-lg">👥</span>
                    <h3 class="text-white font-bold text-sm">Jumlah Anggota</h3>
                </div>
                <div class="p-5 space-y-4">
                    {{-- Live Stats --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-3 text-center">
                            <p class="text-xs text-purple-600 dark:text-purple-400 font-bold">Mendaftar di DB</p>
                            <p class="text-2xl font-extrabold text-purple-700 dark:text-purple-300 mt-1">{{ number_format($dbMemberCount) }}</p>
                        </div>
                        <div class="bg-pink-50 dark:bg-pink-900/20 rounded-xl p-3 text-center">
                            <p class="text-xs text-pink-600 dark:text-pink-400 font-bold">Total Tampil di Web</p>
                            @php
                                $baseCount = $kontenAnggota ? (int)($kontenAnggota->description ?? 0) : 0;
                                $totalDisplay = $baseCount + $dbMemberCount;
                            @endphp
                            <p class="text-2xl font-extrabold text-pink-700 dark:text-pink-300 mt-1">{{ number_format($totalDisplay) }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">
                                Angka Dasar Manual
                            </label>
                            <input type="number" readonly value="{{ $kontenAnggota->description ?? 0 }}"
                                   class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white cursor-not-allowed">
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Total = Manual + DB ({{ $dbMemberCount }} anggota)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- end grid --}}
    </div>

    {{-- ===================== TAB: PRODUK LIST ===================== --}}
    <div x-show="activeTab === 'produk_list'" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         style="display:none;">

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Produk Koperasi
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftar produk koperasi lengkap</p>
            </div>
        </div>

        <div class="mb-4">
            <div class="relative max-w-md">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Cari produk koperasi..." x-model="searchProduk"
                       class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-md overflow-hidden">
            <div class="bg-amber-500 px-5 py-3">
                <h3 class="text-white font-bold text-sm uppercase tracking-wider">Daftar Produk Koperasi</h3>
            </div>
            <div class="divide-y-2 divide-gray-200 dark:divide-slate-600">
                @foreach($kontens as $slug => $konten)
                @if(in_array($slug, ['sembako', 'pengadaan_logistik', 'agrobisnis_infrastruktur']))
                <div class="px-5 py-4 hover:bg-amber-50 dark:hover:bg-slate-700/30 transition-colors duration-150"
                     x-show="searchProduk === '' || '{{ strtolower($konten->title) }}'.includes(searchProduk.toLowerCase())">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-800 dark:text-slate-100">{{ $konten->title }}</p>
                            @if($konten->description)
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $konten->description }}</p>
                            @endif
                            <div class="flex items-center gap-3 mt-2">
                                @if($konten->harga_info)
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">💰 {{ Str::limit($konten->harga_info, 30) }}</span>
                                @endif
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                    {{ $konten->status === 'approved' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400' }}">
                                    {{ ucfirst($konten->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <button @click="setTab('prod_{{ $slug }}')"
                                    class="px-3 py-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-semibold rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                                Lihat Detail →
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===================== TAB: LAYANAN LIST ===================== --}}
    <div x-show="activeTab === 'layanan_list'" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         style="display:none;">

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Layanan Produksi
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftar layanan koperasi lengkap</p>
            </div>
        </div>

        <div class="mb-4">
            <div class="relative max-w-md">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Cari layanan..." x-model="searchLayanan"
                       class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-md overflow-hidden">
            <div class="bg-indigo-600 px-5 py-3">
                <h3 class="text-white font-bold text-sm uppercase tracking-wider">Daftar Layanan Koperasi</h3>
            </div>
            <div class="divide-y-2 divide-gray-200 dark:divide-slate-600">
                @foreach($kontens as $slug => $konten)
                @if(!in_array($slug, ['sembako', 'pengadaan_logistik', 'agrobisnis_infrastruktur', 'beranda', 'tentang', 'hubungi_kami', 'jumlah_anggota']))
                <div class="px-5 py-4 hover:bg-indigo-50 dark:hover:bg-slate-700/30 transition-colors duration-150"
                     x-show="searchLayanan === '' || '{{ strtolower($konten->title) }}'.includes(searchLayanan.toLowerCase())">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-800 dark:text-slate-100">{{ $konten->title }}</p>
                            @if($konten->description)
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $konten->description }}</p>
                            @endif
                            <div class="flex items-center gap-3 mt-2">
                                @if($konten->harga_info)
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">💰 {{ Str::limit($konten->harga_info, 30) }}</span>
                                @endif
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                    {{ $konten->status === 'approved' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400' }}">
                                    {{ ucfirst($konten->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <button @click="setTab('lay_{{ $slug }}')"
                                    class="px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                Lihat Detail →
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB DINAMIS: 3 PRODUK & 6 LAYANAN                       --}}
    {{-- ======================================================= --}}
    @php
        $dynTabs = \App\Models\MinatData::categories();
    @endphp

    @foreach($dynTabs as $slug => $meta)
    <div x-show="activeTab === '{{ $meta['type'] == 'produk' ? 'prod_' . $slug : 'lay_' . $slug }}'" class="space-y-6" x-cloak>
        
        {{-- Header Tab --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-2xl" style="background-color: {{ $meta['color'] }}20">
                {{ $meta['icon'] }}
            </div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">{{ $meta['title'] }}</h2>
                <p class="text-xs text-gray-400 mt-0.5">Statistik peminatan serta rincian informasi {{ $meta['type'] }} yang terpublikasi.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Grafik Minat (2 Tahun) --}}
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 dark:text-white mb-4 text-left">📈 Grafik Peminat Bulanan (2 Tahun Terakhir)</h3>
                <div class="h-80 relative">
                    <canvas id="chart-kepala-{{ $slug }}"></canvas>
                </div>
            </div>

            {{-- Informasi Publikasi Saat Ini --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm text-left space-y-4">
                <h3 class="text-base font-bold text-slate-800 dark:text-white border-b dark:border-slate-700 pb-3">📄 Informasi Terpublikasi</h3>
                
                @php
                    $konten = $kontens[$slug] ?? null;
                @endphp

                <div class="space-y-3 text-xs">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Judul / Nama Layanan:</p>
                        <p class="text-slate-800 dark:text-white font-bold text-sm mt-0.5">{{ $konten ? $konten->title : $meta['title'] }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Deskripsi:</p>
                        <p class="text-slate-700 dark:text-gray-300 mt-0.5 font-medium leading-relaxed">{{ $konten ? $konten->description : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Persyaratan:</p>
                        <p class="text-slate-700 dark:text-gray-300 mt-0.5 leading-relaxed">{{ $konten ? $konten->syarat : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Biaya / Harga Info:</p>
                        <p class="text-emerald-600 dark:text-emerald-450 font-bold text-sm mt-0.5">{{ $konten ? $konten->harga_info : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

{{-- SCRIPT DRAWING CHART.JS SECARA DINAMIS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const minatDataRaw = @json($minatData);
        const categories = @json(array_keys($dynTabs));

        const monthsName = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

        // Hitung total pending approval & perbarui badge notifikasi
        const totalPending = {{ $pendingStoks->count() + $pendingBeritas->count() + $pendingMinats->count() + $pendingKontens->count() }};
        if (totalPending > 0) {
            const badge = document.getElementById('pending-badge-total');
            if (badge) badge.classList.remove('hidden');
        }

        categories.forEach(slug => {
            let filtered = minatDataRaw.filter(d => d.category === slug);
            filtered.sort((x, y) => {
                if (x.year !== y.year) return x.year - y.year;
                return x.month - y.month;
            });

            let recent = filtered.slice(-12);

            let labels = recent.map(d => monthsName[d.month] + ' ' + d.year);
            let anggotaData = recent.map(d => d.anggota);
            let mitraData = recent.map(d => d.mitra);

            const ctx = document.getElementById('chart-kepala-' + slug);
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Minat Anggota',
                            data: anggotaData,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Minat Mitra',
                            data: mitraData,
                            borderColor: '#EC4899',
                            backgroundColor: 'rgba(236, 72, 153, 0.1)',
                            borderWidth: 3,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.15)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        });
    });
</script>
@endsection