<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAtk extends Migration
{
    public function up(): void
    {
        Schema::create('master_atk', function (Blueprint $table) {
            $table->increments('id_atk');
            $table->string('nama_atk', 255);
            $table->string('kode_atk', 100);
            $table->enum('jenis_atk', ['habis_pakai', 'tidak_habis_pakai']);
            $table->string('satuan', 50);
            $table->string('gambar_atk', 255)->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('master_atk');
    }
};
