<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->integer('id_transaksi')->lenght(11)->unsigned();
            $table->string('nama_barang');
            $table->integer('jumlah')->lenght(11)->unsigned();
            $table->integer('subtotal')->lenght(11)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_detail_transaksi');
    }
}
