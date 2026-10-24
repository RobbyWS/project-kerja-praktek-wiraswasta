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
      Schema::create('alat_berat', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('merek');
        $table->string('kapasitas');
        $table->unsignedBigInteger('harga')->default(0);
        $table->boolean('tersedia');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_berat');
    }
};
