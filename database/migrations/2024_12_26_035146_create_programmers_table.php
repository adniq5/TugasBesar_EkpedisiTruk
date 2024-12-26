<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammersTable extends Migration
{
    public function up()
    {
        Schema::create('programmers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('instansi');
            $table->string('image')->nullable(); // Kolom untuk menyimpan path gambar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programmers');
    }
}
