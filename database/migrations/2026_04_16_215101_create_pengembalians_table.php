<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('pengembalians', function (Blueprint $table) {
    $table->id();

    $table->foreignId('peminjaman_id')
          ->constrained('peminjamans') // 🔥 FIX DI SINI
          ->cascadeOnDelete();

    $table->date('tgl_kembali');
    $table->integer('terlambat')->default(0);
    $table->integer('denda')->default(0);

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};