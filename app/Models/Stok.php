<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $fillable = [
        'product_name',
        'qty',
        'price',
        'status',
        'draft_qty',
        'draft_price',
        'draft_product_name'
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}