<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Menambahkan panjang maksimal untuk nama
            $table->string('email', 255)->unique(); // Menambahkan panjang maksimal untuk email
            $table->string('phone', 20)->nullable(); // Menambahkan panjang maksimal untuk nomor telepon
            $table->string('profile_picture')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
