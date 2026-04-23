<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->id();

            $table->string('nama_alat');
            $table->integer('stok')->default(0);

            // ✅ RELASI KE KATEGORI
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();

            $table->string('kondisi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};