<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $fillable = ['cost', 'chance'];

    public function getImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->image;
    }
    public function getItemImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->item_image;
    }
    public function getNameAttribute()
    {
        $name = SiteCardName::where('site_id', SITE_ID)->where('card_id', $this->id)->first();
        return $name ? $name->name : '';
    }
}
