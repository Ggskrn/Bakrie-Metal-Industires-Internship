<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'status',
        'draft_title',
        'draft_content',
        'draft_image'
    ];
}