@extends('layouts.app')

@section('title', 'Pendaftaran Anggota & Hubungi Kami - KOP-AJS')

@section('content')
<section class="pt-32 pb-20 bg-gradient-to-br from-white via-slate-50 to-amber-50/10 min-h-screen">
    <div class="container-custom">
        <div class="max-w-6xl mx-auto space-y-16">
            
            <!-- Header Utama -->
            <div class="text-center">
                <span class="text-bakrie-gold font-bold text-xs tracking-widest uppercase bg-amber-50 px-4 py-1.5 rounded-full border border-amber-200">Hubungi &amp; Gabung</span>
                <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-bakrie-dark mt-4">Hubungi Kami &amp; Pendaftaran</h1>
                <div class="w-24 h-1 bg-bakrie-gold rounded-full mx-auto mt-4"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Informasi alamat akurat, denah desa operasional PT Bakrie Metal Industries, dan formulir resmi keanggotaan KOP-AJS.</p>
            </div>

            <!-- Bagian Baru: Hubungi Kami & Peta (Denah Akurat) -->
            <div id="hubungi-kami" class="bg-white rounded-3xl border border-gray-200 shadow-xl overflow-hidden grid md:grid-cols-2 gap-0 divide-x divide-slate-100">
                <!-- Info Denah & Peta -->
                <div class="p-8 space-y-6">
                    <h3 class="text-2xl font-heading font-extrabold text-bakrie-dark">📍 Lokasi &amp; Denah Operasional</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Kantor operasional KOP-AJS berlokasi di area strategis kawasan industri PT Bakrie Metal Industries. Berikut rincian peta koordinat presisi.
                    </p>

                    <!-- Foto Denah Google Maps PT Bakrie Metal Industries (Asli) -->
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-md">
                        <img src="{{ asset('images/denah-kopajs.JPEG') }}" alt="Denah Lokasi PT Bakrie Metal Industries - KOP-AJS" class="w-full object-cover" style="height: 260px;">
                        <!-- Overlay Info -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent flex flex-col justify-between p-4 pointer-events-none">
                            <div class="self-start">
                                <span class="bg-bakrie-gold text-bakrie-dark text-xs font-extrabold px-3 py-1.5 rounded-lg shadow">
                                    📍 Denah Area KOP-AJS
                                </span>
                            </div>
                            <div class="text-white space-y-0.5">
                                <p class="text-[10px] font-bold text-bakrie-gold tracking-wider">Titik Koordinat GPS:</p>
                                <p class="font-mono text-sm tracking-widest font-bold">6°11'43.2"S 106°57'02.1"E</p>
                                <p class="text-[10px] text-slate-300">Jl. Pejuang, Cakung — Jakarta Timur</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Alamat Resmi -->
                    <div class="space-y-3 text-sm text-gray-700">
                        <div class="flex items-start gap-3">
                            <span class="text-xl">🏢</span>
                            <div>
                                <strong class="text-slate-800">Alamat Korespondensi:</strong>
                                <p class="mt-0.5 text-gray-500">Kawasan Industri PT Bakrie Metal Industries, Jl. Raya Bekasi Km. 23, Cakung, Jakarta Timur, 13910, Indonesia</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-xl">📧</span>
                            <div>
                                <strong class="text-slate-800">Email Resmi:</strong>
                                <p class="mt-0.5"><a href="mailto:koperasi@kopajs.co.id" class="text-bakrie-gold font-semibold hover:underline">koperasi@kopajs.co.id</a></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-xl">📞</span>
                            <div>
                                <strong class="text-slate-800">Telepon / Fax:</strong>
                                <p class="mt-0.5 text-gray-500">+62 21 8978 5678 (Ext. 204)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Jam Operasional & Layanan Pengaduan -->
                <div class="p-8 bg-slate-50/50 flex flex-col justify-between space-y-6">
                    <div>
                        <h3 class="text-2xl font-heading font-extrabold text-bakrie-dark">🕒 Waktu Layanan</h3>
                        <p class="text-slate-500 text-sm mt-1">Kami siap melayani kebutuhan anggota koperasi pada jam kerja berikut:</p>
                        
                        <div class="space-y-3 mt-6">
                            <div class="flex justify-between items-center border-b border-gray-200/80 pb-2 text-sm">
                                <span class="text-gray-500">Senin - Jumat</span>
                                <strong class="text-slate-800">07:30 - 16:30 WIB</strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200/80 pb-2 text-sm">
                                <span class="text-gray-500">Istirahat</span>
                                <strong class="text-slate-800">12:00 - 13:00 WIB</strong>
                            </div>
                            <div class="flex justify-between items-center pb-2 text-sm">
                                <span class="text-gray-500">Sabtu, Minggu &amp; Libur Nasional</span>
                                <strong class="text-red-600 bg-red-50 px-3 py-0.5 rounded-full text-xs font-bold">Tutup</strong>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-bakrie-dark to-slate-800 text-white p-6 rounded-2xl shadow-md space-y-2">
                        <h4 class="font-bold text-sm text-bakrie-gold">🛡️ Layanan Anggota Cepat</h4>
                        <p class="text-xs text-gray-300 leading-relaxed">Pengajuan pinjaman darurat atau pendaftaran anggota dapat pula dikoordinasikan langsung melalui WhatsApp resmi KOP-AJS.</p>
                    </div>
                </div>
            </div>

            <!-- Form Pendaftaran Anggota -->
            <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-8 md:p-10 space-y-6">
                <div class="border-b pb-4">
                    <h3 class="text-2xl font-heading font-extrabold text-bakrie-dark">📝 Formulir Pendaftaran Anggota Baru</h3>
                    <p class="text-slate-500 text-sm mt-1">Isi data diri Anda secara lengkap dan akurat di bawah ini untuk memulai proses keanggotaan koperasi KOP-AJS.</p>
                </div>

                <form action="#" method="POST" class="space-y-6" onsubmit="event.preventDefault(); alert('Terima kasih! Formulir pendaftaran berhasil diajukan.');">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Lengkap (Sesuai KTP)</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition">
                        </div>
                        <div>
                            <label for="nik" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Induk Karyawan (NIK)</label>
                            <input type="text" id="nik" name="nik" required placeholder="Contoh: BMI-202612" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Alamat Email Aktif</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition">
                        </div>
                        <div>
                            <label for="phone" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor HP / WhatsApp Aktif</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Contoh: 085179737735" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition">
                        </div>
                    </div>

                    <div>
                        <label for="division" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Divisi / Departemen Kerja</label>
                        <input type="text" id="division" name="division" required placeholder="Contoh: Produksi / Logistik / Keuangan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition">
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pesan / Alasan Bergabung (Opsional)</label>
                        <textarea id="message" name="message" rows="4" placeholder="Tulis catatan atau alasan pengajuan Anda di sini..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakrie-gold/50 focus:border-bakrie-gold text-sm transition"></textarea>
                    </div>

                    <div class="pt-4 border-t">
                        <button type="submit" class="w-full bg-bakrie-dark text-white font-extrabold py-3.5 rounded-xl hover:bg-slate-800 transition shadow-lg text-sm">
                            Kirim Formulir Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
@endsection
