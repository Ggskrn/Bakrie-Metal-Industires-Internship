<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukLayananKonten extends Model
{
    use HasFactory;

    protected $table = 'produk_layanan_konten';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'syarat',
        'harga_info',
        'status',
        'draft_title',
        'draft_description',
        'draft_syarat',
        'draft_harga_info',
    ];

    /**
     * Ambil konten yang aktif (approved). Jika ada draft, tampilkan draft (hanya untuk admin).
     */
    public function activeTitle(): string
    {
        return $this->title;
    }

    public function activeDescription(): string
    {
        return $this->description;
    }

    public function activeSyarat(): ?string
    {
        return $this->syarat;
    }

    public function activeHargaInfo(): ?string
    {
        return $this->harga_info;
    }

    public function hasPendingDraft(): bool
    {
        return $this->status === 'pending';
    }
}
