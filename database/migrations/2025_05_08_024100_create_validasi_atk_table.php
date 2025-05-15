<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasiAtkTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('validasi_atk', function (Blueprint $table) {
            $table->increments('id_validasi');
            $table->unsignedInteger('id_request');

            $table->foreign('id_request')->references('id_request')->on('request_atk')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_atk');
    }
};
