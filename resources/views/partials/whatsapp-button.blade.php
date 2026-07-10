<!-- WhatsApp Floating Button with Interactive Chat Simulation -->
<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50">
    <!-- Bubble Chat Popup -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-95"
         class="absolute bottom-20 right-0 w-88 md:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col"
         style="display: none; filter: drop-shadow(0 25px 25px rgba(0, 0, 0, 0.15));">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-green-700 text-white p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center font-heading font-extrabold text-sm text-white">
                        AJS
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-green-600 rounded-full"></span>
                </div>
                <div>
                    <h4 class="font-heading font-bold text-sm leading-tight text-white">Layanan Chat KOP AJS</h4>
                    <p class="text-[11px] text-green-100 flex items-center gap-1 mt-0.5">
                        <span class="inline-block w-1.5 h-1.5 bg-green-300 rounded-full animate-pulse"></span>
                        Online · Siap Membantu
                    </p>
                </div>
            </div>
            <button @click="open = false" class="text-white/80 hover:text-white transition focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Body / Pertanyaan Simulasi -->
        <div class="p-4 max-h-[350px] overflow-y-auto space-y-3 bg-gray-50/50">
            <p class="text-xs text-gray-500 font-semibold mb-1">Pilih simulasi pertanyaan atau topik berikut:</p>
            
            <!-- Group Produk -->
            <div>
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1.5">🛒 Produk Koperasi</p>
                <div class="space-y-2">
                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20saya%20ingin%20menanyakan%20daftar%20harga%20sembako%20terbaru%20di%20koperasi." target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700">Tanya Sembako</span>
                            <span class="text-[10px] text-gray-400">Paling Sering</span>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Saya ingin menanyakan daftar harga sembako terbaru..."</p>
                    </a>
                    
                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20saya%20tertarik%20mengenai%20layanan%20pengadaan%20bahan%20baku%20dan%20logistik%20skala%20korporat." target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 block">Pengadaan & Logistik Korporat</span>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Saya tertarik mengenai layanan pengadaan bahan baku..."</p>
                    </a>

                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20mohon%20informasi%20mengenai%2 	" target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 block">Agrobisnis & Cold Storage</span>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Mohon informasi sewa cold storage dan hasil bumi..."</p>
                    </a>
                </div>
            </div>

            <!-- Group Layanan -->
            <div class="pt-1">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1.5">🏦 Layanan Keuangan & Pemberdayaan</p>
                <div class="space-y-2">
                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20saya%20ingin%20tahu%20syarat%20dan%20cara%20mengajukan%20pinjaman%20anggota%20%2F%20karyawan." target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700">Simpan Pinjam</span>
                            <span class="text-[10px] text-gray-400">Populer</span>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Saya ingin tahu syarat mengajukan pinjaman karyawan..."</p>
                    </a>

                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20bagaimana%20prosedur%20kemitraan%20usaha%20atau%20menjadi%20supplier%20Koperasi%20BMI%3F" target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 block">Kemitraan Usaha & Supplier</span>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Bagaimana prosedur kemitraan atau menjadi supplier..."</p>
                    </a>

                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20saya%20ingin%20menjadwalkan%20sesi%20konsultasi%20keuangan%20gratis%20untuk%20anggota." target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 block">Konsultasi Keuangan Anggota</span>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Saya ingin menjadwalkan konsultasi keuangan..."</p>
                    </a>

                    <a href="https://wa.me/6285819920149?text=Halo%20KOP%20AJS%2C%20mohon%20info%20jadwal%20pelatihan%20wirausaha%20koperasi%20terdekat." target="_blank" class="block p-2.5 bg-white hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-xl text-left transition group">
                        <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 block">Pelatihan Kewirausahaan</span>
                        <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">"Mohon info jadwal pelatihan wirausaha terdekat..."</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Custom Input -->
        <div class="p-3 bg-white border-t border-gray-100 flex items-center gap-2" x-data="{ customMsg: '' }">
            <input type="text" 
                   x-model="customMsg" 
                   @keydown.enter="if(customMsg.trim() !== '') { window.open('https://wa.me/6285819920149?text=' + encodeURIComponent(customMsg), '_blank'); customMsg = ''; }"
                   placeholder="Ketik pertanyaan khusus..." 
                   class="flex-1 px-3 py-2 text-xs border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500">
            <button @click="if(customMsg.trim() !== '') { window.open('https://wa.me/6285819920149?text=' + encodeURIComponent(customMsg), '_blank'); customMsg = ''; }" 
                    class="p-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition focus:outline-none">
                <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Floating Trigger Button -->
    <button @click="open = !open" 
            class="relative flex items-center justify-center w-16 h-16 bg-emerald-500 rounded-full shadow-2xl hover:shadow-emerald-500/50 transition-all duration-300 hover:scale-110 hover:rotate-3 focus:outline-none group"
            aria-label="Chat via WhatsApp">
        <!-- WhatsApp Icon -->
        <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        <!-- Pulse ring effect -->
        <span class="absolute inset-0 rounded-full animate-ping bg-green-400 opacity-20 group-hover:opacity-40"></span>
    </button>
</div>