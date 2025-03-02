<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artwork extends Model
{

    protected $table = 'artworks';

    protected $fillable = [
        'judul_artwork',
        'artist_artwork',
        'deskripsi_artwork',
        'date_artwork',
        'kategori_artwork',
        'image_artwork',
    ];
}
