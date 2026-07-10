@extends('layouts.admin')
@section('content')
<div class="p-8 space-y-8 transition-colors duration-200">

    {{-- MODAL POP-UP NOTIFIKASI CATATAN BARU DARI KEPALA --}}
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
         x-show="editBeritaOpen"
         style="display: none;">
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-gray-100 dark:border-slate-700" @click.away="editBeritaOpen = false">
            <h3 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white border-b pb-3 mb-6">✏️ Edit Berita</h3>
            <form :action="'/admin/berita/' + currentBerita.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Judul Berita</label>
                    <input type="text" name="title" x-model="currentBerita.title" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Ganti Foto Utama (Opsional)</label>
                    <input type="file" name="image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 dark:file:bg-slate-700 file:text-bakrie-dark dark:file:text-white hover:file:bg-amber-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Konten / Isi Berita</label>
                    <textarea name="content" x-model="currentBerita.content" rows="6" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 text-sm"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t dark:border-slate-700">
                    <button type="button" @click="editBeritaOpen = false" class="bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 text-gray-700 dark:text-gray-200 font-bold text-xs py-2.5 px-4 rounded-xl transition">Batal</button>
                    <button type="submit" class="bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold text-xs py-2.5 px-6 rounded-xl shadow transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- NOTIFIKASI TOAST --}}
    @if(session('success_stok') || session('success_berita') || session('success_reply_kepala') || session('success'))
    <div class="bg-white dark:bg-slate-800 border-l-4 border-emerald-500 p-4 rounded-2xl shadow-md flex items-center justify-between border border-gray-100 dark:border-slate-700 animate-slide-in">
        <div class="flex items-center gap-3">
            <span class="text-xl">✨</span>
            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                {{ session('success_stok') ?? session('success_berita') ?? session('success_reply_kepala') ?? session('success') }}
            </p>
        </div>
        <button class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    {{-- ======================================================= --}}
    {{-- TAB: OVERVIEW                                           --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'overview'" class="space-y-8" x-cloak>
        {{-- Banner Selamat Datang --}}
        <div class="bg-gradient-to-r from-bakrie-gold/20 via-amber-50/10 to-transparent p-8 rounded-3xl border border-bakrie-gold/30 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-4 text-left">
                <div class="w-16 h-16 bg-gradient-to-br from-bakrie-gold to-yellow-500 rounded-2xl flex items-center justify-center text-3xl shadow-md text-bakrie-dark">
                    👋
                </div>
                <div>
                    <h2 class="text-2xl font-heading font-extrabold text-bakrie-dark dark:text-white leading-tight">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-0.5">Mulai kelola produk sembako, berita, dan koordinasi dengan Kepala Koperasi.</p>
                </div>
            </div>
            <span class="text-xs bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-400 font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Administrator KOP-AJS</span>
        </div>

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-bakrie-gold">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Total Anggota</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalAnggota }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-blue-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Berita</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalBerita }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-emerald-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Stok Sembako</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $totalStok }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-slate-700 border-l-4 border-purple-500">
                <p class="text-gray-400 text-xs font-extrabold uppercase tracking-wider">Pesan WA</p>
                <p class="text-3xl md:text-4xl font-heading font-black text-slate-800 dark:text-white mt-2">{{ $messages->count() }}</p>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <button @click="setTab('stok')" class="bg-white dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-amber-200 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">🛒</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-bakrie-dark dark:group-hover:text-bakrie-gold">Kelola Stok Sembako</h4>
                <p class="text-xs text-gray-400 mt-1">Tambah, edit, dan perbarui stok produk sembako</p>
            </button>
            <button @click="setTab('berita')" class="bg-white dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-blue-100 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📰</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-blue-600">Kelola Berita</h4>
                <p class="text-xs text-gray-400 mt-1">Buat dan edit artikel berita koperasi</p>
            </button>
            <button @click="setTab('catatan')" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/50 border-2 border-dashed border-slate-200 dark:border-slate-700 p-6 rounded-3xl text-left group transition-all duration-200 cursor-pointer">
                <span class="text-3xl block mb-3">📜</span>
                <h4 class="font-extrabold text-slate-800 dark:text-white text-sm group-hover:text-slate-600">Catatan Kepala</h4>
                <p class="text-xs text-gray-400 mt-1">Lihat instruksi dan balas catatan kepala</p>
            </button>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: KELOLA STOK SEMBAKO                                --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'stok'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">🛒</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Kelola Stok &amp; Harga Sembako</h2>
                <p class="text-xs text-gray-400 mt-0.5">Perubahan stok akan masuk status pending dan perlu disetujui Kepala Koperasi.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b dark:border-slate-700 pb-4 gap-3">
                <h3 class="text-lg font-heading font-extrabold text-bakrie-dark dark:text-white">Daftar Produk Sembako</h3>
                <button onclick="document.getElementById('tambah-stok-form').classList.toggle('hidden')"
                        class="bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold text-xs py-2.5 px-5 rounded-xl shadow-md transition flex items-center gap-2 cursor-pointer">
                    <span>+</span> Tambah Sembako Baru
                </button>
            </div>

            {{-- Form Tambah Sembako Baru (Collapsible) --}}
            <div id="tambah-stok-form" class="hidden bg-amber-50/50 dark:bg-slate-900/50 border border-amber-200 dark:border-slate-700 p-6 rounded-2xl">
                <h4 class="font-bold text-sm text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-bakrie-gold rounded-full flex items-center justify-center text-xs text-bakrie-dark font-extrabold">+</span>
                    Tambah Produk Baru ke Katalog
                </h4>
                <form action="{{ route('admin.stok.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    @csrf
                    <div class="text-left">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Produk</label>
                        <input type="text" name="product_name" required placeholder="Contoh: Beras Pandan Wangi 5kg"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/25 transition text-sm">
                    </div>
                    <div class="text-left">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Quantity (Qty)</label>
                        <input type="number" name="qty" required placeholder="0" min="0"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/25 transition text-sm">
                    </div>
                    <div class="text-left">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Harga Satuan (Rp)</label>
                        <input type="number" name="price" required placeholder="Contoh: 75000" min="0"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/25 transition text-sm">
                    </div>
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('tambah-stok-form').classList.add('hidden')"
                                class="bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 text-gray-700 dark:text-gray-200 font-bold text-xs py-2.5 px-4 rounded-xl transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow transition cursor-pointer">
                            Simpan &amp; Ajukan ke Kepala
                        </button>
                    </div>
                </form>
            </div>

            {{-- Tabel Sembako --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-900 text-slate-500 uppercase text-xs font-bold border-b border-gray-200 dark:border-slate-700">
                        <tr>
                            <th class="p-4">Nama Produk</th>
                            <th class="p-4 w-32 text-center">QTY</th>
                            <th class="p-4 w-48">Harga (Rp)</th>
                            <th class="p-4 text-center w-40">Status &amp; Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($stoks as $stok)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition duration-150">
                            <form action="{{ route('admin.stok.update', $stok->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td class="p-4 font-bold text-slate-800 dark:text-white text-sm text-left">
                                    {{ $stok->product_name }}
                                    @if($stok->status === 'pending')
                                    <span class="block text-[10px] text-amber-600 dark:text-amber-400 font-bold mt-0.5 bg-amber-50 dark:bg-amber-950/20 px-2 py-0.5 rounded-md inline-block">
                                        ⏳ Pending Approval Kepala
                                    </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <input type="number" name="qty" value="{{ $stok->qty }}"
                                           class="w-20 mx-auto block px-3 py-1.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 text-center font-semibold text-sm">
                                </td>
                                <td class="p-4">
                                    <input type="number" name="price" value="{{ (int)$stok->price }}"
                                           class="w-full px-3 py-1.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 font-semibold text-sm">
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="submit" class="bg-emerald-600 text-white font-bold py-1.5 px-4 rounded-xl hover:bg-emerald-700 transition text-xs shadow-sm cursor-pointer">
                                            Update
                                        </button>
                                        <button type="button"
                                                onclick="if(confirm('Hapus produk ini?')) { document.getElementById('delete-stok-{{ $stok->id }}').submit(); }"
                                                class="bg-red-50 dark:bg-red-950/30 hover:bg-red-100 text-red-600 dark:text-red-400 font-bold py-1.5 px-3 rounded-xl transition text-xs cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </form>
                            <form id="delete-stok-{{ $stok->id }}" action="{{ route('admin.stok.destroy', $stok->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-gray-400 font-medium">
                                <div class="text-4xl mb-3">📦</div>
                                Belum ada data stok.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: KELOLA BERITA                                      --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'berita'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">📰</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Kelola Berita Koperasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">Buat berita baru atau edit berita. Draft perlu disetujui Kepala.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Form Buat Berita --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-5">
                <h3 class="text-lg font-heading font-extrabold text-bakrie-dark dark:text-white border-b dark:border-slate-700 pb-3 text-left">📢 Buat Berita Baru</h3>
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-left">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Judul Berita</label>
                        <input type="text" name="title" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 transition text-sm"
                               placeholder="Tulis judul berita...">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Upload Foto Utama</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 dark:file:bg-slate-700 file:text-bakrie-dark dark:file:text-white hover:file:bg-amber-100 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Isi Berita</label>
                        <textarea name="content" rows="7" required
                                  class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:border-bakrie-gold focus:ring focus:ring-bakrie-gold/20 transition text-sm"
                                  placeholder="Tulis isi berita lengkap..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-bakrie-dark dark:bg-bakrie-gold text-white dark:text-bakrie-dark font-extrabold py-3 rounded-xl hover:opacity-95 transition shadow-md text-sm cursor-pointer">
                        Ajukan Draft Berita ➔
                    </button>
                </form>
            </div>

            {{-- Daftar Berita --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-heading font-extrabold text-bakrie-dark dark:text-white border-b dark:border-slate-700 pb-3 mb-5 text-left">📰 Daftar Berita</h3>
                <div class="space-y-4 max-h-[520px] overflow-y-auto pr-1">
                    @forelse($beritas as $news)
                    <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-900/30 transition border border-gray-100 dark:border-slate-700 text-left">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-xl overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($news->image)
                                <img src="{{ asset('images/' . $news->image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl">📰</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-sm text-slate-800 dark:text-white leading-tight">
                                {{ Str::limit($news->title, 50) }}
                            </h4>
                            @if($news->status === 'pending')
                            <span class="text-[10px] text-amber-600 font-bold bg-amber-50 dark:bg-amber-950/20 px-2 py-0.5 rounded-full mt-1 inline-block">⏳ Pending Approval</span>
                            @else
                            <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 dark:bg-emerald-950/20 px-2 py-0.5 rounded-full mt-1 inline-block">✅ Aktif</span>
                            @endif
                        </div>
                        <div class="flex flex-col gap-1 flex-shrink-0">
                            <button @click="currentBerita = { id: '{{ $news->id }}', title: '{{ addslashes($news->title) }}', content: '{{ addslashes($news->content) }}' }; editBeritaOpen = true"
                                    class="px-2.5 py-1 bg-amber-50 dark:bg-slate-700 hover:bg-amber-100 text-bakrie-dark dark:text-white font-bold text-xs rounded-lg transition cursor-pointer">
                                Edit
                            </button>
                            <form action="{{ route('admin.berita.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 font-bold text-xs rounded-lg transition cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 text-center">
                        <p class="text-gray-400 text-sm">Belum ada berita.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- TAB: CATATAN KEPALA                                     --}}
    {{-- ======================================================= --}}
    <div x-show="activeTab === 'catatan'" class="space-y-6" x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl">📜</div>
            <div class="text-left">
                <h2 class="text-xl font-heading font-extrabold text-bakrie-dark dark:text-white">Catatan &amp; Instruksi Kepala</h2>
                <p class="text-xs text-gray-400 mt-0.5">Komunikasi timbal-balik revisi dari Kepala Koperasi.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm space-y-4">
            @forelse($announcements as $ann)
            <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-6 rounded-2xl space-y-4 text-left">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Catatan Koreksi dari Kepala
                    </h4>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 pl-4 border-l-2 border-blue-200">{{ $ann->message }}</p>
                </div>
                <div class="pt-3 border-t border-dashed dark:border-slate-700">
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
            <p class="text-gray-400 text-sm py-12 text-center">Tidak ada catatan.</p>
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
                <p class="text-xs text-gray-400 mt-0.5">Kelola data minat bulanan, visualisasi grafik 2 tahun, serta isi rincian informasi {{ $meta['type'] }}.</p>
            </div>
        </div>

        {{-- Grid Panel --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Kiri & Tengah: Grafik Visualisasi & Edit Minat --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Grafik Minat --}}
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white mb-4 text-left">📈 Grafik Peminat Bulanan (2 Tahun Terakhir)</h3>
                    <div class="h-80 relative">
                        <canvas id="chart-{{ $slug }}"></canvas>
                    </div>
                </div>

                {{-- Form Edit Data Minat --}}
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white mb-4 text-left">✏️ Edit / Tambah Statistik Minat</h3>
                    <form action="{{ route('admin.minat.update') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end text-left">
                        @csrf
                        <input type="hidden" name="category" value="{{ $slug }}">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Tahun</label>
                            <select name="year" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Bulan</label>
                            <select name="month" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ $m }}">{{ \App\Models\MinatData::monthName($m) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Minat Anggota</label>
                            <input type="number" name="anggota" required min="0" placeholder="0" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Minat Mitra</label>
                            <input type="number" name="mitra" required min="0" placeholder="0" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">
                        </div>
                        <div class="sm:col-span-4 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow cursor-pointer">
                                Ajukan Perubahan Angka ➔
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Kanan: Form Kelola Konten & Informasi Layanan --}}
            <div class="space-y-6">
                
                {{-- Form Konten Info --}}
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-gray-200 dark:border-slate-700 shadow-sm text-left">
                    <div class="flex items-center justify-between border-b dark:border-slate-700 pb-3 mb-4">
                        <h3 class="text-base font-bold text-slate-800 dark:text-white">📝 Rincian Informasi</h3>
                        @if(isset($kontens[$slug]) && $kontens[$slug]->status === 'pending')
                            <span class="text-[9px] bg-amber-100 text-amber-800 font-extrabold px-2 py-0.5 rounded-full">⏳ Draft Pending</span>
                        @endif
                    </div>

                    @php
                        $konten = $kontens[$slug] ?? null;
                    @endphp

                    <form action="{{ route('admin.konten.update', $slug) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nama / Judul Halaman</label>
                            <input type="text" name="title" required value="{{ $konten ? ($konten->draft_title ?? $konten->title) : $meta['title'] }}"
                                   class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Deskripsi Utama</label>
                            <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white">{{ $konten ? ($konten->draft_description ?? $konten->description) : '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Persyaratan Layanan</label>
                            <textarea name="syarat" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white" placeholder="Sebutkan syarat... (1. Syarat A, 2. Syarat B)">{{ $konten ? ($konten->draft_syarat ?? $konten->syarat) : '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Info Biaya / Jasa / Harga</label>
                            <input type="text" name="harga_info" value="{{ $konten ? ($konten->draft_harga_info ?? $konten->harga_info) : '' }}"
                                   class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-white" placeholder="Contoh: Mulai dari Rp 50.000 / Gratis">
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-2.5 rounded-xl text-xs transition cursor-pointer">
                            Ajukan Pembaruan Rincian ➔
                        </button>
                    </form>
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

        categories.forEach(slug => {
            // Filter data khusus kategori ini
            let filtered = minatDataRaw.filter(d => d.category === slug);
            
            // Sort urut waktu (lama ke baru)
            filtered.sort((x, y) => {
                if (x.year !== y.year) return x.year - y.year;
                return x.month - y.month;
            });

            // Ambil 12 data terakhir untuk grafik agar tidak terlalu penuh
            let recent = filtered.slice(-12);

            let labels = recent.map(d => monthsName[d.month] + ' ' + d.year);
            let anggotaData = recent.map(d => d.anggota);
            let mitraData = recent.map(d => d.mitra);

            const ctx = document.getElementById('chart-' + slug);
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