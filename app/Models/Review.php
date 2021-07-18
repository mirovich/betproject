<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'username',
        'user_link',
        'user_avatar',
        'text',
        'photo',
        'opinion_link'
    ];
}
