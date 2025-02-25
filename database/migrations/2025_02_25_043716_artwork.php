<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('ID_ARTWORK');
            $table->unsignedInteger('ID_KATEGORI');
            $table->unsignedInteger('ID_MUSEUM');
            $table->string('JUDUL_ARTWORK', 255);
            $table->string('ARTIST_ARTWORK', 255);
            $table->string('DESKRIPSI_ARTWORK', 255);
            $table->string('DATE_ARTWORK', 100);
            $table->string('CATEGORY_ARTWORK', 100);
            $table->string('IMAGE_ARTWORK', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artworks');
    }
};