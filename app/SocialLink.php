<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'image',
        'name',
        'user_name',
        'link',
    ];
}
