<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
    'section_id',
    'position',
    'name',
    'degree',
    'photo'
];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
