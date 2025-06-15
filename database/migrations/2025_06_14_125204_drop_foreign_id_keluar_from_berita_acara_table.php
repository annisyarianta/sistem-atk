<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignIdKeluarFromBeritaAcaraTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('berita_acara', function (Blueprint $table) {
            $table->dropForeign(['id_keluar']);
            $table->dropColumn('id_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita_acara', function (Blueprint $table) {
        });
    }
}
