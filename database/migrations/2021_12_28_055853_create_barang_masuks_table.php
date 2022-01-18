<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_id');
            $table->integer('qty')->default(0);
            $table->string('satuan');
            $table->string('tanggal_masuk');
            $table->string('tanggal_exp');
            $table->string('supplier');
            $table->timestamps();

            $table->foreign('daftar_id')->references('id')->on('daftar_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
}
