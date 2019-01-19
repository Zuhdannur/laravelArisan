<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_toko')->lenght(11)->unsigned();
            $table->integer('pendapatan')->lenght(20)->unsigned()->nullable();
            $table->integer('pengeluaran')->lenght(20)->unsigned()->nullable();
            $table->date('tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_transaksi');
    }
}
