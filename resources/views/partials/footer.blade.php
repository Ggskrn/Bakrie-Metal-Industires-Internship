<footer class="bg-bakrie-dark text-white pt-16 pb-8">
    <div class="container-custom">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Kolom 1: Logo & Deskripsi -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-bakrie-gold rounded-lg flex items-center justify-center font-heading font-extrabold text-bakrie-dark text-sm">
                        AJS
                    </div>
                    <div>
                        <p class="font-heading font-bold text-sm leading-tight">KOP-AJS</p>
                        <p class="text-[10px] text-gray-400 font-semibold tracking-wider">AMANAH · JAYA · SUKSES</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">Koperasi Amanah Jaya Sukses – melayani kebutuhan anggota dan mitra usaha dengan integritas, amanah, dan profesionalisme.</p>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div>
                <h4 class="font-heading font-bold text-sm mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('about') }}" class="hover:text-bakrie-gold transition">Tentang Kami</a></li>
                    <li><a href="{{ route('products.sembako') }}" class="hover:text-bakrie-gold transition">Produk Sembako</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-bakrie-gold transition">Program Kerja</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-bakrie-gold transition">Daftar Anggota</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Layanan -->
            <div>
                <h4 class="font-heading font-bold text-sm mb-4">Layanan</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('services.simpanpinjam') }}" class="hover:text-bakrie-gold transition">Simpan Pinjam</a></li>
                    <li><a href="{{ route('services.kemitraan') }}" class="hover:text-bakrie-gold transition">Kemitraan Usaha</a></li>
                    <li><a href="{{ route('services.pelayanan') }}" class="hover:text-bakrie-gold transition">Pelayanan Anggota</a></li>
                    <li><a href="{{ route('services.pelatihan') }}" class="hover:text-bakrie-gold transition">Pelatihan & Edukasi</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Kontak & Sosial Media -->
            <div>
                <h4 class="font-heading font-bold text-sm mb-4">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Jl. Raya Bekasi Km. 23, Cakung</li>
                    <li>Jakarta Timur, Indonesia</li>
                    <li><a href="mailto:koperasi@kopajs.co.id" class="hover:text-bakrie-gold transition">koperasi@kopajs.co.id</a></li>
                    <li>+62 21 8978 5678</li>
                </ul>
                <div class="mt-4">
                    <h5 class="font-heading font-bold text-xs mb-2 text-gray-400">Ikuti Kami</h5>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/bakriemetalinds?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-bakrie-gold transition" aria-label="Instagram">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} KOP-AJS – Koperasi Amanah Jaya Sukses. All rights reserved.
        </div>
    </div>
</footer>