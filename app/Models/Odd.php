<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odd extends Model
{
    protected $guarded = [''];

    public function bookmaker()
    {
        return $this->belongsTo(\App\Models\Bookmaker::class, 'bookmaker_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo(\App\Models\Game::class, 'game_id', 'id');
    }
}
