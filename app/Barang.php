<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "tbl_barang";
    public $timestamps = false;
    public $primaryKey = "id_barang";
    protected $fillable = [
        'id_barang','id_toko','nama_barang','harga','status'
    ];
}
