@extends('layouts.admin')
@section('content')
<div class="p-6 space-y-6 transition-colors duration-200">

    {{-- MODAL POP-UP CATATAN BARU DARI KEPALA --}}
    @if(isset($unreadCountForAdmin) && $unreadCountForAdmin > 0)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm"
         x-data="{ showModal: true }" x-show="showModal">
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-md w-full shadow-2xl border border-amber-200 dark:border-amber-900/50 text-center">
            <div class="w-16 h-16 bg-amber-100 dark:bg-amber-950/30 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">📢</div>
            <h3 class="text-xl font-heading font-extrabold text-slate-800 dark:text-white">Catatan Koreksi Baru!</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm mt-2 leading-relaxed">
                Halo Admin, terdapat <strong class="text-blue-600 dark:text-blue-400">{{ $unreadCountForAdmin }} catatan revisi baru</strong> dari Kepala Koperasi.
            </p>
            <button @click="showModal = false; setTab('catatan')"
                    class="mt-6 w-full bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold py-3 rounded-xl hover:opacity-90 transition cursor-pointer">
                Lihat Catatan Sekarang
            </button>
        </div>
    </div>
    @endif

    {{-- MODAL EDIT BERITA --}}
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm"
         x-show="editBeritaOpen" style="display: none;">
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-gray-100 dark:border-slate-700" @click.away="editBeritaOpen = false">
            <div class="flex items-center justify-between mb-6 border-b dark:border-slate-700 pb-4">
                <h3 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">✏️ Edit Berita</h3>
                <button @click="editBeritaOpen = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-white text-2xl cursor-pointer leading-none">&times;</button>
            </div>
            <form :action="'/admin/berita/' + currentBerita.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Judul Berita</label>
                    <input type="text" name="title" x-model="currentBerita.title" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Ganti Foto Utama (Opsional)</label>
                    <input type="file" name="image" class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 dark:file:bg-slate-700 file:text-bakrie-dark dark:file:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Isi Berita</label>
                    <textarea name="content" x-model="currentBerita.content" rows="6" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 text-sm"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t dark:border-slate-700">
                    <button type="button" @click="editBeritaOpen = false" class="bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-700 dark:text-gray-200 font-bold text-xs py-2.5 px-5 rounded-xl transition cursor-pointer">Batal</button>
                    <button type="submit" class="bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold text-xs py-2.5 px-6 rounded-xl shadow transition cursor-pointer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- TOAST NOTIFIKASI --}}
    @if(session('success_stok') || session('success_berita') || session('success_reply_kepala') || session('success'))
    <div class="bg-white dark:bg-slate-800 border-l-4 border-emerald-500 p-4 rounded-2xl shadow-md flex items-center justify-between border border-gray-100 dark:border-slate-700">
        <div class="flex items-center gap-3">
            <span class="text-xl">✅</span>
            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                {{ session('success_stok') ?? session('success_berita') ?? session('success_reply_kepala') ?? session('success') }}
            </p>
        </div>
        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-white font-bold text-lg cursor-pointer" onclick="this.parentElement.remove()">&times;</button>
    </div>
    @endif

    {{-- ======================================================= --}}
    {{-- TAB: OVERVIEW                                           --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'overview'" class="space-y-6" x-cloak>
        <div class="bg-gradient-to-r from-bakrie-gold/20 via-amber-50/10 to-transparent p-8 rounded-3xl border border-bakrie-gold/30 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm dark:from-amber-950/20 dark:border-amber-900/30">
            <div class="flex items-center gap-4 text-left">
                <div class="w-16 h-16 bg-gradient-to-br from-bakrie-gold to-yellow-500 rounded-2xl flex items-center justify-center text-3xl shadow-md text-bakrie-dark">👋</div>
                <div>
                    <h2 class="text-2xl font-heading font-extrabold text-bakrie-dark dark:text-white">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-0.5">Kelola produk sembako, berita, dan koordinasi dengan Kepala Koperasi.</p>
                </div>
            </div>
            <span class="text-xs bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-400 font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Administrator KOP-AJS</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 border-l-4 border-bakrie-gold">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Total Anggota</p>
                <p class="text-3xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalAnggota }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 border-l-4 border-blue-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Total Berita</p>
                <p class="text-3xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalBerita }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 border-l-4 border-emerald-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Stok Sembako</p>
                <p class="text-3xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalStok }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 border-l-4 border-purple-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Pesan WA</p>
                <p class="text-3xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $messages->count() }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button @click="setTab('stok')" class="bg-white dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-slate-700/60 border-2 border-dashed border-amber-200 dark:border-slate-700 p-6 rounded-2xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">🛒</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm">Kelola Stok Sembako</h4>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Tambah, edit, dan perbarui stok produk sembako</p>
            </button>
            <button @click="setTab('berita')" class="bg-white dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-slate-700/60 border-2 border-dashed border-blue-100 dark:border-slate-700 p-6 rounded-2xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📰</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm">Kelola Berita</h4>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Buat dan edit artikel berita koperasi</p>
            </button>
            <button @click="setTab('catatan')" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/60 border-2 border-dashed border-slate-200 dark:border-slate-700 p-6 rounded-2xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📜</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm">Catatan Kepala</h4>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Lihat instruksi dan balas catatan kepala</p>
            </button>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: KELOLA STOK SEMBAKO                                --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'stok'" class="space-y-5" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-950/30 rounded-xl flex items-center justify-center text-2xl">🛒</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Kelola Stok & Harga Sembako</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Perubahan stok perlu disetujui Kepala Koperasi.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 border-b border-gray-100 dark:border-slate-700 gap-3">
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex-1 sm:w-64">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="search-stok" placeholder="Cari produk sembako..." onkeyup="filterTable('tbl-stok', this.value)"
                               class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white rounded-xl focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 transition">
                    </div>
                </div>
                <button onclick="document.getElementById('tambah-stok-form').classList.toggle('hidden')"
                        class="bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold text-xs py-2.5 px-5 rounded-xl shadow transition flex items-center gap-2 cursor-pointer whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Sembako Baru
                </button>
            </div>

            {{-- Form Tambah --}}
            <div id="tambah-stok-form" class="hidden bg-amber-50/50 dark:bg-slate-900/60 border-b border-amber-200 dark:border-slate-700 p-5">
                <form action="{{ route('admin.stok.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Nama Produk</label>
                        <input type="text" name="product_name" required placeholder="Contoh: Beras 5kg"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Jumlah (Qty)</label>
                        <input type="number" name="qty" required placeholder="0" min="0"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Harga (Rp)</label>
                        <input type="number" name="price" required placeholder="75000" min="0"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                    </div>
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('tambah-stok-form').classList.add('hidden')"
                                class="bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-700 dark:text-gray-200 font-bold text-xs py-2.5 px-4 rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow transition cursor-pointer">
                            Simpan & Ajukan ke Kepala
                        </button>
                    </div>
                </form>
            </div>

            {{-- Tabel ERP-style --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="tbl-stok">
                    <thead class="bg-slate-50 dark:bg-slate-900 text-slate-500 dark:text-slate-400 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-5 py-3.5 w-10">#</th>
                            <th class="px-5 py-3.5">Nama Produk</th>
                            <th class="px-5 py-3.5 w-28 text-center">Qty</th>
                            <th class="px-5 py-3.5 w-40">Harga (Rp)</th>
                            <th class="px-5 py-3.5 w-28 text-center">Status</th>
                            <th class="px-5 py-3.5 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                        @forelse($stoks as $i => $stok)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-900/40 transition duration-100 stok-row">
                            <form action="{{ route('admin.stok.update', $stok->id) }}" method="POST">
                                @csrf @method('PUT')
                                <td class="px-5 py-3.5 text-slate-400 dark:text-slate-500 text-xs font-mono">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-5 py-3.5 font-semibold text-slate-800 dark:text-white">
                                    <span class="stok-name">{{ $stok->product_name }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <input type="number" name="qty" value="{{ $stok->qty }}" min="0"
                                           class="w-20 text-center px-2 py-1.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                                </td>
                                <td class="px-5 py-3.5">
                                    <input type="number" name="price" value="{{ (int)$stok->price }}" min="0"
                                           class="w-full px-2 py-1.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    @if($stok->status === 'pending')
                                        <span class="inline-flex items-center gap-1 text-[10px] text-amber-700 dark:text-amber-400 font-bold bg-amber-50 dark:bg-amber-950/30 px-2 py-1 rounded-full">⏳ Pending</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-[10px] text-emerald-700 dark:text-emerald-400 font-bold bg-emerald-50 dark:bg-emerald-950/30 px-2 py-1 rounded-full">✅ Aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="submit" title="Update" class="p-1.5 bg-emerald-100 dark:bg-emerald-950/40 hover:bg-emerald-200 text-emerald-700 dark:text-emerald-400 rounded-lg transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                        <button type="button" title="Hapus"
                                                onclick="if(confirm('Hapus produk ini?')) { document.getElementById('delete-stok-{{ $stok->id }}').submit(); }"
                                                class="p-1.5 bg-red-50 dark:bg-red-950/30 hover:bg-red-100 text-red-600 dark:text-red-400 rounded-lg transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </form>
                            <form id="delete-stok-{{ $stok->id }}" action="{{ route('admin.stok.destroy', $stok->id) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center text-gray-400 dark:text-slate-500">
                                <div class="text-4xl mb-3">📦</div>
                                <p>Belum ada data stok sembako.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: KELOLA BERITA — ERP-style Table                    --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'berita'" class="space-y-5" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-950/30 rounded-xl flex items-center justify-center text-2xl">📰</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Kelola Berita Koperasi</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Draft berita perlu disetujui Kepala sebelum dipublikasikan.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm overflow-hidden">
            {{-- Toolbar --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 border-b border-gray-100 dark:border-slate-700 gap-3">
                <div class="relative w-full sm:w-72">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Cari judul berita..." onkeyup="filterTable('tbl-berita', this.value)"
                           class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white rounded-xl focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition">
                </div>
                <button onclick="document.getElementById('form-tambah-berita').classList.toggle('hidden')"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs py-2.5 px-5 rounded-xl shadow transition flex items-center gap-2 cursor-pointer whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Buat Berita Baru
                </button>
            </div>

            {{-- Form Buat Berita --}}
            <div id="form-tambah-berita" class="hidden bg-blue-50/40 dark:bg-slate-900/60 border-b border-blue-100 dark:border-slate-700 p-5">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Judul Berita</label>
                            <input type="text" name="title" required placeholder="Tulis judul berita..."
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Foto Utama (Opsional)</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 dark:file:bg-slate-700 file:text-blue-800 dark:file:text-white">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Isi Berita</label>
                        <textarea name="content" rows="4" required placeholder="Tulis isi berita..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('form-tambah-berita').classList.add('hidden')"
                                class="bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 text-gray-700 dark:text-gray-200 font-bold text-xs py-2.5 px-4 rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs py-2.5 px-6 rounded-xl shadow transition cursor-pointer">
                            Ajukan Draft Berita ➔
                        </button>
                    </div>
                </form>
            </div>

            {{-- Tabel Berita ERP-style --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="tbl-berita">
                    <thead class="bg-slate-50 dark:bg-slate-900 text-slate-500 dark:text-slate-400 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-5 py-3.5 w-10">#</th>
                            <th class="px-5 py-3.5">Judul Berita</th>
                            <th class="px-5 py-3.5 w-32 text-center">Status</th>
                            <th class="px-5 py-3.5 w-36">Tanggal</th>
                            <th class="px-5 py-3.5 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                        @forelse($beritas as $i => $news)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-900/40 transition duration-100">
                            <td class="px-5 py-3.5 text-slate-400 dark:text-slate-500 text-xs font-mono">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if($news->image)
                                        <img src="{{ asset('images/' . $news->image) }}" class="w-10 h-10 object-cover rounded-lg flex-shrink-0 border border-gray-100 dark:border-slate-700">
                                    @else
                                        <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center flex-shrink-0 text-sm">📰</div>
                                    @endif
                                    <span class="font-semibold text-slate-800 dark:text-white berita-title">{{ Str::limit($news->title, 60) }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($news->status === 'pending')
                                    <span class="inline-flex items-center gap-1 text-[10px] text-amber-700 dark:text-amber-400 font-bold bg-amber-50 dark:bg-amber-950/30 px-2 py-1 rounded-full">⏳ Pending</span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] text-emerald-700 dark:text-emerald-400 font-bold bg-emerald-50 dark:bg-emerald-950/30 px-2 py-1 rounded-full">✅ Aktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-xs text-slate-500 dark:text-slate-400">{{ $news->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-3.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button @click="currentBerita = { id: '{{ $news->id }}', title: '{{ addslashes($news->title) }}', content: '{{ addslashes($news->content) }}' }; editBeritaOpen = true"
                                            title="Edit" class="p-1.5 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 text-amber-700 dark:text-amber-400 rounded-lg transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.berita.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" title="Hapus" class="p-1.5 bg-red-50 dark:bg-red-950/30 hover:bg-red-100 text-red-600 dark:text-red-400 rounded-lg transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center text-gray-400 dark:text-slate-500">
                                <div class="text-4xl mb-3">📰</div>
                                <p>Belum ada berita.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: CATATAN KEPALA                                     --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'catatan'" class="space-y-5" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">📜</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Catatan & Instruksi Kepala</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Komunikasi timbal-balik revisi dari Kepala Koperasi.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
            @forelse($announcements as $ann)
            <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-5 rounded-2xl space-y-4 text-left">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Catatan Koreksi dari Kepala
                    </h4>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 pl-4 border-l-2 border-blue-200 dark:border-blue-800">{{ $ann->message }}</p>
                </div>
                <div class="pt-3 border-t border-dashed border-slate-200 dark:border-slate-700">
                    @if($ann->reply)
                    <div class="bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/50 p-4 rounded-xl">
                        <p class="text-xs text-emerald-800 dark:text-emerald-400 font-bold">✅ Balasan Admin Terkirim:</p>
                        <p class="text-sm text-gray-800 dark:text-gray-300 mt-1">{{ $ann->reply }}</p>
                    </div>
                    @else
                    <form action="{{ route('admin.reply.kepala', $ann->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="reply" required placeholder="Tulis balasan klarifikasi..."
                               class="flex-1 px-4 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 text-slate-800 dark:text-white rounded-xl text-sm focus:border-blue-500">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-2 px-5 rounded-xl transition cursor-pointer">Kirim</button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-gray-400 dark:text-slate-500 text-sm py-12 text-center">Tidak ada catatan.</p>
            @endforelse
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB DINAMIS: PRODUK & LAYANAN (ERP-style List + Form)   --}}
    {{-- ======================================================= --}}
    @php $dynTabs = \App\Models\MinatData::categories(); @endphp

    @foreach($dynTabs as $slug => $meta)
    @php $tabKey = ($meta['type'] == 'produk' ? 'prod_' : 'lay_') . $slug; @endphp
    <div x-show="activeTab === '{{ $tabKey }}'" class="space-y-5" x-cloak>

        {{-- Header --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-2xl" style="background-color: {{ $meta['color'] }}20">
                {{ $meta['icon'] }}
            </div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">{{ $meta['title'] }}</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Kelola data statistik minat dan informasi rincian {{ $meta['type'] }}.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-5 gap-5">

            {{-- Kiri: Tabel Minat Bulanan (3/5 lebar) --}}
            <div class="xl:col-span-3 bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm">📊 Data Statistik Minat Bulanan</h3>
                    <span class="text-xs text-gray-400 dark:text-slate-500">2024 - 2025</span>
                </div>

                {{-- Form Edit Minat --}}
                <div class="p-4 bg-slate-50/60 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3">✏️ Edit / Tambah Data Minat</p>
                    <form action="{{ route('admin.minat.update') }}" method="POST" class="grid grid-cols-2 sm:grid-cols-4 gap-3 items-end">
                        @csrf
                        <input type="hidden" name="category" value="{{ $slug }}">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Tahun</label>
                            <select name="year" required class="w-full px-3 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white">
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Bulan</label>
                            <select name="month" required class="w-full px-3 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white">
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ $m }}">{{ \App\Models\MinatData::monthName($m) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Anggota</label>
                            <input type="number" name="anggota" required min="0" placeholder="0"
                                   class="w-full px-3 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Mitra</label>
                            <input type="number" name="mitra" required min="0" placeholder="0"
                                   class="w-full px-3 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white">
                        </div>
                        <div class="col-span-2 sm:col-span-4 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-2 px-5 rounded-xl shadow cursor-pointer">
                                Ajukan Perubahan ➔
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Grafik --}}
                <div class="p-5">
                    <div class="h-56 relative">
                        <canvas id="chart-{{ $slug }}"></canvas>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form Rincian Konten (2/5 lebar) --}}
            <div class="xl:col-span-2 bg-white dark:bg-slate-800 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm">
                <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm">📝 Rincian Informasi</h3>
                    @if(isset($kontens[$slug]) && $kontens[$slug]->status === 'pending')
                        <span class="text-[9px] bg-amber-100 dark:bg-amber-950/30 text-amber-800 dark:text-amber-400 font-extrabold px-2 py-0.5 rounded-full">⏳ Draft Pending</span>
                    @endif
                </div>
                @php $konten = $kontens[$slug] ?? null; @endphp
                <form action="{{ route('admin.konten.update', $slug) }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nama / Judul</label>
                        <input type="text" name="title" required value="{{ $konten ? ($konten->draft_title ?? $konten->title) : $meta['title'] }}"
                               class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Deskripsi Utama</label>
                        <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20">{{ $konten ? ($konten->draft_description ?? $konten->description) : '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Persyaratan</label>
                        <textarea name="syarat" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20" placeholder="1. Syarat A&#10;2. Syarat B">{{ $konten ? ($konten->draft_syarat ?? $konten->syarat) : '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Info Biaya / Harga</label>
                        <input type="text" name="harga_info" value="{{ $konten ? ($konten->draft_harga_info ?? $konten->harga_info) : '' }}"
                               class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20" placeholder="Mulai dari Rp 50.000">
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-2.5 rounded-xl text-xs transition cursor-pointer">
                        Ajukan Pembaruan Rincian ➔
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>

{{-- SCRIPT CHART.JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const minatDataRaw = @json($minatData);
        const categories = @json(array_keys($dynTabs));
        const monthsName = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

        categories.forEach(slug => {
            let filtered = minatDataRaw.filter(d => d.category === slug);
            filtered.sort((x, y) => x.year !== y.year ? x.year - y.year : x.month - y.month);
            let recent = filtered.slice(-12);
            let labels = recent.map(d => monthsName[d.month] + ' ' + d.year);
            let anggotaData = recent.map(d => d.anggota);
            let mitraData = recent.map(d => d.mitra);
            const ctx = document.getElementById('chart-' + slug);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [
                        { label: 'Minat Anggota', data: anggotaData, borderColor: '#3B82F6', backgroundColor: 'rgba(59,130,246,0.1)', borderWidth: 2.5, tension: 0.35, fill: true, pointRadius: 3 },
                        { label: 'Minat Mitra', data: mitraData, borderColor: '#EC4899', backgroundColor: 'rgba(236,72,153,0.08)', borderWidth: 2.5, tension: 0.35, fill: true, pointRadius: 3 }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(156,163,175,0.12)' }, ticks: { font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                    },
                    plugins: { legend: { position: 'top', labels: { font: { weight: 'bold', size: 11 } } } }
                }
            });
        });
    });

    // Filter tabel universal
    function filterTable(tableId, query) {
        const rows = document.querySelectorAll('#' + tableId + ' tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query.toLowerCase()) ? '' : 'none';
        });
    }
</script>
@endsection