<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->integer('id_toko')->lenght(11)->unsigned();
            $table->integer('id_user');
            $table->string('jabatan')->nullable();
            $table->integer('gaji')->lenght(20)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pegawai');
    }
}
