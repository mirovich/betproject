<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function setting()
    {
        return $this->hasOne(\App\Models\Setting::class, 'site_id', 'id');
    }
}
