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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');

            // relasi ke user
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->date('tgl_pinjam');
            $table->date('tgl_rencana_kembali');

            $table->enum('status', [
                'menunggu',
                'dipinjam',
                'dikembalikan',
                'ditolak'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
