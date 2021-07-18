<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $guarded = [''];
    protected $appends = ['status_name'];

    private function getStatusText($status)
    {
        $statuses = [
            0 => 'Не активный',
            1 => 'Активный',
            2 => 'Идет',
            3 => 'Завершенный'
        ];
        return $statuses[$status];
    }

    public function games()
    {
        return $this->hasMany(\App\Models\Game::class, 'league_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        return $this->getStatusText($this->status);
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
