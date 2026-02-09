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
    Schema::create('alat', function (Blueprint $table) {
        $table->id('id_alat'); 
        // Pastikan 'kategoris' di sini sama dengan nama tabel di atas
        $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori')->onDelete('cascade');
        $table->string('nama_alat');
        $table->string('kondisi');
        $table->integer('stok');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};