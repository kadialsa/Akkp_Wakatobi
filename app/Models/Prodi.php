<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'header_title',
        'sejarah_title',
        'sejarah_content',
        'sejarah_image',
        'kaprodi_name',
        'kaprodi_nip',
        'kaprodi_nidn',
        'kaprodi_photo',
        'visi',
        'tujuan',
        'sasaran',
        'kurikulum_title',
        'kurikulum_content',
        'thumbnail',
        'short_description'

    ];

    public function misi()
    {
        return $this->hasMany(ProdiMisi::class)->orderBy('urutan');
    }
}
