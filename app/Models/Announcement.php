<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = [
        'message',
        'user_id',
        'reply',
        'replied_at',
        'is_read_by_admin',
        'is_read_by_kepala'
    ];

    /**
     * Relasi ke User pengirim (Kepala).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
