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
        Schema::table('atkkeluar', function (Blueprint $table) {
            $table->unsignedInteger('id_ba')->nullable();
            $table->foreign('id_ba')->references('id_ba')->on('berita_acara')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atkkeluar', function (Blueprint $table) {
            $table->dropForeign(['id_ba']);
            $table->dropColumn('id_ba');
        });
    }
};
