<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteItemImage extends Model
{
    protected $table = 'site_item_image';
    protected $fillable = ['image', 'site_id', 'item_id'];
}
