<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkirMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkir_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_parkir')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->string('jenis_id')->nullable();
            $table->string('merek_kendadraan')->nullable();
            $table->string('warna_kendaraan')->nullable();
            $table->integer('petugas_id')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->integer('nominal')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkir_masuks');
    }
}
