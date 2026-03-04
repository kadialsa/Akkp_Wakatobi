<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
     protected $fillable = [
        'type',
        'title',
        'badge',
        'badge_color',
        'description',
        'image',
        'file'
    ];
}
