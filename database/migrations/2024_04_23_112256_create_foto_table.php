<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('judul_foto');
            $table->text('deskripsi_foto');
            $table->date('tanggal_posting');
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('user_id'); // Menggunakan unsignedBigInteger agar sesuai dengan id di tabel users
            $table->timestamps();
            $table->index('user_id');
            $table->index('album_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto');
    }
};
