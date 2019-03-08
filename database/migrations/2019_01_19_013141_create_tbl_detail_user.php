<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDetailUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detail_user', function (Blueprint $table) {
            $table->increments('id_detail_user');
            $table->integer('id_user')->lenght(11)->unsigned();
            $table->date('tgl_lahir');
            $table->string('phone');
            $table->text('address');
            $table->string('nik');
            $table->integer('saldo')->lenght(20)->unsigned();
            $table->string('alamat');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_detail_user');
    }
}
