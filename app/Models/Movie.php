<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'poster',
        'language',
        'genre',
        'duration',
        'rating',
        'price' 
    ];
}
