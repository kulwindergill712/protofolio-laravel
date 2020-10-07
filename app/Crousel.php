<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crousel extends Model
{
    protected $fillable = [
        'image_url',
        'heading',
        'description',
    ];
}
