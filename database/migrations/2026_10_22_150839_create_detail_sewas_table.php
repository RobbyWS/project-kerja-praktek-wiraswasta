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
    Schema::create('detail_sewa', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sewa_id')->constrained('sewa')->cascadeOnDelete();
        $table->foreignId('alat_berat_id')->constrained('alat_berat')->restrictOnDelete();
        $table->date('tanggal_awal_sewa');
        $table->date('tanggal_akhir_sewa');
        $table->decimal('harga_per_hari', 12, 2);
        $table->decimal('subtotal', 14, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sewas');
    }
};
