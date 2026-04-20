<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('peminjaman', function (Blueprint $table) {
    //         $table->unsignedBigInteger('id_alat')->nullable()->after('user_id');
            
    //         // foreign key ke tabel alat
    //         $table->foreign('id_alat')->references('id_alat')->on('alat')->onDelete('set null');
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['id_alat']);
            
            $table->dropColumn('id_alat');
        });
    }
};
