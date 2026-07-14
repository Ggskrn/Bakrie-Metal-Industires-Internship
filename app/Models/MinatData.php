<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MinatData extends Model
{
    use HasFactory;

    protected $table = 'minat_data';

    protected $fillable = [
        'category',
        'year',
        'month',
        'anggota',
        'mitra',
        'status',
        'draft_anggota',
        'draft_mitra',
    ];

    /**
     * Nama bulan dalam Bahasa Indonesia.
     */
    public static function monthName(int $month): string
    {
        return ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'][$month] ?? '-';
    }

    public static function categories(): array
    {
        return [
            'sembako'                   => ['title' => 'Sembako',                  'icon' => '🛒', 'type' => 'produk',  'color' => '#F5A623'],
            'pengadaan_logistik'        => ['title' => 'Pengadaan & Logistik',     'icon' => '📦', 'type' => 'produk',  'color' => '#3B82F6'],
            'agrobisnis_infrastruktur'  => ['title' => 'Agrobisnis & Infrastruktur','icon' => '🌾', 'type' => 'produk',  'color' => '#22C55E'],
            'kemitraan_usaha'           => ['title' => 'Kemitraan Usaha',          'icon' => '🤝', 'type' => 'layanan', 'color' => '#8B5CF6'],
            'konsultasi_keuangan'       => ['title' => 'Konsultasi Keuangan',      'icon' => '💼', 'type' => 'layanan', 'color' => '#6366F1'],
            'pelayanan_anggota'         => ['title' => 'Pelayanan Anggota',        'icon' => '👥', 'type' => 'layanan', 'color' => '#0EA5E9'],
            'pemasaran_produk'          => ['title' => 'Pemasaran Produk',         'icon' => '📣', 'type' => 'layanan', 'color' => '#EC4899'],
            'pelatihan_edukasi'         => ['title' => 'Pelatihan & Edukasi',      'icon' => '🎓', 'type' => 'layanan', 'color' => '#F43F5E'],
        ];
    }
}
