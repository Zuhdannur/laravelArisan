<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->integer('id_toko')->lenght(11)->unsigned();
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('allDay');
            $table->string('className');
            $table->string('description')->default('nothing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_jadwal');
    }
}
