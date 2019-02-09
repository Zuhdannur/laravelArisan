<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "tbl_pegawai";
    public $timestamps = false;
    protected $fillable = [
        'id_pegawai','id_toko','jabatan','gaji'
    ];
}
