<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            // Kolom untuk data buku
            $table->string('penulis')->nullable()->after('kondisi');
            $table->string('penerbit')->nullable()->after('penulis');
            $table->integer('tahun_terbit')->nullable()->after('penerbit');
            $table->string('isbn')->nullable()->after('tahun_terbit');
        });
    }

    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn(['penulis', 'penerbit', 'tahun_terbit', 'isbn']);
        });
    }
};