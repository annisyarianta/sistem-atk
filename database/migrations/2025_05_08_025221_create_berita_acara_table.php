<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->increments('id_ba');
            $table->date('tanggal_ba');
            $table->string('referensi', 100);
            $table->unsignedInteger('id_unit');
            $table->unsignedInteger('id_keluar');
            $table->string('diketahui', 255);
            $table->string('penerima', 255);
            $table->string('jabatan_penerima', 255);
            $table->string('kode_barcode', 100);
            $table->string('lampiran', 255)->nullable();

            $table->foreign('id_unit')->references('id_unit')->on('master_unit')->onDelete('restrict');
            $table->foreign('id_keluar')->references('id_keluar')->on('atkkeluar')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
    }
};
