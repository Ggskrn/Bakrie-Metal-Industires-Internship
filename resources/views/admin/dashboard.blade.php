@extends('layouts.admin')

@section('content')
{{-- ============================================================
     ADMIN DASHBOARD — Bakrie Metal
     Alpine data: adminDashboard() → activeTab, darkMode,
     editBeritaOpen, currentBerita, setTab(), toggleDarkMode()
     ============================================================ --}}

@php
    $dynTabs = \App\Models\MinatData::categories();
@endphp

{{-- ===================== 1. MODAL — UNREAD KEPALA NOTES ===================== --}}
@if($unreadCountForAdmin > 0)
<div x-data="{ showUnread: true }" x-show="showUnread" x-transition.opacity.duration.300ms
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm"
     @keydown.escape.window="showUnread = false">
    <div @click.outside="showUnread = false"
         class="relative w-full max-w-md mx-4 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-amber-200 dark:border-amber-700 overflow-hidden animate-bounce-in">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-amber-500 to-yellow-500 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg">Catatan Baru dari Kepala</h3>
                    <p class="text-amber-100 text-sm">Ada {{ $unreadCountForAdmin }} catatan yang belum dibaca</p>
                </div>
            </div>
        </div>
        {{-- Body --}}
        <div class="px-6 py-5">
            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                Anda memiliki <span class="font-bold text-amber-600 dark:text-amber-400">{{ $unreadCountForAdmin }}</span>
                catatan baru dari Kepala yang memerlukan perhatian Anda. Silakan periksa tab Catatan untuk membaca dan membalasnya.
            </p>
        </div>
        {{-- Footer --}}
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 flex items-center justify-end gap-3">
            <button @click="showUnread = false"
                    class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                Nanti Saja
            </button>
            <button @click="showUnread = false; setTab('catatan')"
                    class="px-5 py-2 bg-gradient-to-r from-amber-500 to-yellow-500 text-white text-sm font-semibold rounded-lg
                           hover:from-amber-600 hover:to-yellow-600 shadow-md hover:shadow-lg transition-all duration-200">
                Lihat Catatan
            </button>
        </div>
        {{-- Close --}}
        <button @click="showUnread = false"
                class="absolute top-3 right-3 text-white/70 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif

{{-- ===================== 2. MODAL — EDIT BERITA ===================== --}}
<div x-show="editBeritaOpen" x-transition.opacity.duration.200ms
     class="fixed inset-0 z-[9998] flex items-center justify-center bg-black/50 backdrop-blur-sm"
     @keydown.escape.window="editBeritaOpen = false" style="display:none;">
    <div @click.outside="editBeritaOpen = false"
         class="relative w-full max-w-2xl mx-4 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Berita
            </h3>
            <button @click="editBeritaOpen = false" class="text-white/70 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        {{-- Form --}}
        <form :action="'{{ url('admin/berita') }}/' + currentBerita.id" method="POST" enctype="multipart/form-data"
              class="px-6 py-5 space-y-5">
            @csrf
            @method('PUT')
            {{-- Judul --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Judul Berita</label>
                <input type="text" name="title" x-model="currentBerita.title"
                       class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                              rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              transition-all duration-200" placeholder="Masukkan judul berita" required>
            </div>
            {{-- Konten --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Konten</label>
                <textarea name="content" x-model="currentBerita.content" rows="6"
                          class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                 transition-all duration-200 resize-none" placeholder="Tulis konten berita..." required></textarea>
            </div>
            {{-- Gambar --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Gambar (opsional)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600
                              dark:file:bg-blue-900/30 dark:file:text-blue-400
                              hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-all">
            </div>
            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" @click="editBeritaOpen = false"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700
                               rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl
                               hover:from-blue-700 hover:to-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== 3. TOAST NOTIFICATIONS ===================== --}}
@foreach(['success_stok','success_berita','success_reply_kepala','success'] as $flashKey)
    @if(session($flashKey))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-[9997] max-w-sm w-full bg-white dark:bg-gray-800 border border-green-200 dark:border-green-700
                rounded-xl shadow-2xl overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4">
            <div class="flex-shrink-0 w-9 h-9 bg-green-100 dark:bg-green-900/40 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 flex-1">{{ session($flashKey) }}</p>
            <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="h-1 bg-green-500 animate-shrink-bar"></div>
    </div>
    @endif
@endforeach

<style>
    @keyframes shrink-bar { from { width: 100%; } to { width: 0%; } }
    .animate-shrink-bar { animation: shrink-bar 4s linear forwards; }
    @keyframes bounce-in {
        0%   { transform: scale(0.9); opacity: 0; }
        50%  { transform: scale(1.02); }
        100% { transform: scale(1); opacity: 1; }
    }
    .animate-bounce-in { animation: bounce-in .35s ease-out; }
</style>

{{-- ===================== MAIN CONTENT WRAPPER ===================== --}}
<div class="space-y-6">

{{-- ===================== 4. TAB: OVERVIEW ===================== --}}
<div x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none;">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500 p-6 md:p-8 shadow-xl">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.08%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                    Selamat Datang, {{ $user->name ?? 'Admin' }}! 👋
                </h1>
                <p class="mt-2 text-amber-100 text-sm md:text-base max-w-lg">
                    Dashboard admin Bakrie Metal — kelola stok, berita, dan layanan koperasi dengan mudah.
                </p>
            </div>
            <div class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-xl px-4 py-3 text-white text-sm font-medium">
                📅 {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-6">
        @php
            $stats = [
                ['label' => 'Total Anggota', 'value' => $totalAnggota, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>', 'from' => 'from-blue-500', 'to' => 'to-cyan-500', 'bg' => 'bg-blue-50 dark:bg-blue-900/30', 'text' => 'text-blue-600 dark:text-blue-400'],
                ['label' => 'Total Berita', 'value' => $totalBerita, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>', 'from' => 'from-emerald-500', 'to' => 'to-teal-500', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/30', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                ['label' => 'Stok Sembako', 'value' => $totalStok, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>', 'from' => 'from-amber-500', 'to' => 'to-orange-500', 'bg' => 'bg-amber-50 dark:bg-amber-900/30', 'text' => 'text-amber-600 dark:text-amber-400'],
                ['label' => 'Pesan WA', 'value' => $messages->count(), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>', 'from' => 'from-purple-500', 'to' => 'to-pink-500', 'bg' => 'bg-purple-50 dark:bg-purple-900/30', 'text' => 'text-purple-600 dark:text-purple-400'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md border border-gray-100 dark:border-gray-700
                    hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
                    <p class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white">{{ number_format($stat['value']) }}</p>
                </div>
                <div class="{{ $stat['bg'] }} w-14 h-14 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 {{ $stat['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                </div>
            </div>
            <div class="mt-3 h-1 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r {{ $stat['from'] }} {{ $stat['to'] }} w-3/4"></div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
        @php
            $quickActions = [
                ['tab' => 'stok', 'title' => 'Kelola Stok', 'desc' => 'Tambah, edit, dan hapus data stok sembako.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>', 'gradient' => 'from-amber-500 to-orange-500'],
                ['tab' => 'berita', 'title' => 'Kelola Berita', 'desc' => 'Buat dan kelola berita koperasi.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>', 'gradient' => 'from-blue-500 to-indigo-500'],
                ['tab' => 'catatan', 'title' => 'Catatan Kepala', 'desc' => 'Baca dan balas catatan dari kepala.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>', 'gradient' => 'from-emerald-500 to-teal-500'],
            ];
        @endphp

        @foreach($quickActions as $qa)
        <button @click="setTab('{{ $qa['tab'] }}')"
                class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md border border-gray-100 dark:border-gray-700
                       hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-left w-full">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-gradient-to-br {{ $qa['gradient'] }} rounded-xl flex items-center justify-center
                            shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $qa['icon'] !!}</svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                        {{ $qa['title'] }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $qa['desc'] }}</p>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-600 group-hover:text-amber-500 transition-colors mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </button>
        @endforeach
    </div>
</div>

{{-- ===================== 5. TAB: STOK ===================== --}}
<div x-show="activeTab === 'stok'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     x-data="{ showAddStok: false }" style="display:none;">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Manajemen Stok Sembako
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data stok produk koperasi</p>
        </div>
        <button @click="showAddStok = !showAddStok"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white
                       text-sm font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600
                       shadow-md hover:shadow-lg transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Sembako Baru
        </button>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative max-w-md">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari produk stok..."
                   onkeyup="filterTable(this.value, 'stok-table')"
                   class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                          rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent
                          transition-all duration-200">
        </div>
    </div>

    {{-- Collapsible Add Form --}}
    <div x-show="showAddStok" x-collapse
         class="mb-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3">
            <h3 class="text-white font-bold text-sm">➕ Tambah Produk Baru</h3>
        </div>
        <form action="{{ route('admin.stok.store') }}" method="POST" class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Nama Produk</label>
                <input type="text" name="product_name" required
                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                       placeholder="Contoh: Beras Premium">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Jumlah (Qty)</label>
                <input type="number" name="qty" required min="0"
                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                       placeholder="0">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Harga (Rp)</label>
                <input type="number" name="price" required min="0"
                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                       placeholder="0">
            </div>
            <div class="md:col-span-3 flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-xl
                               hover:from-amber-600 hover:to-orange-600 shadow-md hover:shadow-lg transition-all duration-200">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

    {{-- ERP Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="stok-table">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400 w-12">#</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Nama Produk</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-28">Qty</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-36">Harga</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-28">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($stoks as $idx => $stok)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">{{ $idx + 1 }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.stok.update', $stok->id) }}" method="POST"
                                  class="flex flex-wrap items-center gap-2" id="stok-form-{{ $stok->id }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="product_name" value="{{ $stok->draft_product_name ?? $stok->product_name }}"
                                       class="flex-1 min-w-[140px] px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </td>
                        <td class="px-4 py-3 text-center">
                                <input type="number" name="qty" value="{{ $stok->draft_qty ?? $stok->qty }}" min="0"
                                       class="w-20 mx-auto px-2 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                              rounded-lg text-sm text-center text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </td>
                        <td class="px-4 py-3 text-center">
                                <input type="number" name="price" value="{{ $stok->draft_price ?? $stok->price }}" min="0"
                                       class="w-28 mx-auto px-2 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                              rounded-lg text-sm text-center text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($stok->status === 'approved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400
                                             text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    Approved
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400
                                             text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="submit" form="stok-form-{{ $stok->id }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                                               text-xs font-semibold rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Update
                                </button>
                            </form>
                                <form action="{{ route('admin.stok.destroy', $stok->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                                   text-xs font-semibold rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada data stok</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Footer --}}
        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
            Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $stoks->count() }}</span> produk
        </div>
    </div>
</div>

{{-- ===================== 6. TAB: BERITA ===================== --}}
<div x-show="activeTab === 'berita'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     x-data="{ showAddBerita: false }" style="display:none;">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                Manajemen Berita
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola berita dan informasi koperasi</p>
        </div>
        <button @click="showAddBerita = !showAddBerita"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white
                       text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700
                       shadow-md hover:shadow-lg transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Berita Baru
        </button>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative max-w-md">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari berita..."
                   onkeyup="filterTable(this.value, 'berita-table')"
                   class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                          rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent
                          transition-all duration-200">
        </div>
    </div>

    {{-- Collapsible Add Form --}}
    <div x-show="showAddBerita" x-collapse
         class="mb-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3">
            <h3 class="text-white font-bold text-sm">📝 Buat Berita Baru</h3>
        </div>
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Judul Berita</label>
                <input type="text" name="title" required
                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Masukkan judul berita">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Konten</label>
                <textarea name="content" rows="4" required
                          class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                          placeholder="Tulis konten berita..."></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Gambar (opsional)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600
                              dark:file:bg-blue-900/30 dark:file:text-blue-400 transition-all">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl
                               hover:from-blue-700 hover:to-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                    Publikasikan
                </button>
            </div>
        </form>
    </div>

    {{-- ERP Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="berita-table">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400 w-12">#</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Judul</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-28">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-32">Tanggal</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($beritas as $idx => $berita)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">{{ $idx + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($berita->image)
                                <img src="{{ asset('storage/' . $berita->image) }}" alt=""
                                     class="w-10 h-10 rounded-lg object-cover border border-gray-200 dark:border-gray-600 flex-shrink-0">
                                @else
                                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $berita->draft_title ?? $berita->title }}</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 truncate max-w-xs">{{ Str::limit(strip_tags($berita->draft_content ?? $berita->content), 60) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($berita->status === 'approved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400
                                             text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    Approved
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400
                                             text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 text-xs">
                            {{ $berita->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Edit --}}
                                <button @click="currentBerita = { id: {{ $berita->id }}, title: '{{ addslashes($berita->draft_title ?? $berita->title) }}', content: `{{ addslashes($berita->draft_content ?? $berita->content) }}` }; editBeritaOpen = true"
                                        class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                                               flex items-center justify-center hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors"
                                        title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                {{-- Delete --}}
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                                   flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada berita</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Footer --}}
        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
            Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $beritas->count() }}</span> berita
        </div>
    </div>
</div>

{{-- ===================== 7. TAB: CATATAN ===================== --}}
<div x-show="activeTab === 'catatan'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none;">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Catatan dari Kepala
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Baca dan balas catatan yang dikirim oleh kepala koperasi</p>
    </div>

    {{-- Announcements List --}}
    <div class="space-y-4">
        @forelse($announcements as $ann)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden
                    {{ $ann->is_read_by_admin ? '' : 'ring-2 ring-amber-400 dark:ring-amber-500' }}">
            {{-- Note Header --}}
            <div class="px-5 py-4 flex items-start gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h3 class="font-bold text-gray-900 dark:text-white text-sm">Kepala Koperasi</h3>
                        @if(!$ann->is_read_by_admin)
                        <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 text-xs font-semibold rounded-full">Baru</span>
                        @endif
                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $ann->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $ann->message }}</p>

                    {{-- Existing Replies --}}
                    @if($ann->replies && $ann->replies->count() > 0)
                    <div class="mt-4 space-y-3 pl-4 border-l-2 border-gray-200 dark:border-gray-600">
                        @foreach($ann->replies as $reply)
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-semibold text-blue-600 dark:text-blue-400">{{ $reply->user->name ?? 'Admin' }}</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $reply->message }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Reply Form --}}
            <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700">
                <form action="{{ route('admin.reply.kepala', $ann->id) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    <input type="text" name="message" required placeholder="Tulis balasan..."
                           class="flex-1 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                  rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent
                                  transition-all duration-200">
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white
                                   text-sm font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 shadow-md
                                   hover:shadow-lg transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Balas
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada catatan dari kepala</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ===================== 8. TAB: PRODUK LIST ===================== --}}
<div x-show="activeTab === 'produk_list'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none;">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Daftar Produk
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola kategori produk koperasi</p>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative max-w-md">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari produk..."
                   onkeyup="filterTable(this.value, 'produk-list-table')"
                   class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                          rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent
                          transition-all duration-200">
        </div>
    </div>

    {{-- ERP Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="produk-list-table">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400 w-12">#</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Nama Produk</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Deskripsi</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-28">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @php $prodIdx = 0; @endphp
                    @foreach($dynTabs as $slug => $cat)
                        @if($cat['type'] === 'produk')
                        @php $prodIdx++; @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">{{ $prodIdx }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ $cat['icon'] }}</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $cat['title'] }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-xs max-w-xs truncate">
                                {{ $kontens[$slug]->description ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if(isset($kontens[$slug]) && $kontens[$slug]->status === 'approved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click="setTab('prod_{{ $slug }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400
                                                   text-xs font-semibold rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </button>
                                    <button class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                                   flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors"
                                            title="Hapus" onclick="alert('Fitur hapus kategori tidak tersedia')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Footer --}}
        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
            Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ collect($dynTabs)->where('type', 'produk')->count() }}</span> kategori produk
        </div>
    </div>
</div>

{{-- ===================== 9. TAB: LAYANAN LIST ===================== --}}
<div x-show="activeTab === 'layanan_list'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none;">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Daftar Layanan
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola kategori layanan koperasi</p>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative max-w-md">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari layanan..."
                   onkeyup="filterTable(this.value, 'layanan-list-table')"
                   class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                          rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                          transition-all duration-200">
        </div>
    </div>

    {{-- ERP Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="layanan-list-table">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400 w-12">#</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Nama Layanan</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-400">Deskripsi</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-28">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-400 w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @php $layIdx = 0; @endphp
                    @foreach($dynTabs as $slug => $cat)
                        @if($cat['type'] === 'layanan')
                        @php $layIdx++; @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">{{ $layIdx }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ $cat['icon'] }}</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $cat['title'] }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-xs max-w-xs truncate">
                                {{ $kontens[$slug]->description ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if(isset($kontens[$slug]) && $kontens[$slug]->status === 'approved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click="setTab('lay_{{ $slug }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400
                                                   text-xs font-semibold rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </button>
                                    <button class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                                   flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors"
                                            title="Hapus" onclick="alert('Fitur hapus kategori tidak tersedia')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Footer --}}
        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
            Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ collect($dynTabs)->where('type', 'layanan')->count() }}</span> kategori layanan
        </div>
    </div>
</div>

{{-- ===================== 10. DETAIL TABS FOR EACH PRODUK/LAYANAN ===================== --}}
@foreach($dynTabs as $slug => $cat)
@php
    $tabName = ($cat['type'] === 'produk' ? 'prod_' : 'lay_') . $slug;
    $backTab = $cat['type'] === 'produk' ? 'produk_list' : 'layanan_list';
    $konten  = $kontens[$slug] ?? null;
    $minat   = $minatData[$slug] ?? null;
    $chartId = 'chart_' . str_replace('-', '_', $slug);
    $colorHex = $cat['color'] ?? '#f59e0b';
@endphp
<div x-show="activeTab === '{{ $tabName }}'" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none;">

    {{-- Back Button --}}
    <button @click="setTab('{{ $backTab }}')"
            class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                   rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white
                   hover:border-gray-300 dark:hover:border-gray-600 shadow-sm hover:shadow-md transition-all duration-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar {{ $cat['type'] === 'produk' ? 'Produk' : 'Layanan' }}
    </button>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- LEFT: Profile Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-900 to-gray-700 dark:from-gray-800 dark:to-gray-700 px-6 py-5">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-4xl shadow-lg">
                        {{ $cat['icon'] }}
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">{{ $cat['title'] }}</h3>
                        <div class="mt-1">
                            @if($konten && $konten->status === 'approved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-green-500/20 text-green-300 text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>Approved
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-yellow-500/20 text-yellow-300 text-xs font-semibold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span>Pending
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Rows --}}
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @php
                    $infoRows = [
                        ['label' => 'Nama',        'value' => $konten->draft_title ?? ($konten->title ?? $cat['title'])],
                        ['label' => 'Deskripsi',   'value' => $konten->draft_description ?? ($konten->description ?? 'N/A')],
                        ['label' => 'Persyaratan', 'value' => $konten->draft_syarat ?? ($konten->syarat ?? 'N/A')],
                        ['label' => 'Biaya',       'value' => $konten->draft_harga_info ?? ($konten->harga_info ?? 'N/A')],
                    ];
                @endphp
                @foreach($infoRows as $row)
                <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4">
                    <span class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider w-24 flex-shrink-0 pt-0.5">
                        {{ $row['label'] }}
                    </span>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed flex-1 whitespace-pre-wrap">{{ $row['value'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: Chart + Edit Forms --}}
        <div class="space-y-6">
            {{-- Chart --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-5">
                <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Data Minat — {{ $cat['title'] }}
                </h4>
                <div class="relative h-52">
                    <canvas id="{{ $chartId }}"></canvas>
                </div>
            </div>

            {{-- Edit Minat Form --}}
            <div x-data="{ openMinat: false }" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <button @click="openMinat = !openMinat"
                        class="w-full px-5 py-3 flex items-center justify-between text-left bg-gray-50 dark:bg-gray-700/50
                               hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <span class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        📊 Edit Data Minat
                    </span>
                    <svg :class="openMinat ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openMinat" x-collapse>
                    <form action="{{ route('admin.minat.update') }}" method="POST" class="p-5 space-y-4">
                        @csrf
                        <input type="hidden" name="category" value="{{ $slug }}">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Jumlah Peminat</label>
                                <input type="number" name="count" value="{{ $minat['count'] ?? 0 }}" min="0"
                                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Target</label>
                                <input type="number" name="target" value="{{ $minat['target'] ?? 0 }}" min="0"
                                       class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                              rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-5 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-xl
                                           hover:from-amber-600 hover:to-orange-600 shadow-md hover:shadow-lg transition-all duration-200">
                                Simpan Minat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Edit Konten Form --}}
            <div x-data="{ openKonten: false }" class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <button @click="openKonten = !openKonten"
                        class="w-full px-5 py-3 flex items-center justify-between text-left bg-gray-50 dark:bg-gray-700/50
                               hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <span class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        ✏️ Edit Konten
                    </span>
                    <svg :class="openKonten ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openKonten" x-collapse>
                    <form action="{{ route('admin.konten.update', $slug) }}" method="POST" class="p-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Judul</label>
                            <input type="text" name="title" value="{{ $konten->draft_title ?? ($konten->title ?? '') }}"
                                   class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                          rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Deskripsi</label>
                            <textarea name="description" rows="3"
                                      class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                             rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent resize-none">{{ $konten->draft_description ?? ($konten->description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Persyaratan</label>
                            <textarea name="syarat" rows="3"
                                      class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                             rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent resize-none">{{ $konten->draft_syarat ?? ($konten->syarat ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Info Harga / Biaya</label>
                            <input type="text" name="harga_info" value="{{ $konten->draft_harga_info ?? ($konten->harga_info ?? '') }}"
                                   class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600
                                          rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-5 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl
                                           hover:from-blue-700 hover:to-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                                Simpan Konten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

</div>
{{-- END MAIN CONTENT WRAPPER --}}

{{-- ===================== 11. CHART.JS + FILTER TABLE SCRIPT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    /**
     * filterTable — searches tbody rows by text content
     * @param {string} query  The search string
     * @param {string} tableId  The id of the table element
     */
    function filterTable(query, tableId) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const rows = table.querySelectorAll('tbody tr');
        const q = query.toLowerCase().trim();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    }

    /**
     * Chart.js — render minat charts for each category when tab becomes active
     */
    document.addEventListener('DOMContentLoaded', function () {
        const chartInstances = {};

        @foreach($dynTabs as $slug => $cat)
        @php
            $chartId = 'chart_' . str_replace('-', '_', $slug);
            $minat = $minatData[$slug] ?? null;
            $countVal = $minat['count'] ?? 0;
            $targetVal = $minat['target'] ?? 100;
            $colorHex = $cat['color'] ?? '#f59e0b';
        @endphp
        (function() {
            const canvasId = '{{ $chartId }}';
            const countVal = {{ $countVal }};
            const targetVal = {{ $targetVal }};
            const colorHex = '{{ $colorHex }}';
            const catTitle = @json($cat['title']);

            function initChart() {
                const canvas = document.getElementById(canvasId);
                if (!canvas) return;
                if (chartInstances[canvasId]) {
                    chartInstances[canvasId].destroy();
                }

                const ctx = canvas.getContext('2d');
                const isDark = document.documentElement.classList.contains('dark');
                const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
                const labelColor = isDark ? '#9ca3af' : '#6b7280';

                chartInstances[canvasId] = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Peminat', 'Target'],
                        datasets: [{
                            label: catTitle,
                            data: [countVal, targetVal],
                            backgroundColor: [
                                colorHex + 'cc',
                                isDark ? 'rgba(107,114,128,0.4)' : 'rgba(209,213,219,0.6)'
                            ],
                            borderColor: [colorHex, isDark ? '#6b7280' : '#d1d5db'],
                            borderWidth: 1,
                            borderRadius: 8,
                            barPercentage: 0.5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#1f2937' : '#fff',
                                titleColor: isDark ? '#f9fafb' : '#111827',
                                bodyColor: isDark ? '#d1d5db' : '#4b5563',
                                borderColor: isDark ? '#374151' : '#e5e7eb',
                                borderWidth: 1,
                                cornerRadius: 8,
                                padding: 10,
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: labelColor, font: { size: 12, weight: 600 } }
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: gridColor },
                                ticks: { color: labelColor, font: { size: 11 } }
                            }
                        }
                    }
                });
            }

            // Use MutationObserver to init chart when its container becomes visible
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        const target = mutation.target;
                        if (target.style.display !== 'none') {
                            setTimeout(initChart, 100);
                        }
                    }
                });
            });

            // Observe the parent div that x-show controls
            const canvas = document.getElementById(canvasId);
            if (canvas) {
                let parent = canvas.closest('[x-show]');
                if (parent) {
                    observer.observe(parent, { attributes: true, attributeFilter: ['style'] });
                }
                // Also try to init immediately if visible
                if (canvas.offsetParent !== null) {
                    setTimeout(initChart, 200);
                }
            }
        })();
        @endforeach
    });
</script>
@endsection