<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestAtkTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_atk', function (Blueprint $table) {
            $table->increments('id_request');
            $table->unsignedInteger('id_atk');
            $table->date('tanggal_request');
            $table->integer('jumlah_request');
            $table->unsignedInteger('id_user');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->foreign('id_atk')->references('id_atk')->on('master_atk')->onDelete('restrict');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_atk');
    }
};
