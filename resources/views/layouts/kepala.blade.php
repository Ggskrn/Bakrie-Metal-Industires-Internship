<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kepala Dashboard - KOP-AJS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-item { transition: all 0.18s cubic-bezier(.4,0,.2,1); }
        .sidebar-item:hover { transform: translateX(3px); }
    </style>
</head>
<body class="antialiased min-h-screen transition-colors duration-200">

    <div x-data="kepalaDashboard()"
         :class="darkMode ? 'dark bg-slate-900 text-slate-200' : 'bg-slate-50 text-slate-800'"
         class="flex min-h-screen">

        {{-- ─── SIDEBAR ─── --}}
        <aside class="w-64 flex-shrink-0 flex flex-col justify-between bg-slate-950 border-r border-slate-800 text-slate-300 sticky top-0 h-screen overflow-y-auto z-40 transition-all duration-300">
            <div>
                {{-- Logo --}}
                <div class="px-6 py-5 border-b border-slate-800 flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center font-heading font-extrabold text-white text-lg shadow-md flex-shrink-0">
                        AJS
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white leading-tight">KOP-AJS</h2>
                        <p class="text-[9px] text-blue-400 font-bold tracking-widest uppercase">KEPALA PANEL</p>
                    </div>
                </div>

                <nav class="px-3 py-4 space-y-0.5">

                    {{-- ── UTAMA ── --}}
                    <p class="px-3 pt-1 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Utama</p>

                    <button @click="setTab('overview')"
                            :class="activeTab === 'overview' ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Dashboard Overview</span>
                    </button>

                    <button @click="setTab('approval')"
                            :class="activeTab === 'approval' ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer relative">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Menunggu Approval</span>
                        <span id="pending-badge-total" class="absolute right-3 top-3 w-2 h-2 bg-red-500 rounded-full hidden animate-pulse"></span>
                    </button>

                    <button @click="setTab('kirim')"
                            :class="activeTab === 'kirim' ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>Kirim Catatan</span>
                    </button>

                    <button @click="setTab('riwayat')"
                            :class="activeTab === 'riwayat' ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Riwayat Catatan</span>
                    </button>

                    {{-- ── PRODUK & LAYANAN (Accordion) ── --}}
                    <div class="pt-3">
                        <p class="px-3 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Produk & Layanan</p>

                        <button @click="setTab('produk_list')"
                                :class="activeTab==='produk_list' || activeTab.startsWith('prod_') ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                                class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Produk Koperasi</span>
                        </button>

                        <button @click="setTab('layanan_list')"
                                :class="activeTab==='layanan_list' || activeTab.startsWith('lay_') ? 'bg-blue-600 text-white font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                                class="sidebar-item w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm cursor-pointer mt-0.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Layanan Koperasi</span>
                        </button>
                    </div>

                    <div class="h-px bg-slate-800 my-3"></div>

                    <a href="{{ route('home') }}"
                       class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Halaman Utama</span>
                    </a>
                </nav>
            </div>

            {{-- Footer Profil --}}
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-1">
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-sm font-bold text-white flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500 truncate">Kepala Koperasi</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ─── MAIN CONTENT ─── --}}
        <main class="flex-1 flex flex-col min-w-0 min-h-screen">

            {{-- Top Header --}}
            <header :class="darkMode ? 'bg-slate-950 border-slate-800' : 'bg-white border-gray-200'"
                    class="h-16 border-b flex items-center justify-between px-8 sticky top-0 z-30 transition-colors duration-300">

                <div class="flex items-center gap-2 text-sm">
                    <span :class="darkMode ? 'text-slate-500' : 'text-gray-400'" class="font-medium">Kepala Panel</span>
                    <span :class="darkMode ? 'text-slate-600' : 'text-gray-300'">/</span>
                    <span :class="darkMode ? 'text-white' : 'text-slate-800'" class="font-bold" x-text="tabLabels[activeTab] || 'Overview'"></span>
                </div>

                <div class="flex items-center gap-3">
                    <button @click="toggleDarkMode()"
                            :class="darkMode ? 'bg-slate-800 text-yellow-400' : 'bg-slate-100 text-slate-600'"
                            class="p-2 rounded-xl hover:scale-105 transition-transform duration-150 cursor-pointer flex items-center gap-1.5 text-xs font-bold px-3">
                        <span x-text="darkMode ? '☀️' : '🌙'"></span>
                        <span x-text="darkMode ? 'Light' : 'Dark'" class="hidden sm:inline"></span>
                    </button>
                    <span :class="darkMode ? 'text-slate-500' : 'text-gray-400'" class="text-xs font-medium hidden md:block">{{ date('d M Y') }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                :class="darkMode ? 'bg-red-950/30 border-red-900/50 text-red-400 hover:bg-red-950/60' : 'bg-red-50 border-red-100 text-red-600 hover:bg-red-100'"
                                class="font-bold text-xs py-2 px-4 rounded-xl transition duration-200 border cursor-pointer">
                            Logout ➔
                        </button>
                    </form>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function kepalaDashboard() {
            return {
                activeTab: localStorage.getItem('kepala_active_tab') || 'overview',
                darkMode: localStorage.getItem('dark_mode') === 'true',
                tabLabels: {
                    overview: 'Dashboard Overview',
                    approval: 'Menunggu Approval',
                    kirim: 'Kirim Catatan ke Admin',
                    riwayat: 'Riwayat Catatan & Klarifikasi',
                    produk_list: 'Produk Koperasi',
                    layanan_list: 'Layanan Koperasi',
                    prod_sembako: 'Produk Koperasi',
                    prod_pengadaan_logistik: 'Produk Koperasi',
                    prod_agrobisnis_infrastruktur: 'Produk Koperasi',
                    lay_kemitraan_usaha: 'Layanan Koperasi',
                    lay_konsultasi_keuangan: 'Layanan Koperasi',
                    lay_pelayanan_anggota: 'Layanan Koperasi',
                    lay_pemasaran_produk: 'Layanan Koperasi',
                    lay_pelatihan_edukasi: 'Layanan Koperasi',
                },
                detailLabels: {
                    prod_sembako: 'Detail — Sembako',
                    prod_pengadaan_logistik: 'Detail — Pengadaan & Logistik',
                    prod_agrobisnis_infrastruktur: 'Detail — Agrobisnis & Infrastruktur',
                    lay_kemitraan_usaha: 'Detail — Kemitraan Usaha',
                    lay_konsultasi_keuangan: 'Detail — Konsultasi Keuangan',
                    lay_pelayanan_anggota: 'Detail — Pelayanan Anggota',
                    lay_pemasaran_produk: 'Detail — Pemasaran Produk',
                    lay_pelatihan_edukasi: 'Detail — Pelatihan & Edukasi',
                },
                init() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
                setTab(tab) {
                    this.activeTab = tab;
                    localStorage.setItem('kepala_active_tab', tab);
                    setTimeout(() => { window.dispatchEvent(new Event('resize')); }, 120);
                },
                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('dark_mode', this.darkMode);
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }
        }
    </script>

</body>
</html>
