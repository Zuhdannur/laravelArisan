<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBarang extends Migration
{
    /**
     * Run the migrations.
     *
* @return void~
     */
    public function up()
    {
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->integer('id_toko')->lenght(11)->unsigned();
            $table->string('nama_barang');
            $table->integer('harga')->lenght(20)->unsigned();
            $table->integer('status')->lenght(1)->unsigned();// 1 atau 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_barang');
    }
}
