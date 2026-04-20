<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamerSetting extends Model
{
    use HasFactory;

    // Izinkan mass-assignment
    protected $guarded = [];

    // Konversi tipe data secara otomatis (Casting)
    protected $casts = [
        'preset_amounts' => 'array',
        'custom_banned_words' => 'array',
        'is_media_share_enabled' => 'boolean',
        'is_milestone_enabled' => 'boolean',
        'is_default_filter_enabled' => 'boolean',
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}