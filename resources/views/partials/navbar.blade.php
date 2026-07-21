{{-- Navbar dengan Mega-Menu Full-Width (Produk & Layanan Gabungan) --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-lg border-b border-gray-100 transition-all duration-300"
     x-data="{ menuOpen: false }"
     @mouseleave="menuOpen = false">

    <div class="container-custom">
        <div class="flex items-center justify-between h-24">

            <!-- ── Logo ── -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-br from-bakrie-gold to-yellow-500 rounded-xl flex items-center justify-center font-heading font-extrabold text-bakrie-dark text-xl transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg shadow-md">
                        AJS
                    </div>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-bakrie-gold rounded-full border-2 border-white"></span>
                </div>
                <div>
                    <h1 class="font-heading font-extrabold text-xl leading-tight text-bakrie-dark tracking-tight">KOP-AJS</h1>
                    <p class="text-[11px] text-bakrie-gold font-bold tracking-widest uppercase">AMANAH · JAYA · SUKSES</p>
                    <p class="text-[9px] text-gray-400 font-medium tracking-wider">Koperasi PT Bakrie Metal Industries</p>
                </div>
            </a>

            <!-- ── Menu Desktop ── -->
            <div class="hidden md:flex items-center gap-7">

                <!-- Beranda -->
                <a href="{{ route('home') }}" class="font-semibold text-sm text-gray-700 hover:text-bakrie-gold transition-colors duration-200 relative group {{ request()->routeIs('home') ? 'text-bakrie-gold' : '' }}">
                    Beranda
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-bakrie-gold rounded-full transition-all duration-300 group-hover:w-full {{ request()->routeIs('home') ? 'w-full' : 'w-0' }}"></span>
                </a>

                <!-- Tentang -->
                <a href="{{ route('about') }}" class="font-semibold text-sm text-gray-700 hover:text-bakrie-gold transition-colors duration-200 relative group {{ request()->routeIs('about') ? 'text-bakrie-gold' : '' }}">
                    Tentang
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-bakrie-gold rounded-full transition-all duration-300 group-hover:w-full {{ request()->routeIs('about') ? 'w-full' : 'w-0' }}"></span>
                </a>

                <!-- Produk & Layanan — tombol trigger -->
                <button @mouseenter="menuOpen = true"
                        @click="menuOpen = !menuOpen"
                        class="flex items-center gap-1.5 font-semibold text-sm transition-colors duration-200 px-3 py-2 rounded-lg {{ request()->routeIs('products.*') || request()->routeIs('services.*') ? 'text-bakrie-gold bg-amber-50' : 'text-gray-700 hover:text-bakrie-gold hover:bg-amber-50/50' }}">
                    Produk &amp; Layanan
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': menuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Berita -->
                <a href="{{ route('news') }}" class="font-semibold text-sm text-gray-700 hover:text-bakrie-gold transition-colors duration-200 relative group {{ request()->routeIs('news') ? 'text-bakrie-gold' : '' }}">
                    Berita
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-bakrie-gold rounded-full transition-all duration-300 group-hover:w-full {{ request()->routeIs('news') ? 'w-full' : 'w-0' }}"></span>
                </a>

                <!-- Hubungi Kami -->
                <a href="{{ route('contact') }}#hubungi-kami" class="font-semibold text-sm text-gray-700 hover:text-bakrie-gold transition-colors duration-200 relative group">
                    Hubungi Kami
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-bakrie-gold rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>

                <!-- CTA Daftar Anggota -->
                @php
                    $kontenAnggota = \App\Models\ProdukLayananKonten::where('slug', 'jumlah_anggota')->first();
                    $dbMemberCount = \App\Models\User::where('role', 'public')->count();
                    $memberCount = ($kontenAnggota ? (int)$kontenAnggota->description : 1200) + $dbMemberCount;
                @endphp
                <a href="{{ route('contact') }}" class="btn-primary text-sm transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    Daftar Anggota ({{ number_format($memberCount) }})
                </a>

                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kepala')
                        <!-- Tombol Dashboard untuk Admin & Kepala (muncul di navbar) -->
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" 
                           class="flex items-center gap-2 px-4 py-2 text-sm bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('public.dashboard') }}" class="px-4 py-2 text-sm bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition duration-200">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800 transition">
                                Logout
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm border border-bakrie-gold text-bakrie-dark font-semibold rounded-xl hover:bg-amber-50 transition duration-200">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Toggle -->
            <button id="mobile-menu-toggle" class="md:hidden text-gray-700 hover:text-bakrie-gold transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mega Menu Panel (Dinamis & Terkoneksi Database) -->
    <div x-show="menuOpen"
         @mouseenter="menuOpen = true"
         @mouseleave="menuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display:none;"
         class="absolute top-full left-0 right-0 bg-white border-t border-gray-100 shadow-[0_24px_60px_rgba(0,0,0,0.13)] z-40">

        {{-- Accent bar emas di atas panel --}}
        <div class="h-1 bg-gradient-to-r from-bakrie-gold via-yellow-400 to-amber-500"></div>

        {{-- Sub-header identitas --}}
        <div class="bg-gradient-to-r from-amber-50/70 via-white to-blue-50/30 px-8 py-3 border-b border-dashed border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-bakrie-gold/15 rounded-lg flex items-center justify-center">
                    <span class="text-xs font-extrabold text-bakrie-gold">AJS</span>
                </div>
                <div>
                    <p class="text-sm font-extrabold text-bakrie-dark">Produk &amp; Layanan Koperasi AJS</p>
                    <p class="text-[10px] text-gray-400 font-medium">Temukan semua produk sembako dan layanan keuangan koperasi kami</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-[11px] text-gray-400 italic font-medium">
                <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse inline-block"></span>
                Layanan Aktif · Amanah Jaya Sukses
            </div>
        </div>

        {{-- Dua Kolom Konten --}}
        <div class="container-custom">
            <div class="grid grid-cols-2 gap-0 divide-x-2 divide-amber-100 py-2">

                @php
                    $navCategories = \App\Models\MinatData::categories();
                    $navKontens = \App\Models\ProdukLayananKonten::all()->keyBy('slug');
                    $produkCount = collect($navCategories)->where('type', 'produk')->count();
                    $layananCount = collect($navCategories)->where('type', 'layanan')->count();
                @endphp

                {{-- ════ KOLOM KIRI: PRODUK ════ --}}
                <div class="py-5 pr-8 text-left">
                    {{-- Label Kategori --}}
                    <div class="flex items-center gap-2 mb-4 px-2">
                        <div class="w-1.5 h-6 bg-gradient-to-b from-bakrie-gold to-yellow-500 rounded-full"></div>
                        <span class="text-xs font-extrabold text-bakrie-gold tracking-[0.18em] uppercase">Produk Koperasi</span>
                        <span class="text-[10px] bg-amber-100 text-amber-700 font-bold px-2 py-0.5 rounded-full">{{ $produkCount }} Produk</span>
                    </div>

                    <div class="space-y-1">
                        @foreach($navCategories as $slug => $meta)
                            @if($meta['type'] === 'produk')
                                @php
                                    $kntn = $navKontens[$slug] ?? null;
                                    $routeMap = [
                                        'sembako' => 'products.sembako',
                                        'pengadaan_logistik' => 'products.logistik',
                                        'agrobisnis_infrastruktur' => 'products.agrobisnis',
                                    ];
                                    $routeDest = route($routeMap[$slug] ?? 'home');
                                @endphp
                                <a href="{{ $routeDest }}"
                                   class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group hover:bg-amber-50/60 border-l-4 border-transparent hover:border-bakrie-gold/50">
                                    <span class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform duration-200">{{ $meta['icon'] }}</span>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-sm text-gray-800 group-hover:text-bakrie-gold leading-tight">{{ $kntn ? $kntn->title : $meta['title'] }}</h4>
                                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed truncate">{{ $kntn ? $kntn->description : 'Informasi rincian produk koperasi KOP-AJS' }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-300 group-hover:text-bakrie-gold ml-auto flex-shrink-0 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- CTA lihat semua --}}
                    <div class="mt-4 mx-4 pt-3 border-t border-dashed border-amber-200">
                        <a href="{{ route('products') }}" class="inline-flex items-center gap-1 text-xs font-bold text-bakrie-gold hover:underline">
                            Lihat semua produk
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                {{-- ════ KOLOM KANAN: LAYANAN ════ --}}
                <div class="py-5 pl-8 text-left">
                    {{-- Label Kategori --}}
                    <div class="flex items-center gap-2 mb-4 px-2">
                        <div class="w-1.5 h-6 bg-gradient-to-b from-blue-500 to-blue-600 rounded-full"></div>
                        <span class="text-xs font-extrabold text-blue-600 tracking-[0.18em] uppercase">Layanan Koperasi</span>
                        <span class="text-[10px] bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded-full">{{ $layananCount }} Layanan</span>
                    </div>

                    {{-- Grid untuk layanan --}}
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                        @foreach($navCategories as $slug => $meta)
                            @if($meta['type'] === 'layanan')
                                @php
                                    $kntn = $navKontens[$slug] ?? null;
                                    $routeMap = [
                                        'kemitraan_usaha' => 'services.kemitraan',
                                        'konsultasi_keuangan' => 'services.konsultasi',
                                        'pelayanan_anggota' => 'services.pelayanan',
                                        'pemasaran_produk' => 'services.pemasaran',
                                        'pelatihan_edukasi' => 'services.pelatihan',
                                    ];
                                    $routeDest = route($routeMap[$slug] ?? 'services');
                                @endphp
                                <a href="{{ $routeDest }}"
                                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group hover:bg-blue-50/50 border-l-4 border-transparent hover:border-blue-400/60">
                                    <span class="text-xl flex-shrink-0 group-hover:scale-110 transition-transform duration-200">{{ $meta['icon'] }}</span>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-sm text-gray-800 group-hover:text-blue-600 leading-tight">{{ $kntn ? $kntn->title : $meta['title'] }}</h4>
                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-relaxed truncate">{{ $kntn ? $kntn->description : 'Informasi rincian layanan koperasi KOP-AJS' }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- CTA lihat semua --}}
                    <div class="mt-4 mx-3 pt-3 border-t border-dashed border-blue-200">
                        <a href="{{ route('services') }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:underline">
                            Lihat semua layanan
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>{{-- end container --}}

        {{-- Footer bar ornamen kepercayaan --}}
        <div class="bg-gradient-to-r from-bakrie-dark via-slate-800 to-slate-900 px-8 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3 text-left">
                <span class="text-base">🛡️</span>
                <p class="text-xs text-gray-300 font-medium">Koperasi Resmi &amp; Berbadan Hukum · PT Bakrie Metal Industries · Beroperasi Sejak <strong class="text-bakrie-gold">1995</strong></p>
            </div>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-xs font-bold text-bakrie-gold hover:text-yellow-300 transition-colors duration-200">
                Daftar Anggota Sekarang
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>{{-- end mega-menu --}}
</nav>