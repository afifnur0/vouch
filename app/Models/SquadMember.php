<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadMember extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }

    public function streamer()
    {
        return $this->belongsTo(User::class, 'streamer_id');
    }
}