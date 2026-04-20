<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();

            $table->string('nama_peminjam')->nullable();
            $table->string('nama_alat')->nullable();

            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_rencana_kembali')->nullable();

            $table->enum('status', [
                'menunggu',
                'dipinjam',
                'dikembalikan',
                'ditolak'
            ])->default('menunggu'); // ✅ default jelas, tidak NULL

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};