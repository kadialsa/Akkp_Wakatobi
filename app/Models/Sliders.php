<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active',
        'position',
    ];
}
