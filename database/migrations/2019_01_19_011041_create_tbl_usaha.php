<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_usaha', function (Blueprint $table) {
            $table->increments('id_usaha');
            $table->integer('id_user')->lenght(11)->unsigned();
            $table->string('nama_toko',100);
            $table->string('deskripsi',50);
            $table->string('alamat');
            $table->string('invitation_code')->nullable();
            $table->string('jenis_usaha',80);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_usaha');
    }
}
