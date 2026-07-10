<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukLayananKonten;

class ProdukLayananKontenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'slug' => 'sembako',
                'title' => 'Sembako',
                'description' => 'Kebutuhan pokok berkualitas dengan harga kompetitif untuk anggota.',
                'syarat' => '1. Terdaftar sebagai Anggota KOP-AJS. 2. Membawa Kartu Anggota Koperasi.',
                'harga_info' => 'Mulai dari Rp 12.000 (Tepung Terigu) s/d Rp 125.000 (Beras Premium 10kg)',
            ],
            [
                'slug' => 'pengadaan_logistik',
                'title' => 'Pengadaan & Logistik',
                'description' => 'Bahan baku, mesin, dan alat berat skala korporat.',
                'syarat' => '1. Pengajuan Purchase Order (PO) resmi dari PT Bakrie Metal Industries atau mitra terafiliasi. 2. Persetujuan Departemen Logistik.',
                'harga_info' => 'Sesuai dengan nilai penawaran PO & Kontrak Kerjasama korporat.',
            ],
            [
                'slug' => 'agrobisnis_infrastruktur',
                'title' => 'Agrobisnis & Infrastruktur',
                'description' => 'Silo, cold storage, dan agro-industri terpadu.',
                'syarat' => '1. Pengajuan proposal kemitraan agrobisnis. 2. Memiliki lahan atau komoditas yang bersesuaian.',
                'harga_info' => 'Berdasarkan nilai investasi proyek & bagi hasil kerjasama.',
            ],
            [
                'slug' => 'simpan_pinjam',
                'title' => 'Simpan Pinjam',
                'description' => 'Pinjaman ringan dengan proses cepat dan bunga koperasi yang bersahabat.',
                'syarat' => '1. Anggota aktif minimal 3 bulan. 2. Slip gaji atau rekomendasi HRD PT Bakrie Metal Industries.',
                'harga_info' => 'Bunga jasa pinjaman mulai 1% flat per bulan.',
            ],
            [
                'slug' => 'kemitraan_usaha',
                'title' => 'Kemitraan Usaha',
                'description' => 'Supplier terpercaya dengan jaringan luas bagi usaha mikro dan menengah.',
                'syarat' => '1. Memiliki usaha aktif. 2. Menandatangani MoU kerjasama kemitraan.',
                'harga_info' => 'Bagi hasil kemitraan / Margin keuntungan disepakati dalam akad.',
            ],
            [
                'slug' => 'konsultasi_keuangan',
                'title' => 'Konsultasi Keuangan',
                'description' => 'Konsultan profesional gratis untuk perencanaan keuangan masa depan.',
                'syarat' => '1. Anggota KOP-AJS atau Karyawan PT BMI. 2. Melakukan reservasi jadwal melalui WhatsApp.',
                'harga_info' => 'Gratis (Fasilitas Khusus Anggota KOP-AJS).',
            ],
            [
                'slug' => 'pelayanan_anggota',
                'title' => 'Pelayanan Anggota',
                'description' => 'Pendaftaran anggota baru, update data berkala, layanan 24/7.',
                'syarat' => '1. Karyawan PT Bakrie Metal Industries atau Masyarakat Umum Mitra. 2. Mengisi formulir pendaftaran anggota.',
                'harga_info' => 'Simpanan Pokok Rp 100.000 (sekali bayar), Simpanan Wajib Rp 50.000 (per bulan).',
            ],
            [
                'slug' => 'pemasaran_produk',
                'title' => 'Pemasaran Produk',
                'description' => 'Promosi toko, marketplace koperasi, pameran produk anggota.',
                'syarat' => '1. Memiliki produk buatan sendiri. 2. Lolos kurasi standar kualitas koperasi.',
                'harga_info' => 'Biaya listing gratis, bagi hasil penjualan 2-5% untuk koperasi.',
            ],
            [
                'slug' => 'pelatihan_edukasi',
                'title' => 'Pelatihan & Edukasi',
                'description' => 'Workshop kewirausahaan, literasi keuangan terstruktur, sertifikat pelatihan.',
                'syarat' => '1. Mendaftar pada event pelatihan aktif. 2. Membuka tabungan koperasi.',
                'harga_info' => 'Subsidi Koperasi (Sebagian gratis, sebagian berbayar murah).',
            ],
        ];

        foreach ($data as $item) {
            ProdukLayananKonten::create(array_merge($item, [
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('ProdukLayananKonten seeded.');
    }
}
