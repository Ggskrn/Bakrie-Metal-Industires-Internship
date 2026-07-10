<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - KOP-AJS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Alpine.js + Chart.js via CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased text-slate-800 dark:text-slate-200 min-h-screen transition-colors duration-200">

    {{-- Wrapper utama dengan x-data Alpine.js untuk tab system dan dark mode --}}
    <div x-data="adminDashboard()"
         :class="darkMode ? 'dark bg-slate-900' : 'bg-slate-50'"
         class="flex min-h-screen">

        {{-- ─── SIDEBAR (Responsive & Adaptive Theme) ─── --}}
        <aside :class="darkMode ? 'bg-slate-950 border-slate-800 text-slate-300' : 'bg-slate-950 border-gray-200 text-slate-300'"
               class="w-64 flex-shrink-0 flex flex-col justify-between border-r sticky top-0 h-screen overflow-y-auto z-40 transition-all duration-300">
            <div>
                {{-- Logo KOP-AJS --}}
                <div class="px-6 py-6 border-b border-slate-800 flex items-center gap-3">
                    <div class="w-10 h-10 bg-bakrie-gold rounded-lg flex items-center justify-center font-heading font-extrabold text-bakrie-dark text-lg shadow-md flex-shrink-0">
                        AJS
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white leading-tight">KOP-AJS</h2>
                        <p class="text-[9px] text-bakrie-gold font-bold tracking-widest uppercase">ADMIN PANEL</p>
                    </div>
                </div>

                {{-- Navigasi Tab --}}
                <nav class="px-4 py-6 space-y-1">
                    <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Utama</span>
                    
                    <button @click="setTab('overview')"
                            :class="activeTab === 'overview' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all duration-150 cursor-pointer">
                        <span>📊</span> <span>Dashboard Overview</span>
                    </button>

                    <button @click="setTab('stok')"
                            :class="activeTab === 'stok' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all duration-150 cursor-pointer">
                        <span>🛒</span> <span>Kelola Stok Sembako</span>
                    </button>

                    <button @click="setTab('berita')"
                            :class="activeTab === 'berita' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all duration-150 cursor-pointer">
                        <span>📰</span> <span>Kelola Berita</span>
                    </button>

                    <button @click="setTab('catatan')"
                            :class="activeTab === 'catatan' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all duration-150 cursor-pointer">
                        <span>📜</span> <span>Catatan Kepala</span>
                    </button>

                    {{-- Separator Produk Koperasi --}}
                    <div class="pt-4 pb-1">
                        <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block">Produk Koperasi</span>
                    </div>

                    <button @click="setTab('prod_sembako')"
                            :class="activeTab === 'prod_sembako' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>🛒</span> <span class="truncate">Sembako (Minat)</span>
                    </button>

                    <button @click="setTab('prod_logistik')"
                            :class="activeTab === 'prod_logistik' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>📦</span> <span class="truncate">Pengadaan & Logistik</span>
                    </button>

                    <button @click="setTab('prod_agrobisnis')"
                            :class="activeTab === 'prod_agrobisnis' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>🌾</span> <span class="truncate">Agrobisnis & Infrastruktur</span>
                    </button>

                    {{-- Separator Layanan Koperasi --}}
                    <div class="pt-4 pb-1">
                        <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block">Layanan Koperasi</span>
                    </div>

                    <button @click="setTab('lay_simpanpinjam')"
                            :class="activeTab === 'lay_simpanpinjam' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>💰</span> <span class="truncate">Simpan Pinjam</span>
                    </button>

                    <button @click="setTab('lay_kemitraan')"
                            :class="activeTab === 'lay_kemitraan' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>🤝</span> <span class="truncate">Kemitraan Usaha</span>
                    </button>

                    <button @click="setTab('lay_konsultasi')"
                            :class="activeTab === 'lay_konsultasi' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>💼</span> <span class="truncate">Konsultasi Keuangan</span>
                    </button>

                    <button @click="setTab('lay_pelayanan')"
                            :class="activeTab === 'lay_pelayanan' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>👥</span> <span class="truncate">Pelayanan Anggota</span>
                    </button>

                    <button @click="setTab('lay_pemasaran')"
                            :class="activeTab === 'lay_pemasaran' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>📣</span> <span class="truncate">Pemasaran Produk</span>
                    </button>

                    <button @click="setTab('lay_pelatihan')"
                            :class="activeTab === 'lay_pelatihan' ? 'bg-bakrie-gold text-bakrie-dark font-extrabold shadow-md' : 'text-slate-400 hover:bg-slate-900 hover:text-white'"
                            class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-xl text-xs transition-all duration-150 cursor-pointer pl-6">
                        <span>🎓</span> <span class="truncate">Pelatihan & Edukasi</span>
                    </button>

                    <div class="h-px bg-slate-800 my-4"></div>

                    <a href="{{ route('home') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 hover:bg-slate-900 hover:text-white text-sm transition-all duration-150">
                        <span>🏠</span> <span>Halaman Utama</span>
                    </a>
                </nav>
            </div>

            {{-- Footer Profil --}}
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-sm font-bold text-white flex-shrink-0">A</div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500 truncate">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ─── MAIN CONTENT AREA (Adaptive to Dark Mode) ─── --}}
        <main class="flex-1 flex flex-col min-w-0 min-h-screen">
            
            {{-- Top Header Bar --}}
            <header :class="darkMode ? 'bg-slate-950 border-slate-800' : 'bg-white border-gray-200'"
                    class="h-16 border-b flex items-center justify-between px-8 sticky top-0 z-30 transition-colors duration-300">
                
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Admin Panel</span>
                    <span class="text-gray-300">/</span>
                    <span class="font-bold text-slate-800 dark:text-white" x-text="tabLabels[activeTab] || 'Overview'"></span>
                </div>

                <div class="flex items-center gap-4">
                    {{-- Toggle Dark Mode Switch --}}
                    <button @click="toggleDarkMode()"
                            class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:scale-105 transition-transform duration-150 cursor-pointer">
                        <span x-text="darkMode ? '☀️ Mode Terang' : '🌙 Mode Gelap'" class="text-xs font-bold"></span>
                    </button>

                    <span class="text-xs text-gray-400 font-medium hidden md:block">{{ date('d M Y') }}</span>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-50 dark:bg-red-950/20 hover:bg-red-100 text-red-600 dark:text-red-400 font-bold text-xs py-2 px-4 rounded-xl transition duration-200 border border-red-100 dark:border-red-900/50 cursor-pointer">
                            Logout / Keluar ➔
                        </button>
                    </form>
                </div>
            </header>

            {{-- Slot view dashboard content --}}
            <div class="flex-1 overflow-y-auto">
                @yield('content')
            </div>

        </main>
    </div>

    <script>
        function adminDashboard() {
            return {
                activeTab: localStorage.getItem('admin_active_tab') || 'overview',
                darkMode: localStorage.getItem('dark_mode') === 'true',
                editBeritaOpen: false,
                currentBerita: {},
                tabLabels: {
                    overview: 'Dashboard Overview',
                    stok: 'Kelola Stok Sembako',
                    berita: 'Kelola Berita',
                    catatan: 'Catatan Kepala',
                    prod_sembako: 'Sembako (Statistik Minat)',
                    prod_logistik: 'Pengadaan & Logistik',
                    prod_agrobisnis: 'Agrobisnis & Infrastruktur',
                    lay_simpanpinjam: 'Simpan Pinjam',
                    lay_kemitraan: 'Kemitraan Usaha',
                    lay_konsultasi: 'Konsultasi Keuangan',
                    lay_pelayanan: 'Pelayanan Anggota',
                    lay_pemasaran: 'Pemasaran Produk',
                    lay_pelatihan: 'Pelatihan & Edukasi'
                },
                init() {
                    // Cek jika dark mode di set
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
                setTab(tab) {
                    this.activeTab = tab;
                    localStorage.setItem('admin_active_tab', tab);
                    // Memicu event agar Chart bisa dirender ulang setelah tab dimuat di DOM
                    setTimeout(() => {
                        window.dispatchEvent(new Event('resize'));
                    }, 100);
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
