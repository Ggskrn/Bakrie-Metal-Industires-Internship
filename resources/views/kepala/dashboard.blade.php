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

    {{-- ======================================================= --}}
    {{-- TAB: KIRIM CATATAN                                      --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'kirim'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">📢</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Kirim Catatan ke Admin</h2>
                <p class="text-xs text-gray-400 mt-0.5">Berikan koreksi, instruksi, atau arahan langsung ke dashboard Administrator.</p>
            </div>
        </div>

        <div class="max-w-2xl text-left">
            <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm">
                <form action="{{ route('kepala.announce') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Isi Catatan / Instruksi</label>
                        <textarea name="message" rows="6" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-sm focus:border-blue-500 focus:ring focus:ring-blue-100 text-slate-800 dark:text-white" placeholder="Contoh: Tolong sesuaikan harga sembako beras premium..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3.5 rounded-xl transition shadow cursor-pointer text-sm">
                        Kirim Catatan ➔
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: RIWAYAT CATATAN                                    --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'riwayat'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">📋</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Riwayat Catatan &amp; Klarifikasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">Semua instruksi yang terkirim beserta balasan dari Admin.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
            @forelse($announcements as $ann)
            <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-6 rounded-2xl text-left space-y-3">
                <div>
                    <span class="text-[10px] text-gray-400 font-bold block mb-1">📅 Dikirim: {{ $ann->created_at->format('d M Y, H:i') }}</span>
                    <p class="text-sm text-slate-800 dark:text-gray-200 pl-3 border-l-2 border-blue-300 font-medium">{{ $ann->message }}</p>
                </div>
                <div class="pt-3 border-t border-dashed dark:border-slate-700">
                    @if($ann->reply)
                    <div class="bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-250 dark:border-emerald-900/40 p-4 rounded-xl">
                        <p class="text-xs text-emerald-800 dark:text-emerald-400 font-bold">✅ Klarifikasi Admin:</p>
                        <p class="text-sm text-slate-700 dark:text-gray-300 mt-1">{{ $ann->reply }}</p>
                    </div>
                    @else
                    <span class="text-xs text-amber-600 dark:text-amber-400 italic">⏳ Menunggu balasan dari Administrator...</span>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm py-12 text-center">Belum ada riwayat.</p>
            @endforelse
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