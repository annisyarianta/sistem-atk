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
        Schema::table('master_atk', function (Blueprint $table) {
            $table->integer('jumlah_minimum')->default(0)->after('satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_atk', function (Blueprint $table) {
            $table->dropColumn('jumlah_minimum');
        });
    }
};
