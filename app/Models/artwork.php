<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artwork extends Model
{

    protected $table = 'artworks';

    public $timestamps = false;

    protected $fillable = [
        'JUDUL_ARTWORK',
        'ARTIST_ARTWORK',
        'DESKRIPSI_ARTWORK',
        'DATE_ARTWORK',
        'CATEGORY_ARTWORK',
        'IMAGE_ARTWORK',
    ];
}
