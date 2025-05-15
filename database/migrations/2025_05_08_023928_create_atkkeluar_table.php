<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtkKeluarTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atkkeluar', function (Blueprint $table) {
            $table->increments('id_keluar'); 
            $table->unsignedInteger('id_atk'); 
            $table->integer('jumlah_keluar');
            $table->date('tanggal_keluar');
            $table->unsignedInteger('id_unit'); 
        
            $table->foreign('id_atk')->references('id_atk')->on('master_atk')->onDelete('restrict');
            $table->foreign('id_unit')->references('id_unit')->on('master_unit')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atkkeluar');
    }
};
