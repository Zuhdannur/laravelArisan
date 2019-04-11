<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblArisan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_arisan', function (Blueprint $table) {
            $table->increments('id_arisan');
            $table->integer('id_anggota')->nullable()->unsigned();
            $table->string('status')->default('belum bayar');
            $table->string('status_bayar')->default('belum menang');
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
        Schema::dropIfExists('tbl_arisan');
    }
}
