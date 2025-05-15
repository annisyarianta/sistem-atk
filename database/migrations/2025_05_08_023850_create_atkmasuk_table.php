<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtkMasukTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atkmasuk', function (Blueprint $table) {
            $table->increments('id_masuk'); 
            $table->unsignedInteger('id_atk'); 
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->integer('harga_satuan');
            $table->integer('harga_total');
        
            // Foreign key constraint
            $table->foreign('id_atk')->references('id_atk')->on('master_atk')->onDelete('restrict');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atkmasuk');
    }
};
