<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppMessage extends Model
{
    protected $table = 'whatsapp_messages'; // ← tambahkan baris ini
    
    protected $fillable = ['sender', 'message', 'is_replied', 'reply'];
}