<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn('kondisi'); // hapus kolom kondisi
        });
    }

    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->string('kondisi'); // untuk rollback, kalau mau bisa tambahkan default
        });
    }
};
