<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('daftar_id');
            $table->foreignId('transaksi_id');
            $table->integer('qty')->default(0);
            $table->string('satuan');
            $table->timestamps();

            $table->foreign('daftar_id')->references('id')->on('daftar_items');
            $table->foreign('transaksi_id')->references('id')->on('transaksis');
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluars');
    }
}
