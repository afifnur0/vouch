<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bounty extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function donator()
    {
        return $this->belongsTo(User::class, 'donator_id');
    }

    public function streamer()
    {
        return $this->belongsTo(User::class, 'streamer_id');
    }
}