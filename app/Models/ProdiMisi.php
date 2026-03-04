<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdiMisi extends Model
{
    protected $fillable = [
        'prodi_id',
        'content',
        'urutan',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
