<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MinatData;

class MinatDataSeeder extends Seeder
{
    public function run(): void
    {
        // Data awal per kategori: [anggota_jan2024, mitra_jan2024, pertumbuhan_per_bulan]
        $base = [
            'sembako'                  => ['a' => 148, 'm' => 18,  'ga' => 1.04, 'gm' => 1.03],
            'pengadaan_logistik'       => ['a' => 28,  'm' => 14,  'ga' => 1.06, 'gm' => 1.05],
            'agrobisnis_infrastruktur' => ['a' => 22,  'm' => 9,   'ga' => 1.05, 'gm' => 1.04],
            'simpan_pinjam'            => ['a' => 195, 'm' => 0,   'ga' => 1.05, 'gm' => 1.0],
            'kemitraan_usaha'          => ['a' => 42,  'm' => 28,  'ga' => 1.07, 'gm' => 1.06],
            'konsultasi_keuangan'      => ['a' => 76,  'm' => 4,   'ga' => 1.04, 'gm' => 1.03],
            'pelayanan_anggota'        => ['a' => 175, 'm' => 0,   'ga' => 1.05, 'gm' => 1.0],
            'pemasaran_produk'         => ['a' => 32,  'm' => 22,  'ga' => 1.06, 'gm' => 1.05],
            'pelatihan_edukasi'        => ['a' => 58,  'm' => 6,   'ga' => 1.06, 'gm' => 1.04],
        ];

        $rows = [];

        foreach ($base as $category => $d) {
            $a = $d['a'];
            $m = $d['m'];

            // Generate Jan 2024 - Dec 2025 (24 bulan)
            for ($year = 2024; $year <= 2025; $year++) {
                for ($month = 1; $month <= 12; $month++) {
                    $rows[] = [
                        'category'    => $category,
                        'year'        => $year,
                        'month'       => $month,
                        'anggota'     => (int) round($a),
                        'mitra'       => (int) round($m),
                        'status'      => 'approved',
                        'draft_anggota' => null,
                        'draft_mitra'   => null,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                    // Terapkan pertumbuhan
                    $a *= $d['ga'];
                    if ($m > 0) $m *= $d['gm'];
                    // Tambahkan sedikit noise realistis
                    $a += rand(-3, 3);
                    $m += rand(-1, 1);
                    if ($a < 0) $a = 0;
                    if ($m < 0) $m = 0;
                }
            }
        }

        // Chunk insert untuk performa
        foreach (array_chunk($rows, 50) as $chunk) {
            MinatData::insert($chunk);
        }

        $this->command->info('MinatData seeded: ' . count($rows) . ' rows.');
    }
}
